<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id9'];
    
    $term = $_POST['term'];
    $year = $_POST['year'];
    $second_call = $_POST['second_call'];
    
    $query = "UPDATE semestral SET term='$term', year='$year', second_call='$second_call' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>