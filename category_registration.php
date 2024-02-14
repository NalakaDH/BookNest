<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Category Registration</title>
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
  <h1>Book Category Registration</h1>

  <!-- Form for adding/updating book categories -->
  <form action="" method="POST">
    <!-- Input fields for Category ID, Name, Date Modified -->
    <!-- Add JavaScript validation for Category ID format -->
    <input type="text" name="category_id" placeholder="Category ID (e.g., C001)" required>
    <input type="text" name="category_name" placeholder="Category Name" required>
    <!-- Hidden field for identifying if it's an update or addition -->
    <input type="hidden" name="action" value="addOrUpdate">
    <button type="submit">Submit</button>
  </form>


</body>
</html>

<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $category_id = $_POST["category_id"];
    $category_name = $_POST["category_name"];

    // Validation: Category ID should match the format C<CATEGORY_ID> (e.g., C001)
    if (!preg_match("/^C\d{3}$/", $category_id)) {
        echo "Invalid Category ID format. Please use CXXX format (e.g., C001)";
        // Handle error or redirect to form with error message
        exit();
    }

    // Get the current date and time
    $date_modified = date("Y-m-d H:i:s");

    // Insert into the database
    $query = "INSERT INTO bookcategory (category_id, category_name, date_modified) 
              VALUES ('$category_id', '$category_name', '$date_modified')";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        echo "Category added successfully!";
        // Redirect to a success page or display success message
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
        // Handle error or redirect to form with error message
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
