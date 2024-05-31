<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_POST['insertdata']))
{
    $description = $_POST['final_description'];
    $percent = $_POST['final_percent'];
    $department= $_POST['department'];
    $catid= $_POST['catid'];

    $sql = "INSERT INTO final_percent (`final_description`, `final_percents`, `department`, `catid`)
    VALUES ('$description', '$percent', '$department', '$catid')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
