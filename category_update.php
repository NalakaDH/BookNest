<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Book Category</title>
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
<h2>Update Book Category</h2>

<?php
// Display error message if validation fails
if (isset($errorMessage)) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
}

// Display success message upon successful update
if (isset($successMessage)) {
    echo '<p style="color: green;">' . $successMessage . '</p>';
}
?>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    Category ID: <input type="text" name="category_id" value="<?php echo isset($_POST['category_id']) ? $_POST['category_id'] : ''; ?>"><br><br>
    Category Name: <input type="text" name="category_Name" value="<?php echo isset($_POST['category_Name']) ? $_POST['category_Name'] : ''; ?>"><br><br>
    Date Modified: <input type="date" name="date_modified" value="<?php echo isset($_POST['date_modified']) ? $_POST['date_modified'] : date('Y-m-d'); ?>"><br><br>
    <input type="submit" value="Update">
</form>

</body>
</html>

<?php
// Your database connection credentials here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

// Function to validate Category ID format
function validateCategoryID($category_id) {
    $pattern = '/^C\d{3}$/'; // C followed by exactly 3 digits
    return preg_match($pattern, $category_id);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category_id = $_POST['category_id'];
    $category_Name = $_POST['category_Name'];
    $date_modified = $_POST['date_modified'];
    
    // Get current system time for the time part
    $currentTime = date('H:i:s'); // Current system time
    
    // Validate Category ID format
    if (!validateCategoryID($category_id)) {
        $errorMessage = "Category ID should be in the format 'C001'. Please enter a valid Category ID.";
        // You can redirect or handle the error as required
    } else {
        try {
            // Combine date and system time
            $dateTimeModified = $date_modified . ' ' . $currentTime;

            // Define DSN (Data Source Name) for the PDO connection
            $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
            
            // Create a PDO connection
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Prepare and execute the SQL query to update category details
            $stmt = $pdo->prepare("UPDATE bookcategory SET category_Name = :category_Name, date_modified = :date_modified WHERE category_id = :category_id");
            $stmt->execute(['category_Name' => $category_Name, 'date_modified' => $dateTimeModified, 'category_id' => $category_id]);

            // Display success message upon successful update
            $successMessage = "Book category details updated successfully!";
        } catch(PDOException $e) {
            // Display error message if an exception occurs
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
}
?>