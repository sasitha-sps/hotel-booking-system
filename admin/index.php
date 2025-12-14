<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    // User is logged in -> Go to Dashboard
    header('Location: dashboard.php');
} else {
    // User is NOT logged in -> Go to Login
    header('Location: login.php');
}
exit;
?>