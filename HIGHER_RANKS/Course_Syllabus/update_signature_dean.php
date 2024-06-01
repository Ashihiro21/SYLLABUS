<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id23'];
    
    $dean_signature = $_POST['dean_signature'];
    $dean_comment = $_POST['department_dean_comments'];
  
    
    $query = "UPDATE course SET `dean_signature`='$dean_signature', `dean_comment`='$dean_comment'  WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>