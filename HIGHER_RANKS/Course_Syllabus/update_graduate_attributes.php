<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id12'];
    
    $graduate_att = $_POST['graduate_att'];
    $descriptors_learn_out = $_POST['descriptors_learn_out'];
    
    $query = "UPDATE graduates_attributes SET graduate_att='$graduate_att', descriptors_learn_out='$descriptors_learn_out' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>