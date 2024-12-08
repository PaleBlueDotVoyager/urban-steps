<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

// Database connection details
$servername = "localhost";
$dbusername = "root";  
$dbpassword = "";      
$dbname = "urbansteps_ds";

// Connect to the database
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to update user data
function updateUserData($conn, $username, $email, $phone, $address) {
    $update_sql = "UPDATE account SET email=?, phone_number=?, address=? WHERE username=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssss", $email, $phone, $address, $username); // "ssss" indicates 4 string parameters
    return $stmt->execute();
}

// Handle form submission for updating user data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $username = $conn->real_escape_string($_SESSION['user']['username']); // Get the username from session
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    
    // Call the update function
    if (updateUserData($conn, $username, $email, $phone, $address)) {
        // Update the session data to reflect changes
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['phone_number'] = $phone;
        $_SESSION['user']['address'] = $address;
        echo "<script>alert('Profile updated successfully.'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";  // Debugging statement
    }
}

// Close the database connection
$conn->close();
?>
