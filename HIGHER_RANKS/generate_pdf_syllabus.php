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
        $department = $row['department'];
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

$sql = mysqli_query($conn,"SELECT * FROM course_syllabus");
$user = mysqli_fetch_assoc($sql);

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Syllabus</title>
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
    padding: 10px;
    border-collapse: collapse;
    text-align:center;
}


table, tr, th, td{

    border: 1px solid black;
    padding: 15px;
    border-collapse: collapse;
}

.total{
    background-color: #ffbb33;
}



</style>

<body>
<img style="margin-left: 12rem; margin-top: 1rem;" src="../img/logos.png" alt="Image" width="190">

    <h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4>

    <h4 style="text-align:center;">COURSE SYLLABUS</h4>

    <span><a class="header">COURSE CODE</a><b><a style=" margin-left: 100px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_code'].'</a></span><br>
    <span><a class="header">COURSE TITLE</a><b><a style=" margin-left: 97px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_tittle'].'</a></span><br>
    <span><a class="header">COURSE TYPE</a><b><a style=" margin-left: 103px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_Type'].'</a></span><br>
    <span><a class="header">COURSE CREDIT</a><b><a style=" margin-left: 84px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_credit'].'</a></span><br>
    <span><a class="header">LEARNING MODALITY</a><b><a style=" margin-left: 36px; margin-right: 2rem;">:</a></b><a class="data">'.$user['learning_modality'].'</a></span><br>
    <span><a class="header">PRE-REQUISITES</a><b><a style=" margin-left: 82px; margin-right: 2rem;">:</a></b><a class="data">'.$user['pre_requisit'].'</a></span><br>
    <span><a class="header">CO-REQUISITES</a><b><a style=" margin-left: 90px; margin-right: 2rem;">:</a></b><a class="data">'.$user['co_pre_requisit'].'</a></span><br>
    <span><a class="header">CONSULTATION HOURS </a><b><a style=" margin-left: 22px; margin-right: 2rem;">:</a></b><a class="data">'.$user['consultation_hours_date'].'</a></span><br>
    <span><a class="" style=" margin-left: 253px; margin-right: 2rem;></a><a></a><a class="data">'.$user['consultation_hours_room'].'</a></span><br>
    <span><a class="" style=" margin-left: 253px; margin-right: 2rem; ></a><a></a><a class="data">'.$user['consultation_hours_email'].'</a></span><br>
    <span><a class="" style=" margin-left: 253px; margin-right: 2rem; ></a><a></a><a class="data">'.$user['consultation_hours_number'].'</a></span>

    <h4 style="">COURSE DESCRIPTION:</h4>
    
    <div class="box-description">
    <p class="indented-paragraph">'.$user['course_description'].'</p>
    </div>

    <h4 style="margin-top: 1rem;">COURSE LEARNING OUTCOMES:</h4>
    <a style="">By the end of this course, students are expected to:</a>
    <br><br>';

    // Fetch and display course learning outcomes
    $sql = "SELECT * FROM course_leaning ORDER BY id ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<a>'. $row['comlab'] ." . ". $row['learn_out'] . '</a><br><br>';
        }
    }

$html .= '

<h4 style="margin-top: 1rem;">LEARNING PLAN:</h4>
<b style="">Learning Outcomes for Midterm Period:</b>
<table>';
// LEARNING PLAN
// Learning Outcomes for Midterm Period

$html .= '<tr>';
$html .= '<th>Course Learning Outcomes</th>';
$html .= '<th>Topic Learning Outcomes</th>';
$html .= '</tr>';

$sql = "SELECT * FROM course_leaning ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>'. $row['comlab'] ." . ". $row['learn_out'] . '</td>';
        $html .= '<td>';
        if (strpos($row['topic_learn_out'], 'TLO') !== false || strpos($row['topic_learn_out'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            $html .= str_replace(array('', "\n"), '<br>', $row['topic_learn_out']);
        } else {
            $html .= $row['topic_learn_out'];
        }
        $html .= '</td>';
        $html .= '</tr>';
    }
}



$html .= '<table class="teaching_guid">';
$html .= '<tr>';
$html .= '<th class="teaching_guid">Module No and Learning Outcomes</th>';
$html .= '<th class="teaching_guid">Week No</th>';
$html .= '<th class="teaching_guid">Teaching-Learning Activities / Assessment Strategy</th>';
$html .= '<th class="teaching_guid">Technology Enabler</th>';
$html .= '<th class="teaching_guid">Onsite / F2F</th>';
$html .= '<th class="teaching_guid">Asynchronous</th>';
$html .= '<th class="teaching_guid">Alloted Hours</th>';
$html .= '</tr>';

$sql = "SELECT * FROM module_learning";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $total_hour_query = "SELECT 
        SUM(hours) as total_hours, 
        SUM(asy) as total_asy_hours,
        SUM(onsite) as total_onsite_hours 
    FROM module_learning";
    $total_hour_result = mysqli_query($conn, $total_hour_query);
    $total_hour_row = mysqli_fetch_assoc($total_hour_result);
    
    $total_hour = $total_hour_row['total_hours'];
    $total_asy_hours = $total_hour_row['total_asy_hours'];
    $total_onsite_hours = $total_hour_row['total_onsite_hours'];

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td class="teaching_guid">';
        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            $html .= str_replace(array('', "\n"), '<br>', $row['module_no']);
        } else {
            $html .= $row['module_no'];
        }
        $html .= '<td class="teaching_guid">'. $row['week'] . $row['date'] . '</td>';
        $html .= '<td class="teaching_guid">';
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If '•' or a line break is found, replace it with <br>
            $html .= str_replace(array('•', "\n"), '<br>', $row['teaching_activities']);
        } else {
            $html .= $row['teaching_activities'];
        }
        $html .= '</td>';
        $html .= '<td class="teaching_guid">'. $row['technology'] . '</td>';
        $html .= '<td class="teaching_guid onsite" style="padding: 10px;">'. ($row['onsite'] == 1 ? '/' : ''
        ) . '</td>';
        $html .= '<td class="teaching_guid asy" style="padding: 10px;">'. ($row['asy'] == 1 ? '/' : '') . '</td>';
        $html .= '<td class="teaching_guid">'. $row['hours'] . '</td>';
        $html .= '</tr>';
    }
    
    // Total row
    $html .= '<tr class="total">';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;" colspan="4">TOTAL</td>';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;">'.$total_onsite_hours.'</td>';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;">'.$total_asy_hours.'</td>';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;">'.$total_hour.'</td>';
    $html .= '</tr>';
}

$html .= '</table>



</body>
</html>';

// Close connection

$dompdf->loadHtml($html);

$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->set_option('isPhpEnabled', true);
$dompdf->set_option('defaultFont', '✔');

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render PDF (optional: you can set other options like DPI, font etc.)
$dompdf->render();

// Output PDF
$dompdf->stream('Syllabus.pdf', array('Attachment' => 0));
?>


