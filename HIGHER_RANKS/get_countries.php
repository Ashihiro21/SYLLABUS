<?php
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch countries from the database
$sql = "SELECT `id`, `name` FROM category";
$result = $conn->query($sql);

// Generate the dropdown options
$options = '<select id="countrySelect" class="form-control">';
$options .= '<option value="">Select Country</option>';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
}

$options .= '</select>';
echo $options;

$conn->close();
?>
