<?php
session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

include('../Database/connection.php');

$email = $_SESSION['email'];
$sql = "SELECT 
            u.`first_name`, 
            u.`last_name`, 
            u.`department`, 
            u.`catid`, 
            u.`phone_number`, 
            u.`email`, 
            u.`password`, 
            p.`name` AS `position`,
            c.`id` AS `id`,
            c.`name` AS `category_name`,
            c.`initial` AS `category_initial`,
            c.`dean_name` AS `deans`,
            c.`dean_position` AS `deans_position`,
            c.`dean_signature` AS `dean_signatures`,
            co.`cname`,
            co.`course_department` AS `course_departments`,
            co.`initial` AS `course_initial`,
            co.`department_name` AS `course_dept_name`,
            co.`department_position` AS `dept_position`,
            co.`dept_signature` AS `dept_signatures`
        FROM 
            `users` AS u 
        LEFT JOIN 
            `position` AS p ON u.`position` = p.`id`
        LEFT JOIN 
            `category` AS c ON u.`department` = c.`id`
        LEFT JOIN
            `course` AS co ON u.`catid` = co.`id`
        WHERE 
            u.email = '$email'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $_SESSION['department'] = $row['department']; 
        $courses = $row['catid'];
        $phone_number = $row['phone_number'];
        $email = $row['email'];
        $password = $row['password'];
        $position = $row['position'];
        $category_name = $row['category_name'];
        $category_initial = $row['category_initial'];
        $cname = $row['cname'];
        $course_initial = $row['course_initial'];
        $course_departments = $row['course_departments'];
        $category_dean = $row['deans'];
        $category_dean_position = $row['deans_position'];
        $dept_head = $row['course_dept_name'];
        $dept_head_position = $row['dept_position'];
        $dept_head_signature = $row['dept_signatures'];
        $deans_category_signature = $row['dean_signatures'];
    }
} 

$department = $_SESSION['department']; 
$sql = mysqli_query($conn,"SELECT * FROM course_syllabus");
$user = mysqli_fetch_assoc($sql);

$sql4 = mysqli_query($conn,"SELECT * FROM semestral");
$user4 = mysqli_fetch_assoc($sql4);

$sql5 = mysqli_query($conn,"SELECT * FROM module_learning");
$user5 = mysqli_fetch_assoc($sql5);

$sql = "SELECT * FROM course_leaning";




require_once 'dompdf/autoload.inc.php'; // Include Dompdf autoload file

use Dompdf\Dompdf;

// Initialize Dompdf
$dompdf = new Dompdf();


$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="icon" type="image/png" href="../img/DLSU-D.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>SYLLABUS</title>
</head>

<style>
/* Add margins to the page */
body {
    margin: 20px;   
}
.header{
    font-weight:bold;
}
.space{
    margin-left: 3rem;
    margin-right: 3rem;
}

.indented-paragraph {
    text-indent: 65px;
}
.box-description{
    
}


.list{
    margin-top: 5rem;
}


.teaching_guid{
    border: 1px solid black;
    padding-bottom: -20rem;
    border-collapse: collapse;
    text-align:center;
}


table, tr, th, td{

    border: 1px solid black;
    padding: 10px;
    border-collapse: collapse;
}

.total{
    background-color: #ffbb33;
}

.container{
    margin-left: 2rem;
}

.checkmark {
  width: 30px;
  height: 30px;
  background-color: #ffffff;

  border-radius: 50%;
  position: relative;
}

.checkmark:after {
  content: "";
  width: 10px;
  height: 20px;
  border: solid #000000;
  border-width: 0 2px 2px 0;
  position: absolute;
  top: 7px;
  left: 9px;
  transform: rotate(45deg);
}



</style>

<body>
<img style="margin-left: 16rem; margin-top: 1rem;" src="../img/logos.png" alt="Image" width="190">

    <h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4>

    <h4 style="text-align:center;">COURSE SYLLABUS</h4>';
 
    
    $department = $_SESSION['department'];
    // Using prepared statement to prevent SQL injection
    $sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $department);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Properly formatted HTML output
          
          $html .='  <span><a class="header">COURSE CODE</a><b><a style=" margin-left: 100px; margin-right: 2rem;">:</a></b><a class="data">'.$row['course_code'].'</a></span><br>';
          $html .='<span><a class="header">COURSE TITLE</a><b><a style=" margin-left: 97px; margin-right: 2rem;">:</a></b><a class="data">'.$row['course_tittle'].'</a></span><br>';
          $html .='<span><a class="header">COURSE TYPE</a><b><a style=" margin-left: 103px; margin-right: 2rem;">:</a></b><a class="data">'.$row['course_Type'].'</a></span><br>';
          $html .=' <span><a class="header">COURSE CREDIT</a><b><a style=" margin-left: 84px; margin-right: 2rem;">:</a></b><a class="data">'.$row['course_credit'].'</a></span><br>';
          $html .='<span><a class="header">LEARNING MODALITY</a><b><a style=" margin-left: 36px; margin-right: 2rem;">:</a></b><a class="data">'.$row['learning_modality'].'</a></span><br>';
          $html .='<span><a class="header">PRE-REQUISITES</a><b><a style=" margin-left: 82px; margin-right: 2rem;">:</a></b><a class="data">'.$row['pre_requisit'].'</a></span><br>';
          $html .='<span><a class="header">CO-REQUISITES</a><b><a style=" margin-left: 90px; margin-right: 2rem;">:</a></b><a class="data">'.$row['co_pre_requisit'].'</a></span><br>';
    
        }
    } 









$dompdf->loadHtml($html);

$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->set_option('isPhpEnabled', true);
$dompdf->set_option('defaultFont', '/');

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render PDF (optional: you can set other options like DPI, font etc.)
$dompdf->render();

// Output PDF
$dompdf->stream('Syllabus.pdf', array('Attachment' => 0));
?>

