<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.html'); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['user']['username'];
$cartFile = 'cart_data.txt';
$cartItems = array();

if (file_exists($cartFile)) {
    $cartItems = unserialize(file_get_contents($cartFile));
    if (!is_array($cartItems)) {
        $cartItems = array(); // Ensure it's an array
    }
}

// Handle adding new items from addtocart.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['price'], $_POST['size'], $_POST['color'], $_POST['quantity'], $_POST['image'])) {
    $newItem = array(
        'name' => htmlspecialchars($_POST['name']),
        'price' => (float)$_POST['price'],
        'size' => htmlspecialchars($_POST['size']),
        'color' => htmlspecialchars($_POST['color']),
        'quantity' => (int)$_POST['quantity'],
        'image' => htmlspecialchars($_POST['image'])
    );

    $cartItems[] = $newItem;
    file_put_contents($cartFile, serialize($cartItems));
    header('Location: cart.php');
    exit();
}

// Handle removal of items
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    if (isset($_POST['selected_items'])) {
        foreach ($_POST['selected_items'] as $index) {
            unset($cartItems[$index]);
        }
        $cartItems = array_values($cartItems);
        file_put_contents($cartFile, serialize($cartItems));
    }
}

// Handle checkout process
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    if (isset($_POST['selected_items'])) {
        $checkoutItems = array();
        $total_price = 0;

        foreach ($_POST['selected_items'] as $index) {
            if (isset($cartItems[$index])) {
                $checkoutItems[] = $cartItems[$index];
                $total_price += $cartItems[$index]['price'] * $cartItems[$index]['quantity'];
            }
        }

        // Store checkout items in session
        $_SESSION['orders'] = $checkoutItems; // Store selected items in session
        $_SESSION['total_price'] = $total_price; // Store total price in session

        // Redirect to history.php
        header('Location: history.php');
        exit();
    }
}

// Calculate total price for all cart items
$totalCartPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Your Cart</title>
    <link rel="stylesheet" href="../CSS/cart.css">
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        #cart {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            font-family: 'PT Sans Narrow', sans-serif; /* Ensure the font is consistent */
        }

        #cart h2 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #333;
            text-align: center; /* Center the title */
        }

        #cart p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #666;
            text-align: center; /* Center the welcome message */
        }

        #cart ul {
            list-style-type: none;
            padding: 0;
        }

        #cart li {
            background-color: #fff;
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex; /* Flexbox for layout */
            align-items: center; /* Center items vertically */
        }

        #cart li:hover {
            transform: translateY(-2px);
        }

        #cart img {
            margin-right: 15px; /* Space between image and text */
            border-radius: 5px;
            max-width: 100px; /* Limit the size of the image */
            height: auto;
        }

        .order-button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block; /* Stack buttons vertically */
            margin: 10px auto; /* Center buttons */
            width: 200px; /* Fixed width for buttons */
        }

        .order-button1 {
            background-color: red; /* Green */
            color: white;
            padding: 7px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block; /* Stack buttons vertically */
            margin-bottom: 1%; /* Center buttons */
            margin-top: 5%;
            width: 100px; /* Fixed width for buttons */
        }

        .order-button2 {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 7px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block; /* Stack buttons vertically */
            width: 100px; /* Fixed width for buttons */
        }

        .order-button:hover {
            background-color: #45a049; /* Darker green */
        }

        .order-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        h3 {
            text-align: center; /* Center total price */
            font-size: 20px;
            color: #333;
        }
        .cart-row {
            display: flex;
            flex-direction: row;
            display: flex; /* Flexbox for layout */
            justify-content: space-between; /* Space between items */
            align-items: center;
        }
        .cart-btn {
            display: flex; /* Use flexbox to align buttons */
            flex-direction: row;
            margin-bottom: -5%;
            margin-left: 15%;
        }
        .cart-btn button {
            display: flex;
            flex-direction: row;
            margin-bottom: -5%;
        }
        .cart-details {
            display: flex; /* Use flexbox for layout */
            flex-direction: row; /* Align items in a row */
            gap: 20px; /* Space between items */
            align-items: center; /* Center items vertically */
        }

        .cart-details div {
            display: flex; /* Allows each item to be a block */
            flex-direction: column; /* Stack text items vertically */
        }
        .bt {
            display: flex;
            flex-direction: row;
        }

        .back {
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            background-color: #777;
            padding: 5px;
            margin-right: 45%;
            margin-left: 45%;
            border-radius: 5px;
            font-family: "PT Sans Narrow", sans-serif;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
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

    <section id="cart">
        <h2>Your Shopping Cart</h2>
        <?php if (empty($cartItems)): ?>
            <p>Your cart is empty!</p>
            <a class="back" href="../PHP/product.php">Go Back</a>
        <?php else: ?>
            <form action="cart.php" method="POST">
                <ul>
                <?php foreach ($cartItems as $index => $item): ?>
                    <li>
                        <input type="checkbox" name="selected_items[]" value="<?php echo $index; ?>" style="margin-right: 10px;">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 100px; height: auto; margin-right: 15px;">
                        <div class="cart-row">   
                            <div class="name">
                                <strong><?php echo htmlspecialchars($item['name']); ?></strong><br> <!-- Shoe name on top -->
                                <div class="cart-row">   
                            <div>
                                <div class="cart-details">
                                    Size: <?php echo htmlspecialchars($item['size']); ?><br>
                                    Color: <?php echo htmlspecialchars($item['color']); ?><br>
                                    Price: $<?php echo number_format($item['price'], 2); ?><br>
                                    Quantity: <?php echo $item['quantity']; ?><br>
                                    Total: $<?php echo number_format($item['price'] * $item['quantity'], 2); ?><br>
                                </div>
                            </div>
                                </div>

                            </div> 
                </li>
                <?php endforeach; ?>
                </ul>
                <h3>Total Price: $<?php echo number_format($totalPrice, 2); ?></h3>

                <!-- Remove and Checkout buttons -->
                 <div class="bt">
                    <button type="submit" name="remove" class="order-button">Remove Selected</button>
                    <button type="submit" name="checkout" class="order-button">Checkout Selected</button>
                 </div>
            </form>
        <?php endif; ?>
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
