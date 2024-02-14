<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$delete_success_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Retrieve form data
    $user_id = $_POST['user_id'];

    // Use prepared statements to delete user
    $delete_query = "DELETE FROM user WHERE user_id=?";
    $stmt_delete = $conn->prepare($delete_query);
    $stmt_delete->bind_param("s", $user_id);

    if ($stmt_delete->execute()) {
        $delete_success_message = "User deleted successfully!";
    } else {
        echo "Error: " . $stmt_delete->error;
    }

    $stmt_delete->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete User</title>
    <link rel="stylesheet" href="Style.css">
</head>
<body>

<header>
    <h1>Library Management System</h1>
</header>

<nav>
    <a href="Index.php">Home</a>
    <div class="Category-dropdown">
      <button class="Category-btn">Books <span class="Category-icon">&#9662;</span></button>
      <div class="Category-dropdown-content">
        <a href="display_book.php">Display Book</a>
        <a href="register_book_form.php">Register Book</a>
        <a href="update_book_form.php">Update Book</a>
        <a href="delete_book_form.php">Delete Book</a>
      </div>
    </div>
    <div class="Category-dropdown">
      <button class="Category-btn">Categories <span class="Category-icon">&#9662;</span></button>
      <div class="Category-dropdown-content">
        <a href="category_display.php">Category Display</a>
        <a href="category_registration.php">Category Register</a>
        <a href="category_update.php">Category Update</a>
        <a href="category_delete.php">Category Delete</a>
      </div>
    </div>
    <div class="Category-dropdown">
      <button class="Category-btn">Member <span class="Category-icon">&#9662;</span></button>
      <div class="Category-dropdown-content">
        <a href="member_display.php">Display Member</a>
        <a href="member_registration.php">Register Member</a>
        <a href="member_update.php">Update Member</a>
        <a href="member_delete.php">Delete Member</a>
      </div>
    </div>  
    <div class="Category-dropdown">
      <button class="Category-btn">Book Borrowed <span class="Category-icon">&#9662;</span></button>
      <div class="Category-dropdown-content">
        <a href="display_borrow_book.php">Borrow Display</a>
        <a href="borrow_details.php">Borrow Details</a>
        <a href="borrow_update.php">Borrow Update</a>
        <a href="borrow_delete.php">Borrow Delete</a>
      </div>
    </div>
    <div class="Category-dropdown">
      <button class="Category-btn">User <span class="Category-icon">&#9662;</span></button>
      <div class="Category-dropdown-content">
        <a href="display_users.php"> Display User</a>
        <a href="update_user.php"> Update User</a>
        <a href="register_user.php"> Register User</a>
        <a href="delete_user.php"> Delete User</a>
      </div>
    </div>
    
    <a href="login.php">Login/Register</a>
   
    
</nav>

<div class="delete-container">
    <form class="delete-form" action="delete_user.php" method="post">
        <h2>Delete User</h2>
        <!-- Add your form fields here -->
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" required><br><br>
        <button type="submit" name="delete">Delete</button>
    </form>
    <?php echo $delete_success_message; ?>
</div>

<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>

</body>
</html>
