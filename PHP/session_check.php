<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header('Location: login.html');
    exit();
}

// User is logged in, you can access user information
$username = $_SESSION['user']['username']; // Access the username (customize as needed)

// Optionally, you can define other user-related variables or functions here
?>
