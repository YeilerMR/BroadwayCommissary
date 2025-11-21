<?php
/**
 * API Router
 * Main entry point for all API requests
 */

require_once __DIR__ . '/config/config.php';

// If we're in development, show errors to help debugging
if (defined('APP_ENV') && APP_ENV === 'development') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/controllers/EmailSubscriptionController.php';
require_once __DIR__ . '/controllers/ContactFormController.php';

use Api\Controllers\EmailSubscriptionController;
use Api\Controllers\ContactFormController;

try {
    // Get the endpoint from query parameter
    $endpoint = $_GET['endpoint'] ?? '';
    $parts = explode('/', trim($endpoint, '/'));
    
    $resource = $parts[0] ?? '';
    $action = $parts[1] ?? '';
    
    // Route handling
    switch ($resource) {
        case 'email':
            if ($action === 'subscribe') {
                EmailSubscriptionController::subscribe();
            } elseif ($action === 'unsubscribe') {
                // Allow unsubscribe via GET link from email: /api/email/unsubscribe?email=user@example.com
                if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['email'])) {
                    EmailSubscriptionController::unsubscribeGet();
                } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    EmailSubscriptionController::unsubscribe();
                } else {
                    http_response_code(405);
                    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
                }
            } else {
                handleNotFound();
            }
            break;
            
        case 'contact':
            if ($action === 'submit' || $_SERVER['REQUEST_METHOD'] === 'POST') {
                ContactFormController::submit();
            } else {
                handleNotFound();
            }
            break;
            
        case 'health':
            http_response_code(200);
            echo json_encode([
                'status' => 'ok',
                'timestamp' => date('Y-m-d H:i:s')
            ]);
            break;
            
        default:
            handleNotFound();
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal Server Error',
        'error' => APP_ENV === 'development' ? $e->getMessage() : ''
    ]);
}

/**
 * Handle 404 errors
 */
function handleNotFound(): void
{
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => 'Endpoint not found'
    ]);
}
