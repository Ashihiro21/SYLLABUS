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
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $department = $row['department'];
    $_SESSION['catid'] = $row['catid']; // Add department to session
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

<!DOCTYPE html>
<html>
<head>
    <title>SYLLABUS</title>
    <link rel="icon" type="image/png" href="../img/DLSU-D.png"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="nav.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.2.1/ckeditor.min.js"></script>
</head>
<style>
    body{
        overflow-x: hidden;
    }
 
 .hide-id {
    display: none;
}

.container-box {
    display: flex;
    flex-direction: column;
    align-items: left;
    margin-left: 15rem;
}

.container-fluid > * {
    margin-bottom: 10px;
}

.container-fluid span, .container-fluid p {
    text-align: left; 
}

.container-fluid a {
    text-decoration: none; 
}

.logos {
    margin-left: 44rem;
    margin-right: 44rem;
}

.header-title {
    margin-left: 15rem;
}

.desc {
    text-indent: 20px;
}

.descriptions {
    margin-left: 30px;
}

td {
    padding: 5px;
}

.text-wrap {
    max-width: 1200px;
    overflow-wrap: break-word;
    overflow: hidden;
    word-spacing: 12px;
}

.text-indent {
    margin-left: 5rem;
}

.c {
    list-style-type: lower-roman;
}

.account-header {
    padding-top: 20px;
    padding-bottom: 5px;
}

.dl-word {
    margin-left: 1rem;
    background-color: #0d6efd;
}

.dl-word:hover {
    background-color: #0a5cb8;
}

.btn-primary {
    margin-left: 50rem;
    white-space: nowrap;
}

.btn-secondary {
    margin-left: 30rem;
}

.sysllabus_button {
    margin-left: 50rem; 
}

.custom-card {
    margin: 13.5rem;
    border: 1px solid #6c757d;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.9);
}

.custom-policy {
    margin: 13.5rem;
    border: 1px solid #6c757d;
    height: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.9);
}

.text-rotate {
    transform: rotate(-180deg);
    white-space: nowrap;
    writing-mode: vertical-lr;
}

.modal-body .btn-primary {
    float: left;
}

.inline-images {
    display: flex;
    align-items: center;
    margin-left: 40%;
}

.img-inline {
    display: inline-block;
    vertical-align: middle;
}

.initial_1 {
    padding-left: 4rem;
    padding-top: 2rem;
}
.dropdown-items{
    color: black;
}
.dropdown-items:hover{
    color: black;
    width: 5rem;
    cursor: pointer;
}
#position{
    cursor: default;
}
</style>
<body>
    <nav>
        <span class="mb-4">
            <a href="generate_pdf_syllabus.php" class="btn btn-danger">Download as PDF</a>
            <!-- Add Edit Button -->
            <?php include("index.php"); ?>
            <a href="generate_pdf_high_and_low.php" class="btn btn-danger">High and Low Report</a>
            <a href="generate_pdf_tos.php" class="btn btn-danger">TOS Report</a>
        </span>
        <span style="margin-left: 45%;">
            <div class="dropdown">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    Dropdown button
                </button>
                <div class="dropdown-menu" style="width:15rem; margin-right: 5rem; margin-top:1rem;">
                    <a class="dropdown-items" id="position"><?php echo $position; ?></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-items" href="#">Link 2</a><br>
                    <a class="dropdown-items" href="#">Another link</a><br>
                    <a class="dropdown-items" <button type="button"  data-toggle="modal" data-target="#editModal">
                        Edit Details
                    </button></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-items" href="logout.php">Logout</a>
                </div>
            </div>
        </span>
    </nav>

   
     
    <?php include 'edit_detail.php';?>

