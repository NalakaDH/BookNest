<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="logstyle.css">

  <title>Login - Library Management System</title>
  
</head>
<body class="login-page">

  <header>
    <h1>Library Management System</h1>
  </header>

  <nav>
    <a href="index.php">Home</a>
    
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <!-- Add other navigation links as needed -->
  </nav>
  

  <div class="login-container">
    <form class="login-form" action="login_process.php" method="post">
      <h2>Login</h2>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Login</button>

      <p class="register-link">Don't have an account? <a href="register.html">Register here</a></p>
    </form>
  </div>

  <footer class="footer-container">
    <p>&copy; 2024 Library Management System. All rights reserved.</p>
  </footer>

</body>
</html>



