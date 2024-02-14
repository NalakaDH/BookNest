<?php
        session_start();

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
$username = $_POST['username'];
$password = $_POST['password'];

// Retrieve hashed password from the database
$retrieve_query = "SELECT * FROM user WHERE username=?";
$stmt = $conn->prepare($retrieve_query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Verify the entered password with the hashed password
    if (password_verify($password, $hashed_password)) {
        // Start the session (if not already started)

        // Set session variables or perform any other actions needed
        $_SESSION['username'] = $username;

        // Redirect to the homepage
        header("Location: Index.php");
    } else {
        echo "Login failed!";
    }
} else {
    echo "Login failed!";
}

$stmt->close();
$conn->close();
?>

