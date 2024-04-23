<?php
session_start();
require_once '../Database/connection.php';

// Fetch data from the registration form
$username = $_POST['username'];
$password = $_POST['password'];

// Check if username already exists in the database
$sql_check_username = "SELECT COUNT(*) FROM admins WHERE username = ?";
$stmt_check_username = $conn->prepare($sql_check_username);
$stmt_check_username->bind_param("s", $username);
$stmt_check_username->execute();
$stmt_check_username->bind_result($username_count);
$stmt_check_username->fetch(); // Fetch the result into $username_count
$stmt_check_username->close();

if ($username_count > 0) {
    $response = array("success" => false, "message" => "Username already exists!");
    echo json_encode($response);
    exit;
}

// Hash password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Insert data into the database
$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password_hashed);
$stmt->execute();

// Check if registration was successful
if ($stmt->affected_rows > 0) {
    // Registration successful
    $response = array("success" => true, "message" => "Registration successful!");
    echo json_encode($response);
    exit;
} else {
    // Registration failed
    $response = array("success" => false, "message" => "Registration failed!");
    echo json_encode($response);
    exit;
}

$stmt->close();
$conn->close();
?>
