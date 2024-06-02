<?php

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["role"] !== "user") {
    // If user is not logged in or not a user, redirect to login page
    header("Location: HIGHER_RANKS/login.php");
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
            co.`dean_signature` AS `dean_signatures`,
            co.`cname`,
            co.`course_department` AS `course_departments`,
            co.`initial` AS `course_initial`,
            co.`department_name` AS `course_dept_name`,
            co.`department_position` AS `dept_position`,
            co.`dept_signature` AS `dept_signatures`,
            co.`commitee_signature` AS `commitee_signatures`
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
        $_SESSION['department'] = $row['department'];
        $_SESSION['catid'] = $row['catid'];
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
        $commitee_signatures = $row['commitee_signatures'];
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
    <link rel="icon" type="image/png" href="../img/DLSU-D.png"/>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.2.1/ckeditor.min.js"></script>
    <title>SYLLABUS</title>
</head>

<style>
    #exportContent{
        display:none;
    }
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
<body>

<button class="btn btn-primary" style="margin-left:1rem;" onclick="Export2Word('exportContent','html-content-with-image')">Download as Word</button>
<div id="exportContent">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><img src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/DLSU-D.png" alt="" width="100" height="100">
</a>
<img src="http://localhost/Github/SYLLABUS/ADMIN/uploads/<?php echo isset($categories_logo) ? $categories_logo : 'No_signature'; ?>" alt="" width="100" height="100">
</a>
<div style="text-align:center; font-weight:bold">
<a style="text-align:center;">DE LA SALLE UNIVERSITY-DASMARINAS</a><br>
    <a style="text-align:center';"><?php echo strtoupper($category_name);?> </a><br>
    <a style="text-align:center;"><?php  echo strtoupper($course_departments);?> </a><br><br>
    <a style="text-align:center; padding-top: 5rem;">COURSE SYLLABUS</a><br>
</div><br>
  
  <?php

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];


// Using prepared statement to prevent SQL injection
$sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department=? and catid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $department,$catid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>


    <span><a style='font-weight: bold;'><b>COURSE CODE</b></a><b><a style="padding-left: 100px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_code'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE TITLE</b></a><b><a style="padding-left: 97px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_tittle'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE TYPE</b></a><b><a style="padding-left: 103px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_Type'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE CREDIT</b></a><b><a style="padding-left: 84px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_credit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>LEARNING MODALITY</b></a><b><a style="padding-left: 36px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['learning_modality']?></a></span><br>
    <span><a style='font-weight: bold;'><b>PRE-REQUISITES</b></a><b><a style="padding-left: 82px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>CO-REQUISITES</b></a><b><a style="padding-left: 90px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['co_pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>CONSULTATION HOURS</b></a><b><a style="padding-left: 22px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['consultation_hours_date']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['consultation_hours_room']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['consultation_hours_email']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['consultation_hours_number']; ?></a></span>
    <p></p>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><a style='font-weight: bold;'><b>COURSE DESCRIPTION:</b></a><b><a style="padding-left: 100px; padding-right: 2rem; text-align: justify;"></a></b></a></span><br><br>
    <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_description']; ?></a></a><br><br>
    

    
    <?php
    }
} else {
    echo "No courses found for the selected department.";
}

// Close the database connection
$conn->close();
?>
    <span><p style='font-weight: bold;'>COURSE LEARNING OUTCOMES:</a><b><a style="padding-left: 100px; padding-right: 2rem;"></p></b></a></span>
    <span><a>By the end of this course, students are expected to:</a></span>


<br>



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

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

$sql = "SELECT `id`, `comlab`, `learn_out`   FROM `course_leaning` WHERE department = $department AND catid=$catid";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["comlab"] ." . ". $row["learn_out"] . "</td>
            </tr>";
    }
    
    // Close table
    echo "</table>";
} else {
    echo "No Results";
}

// Close connection
$conn->close();
?>

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

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

$sql = "SELECT `id`, `comlab`, `final_learning_out`   FROM `laerning_final` WHERE department = $department AND catid=$catid";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table>";
    
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["comlab"] ." . ". $row["final_learning_out"] . "</td>
            </tr>";
    }
    
    // Close table
    echo "</table>";
} else {
    echo "No Results";
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
$sql = "SELECT `comlab`, `learn_out`, `topic_learn_out` FROM `course_leaning` WHERE department = $department AND catid=$catid";

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
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>";
        
        echo $row["comlab"] . " . " . $row["learn_out"];
        
        echo "</td>
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
    echo "No Results";
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



$department = $_SESSION['department'];
$catid = $_SESSION['catid'];



// Check if any rows were returned
if ($result->num_rows > 0) {

    $total_hour_query = "SELECT `hours`,`asy`,`onsite`,
    SUM(hours) as total_hours, 
    SUM(asy) as total_asy_hours,
    SUM(onsite) as total_onsite_hours 
FROM 
    module_learning 
WHERE department = $department AND catid=$catid";
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
    `module_learning` 
WHERE department = $department AND catid=$catid";


    $result = $conn->query($sql);
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold;'>Module No and Learning Outcomes</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; padding: 18px;'>Weeks</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; padding: 18px;'>Teaching-Learning Activities / Assessment Strategy</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold;'>Technology Enabler</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; '>Onsite / F2F</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; '>Asynchronous</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold;'>Alloted Hours</td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>";
    
        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
        } else {
            echo $row['module_no'];
        }
    
        echo "</td>

                <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . $row["week"] . "   " . $row["date"] . "</td>
                
                <td style='border: 1px solid #dddddd; padding:8px; text-align: left; width: 50px'>";
    
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
        } else {
            echo $row['teaching_activities'];
        }
        echo "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . $row["technology"] . "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . ($row['onsite'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . ($row['asy'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . $row["hours"] . "</td>
    </tr>";
    
    }


    echo "<tr style='background-color:#ffbb33'>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;' colspan='4'><p style='font-weight:bold;'>TOTAL</p></td>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;'>" . (is_numeric($total_onsite_hours) && is_numeric($hours) ? ($total_onsite_hours * $hours) : 0) . "</td>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;'>" . (is_numeric($total_asy_hours) && is_numeric($hours) ? ($total_asy_hours * $hours) : 0) . "</td>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;'>" . (is_numeric($total_hour) ? $total_hour : 0) . "</td>
</tr>";




    
    
    
    // Close table
    echo "</table>";
} else {
    echo "No Results";
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
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

// SQL query
$sql = "SELECT `comlab`, `final_learning_out`, `final_topic_leaning_out` FROM `laerning_final` WHERE department = $department AND catid=$catid";

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
                <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>".$row["comlab"]." . ".$row["final_learning_out"]."</td>
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
    echo "No Results";
}

// Close connection
$conn->close();
?>
<br><br><br><br>

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



$department = $_SESSION['department'];
$catid = $_SESSION['catid'];



// Check if any rows were returned
if ($result->num_rows > 0) {

    $total_hour_query = "SELECT `hours`,`asy`,`onsite`,
    SUM(hours) as total_hours, 
    SUM(asy) as total_asy_hours,
    SUM(onsite) as total_onsite_hours 
FROM 
module_learning_final
WHERE department = $department AND catid=$catid";
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
    `module_learning_final` 
WHERE department = $department AND catid=$catid";


    $result = $conn->query($sql);
    // Output table header
    echo "<table style='width: 100%;
    border-collapse: collapse;'>
    <tr>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold;'>Module No and Learning Outcomes</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; padding: 18px;'>Weeks</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; padding: 18px;'>Teaching-Learning Activities / Assessment Strategy</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold;'>Technology Enabler</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; '>Onsite / F2F</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold; '>Asynchronous</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center; font-weight:bold;'>Alloted Hours</td>
    </tr>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>";
    
        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
        } else {
            echo $row['module_no'];
        }
    
        echo "</td>

                <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . $row["week"] . "   " . $row["date"] . "</td>
                
                <td style='border: 1px solid #dddddd; padding:8px; text-align: left; width: 50px'>";
    
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
        } else {
            echo $row['teaching_activities'];
        }
        echo "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . $row["technology"] . "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . ($row['onsite'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . ($row['asy'] == 1 ? '/' : '') . "</td>
        <td style='border: 1px solid #dddddd; padding:8px; text-align: center;'>" . $row["hours"] . "</td>
    </tr>";
    
    }


    echo "<tr style='background-color:#ffbb33'>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;' colspan='4'><p style='font-weight:bold;'>TOTAL</p></td>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;'>" . (is_numeric($total_onsite_hours) && is_numeric($hours) ? ($total_onsite_hours * $hours) : 0) . "</td>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;'>" . (is_numeric($total_asy_hours) && is_numeric($hours) ? ($total_asy_hours * $hours) : 0) . "</td>
    <td style='border: 1px solid #dddddd; text-align: center; padding: 18px;'>" . (is_numeric($total_hour) ? $total_hour : 0) . "</td>
</tr>";




    
    
    
    // Close table
    echo "</table>";
} else {
    echo "No Results";
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
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

$total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent WHERE department = $department AND catid=$catid";
$total_percent_result = mysqli_query($conn, $total_percent_query);
$total_percent_row = mysqli_fetch_assoc($total_percent_result);
        
$total_percent = $total_percent_row['total_percent'];

// Fetch module learning records

// SQL query
$sql = "SELECT `description`, `percents` FROM `percent` WHERE department = $department AND catid=$catid";

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
    echo "<tr style=''>
    <td style='text-align: left;'><p style=''>Total<p></td>
    <td style='text-align: left;'><p style=''>". ($total_percent) . "%<p></td>
    </tr>";
    // Close table
    echo "</table>";
} else {
    echo "No Results";
}

// Close connection
$conn->close();
?>
<br>
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
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

$total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent WHERE department = $department AND catid=$catid";
$total_percent_result = mysqli_query($conn, $total_percent_query);
$total_percent_row = mysqli_fetch_assoc($total_percent_result);
        
$total_percent = $total_percent_row['total_percent'];

// Fetch module learning records

// SQL query
$sql = "SELECT `description`, `percents` FROM `percent` WHERE department = $department AND catid=$catid";

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
    echo "<tr style=''>
    <td style='text-align: left;'><p style=''>Total<p></td>
    <td style='text-align: left;'><p style=''>". ($total_percent) . "%<p></td>
    </tr>";
    // Close table
    echo "</table>";
} else {
    echo "No Results";
}

// Close connection
$conn->close();
?>

<br>

<span>Overall Final Grade = [(Midterm grade) + (Final term grade)] / 2</a></span><br>


<div id="coursePolicies" style="text-align: justify; text-justify: inter-word;">
    <p style="font-weight:bold"> COURSE POLICIES AND REQUIREMENTS </p><br>
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

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

$sql = "SELECT `id`, `description` FROM `course_policies`";

// Execute query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "<table>";
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $description = $row['description'];
    
        // Replace 'CLO' and newline characters with <br>
        if (strpos($description, 'CLO') !== false || strpos($description, "\n") !== false) {
            $description = str_replace(array('CLO', "\n"), '<br>', $description);
        }
    
        // Define the function to indent the text
        function indentText($text) {
            $lines = explode('<br>', $text); // Split the text by <br> tags
            foreach ($lines as &$line) {
                if (preg_match('/^\s*\d+\./', $line)) {
                    // Add indentation if the line starts with a numeral followed by a period
                    $line = '<div class="course_policies" style="margin-left: 10px;">' . $line . '</div>';
                } elseif (preg_match('/^\s*[a-z]+\./', $line) && !preg_match('/^\s*(i|ii|iii|iv|v|vi|vii|viii|ix|x)\./', $line)) {
                    // Add indentation if the line starts with a lowercase letter followed by a period
                    // and does not start with a lowercase Roman numeral followed by a period
                    $line = '<div class="course_policies" style="margin-left: 60px;">' . $line . '</div>';
                } elseif (preg_match('/^\s*(i|ii|iii|iv|v|vi|vii|viii|ix|x)\./', $line)) {
                    // Add more indentation if the line starts with a lowercase Roman numeral followed by a period
                    $line = '<div class="course_policies" style="margin-left: 80px;">' . $line . '</div>';
                } else {
                    // No indentation for other lines
                    $line = '<div class="course_policies">' . $line . '</div>';
                }
            }
            return implode('<br>', $lines);
        }
    
        // Apply the indentText function to the description
        $descriptions = indentText($description);
    
        // Output the table row with the processed description
        echo "<tr>
                <td>" . $descriptions . "</td>
              </tr>";
    }
    
    
    // Close table
    echo "</table>";
} else {
    echo "No Results";
}

// Close connection
$conn->close();
?>
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
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT `Provider`, `Reference_Material` FROM `onsite_reffence` 
WHERE department = $department AND catid=$catid";

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
    echo "No Results";
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
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

// SQL query
$sql = "SELECT  `e_provider`, `refference_material` FROM `online_refference` 
WHERE department = $department AND catid=$catid";

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
    echo "No Results";
}

// Close connection
$conn->close();
?>
<br><br>


<span><b>Prepared:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:30px;" class="course"><?php echo $course_departments ?></a></b></span><br>
<?php
// Establish connection to your database
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

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];
 

// Fetch and display course learning outcomes
$sql = "SELECT * FROM semestral WHERE department = '$department' and catid = '$catid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $term = $row['term'];
        $year = $row['year'];
        echo '<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="term_year">' . $term . " " . $year . '</a></span>';
    }
}

// Close the connection
$conn->close();
?>

<br><br>
<span><b><?php echo $dept_head_signature ?>:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:180px;" class="course"><?php echo $dept_head ?></a></b></span><br>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:180px;" class="course"><?php echo $dept_head_position.", ".$course_initial ?></a></span><br><br><br>



<span><b><?php echo $deans_category_signature ?>:</b><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:180px;" class="course"><?php echo $category_dean ?></a></b></span><br>
<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="padding-left:180px;" class="course"><?php echo $category_dean_position.", ".$category_initial ?></a></span><br><br><br>






&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><img src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/DLSU-D.png" alt="" width="100" height="100">
</a>
<img src="http://localhost/Github/SYLLABUS/ADMIN/uploads/<?php echo isset($categories_logo) ? $categories_logo : 'No_signature'; ?>" alt="" width="100" height="100">
</a>
<div style="text-align:center; font-weight:bold">
<a style="text-align:center;">DE LA SALLE UNIVERSITY-DASMARINAS</a><br>
    <a style="text-align:center';"><?php echo strtoupper($category_name);?> </a><br>
    <a style="text-align:center;"><?php  echo strtoupper($course_departments);?> </a><br><br>
    <a style="text-align:center; padding-top: 5rem;">PROGRAM LEARNING OUTCOME - COURSE LEARNING OUTCOME </a><br>
    <a>MAPPING TABLE FOR <?php echo strtoupper($cname) ?> </a>
</div><br><br>





    
    
<?php

$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$dbname = "syllabus"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$department = $_SESSION['department'];
$catid = $_SESSION['catid'];


// Using prepared statement to prevent SQL injection
$sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department=? and catid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $department,$catid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>


    <span><a style='font-weight: bold;'><b>COURSE CODE</b></a><b><a style="padding-left: 100px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_code'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE TITLE</b></a><b><a style="padding-left: 97px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_tittle'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE TYPE</b></a><b><a style="padding-left: 103px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b> :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_Type'];?></a></span><br>
    <span><a style='font-weight: bold;'><b>COURSE CREDIT</b></a><b><a style="padding-left: 84px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['course_credit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>LEARNING MODALITY</b></a><b><a style="padding-left: 36px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['learning_modality']?></a></span><br>
    <span><a style='font-weight: bold;'><b>PRE-REQUISITES</b></a><b><a style="padding-left: 82px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'><b>CO-REQUISITES</b></a><b><a style="padding-left: 90px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a><b>:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['co_pre_requisit']; ?></a></span><br>    
    <?php
    }
} else {
    echo "No courses found for the selected department.";
}

// Close the database connection
$conn->close();
?>

    

    <?php



    
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "syllabus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Execute query


// Check if any rows were returned
if ($result->num_rows > 0) {


    // SQL query
    $sql = "SELECT `id`, `learn_out_mapping`, `pl1`, `pl2`, `pl3`, `pl4`, `pl5`, `pl6`, `pl7`, `pl8`, `pl9` FROM `mapping_table` WHERE department = $department AND catid=$catid";


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
    echo "No Results";
}

// Close connection
$conn->close();
?>




<br><br><br>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $commitee_signatures ?></p>
    <p>____________________________</p>
<p style="font-style: italic; margin-top: -20px; margin-left: 10px;">
  Approved in <?= date("F") ." ".date("Y") ?> during a multi-sectoral committee specifically convened for the purpose of coming up with descriptions for the graduate attributes.
</p>











</div>






    
</body>
</html>