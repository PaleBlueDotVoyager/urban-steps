<?php
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture user input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password']; // Storing password in plain text

    // Check if username or email already exists
    $checkUser = "SELECT * FROM account WHERE username='$username' OR email='$email'";
    $result = $conn->query($checkUser);

    if (!$result) {
        die("Error checking user existence: " . $conn->error); // Capture error if the query fails
    }

    if ($result->num_rows > 0) {
        // Redirect if username or email is taken
        header("Location: register.php?error=Username or Email already taken!");
        exit();
    } else {
        // Insert data into the database without hashing the password
        $sql = "INSERT INTO account (username, email, phone_number, password, address) 
                VALUES ('$username', '$email', '$phone', '$password', '$address')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to the new success page after successful registration
            header("Location: registration_success.php");
            exit();
        } else {
            // Capture error if insertion fails
            die("Error inserting data: " . $conn->error);
        }
    }
}

// Close the database connection
$conn->close();
?>
