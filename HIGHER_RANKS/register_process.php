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

// Hash password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);


// Insert data into the database
$sql = "INSERT INTO users (first_name, last_name, department, courses, phone_number, email, password, position) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $first_name, $last_name, $department, $courses, $phone_number, $email, $password_hashed, $position);
$stmt->execute();

echo "Registration successful!";
?>
