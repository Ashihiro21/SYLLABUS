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
    $module_no = $_POST['module_no'];
    $week = $_POST['week'];
    $date = $_POST['date'];
    $teaching_activities = $_POST['teaching_activities'];
    $technology = $_POST['technology'];
    $onsite = $_POST['onsite'];
    $asy = $_POST['asy'];
    $hours = $_POST['hours'];
    $department = $_POST['department'];

    $sql = "INSERT INTO module_learning_final (`module_no`, `week` , `date` , `teaching_activities` , `technology` , `onsite` , `asy`, `hours`, `department`)
    VALUES ('$module_no', '$week' , '$date' , '$teaching_activities' , '$technology' , '$onsite' , '$asy', '$hours', '$department')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
