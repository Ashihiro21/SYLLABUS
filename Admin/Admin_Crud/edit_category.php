<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];
    
    $name = $_POST['name'];
    $initial = $_POST['initial'];
    $dean_name = $_POST['dean_name'];
    
    $query = "UPDATE category SET name='$name', initial='$initial' , dean_name='$dean_name' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../department.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>



<?php
// update_signature.php

// Upload directory
$uploadDirectory = "../Admin/uploads/"; // Path to the directory where you want to store the files

// Directory where the file will be stored in the database
$postDirectory = "../Admin/uploads/"; // Directory path relative to the server root

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
    $update_id = $_POST['update_id'];
    $name = $_POST['name'];
    $initial = $_POST['initial'];
    $dean_name = $_POST['dean_name'];

    // Handle the file upload
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));

    // Create the upload directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    // Attempt to upload the file
    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $uploadDirectory . basename($_FILES["logo"]["name"]))) {
        // File uploaded successfully, now update the database

        // Get the file name without the directory
        $filename = basename($_FILES["logo"]["name"]);

        // Add the directory to the filename
        $filenameWithPath = $postDirectory . $filename;

        // SQL query to update the database
        $sql = "UPDATE category SET name='$name', initial='$initial', dean_name='$dean_name', logo = '$filenameWithPath' WHERE id = $update_id";

        // Execute the query
        if($conn->query($sql) === TRUE){
            // Record updated successfully
          header("Location: ../department.php");
        } else{
            // Error updating record
            echo "ERROR: Could not execute $sql. " . $conn->error;
        }
    } else {
      header("Location: ../department.php");
    }
}

// Close the database connection
$conn->close();
?>