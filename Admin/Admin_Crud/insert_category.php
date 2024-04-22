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
    $name = $_POST['name'];
    $initial = $_POST['initial'];
    $dean_name = $_POST['dean_name'];

    $sql = "INSERT INTO  category (`name`, `initial`, `dean_name`)
    VALUES ('$name', '$initial','$dean_name')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../department.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
