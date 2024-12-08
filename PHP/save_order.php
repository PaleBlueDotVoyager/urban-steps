<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderData = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($_SESSION['orders'])) {
        $_SESSION['orders'] = [];
    }

    $_SESSION['orders'][] = $orderData;
    http_response_code(200);
} else {
    http_response_code(400);
}
