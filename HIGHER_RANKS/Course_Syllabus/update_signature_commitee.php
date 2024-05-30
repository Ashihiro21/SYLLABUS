<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id45'];
    
    $commitee_signature = $_POST['commitee_signature'];
    $commitee_comment = $_POST['commitee_comment'];
  
    
    $query = "UPDATE course SET `commitee_signature`='$commitee_signature', `commitee_comment`='$commitee_comment'  WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>