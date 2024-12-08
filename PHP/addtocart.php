<?php
include 'session_check.php'; // Include session check

// Check if the required parameters are set via GET request
if (isset($_GET['name']) && isset($_GET['price']) && isset($_GET['image'])) {
    $name = htmlspecialchars($_GET['name']);
    $price = (float) htmlspecialchars($_GET['price']);
    $image = htmlspecialchars(urldecode($_GET['image']));
} else {
    // Default values in case parameters are not provided
    $name = "Product Name";
    $price = 0.00;
    $image = ""; // Default image if not provided
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Order Page</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/addtocart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<style>
    .order-button2 {
    background-color: red;
    color: white;
    padding: 7px 180px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s; 
    margin-top: 5%;
    align-items: center;
    justify-content: center;
    display: flex;
    flex-direction: row;
    font-family: 'PT Sans Narrow', sans-serif;
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

    <form class="form" method="POST" action="cart.php" onsubmit="return validateForm()"> <!-- Submit to cart.php -->
    <div class="order-container">
            <div class="product-image">
                <img src="<?php echo $image; ?>" alt="<?php echo $name; ?> Image" />
            </div>
            <div class="product-details">
                <h1><?php echo $name; ?></h1>
                <p class="product-description">Stylish, fast, convenient.</p>

                <h2>Choose Color</h2>
                <div class="color-options">
                    <div class="color-option" style="background-color: black;" onclick="selectColor(this, 'Black')"></div>
                    <div class="color-option" style="background-color: white;" onclick="selectColor(this, 'White')"></div>
                    <div class="color-option" style="background-color: red;" onclick="selectColor(this, 'Red')"></div>
                </div>

                <h2>Choose Size</h2>
                <div class="size-options">
                    <button type="button" class="size-option" onclick="selectSize(this, '6')">6</button>
                    <button type="button" class="size-option" onclick="selectSize(this, '7')">7</button>
                    <button type="button" class="size-option" onclick="selectSize(this, '8')">8</button>
                    <button type="button" class="size-option" onclick="selectSize(this, '9')">9</button>
                    <button type="button" class="size-option" onclick="selectSize(this, '10')">10</button>
                </div>

                <div class="qty">
                    <h2>Quantity:</h2>
                    <input type="number" value="1" min="1" name="quantity" id="quantityInput" class="quantity-input" onchange="updateTotalPrice()" required>
                </div>

                <h2>Price: $<span id="price"><?php echo number_format($price, 2); ?></span></h2>
                <h2>Total Price: $<span id="totalPrice"><?php echo number_format($price, 2); ?></span></h2>
                
                <input type="hidden" name="name" id="productName" value="<?php echo $name; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
                <input type="hidden" name="image" value="<?php echo $image; ?>">
                <input type="hidden" name="size" id="selectedSize">
                <input type="hidden" name="color" id="selectedColor">

                <div>
                    <button type="submit" class="order-button2">Add to Cart</button> <!-- Submit form to cart.php -->
                    <button type="button" class="order-button1" onclick="window.location.href='../PHP/product.php'">Cancel</button>
                </div>
            </div>
    </div>
    </form>

    <footer>
        <div class="footer-row">
            <div class="footer-section">
                <h2>Shortcuts</h2>
                <a href="landing.html">Home</a>
                <a href="product.html">Products</a>
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

    <script>
        let selectedSize = null;
        let selectedColor = null;

        function selectSize(button, size) {
            const sizeButtons = document.querySelectorAll('.size-option');
            sizeButtons.forEach(btn => btn.classList.remove('selected'));
            button.classList.add('selected');
            selectedSize = size;
            document.getElementById('selectedSize').value = size; // Set the hidden size input
        }

        function selectColor(element, color) {
            const colorOptions = document.querySelectorAll('.color-option');
            colorOptions.forEach(option => option.classList.remove('selected'));
            element.classList.add('selected');
            selectedColor = color;
            document.getElementById('selectedColor').value = color; // Set the hidden color input
        }

        function updateTotalPrice() {
            const quantity = document.getElementById('quantityInput').value;
            const price = <?php echo $price; ?>; // Get price from PHP
            const totalPrice = price * quantity;
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
        }

        function validateForm() {
        // Check if size and color are selected
        if (!selectedSize || !selectedColor) {
            alert("Please select both a color and a size.");
            return false; // Prevent form submission
        }
        return true; // Allow form submission
    }
    </script>
</body>
</html>
