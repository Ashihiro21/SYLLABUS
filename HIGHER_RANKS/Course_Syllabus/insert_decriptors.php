<?php

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

if(isset($_POST['insertdata']))
{
    $program_learn = $_POST['program_learn'];
    $rate1 = $_POST['rate1_s'];
    $rate2 = $_POST['rate2_s'];
    $rate3 = $_POST['rate3_s'];
    $rate4 = $_POST['rate4_s'];
    $rate5 = $_POST['rate5_s'];
    $department = $_POST['department'];
    $catid = $_POST['catid'];
    

    $sql = "INSERT INTO decriptors (`program_learn`, `rate1` , `rate2` , `rate3` , `rate4` , `rate5`,`department`,`catid`)
    VALUES ('$program_learn', '$rate1' , '$rate2' , '$rate3' , '$rate4' , '$rate5', '$department','$catid')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
