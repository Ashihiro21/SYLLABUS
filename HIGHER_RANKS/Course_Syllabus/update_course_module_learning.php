<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata3'])) {   
    $id = $_POST['update_id3'];
    
    $module_no = $_POST['module_no'];
    $title = $_POST['title'];
    $week = $_POST['week'];
    $date = $_POST['date'];
    $teaching_activities = $_POST['teaching_activities'];
    $technology = $_POST['technology'];
    $onsite = $_POST['onsite'];
    $asy = $_POST['asy'];
    $alloted_hours = $_POST['alloted_hours'];
    
    $query = "UPDATE module_learning SET module_no='$module_no', title='$title', week='$week', date='$date', teaching_activities='$teaching_activities' , technology='$technology', onsite='$onsite', asy='$asy', hours='$alloted_hours'  WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>