<?php

$uploadDirectory = "../Admin/uploads/";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (isset($_POST['insertdata'])) {
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION));

    // Validate file type
    $validFileTypes = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $validFileTypes)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Validate file size (limit to 5MB)
    if ($_FILES["logo"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Create the upload directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
        if (!mkdir($uploadDirectory, 0777, true)) {
            echo "Failed to create directory.";
            $uploadOk = 0;
        }
    }

    if ($uploadOk == 1) {
        // Sanitize the filename
        $filename = basename($_FILES["logo"]["name"]);
        $filename = preg_replace("/[^a-zA-Z0-9\._-]/", "", $filename);

        // Generate a unique filename to avoid overwriting
        $filenameWithPath = $uploadDirectory . uniqid() . "_" . $filename;

        // Attempt to upload the file
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $filenameWithPath)) {
            // File uploaded successfully, now update the database

            $name = $_POST['name'];
            $initial = $_POST['initial'];
            $dean_name = $_POST['dean_name'];

            // Prepare the SQL statement to prevent SQL injection
            $stmt = $connection->prepare("INSERT INTO category (`name`, `initial`, `dean_name`, `logo`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $initial, $dean_name, $filenameWithPath);

            if ($stmt->execute()) {
                echo '<script>alert("Data Saved");</script>';
                header('Location: ../department.php');
                exit(); // Ensure the script stops execution after redirect
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    }
}

$connection->close();
?>
