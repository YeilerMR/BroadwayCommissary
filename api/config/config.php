<?php
/**
 * Email Configuration for PHPMailer
 */

// Load DB helper (provides DB::conn())
require_once __DIR__ . '/../database/db.php';

define('MAIL_HOST', 'smtp.gmail.com');
define('MAIL_PORT', 587);
define('MAIL_ENCRYPTION', 'tls');
define('MAIL_USERNAME', 'adbvtest@gmail.com'); 
define('MAIL_PASSWORD', 'hymk bvzd tnbu akrb');
define('MAIL_FROM_ADDRESS', 'adbvtest@gmail.com');
define('MAIL_FROM_NAME', 'Lakeland Commissary');

// Database configuration (for future use)
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'danielbv0415');
define('DB_NAME', 'Lakeland Commissary');

// Application settings
define('APP_URL', 'http://localhost/BroadwayCommissary');
define('APP_ENV', 'development'); // 'development' or 'production'

// reCAPTCHA configuration
// Set your secret key here (from Google reCAPTCHA admin)
define('RECAPTCHA_SECRET', '');
// Score threshold for reCAPTCHA v3 (optional). If empty, only 'success' is checked.
define('RECAPTCHA_SCORE_THRESHOLD', 0.5);