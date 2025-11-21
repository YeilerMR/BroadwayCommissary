<?php

namespace Api\Validators;

use DB;

class EmailValidator
{
    /**
     * Validate email format
     */
    public static function validate(string $email): array
    {
        $email = trim($email);

        if (empty($email)) {
            return [
                'valid' => false,
                'message' => 'Email address is required'
            ];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'valid' => false,
                'message' => 'The email format is invalid'
            ];
        }

        if (strlen($email) > 255) {
            return [
                'valid' => false,
                'message' => 'The email is too long'
            ];
        }

        return [
            'valid' => true,
            'message' => 'Valid email',
            'email' => $email
        ];
    }

    /**
     * Check if email already exists in subscribers
     */
    public static function alreadyExists(string $email): bool
    {
        $conn = DB::conn();

        $stmt = $conn->prepare("SELECT id FROM email_subscribers WHERE email = ? AND active = TRUE LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public static function registerEmail(string $email, string $createdAt): bool
    {
        $conn = DB::conn();

        $stmt = $conn->prepare("
        INSERT INTO email_subscribers (
            email,
            subscribed_at,
            unsubscribed_at,
            active
        ) VALUES (
            ?,                       
            ?,      
            NULL,                   
            1
        )
     ");

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ss", $email, $createdAt);

        if (!$stmt->execute()) {
            return false;
        }

        return $stmt->affected_rows === 1;
    }

    public static function unsubscribeEmail(string $email, string $unsubscribedAt): bool
    {
        $conn = DB::conn();

        $stmt = $conn->prepare("
        UPDATE email_subscribers
        SET
            active = 0,
            unsubscribed_at = ?
        WHERE email = ?
        LIMIT 1
        ");

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("ss", $unsubscribedAt, $email);

        if (!$stmt->execute()) {
            return false;
        }

        return $stmt->affected_rows === 1;
    }
}
