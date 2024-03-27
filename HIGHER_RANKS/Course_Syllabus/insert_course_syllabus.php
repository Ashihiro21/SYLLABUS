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
    $course_code = $_POST['course_code'];
    $course_tittle = $_POST['course_tittle'];
    $course_Type = $_POST['course_Type'];
    $course_credit = $_POST['course_credit'];
    $learning_modality = $_POST['learning_modality'];
    $pre_requisit = $_POST['pre_requisit'];
    $co_pre_requisit = $_POST['co_pre_requisit'];
    $professor = $_POST['professor'];
    $consultation_hours = $_POST['consultation_hours'];

    $sql = "INSERT INTO course_syllabus (`course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours`)
    VALUES ('$course_code', '$course_tittle', '$course_Type', '$course_credit', '$learning_modality', '$pre_requisit', '$co_pre_requisit', '$professor', '$consultation_hours')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
