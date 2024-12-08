<?php
session_start(); // Start the session

// Retrieve the posted data
$price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;
$total_price = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0;

// Here you would add your payment processing logic
// For example, integrating with a payment gateway

// Debugging: Check the values received
echo "<pre>";
echo "Processing Payment...\n";
echo "Price: $price\n";
echo "Quantity: $quantity\n";
echo "Total Price: $total_price\n";
echo "</pre>";

// After processing, redirect or display a success message
?>