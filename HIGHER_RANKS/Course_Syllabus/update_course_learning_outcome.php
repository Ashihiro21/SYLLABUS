<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];
    
    $comlab = $_POST['comlab'];
    $learn_out = $_POST['learn_out'];
    
    $query = "UPDATE course_leaning SET comlab='$comlab', learn_out='$learn_out' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>