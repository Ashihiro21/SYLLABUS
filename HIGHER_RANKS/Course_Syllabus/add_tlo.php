<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['tloNumber'])) {
    $tloNumber = mysqli_real_escape_string($connection, $_POST['tloNumber']);
<<<<<<< Updated upstream
    $department = $_SESSION['department'];
    $catid = $_SESSION['catid'];
=======
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    // Check if a row with the given ID exists
    $query = "SELECT * FROM course_leaning WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // If a row with the given ID exists, insert the data into the `learn_out` column
        $query = "UPDATE course_leaning SET learn_out = CONCAT(learn_out, '\n', '$tloNumber') WHERE id = '$id'";
    } else {
        // If a row with the given ID does not exist, insert the data into the `topic_learn_out` column
        $query = "INSERT INTO course_leaning (`topic_learn_out`) VALUES ('$tloNumber')";
    }
>>>>>>> Stashed changes

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
