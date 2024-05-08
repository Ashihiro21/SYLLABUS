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

$department = $_SESSION['department']; 
$sql = mysqli_query($conn,"SELECT * FROM course_syllabus");
$user = mysqli_fetch_assoc($sql);

$sql4 = mysqli_query($conn,"SELECT * FROM semestral");
$user4 = mysqli_fetch_assoc($sql4);

$sql5 = mysqli_query($conn,"SELECT * FROM module_learning");
$user5 = mysqli_fetch_assoc($sql5);

$sql5 = mysqli_query($conn,"SELECT * FROM module_learning" );
$user5 = mysqli_fetch_assoc($sql5);




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
    box-sizing: border-box;
}
.header{
    font-weight:bold;
}

table{
    width: 100%;
    margin-bottom: 5rem;
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

    <p style="text-align:center; font-weight:bold;">Table of Specifications</p>';
    
    


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

    $knowledge = [
        "Define",
        "Recall",
        "Recognize",
        "List",
        "Memorize"
    ];
    
    $comprehension = [
        "Explain",
        "Summarize",
        "Paraphrase",
        "Interpret",
        "Classify",  
        "Understand",  
        "Comprehend",  
        "Grasp",  
        "Absorb",  
        "Digest",  
    ];
    
    
    $apply = [
        "Apply",
        "Implement",
        "Use",
        "Solve",
        "Utilize" , 
        "Employ" , 
        "Execute" , 
        "Employ"
    ];
    
    $analysis = [
        "Analyze",
        "Compare",
        "Contrast",
        "Differentiate",
        "Break down",
    

    ];
    
    // Initialize counts for matches
    $higherMatches = 0;
    $lowerMatches = 0;
    $applyMatches = 0;
    $analysisMatches = 0;
    
    $filteredWords = [];
    foreach ($knowledge as $word) {
        $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$word%' and department='$department'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Extract individual words
                $sentence = $row['topic_learn_out'];
                $words = explode(" ", $sentence); // Split sentence into words
                foreach ($words as $singleWord) {
                    if (stripos($singleWord, $word) !== false) { // Check if word exists in single word
                        $filteredWords[] = $singleWord; // Store only the word
                        $higherMatches++;
                        break; // Stop further processing of words in this sentence
                    }
                }
            }
        }
    }
    
    // Filter colors from database based on the colors array
    $filteredColors = [];
    foreach ($comprehension as $color) {
        $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$color%' and department='$department'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Extract individual words
                $sentence = $row['topic_learn_out'];
                $words = explode(" ", $sentence); // Split sentence into words
                foreach ($words as $singleWord) {
                    if (stripos($singleWord, $color) !== false) { // Check if color exists in single word
                        $filteredColors[] = $singleWord; // Store only the word
                        $lowerMatches++;
                        break; // Stop further processing of words in this sentence
                    }
                }
            }
        }
    }
    
    // Filter words from database based on the $apply array
    $filteredApply = [];
    foreach ($apply as $applyWord) {
        $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$applyWord%' and department='$department'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Extract individual words
                $sentence = $row['topic_learn_out'];
                $words = explode(" ", $sentence); // Split sentence into words
                foreach ($words as $singleWord) {
                    if (stripos($singleWord, $applyWord) !== false) { // Check if word exists in single word
                        $filteredApply[] = $singleWord; // Store only the word
                        $applyMatches++;
                        break; // Stop further processing of words in this sentence
                    }
                }
            }
        }
    }
    
    // Filter words from database based on the $analysis array
    $filteredAnalysis = [];
    foreach ($analysis as $analysisWord) {
        $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$analysisWord%' and department='$department'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Extract individual words
                $sentence = $row['topic_learn_out'];
                $words = explode(" ", $sentence); // Split sentence into words
                foreach ($words as $singleWord) {
                    if (stripos($singleWord, $analysisWord) !== false) { // Check if word exists in single word
                        $filteredAnalysis[] = $singleWord; // Store only the word
                        $analysisMatches++;
                        break; // Stop further processing of words in this sentence
                    }
                }
            }
        }
    }
    
    // Start building HTML table
    $html = '<table style="border:1px solid black;">';
    $html .= '<tr style="margin:0px; padding:0px;">';
    $html .= '<th style="width:70px;" rowspan="2">% ITEM</th>';
    $html .= '<th rowspan="2"><p>Time</p><p>Allotment/</p><p>topic(mins)</p></th>';
    $html .= '<th rowspan="2">TOPICS</th>';
    $html .= '<th colspan="4">LEVELS</th>';
    $html .= '<th rowspan="2">No. of Items</th>';
    $html .= '</tr>';
    
    $html .= '<tr>';
    $html .= '<th>K</th>';
    $html .= '<th>C</th>';
    $html .= '<th>AP</th>';
    $html .= '<th>AN</th>';
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
            $modulePosition = strpos($row['ml_teaching_activities'], 'Module');
    
            // If 'Module' is found
            if ($modulePosition !== false) {
                // Get the substring starting from 'Module' to the end of the string
                $substring = substr($row['ml_teaching_activities'], $modulePosition);
    
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
                $html .= $row['ml_teaching_activities'];
            }
    
            // Concatenate $row['title'] to the side of $row['teaching_activities']
            $html .= '<br/>' . $row['ml_title'];
    
            $html .= '</td>';
    
            // Output learning outcomes based on matches
            $html .= '<td>';
            $html .= implode('<br/>', array_slice($filteredWords, 0, 2)); // Output first two matching words from $knowledge
            $html .= '</td>';
            $html .= '<td>';
            $html .= implode('<br/>', array_slice($filteredColors, 0, 2)); // Output first two matching words from $comprehension
            $html .= '</td>';
            $html .= '<td>';
            $html .= implode('<br/>', array_slice($filteredApply, 0, 2)); // Output first two matching words from $apply
            $html .= '</td>';
            $html .= '<td>';
            $html .= implode('<br/>', array_slice($filteredAnalysis, 0, 2)); // Output first two matching words from $analysis
            $html .= '</td>';
    
            $html .= '<td>Example</td>';
            $html .= '</tr>';
        }
    }
    
    $html .= '</table>';









    
   
//     $servername = "localhost";
//     $username = "root";
//     $password = "";
//     $database = "syllabus";
    
//     // Create connection
//     $conn = new mysqli($servername, $username, $password, $database);
    
//     // Check connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }
    
//     $department = $_SESSION['department']; 
    
//     // Example words array
//     $knowledge = [
//         "Define",
//         "Recall",
//         "Recognize",
//         "List",
//         "Memorize"
//     ];
    
//     $comprehension = [
//         "Explain",
//         "Summarize",
//         "Paraphrase",
//         "Interpret",
//         "Classify"  
//     ];

    
//     $apply = [
//         "Apply",
//         "Implement",
//         "Use",
//         "Solve",
//         "Demonstrate"  
//     ];
    
//     $analysis = [
//         "Analyze",
//         "Compare",
//         "Contrast",
//         "Differentiate",
//         "Investigate"  
//     ];
//     // Initialize counts for matches
//     $higherMatches = 0;
//     $lowerMatches = 0;
//     $applyMatches = 0;
//     $analysisMatches = 0;
    
//     $filteredWords = [];
//     foreach ($knowledge as $word) {
//         $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$word%' and department='$department'";
//         $result = $conn->query($sql);
//         if ($result && $result->num_rows > 0) {
//             while($row = $result->fetch_assoc()) {
//                 // Extract individual words
//                 $sentence = $row['topic_learn_out'];
//                 $words = explode(" ", $sentence); // Split sentence into words
//                 foreach ($words as $singleWord) {
//                     if (stripos($singleWord, $word) !== false) { // Check if word exists in single word
//                         $filteredWords[] = $singleWord; // Store only the word
//                         $higherMatches++;
//                         break; // Stop further processing of words in this sentence
//                     }
//                 }
//             }
//         }
//     }
    
//     // Filter colors from database based on the colors array
//     $filteredColors = [];
//     foreach ($comprehension as $color) {
//         $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$color%' and department='$department'";
//         $result = $conn->query($sql);
//         if ($result && $result->num_rows > 0) {
//             while($row = $result->fetch_assoc()) {
//                 // Extract individual words
//                 $sentence = $row['topic_learn_out'];
//                 $words = explode(" ", $sentence); // Split sentence into words
//                 foreach ($words as $singleWord) {
//                     if (stripos($singleWord, $color) !== false) { // Check if color exists in single word
//                         $filteredColors[] = $singleWord; // Store only the word
//                         $lowerMatches++;
//                         break; // Stop further processing of words in this sentence
//                     }
//                 }
//             }
//         }
//     }
    
//     // Filter words from database based on the $apply array
//     $filteredApply = [];
//     foreach ($apply as $applyWord) {
//         $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$applyWord%' and department='$department'";
//         $result = $conn->query($sql);
//         if ($result && $result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 // Extract individual words
//                 $sentence = $row['topic_learn_out'];
//                 $words = explode(" ", $sentence); // Split sentence into words
//                 foreach ($words as $singleWord) {
//                     if (stripos($singleWord, $applyWord) !== false) { // Check if word exists in single word
//                         $filteredApply[] = $singleWord; // Store only the word
//                         $applyMatches++;
//                         break; // Stop further processing of words in this sentence
//                     }
//                 }
//             }
//         }
//     }
    
//     // Filter words from database based on the $analysis array
//     $filteredAnalysis = [];
//     foreach ($analysis as $analysisWord) {
//         $sql = "SELECT `topic_learn_out` FROM `course_leaning` WHERE `topic_learn_out` LIKE '%$analysisWord%' and department='$department'";
//         $result = $conn->query($sql);
//         if ($result && $result->num_rows > 0) {
//             while ($row = $result->fetch_assoc()) {
//                 // Extract individual words
//                 $sentence = $row['topic_learn_out'];
//                 $words = explode(" ", $sentence); // Split sentence into words
//                 foreach ($words as $singleWord) {
//                     if (stripos($singleWord, $analysisWord) !== false) { // Check if word exists in single word
//                         $filteredAnalysis[] = $singleWord; // Store only the word
//                         $analysisMatches++;
//                         break; // Stop further processing of words in this sentence
//                     }
//                 }
//             }
//         }
//     }
    
//     // Calculate percentages
//     $higherPercent = ($higherMatches / count($knowledge)) * 100;
//     $lowerPercent = ($lowerMatches / count($comprehension)) * 100;
//     $applyPercent = ($applyMatches / count($apply)) * 100;
//     $analysisPercent = ($analysisMatches / count($analysis)) * 100;
    
//     $html .= '<div class="center">';
//     $html .= '<table>';
//     $html .= '<tr>';
//     $html .= '<th>K (' . round($higherPercent, 2) . '%)</th>';
//     $html .= '<th>C (' . round($lowerPercent, 2) . '%)</th>';
//     $html .= '<th>AP (' . round($applyPercent, 2) . '%)</th>';
//     $html .= '<th>AN (' . round($analysisPercent, 2) . '%)</th>';
//     $html .= '<th>No.of Items</th>';
//     $html .= '</tr>';
//     $html .= '<tr>';
    
//    // Initialize total count variable
//     $totalCount = 0;

//    // Define an array of filtered arrays
// $filteredArrays = [
//     'filteredWords' => $filteredWords,
//     'filteredColors' => $filteredColors,
//     'filteredApply' => $filteredApply,
//     'filteredAnalysis' => $filteredAnalysis
// ];

// // Initialize total count
// $totalCount = 0;

// // Get array keys
// $keys = array_keys($filteredArrays);

// // Initialize index
// $i = 0;

// // Start the loop
// while ($i < count($filteredArrays)) {
//     $key = $keys[$i];
//     $filteredArray = $filteredArrays[$key];

//     $html .= '<td>';
//     if (!empty($filteredArray)) {
//         $html .= '<p>' . count($filteredArray) . '</p>'; // Display count of filtered elements
//         // Add count to total
//         $totalCount += count($filteredArray);
//         // Check if $key is 'filteredColors' and $higherMatches is 0
//         if ($key === 'filteredColors' && $higherMatches == 0) {
//             $html .= '<p class="footer">Add More Higher Level to Make higher Level.</p>';
//         }
//     } else {
//         $html .= '<p>0</p>';
//     }
//     $html .= '</td>';

//     // Increment index
//     $i++;
// }

// // Add total count of all filtered elements to another table cell
//     $html .= '<td>';
//     $html .= '<p>' . $totalCount . '</p>';
//     $html .= '</td>';

//     $html .= '</tr>';
//     $html .= '</table>';
//     $html .= '</div>';
    
//     // Close connection
//     $conn->close();

    
    
    









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
