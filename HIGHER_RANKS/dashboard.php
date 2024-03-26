<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Example dashboard
echo "Welcome to the Dashboard!";
echo "Your position is: " . $_SESSION['position'];
?>
