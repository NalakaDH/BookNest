<?php
// Your database connection credentials here
$dsn = 'mysql:host=localhost;dbname=library_system';
$username = 'root';
$password = '';

// Initialize error and success messages
$errorMessage = $successMessage = "";

// Handling form submission for Delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Retrieve form data
    $member_id = $_POST['member_id'];

    try {
        // Create a PDO connection
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Start a transaction
        $pdo->beginTransaction();

        // Delete associated records in the bookborrower table
        $deleteBookBorrowerStmt = $pdo->prepare("DELETE FROM bookborrower WHERE member_id = :member_id");
        $deleteBookBorrowerStmt->execute(['member_id' => $member_id]);

        // Delete the member record
        $deleteMemberStmt = $pdo->prepare("DELETE FROM member WHERE member_id = :member_id");
        $deleteMemberStmt->execute(['member_id' => $member_id]);

        // Commit the transaction
        $pdo->commit();

        // Display success message upon successful deletion
        $successMessage = "Member record and associated book borrower records deleted successfully!";
    } catch (PDOException $e) {
        // Rollback the transaction in case of an exception
        $pdo->rollBack();

        // Display error message if an exception occurs during connection or query execution
        $errorMessage = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete member</title>
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

<h2>Delete member</h2>

<!-- Message display section -->
<?php
if (isset($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
}

if (isset($successMessage)) {
    echo '<p style="color: green;">' . $successMessage . '</p>';
}
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    Member ID to delete: <input type="text" name="member_id" value="<?php echo isset($_POST['member_id']) ? $_POST['member_id'] : ''; ?>"><br><br>
    <input type="submit" name="delete" value="Delete">
</form>

<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>

</body>
</html>



