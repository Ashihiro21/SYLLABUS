<?php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "syllabus");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Outer query
$outerQuery = "SELECT learn_out FROM course_leaning";
$outerResult = $mysqli->query($outerQuery);

if ($outerResult->num_rows > 0) {
    while ($author = $outerResult->fetch_assoc()) {
        echo "Author: " . $author['learn_out'] . "<br>";

        // Inner query using the author id
        $innerQuery = "SELECT final_topic_leaning_out FROM laerning_final WHERE final_topic_leaning_out	 = ?";
        $stmt = $mysqli->prepare($innerQuery);
        $stmt->bind_param("i", $author['id']);
        $stmt->execute();
        $innerResult = $stmt->get_result();

        if ($innerResult->num_rows > 0) {
            while ($learning = $innerResult->fetch_assoc()) {
                echo "&emsp;learning: " . $learning['final_topic_leaning_out'] . "<br>";
            }
        } else {
            echo "&emsp;No learnings found for this author.<br>";
        }
    }
} else {
    echo "No authors found.";
}

// Close connection
$mysqli->close();
?>
