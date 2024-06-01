<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id22'];
    
    $chair_signature = $_POST['chair_signature'];
    $chair_comment = $_POST['department_chair_comments'];
  
    
    $query = "UPDATE course SET `dept_signature`='$chair_signature', `chair_comment`='$chair_comment'  WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>