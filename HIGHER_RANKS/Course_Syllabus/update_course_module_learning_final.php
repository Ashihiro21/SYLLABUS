<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata15'])) {   
    $id = $_POST['update_id15'];
    
    $module_no = $_POST['module_no'];
    $week = $_POST['week'];
    $date = $_POST['date'];
    $teaching_activities = $_POST['teaching_activities'];
    $technology = $_POST['technology'];
    $onsite = $_POST['onsite1'];
    $asy = $_POST['asy1'];
    $alloted_hours2 = $_POST['alloted_hours2'];
    
    $query = "UPDATE module_learning_final SET module_no='$module_no', week='$week', date='$date', teaching_activities='$teaching_activities' , technology='$technology', onsite='$onsite', asy='$asy', hours='$alloted_hours2'  WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>