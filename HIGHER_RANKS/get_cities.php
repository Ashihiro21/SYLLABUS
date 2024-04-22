<?php
// Database connection
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['catid'])) {
    $categoryId = $_POST['catid'];

    $sql = "SELECT * FROM course WHERE catid = $categoryId";
    $result = $conn->query($sql);

    // Generate the course dropdown
    $courseDropdown = '<select id="courseSelect" class="form-control">';

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Check if this is the first iteration, then set it as selected
            $selected = ($row['catid'] == 1) ? 'selected' : '';
            $courseDropdown .= '<option value="'.$row['catid'].'" '.$selected.'>'.$row['cname'].'</option>';
        }
    }

    $courseDropdown .= '</select>';
    echo $courseDropdown;
} else {
    echo 'Invalid request!';
}

$conn->close();
?>
