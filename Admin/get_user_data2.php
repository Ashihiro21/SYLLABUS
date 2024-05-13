<?php
// get_user_data2.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data based on the course ID
if (isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];

    $sql = "SELECT * FROM course WHERE id = $course_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo "No data found";
    }
}

$conn->close();
?>
