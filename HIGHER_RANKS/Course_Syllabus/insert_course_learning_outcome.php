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
    $comlab = $_POST['comlab'];
    $learn_out = $_POST['learn_out'];
    $department = $_POST['department'];
    $catid = $_POST['catid'];

    $sql = "INSERT INTO course_leaning (`comlab`, `learn_out`,`department`,`catid`)
    VALUES ('$comlab', '$learn_out', '$department', '$catid')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
