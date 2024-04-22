<?php

session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

include('../Database/connection.php');

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.2.1/ckeditor.min.js"></script>
    <title>Document</title>
</head>

<style>
    /* #exportContent{
        display:none;
    } */
    ul{
        list-style-type:none;
    }
</style>

<script>
    function Export2Word(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
</script>
<body style="">

<button class="btn btn-primary" onclick="Export2Word('exportContent','html-content-with-image')">Download as Word</button>
<div id="exportContent">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style=""><img src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/logos.jpeg" alt="" width="180" height="90">
</a><br>
<div style="text-align:center; font-weight:bold">
<a style="text-align:center;">DE LA SALLE UNIVERSITY-DASMARINAS</a><br>
    <a style="text-align:center';"><?php echo strtoupper($category_name);?> </a><br>
    <a style="text-align:center;"><?php  echo strtoupper($course_departments);?> </a><br><br>
    <a style="text-align:center; padding-top: 5rem;">COURSE SYLLABUS</a><br>
</div><br>
  
    
    
    <span><a style='font-weight: bold;'><b>COURSE CODE</b></a><b><a style="padding-left: 100px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_code'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE TITLE</b></a><b><a style="padding-left: 97px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_tittle'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE TYPE</b></a><b><a style="padding-left: 103px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_Type'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE CREDIT</b></a><b><a style="padding-left: 84px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_credit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>LEARNING MODALITY</b></a><b><a style="padding-left: 36px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['learning_modality']?></a></span><br>
    <span><a style='font-weight: bold;'><b>PRE-REQUISITES</b></a><b><a style="padding-left: 82px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>CO-REQUISITES</b></a><b><a style="padding-left: 90px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['co_pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>CONSULTATION HOURS</b></a><b><a style="padding-left: 22px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_date']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_room']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_email']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_number']; ?></a></span>
    <p></p>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><a style='font-weight: bold;'><b>COURSE DESCRIPTION:</b></a><b><a style="padding-left: 100px; padding-right: 2rem; text-align: justify;"></a></b></a></span><br><br>
    <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_description']; ?></a></a><br><br>
    <span><p style='font-weight: bold;'>COURSE LEARNING OUTCOMES:</a><b><a style="padding-left: 100px; padding-right: 2rem;"></p></b></a></span>
    <span><a style=''>By the end of this course, students are expected to:</a></span>






<!-- COURSE LEARNING OUTCOMES: -->




    <?php

    

    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT `id`, `comlab`, `learn_out`   FROM `course_leaning`";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["comlab"]." . ". $row["learn_out"]. "</td>
            </tr>";
    }
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>


<!-- LEARNING PLAN -->

<p style="font-weight:bold">LEARNING PLAN</p>
<p style="font-weight:bold">Learning Outcomes for Midterm Period</p>


    <?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT `comlab`, `learn_out`, `topic_learn_out` FROM `course_leaning`";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd;text-align: left; padding-left: 8px;'>Learn Out Come</td>
        <td style='border: 1px solid #dddddd;text-align: left; padding-left: 8px;'>Topic Learn out</td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>" . $row["comlab"] . " . " . $row["learn_out"] . "</td>
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>";
    
        if (strpos($row['topic_learn_out'], 'TLO') !== false || strpos($row['topic_learn_out'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['topic_learn_out']);
        } else {
            echo $row['topic_learn_out'];
        }
    
        echo "</td>
            </tr>";
    }
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
<br><br>

<!-- TEACHING ASSESMENT GUIDE WITH COMPUTATION -->
<?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Execute query


// Check if any rows were returned
if ($result->num_rows > 0) {

    $total_hour_query = "SELECT `hours`,`asy`,`onsite`,
    SUM(hours) as total_hours, 
    SUM(asy) as total_asy_hours,
    SUM(onsite) as total_onsite_hours 
FROM 
    module_learning";
    $total_hour_result = mysqli_query($conn, $total_hour_query);
    $total_hour_row = mysqli_fetch_assoc($total_hour_result);

    $hours = $total_hour_row['hours'];
    $onsite = $total_hour_row['onsite'];
    $asy = $total_hour_row['asy'];
    $total_hour = $total_hour_row['total_hours'];
    $total_asy_hours = $total_hour_row['total_asy_hours'];
    $total_onsite_hours = $total_hour_row['total_onsite_hours'];

    // SQL query
    $sql = "SELECT 
    `id`, 
    `module_no`, 
    `week`, 
    `date`, 
    `teaching_activities`, 
    `technology`, 
    `onsite`, 
    `asy`, 
    `hours`
    FROM 
    `module_learning`";


    $result = $conn->query($sql);
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px; font-weight:bold;'>Module No and Learning Outcomes</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 18px; font-weight:bold;'>Weeks</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px; font-weight:bold;'>Teaching-Learning Activities / Assessment Strategy</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px; font-weight:bold;'>Technology Enabler</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;   font-weight:bold;'>Onsite / F2F</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;   font-weight:bold;'>Asynchronous</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;   font-weight:bold;'>Alloted Hours</td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>";
    
        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
        } else {
            echo $row['module_no'];
        }
    
        echo "</td>

                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["week"] . "   " . $row["date"] . "</td>
                
                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>";
    
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('<br>', "\n"), '<br><br>', $row['teaching_activities']);
        } else {
            echo $row['teaching_activities'];
        }
        echo "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["technology"] . "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . ($row['onsite'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . ($row['asy'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["hours"] . "</td>
    </tr>";
    
    }


    echo "<tr style='background-color:#ffbb33'>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;' colspan='4'><p style='font-weight:bold;'>TOTAL <p></td>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'> " . ($total_onsite_hours * $hours) . " </td>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'> " . ($total_asy_hours * $hours) . " </td>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'> " . $total_hour . " </td>
</tr>";



    
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<p style="">Learning Outcomes for Final Period</p>


<?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT `final_learning_out`, `final_topic_leaning_out` FROM `laerning_final`";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>Learn Out Come</td>
        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>Topic Learn out</td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>" . $row["final_learning_out"] . "</td>
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>";
    
        if (strpos($row['final_topic_leaning_out'], 'TLO') !== false || strpos($row['final_topic_leaning_out'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['final_topic_leaning_out']);
        } else {
            echo $row['final_topic_leaning_out'];
        }
    
        echo "</td>
            </tr>";
    }
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
<br><br>

<!-- TEACHING ASSESMENT GUIDE WITH COMPUTATION -->

<?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Execute query


// Check if any rows were returned
if ($result->num_rows > 0) {

    $total_hour_query = "SELECT `hours`,`asy`,`onsite`,
    SUM(hours) as total_hours, 
    SUM(asy) as total_asy_hours,
    SUM(onsite) as total_onsite_hours 
FROM 
    module_learning_final";
    $total_hour_result = mysqli_query($conn, $total_hour_query);
    $total_hour_row = mysqli_fetch_assoc($total_hour_result);

    $hours = $total_hour_row['hours'];
    $onsite = $total_hour_row['onsite'];
    $asy = $total_hour_row['asy'];
    $total_hour = $total_hour_row['total_hours'];
    $total_asy_hours = $total_hour_row['total_asy_hours'];
    $total_onsite_hours = $total_hour_row['total_onsite_hours'];

    // SQL query
    $sql = "SELECT 
    `id`, 
    `module_no`, 
    `week`, 
    `date`, 
    `teaching_activities`, 
    `technology`, 
    `onsite`, 
    `asy`, 
    `hours`
    FROM 
    `module_learning_final`";


    $result = $conn->query($sql);
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd;text-align: center; font-weight:bold; padding: 8px;'>Module No and Learning Outcomes</td>
        <td style='border: 1px solid #dddddd;text-align: center; font-weight:bold; padding: 18px;'>Weeks</td>
        <td style='border: 1px solid #dddddd;text-align: center; font-weight:bold; padding: 18px;'>Teaching-Learning Activities / Assessment Strategy</td>
        <td style='border: 1px solid #dddddd;text-align: center; font-weight:bold; padding: 8px;'>Technology Enabler</td>
        <td style='border: 1px solid #dddddd;text-align: center; font-weight:bold; padding: 8px;'>Onsite / F2F</td>
        <td style='border: 1px solid #dddddd;text-align: center; font-weight:bold; padding: 8px;'>Asynchronous</td>
        <td style='border: 1px solid #dddddd;text-align: center; font-weight:bold; padding: 8px;'>Alloted Hours</td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>";
    
        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
        } else {
            echo $row['module_no'];
        }
    
        echo "</td>

                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["week"] . "   " . $row["date"] . "</td>
                
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px; width: 50px'>";
    
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('<br>', "\n"), '<br><br>', $row['teaching_activities']);
        } else {
            echo $row['teaching_activities'];
        }
        echo "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["technology"] . "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . ($row['onsite'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . ($row['asy'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["hours"] . "</td>
    </tr>";
    
    }


    echo "<tr style='background-color:#ffbb33'>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;' colspan='4'><p style='font-weight:bold;'>TOTAL <p></td>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'> " . ($total_onsite_hours * $hours) . " </td>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'> " . ($total_asy_hours * $hours) . " </td>
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'> " . $total_hour . " </td>
</tr>";



    
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<p style="font-weight:bold">GRADING SYSTEM</p>


<?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent";
$total_percent_result = mysqli_query($conn, $total_percent_query);
$total_percent_row = mysqli_fetch_assoc($total_percent_result);
        
$total_percent = $total_percent_row['total_percent'];

// Fetch module learning records

// SQL query
$sql = "SELECT `description`, `percents` FROM `percent`";

// Execute query
$result = $conn->query($sql);
// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table style='width: 50%;
    border-collapse: collapse; border:none;'>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td style='text-align: left;'>" . $row["description"] . "</td>
                <td style='text-align: left;'>" . $row["percents"] . "</td>
                </tr>";
            }
            
            
    echo"<td style='' colspan='2'> <a>____________________________________</a></td>";

    echo "<tr style=''>
    <td style='text-align: left; padding: 8px;'><p style='font-weight:bold;'>TOTAL <p></td>
    <td style='text-align: left;'><p style='font-weight:bold;'>". ($total_percent) . "<p> </td>
    </tr>";
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
<br><br>


<span><b>Overall Final Grade</b> = <a style="text-decoration-line: underline;">Midterm + Final</a></span><br>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>2</a>




<div id="coursePolicies" style="text-align: justify; text-justify: inter-word;">
    <p style="font-weight:bold"> COURSE POLICIES AND REQUIREMENTS </p><br>
    <ol>
        <li>
            <p><strong>Office365 Activation:</strong> Please ensure that your Office365 account is working. Your Office365 account is needed to access both Schoolbook and MS Teams where your asynchronous and synchronous classes will be held.</p>
        </li>
        <br>
        <li>
            <p><strong>Enrollment in an E-Class:</strong> You will automatically be enrolled in your e-class which is based on your enrollment data.</p>
        </li>
        <br>
        <li>
            <p><strong>Traditional Blended Learning Model:</strong> This course adopts the traditional blended learning model. This means that there will be a mix of face-to-face and asynchronous classes. The majority of teaching-learning activities and assessments are undertaken onsite. The total number of onsite classes shall be 50% of the number of hours allotted for the whole semester.</p>
        </li>
        <br>
        <li>
            <p><strong>Online Asynchronous Sessions:</strong></p>
            <br>
            <ol type="a">
                <li><strong>Schoolbook (SB).</strong> Schoolbook shall be the only platform for asynchronous sessions.</li>
                <li><strong>Modules.</strong> Modules are self-paced learning resources for asynchronous sessions. These can be accessed in Schoolbook.</li>
                <li><strong>References.</strong> Each page section may contain uploaded references. These learning resources may be downloaded.</li>
                <li><strong>Asynchronous Activities.</strong> You are expected to read the modules as soon as they are uploaded. The learning content of the modules complements the online synchronous and face-to-face sessions.</li>
                <li><strong>Asynchronous Engagement.</strong> Your activities in the course can be tracked by your professor. This includes the time you spend in reading the lessons and answering the assessments.</li>
                <li><strong>Schoolbook Forum.</strong> All general concerns about the lessons and assessments in asynchronous sessions must be posted in the Schoolbook Forum. Response shall be made by your teacher within 48 hours.</li>
                <li><strong>Schoolbook Messaging.</strong> This shall be the mode of communication for private and/or confidential communications. Response shall be made by your teacher within 48 hours upon receipt of the same unless it falls on weekends or holidays, which shall be handled promptly the following working day.</li>
            </ol>
        </li>
        <br>
        <li>
          
            <p><strong>Onsite / Face-to-face (F2F) Sessions:</strong></p><br>
            <ol type="a">
                <li><strong>Face-to-face engagement.</strong> Your engagement in face-to-face classes is graded based on your class participation.</li>
                <li>Classroom. F2F classes shall be held at the classroom indicated in your Certificate of Registration. Should there be changes in the classroom venue, information will be given in advance.</li>
                <li><strong>Gospel Reading and Prayer.</strong> Each F2F session shall start with a Gospel reading and prayer. Your teacher may assign you, in advance, to do this.</li>
                <li><strong>F2F Meeting Schedule.</strong> The meeting schedule shall follow the time indicated in your official registration. The dates of F2F meetings are identified in the learning plan.</li>
                <li><strong>Attendance.</strong> Attendance in F2F meetings is required. Absence beyond 20% of the total number of F2F meetings will automatically be given a 0.0 grade in the subject.</li>
                <li><strong>Tardiness.</strong> A student who came in 1-30 minutes after the start of the face-to-face meeting is considered late. Three tardy attendance is equivalent to 1 absence.</li>
                <li><strong>Absence.</strong> A student is considered absent 30 minutes after the official class schedule.</li>
                <li><strong>Excuse from F2F classes.</strong> Students are excused in the F2F classes based on the provisions in the latest version of the Student Handbook.</li>
                <li><strong>Uniform.</strong> Wearing of prescribed uniform could be worn on Mondays, Thursdays, and Fridays, while Wednesdays and Saturdays are designated as wash days. Wearing of corporate attire could be worn every Tuesday. Civilian attire should follow the policy on dress code as stipulated in the latest version of the Student Handbook.</li>
            </ol>
        </li>
        <br>
        <li>
            <p><strong>Assessment and Grading System:</strong></p>
            <br>
            <ol type="a">
                <li><strong>Formative assessments.</strong> These are ungraded assessments.</li>
                <li><strong>Enabling assessments.</strong> These will comprise most of your graded assessments.</li>
                <li><strong>No. of Attempts.</strong> All enabling assessments, if given onsite, shall have 1 attempt only. For online enabling assessment shall have a maximum of 2 attempts.</li>
                <li><strong>Summative assessments.</strong> There shall be two summative assessments (midterm and final exams) for the entire semester.</li>
                    <ol type="i">
                        <li>There shall be two summative assessments (midterm and final exams) for the entire semester. These are designed to achieve the course learning outcomes.</li>
                        <li>Summative assessment shall be given onsite.</li>
                        <li>Output-based summative assessment shall be given to students at least fifteen days prior to scheduled Summative Exam Week.</li>
                    </ol>
                <li><strong>Lifeline.</strong> Only students with (1) valid reason as stated in the Student Handbook and IRR, and (2) given their proof of excuse on or before the next synchronous/F2F session, shall be given a lifeline on the enabling and summative assessments.</li>
                <li><strong>Rubric.</strong> All online non-quiz or non-discrete types of assessment shall have a rubric or criteria for rating the students’ tasks.</li>
                <li><strong>Grading.</strong> All online assessments should be checked and graded by the teacher before the submission of midterm and final grades.</li>
                <li><strong>Grading system.</strong> The following shall be the basis for the computation of grades per term for traditional blended classes.</li>
                                                <?php  
                            // Database connection details
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "syllabus";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                

                            // Fetch module learning records

                            // SQL query
                            $sql = "SELECT `description`, `percents` FROM `percent`";

                            // Execute query
                            $result = $conn->query($sql);

                            // Check if any rows were returned
                            if ($result->num_rows > 0) {
                                // Output table header
                                
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<ol type='i'>
                                            <li style='text-align: left; padding: 8px;'>" . $row["description"] ." ". $row["percents"] ."</li>
                                        </ol>";
                                }
                            }
                            // Close connection
                            $conn->close();
                            ?>                
                <li><strong>Gradebook.</strong> Students can see the breakdown of grades in their Assessment tab.</li>
            </ol>
        </li>
        <br>
        <li>
            <p><strong>Self-Care:</strong></p>
            <ol type="a">
            <li><strong>Schedule. </strong> The schedule of self-care week for the <?php echo $user4['second_call']." ".$user4['year'];?> is on <?php echo $user5['date'];?>. During this week, there shall be no asynchronous/synchronous meetings, F2F classes, new modules, new assessments, and deadlines.</li>
                <li><strong>Prerogative.</strong> Students may avail of the self-care program, whether online or onsite, provided by the different units of the University.</li>
            </ol>
        </li>
        <br>
        <li>
            <p><strong>Data Privacy:</strong></p>
            <ol type="a">
                <li><strong>Access to the MS Teams.</strong> Only students who are officially enrolled shall be part of the MS Teams and have access to all the resources including the recording.</li>
                <li><strong>Guests.</strong> Inviting people that are not part of the class in synchronous meetings is strictly prohibited, unless approved by the subject teacher.</li>
            </ol>
        </li>
        <br>
        <li>
            <p><strong>Copyright and Plagiarism:</strong></p>
            <ol type="a">
                <li>Using of any illegally obtained software and other technology tools is strictly prohibited.</li>
                <li>Students are encouraged to use their original photos, videos, and other resources.</li>
                <li>Giving of password to Schoolbook and Office 365 is strictly prohibited.</li>
                <li>This subject shall abide by the policies pertaining to intellectual property, copyright, and plagiarism as stipulated in the latest edition of the Student Handbook.</li>
                <li>Any plagiarized work, whether in part or full, shall mean a grade of 0.0 for the assessment.</li>
            </ol>
        </li>
        <br>
        <li>This course shall abide by any institutional policies that may be released after the approval of this syllabus. Any such policy shall be posted within the e-class at the forums section, news feed. It will also be briefly discussed during the soonest synchronous meeting.</li>
    </ol>
</div>



<p style="font-weight:bold">REFERENCES</p>
<p style="font-weight:bold">On-Site References</p>

<?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT `Provider`, `Reference_Material` FROM `onsite_reffence`";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 18px;'><p style='font-weight:bold'>Provider</p></td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'><p style='font-weight:bold'>Reference Material</p></td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["Provider"] . "</td>
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>" . $row["Reference_Material"] . "</td>
            </tr>";
    }
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
<br>


<p style="font-weight:bold">Online References</p>

<?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT  `e_provider`, `refference_material` FROM `online_refference`";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'><p style='font-weight:bold'>Call Number / E-provider</p></td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'><p style='font-weight:bold'>Reference Material</p></td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["e_provider"] . "</td>
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>" . $row["refference_material"] . "</td>
            </tr>";
    }
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
<br><br>


<span><b>Prepared:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:30px;" class="course"><?php echo $course_departments ?></a></b></span><br>

<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:130px; padding-top:10px;" class="term_year"><?php echo $user4['term']." ".$user4['year'] ?></a></span>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="padding-left:145px; padding-top:10px;" src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/<?php echo $dept_head_signature ?>" class="course" alt="Department Head Signature"></p>

<span><b>Approved by:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:20px;" class="course"><?php echo $dept_head ?></a></b></span><br>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:140px;" class="course"><?php echo $dept_head_position.", ".$course_initial ?></a></span><br>


<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="padding-left:145px; padding-top:10px;" src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/<?php echo $deans_category_signature ?>" class="course" alt="Department Head Signature"></p>

<span><b>Approved by:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:20px;" class="course"><?php echo $category_dean ?></a></b></span><br>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:140px;" class="course"><?php echo $category_dean_position.", ".$category_initial ?></a></span><br><br><br>







&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style=""><img src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/logos.jpeg" alt="" width="180" height="90">
<div style="text-align:center; font-weight:bold">
<a style="text-align:center;">DE LA SALLE UNIVERSITY-DASMARINAS</a><br>
    <a style="text-align:center';"><?php echo strtoupper($category_name);?> </a><br>
    <a style="text-align:center;"><?php  echo strtoupper($course_departments);?> </a><br><br>
    <a style="text-align:center; padding-top: 5rem;">PROGRAM LEARNING OUTCOME - COURSE LEARNING OUTCOME </a><br>
    <a>MAPPING TABLE FOR <?php echo strtoupper($cname) ?> </a>
</div><br><br>





    
    
    <span><a style='font-weight: bold;'>COURSE CODE</a><b><a style="padding-left: 100px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_code'];?></a></span><br>
    <span><a style='font-weight: bold;'>COURSE TITLE</a><b><a style="padding-left: 97px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_tittle'];?></a></span><br>
    <span><a style='font-weight: bold;'>COURSE TYPE</a><b><a style="padding-left: 103px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_Type'];?></a></span><br>
    <span><a style='font-weight: bold;'>COURSE CREDIT</a><b><a style="padding-left: 84px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_credit']; ?></a></span><br>
    <span><a style='font-weight: bold;'>LEARNING MODALITY</a><b><a style="padding-left: 36px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['learning_modality']?></a></span><br>
    <span><a style='font-weight: bold;'>PRE-REQUISITES</a><b><a style="padding-left: 82px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'>CO-REQUISITES</a><b><a style="padding-left: 90px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['co_pre_requisit']; ?></a></span><br><br>

    

    <?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Execute query


// Check if any rows were returned
if ($result->num_rows > 0) {


    // SQL query
    $sql = "SELECT `id`, `learn_out_mapping`, `pl1`, `pl2`, `pl3`, `pl4`, `pl5`, `pl6`, `pl7`, `pl8`, `pl9` FROM `mapping_table`";


    $result = $conn->query($sql);
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
        <tr>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;' rowspan='2'>Course Learning Outcome</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;' colspan='9'>Program Learning Outcomes</th>
        </tr>
        <tr>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 1</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 2</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 3</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 4</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 5</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 6</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 7</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 8</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>PLO 9</th>
        </tr>";
    
   
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>" . $row["learn_out_mapping"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl1"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl2"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl3"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl4"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl5"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl6"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl7"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl8"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["pl9"] . "</td>
    </tr>";
    
    }




    
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>



<p style="font-style:italic; margin-top: -10px; margin-left: 10px; ">NOTE: Provide a check mark on the areas in which the program learning outcome (PLO) is hit by the course
learning outcome (CLO)</p><br><br>




&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style=""><img src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/logos.jpeg" alt="" width="180" height="90">


<div style="text-align:center; font-weight:bold">
<a style="text-align:center;">DE LA SALLE UNIVERSITY-DASMARINAS</a><br>
    <a style="text-align:center';"><?php echo strtoupper($category_name);?> </a><br>
    <a style="text-align:center;"><?php  echo strtoupper($course_departments);?> </a><br><br>
    <a style="text-align:center; padding-top: 5rem;">GRADUATE ATTRIBUTES (DESCRIPTORS/INSTITUTIONAL LEARNING OUTCOMES) – </a>
<a style="text-align:center;">PROGRAM LEARNING OUTCOME MAPPING TABLE FOR  <?php echo strtoupper($cname) ?> </a>
</div><br><br>
    

    

    <?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Execute query


// Check if any rows were returned
if ($result->num_rows > 0) {


    // SQL query
    $sql = "SELECT `id`, `program_learn`, `rate1`, `rate2`, `rate3`, `rate4`, `rate5` FROM `decriptors`";


    $result = $conn->query($sql);
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
        <tr>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Program Learning Outcomes</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>1</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>2</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>3</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>4</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>5</th>
        </tr>";
    
   
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>" . $row["program_learn"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["rate1"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["rate2"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["rate3"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["rate4"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["rate5"] . "</td>

    </tr>";
    
    }




    
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<br>

<p style="font-style:italic; margin-top: -10px; margin-left: 10px; ">NOTE:  Provide a check mark on the areas in which the Graduate Attribute (Descriptors/Institutional Learning Outcome) is hit by the program learning outcome (PLO).  Kindly refer to the descriptors (institutional learning outcomes) to clearly understand what each attribute refers to or expects from its graduates.

</p><br><br>



&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style=""><img src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/logos.jpeg" alt="" width="180" height="90"><br><br>
   
    
<div style="text-align:center; font-weight:bold">
<a style="text-align:center;">DE LA SALLE UNIVERSITY-DASMARINAS</a><br>
    <a style="text-align:center';"><?php echo strtoupper($category_name);?> </a><br>
    <a style="text-align:center;"><?php  echo strtoupper($course_departments);?> </a><br><br>
    <a style="text-align:center; padding-top: 5rem;">GRADUATES ATTRIBUTES AND INSTITUTIONAL LEARNING OUTCOMES (ILOs)</a><br>
</div><br><br>
    

    <?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Execute query


// Check if any rows were returned
if ($result->num_rows > 0) {


    // SQL query
    $sql = "SELECT `id`, `graduate_att`, `descriptors_learn_out` FROM `graduates_attributes`";


    $result = $conn->query($sql);
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
        <tr>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Graduate Attribute (GA)</th>
        <th style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Descriptors (Institutional Learning Outcome)</th>
        </tr>";
    
   
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>" . $row["graduate_att"] . "</td>

        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>";
    
        if (strpos($row['descriptors_learn_out'], '\n') !== false || strpos($row['descriptors_learn_out'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('<br>', "\n"), '<br><br>', $row['descriptors_learn_out']);
        } else {
            echo $row['descriptors_learn_out'];
        }
    
        echo "</td>

    </tr>";
    
    }




    
    
    
    // Close table
    echo "</table>";
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>

<br><br><br>


    <p>____________________________</p>
<p style="font-style: italic; margin-top: -10px; margin-left: 10px;">
  Approved in <?= date("F") ." ".date("Y") ?> during a multi-sectoral committee specifically convened for the purpose of coming up with descriptions for the graduate attributes.
</p>











</div>






    
</body>
</html>