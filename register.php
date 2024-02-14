<?php
// Include the session check function
//require_once('session_check.php');

// Call the function to check the session
//checkSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="logstyle.css">
    <title>Register - Library Management System</title>
</head>
<body class="register-page">

<header>
    <h1>Library Management System</h1>
</header>

<nav>
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <!-- Add other navigation links as needed -->
</nav>

<div class="register-container">
    <form class="register-form" action="register_process.php" method="post">
        <h2>Register</h2>
        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" pattern="U\d{3}" title="User ID must be in 'U001' format" required>

        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password (at least 8 characters):</label>
        <input type="password" id="password" name="password" pattern=".{8,}" title="Password must be at least 8 characters" required>

        <button type="submit">Register</button>

        <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
</div>

<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>

</body>
</html>
