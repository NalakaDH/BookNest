<?php
// Include the session check function
require_once('session_check.php');

// Call the function to check the session
checkSession();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Records</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>

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

<h2>Book Records</h2>

<table>
    <tr>
        <th>book_id</th>
        <th>book_name</th>
        <th>category_id</th>
    </tr>

    <?php
    // Connect to the database
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

    // Retrieve book records from the database
    $sql = "SELECT * FROM book";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["book_id"] . "</td>";
            echo "<td>" . $row["book_name"] . "</td>";
            echo "<td>" . $row["category_id"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No books found</td></tr>";
    }

    $conn->close();
    ?>

</table>

<footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
  </footer>

</body>
</html>
