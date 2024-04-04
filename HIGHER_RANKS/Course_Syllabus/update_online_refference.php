<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id8'];
    
    $e_provider = $_POST['e_provider'];
    $refference_material = $_POST['refference_material'];
    
    $query = "UPDATE online_refference SET e_provider='$e_provider', refference_material='$refference_material' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>