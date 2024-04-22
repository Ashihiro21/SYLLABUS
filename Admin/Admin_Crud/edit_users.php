<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department = $_POST['department'];
    $catid = $_POST['catid'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    
    
    $query = "UPDATE `users` SET first_name='$first_name', last_name='$last_name', department='$department', catid='$catid', phone_number='$phone_number', email='$email', position='$position' WHERE id='$id'";
    
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../users.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>
