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
















// Save the document as a Word file
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$docFileName = 'chillyfacts.docx';
$objWriter->save($docFileName);

// Set headers to force download
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=$docFileName");
readfile($docFileName); // Output the file contents
exit; // Terminate the script
?>
