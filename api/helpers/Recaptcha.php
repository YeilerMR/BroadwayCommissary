<?php

namespace Api\Helpers;

class Recaptcha
{
    /**
     * Verify reCAPTCHA token with Google
     * Returns decoded response array from Google
     */
    public static function verify(string $token): array
    {
        $secret = RECAPTCHA_SECRET;
        if (empty($secret) || empty($token)) {
            return [
                'success' => false,
                'error-codes' => ['missing-input-secret-or-token']
            ];
        }

        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $data = http_build_query([
            'secret' => $secret,
            'response' => $token
        ]);

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => $data,
                'timeout' => 10
            ]
        ];

        $context  = stream_context_create($options);
        $result = @file_get_contents($url, false, $context);
        if ($result === false) {
            return [
                'success' => false,
                'error-codes' => ['recaptcha-request-failed']
            ];
        }

        $resp = json_decode($result, true);
        if (!is_array($resp)) {
            return [
                'success' => false,
                'error-codes' => ['invalid-json-response']
            ];
        }

        return $resp;
    }
}
