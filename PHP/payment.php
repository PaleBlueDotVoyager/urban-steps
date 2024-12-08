<?php
session_start(); // Start the session
if (!isset($_SESSION['user'])) {
    header('Location: login.html'); // Redirect to login if not logged in
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanSteps</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    
    <!--FONTS-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <!--ICONS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .summary-page { padding: 20px; }
        .section { margin-bottom: 20px; }
        .section-title { font-size: 1.5em; font-weight: bold; margin-bottom: 10px; }
        .user-info, .cart-summary, .payment-info { background-color: #181C14; color: white; padding: 20px; border-radius: 8px; }
        .cart-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #ccc; }
        .cart-item img { width: 100px; height: auto; }
        .summary-button { background-color: #000; color: #fff; padding: 15px 20px; border: none; cursor: pointer; font-size: 1em; border-radius: 5px; display: block; width: 100%; text-align: center; }
        .summary-button:hover { background-color: #444; }
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

    <div class="main">
        <div class="nav">
            <div class="nav-part-1">
                <img src="Logo.png" alt="logo" style="height: 150px; width: 150px;">
                <ul>
                    <li><a href="Landing.php">Home</a></li>
                    <li><a href="collection.html">Collection</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="nav-part-2">
                <a href="profile.php"><i class="ri-user-line"></i></a>
                <a href="cart.html"><i class="ri-shopping-cart-2-line"></i></a>
                <a href="menu.html"><i class="ri-menu-line" id="menu-icon"></i></a>
            </div>            
        </div>

        <div class="summary-page">
            <h1>Order Summary</h1>

            <!-- User Information -->
            <div class="user-info section">
                <div class="section-title">Your Information</div>
                <p><strong>Username:</strong> <?php echo isset($user['username']) ? htmlspecialchars($user['username']) : 'Not provided'; ?></p>
                <p><strong>Email:</strong> <?php echo isset($user['email']) ? htmlspecialchars($user['email']) : 'Not provided'; ?></p>
                <p><strong>Phone Number:</strong> <?php echo isset($user['phone']) ? htmlspecialchars($user['phone']) : 'Not provided'; ?></p>
                <p><strong>Address:</strong> <?php echo isset($user['address']) ? htmlspecialchars($user['address']) : 'Not provided'; ?></p>
            </div>

            <!-- Cart Summary -->
            <div class="cart-summary section">
                <div class="section-title">Your Cart</div>
                <div id="cartItems">
                    <!-- Items from cart will be dynamically inserted here -->
                </div>
                <div id="emptyMessage" class="empty-cart"></div>
            </div>

            <!-- Payment Method -->
            <div class="payment-info section">
                <div class="section-title">Payment Method</div>
                <p id="paymentMethod">Not selected</p>
            </div>

            <button class="summary-button" onclick="confirmOrder()">Confirm Order</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select elements
            const cartItemsContainer = document.getElementById('cartItems');
            const emptyMessage = document.getElementById('emptyMessage');
            const paymentMethodElement = document.getElementById('paymentMethod');

            // Get cart and payment method from localStorage
            let cart = JSON.parse(localStorage.getItem('cartItems')) || [];
            let selectedPaymentMethod = localStorage.getItem('selectedPaymentMethod');

            // Render the cart items
            function renderCart() {
                cartItemsContainer.innerHTML = '';  // Clear cart container
                if (cart.length === 0) {
                    emptyMessage.textContent = 'Your cart is empty.';
                    return;
                }
                emptyMessage.textContent = '';
                cart.forEach((item) => {
                    const itemElement = document.createElement('div');
                    itemElement.className = 'cart-item';
                    itemElement.innerHTML = `
                        <img src="${item.image}" alt="${item.name}">
                        <div>
                            <h3>${item.name}</h3>
                            <p><strong>Size:</strong> ${item.size}</p>
                            <p><strong>Category:</strong> ${item.category === 'men' ? "Men's Shoes" : "Women's Shoes"}</p>
                            <p><strong>Price:</strong> ₱${(item.price || 0).toFixed(2)}</p>
                        </div>
                    `;
                    cartItemsContainer.appendChild(itemElement);
                });
            }

            // Render payment method
            function renderPaymentMethod() {
                paymentMethodElement.textContent = selectedPaymentMethod ? selectedPaymentMethod : 'Not selected';
            }

            // Confirm order action
            function confirmOrder() {
                if (cart.length === 0) {
                    alert('Your cart is empty. Please add items before confirming.');
                    return;
                }
                // Proceed to success page
                window.location.href = 'success.php';
            }

            // Load and display the data
            renderCart();
            renderPaymentMethod();

            // Attach confirm order function globally
            window.confirmOrder = confirmOrder;
        });
    </script>
</body>
</html>