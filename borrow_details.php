<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Borrow Details</title>
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
    
    <a href="login.html">Login/Register</a>
</nav>

<h2>Add Borrow Details</h2>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    BorrowID: <input type="text" name="borrow_id" pattern="BR\d{3}" title="Enter in BR001 format" required><br><br>
    BookID: <input type="text" name="book_id" pattern="B\d{3}" title="Enter in B001 format" required><br><br>
    MemberID: <input type="text" name="member_id" pattern="M\d{3}" title="Enter in M001 format" required><br><br>
    Borrow Status:
    <select name="borrow_status">
        <option value="borrowed">Borrowed</option>
        <option value="available">Available</option>
    </select><br><br>
    <input type="submit" name="submit" value="Add Borrow Details">
</form>

<?php
// Display error or success message
if (isset($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
} elseif (isset($successMessage)) {
    echo '<p style="color: green;">' . $successMessage . '</p>';
}
?>

<?php
// Your database connection credentials here
$dsn = 'mysql:host=localhost;dbname=library_system';
$username = 'root';
$password = '';
$dbname ='library_system';

// Handling form submission for Adding Borrow Details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $borrowID = $_POST['borrow_id'];
    $bookID = $_POST['book_id'];
    $memberID = $_POST['member_id'];
    $borrowStatus = ($_POST['borrow_status'] == 'borrowed') ? 'borrowed' : 'available'; // Updating borrow status

    // Validation using regular expressions
    $validBorrowID = preg_match('/^BR\d{3}$/', $borrowID); // BR followed by 3 digits
    $validBookID = preg_match('/^B\d{3}$/', $bookID); // B followed by 3 digits
    $validMemberID = preg_match('/^M\d{3}$/', $memberID); // M followed by 3 digits

    if ($validBorrowID && $validBookID && $validMemberID) {
        try {
            // Create a PDO connection
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the SQL query to insert borrow details
            $stmt = $pdo->prepare("INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) VALUES (:borrow_id, :book_id, :member_id, :borrow_status, NOW())");
            
            // Add the missing binding for :member_id
            $stmt->execute(['borrow_id' => $borrowID, 'book_id' => $bookID, 'member_id' => $memberID, 'borrow_status' => $borrowStatus]);

            // Display success message upon successful insertion
            $successMessage = "Borrow details added successfully!";
        } catch(PDOException $e) {
            // Display error message if an exception occurs
            $errorMessage = "Error: " . $e->getMessage();
        }
    } else {
        $errorMessage = "Invalid format for Borrow ID, Book ID, or Member ID!";
    }
}
?>
<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>

</body>
</html>
