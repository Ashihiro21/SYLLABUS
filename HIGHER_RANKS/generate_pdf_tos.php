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

// Load HTML content
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



table, tr, th, td{

    border: 1px solid black;
    border-collapse: collapse;
}
th{
    text-align:center
}



</style>

<body>
<img style="margin-left: 16rem; margin-top: 1rem;" src="../img/logos.png" alt="Image" width="190">

    <h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4>

    <h4 style="text-align:center;">TABLE OF SPECIFICATION FOR SUMMATIVE EXAM</h4>';

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
          $html .='<span><a class="header">CO-REQUISITES</a><b><a style=" margin-left: 90px; margin-right: 2rem;">:</a></b><a class="data">'.$row['co_pre_requisit'].'</a></span><br><br><br><br>';
        }
    } 

    $html .='<table>';
    // LEARNING PLAN
    // Learning Outcomes for Midterm Period

    $html .= '<tr>';

    $html .= '<th>Instructional Objectives</th>';
    $html .= '<th>Time Spent on Topic</th>';
    $html .= '<th>Percent of Class Time on Topic</th>';

    $html .= '<th>Number of Test Items</th>';
    
    $html .= '<th>Lower Processes<br>';
    $html .='<div style="text-align:left; margin-left: 24px;">';
    $html .= '•  Knowledge<br>';
    $html .= '•  Recall<br>';
    $html .= '•  Identification<br>';
    $html .= '•  Comprehension';
    $html .='</div>';
    $html .= '</th>';
    $html .= '<p></p>';
    $html .= '<th>Higher Processes<br>';
    $html .='<div style="text-align:left; margin-left: 35px;">';
    $html .= '•  Analysis<br>';
    $html .= '•  Synthesis<br>';
    $html .= '•  evaluation<br>';
    $html .='</div>';
    $html .= '</th>';

    $html .= '</tr>';


    $html .= '<tr>';
    $html .= '<td>example1';
    $html .= '</td>';
    $html .= '<td>example1';
    $html .= '</td>';
    $html .= '<td>example1';
    $html .= '</td>';
    $html .= '<td>example1';
    $html .= '</td>';
    $html .= '<td>example1';
    $html .= '</td>';
    $html .= '</td>';
    $html .= '<td>example1';
    $html .= '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>example2';
    $html .= '</td>';
    $html .= '<td>example2';
    $html .= '</td>';
    $html .= '<td>example2';
    $html .= '</td>';
    $html .= '<td>example2';
    $html .= '</td>';
    $html .= '<td>example2';
    $html .= '</td>';
    $html .= '</td>';
    $html .= '<td>example2';
    $html .= '</td>';
    $html .= '</tr>';

    $html .= '<tr>';
    $html .= '<td>example3';
    $html .= '</td>';
    $html .= '<td>example3';
    $html .= '</td>';
    $html .= '<td>example3';
    $html .= '</td>';
    $html .= '<td>example3';
    $html .= '</td>';
    $html .= '<td>example3';
    $html .= '</td>';
    $html .= '</td>';
    $html .= '<td>example3';
    $html .= '</td>';
    $html .= '</tr>';




    // $department = $_SESSION['department']; 

    // $sql = "SELECT * FROM course_leaning WHERE department = $department  ORDER BY id ASC";
    // $result = $conn->query($sql);
    // if ($result->num_rows > 0) {
    //     while ($row = $result->fetch_assoc()) {
    //         $html .= '<tr>';
    //         $html .= '<td>'. $row['comlab'] ." . ". $row['learn_out'] . '</td>';
    //         $html .= '<td>';
    //         if (strpos($row['topic_learn_out'], 'TLO') !== false || strpos($row['topic_learn_out'], "\n") !== false) {
                // If 'TLO' or a line break is found, replace it with <br>
                // $html .= str_replace(array('', "\n"), '<br>', $row['topic_learn_out']);
    //         } else {
    //             $html .= $row['topic_learn_out'];
    //         }
    //         $html .= '</td>';
    //         $html .= '</tr>';
    //     }
    // }

    $html .= '</table>';

   

    









$html .= '</body>';
$html .= '</html>';


// Close connection

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
