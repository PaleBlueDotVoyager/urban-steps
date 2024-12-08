<?php
include 'session_check.php'; // Include the session check file

if (isset($_GET['name']) && isset($_GET['price']) && isset($_GET['image'])) {
    $name = htmlspecialchars($_GET['name']);
    $price = (float) htmlspecialchars($_GET['price']);
    $image = htmlspecialchars(urldecode($_GET['image'])); // Ensure correct decoding

    // Check if image file exists
    if (!file_exists($image)) {
        $image = 'path/to/placeholder-image.jpg'; // Fallback image
    }
} else {
    // Default values in case parameters are not provided
    $name = "Product Name";
    $price = 0.00;
    $image = 'path/to/placeholder-image.jpg'; // Fallback image
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store - Add to Cart</title>
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="stylesheet" href="../CSS/product.css">
    <link rel="stylesheet" href="CSS/add-to-cart.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../CSS/footer.css">
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

    <section id="brands">
        <h2>Select a Brand</h2>
        <div class="brand-nav">
            <div class="brand" onclick="showProducts('nike')">Nike</div>
            <div class="brand" onclick="showProducts('newbalance')">New Balance</div>
            <div class="brand" onclick="showProducts('converse')">Converse</div>
            <div class="brand" onclick="showProducts('adidas')">Adidas</div>
            <div class="brand" onclick="showProducts('puma')">Puma</div>
            <div class="brand" onclick="showProducts('skechers')">Skechers</div>
        </div>
    </section>

    <section id="products">
    <div id="nike" class="product-container" style="display:contents">
        <div class="product">
            <img src="../images/n1.png" alt="Nike Air Max">
            <h3>Nike Air Max</h3>
            <p class="price" data-price="150.00">$150.00</p>
            <a href="../PHP/addtocart.php?name=Nike%20Air%20Max&price=150.00&image=../images/n1.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Nike%20Air%20Max&price=150.00&image=../images/n1.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/n2.png" alt="Nike Zoom">
            <h3>Nike Zoom</h3>
            <p class="price" data-price="140.00">$140.00</p>
            <a href="../PHP/addtocart.php?name=Nike%20Zoom&price=140.00&image=../images/n2.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Nike%20Zoom&price=140.00&image=../images/n2.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/n3.png" alt="Nike Blazer">
            <h3>Nike Blazer</h3>
            <p class="price" data-price="130.00">$130.00</p>
            <a href="../PHP/addtocart.php?name=Nike%20Blazer&price=130.00&image=../images/n3.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Nike%20Blazer&price=130.00&image=../images/n3.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
    </div>

    <div id="newbalance" class="product-container" style="display:none;">
        <div class="product">
            <img src="../images/nb1.png" alt="New Balance 990">
            <h3>New Balance 990</h3>
            <p class="price" data-price="180.00">$180.00</p>
            <a href="../PHP/addtocart.php?name=New%20Balance%20990&price=180.00&image=../images/nb1.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=New%20Balance%20990&price=180.00&image=../images/nb1.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/nb2.png" alt="New Balance 574">
            <h3>New Balance 574</h3>
            <p class="price" data-price="110.00">$110.00</p>
            <a href="../PHP/addtocart.php?name=New%20Balance%20574&price=110.00&image=../images/nb2.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=New%20Balance%20574&price=110.00&image=../images/nb2.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/nb3.png" alt="New Balance 860">
            <h3>New Balance 860</h3>
            <p class="price" data-price="120.00">$120.00</p>
            <a href="../PHP/addtocart.php?name=New%20Balance%20860&price=120.00&image=../images/nb3.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=New%20Balance%20860&price=120.00&image=../images/nb3.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
    </div>

    <div id="converse" class="product-container" style="display:none;">
        <div class="product">
            <img src="../images/con1.png" alt="Converse Chuck Taylor">
            <h3>Converse Chuck Taylor</h3>
            <p class="price" data-price="65.00">$65.00</p>
            <a href="../PHP/addtocart.php?name=Converse%20Chuck%20Taylor&price=65.00&image=../images/con1.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Converse%20Chuck%20Taylor&price=65.00&image=../images/con1.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/con2.png" alt="Converse All Star">
            <h3>Converse All Star</h3>
            <p class="price" data-price="70.00">$70.00</p>
            <a href="../PHP/addtocart.php?name=Converse%20All%20Star&price=70.00&image=../images/con2.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Converse%20All%20Star&price=70.00&image=../images/con2.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/con3.png" alt="Converse One Star">
            <h3>Converse One Star</h3>
            <p class="price" data-price="80.00">$80.00</p>
            <a href="../PHP/addtocart.php?name=Converse%20One%20Star&price=80.00&image=../images/con3.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Converse%20One%20Star&price=80.00&image=../images/con3.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
    </div>

    <div id="adidas" class="product-container" style="display:none;">
        <div class="product">
            <img src="../images/adidas1.png" alt="Adidas Ultraboost">
            <h3>Adidas Ultraboost</h3>
            <p class="price" data-price="180.00">$180.00</p>
            <a href="../PHP/addtocart.php?name=Adidas%20Ultraboost&price=180.00&image=../images/adidas1.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Adidas%20Ultraboost&price=180.00&image=../images/adidas1.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/adidas2.png" alt="Adidas NMD">
            <h3>Adidas NMD</h3>
            <p class="price" data-price="140.00">$140.00</p>
            <a href="../PHP/addtocart.php?name=Adidas%20NMD&price=140.00&image=../images/adidas2.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Adidas%20NMD&price=140.00&image=../images/adidas2.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/adidas3.png" alt="Adidas Yeezy">
            <h3>Adidas Yeezy</h3>
            <p class="price" data-price="220.00">$220.00</p>
            <a href="../PHP/addtocart.php?name=Adidas%20Yeezy&price=220.00&image=../images/adidas3.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Adidas%20Yeezy&price=220.00&image=../images/adidas3.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
    </div>

    <div id="puma" class="product-container" style="display:none;">
        <div class="product">
            <img src="../images/puma1.png" alt="Puma RS-X">
            <h3>Puma RS-X</h3>
            <p class="price" data-price="110.00">$110.00</p>
            <a href="../PHP/addtocart.php?name=Puma%20RS-X&price=110.00&image=../images/puma1.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Puma%20RS-X&price=110.00&image=../images/puma1.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/puma2.png" alt="Puma Suede">
            <h3>Puma Suede</h3>
            <p class="price" data-price="80.00">$80.00</p>
            <a href="../PHP/addtocart.php?name=Puma%20Suede&price=80.00&image=../images/puma2.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Puma%20Suede&price=80.00&image=../images/puma2.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/puma3.png" alt="Puma RS-0">
            <h3>Puma RS-0</h3>
            <p class="price" data-price="90.00">$90.00</p>
            <a href="../PHP/addtocart.php?name=Puma%20RS-0&price=90.00&image=../images/puma3.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Puma%20RS-0&price=90.00&image=../images/puma3.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
    </div>

    <div id="skechers" class="product-container" style="display:none;">
        <div class="product">
            <img src="../images/skechers1.png" alt="Skechers Go Walk">
            <h3>Skechers Go Walk</h3>
            <p class="price" data-price="70.00">$70.00</p>
            <a href="../PHP/addtocart.php?name=Skechers%20Go%20Walk&price=70.00&image=../images/skechers1.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Skechers%20Go%20Walk&price=70.00&image=../images/skechers1.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/skechers2.png" alt="Skechers D'Lites">
            <h3>Skechers D'Lites</h3>
            <p class="price" data-price="80.00">$80.00</p>
            <a href="../PHP/addtocart.php?name=Skechers%20D'Lites&price=80.00&image=../images/skechers2.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Skechers%20D'Lites&price=80.00&image=../images/skechers2.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
        <div class="product">
            <img src="../images/skechers3.png" alt="Skechers Flex Appeal">
            <h3>Skechers Flex Appeal</h3>
            <p class="price" data-price="75.00">$75.00</p>
            <a href="../PHP/addtocart.php?name=Skechers%20Flex%20Appeal&price=75.00&image=../images/skechers3.png" class="btn">Add to Cart</a>
            <a href="../PHP/order.php?name=Skechers%20Flex%20Appeal&price=75.00&image=../images/skechers3.png&size=6&quantity=1" class="btn">Order Now</a>
        </div>
    </div>
</section>

    <script>
        function showProducts(brand) {
            const containers = document.querySelectorAll('.product-container');
            containers.forEach(container => {
                container.style.display = 'none';
            });
            document.getElementById(brand).style.display = 'block';
        }

        document.querySelectorAll('.product').forEach(product => {
        const priceElement = product.querySelector('.price');
        const quantityInput = product.querySelector('.quantity');
        const totalPriceElement = product.querySelector('.total-price');
        const basePrice = parseFloat(priceElement.getAttribute('data-price'));

        quantityInput.addEventListener('input', () => {
            const quantity = parseInt(quantityInput.value) || 1;
            const total = (basePrice * quantity).toFixed(2);
            totalPriceElement.textContent = `$${total}`;
        });
    });
    </script>

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
