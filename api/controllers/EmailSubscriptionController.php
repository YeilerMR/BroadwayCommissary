<?php

namespace Api\Controllers;

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../validators/EmailValidator.php';
require_once __DIR__ . '/../helpers/Recaptcha.php';

use Api\Validators\EmailValidator;
use Api\Helpers\Recaptcha;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSubscriptionController
{
    /**
     * Subscribe an email to notifications
     */
    public static function subscribe(): void
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

        // Get JSON input
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['email'])) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Email address is required'
            ]);
            return;
        }

        // Validate reCAPTCHA token
        $recaptchaToken = $input['recaptcha_token'] ?? '';
        $recaptchaResponse = Recaptcha::verify($recaptchaToken);
        // If google response has score, check threshold. Otherwise rely on success flag.
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

        $email = $input['email'];

        // Validate email
        $validation = EmailValidator::validate($email);
        if (!$validation['valid']) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $validation['message']
            ]);
            return;
        }

        // Check if already subscribed
        if (EmailValidator::alreadyExists($email)) {
            http_response_code(409);
            echo json_encode([
                'success' => false,
                'message' => 'This email address is already subscribed'
            ]);
            return;
        }

        $res = EmailValidator::registerEmail($email, date('Y-m-d H:i:s'));
        if ($res) {
            // Send confirmation email with unsubscribe link (best-effort)
            try {
                self::sendSubscriptionEmail($email);
            } catch (\Exception $e) {
                // Log error but don't fail the subscription
                error_log('Subscription email error: ' . $e->getMessage());
            }
            http_response_code(201);
            echo json_encode([
                'success' => true,
                'message' => 'You have successfully subscribed to our notifications',
                'email' => $email
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error processing your subscription'
            ]);
        }
    }

    /**
     * Send subscription confirmation email with unsubscribe link
     */
    private static function sendSubscriptionEmail(string $email): bool
    {
        // If PHPMailer not installed, skip
        if (!file_exists(__DIR__ . '/../../vendor/autoload.php')) {
            error_log('PHPMailer not installed. Run composer install.');
            return false;
        }

        require_once __DIR__ . '/../../vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            // Unsubscribe link (GET)
            $unsubscribeUrl = rtrim(APP_URL, '/') . '/api/email/unsubscribe?email=' . urlencode($email);

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
            $mail->addAddress($email);

            // --- EMAIL CONTENT (Improved Design) ---

            $mail->isHTML(true);
            $mail->Subject = 'Subscription Confirmation - Lakeland Commissary';

            // Heredoc para el cuerpo HTML mejorado
            $mail->Body = <<<HTML
            <html>
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Subscription Confirmation</title>
                </head>
                <body style='font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;'>

                    <div style='max-width: 600px; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05); border-top: 5px solid #ffc107;'>
                        
                        <div style='padding: 25px 30px; text-align: center;'>
                            <h2 style='margin: 0; color: #333333; font-size: 24px;'>&#9998; Welcome to Lakeland Commissary!</h2>
                        </div>
                        
                        <div style='padding: 0 30px 20px 30px;'>
                            <p style='font-size: 16px; color: #555555;'>
                                Thank you for subscribing to **Lakeland Commissary** notifications. You will now receive our latest updates directly in your inbox.
                            </p>

                            <div style='margin: 30px 0; padding: 15px; border: 1px solid #ffc107; background-color: #fffbe6; border-radius: 4px; text-align: center;'>
                                <p style='margin-bottom: 10px; font-size: 14px; color: #856404; font-weight: bold;'>
                                    Unsubscribe
                                </p>
                                <p style='margin: 0;'>
                                    <a href="{$unsubscribeUrl}" 
                                    style='display: inline-block; padding: 10px 20px; background-color: #dc3545; color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px;'>
                                        Click Here to Unsubscribe
                                    </a>
                                </p>
                            </div>
                            
                            <p style='font-size: 14px; color: #777777; text-align: center; margin-top: 30px;'>
                                If you did not request this subscription, please click the link above or simply ignore this email.
                            </p>
                        </div>

                        <div style='padding: 15px 30px; border-top: 1px solid #eeeeee; text-align: center; background-color: #f7f7f7; border-bottom-left-radius: 8px; border-bottom-right-radius: 8px;'>
                            <p style='margin: 0; color: #999999; font-size: 11px;'>
                                Kind regards,<br>
                                The Lakeland Commissary Team
                            </p>
                        </div>
                        
                    </div>

                </body>
            </html>
            HTML;

            // Versión de texto plano
            $mail->AltBody = "Thank you for subscribing to Lakeland Commissary notifications.\n\nTo unsubscribe, please visit the following link: {$unsubscribeUrl}";

            return $mail->send();
        } catch (Exception $e) {
            error_log('PHPMailer subscription error: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Unsubscribe via GET link (from email)
     * Example: /api/email/unsubscribe?email=user@example.com
     */
    public static function unsubscribeGet(): void
    {
        // Expect email in query string
        $email = $_GET['email'] ?? '';
        if (empty($email)) {
            http_response_code(400);
            echo '<h1>Bad request</h1><p>Missing email parameter.</p>';
            return;
        }

        $email = strtolower(trim($email));
        $res = EmailValidator::unsubscribeEmail($email, date('Y-m-d H:i:s'));

        if ($res) {
            echo '<h1>Successful unsubscription</h1><p>Your email has been successfully unsubscribed from notifications.</p>';
        } else {
            echo '<h1>Error</h1><p>We were unable to unsubscribe you. Your email address may not exist or you may have already been unsubscribed.</p>';
        }
    }

    /**
     * Unsubscribe an email
     */
    public static function unsubscribe(): void
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode([
                'success' => false,
                'message' => 'Disallowed method'
            ]);
            return;
        }

        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input || !isset($input['email'])) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Email address is required'
            ]);
            return;
        }

        $email = strtolower($input['email']);
        $res = EmailValidator::unsubscribeEmail($email, date('Y-m-d H:i:s'));
        if ($res) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'You have successfully unsubscribed'
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error processing your unsubscription'
            ]);
        }
    }
}
