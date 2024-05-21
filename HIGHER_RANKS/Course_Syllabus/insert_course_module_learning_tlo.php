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

    $topic_learn_out = $_POST['topic_learn_out'];
    $catid = $_POST['catid'];
    $department = $_POST['department'];

    $sql = "INSERT INTO tlo (`topic_learn_out`,`catid`,`department`)
    VALUES ('$topic_learn_out','$catid','$department')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
