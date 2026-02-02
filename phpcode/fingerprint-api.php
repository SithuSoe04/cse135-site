<?php
/**
 * Fingerprint API - CSE 135 Extra Credit
 *
 * This API demonstrates browser fingerprinting for user identification
 * even after cookies are cleared.
 *
 * Storage: Uses a JSON file to persist fingerprint-to-session mappings
 * In production, this would use a database.
 */

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set JSON response header
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Credentials: true');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Storage file path (in production, use a database)
$storageFile = __DIR__ . '/fingerprint-data.json';

// Load existing data
function loadData($file) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        return json_decode($content, true) ?: [];
    }
    return [];
}

// Save data
function saveData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    echo json_encode(['error' => 'Invalid JSON input']);
    exit();
}

$action = $input['action'] ?? '';
$fingerprint = $input['fingerprint'] ?? '';

if (empty($fingerprint)) {
    echo json_encode(['error' => 'Fingerprint required']);
    exit();
}

// Start session
session_start();

// Load stored fingerprint data
$data = loadData($storageFile);

// Initialize response
$response = [
    'success' => true,
    'has_cookie' => isset($_COOKIE['PHPSESSID']),
    'session_id' => session_id(),
    'fingerprint' => $fingerprint
];

switch ($action) {
    case 'check':
        // Check if this fingerprint exists in our records
        $fingerprintExists = isset($data[$fingerprint]);
        $sessionHasFingerprint = isset($_SESSION['fingerprint']);

        if (!$sessionHasFingerprint && $fingerprintExists) {
            // REASSOCIATION: Cookie was cleared but fingerprint matches!
            // Restore the session data from fingerprint storage
            $_SESSION['fingerprint'] = $fingerprint;
            $_SESSION['stored_data'] = $data[$fingerprint]['stored_data'] ?? '';
            $_SESSION['visit_count'] = ($data[$fingerprint]['visit_count'] ?? 0) + 1;

            // Log this reassociation
            $data[$fingerprint]['visit_history'][] = [
                'time' => date('Y-m-d H:i:s'),
                'method' => 'Fingerprint Reassociation (cookies were cleared)'
            ];
            $data[$fingerprint]['visit_count'] = $_SESSION['visit_count'];

            $response['is_new'] = false;
            $response['reassociated'] = true;
            $response['recognition_method'] = 'Fingerprint (cookies were cleared, but we recognized you!)';

        } elseif ($sessionHasFingerprint && $_SESSION['fingerprint'] === $fingerprint) {
            // Normal returning user with valid session
            $_SESSION['visit_count'] = ($_SESSION['visit_count'] ?? 0) + 1;

            // Update storage
            if (!isset($data[$fingerprint])) {
                $data[$fingerprint] = [];
            }
            $data[$fingerprint]['visit_history'][] = [
                'time' => date('Y-m-d H:i:s'),
                'method' => 'Session Cookie'
            ];
            $data[$fingerprint]['visit_count'] = $_SESSION['visit_count'];

            $response['is_new'] = false;
            $response['reassociated'] = false;
            $response['recognition_method'] = 'Session Cookie (normal identification)';

        } else {
            // New user
            $_SESSION['fingerprint'] = $fingerprint;
            $_SESSION['stored_data'] = '';
            $_SESSION['visit_count'] = 1;

            // Create new fingerprint record
            $data[$fingerprint] = [
                'first_seen' => date('Y-m-d H:i:s'),
                'stored_data' => '',
                'visit_count' => 1,
                'visit_history' => [
                    [
                        'time' => date('Y-m-d H:i:s'),
                        'method' => 'New Visitor'
                    ]
                ]
            ];

            $response['is_new'] = true;
            $response['reassociated'] = false;
            $response['recognition_method'] = 'New visitor (first time seeing this fingerprint)';
        }

        // Add stored data and history to response
        $response['stored_data'] = $_SESSION['stored_data'] ?? $data[$fingerprint]['stored_data'] ?? '';
        $response['visit_count'] = $_SESSION['visit_count'] ?? 1;
        $response['visit_history'] = array_slice($data[$fingerprint]['visit_history'] ?? [], -10); // Last 10 visits

        // Save updated data
        saveData($storageFile, $data);
        break;

    case 'save':
        // Save user data associated with this fingerprint
        $userData = $input['data'] ?? '';

        $_SESSION['stored_data'] = $userData;

        // Also save to fingerprint storage for reassociation
        if (!isset($data[$fingerprint])) {
            $data[$fingerprint] = [
                'first_seen' => date('Y-m-d H:i:s'),
                'visit_count' => 1,
                'visit_history' => []
            ];
        }
        $data[$fingerprint]['stored_data'] = $userData;
        $data[$fingerprint]['last_updated'] = date('Y-m-d H:i:s');

        saveData($storageFile, $data);

        $response['message'] = 'Data saved successfully';
        break;

    case 'clear':
        // Clear all data for this fingerprint
        if (isset($data[$fingerprint])) {
            unset($data[$fingerprint]);
            saveData($storageFile, $data);
        }

        // Destroy session
        session_destroy();

        $response['message'] = 'All data cleared';
        break;

    default:
        $response = ['error' => 'Unknown action'];
}

echo json_encode($response);
