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
    $description = $_POST['description'];

    $sql = "INSERT INTO  course_policies (`description`)
    VALUES ('$description')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../course_syllabus.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
