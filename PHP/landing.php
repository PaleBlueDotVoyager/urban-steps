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
    <title>Shoe Store</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <!--ICONS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <header>
        <h1><a href="#">UrbanSteps</a></h1>
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

    <section id="hero">
        <h2>Find Your Perfect Pair</h2>
        <p>Explore our collection of stylish and comfortable shoes.</p>
        <a href="product.php" class="btn2">Shop Now</a>
    </section>

    <section id="products">
        <div>
            <h2>OUR PRODUCTS</h2>
            <div class="product">
                <img src="../images/n2.png" alt="Stylish Sneakers">
                <h3>NIKE</h3>
                <a href="../PHP/product.php" class="btn">View Products</a>
            </div>
            <div class="product">
                <img src="../images/nb1.png" alt="Classic Boots">
                <h3>NEW BALANCE</h3>
                <a href="../PHP/product.php" class="btn">View Products</a>
            </div>
            <div class="product">
                <img src="../images/con3.png" alt="Running Shoes">
                <h3>CONVERSE</h3>
                <a href="../PHP/product.php" class="btn">View Products</a>
            </div>
        </div>
        <div>
            <div class="product">
                <img src="../images/adidas1.png" alt="Stylish Sneakers">
                <h3>ADIDAS</h3>
                <a href="../PHP/product.php" class="btn">View Products</a>
            </div>
            <div class="product">
                <img src="../images/puma1.png" alt="Classic Boots">
                <h3>PUMA</h3>
                <a href="../PHP/product.php" class="btn">View Products</a>
            </div>
            <div class="product">
                <img src="../images/skechers3.png" alt="Running Shoes">
                <h3>SKECHERS</h3>
                <a href="../PHP/product.php" class="btn">View Products</a>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-row">
            <div class="footer-section">
                <h2>Shortcuts</h2>
                <a href="landing.php">Home</a>
                <a href="product.php">Products</a>
                <a href="contact.php">Contact</a>
            </div>
            <div class="footer-section">
                <h2>About Us</h2>
                <p>Learn more about our story, mission, and values.</p>
                <a href="about.php">Read More</a>
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
