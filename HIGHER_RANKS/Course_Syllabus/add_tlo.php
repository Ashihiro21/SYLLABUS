<?php
// Database connection
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the TLO number and ID are set in the POST request
if (isset($_POST['tloNumber']) && isset($_POST['id'])) {
    $tloNumber = mysqli_real_escape_string($connection, $_POST['tloNumber']);
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    // Check if a row with the given ID exists
    $query = "SELECT * FROM course_leaning WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        // If a row with the given ID exists, insert the data into the `learn_out` column
        $query = "UPDATE course_leaning SET learn_out = CONCAT(learn_out, '\n', '$tloNumber') WHERE id = '$id'";
    } else {
        // If a row with the given ID does not exist, insert the data into the `topic_learn_out` column
        $query = "INSERT INTO course_leaning (topic_learn_out) VALUES ('$tloNumber')";
    }

    if (mysqli_query($connection, $query)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "invalid input";
}

// Close the connection
mysqli_close($connection);
?>
