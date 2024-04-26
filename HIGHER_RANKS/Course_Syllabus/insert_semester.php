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
    $term = $_POST['term'];
    $year = $_POST['year'];
    $second_call = $_POST['second_call'];
    $department = $_POST['department'];

    $sql = "INSERT INTO semestral (`term`, `year`, `department`, `second_call`)
    VALUES ('$term', '$year', '$department', '$second_call')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
