<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.html');
    exit;
}

// Database connection details
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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize user data variables
$username = $_SESSION['user'];
$email = '';
$phone = '';
$address = '';

// Fetch user data from the database
$sql = "SELECT * FROM account WHERE username = '$username'";
$result = $conn->query($sql);

// After fetching user data, add this line:
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $phone = $row['phone_number'];
    $address = $row['address'];
    $password = $row['password']; // Add this line to fetch the password
} else {
    echo "No user found.";
}

// Handle form submission for updating user data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $new_username = $conn->real_escape_string($_POST['username']);
        $new_password = $conn->real_escape_string($_POST['password']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $address = $conn->real_escape_string($_POST['address']);
        
        // Update user data in the database
        $update_sql = "UPDATE account SET username='$new_username', password='$new_password', email='$email', phone_number='$phone', address='$address' WHERE username='$username'";
        
        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['user'] = $new_username; // Update session with new username
            echo "<script>alert('Profile updated successfully.');</script>";
            $username = $new_username; // Update the username variable
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif (isset($_POST['delete'])) {
        // Delete user from the database
        $delete_sql = "DELETE FROM account WHERE username='$username'";
        if ($conn->query($delete_sql) === TRUE) {
            session_destroy();
            echo "<script>alert('Account deleted successfully.'); window.location.href='../landing_no_acc.html';</script>";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrbanSteps</title>
    <link rel="stylesheet" href="../CSS/profile.css">
    <link rel="stylesheet" href="../CSS/landing.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<style>
    #profile {
    max-width: 600px;
    margin: 120px auto 50px;
    padding: 30px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

#profile h2 {
    color: #333;
    font-size: 28px;
    margin-bottom: 30px;
    text-align: center;
    font-weight: 600;
}

.profile-info {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.profile-info > div {
    position: relative;
}

.profile-info label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.profile-info input {
    width: 100%;
    padding: 12px 15px;
    border: 2px solid #e1e1e1;
    border-radius: 8px;
    font-size: 16px;
    color: #333;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.profile-info input:focus {
    border-color: #4CAF50;
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
    outline: none;
    background: #ffffff;
}

.profile-info input:hover {
    background: #ffffff;
}

/* Button Styles */
#profile button {
    width: 100%;
    padding: 14px 20px;
    margin-top: 20px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

#edit-button {
    background-color: #4CAF50;
    color: white;
    margin-left: -1px;
}

#edit-button:hover {
    background-color: #45a049;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
}

#update-button {
    background-color: #2196F3;
    color: white;
}

#update-button:hover {
    background-color: #1976D2;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(33, 150, 243, 0.2);
}

button[name="delete"] {
    background-color: #dc3545;
    color: white;
}

button[name="delete"]:hover {
    background-color: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
}

/* Responsive Design */
@media (max-width: 768px) {
    #profile {
        margin: 100px 20px 40px;
        padding: 20px;
    }

    #profile h2 {
        font-size: 24px;
    }

    .profile-info input {
        font-size: 14px;
    }

    #profile button {
        padding: 12px 16px;
        font-size: 14px;
    }
}

/* Optional: Animation for form elements */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.profile-info > div {
    animation: fadeIn 0.5s ease-out forwards;
    opacity: 0;
}

.profile-info > div:nth-child(1) { animation-delay: 0.1s; }
.profile-info > div:nth-child(2) { animation-delay: 0.2s; }
.profile-info > div:nth-child(3) { animation-delay: 0.3s; }
.profile-info > div:nth-child(4) { animation-delay: 0.4s; }
.profile-info > div:nth-child(5) { animation-delay: 0.5s; }

/* Optional: Custom scrollbar */
#profile {
    scrollbar-width: thin;
    scrollbar-color: #4CAF50 #f1f1f1;
}

#profile::-webkit-scrollbar {
    width: 8px;
}

#profile::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

#profile::-webkit-scrollbar-thumb {
    background: #4CAF50;
    border-radius: 10px;
}

#profile::-webkit-scrollbar-thumb:hover {
    background: #45a049;
}

/* Optional: Input placeholder styling */
.profile-info input::placeholder {
    color: #aaa;
    opacity: 0.7;
}

/* Optional: Focus within effect for each form group */
.profile-info > div:focus-within label {
    color: #4CAF50;
}
</style>
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
<body>
    <section id="profile">
    <h2>User Profile</h2>
    <form method="POST" action="">
        <div class="profile-info">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username-input" value="<?php echo htmlspecialchars($username); ?>">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password-input" placeholder="<?php echo htmlspecialchars($password); ?>">
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email-input" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div>
                <label for="phone">Phone Number:</label>
                <input type="tel" name="phone" id="phone-input" value="<?php echo htmlspecialchars($phone); ?>">
            </div>
            <div>
                <label for="address">Address:</label>
                <input type="text" name="address" id="address-input" value="<?php echo htmlspecialchars($address); ?>">
            </div>
        </div>
        <button type="button" class="btn1" id="edit-button" onclick="toggleEdit()">Edit Profile</button>
        <button type="submit" name="update" id="update-button" style="display:none;">Update Profile</button>
        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</button>
    </form>
</section>
</section>

    <footer>
        <!-- Footer content remains the same -->
    </footer>

    <script>
        function toggleEdit() {
            const profileInfoDivs = document.querySelectorAll('.profile-info div');
            const editButton = document.getElementById('edit-button');
            const updateButton = document.getElementById('update-button');
            const isEditing = editButton.textContent === 'Edit Profile';

            profileInfoDivs.forEach(div => {
                const p = div.querySelector('p');
                const input = div.querySelector('input');
                if (isEditing) {
                    p.style.display = 'none';
                    input.style.display = 'block';
                    if (input.type === 'password') {
                        input.value = ''; // Clear password field for security
                    }
                } else {
                    p.style.display = 'block';
                    input.style.display = 'none';
                    if (input.type !== 'password') {
                        p.textContent = input.value; // Update the displayed text
                    }
                }
            });

            editButton.textContent = isEditing ? 'Cancel' : 'Edit Profile';
            updateButton.style.display = isEditing ? 'inline-block' : 'none';
        }
    </script>
</body>
</html>