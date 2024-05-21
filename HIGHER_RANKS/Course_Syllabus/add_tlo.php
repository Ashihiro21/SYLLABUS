<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['tloNumber'])) {
    $tloNumber = mysqli_real_escape_string($connection, $_POST['tloNumber']);
    $department = $_SESSION['department'];
    $catid = $_SESSION['catid'];

    $query = "INSERT INTO course_leaning (topic_learn_out, department, catid) VALUES ('$tloNumber', '$department', '$catid')";
    if (mysqli_query($connection, $query)) {
        echo "success";
    } else {
        echo "Error: " . mysqli_error($connection);
    }
} else {
    echo "Invalid input";
}

mysqli_close($connection);
?>
