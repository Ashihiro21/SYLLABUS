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
    $final_learning_out = $_POST['final_learning_out'];
    $final_topic_leaning_out = $_POST['final_topic_leaning_out'];

    $sql = "INSERT INTO  laerning_final (`final_learning_out`, `final_topic_leaning_out`)
    VALUES ('$final_learning_out', '$final_topic_leaning_out')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>