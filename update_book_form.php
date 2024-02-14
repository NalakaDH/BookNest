<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Book Details</title>
    
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
    
    <a href="login.php">Login/Register</a>
</nav>


<form method="post" action="">
    Book ID to Update: <input type="text" name="book_id"><br>
    <input type="submit" name="submit" value="Update Book">
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];

    // Fetch book details based on Book ID
    $sql = "SELECT * FROM book WHERE book_id = '$book_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            // Display form to update book details
            echo '<form method="post" action="">';
            echo 'Book ID: <input type="text" name="book_id" value="' . $row["book_id"] . '" readonly><br>';
            echo 'Book Name: <input type="text" name="book_name" value="' . $row["book_name"] . '"><br>';
            echo 'Book Category: <input type="text" name="category_id" value="' . $row["category_id"] . '"><br>';
            echo '<input type="submit" name="submit" value="Update">';
            echo '</form>';
        }
    } else {
        echo "Book ID not found.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure the $_POST array contains the expected keys
    if (isset($_POST['book_id'], $_POST['book_name'], $_POST['category_id'])) {
        $book_id = $_POST['book_id'];
        $book_name = $_POST['book_name'];
        $category_id = $_POST['category_id'];

        // Update book details in the database
        $update_sql = "UPDATE book SET book_name='$book_name', category_id='$category_id' WHERE book_id='$book_id'";

        if ($conn->query($update_sql) === TRUE) {
            echo "Book details updated successfully";
        } else {
            echo "Error updating book details: " . $conn->error;
        }
    } else {
        echo "Invalid form submission. Please fill in all fields.";
    }
}

$conn->close();
?>

<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
  </footer>

</body>
</html>
