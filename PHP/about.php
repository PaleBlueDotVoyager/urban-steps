<?php
include 'session_check.php'; // Include the session check file

// Database credentials
$host = 'localhost';  // WAMP server usually runs locally
$username = 'root';    // Default WAMP username
$password = '';        // Default WAMP password (empty for root)
$dbname = 'UrbanSteps_DS';  // Your database name

// Create connection using mysqli
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - [Your Store Name]</title>
    <link rel="stylesheet" href="../CSS/about.css">
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/footer.css">
     <!--FONTS-->
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
     <!--ICONS-->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<header>
        <h1><a href="landing.php">UrbanSteps</a></h1>
        <nav>
            <ul class="nav-btn">
                <li><a href="landing.php">Home</a></li>
                <li><a href="product.php">Products</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="user-menu">
            <div class="dropdown"> 
                <button class="btn1">
                    <a href="profile.php">
                        <i class="fa-solid fa-user" style="color: #181C14;"></i>
                    </a>
                </button>
            </div>
            <div class="dropdown">
                <button class="btn1">
                    <a href="cart.php">
                        <i class="fa-solid fa-cart-shopping" style="color: #181C14;"></i>
                    </a>
                </button>
            </div>
            <div class="dropdown">
                <button class="btn1">
                    <a href="history.php">
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
<body>
<section class="intro">
        <div class="container">
            <h2>Welcome to UrbanSteps</h2>
            <p>We are your trusted online destination for premium footwear, offering high-quality, 100% authentic shoes. Available both locally in the Philippines and internationally, we bring comfort, style, and reliability to your doorstep.</p>
        </div>
    </section>

    <section class="history">
        <div class="container">
            <h2>Our Story</h2>
            <p>Founded in 2024, UrbanSteps began with a simple vision: to provide high-quality, authentic footwear to shoe lovers worldwide. What started as a small venture in the Philippines has grown into an international brand, trusted by customers globally.</p>
        </div>
    </section>

    <section class="mission">
        <div class="container">
            <h2>Our Mission and Values</h2>
            <p>Our mission is simple: to provide only the best quality footwear, with transparency and trust. We are committed to offering shoes that are durable, stylish, and most importantly, genuine.</p>
        </div>
    </section>

    <section class="why-choose-us">
        <div class="container">
            <h2>Why Choose Us?</h2>
            <ul>
                <li><strong>100% Authentic</strong>: We guarantee all our shoes are genuine, sourced from trusted brands.</li>
                <li><strong>Worldwide Shipping</strong>: Our shoes are available for delivery globally.</li>
                <li><strong>Customer Satisfaction</strong>: We offer easy returns, and our customer support team is always ready to help.</li>
            </ul>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2>Customer Testimonials</h2>
            <p>"Amazing selection of shoes! I love the quality and fast shipping to the US." — Maria, New York</p>
            <p>"I've bought several pairs from UrbanSteps and will keep coming back. Their customer service is outstanding!" — John, Manila</p>
        </div>
    </section>

    <section class="shipping">
        <div class="container">
            <h2>Shipping & Delivery</h2>
            <p>We offer worldwide shipping, with fast and reliable delivery options. Shipping rates are calculated at checkout based on your location, and we ensure that your shoes are carefully packaged and shipped directly to you.</p>
        </div>
    </section>
    <footer>
        <div class="footer-row">
            <div class="footer-section">
                <h2>Shortcuts</h2>
                <a href="landing.php">Home</a>
                <a href="product.php">Products</a>
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
            <p>&copy; 2024 UrbanSteps. <br>All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
