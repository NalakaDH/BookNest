<?php 
session_start();
// Include the session check function
// require_once('session_check.php');

// Call the function to check the session
// checkSession();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <style>
    /* ... (your existing CSS code) ... */

    /* Profile icon styling */
    #profile-icon {
      font-size: 24px;
      cursor: pointer;
      color: #fff;
      margin-right: 10px;
      position: absolute;
      top: 10px;
      right: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #3498db;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      transition: background-color 0.3s;
    }

    /* Profile icon hover effect */
    #profile-icon:hover {
      background-color: #2980b9;
    }

    /* Profile container styling */
    #profile-container {
      display: none;
      position: absolute;
      top: 60px;
      right: 10px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      border-radius: 5px;
      padding: 10px;
      text-align: center;
    }

    #profile-container a {
      text-decoration: none;
      color: #333;
      display: block;
      padding: 8px;
      transition: background-color 0.3s;
    }

    #profile-container a:hover {
      background-color: #ddd;
    }
  </style>



  <title>Library Management System</title>
</head>
<body>

  <header>
    <h1>Library Management System</h1>
  </header>

  <nav>
    <a href="#">Home</a>
    <div class="Category-dropdown">
      <button class="Category-btn">Books <span class="Category-icon">&#9662;</span></button>
      <div class="Category-dropdown-content">
        <a href="display_book.php">Display Book</a>
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

    
    <!-- Add an ID to the profile icon -->
  <div id="profile-icon">
    <?php
      
      if (isset($_SESSION['username'])) {
          $initial = strtoupper(substr($_SESSION['username'], 0, 1));
          echo $initial;
      }
    ?>
  </div>

  <!-- Hidden container for displaying username and logout button -->
  <div id="profile-container">
      <?php if (isset($_SESSION['username'])) { ?>
        <a href="logout.php">Logout</a>
        <?php } ?>
  </div>
  </nav>

  <!-- ... (rest of your existing body content) ... -->
  <!-- JavaScript code to handle the click event -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var profileIcon = document.getElementById("profile-icon");
      var profileContainer = document.getElementById("profile-container");

      // Display only username initially
      if (profileContainer.style.display === "none" && '<?php echo isset($_SESSION['username']); ?>') {
        profileContainer.style.display = "block";
      }

      // Add a click event listener to the profile icon
      profileIcon.addEventListener("click", function () {
        // Toggle the visibility of the profile container
        if (profileContainer.style.display === "none") {
          profileContainer.style.display = "block";
        } else {
          profileContainer.style.display = "none";
        }
      });
    });
  </script>





    


  <div class="hero">
    <img src="Book-blog-image.jpg" alt="Library Image" class="hero-image">
    <div class="hero-content">
      <h2>Explore the World of Books with Our Library Management System</h2>
      <a href="login.php" class="cta-button">Get Started</a>
    </div>
  </div>

  <div class="features">
    <div class="feature">
      <h3>Login and User Registration</h3>
      <p>Brief description and CTA button.</p>
    </div>
    <div class="feature">
      <h3>Books Registration</h3>
      <p>Featured books and link to the catalog.</p>
    </div>
    <div class="feature">
      <h3>Book Category Registration</h3>
      <p>Popular categories and link to the full list.</p>
    </div>
    <div class="feature">
      <h3>Library Member Registration</h3>
      <p>Benefits of becoming a member and registration button.</p>
    </div>
    <div class="feature">
      <h3>Book Borrow Details</h3>
      <p>Recently borrowed books or announcements.</p>
    </div>
    <div class="feature">
      <h3>Assign Fine for a User</h3>
      <p>Brief explanation and link to more details.</p>
    </div>
  </div>



</body>
</html>










