<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Book Category by ID</title>
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

<h2>Search Book Category by ID</h2>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    Category ID to search: <input type="text" name="searchCategoryID" value="<?php echo isset($_POST['searchCategoryID']) ? htmlspecialchars($_POST['searchCategoryID']) : ''; ?>"><br><br>
    <input type="submit" name="submit" value="Search">
</form>

<?php
// Your database connection credentials here
$dsn = 'mysql:host=localhost;dbname=library_system';
$username = "root";
$password = "";

// Initialize variables
$categoryDetails = [];
$errorMessage = '';

// Handling form submission for Fetching Category Details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $searchCategoryID = $_POST['searchCategoryID'];

    try {
        // Create a PDO connection
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query to fetch category details by ID
        $stmt = $pdo->prepare("SELECT category_id, category_name, date_modified FROM bookcategory WHERE category_id = :searchCategoryID");

        $stmt->execute(['searchCategoryID' => $searchCategoryID]);
        $categoryDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$categoryDetails) {
            $errorMessage = "No category found with the provided ID.";
        }
    } catch (PDOException $e) {
        // Display error message if an exception occurs
        $errorMessage = "Error: " . $e->getMessage();
    }
}

// Display error message if search fails
if ($errorMessage) {
    echo '<p style="color: red;">' . $errorMessage . '</p>';
} elseif ($categoryDetails) {
    // Display category details if found
    ?>
    <h3>Category Details</h3>
    <p><strong>Category ID:</strong> <?php echo htmlspecialchars($categoryDetails['category_id']); ?></p>
    <p><strong>Category Name:</strong> <?php echo htmlspecialchars($categoryDetails['category_name']); ?></p>
    <p><strong>Date Modified:</strong> <?php echo htmlspecialchars($categoryDetails['date_modified']); ?></p>
    <?php
}
?>

<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>

</body>
</html>
