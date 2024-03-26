<?php
session_start();
require_once '../Database/connection.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['position'] = $user['position'];
    header("Location: dashboard.php"); // Redirect to dashboard
} else {
    echo "Invalid email or password";
}
?>
