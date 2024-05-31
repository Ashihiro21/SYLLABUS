<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];
    
    $description = $_POST['description'];

    
    $query = "UPDATE `course_policies` SET `description`='$description'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../course_syllabus.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>
