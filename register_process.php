<?php
// Include the session check function
//require_once('session_check.php');

// Call the function to check the session
//checkSession();

// Database connection details
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

// Form data
$user_id = $_POST['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing the password

// Use prepared statements to check if username or email already exists
$check_query = "SELECT * FROM user WHERE username=? OR email=?";
$stmt_check = $conn->prepare($check_query);
$stmt_check->bind_param("ss", $username, $email);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    echo "Username or email already exists. Please choose a different one.";
    exit();  // Add this line
} else {
    // Insert data into the database using prepared statements
    $insert_query = "INSERT INTO user (user_id, first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($insert_query);
    $stmt_insert->bind_param("ssssss", $user_id, $first_name, $last_name, $username, $email, $password);

    if ($stmt_insert->execute()) {
        // Registration successful, redirect to the homepage
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt_insert->error;
    }

    $stmt_insert->close();
}

$stmt_check->close();
$conn->close();
?>
