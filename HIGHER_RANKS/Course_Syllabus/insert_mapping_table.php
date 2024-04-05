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
    $learn_out_mapping = $_POST['learn_out_mapping'];
    $pl1 = $_POST['pl1'];
    $pl2 = $_POST['pl2'];
    $pl3 = $_POST['pl3'];
    $pl4 = $_POST['pl4'];
    $pl5 = $_POST['pl5'];
    $pl6 = $_POST['pl6'];
    $pl7 = $_POST['pl7'];
    $pl8 = $_POST['pl8'];
    $pl9 = $_POST['pl9'];

    $sql = "INSERT INTO mapping_table (`learn_out_mapping`, `pl1` , `pl2` , `pl3` , `pl4` , `pl5` , `pl6` , `pl7` , `pl8` , `pl9`)
    VALUES ('$learn_out_mapping', '$pl1' , '$pl2' , '$pl3' , '$pl4' , '$pl5' , '$pl6' , '$pl7' , '$pl8' , '$pl9')";

    if ($connection->query($sql) === TRUE) {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../dashboard.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}

$connection->close();
?>
