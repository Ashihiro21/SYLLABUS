 
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
        "Classify"  
    ];

    
    $apply = [
        "Apply",
        "Implement",
        "Use",
        "Solve",
        "Demonstrate"  
    ];
    
    $analysis = [
        "Analyze",
        "Compare",
        "Contrast",
        "Differentiate",
        "Investigate"  
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
    
    // Calculate percentages
    $higherPercent = ($higherMatches / count($knowledge)) * 100;
    $lowerPercent = ($lowerMatches / count($comprehension)) * 100;
    $applyPercent = ($applyMatches / count($apply)) * 100;
    $analysisPercent = ($analysisMatches / count($analysis)) * 100;
    
    $html .= '<div class="center">';
    $html .= '<table>';
    $html .= '<tr>';
    $html .= '<th>K (' . round($higherPercent, 2) . '%)</th>';
    $html .= '<th>C (' . round($lowerPercent, 2) . '%)</th>';
    $html .= '<th>AP (' . round($applyPercent, 2) . '%)</th>';
    $html .= '<th>AN (' . round($analysisPercent, 2) . '%)</th>';
    $html .= '<th>No.of Items</th>';
    $html .= '</tr>';
    $html .= '<tr>';
    
   // Initialize total count variable
    $totalCount = 0;

   // Define an array of filtered arrays
$filteredArrays = [
    'filteredWords' => $filteredWords,
    'filteredColors' => $filteredColors,
    'filteredApply' => $filteredApply,
    'filteredAnalysis' => $filteredAnalysis
];

// Initialize total count
$totalCount = 0;

// Get array keys
$keys = array_keys($filteredArrays);

// Initialize index
$i = 0;

// Start the loop
while ($i < count($filteredArrays)) {
    $key = $keys[$i];
    $filteredArray = $filteredArrays[$key];

    $html .= '<td>';
    if (!empty($filteredArray)) {
        $html .= '<p>' . count($filteredArray) . '</p>'; // Display count of filtered elements
        // Add count to total
        $totalCount += count($filteredArray);
        // Check if $key is 'filteredColors' and $higherMatches is 0
        if ($key === 'filteredColors' && $higherMatches == 0) {
            $html .= '<p class="footer">Add More Higher Level to Make higher Level.</p>';
        }
    } else {
        $html .= '<p>0</p>';
    }
    $html .= '</td>';

    // Increment index
    $i++;
}

// Add total count of all filtered elements to another table cell
    $html .= '<td>';
    $html .= '<p>' . $totalCount . '</p>';
    $html .= '</td>';

    $html .= '</tr>';
    $html .= '</table>';
    $html .= '</div>';
    
    // Close connection
    $conn->close();

    
    
    