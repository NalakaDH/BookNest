<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Member</title>
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

<h2>Update Member</h2>



<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
    Member ID: <input type="text" name="member_id" value="<?php echo isset($_POST['member_id']) ? $_POST['member_id'] : ''; ?>"><br><br>
    First Name: <input type="text" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>"><br><br>
    Last Name: <input type="text" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>"><br><br>
    <label for="birthday">birthday:</label>
    <input type="date" id="birthday" name="birthday" required><br><br>
    Email: <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"><br><br>
    <input type="submit" value="Update">
</form>
<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>

</body>

</html>

<?php
// Your database connection credentials here
$dsn = 'mysql:host=localhost;$dbname=database';
$servername = "localhost"; // server name
$username = 'root';
$password = '';
$dbname = "library_system"; // database name

// Function to validate Category ID format
function validateMemberID($member_id) {
    $pattern = '/^M\d{3}$/'; // C followed by exactly 3 digits
    return preg_match($pattern, $member_id);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $member_id = $_POST['member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    try {
        // Create a PDO connection
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query to update member details
        $stmt = $pdo->prepare("UPDATE member SET first_name = :first_name, last_name = :last_name, birthday = :birthday WHERE member_id = :member_id");
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':member_id', $member_id);

        $stmt->execute();

        // Display success message upon successful update
        $successMessage = "Member details updated successfully!";
    } catch (PDOException $e) {
        // Display error message if an exception occurs
        $errorMessage = "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your existing PHP code for updating data...
    if (isset($successMessage)) {
        echo '<p style="color: green;">' . $successMessage . '</p>';
    } elseif (isset($errorMessage)) {
        echo '<p style="color: red;">' . $errorMessage . '</p>';
    }
}

    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $member_id = $_POST['member_id'];
        $birthday = $_POST['birthday'];
    
        $member_id = mysqli_real_escape_string($conn, $member_id); // Sanitize input
        $birthday = mysqli_real_escape_string($conn, $birthday); // Sanitize input
    
        $sql = "UPDATE member SET birthday = '$birthday' WHERE member_id = '$member_id'";
    
        if ($conn->query($sql) === TRUE) {
            echo "Birthday updated successfully";
        } else {
            echo "Error updating birthday: " . $conn->error;
        }
    }

}

$conn->close();

?>


