<?php
/**
 * Email Configuration for PHPMailer
 */

// Load DB helper (provides DB::conn())
require_once __DIR__ . '/../database/db.php';

function loadEnvIfAvailable($filePath) {
    if (!file_exists($filePath)) {
        return; 
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '#') === 0) {
            continue;
        }

        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Lógica de manejo de comillas del código original
            if ((strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) ||
                (strpos($value, "'") === 0 && strrpos($value, "'") === strlen($value) - 1)) {
                $value = substr($value, 1, -1);
            }
            
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

loadEnvIfAvailable(__DIR__ . '/../../.env');


// PHPMailer Configuration
define('MAIL_HOST', getenv('MAIL_HOST') ?? $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com');
define('MAIL_PORT', getenv('MAIL_PORT') ?? $_ENV['MAIL_PORT'] ?? 587);
define('MAIL_ENCRYPTION', getenv('MAIL_ENCRYPTION') ?? $_ENV['MAIL_ENCRYPTION'] ?? 'tls');
define('MAIL_USERNAME', getenv('MAIL_USERNAME') ?? $_ENV['MAIL_USERNAME'] ?? '');
define('MAIL_PASSWORD', getenv('MAIL_PASSWORD') ?? $_ENV['MAIL_PASSWORD'] ?? '');
define('MAIL_FROM_ADDRESS', getenv('MAIL_FROM_ADDRESS') ?? $_ENV['MAIL_FROM_ADDRESS'] ?? '');
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?? $_ENV['MAIL_FROM_NAME'] ?? 'Lakeland Commissary');

// Database
define('DB_HOST', getenv('DB_HOST') ?? $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', getenv('DB_USER') ?? $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', getenv('DB_PASS') ?? $_ENV['DB_PASS'] ?? '');
define('DB_NAME', getenv('DB_NAME') ?? $_ENV['DB_NAME'] ?? 'lakeland_commissary');

// Application settings
define('APP_URL', getenv('APP_URL') ?? $_ENV['APP_URL'] ?? 'http://localhost/Lakeland-Commissary');
define('APP_ENV', getenv('APP_ENV') ?? $_ENV['APP_ENV'] ?? 'development');

// reCAPTCHA configuration
define('RECAPTCHA_SECRET', getenv('RECAPTCHA_SECRET') ?? $_ENV['RECAPTCHA_SECRET'] ?? '');
define('RECAPTCHA_SCORE_THRESHOLD', getenv('RECAPTCHA_SCORE_THRESHOLD') ?? $_ENV['RECAPTCHA_SCORE_THRESHOLD'] ?? 0.5);