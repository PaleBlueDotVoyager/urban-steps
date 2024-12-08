<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

// Database connection details (for user info only)
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
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve user information
$username = $_SESSION['user'];
$sql = "SELECT * FROM account WHERE username = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $username);
$stmt->execute();

// Bind result variables
$stmt->bind_result($user_id, $db_username, $db_password, $db_email, $db_phone, $db_address);
$stmt->fetch();

// Store user info in array
$user = array(
    'username' => $db_username,
    'email' => $db_email,
    'phone_number' => $db_phone,
    'address' => $db_address
);

$stmt->close();
$conn->close();

// Check if there are selected orders in the session
if (!isset($_SESSION['selected_orders_to_print']) || empty($_SESSION['selected_orders_to_print'])) {
    echo '<p>No orders to print.</p>';
    exit;
}

// Get all orders from session
$all_orders = isset($_SESSION['orders']) ? $_SESSION['orders'] : array();
$selected_indices = $_SESSION['selected_orders_to_print'];
$orders = array();
$total_amount = 0;

// Get only selected orders
foreach ($selected_indices as $index) {
    if (isset($all_orders[$index])) {
        $orders[] = $all_orders[$index];
        $total_amount += isset($all_orders[$index]['total_price']) ? 
            $all_orders[$index]['total_price'] : 
            ($all_orders[$index]['price'] * $all_orders[$index]['quantity']);
    }
}

// Function to safely output data
function safeOutput($data) {
    return htmlspecialchars($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Receipt</title>
    <link rel="stylesheet" href="../CSS/receipt.css">
</head>
<style>
    .img1 {
        height: 60px;
        margin-bottom: -1%;
    }
</style>
<body>
    <h1>
        <img class="img1" src="../images/logobg.png">
        Official Receipt from UrbanSteps</h1>
    <h2>Customer's Information</h2>
    <p>Name: <?php echo safeOutput($user['username']); ?></p>
    <p>Email: <?php echo safeOutput($user['email']); ?></p>
    <p>Phone: <?php echo safeOutput($user['phone_number']); ?></p>
    <p>Address: <?php echo safeOutput($user['address']); ?></p>

    <h2>Order Details</h2>
    <table>
        <tr>
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Size</th>
            <th>Color</th>
            <th>Quantity</th>
            <th>Price per Item</th>
            <th>Total Price</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td>
                <img src="<?php echo safeOutput(isset($order['image']) ? $order['image'] : ''); ?>" 
                     alt="Product Image" 
                     style="width: 50px; height: auto;">
            </td>
            <td><?php echo safeOutput(isset($order['product']) ? $order['product'] : (isset($order['name']) ? $order['name'] : 'N/A')); ?></td>
            <td><?php echo safeOutput(isset($order['size']) ? $order['size'] : 'N/A'); ?></td>
            <td><?php echo safeOutput(isset($order['color']) ? $order['color'] : 'N/A'); ?></td>
            <td><?php echo safeOutput(isset($order['quantity']) ? $order['quantity'] : 'N/A'); ?></td>
            <td>$<?php echo safeOutput(number_format(isset($order['price_per_item']) ? $order['price_per_item'] : (isset($order['price']) ? $order['price'] : 0), 2)); ?></td>
            <td>$<?php echo safeOutput(number_format(isset($order['total_price']) ? $order['total_price'] : (isset($order['price']) ? $order['price'] * $order['quantity'] : 0), 2)); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <h3>Total Amount: $<?php echo safeOutput(number_format($total_amount, 2)); ?></h3>
    <div class="btn no-print">
    <div class="btn1">
        <button onclick="window.print();">Print Receipt</button>
    </div>
    <div>
        <button class="btn2">
            <a class="back" href="../PHP/history.php">Go Back</a>
        </button>
    </div>
</div>

<style>
    .img1 {
        height: 60px;
        margin-bottom: -1%;
    }
    
    @media print {
        .no-print {
            display: none !important;
        }
        body {
            font-size: 12pt;
        }
        table {
            page-break-inside: avoid;
        }
        img {
            max-width: 100% !important;
        }
        * {
            background-image: none !important;
            background-color: white !important;
            color: black !important;
        }
    }
</style>
</body>
</html>