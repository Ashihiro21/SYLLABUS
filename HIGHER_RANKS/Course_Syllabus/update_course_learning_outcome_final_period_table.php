<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedatatable'])) {   
    $id = $_POST['update_id5'];
    
    $final_learning_out = $_POST['final_learning_out'];
    $final_topic_leaning_out = $_POST['final_topic_leaning_out'];
    
    $query = "UPDATE laerning_final SET final_learning_out='$final_learning_out', final_topic_leaning_out='$final_topic_leaning_out' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>