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
    $rate1 = $_POST['rate1'];
    $rate2 = $_POST['rate2'];
    $rate3 = $_POST['rate3'];
    $rate4 = $_POST['rate4'];
    $rate5 = $_POST['rate5'];
    

    $sql = "INSERT INTO decriptors (`program_learn`, `rate1` , `rate2` , `rate3` , `rate4` , `rate5`)
    VALUES ('$program_learn', '$rate1' , '$rate2' , '$rate3' , '$rate4' , '$rate5')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
