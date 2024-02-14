<?php
// Include this function at the beginning of each restricted page
function checkSession() {
    // Check if the session is not already active
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Check if the 'username' session variable is set
    if (!isset($_SESSION['username'])) {
        // Redirect to the login page if not logged in
        header("Location: login.php");
        exit();
    }
}
?>
