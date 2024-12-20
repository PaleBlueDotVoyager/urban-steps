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
    <title>UrbanSteps</title>
    <link rel="stylesheet" href="../CSS/contact.css">
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/footer.css">
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <!--ICONS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
    <style>
        /* General reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: #F5F7F8;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #F6F5F2;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        header h1 {
            margin: 0;
            font-size: 2em;
            color: #181C14;
        }

        header a {
            text-decoration: none;
            color: #181C14;
        }

        nav {
            flex-grow: 1;
            text-align: center;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav a {
            color: #181C14;
            text-decoration: none;
        }

        .user-menu {
            display: flex;
            align-items: center;
        }

        .user-menu .btn1 {
            background: none;
            color: #181C14;
            border: none;
            cursor: pointer;
            font-family: 'PT Sans Narrow', sans-serif;
        }

        .contact {
            margin-top: 5%;
            padding: 60px 20px;
            text-align: center;
            background-color: #E9EFEC;
        }

        .contact h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #181C14;
        }

        .contact p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #697565;
        }

        .contact ul {
            list-style: none;
            padding: 0;
        }

        .contact ul li {
            margin: 15px 0;
            font-size: 1.2em;
        }

        .contact a {
            color: #295F98;
            text-decoration: none;
        }

        .contact a:hover {
            text-decoration: underline;
        }

        footer {
            background-color: #F6F5F2;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.3);
        }

        .footer-bottom p {
            font-size: 14px;
            color: #697565;
        }

        /* Responsive Design for Smaller Screens */
        @media (max-width: 768px) {
            header {
                flex-direction: column;
                align-items: flex-start;
            }

            nav ul {
                flex-direction: column;
            }

            .contact {
                padding: 40px 10px;
            }
        }
    </style>
<body>
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

<section class="contact">
    <div class="container">
        <h2>Contact Us</h2>
        <center><p>Got questions or need assistance? Reach out to us at:</p></center>
        <ul>
            <li>Email: <a href="mailto:urbansteps@gmail.com">urbansteps@gmail.com</a></li>
            <li>Phone: 0912-345-6789</li>
            <li>Follow us on social media: 
                <a href="https://facebook.com">Facebook</a>, 
                <a href="https://instagram.com">Instagram</a>, 
                <a href="https://twitter.com">Twitter</a>
            </li>
        </ul>
    </div>
</section>

<footer>
    <div class="footer-row">
        <div class="footer-section">
            <h2>Shortcuts</h2>
            <a href="landing_no_acc.html">Home</a>
            <a href="product_no_acc.html">Products</a>
            <a href="contact.html">Contact</a>
        </div>
        <div class="footer-section">
            <h2>About Us</h2>
            <p>Learn more about our story, mission, and values.</p>
            <a href="about.html">Read More</a>
        </div>
        <div class="footer-section">
            <h2>Contact Info</h2>
            <p>Email: urbansteps@gmail.com</p>
            <p>Phone: 09123456789
            <p>Address: Fatima Ave, corner MacArthur Hwy, Valenzuela, 1440 Metro Manila </p>
            </p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 UrbanSteps. <br>All rights reserved.</p>
    </div>
</footer>

</body>
</html>
