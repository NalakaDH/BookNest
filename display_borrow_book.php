<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Book Borrow</title>
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

<?php
// database connection credentials here
$servername = "localhost"; // server name
$username = 'root';
$password = '';
$dbname = "library_system"; // database name

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve Borrow Book records with Book details from the database
    $stmt = $pdo->query("
        SELECT bb.book_id, bb.member_id, b.book_name, bb.borrow_status, bb.borrower_date_modified
        FROM bookborrower bb
        JOIN book b ON bb.book_id = b.book_id
    ");

    // Check if there are any records
    if ($stmt->rowCount() > 0) {
        echo '<h2>Borrow Book Records</h2>';
        echo '<table border="1">
                <thead>
                    <tr>
                        <th>book_id</th>
                        <th>Member who borrowed</th>
                        <th>Book Name</th>
                        <th>Borrow Status</th>
                        <th>Date Modified</th>
                    </tr>
                </thead>
                <tbody>';

        // Loop through each row in the result set
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>
                    <td>' . $row['book_id'] . '</td>
                    <td>' . $row['member_id'] . '</td>
                    <td>' . $row['book_name'] . '</td>
                    <td>' . $row['borrow_status'] . '</td>
                    <td>' . $row['borrower_date_modified'] . '</td>
                  </tr>';
        }

        echo '</tbody></table>';
    } else {
        // Display a message if no records are found
        echo '<p>No Borrow Book records found.</p>';
    }
} catch (PDOException $e) {
    // Display error message if an exception occurs
    echo "Error: " . $e->getMessage();
}

// Close the PDO connection
$pdo = null;
?>

<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
</footer>
</body>
</html>