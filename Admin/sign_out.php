<?php
session_start(); // Start the session

// Check if user is logged in
if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] === true) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to appropriate logout page based on role
    if (isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
        // If the user was an admin
        header("Location: ../HIGHER_RANKS/login.php");
        exit();
    } else {
        // If the user was a regular user
        header("Location: ../HIGHER_RANKS/login.php");
        exit();
    }
} else {
    // If user is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>
