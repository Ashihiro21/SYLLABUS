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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a style="width:'50px';"><img src="http://localhost/Github/SYLLABUS/HIGHER_RANKS/logos.jpeg" alt=""></a>
    <h4 style="text-align:center">DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4 style="text-align:center"><?php echo strtoupper($category_name);?> </h4>
    <h4 style="text-align:center"><?php  echo strtoupper($course_departments);?> </h4>
    <h4 style="text-align:center; padding-top: 5rem;">COURSE SYLLABUS</h4>
    
    
    <span><a style='font-weight: bold;'>COURSE CODE</a><b><a style="padding-left: 100px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_code'];?></a></span><br>
    <span><a style='font-weight: bold;'>COURSE TITLE</a><b><a style="padding-left: 97px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_tittle'];?></a></span><br>
    <span><a style='font-weight: bold;'>COURSE TYPE</a><b><a style="padding-left: 103px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_Type'];?></a></span><br>
    <span><a style='font-weight: bold;'>COURSE CREDIT</a><b><a style="padding-left: 84px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_credit']; ?></a></span><br>
    <span><a style='font-weight: bold;'>LEARNING MODALITY</a><b><a style="padding-left: 36px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['learning_modality']?></a></span><br>
    <span><a style='font-weight: bold;'>PRE-REQUISITES</a><b><a style="padding-left: 82px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'>CO-REQUISITES</a><b><a style="padding-left: 90px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['co_pre_requisit']; ?></a></span><br>
    <span><a style='font-weight: bold;'>CONSULTATION HOURS </a><b><a style="padding-left: 22px; padding-right: 2rem;"></a></b>&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_date']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_room']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_email']; ?></a></span><br>
    <span><a style="padding-left: 253px; padding-right: 2rem;"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['consultation_hours_number']; ?></a></span>
    <p></p>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <span><a style='font-weight: bold;'>COURSE DESCRIPTION:</a><b><a style="padding-left: 100px; padding-right: 2rem;"></a></b></a></span><br><br>
    <a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['course_description']; ?></a></a><br><br>
    <span><p style='font-weight: bold;'>COURSE LEARNING OUTCOMES:</a><b><a style="padding-left: 100px; padding-right: 2rem;"></p></b></a></span>
    <span><a style='font-weight: bold;'>By the end of this course, students are expected to:</a><b><a style="padding-left: 100px; padding-right: 2rem;"></a></b></p></span>






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
        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>Learn Out Come</td>
        <td style='border: 1px solid #dddddd;text-align: left; padding: 8px;'>Topic Learn out</td>
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
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Module No and Learning Outcomes</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Weeks</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Teaching-Learning Activities / Assessment Strategy</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Technology Enabler</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Onsite / F2F</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Asynchronous</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Alloted Hours</td>
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

                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["week"] . " . " . $row["date"] . "</td>
                
                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>";
    
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
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
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;' colspan='4'> TOTAL </td>
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

<p style="font-weight:bold">Learning Outcomes for Final Period</p>


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
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Module No and Learning Outcomes</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Weeks</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Teaching-Learning Activities / Assessment Strategy</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Technology Enabler</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Onsite / F2F</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Asynchronous</td>
        <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>Alloted Hours</td>
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

                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>" . $row["week"] . " . " . $row["date"] . "</td>
                
                <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;'>";
    
        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
            // If 'TLO' or a line break is found, replace it with <br>
            echo str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
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
    <td style='border: 1px solid #dddddd;text-align: center; padding: 8px;' colspan='4'> TOTAL </td>
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
                <td style='text-align: left; padding: 8px;'>" . $row["description"] . "</td>
                <td style='text-align: left; padding: 8px;'>" . $row["percents"] . "</td>
            </tr>";
    }
    
    echo "<tr style=''>
    <td style='text-align: left; padding: 8px;'> TOTAL </td>
    <td style='text-align: left;'>". ($total_percent) . " </td>
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





</div>

    
</body>
</html>