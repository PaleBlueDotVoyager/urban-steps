<?php
include 'session_check.php';

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to login page if not logged in
    header('Location: login.html'); 
    exit();
}

// User is logged in, you can access user information
$username = $_SESSION['user']['username']; // Access the username

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get product details from POST request
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $size = htmlspecialchars($_POST['size']);
    $color = htmlspecialchars($_POST['color']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $image = htmlspecialchars($_POST['image']); // Assuming the image is sent in POST

    // Create a cart entry
    $cartEntry = array(
        'name' => $name,
        'price' => $price,
        'size' => $size,
        'color' => $color,
        'quantity' => $quantity,
        'image' => $image // Add image to the cart entry
    );

    // Store cart entry in session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Initialize cart if it doesn't exist
    }
    $_SESSION['cart'][] = $cartEntry; // Add item to cart

    // Redirect to the same page to display the added product
    header("Location: add_to_cart.php?added=true&name=" . urlencode($name) . "&price=" . urlencode($price) . "&size=" . urlencode($size) . "&color=" . urlencode($color) . "&quantity=" . urlencode($quantity) . "&image=" . urlencode($image));
    exit();
}

// Check if the product was added
$added = isset($_GET['added']);
$name = isset($_GET['name']) ? $_GET['name'] : '';
$price = isset($_GET['price']) ? $_GET['price'] : '';
$size = isset($_GET['size']) ? $_GET['size'] : '';
$color = isset($_GET['color']) ? $_GET['color'] : '';
$quantity = isset($_GET['quantity']) ? $_GET['quantity'] : '';
$image = isset($_GET['image']) ? $_GET['image'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Added to Cart</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/addtocart.css">
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
                <li><a href="../landing.html">Home</a></li>
                <li><a href="../product.html">Products</a></li>
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
                <button class="btn1" onclick="location.href='landing_no_acc.html'">
                    <i class="fas fa-sign-out-alt" style="color: #181C14;"></i>
                </button>
            </div>
        </div>
    </header>

    <div class="order-container">
        <div class="product-image">
            <?php if ($added): ?>
                <img id="product-img" src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>">
            <?php else: ?>
                <p>No product added to cart.</p>
            <?php endif; ?>
        </div>
        <div class="product-details">
            <?php if ($added): ?>
                <h1 id="product-name"><?php echo htmlspecialchars($name); ?></h1>
                <p class="product-description">Stylish, fast, convenient.</p>
                <h2>Size: <?php echo htmlspecialchars($size); ?></h2>
                <h2>Color: <?php echo htmlspecialchars($color); ?></h2>
                <h2>Quantity: <?php echo htmlspecialchars($quantity); ?></h2>
                <h2>Total Price: $<?php echo htmlspecialchars($price * $quantity); ?></h2>
                <div class="buttons">
                    <button onclick="window.location.href='../product.html'">Continue Shopping</button>
                    <button onclick="window.location.href='../PHP/cart.php'">View Cart</button>
                </div>
            <?php else: ?>
                <p>No product added to cart.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <div class="footer-row">
            <div class="footer-section">
                <h2>Shortcuts</h2>
                <a href="../landing.html">Home</a>
                <a href="../product.html">Products</a>
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
