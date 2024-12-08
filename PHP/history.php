<?php
session_start(); // Start the session
if (!isset($_SESSION['user'])) {
    header('Location: login.html'); // Redirect to login if not logged in
    exit;
}

$user = $_SESSION['user']; // Retrieve the logged-in user

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve orders from the session or initialize as an empty array
$orders = isset($_SESSION['orders']) && is_array($_SESSION['orders']) ? $_SESSION['orders'] : array();

// Function to safely output data
function safeOutput($data) {
    return htmlspecialchars($data);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_orders']) && is_array($_POST['selected_orders'])) {
        // Create an array to store indexes of canceled orders
        $canceled_indexes = array();
        $selected_orders_indices = array(); // Store indices of selected orders for printing

        // Loop through selected orders
        foreach ($_POST['selected_orders'] as $index) {
            $index = (int)$index; // Cast to integer for safety
            if (isset($orders[$index])) {
                if (isset($_POST['cancel_selected'])) {
                    $canceled_indexes[] = $index; // Store index of canceled order
                }
                if (isset($_POST['print_selected'])) {
                    $selected_orders_indices[] = $index; // Collect selected order indices for printing
                }
            }
        }

        // Cancel the selected orders
        foreach ($canceled_indexes as $index) {
            unset($orders[$index]); // Cancel the selected order
        }

        // Reindex the array if any orders were canceled
        if (!empty($canceled_indexes)) {
            $_SESSION['orders'] = array_values($orders); // Reindex orders after cancellation
            echo '<p>Selected orders have been canceled successfully.</p>'; // Success message
        }

        // Check if any valid orders are selected for printing
        if (!empty($selected_orders_indices)) {
            // Store selected orders indices in session for printing
            $_SESSION['selected_orders_to_print'] = $selected_orders_indices;

            // Redirect to print_receipt.php
            header('Location: print_receipt.php');
            exit;
        } else {
            echo 'No valid orders selected for printing.'; // No valid orders selected
        }
    }
}

// Process payment details if set
if (isset($_SESSION['payment_method']) && isset($_SESSION['payment_details'])) {
    $paymentMethod = safeOutput($_SESSION['payment_method']);
    $paymentDetails = safeOutput($_SESSION['payment_details']);
    $payButtonVisible = false; // Hide pay button once payment details are received
} else {
    $payButtonVisible = true; // Show pay button if payment details are not received
    $paymentMethod = '<a href="payment.php">Pay</a>'; // Pay button
    $paymentDetails = '<a href="payment.php">Pay</a>'; // Pay button
}

// Retrieve orders from the session or initialize as an empty array
$orders = isset($_SESSION['orders']) && is_array($_SESSION['orders']) ? $_SESSION['orders'] : array();
$total_price = isset($_SESSION['total_price']) ? $_SESSION['total_price'] : 0; // Get total price

$payment_details = isset($_SESSION['payment_details']) ? $_SESSION['payment_details'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Order History</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/addtocart.css">
    <link rel="stylesheet" href="../CSS/history.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .pay-button {
            background-color: #4CAF50; /* Green background */
            border: none; /* No border */
            color: white; /* White text color */
            padding: 3px 6px; /* Padding for the button */
            text-align: center; /* Center the text */
            text-decoration: none; /* Remove underline from link */
            display: inline-block; /* Display as inline-block */
            font-size: 14px; /* Font size */
            margin: 4px 2px; /* Margin around the button */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for background color */
        }

        .pay-button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .pay-button a {
            color: white; /* Ensure link text is white */
            text-decoration: none; /* Remove underline from link */
        }

        .payment-info {
            font-size: 16px;
            color: #333;
            margin-top: 10px;
        }

        table {
            margin-left: -1px;
        }

        /* Styling for the Cancel and Print buttons */
        .cancel-button, .print-button {
            background-color: #f44336; /* Red background for Cancel */
            border: none; /* No border */
            color: white; /* White text color */
            padding: 8px 16px; /* Padding for the button */
            text-align: center; /* Center the text */
            text-decoration: none; /* Remove underline from link */
            display: inline-block; /* Display as inline-block */
            font-size: 14px; /* Font size */
            margin: 4px 2px; /* Margin around the button */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for background color */
        }

        .cancel-button:hover {
            background-color: #e53935; /* Darker red on hover */
        }

        .print-button {
            background-color: #2196F3; /* Blue background for Print */
            border: none; /* No border */
            color: white; /* White text color */
            padding: 8px 16px; /* Padding for the button */
            text-align: center; /* Center the text */
            text-decoration: none; /* Remove underline from link */
            display: inline-block; /* Display as inline-block */
            font-size: 14px; /* Font size */
            margin: 4px 2px; /* Margin around the button */
            cursor: pointer; /* Pointer cursor on hover */
            border-radius: 5px; /* Rounded corners */
            transition: background-color 0.3s; /* Smooth transition for background color */
        }

        .print-button:hover {
            background-color: #1e88e5; /* Darker blue on hover */
        }

        /* Button Styles */
button[type="submit"] {
    margin-top: 3%;
    background-color: #4CAF50; /* Green background for the Print button */
    color: white; /* White text color */
    padding: 5px 10px; /* Further reduced padding for smaller buttons */
    border: none; /* No border */
    border-radius: 3px; /* Smaller rounded corners */
    font-size: 12px; /* Smaller font size */
    cursor: pointer; /* Pointer cursor on hover */
    margin: 0 3px; /* Reduced margin between buttons */
    transition: background-color 0.3s, transform 0.2s; /* Smooth transition for background color and scale */
}

button[name="cancel_selected"] {
    margin-top: 3%;
    background-color: #f44336; /* Red background for the Cancel button */
}

button[type="submit"]:hover {
    background-color: #45a049; /* Darker green on hover for Print button */
}

button[name="cancel_selected"]:hover {
    background-color: #e53935; /* Darker red on hover for Cancel button */
}

button[type="submit"]:active {
    transform: scale(0.95); /* Slightly shrink the button on click */
}

    </style>
    <script>
        function toggleSelectAll(source) {
            const checkboxes = document.querySelectorAll('input[name="selected_orders[]"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = source.checked;
            });
        }
    </script>
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

<div class="order-container">
    <h2>Order Summary</h2>
    <?php if (empty($orders)): ?>
        <p>No orders found.</p>
    <?php else: ?>
        <form method="POST" action="">
            <table>
                <tr>
                    <th>
                        <input type="checkbox" onclick="toggleSelectAll(this)"> Select
                    </th>
                    <th>Product</th>
                    <th>Brand</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Price per Item</th>
                    <th>Total Price</th>
                </tr>
                <?php foreach ($orders as $index => $order): ?>
    <tr>
        <td><input type="checkbox" name="selected_orders[]" value="<?php echo $index; ?>"></td>
        <td><img src="<?php echo safeOutput(isset($order['image']) ? $order['image'] : ''); ?>" 
                 alt="<?php echo safeOutput(isset($order['name']) ? $order['name'] : ''); ?>" 
                 style="width: 50px; height: auto;">
        </td>
        <td><?php echo safeOutput(isset($order['product']) ? $order['product'] : (isset($order['name']) ? $order['name'] : 'N/A')); ?></td>
        <td><?php echo safeOutput(isset($order['size']) ? $order['size'] : 'N/A'); ?></td>
        <td><?php echo safeOutput(isset($order['color']) ? $order['color'] : 'N/A'); ?></td>
        <td><?php echo safeOutput(isset($order['quantity']) ? $order['quantity'] : 'N/A'); ?></td>
        <td>$<?php echo safeOutput(number_format(isset($order['price']) ? $order['price'] : 0, 2)); ?></td>
        <td>
            <?php 
                // Display total price
                $totalPrice = isset($order['total_price']) ? $order['total_price'] : (isset($order['price']) && isset($order['quantity']) ? $order['price'] * $order['quantity'] : 0);
                echo '$' . number_format($totalPrice, 2); 
            ?>
        </td>
    </tr>
<?php endforeach; ?>

            </table>
            <br>

            <p><strong>Total Price: $<?php echo number_format($total_price, 2); ?></strong></p>

            <button type="submit" name="print_selected">Print Selected Orders</button>
            <button type="submit" name="cancel_selected">Cancel Selected Orders</button>
        </form>
    <?php endif; ?>
</div>
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
