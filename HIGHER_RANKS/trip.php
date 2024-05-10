<?php
session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

include('../Database/connection.php');

$userEmail = $_SESSION['email']; // Renamed to avoid conflict

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
            u.email = '$userEmail'"; // Changed variable name to avoid conflict

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $_SESSION['department'] = $row['department']; 
        $courses = $row['catid'];
        $phone_number = $row['phone_number'];
        $userEmail = $row['email']; // Renamed to avoid conflict
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

?>

<?php
$knowledgeArray = [
    "Define",
    "List",
    "Identify",
    "Name",
    "Label",
    "Recall",
    "Recognize",
    "State",
    "Memorize",
    "Recite",
    "Enumerate",
    "Classify",
    "Catalog",
    "Specify",
    "Record",
    "Locate",
    "Point out",
    "Distinguish"
];

$compressionArray = [
    "Summarize",
    "Explain",
    "Describe",
    "Interpret",
    "Paraphrase",
    "Clarify",
    "Demonstrate",
    "Understand",
    "Discuss",
    "Predict",
    "Illustrate",
    "Elaborate",
    "Differentiate",
    "Translate",
    "Outline",
    "Sum up",
    "Review",
    "Simplify",
    "Summarize",
    "Elucidate",
    "Convey"
];

$applyArray = [
    "Apply",
    "Demonstrate",
    "Implement",
    "Solve",
    "Use",
    "Practice",
    "Employ",
    "Utilize",
    "Execute",
    "Operate",
    "Adapt",
    "Experiment",
    "Engage",
    "Integrate",
    "Harness"
];

$analysisArray = [
    "Analyze",
    "Compare",
    "Contrast",
    "Differentiate",
    "Examine",
    "Investigate",
    "Break down",
    "Dissect",
    "Evaluate",
    "Critique",
    "Deconstruct",
    "Deem",
    "Assess",
    "Inspect",
    "Scrutinize",
    "Probe",
    "Explore",
    "Test",
    "Validate", 
];

// Function to retrieve data from the database and return results
function fetchModuleData($conn) {
    $department = $_SESSION['department'];
    $query = "SELECT `id`, `module_no`, `title`, `hours`, `department` FROM `module_learning` WHERE 
    `department` = $department
    GROUP BY 
    module_no, hours, department
    ORDER BY 
    id ASC";
    
    // Execute query
    $result = $conn->query($query);

    // Store results in an array
    $results_array = array();
    if ($result) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // Add your logic here to manipulate the 'module_no' field
                $modulePosition = strpos($row['module_no'], 'Module');
                if ($modulePosition !== false) {
                    $substring = substr($row['module_no'], $modulePosition);
                    preg_match('/Module\D+(\d+)/', $substring, $matches);
                    if (isset($matches[1])) {
                        $numberPosition = strpos($substring, $matches[1]);
                        if ($numberPosition !== false) {
                            $substring = substr($substring, 0, $numberPosition + strlen($matches[1]));
                        }
                    }
                    $row['module_no'] = $substring;
                }
                // End of manipulation

                $results_array[] = $row;
            }
            // Remove first and last index from the array
            array_shift($results_array);
            array_pop($results_array);
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $conn->error;
    }

    return $results_array;
}



// Function to generate and execute SQL queries
function searchDatabase($conn, $array, $category) {
    $department = $_SESSION['department'];
    $query = "SELECT * FROM course_leaning WHERE `department` = $department";

    $conditions = array();
    foreach ($array as $item) {
        $trimmed_item = trim($item);
        $escaped_item = $conn->real_escape_string($trimmed_item);
        $conditions[] = "$category LIKE '%$escaped_item%'";
    }
    $query .= " AND (" . implode(" OR ", $conditions) . ")";

    // Execute query
    $result = $conn->query($query);

    // Store results in an array
    $results_array = array();
    if ($result) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $results_array[] = $row;
            }
        }
    } else {
        // Handle query execution error
        echo "Error executing query: " . $conn->error;
    }

    return $results_array;
}

// Create connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform searches and store results
$hoursResult = fetchModuleData($conn, $knowledgeArray, "hours");
$module_noResult = fetchModuleData($conn, $knowledgeArray, "module_no");
$titleResult = fetchModuleData($conn, $knowledgeArray, "title");
$knowledgeResults = searchDatabase($conn, $knowledgeArray, "topic_learn_out");
$compressionResults = searchDatabase($conn, $compressionArray, "topic_learn_out");
$applyResults = searchDatabase($conn, $applyArray, "topic_learn_out");
$analysisResults = searchDatabase($conn, $analysisArray, "topic_learn_out");

// Close connection
$conn->close();

// Display results in a table
echo "<table border='2' style='border-collapse:collapse; text-align:center; padding:5px;'>";
echo "<tr>";
echo "<th style='width:150px;' rowspan='2'>Hours</th>";
echo "<th style='Padding:5px;' rowspan='2'>Module No</th>";
echo "<th style='Padding:5px;' colspan='4'>LEVELS</th>";
echo "<th style='width:150px;' rowspan='2'>Total</th>";
echo "<tr>";
echo "<th style='width:250px; Padding:5px;'>K</th>";
echo "<th style='width:250px; Padding:5px;'>C</th>";
echo "<th style='width:250px; Padding:5px;'>AP</th>";
echo "<th style='width:250px; Padding:5px;'>AN</th>";
echo "</tr>";
echo "</tr>";

$maxCount = max(count($hoursResult),count($module_noResult),count($titleResult),count($knowledgeResults), count($compressionResults), count($applyResults), count($analysisResults));

$totalHours = 0;
$totalKnowledge = 0;
$totalCompression = 0;
$totalApplication = 0;
$totalAnalysis = 0;

// Iterate over each array and sum up the counts
$totalHours = count($hoursResult);
$totalKnowledge = count($knowledgeResults);
$totalCompression = count($compressionResults);
$totalApplication = count($applyResults);
$totalAnalysis = count($analysisResults);

$totalCount = $totalHours + $totalKnowledge + $totalCompression + $totalApplication + $totalAnalysis;

echo "Total count of all results: $totalCount";

for ($i = 0; $i < $maxCount; $i++) {
    echo "<tr>";
    echo "<td style='padding: 5px;'>";
      if (isset(($hoursResult[$i]))) {
        $totalHours = ($hoursResult[$i]['hours']) * 60;
        echo $totalHours;
    }else{
        echo "0";
    }
    echo "<td style='padding: 5px;'>";
    if (isset($module_noResult[$i])) {
        echo $module_noResult[$i]['module_no']."<br>".$titleResult[$i]['title'];
    }else{
        echo "0";
    }
    echo "<td style='padding: 5px;'>";
    if (isset($knowledgeResults[$i])) {
        echo $knowledgeResults[$i]['topic_learn_out'];
    }else{
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding: 5px;'>";
    if (isset($compressionResults[$i])) {
        echo $compressionResults[$i]['topic_learn_out'];
    }else{
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding: 5px;'>";
    if (isset($applyResults[$i])) {
        echo $applyResults[$i]['topic_learn_out'];
    }else{
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding: 5px;'>";
    if (isset($analysisResults[$i])) {
        echo $analysisResults[$i]['topic_learn_out'];
    }else{
        echo "0";
    }
    
    echo "<td style='padding:5px;'>Waiting</td>";

  
   
    
    echo "</tr>";
}

echo "</table>";
?>