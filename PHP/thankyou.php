<?php
session_start();

// Check if the payment details are stored in the session
if (!isset($_SESSION['payment_details'])) {
    header('Location: login.html'); // Redirect to home if no payment details found
    exit;
}

$payment_details = $_SESSION['payment_details'];
unset($_SESSION['payment_details']); // Clear payment details after showing thank you message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/thankyou.css"> <!-- Add a CSS file for thank you page -->
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

<div class="thank-you-page">
    <h1>Thank You for Your Purchase!</h1>
    <p>We have received your order and will process it soon.</p>
    <p><strong>Order Summary:</strong></p>
    <ul>
        <li><strong>Price:</strong> $<?php echo number_format($payment_details['price'], 2); ?></li>
        <li><strong>Quantity:</strong> <?php echo $payment_details['quantity']; ?></li>
        <li><strong>Total Price:</strong> $<?php echo number_format($payment_details['total_price'], 2); ?></li>
        <li><strong>Payment Method:</strong> <?php echo $payment_details['payment_method']; ?></li>
        <?php
            if ($payment_details['payment_method'] == 'GCash') {
                echo "<li><strong>GCash Number:</strong> " . $payment_details['gcash_number'] . "</li>";
            } elseif ($payment_details['payment_method'] == 'Credit Card') {
                echo "<li><strong>Card Number:</strong> " . $payment_details['card_number'] . "</li>";
            } elseif ($payment_details['payment_method'] == 'PayPal') {
                echo "<li><strong>PayPal Email:</strong> " . $payment_details['paypal_email'] . "</li>";
            }
        ?>
    </ul>
    <button onclick="window.location.href='history.php'">Return to Order History</button>
</div>

</body>
</html>
