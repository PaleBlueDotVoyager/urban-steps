<?php
session_start(); // Start the session
if (!isset($_SESSION['user'])) {
    header('Location: login.html'); // Redirect to login if not logged in
    exit;
}

$user = $_SESSION['user'];

// Retrieve price, quantity, and total price from query parameters
$price = isset($_GET['price']) ? floatval($_GET['price']) : 0;
$quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 0;

// Calculate total price
$total_price = $price * $quantity; // Total price calculation

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Store payment details in session
    $_SESSION['payment_details'] = array(
        'price' => $price,
        'quantity' => $quantity,
        'total_price' => $total_price,
        'payment_method' => $_POST['payment_method'], // Store selected payment method
    );

    // Capture additional payment details based on the selected method
    if ($_POST['payment_method'] == 'GCash') {
        $_SESSION['payment_details']['gcash_number'] = $_POST['gcash_number'];
    } elseif ($_POST['payment_method'] == 'Credit Card') {
        $_SESSION['payment_details']['card_number'] = $_POST['card_number'];
    } elseif ($_POST['payment_method'] == 'PayPal') {
        $_SESSION['payment_details']['paypal_email'] = $_POST['paypal_email'];
    }

    // Redirect to thankyou.php after processing payment
header('Location: thankyou.php');
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Payment</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/addtocart.css">
    <link rel="stylesheet" href="../CSS/history.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .payment-page {
            max-width: 600px;
            margin: 5% auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 20px;
            margin-bottom: 10px;
            color: #181C14;
        }

        .payment-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        #paymentDetails {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .summary-button {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text color */
            padding: 15px 20px; /* Padding for the button */
            border: none; /* No border */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size */
            border-radius: 5px; /* Rounded corners */
            display: block; /* Display as block */
            width: 100%; /* Full width */
            transition: background-color 0.3s; /* Smooth transition for background color */
            margin-top: 20px;
        }

        .summary-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .order-button1 {
            background-color: #f44336; /* Red background */
            color: white; /* White text color */
            padding: 10px 15px; /* Padding for the button */
            border: none; /* No border */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Font size */
            border-radius: 5px; /* Rounded corners */
            display: inline-block; /* Display as inline-block */
            margin-top: 10px;
            text-align: center;
            text-decoration: none; /* Remove underline from link */
        }

        .order-button1:hover {
            background-color: #d32f2f; /* Darker red on hover */
        }
    </style>
    <script>
        function showPaymentFields(method) {
            const paymentDetailsDiv = document.getElementById('paymentDetails');
            paymentDetailsDiv.innerHTML = ''; // Clear previous details

            if (method === 'GCash') {
                paymentDetailsDiv.innerHTML = ` 
                    <h4>GCash Details:</h4>
                    <label for="gcash_number">GCash Number:</label>
                    <input type="text" name="gcash_number" required>
                `;
            } else if (method === 'Credit Card') {
                paymentDetailsDiv.innerHTML = ` 
                    <h4>Credit Card Details:</h4>
                    <label for="card_number">Card Number:</label>
                    <input type="text" name="card_number" required>
                `;
            } else if (method === 'PayPal') {
                paymentDetailsDiv.innerHTML = ` 
                    <h4>PayPal Details:</h4>
                    <label for="paypal_email">PayPal Email:</label>
                    <input type="email" name="paypal_email" required>
                `;
            }
        }
    </script>
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

<div class="payment-page">
    <h1>Payment Information</h1>
    <div class="payment-info section">
        <div class="section-title">Order Summary</div>
        <p><strong>Price:</strong> $<?php echo number_format($price, 2); ?></p>
        <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
        <p><strong>Total Price:</strong> $<?php echo number_format($total_price, 2); ?></p> <!-- Display total price -->
    </div>

    <form method="POST" onsubmit="return validateOrder()">
        <h3>Choose Payment Method:</h3>
        <label>
            <input type="radio" name="payment_method" value="GCash" onclick="showPaymentFields('GCash')" required> GCash
        </label>
        <label>
            <input type="radio" name="payment_method" value="Credit Card" onclick="showPaymentFields('Credit Card')" required> Credit Card
        </label>
        <label>
            <input type="radio" name="payment_method" value="PayPal" onclick="showPaymentFields('PayPal')" required> PayPal
        </label>

        <!-- Payment Details Section (hidden initially) -->
        <div id="paymentDetails"></div>

        <button class="summary-button" type="submit">
            Pay Now
        </button>
        <button type="button" class="order-button1" onclick="window.location.href='../PHP/history.php'">Cancel</button>
    </form>
</div>

</body>
</html>
