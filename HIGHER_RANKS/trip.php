<?php
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

include('../Database/connection.php');

$email = $_SESSION['email'];

// Prepare and execute SQL statement
$sql = "SELECT 
            u.first_name, 
            u.last_name, 
            u.department, 
            u.catid, 
            u.phone_number, 
            u.email, 
            u.password, 
            p.name AS position,
            c.id AS category_id,
            c.name AS category_name,
            c.initial AS category_initial,
            c.dean_name AS category_dean,
            c.dean_position AS category_dean_position,
            c.logo AS category_logo,
            co.dean_signature AS deans_category_signature,
            co.cname,
            co.course_department AS course_department,
            co.initial AS course_initial,
            co.department_name AS dept_head,
            co.department_position AS dept_head_position,
            co.dept_signature AS dept_head_signature,
            co.commitee_signature AS dept_commitee_signature
        FROM 
            users AS u 
        LEFT JOIN 
            position AS p ON u.position = p.id
        LEFT JOIN 
            category AS c ON u.department = c.id
        LEFT JOIN
            course AS co ON u.catid = co.id
        WHERE 
            u.email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Fetch data
    $row = $result->fetch_assoc();
    $_SESSION['department'] = $row['department']; // Add department to session
    $_SESSION['catid'] = $row['catid']; // Add department to session
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $department = $row['department'];
    $phone_number = $row['phone_number'];
    $email = $row['email'];
    $password = $row['password'];
    $position = $row['position'];
    $category_name = $row['category_name'];
    $category_initial = $row['category_initial'];
    $cname = $row['cname'];
    $course_initial = $row['course_initial'];
    $course_departments = $row['course_department'];
    $category_dean = $row['category_dean'];
    $category_dean_position = $row['category_dean_position'];
    $dept_head = $row['dept_head'];
    $dept_head_position = $row['dept_head_position'];
    $dept_head_signature = $row['dept_head_signature'];
    $deans_category_signature = $row['deans_category_signature'];
    $commitee_dept_signature = $row['dept_commitee_signature'];
    $categories_logo = $row['category_logo'];
} else {
    $position = "Position not found";
}

// Close statement and connection
$stmt->close();
$conn->close();
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
    $catid = $_SESSION['catid'];
    $query = "SELECT `id`, `module_no`, `title`, `hours`, `department`, `catid` FROM `module_learning` WHERE 
    `department` = $department and `catid` = $catid
    GROUP BY 
    module_no, hours, department";
    
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
    $catid = $_SESSION['catid'];
    $query = "SELECT * FROM course_leaning WHERE `department` = $department and `catid` = $catid";

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
$moduleData = fetchModuleData($conn);
$knowledgeResults = searchDatabase($conn, $knowledgeArray, "topic_learn_out");
$compressionResults = searchDatabase($conn, $compressionArray, "topic_learn_out");
$applyResults = searchDatabase($conn, $applyArray, "topic_learn_out");
$analysisResults = searchDatabase($conn, $analysisArray, "topic_learn_out");

// Count the total number of items in the knowledgeResults array
$totalKnowledgeItems = count($knowledgeResults);

// Close connection
$conn->close();

echo $cname;

// Display results in a table
echo "<table border='2' style='border-collapse:collapse; text-align:center; padding:5px;'>";
echo "<tr>";
echo "<th style='width:150px;' rowspan='2'>Hours</th>";
echo "<th style='Padding:5px;' rowspan='2'>Module No</th>";
echo "<th style='Padding:5px;' colspan='4'>LEVELS</th>";
echo "<th style='width:150px;' rowspan='2'>Total</th>";
echo "<tr>";
echo "<th style='width:250px; Padding:5px;'>K ($totalKnowledgeItems)</th>"; // Include the total count of knowledge items
echo "<th style='width:250px; Padding:5px;'>C</th>";
echo "<th style='width:250px; Padding:5px;'>AP</th>";
echo "<th style='width:250px; Padding:5px;'>AN</th>";
echo "</tr>";
echo "</tr>";

$maxCount = max(count($moduleData), count($knowledgeResults), count($compressionResults), count($applyResults), count($analysisResults));

$totalHours = 0;
$totalKnowledge = 0;
$totalCompression = 0;
$totalApplication = 0;
$totalAnalysis = 0;

// Iterate over each array and sum up the counts
$totalHours = count($moduleData);
$totalKnowledge = count($knowledgeResults);
$totalCompression = count($compressionResults);
$totalApplication = count($applyResults);
$totalAnalysis = count($analysisResults);

$totalCount = $totalHours + $totalKnowledge + $totalCompression + $totalApplication + $totalAnalysis;

echo "Total count of all results: $totalCount";

for ($i = 0; $i < $maxCount; $i++) {
    echo "<tr>";
    echo "<td style='padding: 5px;'>";
    if (isset($moduleData[$i])) {
        $totalHours = ($moduleData[$i]['hours']) * 60;
        echo $totalHours;
    } else {
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding: 5px;'>";
    if (isset($moduleData[$i])) {
        echo $moduleData[$i]['module_no']."<br>".$moduleData[$i]['title'];
    } else {
        echo "0";
    }
    echo "<td style='padding: 5px;'>";
    if (isset($knowledgeResults[$i])) {
        echo $knowledgeResults[$i]['topic_learn_out'];
    } else {
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding: 5px;'>";
    if (isset($compressionResults[$i])) {
        echo $compressionResults[$i]['topic_learn_out'];
    } else {
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding: 5px;'>";
    if (isset($applyResults[$i])) {
        echo $applyResults[$i]['topic_learn_out'];
    } else {
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding: 5px;'>";
    if (isset($analysisResults[$i])) {
        echo $analysisResults[$i]['topic_learn_out'];
    } else {
        echo "0";
    }
    echo "</td>";
    echo "<td style='padding:5px;'>Waiting</td>";
    echo "</tr>";
}

echo "</table>";
?>
