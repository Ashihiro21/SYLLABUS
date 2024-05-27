<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table, th, td, tr{
        border: 2px solid black;
        padding: 20px;
        border-collapse: collapse;
        text-align: center;
    }
</style>
<body>

<?php
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

// Higher and Lower Level Arrays
$higherArray = [
    "Design", "Assemble", "Construct", "Conjecture", "Develop", "Formulate", 
    "Author", "Investigate", "Appraise", "Argue", "Defend", "Judge", 
    "Select", "Support", "Value", "Critique", "Weight", "Differentiate", 
    "Organize", "Relate", "Compare", "Contrast", "Distinguish", "Examine", 
    "Question", "Test"
];

$lowerArray = [
    "Execute", "Implement", "Solve", "Use", "Interpret", "Demonstrate", 
    "Operate", "Schedule", "Sketch", "Classify", "Describe", "Discuss", 
    "Explain", "Identify", "Locate", "Recognize", "Report", "Translate", 
    "Define", "List", "Memorize", "State"
];

// Function to filter learning outcomes per department
function filterLearningOutcomesByDepartment($conn, $array, $table, $column) {
    $results = [];
    $sql = "SELECT DISTINCT d.department, c.id, c.name, c.initial, c.dean_name, c.dean_position, c.logo 
            FROM $table d 
            LEFT JOIN category c ON d.department = c.id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departmentId = $row['department'];
            $departmentName = $row['name'];

            $higherMatches = 0;
            $lowerMatches = 0;
            $filteredHigherResults = [];
            $filteredLowerResults = [];

            foreach ($array['higher'] as $word) {
                $sql = "SELECT `comlab`, `$column` FROM `$table` 
                        WHERE `$column` LIKE '%$word%' 
                        AND `department` = '$departmentId' 
                        AND `catid` IS NOT NULL";
                $subResult = $conn->query($sql);
                if ($subResult && $subResult->num_rows > 0) {
                    while ($subRow = $subResult->fetch_assoc()) {
                        $filteredHigherResults[] = $subRow;
                        $higherMatches++;
                    }
                }
            }

            foreach ($array['lower'] as $word) {
                $sql = "SELECT `comlab`, `$column` FROM `$table` 
                        WHERE `$column` LIKE '%$word%' 
                        AND `department` = '$departmentId' 
                        AND `catid` IS NOT NULL";
                $subResult = $conn->query($sql);
                if ($subResult && $subResult->num_rows > 0) {
                    while ($subRow = $subResult->fetch_assoc()) {
                        $filteredLowerResults[] = $subRow;
                        $lowerMatches++;
                    }
                }
            }

            $higherPercent = ($higherMatches / count($array['higher'])) * 100;
            $lowerPercent = ($lowerMatches / count($array['lower'])) * 100;

            $results[$departmentName] = [
                'higher' => $filteredHigherResults,
                'higherPercent' => $higherPercent,
                'lower' => $filteredLowerResults,
                'lowerPercent' => $lowerPercent,
                'details' => $row
            ];
        }
    }

    return $results;
}

// Learning outcome arrays
$learningOutcomeArray = ['higher' => $higherArray, 'lower' => $lowerArray];

// Get filtered results for midterm period
$midtermResults = filterLearningOutcomesByDepartment($conn, $learningOutcomeArray, 'course_leaning', 'learn_out');

// Get filtered results for final period
$finalResults = filterLearningOutcomesByDepartment($conn, $learningOutcomeArray, 'laerning_final', 'final_learning_out');

$conn->close();
?>

<h2>Learning Outcomes for Midterm Period</h2>
<?php
foreach ($midtermResults as $department => $data) {
    $details = $data['details'];
    echo "<h3>Department: {$details['name']} ({$details['initial']})</h3>";
    echo '<div class="center">';
    echo '<table>';
    echo '<tr>';
    echo '<th>Higher Level (' . round($data['higherPercent'], 2) . '%)</th>';
    echo '<th>Lower Level (' . round($data['lowerPercent'], 2) . '%)</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    if (!empty($data['higher'])) {
        foreach ($data['higher'] as $result) {
            echo '<p>' . $result['comlab'] . '. ' . $result['learn_out'] . '</p>';
        }
    } else {
        echo '<p>No Higher Level found.</p>';
    }
    echo '</td>';
    echo '<td>';
    if (!empty($data['lower'])) {
        foreach ($data['lower'] as $result) {
            echo '<p>' . $result['comlab'] . '. ' . $result['learn_out'] . '</p>';
        }
    } else {
        echo '<p>No Lower Level found.</p>';
    }
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
}
?>

<h2>Learning Outcomes for Final Period</h2>
<?php
foreach ($finalResults as $department => $data) {
    $details = $data['details'];
    echo "<h3>Department: {$details['name']} ({$details['initial']})</h3>";
    echo '<div class="center">';
    echo '<table>';
    echo '<tr>';
    echo '<th>Higher Level (' . round($data['higherPercent'], 2) . '%)</th>';
    echo '<th>Lower Level (' . round($data['lowerPercent'], 2) . '%)</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>';
    if (!empty($data['higher'])) {
        foreach ($data['higher'] as $result) {
            echo '<p>' . $result['comlab'] . '. ' . $result['final_learning_out'] . '</p>';
        }
    } else {
        echo '<p>No Higher Level found.</p>';
    }
    echo '</td>';
    echo '<td>';
    if (!empty($data['lower'])) {
        foreach ($data['lower'] as $result) {
            echo '<p>' . $result['comlab'] . '. ' . $result['final_learning_out'] . '</p>';
        }
    } else {
        echo '<p>No Lower Level found.</p>';
    }
    echo '</td>';
    echo '</tr>';
    echo '</table>';
    echo '</div>';
}
?>

</body>
</html>
