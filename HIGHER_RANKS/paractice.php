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
            c.dean_signature AS deans_category_signature,
            co.cname,
            co.course_department AS course_department,
            co.initial AS course_initial,
            co.department_name AS dept_head,
            co.department_position AS dept_head_position,
            co.dept_signature AS dept_head_signature
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
    $course_departments = $row['course_department'];
    $category_dean = $row['category_dean'];
    $category_dean_position = $row['category_dean_position'];
    $dept_head = $row['dept_head'];
    $dept_head_position = $row['dept_head_position'];
    $dept_head_signature = $row['dept_head_signature'];
    $deans_category_signature = $row['deans_category_signature'];
} else {
    $position = "Position not found";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIGHER AND LOWER LEVEL REPORT</title>
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
            width: 50%;
        }
        th,h1, .footer, h2{
            text-align: center;
        }
      
    </style>
</head>
<body>
    <h1>HIGHER AND LOWER LEVEL REPORT</h1>
    <h2>Learning Outcomes for Midterm Period</h2>

    <?php
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
        $sql = "SELECT `comlab`, `learn_out` FROM `course_leaning` WHERE `learn_out` LIKE '%$word%' and department='$department'";
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
        $sql = "SELECT `comlab`, `learn_out` FROM `course_leaning` WHERE `learn_out` LIKE '%$color%' and department='$department'";
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
    ?>
<div class="center">
    <table>
        <tr>
            <th>Higher Level (<?php echo round($higherPercent, 2); ?>%)</th>
            <th>Lower Level (<?php echo round($lowerPercent, 2); ?>%)</th>
        </tr>
        <tr>
            <td>
                <?php if(!empty($filteredWords)): ?>
                    <?php foreach($filteredWords as $word): ?>
                        <p><?php echo $word['comlab']; ?> . <?php echo $word['learn_out']; ?> </p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No Higher Level found.</p>
                <?php endif; ?>
            </td>
            <td>
                <?php if(!empty($filteredColors)): ?>
                    <?php foreach($filteredColors as $color): ?>
                        <p><?php echo $color['comlab']; ?> . <?php echo $color['learn_out']; ?> </p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No Higher Level found.</p>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    </div>
    <?php
    // Check if $lowerArray has more matches than $higherArray
    if ($lowerMatches >= $higherMatches) {
        echo "<p class='footer'>Add More Higher Level to Make higher Level.</p>";
    }

    // Close connection
    $conn->close();
    ?>




    <!--   Learning Outcomes for Final Period -->


    <h2>Learning Outcomes for Final Period</h2>

<?php
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
    $sql = "SELECT `comlab`, `final_learning_out` FROM `laerning_final` WHERE `final_learning_out` LIKE '%$word%' and department='$department'";
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
    $sql = "SELECT `comlab`, `final_learning_out` FROM `laerning_final` WHERE `final_learning_out` LIKE '%$color%' and department='$department'";
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
?>
<div class="center">
<table>
    <tr>
        <th>Higher Level (<?php echo round($higherPercent, 2); ?>%)</th>
        <th>Lower Level (<?php echo round($lowerPercent, 2); ?>%)</th>
    </tr>
    <tr>
        <td>
            <?php if(!empty($filteredWords)): ?>
                <?php foreach($filteredWords as $word): ?>
                    <p><?php echo $word['comlab']; ?> . <?php echo $word['final_learning_out']; ?> </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No Higher Level found.</p>
            <?php endif; ?>
        </td>
        <td>
            <?php if(!empty($filteredColors)): ?>
                <?php foreach($filteredColors as $color): ?>
                    <p><?php echo $color['comlab']; ?> . <?php echo $color['final_learning_out']; ?> </p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No Higher Level found.</p>
            <?php endif; ?>
        </td>
    </tr>
</table>
</div>
<?php
// Check if $lowerArray has more matches than $higherArray
if ($lowerMatches >= $higherMatches) {
    echo "<p class='footer'>Add More Higher Level to Make higher Level.</p>";
}

// Close connection
$conn->close();
?>




</body>
</html>
