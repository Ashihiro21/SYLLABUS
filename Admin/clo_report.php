<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .center {
            margin: auto;
            width: 80%;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        h2, h1, h3, h4 {
            text-align: center;
        }
        .department-logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .department-logo img {
            max-height: 50px;
            margin-left: 10px;
        }
    </style>
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
        $sql = "
        SELECT cl.`comlab`, cl.`$column`, cat.`name`, cat.`initial`, cat.`dean_name`, cat.`dean_position`, cat.`logo`, cr.`cname`, cr.course_department
        FROM `$table` AS cl
        LEFT JOIN `category` AS cat ON cl.`department` = cat.`id`
        LEFT JOIN `course` AS cr ON cl.`catid` = cr.`id`
        WHERE cl.`$column` LIKE '%$word%' AND cl.`department` IS NOT NULL AND cl.`catid` IS NOT NULL
        GROUP BY cl.`department`, cl.`$column`";
        
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $filteredResults[$row['name']][] = $row;
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

<h1>Higher and Lower for Department</h1>
<h4>DE LA SALLE UNIVERSITY-DASMARINAS</h4>

<h2>Learning Outcomes for Midterm Period</h2>
<div class="center">
    <?php foreach ($midtermHigherResults as $department => $results): ?>
        <h3><?php echo $department; ?></h3>
        <div class="department-logo">
            <img src="../Admin/uploads/<?php echo isset($results[0]['logo']) ? $results[0]['logo'] : 'No_signature'; ?>" alt="Department Logo">
        </div>
        <?php if (!empty($midtermHigherResults[$department])): ?>
            <?php foreach ($midtermHigherResults[$department] as $result): ?>
                <h4><?php echo $result['cname']; ?></h4>
                
                <table>
                    <tr>
                        <th>Higher Level (<?php echo round($midtermHigherPercent, 2); ?>%)</th>
                        <th>Lower Level (<?php echo round($midtermLowerPercent, 2); ?>%)</th>
                    </tr>
                    <tr>
                        <td>
                            <p><strong>Outcome:</strong> <?php echo $result['comlab'] . '. ' . $result['learn_out']; ?></p>
                        </td>
                        <td>
                            <?php
                            if (!empty($midtermLowerResults[$department])) {
                                foreach ($midtermLowerResults[$department] as $lowerResult) {
                                    if ($lowerResult['cname'] == $result['cname']) {
                                        echo '<p><strong>Outcome:</strong> ' . $lowerResult['comlab'] . '. ' . $lowerResult['learn_out'] . '</p>';
                                    }
                                }
                            } else {
                                echo '<p>No Lower Level found.</p>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Department:</strong> <?php echo $result['course_department']; ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No Higher Level found.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<h2>Learning Outcomes for Final Period</h2>
<div class="center">
    <?php foreach ($finalHigherResults as $department => $results): ?>
        <h3><?php echo $department; ?></h3>
        <div class="department-logo">
            <img src="../Admin/uploads/<?php echo isset($results[0]['logo']) ? $results[0]['logo'] : 'No_signature'; ?>" alt="Department Logo">
        </div>
        <?php if (!empty($finalHigherResults[$department])): ?>
            <?php foreach ($finalHigherResults[$department] as $result): ?>
                <h4><?php echo $result['cname']; ?></h4>
                
                <table>
                    <tr>
                        <th>Higher Level (<?php echo round($finalHigherPercent, 2); ?>%)</th>
                        <th>Lower Level (<?php echo round($finalLowerPercent, 2); ?>%)</th>
                    </tr>
                    <tr>
                        <td>
                            <p><strong>Outcome:</strong> <?php echo $result['comlab'] . '. ' . $result['final_learning_out']; ?></p>
                        </td>
                        <td>
                            <?php
                            if (!empty($finalLowerResults[$department])) {
                                foreach ($finalLowerResults[$department] as $lowerResult) {
                                    if ($lowerResult['cname'] == $result['cname']) {
                                        echo '<p><strong>Outcome:</strong> ' . $lowerResult['comlab'] . '. ' . $lowerResult['final_learning_out'] . '</p>';
                                    }
                                }
                            } else {
                                echo '<p>No Lower Level found.</p>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Department:</strong> <?php echo $result['course_department']; ?></td>
                    </tr>
                </table>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No Higher Level found.</p>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

</body>
</html>
