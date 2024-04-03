<?php
session_start();
require_once '../Database/connection.php';

// Fetch data from the registration form
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$department = $_POST['department'];
$courses = $_POST['courses'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$password = $_POST['password'];
$position = $_POST['position'];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format!";
    exit;
}

// Check if email already exists in the database
$sql_check_email = "SELECT COUNT(*) FROM users WHERE email = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
$stmt_check_email->bind_result($email_count);
$stmt_check_email->fetch();
$stmt_check_email->close();

if ($email_count > 0) {
    echo "Email already exists!";
    exit;
}

// Hash password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO users (first_name, last_name, department, courses, phone_number, email, password, position) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $first_name, $last_name, $department, $courses, $phone_number, $email, $password_hashed, $position);
$stmt->execute();

// Check if registration was successful
if ($stmt->affected_rows > 0) {
    // Registration successful, redirect to registration form
    echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>';
    header("Location: Register.php");
    exit;
} else {
    // Registration failed, trigger error alert
   
    echo '<script>
            $(document).ready(function() {
                $(".fancy-alert").addClass("fancy-alert__active");
                $(".fancy-alert").addClass("error");
                $(".fancy-alert--words").html("Registration failed!");
            });
          </script>';
}

$stmt->close();
$conn->close();
?>
