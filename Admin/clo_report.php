<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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

// Function to filter learning outcomes
function filterLearningOutcomes($conn, $array, $table, $column) {
    $matches = 0;
    $filteredResults = [];

    foreach ($array as $word) {
        $sql = "SELECT `comlab`, `$column` FROM `$table` WHERE `$column` LIKE '%$word%' AND `department` IS NOT NULL AND `catid` IS NOT NULL";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $filteredResults[] = $row;
                $matches++;
            }
        }
    }

    $percent = ($matches / count($array)) * 100;
    return [$filteredResults, $percent];
}

// Get filtered results for midterm period
list($midtermHigherResults, $midtermHigherPercent) = filterLearningOutcomes($conn, $higherArray, 'course_leaning', 'learn_out');
list($midtermLowerResults, $midtermLowerPercent) = filterLearningOutcomes($conn, $lowerArray, 'course_leaning', 'learn_out');

// Get filtered results for final period
list($finalHigherResults, $finalHigherPercent) = filterLearningOutcomes($conn, $higherArray, 'laerning_final', 'final_learning_out');
list($finalLowerResults, $finalLowerPercent) = filterLearningOutcomes($conn, $lowerArray, 'laerning_final', 'final_learning_out');

$conn->close();
?>

<h2>Learning Outcomes for Midterm Period</h2>
<div class="center">
<table>
<tr>
    <th>Higher Level (<?php echo round($midtermHigherPercent, 2); ?>%)</th>
    <th>Lower Level (<?php echo round($midtermLowerPercent, 2); ?>%)</th>
</tr>
<tr>
<td>
<?php
if (!empty($midtermHigherResults)) {
    foreach ($midtermHigherResults as $result) {
        echo '<p>' . $result['comlab'] . '. ' . $result['learn_out'] . '</p>';
    }
} else {
    echo '<p>No Higher Level found.</p>';
}
?>
</td>
<td>
<?php
if (!empty($midtermLowerResults)) {
    foreach ($midtermLowerResults as $result) {
        echo '<p>' . $result['comlab'] . '. ' . $result['learn_out'] . '</p>';
    }
} else {
    echo '<p>No Lower Level found.</p>';
}
?>
</td>
</tr>
</table>
</div>

<h2>Learning Outcomes for Final Period</h2>
<div class="center">
<table>
<tr>
    <th>Higher Level (<?php echo round($finalHigherPercent, 2); ?>%)</th>
    <th>Lower Level (<?php echo round($finalLowerPercent, 2); ?>%)</th>
</tr>
<tr>
<td>
<?php
if (!empty($finalHigherResults)) {
    foreach ($finalHigherResults as $result) {
        echo '<p>' . $result['comlab'] . '. ' . $result['final_learning_out'] . '</p>';
    }
} else {
    echo '<p>No Higher Level found.</p>';
}
?>
</td>
<td>
<?php
if (!empty($finalLowerResults)) {
    foreach ($finalLowerResults as $result) {
        echo '<p>' . $result['comlab'] . '. ' . $result['final_learning_out'] . '</p>';
    }
} else {
    echo '<p>No Lower Level found.</p>';
}
?>
</td>
</tr>
</table>
</div>

</body>
</html>
