<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];
    
    $name = $_POST['name'];
    $initial = $_POST['initial'];
    
    $query = "UPDATE category SET name='$name', initial='$initial' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../department.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>