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
            co.`dean_signature` AS `dean_signatures`,
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
body {
    margin: 20px;
    box-sizing: border-box;
}
.header{
    font-weight:bold;
}

table{
    width: 100%;
    margin-bottom: 1rem;
}

table, th, td, tr{
    border: 1px solid black;
    border-collapse: collapse;
}
th, td{
    text-align:center;
    padding:5px;
}
</style>

<body>

<img style="margin-left: 16rem; margin-top: 1rem;" src="../img/logos.png" alt="Image" width="190">
<h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>
<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>
<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4>

<h4 style="text-align:center;">HIGHER AND LOWER</h4>';

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
      
      $html .='<h4 style="text-align:center; margin-top: -1rem; font-weight:bold;">'.strtoupper($row['course_code']).'-'.strtoupper($row['course_tittle']).'</h4>';
    }
} 



$sql = "SELECT `id`, `module_no`, `title`, `week`, `date`, `teaching_activities`, `technology`, `onsite`, `asy`, `hours`, `department` FROM `module_learning` WHERE `department` = $department GROUP BY module_no, hours, department ORDER BY id ASC";

$html .= '<table>';


$html .= '<tr>';
$html .= '<th>% ITEM</th>';
$html .= '<th>Time
Allotment/
topic(mins)</th>';
$html .= '<th>TOPICS</th>';
$html .= '<th>LEVEL K</th>';
$html .= '</tr>';

$department = $_SESSION['department']; 
$sql = "SELECT 
ML.`id` AS ml_id,
ML.`module_no` AS ml_module_no,
ML.`title` AS ml_title,
ML.`week` AS ml_week,
ML.`date` AS ml_date,
ML.`teaching_activities` AS ml_teaching_activities,
ML.`technology` AS ml_technology,
ML.`onsite` AS ml_onsite,
ML.`asy` AS ml_asy,
ML.`hours` AS ml_hours,
ML.`department` AS ml_department,
CL.`id` AS cl_id,
CL.`comlab` AS cl_comlab,
CL.`learn_out` AS cl_learn_out,
CL.`topic_learn_out` AS cl_topic_learn_out
FROM 
`module_learning` AS ML
LEFT JOIN 
`course_leaning` AS CL ON ML.`department` = CL.`department`
WHERE 
ML.`department` = $department
GROUP BY 
ml_module_no, ml_hours, ml_department
ORDER BY 
ml_id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $rowCount = 0; // Initialize row count

    while ($row = $result->fetch_assoc()) {
        $rowCount++; // Increment row count
        // Skip first and last row
        if ($rowCount === 1 || $rowCount === $result->num_rows) {
            continue;
        }

        
        $html .= '<tr>';
        $html .= '<td>Example</td>';
        $html .= '<td>'. ($row['ml_hours']) * 60 .'</td>';
        $html .= '<td>';

        // Find the position of the first occurrence of 'Module'
        $modulePosition = strpos($row['ml_module_no'], 'Module');

        // If 'Module' is found
        if ($modulePosition !== false) {
            // Get the substring starting from 'Module' to the end of the string
            $substring = substr($row['ml_module_no'], $modulePosition);

            // Find the position of the first occurrence of a number after 'Module'
            preg_match('/Module\D+(\d+)/', $substring, $matches);
            if (isset($matches[1])) {
                $numberPosition = strpos($substring, $matches[1]);
                // If a number is found after 'Module', trim the substring to that position
                if ($numberPosition !== false) {
                    $substring = substr($substring, 0, $numberPosition + strlen($matches[1]));
                }
            }

            $html .= $substring;
        } else {
            $html .= $row['ml_module_no'];
        }

        // Concatenate $row['title'] to the side of $row['teaching_activities']
        $html .= '<br/>' . $row['ml_title'];

        $html .= '</td>';

        $html .= '<td>'. ($row['ml_module_no']).'</td>';
        $html .= '</tr>';
    }
}

$html .= '</table>';












// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$department = $_SESSION['department']; 

// Example words array
$knowlegeArray = [
    "Define",
    "Recall",
    "Recognize",
    "List",
    "Memorize"
];

$compressionArray = [
    "Explain",
    "Summarize",
    "Paraphrase",
    "Interpret",
    "Classify" 
];

$applyArray = [
    "Apply",
    "Implement",
    "Use",
    "Solve",
    "Demonstrate"
];

$analysisArray = [
    "Analyze",
    "Compare",
    "Contrast",
    "Differentiate",
    "Investigate"  
];

// Initialize counts for matches
$knowledgeMatches = 0;
$compressionMatches = 0;
$applyMatches = 0;
$analysisMatches = 0;

// Filter words from database based on the words array
$filteredknowledge = [];
foreach ($knowlegeArray as $knowlege) {
    $sql = "SELECT `id`, `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$knowlege%' and department='$department'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredknowledge[] = $row;
            $knowledgeMatches++;
        }
    }
}

// Filter colors from database based on the colors array
$filteredcompression = [];
foreach ($compressionArray as $compression) {
    $sql = "SELECT `id`, `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$compression%' and department='$department'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredcompression[] = $row;
            $compressionMatches++;
        }
    }
}

// Filter colors from database based on the colors array
$filteredapply = [];
foreach ($applyArray as $apply) {
    $sql = "SELECT `id`, `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$apply%' and department='$department'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredapply[] = $row;
            $applyMatches++;
        }
    }
}

// Filter colors from database based on the colors array
$filteredanalysis = [];
foreach ($analysisArray as $analysis) {
    $sql = "SELECT `id`, `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$analysis%' and department='$department'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredanalysis[] = $row;
            $analysisMatches++;
        }
    }
}






// Calculate percentages
$knowlegePercent = ($knowledgeMatches / count($knowlegeArray)) * 100;
$compressionPercent = ($compressionMatches / count($compressionArray)) * 100;
$applyPercent = ($applyMatches / count($applyArray)) * 100;
$analysisPercent = ($analysisMatches / count($analysisArray)) * 100;

$totalCount = $knowledgeMatches + $compressionMatches + $applyMatches + $analysisMatches;

$html .= '<div class="center">';
$html .= '<table>';
$html .= '<tr>';
$html .= '<th colspan="4">LEVELS</th>';
$html .= '<th rowspan="2">No. of Items</th>'; // Added total column
$html .= '</tr>';
$html .= '<tr>';
$html .= '<th>K</th>';
$html .= '<th>C</th>';
$html .= '<th>AP</th>';
$html .= '<th>AN</th>';

$html .= '</tr>';




$html .= '<tr>';

$html .= '<td>';
$html .= '<p>' . $knowledgeMatches . '</p>';
$html .= '</td>';

$html .= '<td>';
$html .= '<p>' . $compressionMatches . '</p>';
$html .= '</td>';

$html .= '<td>';
$html .= '<p>' . $applyMatches . '</p>';
$html .= '</td>';

$html .= '<td>';
$html .= '<p>' . $analysisMatches . '</p>';
$html .= '</td>';

$html .= '<td>';
$html .= '<p>' . $totalCount . '</p>'; // Display total count
$html .= '</td>';

$html .= '</tr>';
$html .= '</table>';
$html .= '</div>';



// Close connection
$conn->close();

$html .= '</body>';
$html .= '</html>';

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
