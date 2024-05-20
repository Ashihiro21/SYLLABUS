<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id']) && isset($_POST['tloNumber'])) {
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $tloNumber = mysqli_real_escape_string($connection, $_POST['tloNumber']);
    $department = $_SESSION['department'];
    $catid = $_SESSION['catid'];

    $query = "UPDATE course_leaning SET learn_out = '$tloNumber' WHERE id = '$id' AND department='$department' AND catid='$catid'";
    if (mysqli_query($connection, $query)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
} else {
    echo "Invalid input";
}

mysqli_close($connection);
?>
