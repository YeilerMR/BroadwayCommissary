<?php

namespace Api\Controllers;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../validators/ContactValidator.php';
require_once __DIR__ . '/../database/db.php';
require_once __DIR__ . '/../helpers/Recaptcha.php';

use Api\Validators\ContactValidator;
use Api\Helpers\Recaptcha;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use DB;

class ContactFormController
{
    /**
     * Submit contact form
     */
    public static function submit(): void
    {
        header('Content-Type: application/json');

        // Only allow POST requests
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode([
                'success' => false,
                'message' => 'Disallowed method'
            ]);
            return;
        }

        // Get form data
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Invalid data'
            ]);
            return;
        }

        // Validate reCAPTCHA token
        $recaptchaToken = $input['recaptcha_token'] ?? '';
        $recaptchaResponse = Recaptcha::verify($recaptchaToken);
        $recaptchaOk = false;
        if (!empty($recaptchaResponse) && isset($recaptchaResponse['success']) && $recaptchaResponse['success'] === true) {
            if (isset($recaptchaResponse['score'])) {
                $threshold = RECAPTCHA_SCORE_THRESHOLD ?: 0.5;
                if ($recaptchaResponse['score'] >= $threshold) {
                    $recaptchaOk = true;
                }
            } else {
                $recaptchaOk = true;
            }
        }

        if (!$recaptchaOk) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'reCAPTCHA validation failed',
                'recaptcha' => $recaptchaResponse
            ]);
            return;
        }

        // Validate data
        $validation = ContactValidator::validate($input);
        if (!$validation['valid']) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validation['errors']
            ]);
            return;
        }

        // Prepare submission data
        $submission = [
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'subject' => $input['subject'],
            'message' => $input['message'],
            'submitted_at' => date('Y-m-d H:i:s'),
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ];

        // Save to file
        if (!self::saveSubmission($submission)) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error saving your message'
            ]);
            return;
        }

        // Send email
        $emailSent = self::sendContactEmail($submission);

        // Send confirmation to user
        self::sendConfirmationEmail($submission);

        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Your message has been sent successfully. We will contact you soon.',
            'email_sent' => $emailSent
        ]);
    }

    /**
     * Save submission to database
     */
    private static function saveSubmission(array $submission): bool
    {
        try {
            $conn = DB::conn();

            $stmt = $conn->prepare("
                INSERT INTO contact_submissions (
                    name,
                    email,
                    phone,
                    subject,
                    message,
                    ip_address,
                    submitted_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?)
            ");

            if (!$stmt) {
                error_log('Prepare error: ' . $conn->error);
                return false;
            }

            $stmt->bind_param(
                'sssssss',
                $submission['name'],
                $submission['email'],
                $submission['phone'],
                $submission['subject'],
                $submission['message'],
                $submission['ip_address'],
                $submission['submitted_at']
            );

            if (!$stmt->execute()) {
                error_log('Execute error: ' . $stmt->error);
                return false;
            }

            return $stmt->affected_rows === 1;
        } catch (\Exception $e) {
            error_log('Database error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send contact email to admin
     */
    private static function sendContactEmail(array $submission): bool
    {
        try {
            // Check if composer autoload exists
            if (!file_exists(__DIR__ . '/../../vendor/autoload.php')) {
                error_log('PHPMailer not installed. Please run: composer install');
                return false;
            }

            require_once __DIR__ . '/../../vendor/autoload.php';

            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = MAIL_ENCRYPTION;
            $mail->Port = MAIL_PORT;

            // Recipients
            $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            $mail->addAddress(MAIL_FROM_ADDRESS, MAIL_FROM_NAME); // Send to admin
            $mail->addReplyTo($submission['email'], $submission['name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Nuevo mensaje de contacto: ' . $submission['subject'];
            $mail->Body = self::getEmailTemplate($submission);
            $mail->AltBody = self::getPlainTextEmail($submission);

            return $mail->send();
        } catch (Exception $e) {
            error_log('PHPMailer Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send confirmation email to user
     */
    private static function sendConfirmationEmail(array $submission): bool
    {
        try {
            if (!file_exists(__DIR__ . '/../../vendor/autoload.php')) {
                return false;
            }

            require_once __DIR__ . '/../../vendor/autoload.php';

            $mail = new PHPMailer(true);

            // Server settings
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = MAIL_ENCRYPTION;
            $mail->Port = MAIL_PORT;

            // Recipients
            $mail->setFrom(MAIL_FROM_ADDRESS, MAIL_FROM_NAME);
            $mail->addAddress($submission['email'], $submission['name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'We confirm receipt of your message - Lakeland Commissary';
            $mail->Body = self::getConfirmationTemplate($submission);
            $mail->AltBody = 'Thank you for contacting us. Your message has been received.';

            return $mail->send();
        } catch (Exception $e) {
            error_log('PHPMailer Confirmation Error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get HTML email template for admin
     */
    private static function getEmailTemplate(array $submission): string
    {
        // Asegúrate de escapar y formatear el contenido del mensaje
        $messageContent = nl2br(htmlspecialchars($submission['message']));

        return <<<HTML
        <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>New Contact Message</title>
            </head>
            <body style='font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>

                <div style='max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-top: 5px solid #007bff;'>
                    
                    <div style='padding: 20px 30px; border-bottom: 1px solid #eeeeee;'>
                        <h2 style='margin: 0; color: #333333; font-size: 24px;'>&#9993; New Contact Submission</h2>
                    </div>
                    
                    <div style='padding: 20px 30px;'>
                        <p style='margin: 0 0 15px 0; font-size: 16px; color: #555555;'>You have received a new message from your contact form. Details are below:</p>

                        <table style='width: 100%; border-collapse: collapse;'>
                            <tr>
                                <td style='padding: 8px 0; font-weight: bold; width: 30%; color: #333333;'>Name:</td>
                                <td style='padding: 8px 0; color: #007bff;'>{$submission['name']}</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px 0; font-weight: bold; color: #333333;'>Email:</td>
                                <td style='padding: 8px 0;'><a href='mailto:{$submission['email']}' style='color: #007bff; text-decoration: none;'>{$submission['email']}</a></td>
                            </tr>
                            <tr>
                                <td style='padding: 8px 0; font-weight: bold; color: #333333;'>Phone:</td>
                                <td style='padding: 8px 0; color: #555555;'>{$submission['phone']}</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px 0; font-weight: bold; color: #333333;'>Subject:</td>
                                <td style='padding: 8px 0; color: #555555;'>{$submission['subject']}</td>
                            </tr>
                        </table>
                    </div>
                    
                    <div style='padding: 0 30px 20px 30px;'>
                        <h3 style='margin-top: 0; color: #333333; font-size: 18px; border-bottom: 1px solid #eeeeee; padding-bottom: 5px;'>Message:</h3>
                        
                        <div style='background-color: #f9f9f9; padding: 15px; border-left: 5px solid #28a745; border-radius: 4px; color: #333333; line-height: 1.6;'>
                            {$messageContent}
                        </div>
                    </div>

                    <div style='padding: 15px 30px; border-top: 1px solid #eeeeee; text-align: center; background-color: #f7f7f7; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;'>
                        <p style='margin: 0; color: #888888; font-size: 12px;'>
                            Received: **{$submission['submitted_at']}**<br>
                            IP Address: {$submission['ip_address']}
                        </p>
                        <p style='margin: 5px 0 0 0; color: #aaaaaa; font-size: 10px;'>
                            This email was sent automatically.
                        </p>
                    </div>
                    
                </div>

            </body>
        </html>
        HTML;
    }

    /**
     * Get plain text email for admin
     */
    private static function getPlainTextEmail(array $submission): string
    {
        return "New contact message\n\n" .
            "Name: {$submission['name']}\n" .
            "Email: {$submission['email']}\n" .
            "Phone: {$submission['phone']}\n" .
            "Subject: {$submission['subject']}\n\n" .
            "Message:\n" .
            "{$submission['message']}\n\n" .
            "Received: {$submission['submitted_at']}\n" .
            "IP: {$submission['ip_address']}\n";
    }

    /**
     * Get HTML confirmation template for user
     */
    private static function getConfirmationTemplate(array $submission): string
    {
        // Asegúrate de escapar y formatear el contenido del mensaje
        $messageContent = nl2br(htmlspecialchars($submission['message'] ?? 'Not provided'));

        return <<<HTML
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Thank You for Contacting Us!</title>
                </head>
                <body style='font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>

                    <div style='max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); border-bottom: 5px solid #28a745;'>
                        
                        <div style='padding: 30px 30px 20px 30px; text-align: center;'>
                            <h2 style='margin: 0 0 10px 0; color: #28a745; font-size: 28px;'>&#10003; Message Received!</h2>
                            <h1 style='margin: 0; color: #333333; font-size: 20px;'>Thank you for contacting us, {$submission['name']}!</h1>
                        </div>
                        
                        <div style='padding: 0 30px 20px 30px;'>
                            <p style='margin-bottom: 20px; font-size: 16px; color: #555555; text-align: center;'>
                                We have successfully received your message and appreciate you reaching out. We will review your inquiry and get back to you **as soon as possible**.
                            </p>

                            <div style='background-color: #f9f9f9; padding: 15px; border-radius: 4px; border: 1px solid #eeeeee;'>
                                <p style='font-size: 14px; font-weight: bold; color: #333333; margin-top: 0;'>Summary of your submission:</p>
                                <ul style='list-style-type: none; padding: 0; margin: 0;'>
                                    <li style='margin-bottom: 5px; color: #555555;'><strong>Subject:</strong> {$submission['subject']}</li>
                                    <li style='margin-bottom: 5px; color: #555555;'><strong>Submitted:</strong> {$submission['submitted_at']}</li>
                                </ul>
                            </div>

                            <p style='margin-top: 25px; margin-bottom: 30px; text-align: center;'>
                                <a href='mailto:your-support-email@example.com' 
                                style='display: inline-block; padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;'>
                                    Reply to this Email if Urgent
                                </a>
                            </p>

                            <p style='font-size: 14px; color: #555555;'>
                                If your question is answered before we contact you, or if you have any immediate concerns, please feel free to reach out to us again.
                            </p>
                        </div>

                        <div style='padding: 15px 30px; border-top: 1px solid #eeeeee; text-align: center; background-color: #f7f7f7; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;'>
                            <p style='margin: 0; color: #888888; font-size: 12px;'>
                                Kind regards,<br>
                                <strong style='color: #333333;'>Lakeland Commissary</strong>
                            </p>
                        </div>
                        
                    </div>

                </body>
            </html>
            HTML;
    }
}
