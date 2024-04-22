<?php

session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

include('../Database/connection.php');

$email = $_SESSION['email'];
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
            c.`dean_signature` AS `dean_signatures`,
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
        $course_departments = $row['course_departments'];
        $category_dean = $row['deans'];
        $category_dean_position = $row['deans_position'];
        $dept_head = $row['course_dept_name'];
        $dept_head_position = $row['dept_position'];
        $dept_head_signature = $row['dept_signatures'];
        $deans_category_signature = $row['dean_signatures'];
    }
} 

$sql = mysqli_query($conn,"SELECT * FROM course_syllabus");
$user = mysqli_fetch_assoc($sql);

$sql4 = mysqli_query($conn,"SELECT * FROM semestral");
$user4 = mysqli_fetch_assoc($sql4);

$sql5 = mysqli_query($conn,"SELECT * FROM module_learning");
$user5 = mysqli_fetch_assoc($sql5);

$sql = "SELECT * FROM course_leaning";

require_once 'read_php_word/vendor/autoload.php'; // Include PHPWord's autoload file

// Create a new PHPWord instance
$phpWord = new \PhpOffice\PhpWord\PhpWord();

// Add a section to the document
$section = $phpWord->addSection();

// Add styled text to the document
$imagePath = '../img/logos.png'; // Path to your image
$section->addImage(
    $imagePath,
    array(
        'width' => 140,             // Adjust width as needed
        'height' => 70,             // Adjust height as needed
        'wrappingStyle' => 'infront',  // Specify wrapping style (e.g., 'behind', 'infront', 'square', 'tight')
        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER // Center the image horizontally
    )
);

$section->addText('DE LA SALLE UNIVERSITY - DASMARINAS', array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'), array('alignment' => 'center'));
$section->addText(strtoupper($category_name), array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'), array('alignment' => 'center'));
$section->addText(strtoupper($course_departments), array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'), array('alignment' => 'center'));

$section->addTextBreak(1);

$section->addText(
    'COURSE SYLLABUS',
    array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'),
    array('alignment' => 'center') // Adjust marginTop value as needed
);

$section->addTextBreak(1);

$section->addText('COURSE CODE                  :            ' . strtoupper($user['course_code']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('COURSE TITLE                  :            ' . strtoupper($user['course_tittle']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('COURSE TYPE                   :            ' . strtoupper($user['course_Type']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('COURSE CREDIT               :            ' . strtoupper($user['course_credit']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('LEARNING MODALITY   :            ' . strtoupper($user['learning_modality']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('PRE-REQUISITES              :            ' . strtoupper($user['pre_requisit']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('CO-REQUISITES                :            ' . strtoupper($user['co_pre_requisit']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('PROFESSOR                       :            ' . strtoupper($user['professor']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('                                             :            ' . strtoupper($user['consultation_hours_date']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('                                             :            ' . strtoupper($user['consultation_hours_room']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('                                             :            ' . strtoupper($user['consultation_hours_email']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
$section->addText('                                             :            ' . strtoupper($user['consultation_hours_number']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));

$section->addText('COURSE DESCRIPTION:', array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'), array('alignment' => 'left'));

$section->addText('    ' . ($user['course_description']), array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));

$section->addText('COURSE LEARNING OUTCOMES:', array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'), array('alignment' => 'left'));

$sql = "SELECT * FROM course_leaning ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $section->addText($row['comlab'] . ' . ' . $row['learn_out'], array('size' => 11, 'name' => 'Times New Roman', 'alignment' => 'left'));
    }
}


$section->addText('LEARNING PLAN', array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'), array('alignment' => 'left'));
$section->addText('Learning Outcomes for Midterm Period', array('bold' => true, 'size' => 9, 'name' => 'Times New Roman'), array('alignment' => 'left'));



$styleTable = array('borderSize' => 6, 'borderColor' => '#000000', 'cellMargin' => 80);
$styleFirstRow = array('borderBottomSize' => 1);
$styleCell = array('valign' => 'center');
$fontStyle = array('bold' => true, 'align' => 'center');
$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
$tableWidth = 5000; // You can adjust this value as needed

$table = $section->addTable('Fancy Table');
$table->setWidth($tableWidth); // Set the width of the table
$table->addRow(900);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Course Learning Outcomes'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Topic Learning Outcomes'), $fontStyle);

// Fetch data from the database and populate the table
$sql = "SELECT * FROM course_leaning ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table->addRow();
        $table->addCell(3000)->addText($row['comlab'].".".$row['learn_out']);
        $topicLearnOut = $row['topic_learn_out'];
        if (strpos($topicLearnOut, 'TLO') !== false || strpos($topicLearnOut, "\n") !== false) {
            $topicLearnOut = str_replace("\n", '<w:br/>', $topicLearnOut); // Use Word specific break tag
        }
        $table->addCell(3000)->addText($topicLearnOut);
    }
}

$section->addTextBreak(1);


$styleTable = array('borderSize' => 6, 'borderColor' => '#000000', 'cellMargin' => 80);
$styleFirstRow = array('borderBottomSize' => 1);
$styleCell = array('valign' => 'center');
$fontStyle = array('bold' => true, 'align' => 'center');
$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
$tableWidth = 5000; // You can adjust this value as needed

$table = $section->addTable('Fancy Table');
$table->setWidth($tableWidth); // Set the width of the table
$table->addRow(900);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Module No and Learning Outcomes'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Week'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Teaching-Learning Activities / Assessment Strategy'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Technology Enabler'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Onsite / F2F'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Asynchronous'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Alloted Hours'), $fontStyle);

// Fetch data from the database and populate the table
$sql = "SELECT * FROM module_learning ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    $total_hour_query = "SELECT 
        SUM(hours) as total_hours, 
        SUM(asy) as total_asy_hours,
        SUM(onsite) as total_onsite_hours 
    FROM module_learning";
    $total_hour_result = mysqli_query($conn, $total_hour_query);
    $total_hour_row = mysqli_fetch_assoc($total_hour_result);
    
    $total_hour = $total_hour_row['total_hours'];
    $total_asy_hours = $total_hour_row['total_asy_hours'];
    $total_onsite_hours = $total_hour_row['total_onsite_hours'];

    while ($row = $result->fetch_assoc()) {
        $table->addRow();
        $topicLearnOut = $row['module_no'];
        if (strpos($topicLearnOut, 'TLO') !== false || strpos($topicLearnOut, "•") !== false) {
            $topicLearnOut = str_replace("\n", '<w:br/><w:br/>', $topicLearnOut); // Use Word specific break tag
        }
        $table->addCell(3000)->addText($topicLearnOut);

        $table->addCell(3000)->addText($row['week'].".".$row['date']);
        $teaching_activities = $row['teaching_activities'];
        if (strpos($teaching_activities, '•') !== false || strpos($teaching_activities, "•") !== false) {
            $teaching_activities = str_replace("\n", '<w:br/><w:br/>', $teaching_activities); // Use Word specific break tag
        }
        $table->addCell(3000)->addText($teaching_activities );
        
        $table->addCell(3000)->addText($row['technology'] );
        $table->addCell(3000)->addText($row['onsite'] == 1 ? '/' : '');
        $table->addCell(3000)->addText($row['asy'] == 1 ? '/' : '');
        $table->addCell(3000)->addText($row['hours']);
    }
    $table->addRow();
    $table->addCell(21000, ['gridSpan' => 4])->addText('TOTAL'); // Assuming 3000 units per cell

    $table->addCell(3000)->addText($total_onsite_hours);
    $table->addCell(3000)->addText($total_asy_hours);
    $table->addCell(3000)->addText($total_hour);
}

$section->addTextBreak(1);

$section->addText('Learning Outcomes for Final Period', array('bold' => true, 'size' => 9, 'name' => 'Times New Roman'), array('alignment' => 'left'));



$styleTable = array('borderSize' => 6, 'borderColor' => '#000000', 'cellMargin' => 80);
$styleFirstRow = array('borderBottomSize' => 1);
$styleCell = array('valign' => 'center');
$fontStyle = array('bold' => true, 'align' => 'center');
$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
$tableWidth = 5000; // You can adjust this value as needed

$table = $section->addTable('Fancy Table');
$table->setWidth($tableWidth); // Set the width of the table
$table->addRow(900);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Course Learning Outcomes'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Topic Learning Outcomes'), $fontStyle);

// Fetch data from the database and populate the table
$sql = "SELECT * FROM  laerning_final ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $table->addRow();
        $table->addCell(3000)->addText($row['final_learning_out']);
        $topicLearnOut = $row['final_topic_leaning_out'];
        if (strpos($topicLearnOut, 'TLO') !== false || strpos($topicLearnOut, "\n") !== false) {
            $topicLearnOut = str_replace("\n", '<w:br/>', $topicLearnOut); // Use Word specific break tag
        }
        $table->addCell(3000)->addText($topicLearnOut);
    }
}

$section->addTextBreak(1);


$styleTable = array('borderSize' => 6, 'borderColor' => '#000000', 'cellMargin' => 80);
$styleFirstRow = array('borderBottomSize' => 1);
$styleCell = array('valign' => 'center');
$fontStyle = array('bold' => true, 'align' => 'center');
$phpWord->addTableStyle('Fancy Table', $styleTable, $styleFirstRow);
$tableWidth = 5000; // You can adjust this value as needed

$table = $section->addTable('Fancy Table');
$table->setWidth($tableWidth); // Set the width of the table
$table->addRow(900);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Module No and Learning Outcomes'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Week'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Teaching-Learning Activities / Assessment Strategy'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Technology Enabler'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Onsite / F2F'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Asynchronous'), $fontStyle);
$table->addCell(2000, $styleCell)->addText(htmlspecialchars('Alloted Hours'), $fontStyle);

// Fetch data from the database and populate the table
$sql = "SELECT * FROM module_learning_final ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    $total_hour_query = "SELECT 
        SUM(hours) as total_hours, 
        SUM(asy) as total_asy_hours,
        SUM(onsite) as total_onsite_hours 
    FROM module_learning_final";
    $total_hour_result = mysqli_query($conn, $total_hour_query);
    $total_hour_row = mysqli_fetch_assoc($total_hour_result);
    
    $total_hour = $total_hour_row['total_hours'];
    $total_asy_hours = $total_hour_row['total_asy_hours'];
    $total_onsite_hours = $total_hour_row['total_onsite_hours'];

    while ($row = $result->fetch_assoc()) {
        $table->addRow();
        $topicLearnOut = $row['module_no'];
        if (strpos($topicLearnOut, 'TLO') !== false || strpos($topicLearnOut, "•") !== false) {
            $topicLearnOut = str_replace("\n", '<w:br/><w:br/>', $topicLearnOut); // Use Word specific break tag
        }
        $table->addCell(3000)->addText($topicLearnOut);

        $table->addCell(3000)->addText($row['week'].".".$row['date']);
        $teaching_activities = $row['teaching_activities'];
        if (strpos($teaching_activities, '•') !== false || strpos($teaching_activities, "•") !== false) {
            $teaching_activities = str_replace("\n", '<w:br/><w:br/>', $teaching_activities); // Use Word specific break tag
        }
        $table->addCell(3000)->addText($teaching_activities );
        
        $table->addCell(3000)->addText($row['technology'] );
        $table->addCell(3000)->addText($row['onsite'] == 1 ? '/' : '');
        $table->addCell(3000)->addText($row['asy'] == 1 ? '/' : '');
        $table->addCell(3000)->addText($row['hours']);
    }
    $table->addRow();
    $table->addCell(21000, ['gridSpan' => 4])->addText('TOTAL'); // Assuming 3000 units per cell

    $table->addCell(3000)->addText($total_onsite_hours);
    $table->addCell(3000)->addText($total_asy_hours);
    $table->addCell(3000)->addText($total_hour);
}

$section->addTextBreak(1);




$styleTable1 = array('borderSize' => 6, 'borderColor' => '#FFFFFF', 'cellMargin' => 80);
$styleFirstRow1 = array('borderBottomSize' => 1);
$styleCell1 = array('valign' => 'center');
$fontStyle1 = array('bold' => true, 'align' => 'center');
$phpWord->addTableStyle('Fancy Table', $styleTable1, $styleFirstRow1);
$tableWidth1 = 3000; // You can adjust this value as needed

$table1 = $section->addTable('Fancy Table');
$table1->setWidth($tableWidth1); // Set the width of the table
// Adjust the table style to remove border size

$table1 = $section->addTable('Fancy Table');
$table1->setWidth($tableWidth1); // Set the width of the table
$table1->addRow(900);
$table1->addCell(2000, $styleCell1)->addText(htmlspecialchars('GRADING SYSTEM'), $fontStyle1);

// Fetch data from the database and populate the table
$sql = "SELECT * FROM percent ORDER BY id ASC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    
    $total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent";
    $total_percent_result = mysqli_query($conn, $total_percent_query);
    $total_percent_row = mysqli_fetch_assoc($total_percent_result);
            
    $total_percent = $total_percent_row['total_percent'];

    while ($row = $result->fetch_assoc()) {
        $table1->addRow();
        $table1->addCell(3000, $styleCell1)->addText($row['description']);
        $table1->addCell(3000, $styleCell1)->addText($row['percents']);
    }
    $table1->addRow();
    $table1->addCell(21000, $styleCell1)->addText('TOTAL'); // Assuming 3000 units per cell
    $table1->addCell(3000, $styleCell1)->addText($total_percent);
 
}

$section->addTextBreak(1);


$section->addText('Overall Final Grade = Midterm + Final 
2 
', array('bold' => true, 'size' => 9, 'name' => 'Times New Roman'), array('alignment' => 'left'));


$section->addTextBreak(1);



$section->addText('COURSE POLICIES AND REQUIREMENTS', array('bold' => true, 'size' => 11, 'name' => 'Times New Roman'), array('alignment' => 'left'));
$section->addText('1.  Office365 Activation.  Please ensure that your Office365 account is working. Your Office365 account is needed to access both Schoolbook and MS Teams where your asynchronous and synchronous classes will be held.
', array('normal' => true, 'size' => 10, 'name' => 'Times New Roman'), array('alignment' => 'left'));
$section->addText('2.  Enrollment in an E-Class.  Please ensure that your Office365 account is working. Your Office365 account is needed to access both Schoolbook and MS Teams where your asynchronous and synchronous classes will be held.
', array('normal' => true, 'size' => 10, 'name' => 'Times New Roman'), array('alignment' => 'left'));
$section->addText('3.  Traditional Blended Learning Model.  This course adopts the traditional blended learning model. This means that there will be a mix of face-to-face and asynchronous classes. Majority of teaching-learning activities and assessments are undertaken onsite. The total number of onsite classes shall be 50% of the number of hours allotted for the whole semester.
', array('normal' => true, 'size' => 10, 'name' => 'Times New Roman'), array('alignment' => 'left'));
$section->addText('4. Online Asynchronous Sessions.', array('normal' => true, 'size' => 10, 'name' => 'Times New Roman'), array('alignment' => 'left'));    










// Save the document as a Word file
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$docFileName = 'generated_document.docx';
$objWriter->save($docFileName);

// Set headers to force download
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=$docFileName");
readfile($docFileName); // Output the file contents
exit; // Terminate the script
?>
