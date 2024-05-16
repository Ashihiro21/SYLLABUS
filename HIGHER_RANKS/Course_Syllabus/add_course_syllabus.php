<?php
// Database credentials
$servername = "localhost"; // Change this to your database host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "syllabus"; // Change this to your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $course_code = $connection->real_escape_string($_POST["course_code"]);
    $course_tittle = $connection->real_escape_string($_POST["course_tittle"]);
    $course_Type = $connection->real_escape_string($_POST["course_Type1"]);
    $course_credit = $connection->real_escape_string($_POST["course_credit"]);
    $learning_modality = $connection->real_escape_string($_POST["learning_modality1"]);
    $pre_requisit = $connection->real_escape_string($_POST["pre_requisit"]);
    $co_pre_requisit = $connection->real_escape_string($_POST["co_pre_requisit"]);
    $professor = $connection->real_escape_string($_POST["professor"]);
    $consultation_hours_date = $connection->real_escape_string($_POST["consultation_hours_date"]);
    $consultation_hours_room = $connection->real_escape_string($_POST["consultation_hours_room"]);
    $consultation_hours_email = $connection->real_escape_string($_POST["consultation_hours_email"]);
    $consultation_hours_number = $connection->real_escape_string($_POST["consultation_hours_number"]);
    $course_description = $connection->real_escape_string($_POST["course_description"]);
    $department = $connection->real_escape_string($_POST["department"]);
    $catid = $connection->real_escape_string($_POST["catid"]);

    // Attempt to insert data into database
    $sql = "INSERT INTO course_syllabus (course_code, course_tittle, course_Type, course_credit, learning_modality, pre_requisit, co_pre_requisit, professor, consultation_hours_date, consultation_hours_room, consultation_hours_email, consultation_hours_number, course_description, department, catid) VALUES ('$course_code', '$course_tittle', '$course_Type', '$course_credit', '$learning_modality', '$pre_requisit', '$co_pre_requisit', '$professor', '$consultation_hours_date', '$consultation_hours_room', '$consultation_hours_email', '$consultation_hours_number', '$course_description','$department','$catid')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

// Close database connection
$connection->close();
?>
