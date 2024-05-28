<?php
session_start();
include('../Database/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $department = $_POST['department'];
    $catid = $_POST['catid'];
    $current_email = $_SESSION['email']; // current email of the logged-in user

    // Update the user details in the database
    $sql = "UPDATE users SET email = ?, department = ?, catid = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $email, $department, $catid, $current_email);

    if ($stmt->execute()) {
        // Update session variables
        $_SESSION['email'] = $email;
        $_SESSION['department'] = $department;
        $_SESSION['catid'] = $catid;
        // Redirect to the same page to reflect the changes
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
