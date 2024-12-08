<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link rel="stylesheet" href="CSS/login_register.css">
</head>
<style>
    /* General Styles */
body {
    font-family: 'Arial', sans-serif; /* Use a clean sans-serif font */
    background-color: #f4f4f4; /* Light background color */
    color: #333; /* Dark text color for readability */
    margin: 0; /* Remove default margin */
    padding: 0; /* Remove default padding */
    display: flex; /* Use flexbox for centering */
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    height: 100vh; /* Full viewport height */
}

/* Container Styles */
.container {
    background: white; /* White background for the container */
    padding: 2rem; /* Padding around the content */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    text-align: center; /* Center text */
    max-width: 400px; /* Maximum width for the container */
    width: 90%; /* Responsive width */
}

/* Heading Styles */
h2 {
    font-size: 24px; /* Font size for the heading */
    margin-bottom: 1rem; /* Space below the heading */
    color: #333; /* Green color for the heading */
}

/* Paragraph Styles */
p {
    font-size: 16px; /* Font size for paragraphs */
    margin-bottom: 1.5rem; /* Space below paragraphs */
}

/* Button Styles */
.btn {
    display: inline-block; /* Inline block for button */
    background-color: #333; /* Green background */
    color: white; /* White text color */
    padding: 10px 20px; /* Padding for the button */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    text-decoration: none; /* Remove underline */
    font-size: 16px; /* Font size for button text */
    transition: background-color 0.3s, transform 0.2s; /* Smooth transitions */
}

/* Button Hover Effects */
.btn:hover {
    background-color: #45a049; /* Darker green on hover */
    transform: translateY(-2px); /* Lift effect on hover */
}

/* Link Styles */
a {
    color: #007bff; /* Blue color for links */
    text-decoration: none; /* Remove underline */
}

a:hover {
    text-decoration: underline; /* Underline on hover */
}
</style>
<body>
    <div class="container">
        <h2>Registration Successful!</h2>
        <p>Thank you for registering with UrbanSteps. You can now log in to your account.</p>
        <a href="../login.html" class="btn">Login Here</a>
        <p>Or <a href="../register.html">Register again</a> if you made a mistake.</p>
    </div>
</body>
</html>