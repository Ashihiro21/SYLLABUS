<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];

    $name = $_POST['name'];
  
    
    $query = "UPDATE `position` SET `name`='$name' WHERE `id`='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../position.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>
