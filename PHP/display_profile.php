<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

$user = $_SESSION['user'];

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

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Fetch user data from the database based on the username from the session
$username = $user['username'];
$sql = "SELECT * FROM account WHERE username = '$username'";
$result = $conn->query($sql);

// Initialize user data variables
$email = '';
$phone = '';
$address = '';

if ($result->num_rows > 0) {
    // Fetch the user data
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $phone = $row['phone_number'];
    $address = $row['address'];
} else {
    echo "No user found.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - UrbanSteps</title>
    <link rel="stylesheet" href="../CSS/profile.css">
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <header>
        <h1><a href="#">UrbanSteps</a></h1>
        <nav>
            <ul class="nav-btn">
                <li><a href="../PHP/landing.php">Home</a></li>
                <li><a href="../PHP/product.php">Products</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <div class="user-menu">
            <div class="dropdown">
                <button class="btn1">
                    <a href="../PHP/profile.php">
                        <i class="fa-solid fa-user" style="color: #181C14;"></i>
                    </a>
                </button>
            </div>
            <div class="dropdown">
                <button class="btn1">
                    <a href="../PHP/cart.php">
                        <i class="fa-solid fa-cart-shopping" style="color: #181C14;"></i>
                    </a>
                </button>
            </div>
            <div class="dropdown">
                <button class="btn1">
                    <a href="../PHP/history.php">
                        <i class="fa-solid fa-receipt" style="color: #181C14;"></i>
                    </a>
                </button>
            </div>
            <div class="dropdown">
                <button class="btn1" onclick="location.href='../landing_no_acc.html'">
                    <i class="fas fa-sign-out-alt" style="color: #181C14;"></i>
                </button>
            </div>
        </div>
    </header>

    <section id="profile">
        <h2>User Profile</h2>
        <div class="profile-info">
            <div>
                <label for="username">Username:</label>
                <p id="username"><?php echo htmlspecialchars($username); ?></p>
            </div>
            <div>
                <label for="email">Email:</label>
                <p id="email"><?php echo htmlspecialchars($email); ?></p>
            </div>
            <div>
                <label for="phone">Phone Number:</label>
                <p id="phone"><?php echo htmlspecialchars($phone); ?></p>
            </div>
            <div>
                <label for="address">Address:</label>
                <p id="address"><?php echo htmlspecialchars($address); ?></p>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-row">
            <div class="footer-section">
                <h2>Shortcuts</h2>
                <a href="../landing.html">Home</a>
                <a href="product.html">Products</a>
                <a href="#">Contact</a>
            </div>
            <div class="footer-section">
                <h2>About Us</h2>
                <p>Learn more about our story, mission, and values.</p>
                <a href="#">Read More</a>
            </div>
            <div class="footer-section">
                <h2>Contact Info</h2>
                <p>Email: urbansteps@gmail.com</p>
                <p>Phone: 09123456789</p>
                <p>Address: Fatima Ave, corner MacArthur Hwy, Valenzuela, 1440 Metro Manila</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 UrbanSteps. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
