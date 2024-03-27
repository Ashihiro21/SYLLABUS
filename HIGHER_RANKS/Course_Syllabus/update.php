<?php

// Define database connection credentials
$servername = "localhost"; // Change this to your MySQL server's hostname or IP address
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "syllabus"; // Change this to your MySQL database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $field = $_POST['field'];
    $value = $_POST['value'];

    // Prepare update query
    $update_query = "UPDATE course_syllabus SET $field = '$value' WHERE id = $id";

    // Execute update query
    $result = mysqli_query($conn, $update_query);

    // Check if query executed successfully
    if ($result) {
        echo "success";
    } else {
        echo "error";
    }

    // Terminate script execution
    exit();
}

// Close database connection (optional)
mysqli_close($conn);
?>
