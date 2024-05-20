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
        $_SESSION['catid'] = $row['catid']; 
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
table, td, th{
    border-collapse: collapse;
    text-align: left;
    border: 2px solid black;
    border-collapse: collapse;
    padding: 5px;
}

.center {
    margin: 0 auto;
    width: 95%;
}
th,h1, .footer, h2{
    text-align: center;
}


</style>

<body>
<img style="margin-left: 16rem; margin-top: 1rem;" src="../img/logos.png" alt="Image" width="190">
<h4 style="text-align:center; margin-top: 1rem;">DE LA SALLE UNIVERSITY-DASMARINAS</h4>
<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($category_name).'</h4>
<h4 style="text-align:center; margin-top: -1rem;">'.strtoupper($course_departments).'</h4>

<h4 style="text-align:center;">HIGHER AND LOWER</h4>';


// FINAL PERIOD

$html .= '<h2>Learning Outcomes for Final Period</h2>';


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
$catid = $_SESSION['catid']; 
// Example words array
$higherArray = [
    "Design",
    "Assemble",
    "Construct",
    "Conjecture",
    "Develop",
    "Formulate",
    "Author",
    "Investigate",
    "Appraise",
    "Argue",
    "Defend",
    "Judge",
    "Select",
    "Support",
    "Value",
    "Critique",
    "Weight",
    "Differentiate",
    "Organize",
    "Relate",
    "Compare",
    "Contrast",
    "Distinguish",
    "Examine",
    "Question",
    "Test"
];

$lowerArray = [
    "Execute",
    "Implement",
    "Solve",
    "Use",
    "Interpret",
    "Demonstrate",
    "Operate",
    "Schedule",
    "Sketch",
    "Classify",
    "Describe",
    "Discuss",
    "Explain",
    "Identify",
    "Locate",
    "Recognize",
    "Report",
    "Translate",
    "Define",
    "List",
    "Memorize",
    "State"
];

// Initialize counts for matches
$higherMatches = 0;
$lowerMatches = 0;

// Filter words from database based on the words array
$filteredWords = [];
foreach ($higherArray as $word) {
    $sql = "SELECT `learn_out` FROM `course_leaning` WHERE `learn_out` LIKE '%$word%' and department='$department' and catid = $catid";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredWords[] = $row;
            $higherMatches++;
        }
    }
}

// Filter colors from database based on the colors array
$filteredColors = [];
foreach ($lowerArray as $color) {
    $sql = "SELECT `learn_out` FROM `course_leaning` WHERE `learn_out` LIKE '%$color%' and department='$department' and catid = $catid";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredColors[] = $row;
            $lowerMatches++;
        }
    }
}

// Calculate percentages
$higherPercent = ($higherMatches / count($higherArray)) * 100;
$lowerPercent = ($lowerMatches / count($lowerArray)) * 100;



$html .= '<div class="center">';
$html .= '<table>';
$html .= '<tr>';
$html .= '<th>Higher Level (' . round($higherPercent, 2) . '%)</th>';
$html .= '<th>Lower Level (' . round($lowerPercent, 2) . '%)</th>';
$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>';
if (!empty($filteredWords)) {
    foreach ($filteredWords as $word) {
        $html .= '<p>' . $word['learn_out'] . '</p>';
    }
} else {
    $html .= '<p>No Higher Level found.</p>';
}
$html .= '</td>';
$html .= '<td>';
if (!empty($filteredColors)) {
    foreach ($filteredColors as $color) {
        $html .= '<p>'. $color['learn_out'] . '</p>';
    }
} else {
    $html .= '<p>No Lower Level found.</p>';
}
$html .= '</td>';
$html .= '</tr>';
$html .= '</table>';
$html .= '</div>';

// Check if $lowerArray has more matches than $higherArray
if ($lowerMatches >= $higherMatches) {
    $html .= '<p class="footer">Add More Higher Level to Make higher Level.</p>';
}

// Close connection
$conn->close();



// FINAL PERIOD

$html .= '<h2>Learning Outcomes for Final Period</h2>';


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
$catid = $_SESSION['catid']; 
// Example words array
$higherArray = [
    "Design",
    "Assemble",
    "Construct",
    "Conjecture",
    "Develop",
    "Formulate",
    "Author",
    "Investigate",
    "Appraise",
    "Argue",
    "Defend",
    "Judge",
    "Select",
    "Support",
    "Value",
    "Critique",
    "Weight",
    "Differentiate",
    "Organize",
    "Relate",
    "Compare",
    "Contrast",
    "Distinguish",
    "Examine",
    "Question",
    "Test"
];

$lowerArray = [
    "Execute",
    "Implement",
    "Solve",
    "Use",
    "Interpret",
    "Demonstrate",
    "Operate",
    "Schedule",
    "Sketch",
    "Classify",
    "Describe",
    "Discuss",
    "Explain",
    "Identify",
    "Locate",
    "Recognize",
    "Report",
    "Translate",
    "Define",
    "List",
    "Memorize",
    "State"
];

// Initialize counts for matches
$higherMatches = 0;
$lowerMatches = 0;

// Filter words from database based on the words array
$filteredWords = [];
foreach ($higherArray as $word) {
    $sql = "SELECT `final_learning_out` FROM `laerning_final` WHERE `final_learning_out` LIKE '%$word%' and department='$department' and catid = $catid";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredWords[] = $row;
            $higherMatches++;
        }
    }
}

// Filter colors from database based on the colors array
$filteredColors = [];
foreach ($lowerArray as $color) {
    $sql = "SELECT `final_learning_out` FROM `laerning_final` WHERE `final_learning_out` LIKE '%$color%' and department='$department' and catid = $catid";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $filteredColors[] = $row;
            $lowerMatches++;
        }
    }
}

// Calculate percentages
$higherPercent = ($higherMatches / count($higherArray)) * 100;
$lowerPercent = ($lowerMatches / count($lowerArray)) * 100;



$html .= '<div class="center">';
$html .= '<table>';
$html .= '<tr>';
$html .= '<th>Higher Level (' . round($higherPercent, 2) . '%)</th>';
$html .= '<th>Lower Level (' . round($lowerPercent, 2) . '%)</th>';
$html .= '</tr>';
$html .= '<tr>';

$html .= '<td>';
if (!empty($filteredWords)) {
    foreach ($filteredWords as $word) {
        $html .= '<p>' . $word['final_learning_out'] . '</p>';
    }
} else {
    $html .= '<p>No Higher Level found.</p>';
}
$html .= '</td>';
$html .= '<td>';
if (!empty($filteredColors)) {
    foreach ($filteredColors as $color) {
        $html .= '<p>'. $color['final_learning_out'] . '</p>';
    }
} else {
    $html .= '<p>No Lower Level found.</p>';
}
$html .= '</td>';
$html .= '</tr>';
$html .= '</table>';
$html .= '</div>';

// Check if $lowerArray has more matches than $higherArray
if ($lowerMatches >= $higherMatches) {
    $html .= '<p class="footer">Add More Higher Level to Make higher Level.</p>';
}

// Close connection
$conn->close();















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
