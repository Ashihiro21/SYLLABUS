<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id'];
    
    $course_code = $_POST['course_code'];
    $course_tittle = $_POST['course_tittle'];
    $course_Type = $_POST['course_Type'];
    $course_credit = $_POST['course_credit'];
    $learning_modality = $_POST['learning_modality'];
    $pre_requisit = $_POST['pre_requisit'];
    $co_pre_requisit = $_POST['co_pre_requisit'];
    $professor = $_POST['professor'];
    $consultation_hours = $_POST['consultation_hours'];
    $course_description = $_POST['course_description'];
    
    $query = "UPDATE course_syllabus SET course_code='$course_code', course_tittle='$course_tittle', course_Type='$course_Type', course_credit='$course_credit', learning_modality='$learning_modality', pre_requisit='$pre_requisit', co_pre_requisit='$co_pre_requisit',  professor='$professor', consultation_hours='$consultation_hours', course_description='$course_description' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>