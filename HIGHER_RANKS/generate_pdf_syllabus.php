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
    padding: 10px;
    border-collapse: collapse;
}

.total{
    background-color: #ffbb33;
}

.container{
    margin-left: 2rem;
}



</style>

<body>
<img style="margin-left: 16rem; margin-top: 1rem;" src="../img/logos.png" alt="Image" width="190">

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

$html .= '</table>';

$html .= '<table class="teaching_guid">';
$html .= '<tr>';
$html .= '<th class="teaching_guid">Module No and Learning Outcomes</th>';
$html .= '<th width="100%" class="teaching_guid">Week No</th>';
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
        $html .= '<td width="70px" class="teaching_guid">'. $row['week'] ." ". $row['date'] . '</td>';
        $html .= '<td class="teaching_guid">';
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If '•' or a line break is found, replace it with <br>
            $html .= str_replace(array('•', "\n"), '<br>', $row['teaching_activities']);
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
    $html .= '<td class="teaching_guid onsite" colspan="4">TOTAL</td>';
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

$sql = "SELECT * FROM laerning_final ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>'. $row['final_learning_out'] . '</td>';
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

$html .= '</table>';

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

$sql = "SELECT * FROM module_learning_final";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $total_hour_query = "SELECT 
        SUM(hours) as total_hours, 
        SUM(asy) as total_asy_hours,
        SUM(onsite) as total_onsite_hours 
    FROM module_learning_final";
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

$html .= '</table>';





$html .= '<h4 style="margin-top: 1rem;">GRADING SYSTEM:</h4>';

$html .= '<style>';
$html .= '.tables { border: none; }'; // Remove table border
$html .= '.tables td, .tables th { border: none; }'; // Remove border for table cells and headers
$html .= '</style>';

$html .= '<table class="tables">';

$sql = "SELECT * FROM percent ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent";
    $total_percent_result = mysqli_query($conn, $total_percent_query);
    $total_percent_row = mysqli_fetch_assoc($total_percent_result);
            
    $total_percent = $total_percent_row['total_percent'];

    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td width="300px">'. $row['description'] . '</td>';
        $html .= '<td style="">'. $row['percents'] . '</td>';
        $html .= '</tr>';
    }
    $html .="<td style='border-top:1px solid black;' colspan='5'>TOTAL <a style='margin-left:15.9rem;padding-top:2rem;'>$total_percent</a>%</td>";
}

$html .= '</table><br><br>';


$html .= '<span style="margin-top: 5rem;"><b style="margin-top: 1rem; margin-left: 2rem;">Overall Final Grade:</b> = <a style="border-bottom:1px solid black">Midterm + Final  <a></span><br>';
$html .= '<span><a style="margin-left: 15rem">2 <a></span>';


$html .= '<h4 style="margin-top: 1rem;margin-left: 3rem;">COURSE POLICIES AND REQUIREMENTS</h4>';


$html .='<div class="container" style="margin-left: 5rem; padding-right:1rem;  overflow-wrap: break-word;">';

$html .='<p><b>1. Office365 Activation.</b>  Please ensure that your Office365 account is working. Your Office365 account is needed to access both Schoolbook and MS Teams where your asynchronous and synchronous classes will be held.</p>';

$html .='<p><b>2. Enrollment in an E-Class.</b>  You will automatically be enrolled in your e-class which is based on your enrollment data.</p>';

$html .='<p><b>3. Traditional Blended Learning Model.</b>  This course adopts the traditional blended learning model.  This means that there will be a mix of face-to-face and asynchronous classes.  Majority of teaching-learning activities and assessments are undertaken onsite.  The total number of onsite classes shall be 50% of the number of hours allotted for the whole semester.</p>';

$html .='<p><b>4. Online Asynchronous Sessions.</b></p>';

$html .='<div class="container-2" style="margin-left: 3rem;margin-bottom: 3rem;  overflow-wrap: break-word;">';

$html .='<p><b>a. Schoolbook (SB). </b>Schoolbook shall be the only platform for asynchronous sessions.</p>';

$html .='<p><b>b. Modules. </b>Modules are self-paced learning resources for asynchronous sessions. These can be accessed in Schoolbook.</p>';

$html .='<p><b>c. References. </b>Each page section may contain uploaded references. These learning resources may be downloaded.';

$html .='<p><b>d. Asynchronous Activities. </b>You are expected to read the modules as soon as they are uploaded. The learning content of the modules complement the online synchronous and face-to-face sessions.';

$html .='<p><b>e. Asynchronous Engagement. </b>Your activities in the course can be tracked by your professor. This includes the time you spend in reading the lessons and answering the assessments.   ';

$html .='<p><b>f. Schoolbook Forum. </b>All general concerns about the lessons and assessments in asynchronous sessions must be posted in the Schoolbook Forum. Response shall be made by your teacher within 48 hours.';

$html .='<p><b>g. Schoolbook Messaging. </b>This shall be the mode of communication for private and/or confidential communications. Response shall be made by your teacher within 48 hours upon receipt of the same unless it falls on weekends or holidays, which shall be handled promptly the following working day.';


$html .='</div>';

$html .='<p><b>5. Onsite / Face-to-face (F2F) Sessions.</b></p>';

$html .='<div class="container-2" style="margin-left: 3rem;margin-bottom: 3rem;  overflow-wrap: break-word;">';

$html .='<p><b>a. Face-to-face engagement. </b>Your engagement in face-to-face classes is graded based on your class participation.</p>';

$html .='<p><b>b. Classroom. </b>F2F classes shall be held at the classroom indicated in your Certificate of Registration. Should there be changes in the classroom venue, information will be given in advance.</p>';

$html .='<p><b>c. Gospel Reading and Prayer. </b>Each F2F session shall start with a Gospel reading and prayer. Your teacher may assign you, in advance, to do this.';

$html .='<p><b>d. d. F2F Meeting Schedule. </b>The meeting schedule shall follow the time indicated in your official registration. The dates of F2F meetings are identified in the learning plan.';

$html .='<p><b>e. Attendance. </b>YAttendance in F2F meetings is required.  Absence beyond 20% of the total number of F2F meetings will automatically be given a 0.0 grade in the subject.';

$html .='<p><b>f. Tardiness. </b>All general concerns about the lessons and assessments in asynchronous sessions must be posted in the Schoolbook Forum. Response shall be made by your teacher within 48 hours.';

$html .='<p><b>g. Absence. </b>A student is considered absent 30 minutes after the official class schedule.';

$html .='<p><b>h. Excuse from F2F classes. </b>Students are excused in the F2F classes based on the provisions in the latest version of the Student Handbook.';

$html .='<p><b>i. Uniform. </b>Wearing of prescribed uniform could be worn on Mondays, Thursdays and Fridays, while Wednesdays and Saturdays are designated as wash days. Wearing of corporate attire could be worn every Tuesdays. Civilian attire should follow the policy on dress code as stipulated in the latest version of the Student Handbook.';


$html .='</div>';

$html .='<p><b>6. Assessment and Grading System.</b></p>';


$html .='<div class="container-2" style="margin-left: 3rem;margin-bottom: 0rem;  overflow-wrap: break-word;">';

$html .='<p><b>a. Formative assessments. </b>These are ungraded assessments. These may be considered as practice assessments that leads towards achieving outcomes without fear of receiving a failing grade.</p>';

$html .='<p><b>b. Enabling assessments. </b>These will comprise most of your graded assessments. These are designed to achieve topic learning outcomes, that leads towards achieving the course learning outcomes. A maximum of two enabling assessments shall be allowed during the week. Please pay attention to the duration and number of attempts. As a general rule, quiz-type enabling assessments shall be open for only a minimum of 24 hours, while output-based enabling assessments shall be open for at least 6 days.</p>';

$html .='<p><b>c. No. of Attempts. </b>All enabling assessments, if given onsite, shall have 1 attempt only. For online enabling assessment shall have a maximum of 2 attempts. Summative assessments shall be given onsite and shall have 1 attempt only.</p>';

$html .='<p><b>d. Summative assessments.</b></p>';

$html .='<div class="container-2" style="margin-left: 3rem;margin-bottom: 0rem;  overflow-wrap: break-word;">';

$html .='<p>i.	There shall be two summative assessments (midterm and final exams) for the entire semester. These are designed to achieve the course learning outcomes.</p>';

$html .='<p>ii.	Summative assessment shall be given onsite..</p>';

$html .='<p>iii.	Output-based summative assessment shall be given to students at least fifteen days prior to scheduled Summative Exam Week.</p>';

$html .='</div>';








$html .='<p><b>e. Lifeline. </b>Only students with (1) valid reason as stated in the Student Handbook and IRR, and (2) given their proof of excuse on or before the next synchronous/F2F session, shall be given a lifeline on the enabling and summative assessments.</p>';

$html .='<p><b>f. Rubric. </b>All online non-quiz or non-discrete types of assessment (essay, drop box, output-based, etc.) shall have a rubric or criteria for rating the students’ tasks. A student may refuse to answer these types of assessment in the absence of a rubric or criteria for grading, and the assessment shall be deemed invalid and shall not be part of the student’s grades.</p>';

$html .='<p><b>g. Grading. </b>All online assessments should be checked and graded by the teacher before the submission of midterm and final grades.</p>';

$html .='<p><b>h. Grading system. </b>The following shall be the basis for the computation of grades per term for traditional blended classes (see table above):</p>';

$html .='<div class="container-2" style="margin-left: 5rem;margin-bottom: 2rem; margin-top: -2rem;  overflow-wrap: break-word;">';

$html .= '<style>';
$html .= 'ul { list-style-type: lower-roman; padding: 0; }'; // Apply CSS to set list style to lower Roman numerals
$html .= '</style>';



$sql = "SELECT * FROM percent ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $html .= '<ul>'; // Start unordered list
    while ($row = $result->fetch_assoc()) {
        $html .= '<li><span><a>'. $row['description'] ."  ". $row['percents'] .'</a></span></li>';
    }
    $html .= '</ul>'; // End unordered list
}

$html .='</div>';

$html .='<p><b>i. Gradebook. </b>Students can see the breakdown of grades in their Assessment tab.</p>';


$html .='</div>';

$html .='<p style="padding-top: 1rem; padding-bottom: 1rem;"    ><b>7. Self-Care.</p>';

$html .='<div class="container-2" style="margin-bottom: 0rem; margin-top: -2rem;  overflow-wrap: break-word;">';





$html .='</div>';

$html .='<div class="container-2" style="margin-left: 7rem;margin-bottom: -2rem;  overflow-wrap: break-word;">';
$html .='<p>a. <b>Schedule. </b>The schedule of self-care week for the '.$user4['second_call']." ".$user4['year'].' is on '.$user5['date'].'. During this week, there shall be no asynchronous/synchronous meetings, F2F classes, new modules, new assessments, and deadlines.</p>';
$html .='<p>b. <b>Prerogative. </b>Students may avail of the self-care program, whether online or onsite, provided by the different units of the University.</p>';
$html .='</div>';


$html .='<p style="padding-top: 1rem; padding-bottom: 1rem;"><b>8. Data Privacy.</p>';

$html .='<div class="container-2" style="margin-bottom: 0rem; margin-top: -2rem;  overflow-wrap: break-word;">';





$html .='</div>';

$html .='<div class="container-2" style="margin-left: 7rem;margin-bottom: -2rem;  overflow-wrap: break-word;">';
$html .='<p>a. <b>Access to the MS Teams. </b>Only students who are officially enrolled shall be part of the MS Teams and have access to all the resources including the recording. Students are not allowed to download the recordings. Screen recording is not allowed.</p>';
$html .='<p>b. <b>Guests. </b>Inviting people that are not part of the class in synchronous meetings is strictly prohibited, unless approved by the subject teacher.</p>';
$html .='</div>';





$html .='<p style="padding-top: 1rem; padding-bottom: 1rem;"><b>9. Copyright and Plagiarism..</p>';

$html .='<div class="container-2" style="margin-bottom: 0rem; margin-top: -2rem;  overflow-wrap: break-word;">';

$html .='</div>';

$html .='<div class="container-2" style="margin-left: 7rem;margin-bottom: -2rem;  overflow-wrap: break-word;">';
$html .='<p>a. Using of any illegally obtained software and other technology tools is strictly prohibited.</p>';
$html .='<p>b. Students are encouraged to use their original photos, videos, and other resources. Otherwise, students can use royalty-free resources or embed the sources in their submissions to avoid copyright infringement and/or plagiarism.</p>';
$html .='<p>c. Giving of password to Schoolbook and Office 365 is strictly prohibited. Likewise, accessing Schoolbook and Office 365 account other than the students’ personal account is also strictly prohibited. Violating students will be reported to the Student Welfare and Formation Office (SWAFO).</p>';
$html .='<p>d. This subject shall abide by the policies pertaining to intellectual property, copyright, and plagiarism as stipulated in the latest edition of the Student Handbook.</p>';
$html .='<p>e. Any plagiarized work, whether in part or full, shall mean a grade of 0.0 for the assessment.</p>';

$html .='</div>';




$html .='<p style="padding-top: 1rem;">10. This course shall abide by any institutional policies that may be released after the approval of this syllabus. Any such policy shall be posted within the e-class at the forums section, news feed. It will also be briefly discussed during the soonest synchronous meeting.</p>';

$html .='</div>';


$html .= '<h4 style="margin-top: 2rem;margin-bottom: 2rem;">REFERENCES:</h4>';

$html .= '<p style="margin-top: 2rem;margin-bottom: 2rem;"><b>On-Site References:<b></p>';




$html .= '<table>';


$html .= '<tr>';
$html .= '<th>Provider</th>';
$html .= '<th>Reference Material</th>';
$html .= '</tr>';

$sql = "SELECT * FROM `onsite_reffence` ORDER BY id ASC";
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

$sql = "SELECT * FROM `online_refference` ORDER BY id ASC";
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


$html .='<span><b>Prepared:</b><b><a style="padding-left:30px;" class="course">'.$course_departments.'</a></b></span>';



$html .='<p style="padding-left:130px; style="padding-top:10px;" class="term_year">'.$user4['term']." ".$user4['year'].'</p></td>';



$html .= '<p><img style="padding-left:145px; padding-top:10px;" src="' . $dept_head_signature . '" " class="course" alt="Department Head Signature"></p>';

$html .='<span><b>Approved by:</b><b><a style="padding-left:20px;" class="course">'.$dept_head.'</a></span>';
$html .='<span><b><p style="padding-left:140px;" class="course">'.$dept_head_position.", ".$course_initial.'</p></b></span>';
'</p></td>';



$html .= '<p><img style="padding-left:145px; padding-top:10px;" src="' . $deans_category_signature . '" " class="course" alt="Department Head Signature"></p>';

$html .='<span><b>Approved by:</b><b><a style="padding-left:20px;" class="course">'.$category_dean.'</a></span>';
$html .='<span><b><p style="padding-left:140px;" class="course">'.$category_dean_position.", ".$category_initial.'</p></b></span>';
'</p></td>';


$html .='<img style="margin-left: 16rem; margin-top: 1rem;" src="../img/logos.png" alt="Image" width="190">';

$html .= '<h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>';
$html .=  '<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>';
$html .=   '<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4';
$html .= '<h4 style="text-align:center; margin-top: 1rem;">PROGRAM LEARNING OUTCOME - COURSE LEARNING OUTCOME</h4>';
$html .=   '<h4 style="text-align:center; margin-top: -1rem;">MAPPING TABLE FOR '.strtoupper($cname).'</h4';

    $html .= '<span><a class="header">COURSE CODE</a><b><a style=" margin-left: 100px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_code'].'</a></span><br>';
    $html .= '<span><a class="header">COURSE TITLE</a><b><a style=" margin-left: 97px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_tittle'].'</a></span><br>';
    $html .= '<span><a class="header">COURSE TYPE</a><b><a style=" margin-left: 103px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_Type'].'</a></span><br>';
    $html .= '<span><a class="header">COURSE CREDIT</a><b><a style=" margin-left: 84px; margin-right: 2rem;">:</a></b><a class="data">'.$user['course_credit'].'</a></span><br>';
    $html .= '<span><a class="header">LEARNING MODALITY</a><b><a style=" margin-left: 36px; margin-right: 2rem;">:</a></b><a class="data">'.$user['learning_modality'].'</a></span><br>';
    $html .= '<span><a class="header">PRE-REQUISITES</a><b><a style=" margin-left: 82px; margin-right: 2rem;">:</a></b><a class="data">'.$user['pre_requisit'].'</a></span><br>';
    $html .= '<span><a class="header">CO-REQUISITES</a><b><a style=" margin-left: 90px; margin-right: 2rem;">:</a></b><a class="data">'.$user['co_pre_requisit'].'</a></span><br>';

    



$html .= '</body>';
$html .= '</html>';


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


