<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id20'];
    
    $description = $_POST['description'];
    $percents = $_POST['percents'];
    
    $query = "UPDATE percent SET description='$description', percents='$percents' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>