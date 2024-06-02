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
            c.logo AS category_logo,
            co.`dean_signature` AS `dean_signatures`,
            co.`cname`,
            co.`course_department` AS `course_departments`,
            co.`initial` AS `course_initial`,
            co.`department_name` AS `course_dept_name`,
            co.`department_position` AS `dept_position`,
            co.`dept_signature` AS `dept_signatures`,
            co.`commitee_signature` AS `commitee_signatures`
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
        $_SESSION['catid'] = $row['catid']; 
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
        $commitee_dept_signature = $row['commitee_signatures'];
        $categories_logo = $row['category_logo'];
    }
} 

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
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
    <link rel="icon" type="image/PNG" href="DLSU-D.png"/>
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
.inline-images {
    display: flex;
    align-items: center;
    margin-left: 30%;
}

.img-inline {
    display: inline-block;
    vertical-align: middle;
}


</style>

<body>

<span class="inline-images">
        <a><img src="../img/DLSU-D.png" style="margin-top:1rem;" width="100" class="mt-5" alt=""></a>
        <a><img class="img-inline" style="margin-left:7rem; margin-top:1rem;" src="../Admin/uploads/'. $categories_logo . '" alt="Image" width="100"></a>
        </span>
    
    <h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>
    <h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4>

    <h4 style="text-align:center;">COURSE SYLLABUS</h4>';
 
    
    $department = $_SESSION['department'];
    $catid = $_SESSION['catid']; 
    $catid = $_SESSION['catid'];
    // Using prepared statement to prevent SQL injection
    $sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department=? and catid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $department,$catid);
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
          $html .='<span><a class="header">PROFESSOR</a><b><a style=" margin-left: 120px; margin-right: 2rem;">:</a></b><a class="data">'.$row['professor'].'</a></span><br>';
          $html .='<span><a class="header">CONSULTATION HOURS </a><b><a style=" margin-left: 22px; margin-right: 2rem;">:</a></b><a class="data">'.$row['consultation_hours_date'].'</a></span><br>';
          $html .='<span><a class="" style=" margin-left: 253px; margin-right: 2rem;></a><a></a><a class="data">'.$row['consultation_hours_room'].'</a></span><br>';
          $html .='<span><a class="" style=" margin-left: 253px; margin-right: 2rem; ></a><a></a><a class="data">'.$row['consultation_hours_email'].'</a></span><br>';
          $html .='<span><a class="" style=" margin-left: 253px; margin-right: 2rem; ></a><a></a><a class="data">'.$row['consultation_hours_number'].'</a></span>';
          $html .='<h4 style="">COURSE DESCRIPTION:</h4>';
          $html .='<div class="box-description">';
          $html .='<p class="indented-paragraph" style="text-align: justify; text-justify: inter-word;">'.$row['course_description'].'</p>';
          $html .=' </div>';
    
        }
    } 

    
    
    $html .= '<h4 style="margin-top: 1rem;">COURSE LEARNING OUTCOMES:</h4>';
    $html .= '<a style="">By the end of this course, students are expected to:</a><br><br>';
    
    $department = $_SESSION['department'];
    $catid = $_SESSION['catid'];  
    $catid = $_SESSION['catid'];
    // Fetch and display course learning outcomes
    $sql = "SELECT * FROM course_leaning WHERE department = $department and catid = $catid ORDER BY id ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strpos($row['learn_out'], 'CLO') !== false || strpos($row['learn_out'], "\n") !== false) {
                // If a line break is found, replace it with <br>
                $output = str_replace("\n", '<br>', $row['learn_out']);
            } else {
                $output =$row['comlab'] .'.'. $row['learn_out'];
            }
            $html .= '<a>' . $output . '</a><br><br>';
            
            
        }
    }

    $department = $_SESSION['department'];
    $catid = $_SESSION['catid'];  
    // Fetch and display course learning outcomes
    $sql = "SELECT * FROM  laerning_final WHERE department = $department and catid = $catid ORDER BY id ASC";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strpos($row['final_learning_out'], 'CLO') !== false || strpos($row['final_learning_out'], "\n") !== false) {
                // If a line break is found, replace it with <br>
                $output = str_replace("\n", '<br>', $row['final_learning_out']);
            } else {
                $output = $row['comlab'] .'.'. $row['final_learning_out'];
            }
            $html .= '<a>' . $output . '</a><br><br>';
            
            
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

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  

$sql = "SELECT * FROM course_leaning WHERE department = $department and catid = $catid  ORDER BY id ASC";
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

$html .= '</table>';

$html .= '<table class="teaching_guid">';
$html .= '<tr style="height: 150px">';
$html .= '<th class="teaching_guid">Module No and Learning Outcomes</th>';
$html .= '<th width="" class="teaching_guid">Week</th>';
$html .= '<th width="200px" class="teaching_guid">Teaching-Learning Activities / Assessment Strategy</th>';
$html .= '<th style="" class="teaching_guid">Technology Enabler</th>';
$html .= '<th height="15%"><p style="transform: rotate(-90deg); white-space: nowrap; width: 1px;">Onsite / F2F</p></th>';
$html .= '<th height="15%"><p style="transform: rotate(-90deg); white-space: nowrap; width: 1px;">Asynchronous</p></th>';
$html .= '<th height="15%"><p style="transform: rotate(-90deg); white-space: nowrap; width: 1px;">Alloted Hours</p></th>';
$html .= '</tr>';

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
$sql = "SELECT * FROM module_learning WHERE department = $department and catid = $catid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $total_hour_query = "SELECT 
        SUM(hours) as total_hours, 
        SUM(asy) as total_asy_hours,
        SUM(onsite) as total_onsite_hours 
    FROM module_learning WHERE department = $department and catid = $catid";
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
        $html .= '<td width="70px" class="teaching_guid">'. $row['week'] ." ". $row['date'] . '</td>';
        $html .= '<td width="100px" style="text-align:left" class="teaching_guid">';
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If '•' or a line break is found, replace it with <br>
            $html .= str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
        } else {
            $html .= $row['teaching_activities'];
        }
        $html .= '</td>';
        $html .= '<td class="teaching_guid">'. $row['technology'] . '</td>';
        $html .= '<td class="teaching_guid onsite">'. ($row['onsite'] == 1 ? '/' : ''
        ) . '</td>';
        $html .= '<td class="teaching_guid asy">'. ($row['asy'] == 1 ? '/' : '') . '</td>';
        $html .= '<td class="teaching_guid">'. $row['hours'] . '</td>';
        $html .= '</tr>';
    }
    
    // Total row
    $html .= '<tr class="total">';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;" colspan="4"><b>TOTAL</b></td>';
    $html .= '<td class="teaching_guid onsite">'.$total_onsite_hours.'</td>';
    $html .= '<td class="teaching_guid onsite">'.$total_asy_hours.'</td>';
    $html .= '<td class="teaching_guid onsite">'.$total_hour.'</td>';
    $html .= '</tr>';
}

$html .= '</table>';

// FINAL PERIOD
$html .= '<b style="">Learning Outcomes for Final Period:</b>';
$html .= '<table>';


$html .= '<tr>';
$html .= '<th>Course Learning Outcomes</th>';
$html .= '<th>Topic Learning Outcomes</th>';
$html .= '</tr>';

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
$sql = "SELECT * FROM laerning_final WHERE department = $department and catid = $catid ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>'. $row['comlab'] ." . ". $row['final_learning_out'] . '</td>';
        $html .= '<td>';
        if (strpos($row['final_topic_leaning_out'], 'TLO') !== false || strpos($row['final_topic_leaning_out'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            $html .= str_replace(array('', "\n"), '<br>', $row['final_topic_leaning_out']);
        } else {
            $html .= $row['final_topic_leaning_out'];
        }
        $html .= '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';


$html .= '<table class="teaching_guid">';
$html .= '<tr style="height: 150px">';
$html .= '<th class="teaching_guid">Module No and Learning Outcomes</th>';
$html .= '<th width="100%" class="teaching_guid">Week</th>';
$html .= '<th width="200px" class="teaching_guid">Teaching-Learning Activities / Assessment Strategy</th>';
$html .= '<th style="" class="teaching_guid">Technology Enabler</th>';
$html .= '<th height="15%"><p style="transform: rotate(-90deg); white-space: nowrap; width: 1px;">Onsite / F2F</p></th>';
$html .= '<th height="15%"><p style="transform: rotate(-90deg); white-space: nowrap; width: 1px;">Asynchronous</p></th>';
$html .= '<th height="15%"><p style="transform: rotate(-90deg); white-space: nowrap; width: 1px;">Alloted Hours</p></th>';
$html .= '</tr>';


$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
$sql = "SELECT * FROM module_learning_final WHERE department = $department and catid = $catid ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $total_hour_query = "SELECT 
        SUM(hours) as total_hours, 
        SUM(asy) as total_asy_hours,
        SUM(onsite) as total_onsite_hours 
    FROM module_learning_final WHERE department = $department and catid = $catid";
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
        $html .= '<td width="70px" class="teaching_guid">'. $row['week'] ." ". $row['date'] . '</td>';
        $html .= '<td width="100px" style="text-align:left" class="teaching_guid">';
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If '•' or a line break is found, replace it with <br>
            $html .= str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
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
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;" colspan="4"><b>TOTAL</b></td>';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;">'.$total_onsite_hours.'</td>';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;">'.$total_asy_hours.'</td>';
    $html .= '<td class="teaching_guid onsite" style="padding: 10px;">'.$total_hour.'</td>';
    $html .= '</tr>';
}

$html .= '</table>';






$html .= '<style>';
$html .= '.tables { border: none; }'; // Remove table border
$html .= '.tables td, .tables th { border: none; }'; // Remove border for table cells and headers
$html .= '</style>';
$html .= '<h4 style="margin-top: 1rem; margin-left:20px">GRADING SYSTEM:</h4>';
$html .= '<p style="margin-left:20px; font-weight:bold; ">Midterm</p>';


$html .= '<table class="tables">';


$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
$sql = "SELECT * FROM percent WHERE department = $department and catid = $catid ORDER BY  id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent WHERE department = $department and catid = $catid";
    $total_percent_result = mysqli_query($conn, $total_percent_query);
    $total_percent_row = mysqli_fetch_assoc($total_percent_result);
    
    $total_percent = $total_percent_row['total_percent'];
    $html .= '<tr>';
    $html .= '</tr>';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td width="270px">'. $row['description'] . '</td>';
        $html .= '<td style="">'. $row['percents'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '<tr>';
    $html .="<td style='' colspan='5'>Total<a style='margin-left:15.9rem;'>$total_percent</a>%</td>";
    $html .= '</tr>';
}

$html .= '</table>';

$html .= '<p style="margin-left:20px; font-weight:bold; ">Finals</p>';


$html .= '<table class="tables">';


$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
$sql = "SELECT * FROM final_percent WHERE department = $department and catid = $catid ORDER BY  id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $total_final_percent_query = "SELECT SUM(`final_percents`) AS total_final_percent FROM final_percent WHERE department = $department and catid = $catid";
    $total_final_percent_result = mysqli_query($conn, $total_final_percent_query);
    $total_final_percent_row = mysqli_fetch_assoc($total_final_percent_result);
    
    $total_final_percent = $total_final_percent_row['total_final_percent'];
    $html .= '<tr>';
    $html .= '</tr>';
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td width="270px">'. $row['final_description'] . '</td>';
        $html .= '<td style="">'. $row['final_percents'] . '</td>';
        $html .= '</tr>';
    }
    $html .= '<tr>';
    $html .="<td style='' colspan='5'>Total<a style='margin-left:15.9rem;'>$total_final_percent</a>%</td>";
    $html .= '</tr>';
}

$html .= '</table>';

$html .'<div style="text-align: justify; text-justify: inter-word;">';

$html .= '<span style="margin-top: 5rem;"><a style="margin-top: 1rem; margin-left:20px;">Overall Final Grade = [(Midterm grade) + (Final term grade)] / 2 <a></span><br><br>';


$html .= '<h4 style="margin-top: 1rem;margin-left: 3rem;">COURSE POLICIES AND REQUIREMENTS</h4>';


$html .='<div class="container" style="margin-left: 4rem; padding-right:1rem;  overflow-wrap: break-word;">';

// Fetch and display course learning outcomes
$sql = "SELECT * FROM course_policies";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $description = $row['description'];
        if (strpos($description, 'CLO') !== false || strpos($description, "\n") !== false) {
            // If a line break is found, replace it with <br>
            $description = str_replace("\n", '<br>', $description);
        } 
        function indentText($text) {    
            $lines = explode('<br>', $text); // Split the text by <br> tags
            foreach ($lines as &$line) {
                if (preg_match('/^\s*\d+\./', $line)) {
                    // Add indentation if the line starts with a numeral followed by a period
                    $line = '<div class="course_policies" style="padding-left: -1px;">' . $line . '</div>';
                } elseif (preg_match('/^\s*[a-z]+\./', $line)) {
                    // Add indentation if the line starts with a lowercase letter followed by a period
                    // and does not start with a lowercase Roman numeral followed by a period
                    $line = '<div class="course_policies" style="padding-left: 40px;">' . $line . '</div>';
                } else {
                    // No indentation for other lines
                    $line = '<div class="course_policies">' . $line . '</div>';
                }
        
        
            }
            return implode('<br>', $lines);
        }
        
        
        
        
    }
    
}

$html .= indentText($description);


$html .='</div>';


$html .= '<h4 style="margin-top: 2rem;margin-bottom: 2rem;">REFERENCES:</h4>';

$html .= '<p style="margin-top: 2rem;margin-bottom: 2rem;"><b>On-Site References:<b></p>';




$html .= '<table>';


$html .= '<tr>';
$html .= '<th width="170px">Provider</th>';
$html .= '<th>Reference Material</th>';
$html .= '</tr>';

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  

$sql = "SELECT * FROM `onsite_reffence` WHERE department = $department and catid = $catid  ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td style="text-align:center">'. $row['Provider'] . '</td>';
        $html .= '<td>'. $row['Reference_Material'] . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';


$html .= '<p style="margin-top: 2rem;margin-bottom: 2rem;"><b>Online References:<b></p>';




$html .= '<table>';


$html .= '<tr>';
$html .= '<th>Call Number / E-provider </th>';
$html .= '<th>Reference Material</th>';
$html .= '</tr>';



$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
$sql = "SELECT * FROM `online_refference` WHERE department = $department and catid = $catid ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td width="70px">'. $row['e_provider'] . '</td>';
        $html .= '<td>'. $row['refference_material'] . '</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';


$html .='&nbsp;&nbsp;&nbsp;&nbsp;<span style=""><b>Prepared:</b><b><a style="padding-left:30px;" class="course">'.$course_departments.'</a></b></span>';


$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
// Fetch and display course learning outcomes
$sql = "SELECT * FROM semestral WHERE department = $department and catid = $catid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .='<p style="padding-left:130px; style="padding-top:10px;" class="term_year">'.$row['term']." ".$row['year'].'</p></td>';
    }
    
}



$html .='&nbsp;&nbsp;&nbsp;&nbsp;<span style=""><b>' . $dept_head_signature . ':</b><b><a style="padding-left:20px;" class="course">'.$dept_head.'</a></span>';
$html .='&nbsp;&nbsp;&nbsp;&nbsp;<span style=""><b><p style="padding-left:140px;" class="course">'.$dept_head_position.", ".$course_initial.'</p></b></span>';
'</p></td>';



$html .='&nbsp;&nbsp;&nbsp;&nbsp;<span style=""><b>' . $deans_category_signature . ':</b><b><a style="padding-left:20px;" class="course">'.$category_dean.'</a></span>';
$html .='&nbsp;&nbsp;&nbsp;&nbsp;<span style=""><b><p style="padding-left:140px;" class="course">'.$category_dean_position.", ".$category_initial.'</p></b></span>';
'</p></td>';


$html .='<span class="inline-images">
<a><img src="../img/DLSU-D.png" style="margin-top:1rem;" width="100" class="mt-5" alt=""></a>
<a><img class="img-inline" style="margin-left:7rem; margin-top:1rem;" src="../Admin/uploads/'. $categories_logo . '" alt="Image" width="100"></a>
</span>';

$html .= '<h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>';
$html .=  '<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>';
$html .=   '<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4';
$html .= '<h4 style="text-align:center; margin-top: 1rem;">PROGRAM LEARNING OUTCOME - COURSE LEARNING OUTCOME</h4>';
$html .=   '<h4 style="text-align:center; margin-top: -1rem;">MAPPING TABLE FOR '.strtoupper($cname).'</h4';

   
$department = $_SESSION['department'];
$catid = $_SESSION['catid']; 
// Using prepared statement to prevent SQL injection
$sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department=? and catid = $catid";
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





    $html .= '<h4 style="margin-top: 1rem;">COURSE LEARNING OUTCOMES:</h4>';
    $html .= '<a style="">By the end of this course, students are expected to:</a><br><br>';
    

    $html .= '<table class="teaching_guid" style="font-size: 14px"; height: 100px;>';
    $html .= '<tr>'; // Opening row tag
    $html .= '<th rowspan="2" scope="col">Course Learning Outcome</th>';
    $html .= '<th class="text-center" colspan="9" scope="col">Program Learning Outcomes</th>';
    $html .= '</tr>'; // Closing the header row
    
    $html .= '<tr>'; // Opening a new row for data
    $html .= '<th width="1px" scope="col">PLO1</th>';
    $html .= '<th width="1px" scope="col">PLO2</th>';
    $html .= '<th width="1px" scope="col">PLO3</th>';
    $html .= '<th width="1px" scope="col">PLO4</th>';
    $html .= '<th width="1px" scope="col">PLO5</th>';
    $html .= '<th width="1px" scope="col">PLO6</th>';
    $html .= '<th width="1px" scope="col">PLO7</th>';
    $html .= '<th width="1px" scope="col">PLO8</th>';
    $html .= '<th width="1px" scope="col">PLO9</th>';
    $html .= '</tr>'; // Closing the data row
    
   
    
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  
$sql = "SELECT * FROM mapping_table WHERE department = $department and catid = $catid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
    
        $html .= '<td>'. $row['learn_out_mapping'] . '</td>';
        $html .= '<td>'. $row['pl1'] . '</td>';
        $html .= '<td>'. $row['pl2'] . '</td>';
        $html .= '<td>'. $row['pl3'] . '</td>';
        $html .= '<td>'. $row['pl4'] . '</td>';
        $html .= '<td>'. $row['pl5'] . '</td>';
        $html .= '<td>'. $row['pl6'] . '</td>';
        $html .= '<td>'. $row['pl7'] . '</td>';
        $html .= '<td>'. $row['pl8'] . '</td>';
        $html .= '<td>'. $row['pl9'] . '</td>';
        $html .= '</tr>';
    }
    
    // Total row
   
}







$html .= '</table>';
$html .='&nbsp;&nbsp;&nbsp;&nbsp;<span style=""><b></b><b><a style="padding-left:20px;" class="course">'.$commitee_dept_signature.'</a></span>';
$html .= '<p style="border-top:1px solid black; width:235px; margin-top: 15px; margin-left: 10px;"></p>';
$html .= '<p style="font-style:italic; margin-left: 10px; ">Approved in </a>'. date("F") ." ".date("Y").' <a>during a multi-sectoral committee specifically convened for the purpose of coming up with 
descriptions for the graduate attributes. 
</p>';






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


