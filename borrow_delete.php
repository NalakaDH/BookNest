<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Book Borrow</title>
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
        <a href="display_book.php">Display Booky</a>
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
        <a href="borrow__delete.php">Borrow Delete</a>
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
    
    <a href="login.html">Login/Register</a>
</nav>

<h2>Delete Book Borrow</h2>

<!-- Form for deleting a borrow book detail -->
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    Borrow ID to Delete: <input type="text" name="borrow_id_to_delete" required>
    <input type="submit" name="delete" value="Delete">
</form>

<?php
// Display success or error messages for both update and delete operations
if (isset($successMessage)) {
    echo '<p style="color: green;">' . $successMessage . '</p>';
} elseif (isset($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
}
?>
<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>

</body>
</html>


<?php
// database connection credentials here
$servername = "localhost"; // server name
$username = 'root';
$password = '';
$dbname = "library_system"; // database name

// Function to validate Borrow ID format
function validateBorrowID($borrow_id) {
    $pattern = '/^BR\d{3}$/'; // BR followed by exactly 3 digits
    return preg_match($pattern, $borrow_id);
}

// Handling form submission for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $borrow_id_to_delete = $_POST['borrow_id_to_delete'];

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query to delete a borrow book detail
        $stmt = $pdo->prepare("DELETE FROM bookborrower WHERE borrow_id = :borrow_id");
        $stmt->bindParam(':borrow_id', $borrow_id_to_delete);
        $stmt->execute();

        // Check if any rows were affected
        $rowsAffected = $stmt->rowCount();

        if ($rowsAffected > 0) {
            // Display success message upon successful deletion
            $successMessage = "Borrow Book detail deleted successfully!";
        } else {
            // Display message if no rows were affected (book borrow detail already deleted)
            $errorMessage = "Borrow Book detail not found or already deleted.";
        }
    } catch (PDOException $e) {
        // Display error message if an exception occurs
        $errorMessage = "Error: " . $e->getMessage();
    }
}

// ... (your existing code for connection and updating)

?>

