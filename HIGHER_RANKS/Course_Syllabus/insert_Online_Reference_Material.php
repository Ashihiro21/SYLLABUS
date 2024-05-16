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
    $e_provider = $_POST['e_provider'];
    $refference_material = $_POST['refference_material'];
    $department = $_POST['department'];
    $catid = $_POST['catid'];

    $sql = "INSERT INTO online_refference (`e_provider`, `refference_material`, `department`, `catid`)
    VALUES ('$e_provider', '$refference_material', '$department', '$catid')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
