<?php
// update_signature.php

// Upload directory
$uploadDirectory = "../uploads/"; // Path to the directory where you want to store the files

// Directory where the file will be stored in the database
$postDirectory = "uploads/"; // Directory path relative to the server root

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if(isset($_POST['updatedata'])) {
    // Get the form data
    $update_id23 = $_POST['update_id23'];

    // Handle the file upload
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["dean_signature"]["name"], PATHINFO_EXTENSION));

    // Create the upload directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Attempt to upload the file
    if (move_uploaded_file($_FILES["dean_signature"]["tmp_name"], $uploadDirectory . basename($_FILES["dean_signature"]["name"]))) {
        // File uploaded successfully, now update the database

        // Get the file name without the directory
        $filename = basename($_FILES["dean_signature"]["name"]);

        // Add the directory to the filename
        $filenameWithPath = $postDirectory . $filename;

        // SQL query to update the database
        $sql = "UPDATE category SET dean_signature = '$filenameWithPath' WHERE id = $update_id23";

        // Execute the query
        if($conn->query($sql) === TRUE){
            // Record updated successfully
            echo "Records were updated successfully.";
            header('Location: ../dashboard.php');
            exit; //
        } else{
            // Error updating record
            echo "ERROR: Could not execute $sql. " . $conn->error;
        }
    } else {
        header('Location: ../dashboard.php');
    }
}

// Close the database connection
$conn->close();
?>
