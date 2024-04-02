<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedatatable'])) {   
    $id = $_POST['update_id1'];
    
    $topic_learn_out = $_POST['topic_learn_out'];
    
    $query = "UPDATE course_leaning SET topic_learn_out='$topic_learn_out' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>