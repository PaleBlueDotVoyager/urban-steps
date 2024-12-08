<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection details
    $servername = "localhost";
    $dbusername = "root";  // Default username for MySQL
    $dbpassword = "";      // Default password for MySQL (empty if no password)
    $dbname = "urbansteps_ds";

    // Connect to the database
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $query = "SELECT id, username FROM account WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }

    // Bind parameters
    $stmt->bind_param("ss", $username, $password);
    
    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($user_id, $db_username); // Adjust based on your table's structure

    // Fetch the result
    if ($stmt->fetch()) {
        // User exists, set session and redirect to landing page
        $_SESSION['user_id'] = $user_id; // Set user ID in session
        $_SESSION['user'] = $db_username; // Store username in session
        header('Location: ../PHP/landing.php'); // Redirect to landing page
        exit();
    } else {
        // Invalid credentials
        echo 'Invalid username or password.';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
