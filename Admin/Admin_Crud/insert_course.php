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
    $catid = $_POST['catid'];
    $cname = $_POST['cname'];
    $initial = $_POST['initial'];
    $course_department = $_POST['course_department'];
    $department_name = $_POST['department_name'];
    $department_position = $_POST['department_position'];

    $sql = "INSERT INTO  course (`catid`, `cname`,`initial`,`course_department`,`department_name`,`department_position`)
    VALUES ('$catid','$cname','$initial', '$course_department','$department_name','$department_position')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../course.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
