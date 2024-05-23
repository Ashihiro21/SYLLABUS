<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['tloNumber'], $_POST['id'])) {
    $tloNumber = mysqli_real_escape_string($connection, $_POST['tloNumber']);
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $query = "UPDATE course_leaning SET topic_learn_out = '$tloNumber' WHERE id = '$id'";
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
