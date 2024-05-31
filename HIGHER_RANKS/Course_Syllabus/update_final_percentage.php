<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id50'];
    
    $final_description = $_POST['final_description'];
    $final_percents = $_POST['final_percents'];
    
    $query = "UPDATE final_percent SET final_description='$final_description', final_percents='$final_percents' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>