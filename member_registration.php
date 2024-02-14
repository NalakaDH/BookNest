<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Member Registration</title>
    <link rel="stylesheet" href="Style.css">

    <script>
        function validateEmail() {
            // Get the value from the email input field
            var email = document.getElementById("email").value;

            // Regular expression to check email format
            var emailFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Check if the email matches the regular expression
            if (!email.match(emailFormat)) {
                alert("Invalid email format");
                return false; // Prevent form submission
            }

            // If the format is valid, allow form submission
            return true;
        }
    </script>

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

    <h1>Library Member Registration</h1>
    <form action="" method="post" onsubmit="return validateEmail()">
        <label for="member_id">Member ID:</label><br>
        <input type="text" id="member_id" name="member_id" required><br><br>

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="birthday">Birthday:</label><br>
        <input type="date" id="birthday" name="birthday" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Register">
    </form>

    <footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>
</body>
</html>


<?php
// Database credentials
$servername = "localhost"; // server name
$username = "root"; // database username
$password = ""; // database password
$dbname = "library_system"; // database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $member_id = $_POST["member_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $birthday = $_POST["birthday"];
    $email = $_POST["email"];


    
    // Assuming the form has been submitted and the email is in $_POST['email']
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
    
        // Validate email format using PHP filter_var function
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format\r\n";
        } else {
            echo "Valid email format: \r\n" . $email;
            // Here you can proceed with other actions like inserting into a database, etc.
        }
    }
    
    

    // Validation: Member ID should match the format 'M<MEMBER_ID> (e.g., M001)
    if (!preg_match("/^M\d{3}$/", $member_id)) {
        echo "Invalid Member ID format. Please use MXXX format (e.g., M001)";
        // Handle error or redirect to form with error message
        exit();
    }

    

    // Insert into the database
    $query = "INSERT INTO member (member_id, first_name, last_name,birthday, email) 
              VALUES ('$member_id', '$first_name', '$last_name','$birthday', '$email')";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        
        echo "    Member added successfully!";
        // Redirect to a success page or display success message
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
        // Handle error or redirect to form with error message
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
