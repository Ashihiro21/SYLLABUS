<?php
// Replace with your database connection code
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

if (isset($_POST['category'])) {
    $catid = $_POST['category'];

    $sql = "SELECT * FROM courses WHERE catid = $catid"; // Adjust table name and column names
    $result = $conn->query($sql);

    $courses = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $courses[] = $row;
        }
    }

    echo json_encode($courses);
}

$conn->close();
?>
