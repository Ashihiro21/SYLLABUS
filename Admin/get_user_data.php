<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if user_id is set and not empty
if(isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    // Sanitize the user_id to prevent SQL injection
    $user_id = $conn->real_escape_string($_POST['user_id']);
    
    // Prepare SQL statement to fetch user data
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    
    // Execute SQL statement
    $result = $conn->query($sql);
    
    // Check if there is a result
    if ($result->num_rows > 0) {
        // Fetch user data
        $row = $result->fetch_assoc();
        
        // Encode user data as JSON and output it
        echo json_encode($row);
    } else {
        // No user found with the given ID
        echo json_encode(array('error' => 'User not found'));
    }
} else {
    // No user ID provided
    echo json_encode(array('error' => 'User ID not provided'));
}

// Close database connection
$conn->close();
?>
