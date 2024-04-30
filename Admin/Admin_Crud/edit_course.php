<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {
    $id = $_POST['update_id'];
    
    $catid = $_POST['catid'];
    $cname = $_POST['cname'];
    $initial = $_POST['initial'];
    $course_department = $_POST['course_department'];
    $department_name = $_POST['department_name'];
    $department_position = $_POST['department_position'];
    
    $query = "UPDATE `course` SET `catid`='$catid', `cname`='$cname', `initial`='$initial', `course_department`='$course_department', `department_name`='$department_name',`department_position`='$department_position' WHERE `id`='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../course.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}
?>
