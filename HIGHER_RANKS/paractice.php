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
            c.dean_signature AS deans_category_signature,
            co.cname,
            co.course_department AS course_department,
            co.initial AS course_initial,
            co.department_name AS dept_head,
            co.department_position AS dept_head_position,
            co.dept_signature AS dept_head_signature
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
    $courses = $row['catid'];
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


.logos{
    margin-left: 44rem;
    margin-right: 44rem;
}

.header-title{
    margin-left: 15rem;
}

.desc{
    text-indent: 20px;
}

.descriptions{
    margin-left: 30px;
}


td{
    padding: 5px;
}






.text-wrap {
    /* Set maximum width for text */
    max-width: 1200px;
    /* Allow wrapping */
    /* Ensure long words break and wrap to fit */
    overflow-wrap: break-word;
    /* Prevent overflow */
    overflow: hidden;
    word-spacing: 12px;
}

.text-indent{
    margin-left: 5rem;
}

.c{
    list-style-type: lower-roman;
}

.account-header{
    padding-top: 20px;
    padding-bottom: 5px;
}

.dl-word{
    margin-left: 1rem;
    background-color: #0d6efd;
}

.dl-word:hover{
    background-color: #0a5cb8;
}

.btn-primary{
    margin-left: 50rem;
}
.sysllabus_button{
    margin-left: 50rem;
   
}
.custom-card {
    margin: 13.5rem;
        border: 1px solid #6c757d; /* Corrected border color syntax */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.9); /* Shadow effect */
        
    }


    .float{
        position: absolute;
        right: 10rem;
    }

  

</style>
<body>


    <nav>
        <span class="float-right"><p><?php echo $position; ?><a href="logout.php">Logout</a></p></span>
        <span class="m-2"><a href="generate_pdf_syllabus.php" class="btn btn-danger">Download as PDF</a>
       
    <?php

    include("index.php");
    ?>

<a><?php echo $department ?></a>
    </nav>
   
    <div class="card custom-card" >
    <div class="card-body">

    <div class="pt-5 pb-4">
        <img src="../img/logos.png" class="logos" alt="">
    </div>
    
    <div class="text-center">
    <h4>DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4><?php echo strtoupper($category_name);?> </h4>
    <h4><?php echo strtoupper($course_departments);?> </h4>
    <p class="pb-3"></p>
    <h4>COURSE SYLLABUS</h4>
    </div>
    
    <div class="container-fluid">


   


 
 <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
 <div class="modal fade" id="editmodal_learn_out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> COURSE LEARNING OUTCOMES </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Dropdowns will be loaded here -->
                

                
            </div>


                <form action="Course_Syllabus/update_course_learning_outcome.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label> Computer Laboratory </label>
                            <input type="text" name="comlab" id="comlab" class="form-control"
                                placeholder="Enter Computer Laboratory">
                        </div>

                        <div class="form-group">
                        <label for="learn_out">Course Learning Outcome</label>
                        <textarea name="learn_out" id="learn_out" placeholder="Enter Course Learning Outcome" cols="50" rows="5"></textarea>
                    </div>


                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

 


    


    <button type="button" class="btn btn-primary float" data-toggle="modal" data-target="#addmodal">
  Add Course
</button>

    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD COURSE SYLLABUS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="Course_Syllabus/add_course_syllabus.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Course Code</label>
                        <input type="text" name="course_code" class="form-control" placeholder="Enter course code">
                    </div>

                    <div class="form-group">
                        <label>Course Title</label>
                        <input type="text" name="course_tittle" class="form-control" placeholder="Enter course title">
                    </div>

                    <div class="form-group">
                        <fieldset>
                            <legend>Course Type</legend>
                            <div>
                                <input type="radio" id="lecture1" name="course_Type1" value="Lecture">
                                <label for="lecture">Lecture</label>
                            </div>
                            <div>
                                <input type="radio" id="laboratory1" name="course_Type1" value="Laboratory">
                                <label for="laboratory">Laboratory</label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <label>Course Credit</label>
                        <input type="text" name="course_credit" class="form-control" placeholder="Enter course credit">
                    </div>

                    <div class="form-group">
                        <fieldset>
                            <legend>Learning Modality</legend>
                            <div>
                                <input type="radio" id="traditional1" name="learning_modality1" value="Traditional">
                                <label for="traditional">Traditional</label>
                            </div>
                            <div>
                                <input type="radio" id="flex_blended1" name="learning_modality1" value="Flex Blended">
                                <label for="flex_blended">Flex Blended</label>
                            </div>
                            <div>
                                <input type="radio" id="fully_onsite1" name="learning_modality1" value="Fully Onsite">
                                <label for="fully_onsite">Fully Onsite</label>
                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <label>Pre-requisites</label>
                        <input type="text" name="pre_requisit" class="form-control" placeholder="Enter pre-requisites">
                    </div>

                    <div class="form-group">
                        <label>Co Pre-requisites</label>
                        <input type="text" name="co_pre_requisit" class="form-control" placeholder="Enter co pre-requisites">
                    </div>

                    <div class="form-group">
                        <label>Professor</label>
                        <input type="text" name="professor" class="form-control" placeholder="Enter professor">
                    </div>

                    <div class="form-group">
                        <label for="consultation_hours_date">Consultation Hours</label>
                        <input id="consultation_hours_date1" name="consultation_hours_date" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Day and Hours"></input>
                    </div>

                    <div class="form-group">
                        <input id="consultation_hours_room1" name="consultation_hours_room" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Room"></input>
                    </div>

                    <div class="form-group">
                        <input id="consultation_hours_email1" name="consultation_hours_email" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Email"></input>
                    </div>

                    <div class="form-group">
                        <input id="consultation_hours_number1" name="consultation_hours_number" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Contact"></input>
                    </div>

                    <div class="form-group">
                        <label for="course_description">Course Description</label>
                        <textarea id="course_description1" name="course_description" class="form-control" rows="7" cols="70" style="width: 450px;" placeholder="Enter Course Description"></textarea>
                    </div>

                    <div class="form-group">
    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
</div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="adddata" class="btn btn-primary">Add Data</button>
                </div>
            </form>

        </div>
    </div>
</div>







    <!-- EDIT POP UP FORM FOR COURSE SYLLABUS (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> EDIT COURSE SYLLABUS </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_syllabus.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_idsyslabus" id="update_idsyslabus">

                        <div class="form-group">
                            <label> Course Code </label>
                            <input type="text" name="course_code" id="course_code" class="form-control"
                                placeholder="Enter course_code">
                        </div>

                        <div class="form-group">
                            <label> Course Tittle </label>
                            <input type="text" name="course_tittle" id="course_tittle" class="form-control" placeholder="Enter Course Tittle">
                        </div>
                        <div class="form-group">
                        <fieldset>
                            <label>Course Type</label>
                            <div>
                                <input type="radio" id="Lecture" name="course_Type" id="course_Type" value="Lecture">
                                <label for="Lecture">Lecture</label>
                            </div>
                            <div>
                                <input type="radio" id="Laboratory" name="course_Type" id="course_Type" value="Laboratory">
                                <label for="Laboratory">Laboratory</label>
                            </div>
                        
                        </fieldset>

                        
                    </div>

                    

                        <div class="form-group">
                            <label> Course credit </label>
                            <input type="text" name="course_credit" id="course_credit" class="form-control" placeholder="Enter Course credit">
                        </div>

                        <div class="form-group">
                        <fieldset>
                            <label>Learning Modality</label>
                            <div>
                                <input type="radio" id="traditional" name="learning_modality" value="Traditional">
                                <label for="traditional">Traditional</label>
                            </div>
                            <div>
                                <input type="radio" id="flex_blended" name="learning_modality" value="Flex Blended">
                                <label for="flex_blended">Flex Blended</label>
                            </div>
                            <div>
                                <input type="radio" id="fully_onsite" name="learning_modality" value="Fully Onsite">
                                <label for="fully_onsite">Fully Onsite</label>
                            </div>
                        </fieldset>
                    </div>
                    


                       
                        <div class="form-group">
                            <label> Pre requisites </label>
                            <input type="text" name="pre_requisit" id="pre_requisit" class="form-control" placeholder="Enter pre_requisit">
                        </div>

                        <div class="form-group">
                            <label> Co Pre Requisites </label>
                            <input type="text" name="co_pre_requisit" id="co_pre_requisit" class="form-control" placeholder="Enter co_pre_requisit">
                        </div>

                        <div class="form-group">
                            <label> Professor </label>
                            <input type="text" name="professor" id="professor" class="form-control" placeholder="Enter professor">
                        </div>

                        <div class="form-group">
                            <label for="consultation_hours_date">Consultation Hours</label>
                            <input id="consultation_hours_date" name="consultation_hours_date" id="consultation_hours_date" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Day and Hours"></input>
                        </div>

                        <div class="form-group">
                            <input id="consultation_hours_room" name="consultation_hours_room" id="consultation_hours_room" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Room"></input>
                        </div>

                        <div class="form-group">
                            <input id="consultation_hours_email" name="consultation_hours_email" id="consultation_hours_email" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Email"></input>
                        </div>

                        <div class="form-group">
                            <input id="consultation_hours_number" name="consultation_hours_number" id="consultation_hours_number" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation Contact"></input>
                        </div>

                        <div class="form-group">
                            <label for="course_description">Course Description</label>
                            <textarea id="course_description" name="course_description" id="course_description" class="form-control" rows="7" cols="70" style="width: 450px;" placeholder="Enter Course Description"></textarea>
                        </div>

                        <div class="form-group">
    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
</div>



                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <!-- DELETE POP UP FORM  FOR LEARNING OUTCOME (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal_learning_out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_course_learning_outcome.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- DELETE POP UP FORM  FOR LEARNING MODULE(Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal_module_learning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_course_module_learning.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id3" id="delete_id3">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata3" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    
 <!-- EDIT POP UP FORM TABLE (Bootstrap MODAL) -->
 <div class="modal fade" id="editmodal_learn_out_table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1"> Topic Learning Outcomes  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_learning_outcome_table.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id1" id="update_id1">

                        <div class="form-group">
                            <label> Course Learning Outcome </label>
                            <textarea name="topic_learn_out" id="topic_learn_out" class="form-control" placeholder="Enter Course Learning Outcome" cols="90" rows="5"></textarea>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedatatable" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

  




                    <?php
                     
           
                     // Database connection
                     
                     $connection = mysqli_connect("localhost","root","","syllabus");
                         if (mysqli_connect_errno()){
                             echo "Failed to connect to MySQL: " . mysqli_connect_error();
                             die();
                             }
                     
                         $department = $_SESSION['department']; 

                         $query = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department='$department'";
                         $query_run = mysqli_query($connection, $query);
            ?>  
                    <table id="datatableid">
                        <thead>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td class="hide-id"> <?php echo $row['id']; ?> </td>
                                <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_code']; ?></td>

                            <td class="hide-id"  style="border: 1px solid white;"><?php echo $row['course_tittle']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_Type']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_credit']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['learning_modality']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['pre_requisit']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['co_pre_requisit']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['professor']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_date']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_room']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_number']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_email']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_description']; ?></td>
                                
                            <td class="centered-btn">
                                <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                                <button type="button" class="btn sysllabus_button btn-success editbtn"><i class="lni lni-pencil"></i></button>

                                <!-- <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i></button> -->
                                </td>
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
                    </table>
                  
                    <?php
// Establish a database connection (replace 'hostname', 'username', 'password', and 'database' with your actual database credentials)
$mysqli = new mysqli("localhost", "root", "", "syllabus");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$department = $_SESSION['department']; 
// Prepare SQL query
$sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department='$department'";

// Execute query
$result = $mysqli->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    ?>

        <?php
        // Loop through the result set
        while ($row = $result->fetch_assoc()) {
            ?>

       <div class="container text-left">
                <div class="header">COURSE CODE</div>
                <div>:</div>
                <div><?php echo $row['course_code']; ?></div>

                <div class="header">COURSE TITLE</div>
                <div>:</div>
                <div><?php echo $row['course_tittle']; ?></div>

                <div class="header">COURSE TYPE</div>
                <div>:</div>
                <div><?php echo $row['course_Type']; ?></div>

                <div class="header">COURSE CREDIT</div>
                <div>:</div>
                <div><?php echo $row['course_credit']; ?></div>

                <div class="header">LEARNING MODALITY</div>
                <div>:</div>
                <div><?php echo $row['learning_modality']; ?></div>

                <div class="header">PRE-REQUISITES</div>
                <div>:</div>
                <div><?php echo $row['pre_requisit']; ?></div>

                <div class="header">CO-REQUISITES</div>
                <div>:</div>
                <div><?php echo $row['co_pre_requisit']; ?></div>

                <div class="header">PROFESSOR</div>
                <div>:</div>
                <div><?php echo $row['professor']; ?></div>


                <div class="header">CONSULTATION HOURS</div>
                <div>:</div>
                <div>
                    <?php echo $row['consultation_hours_date']; ?><br>
                    <?php echo $row['consultation_hours_room']; ?><br>
                    <?php echo $row['consultation_hours_email']; ?><br>
                    <?php echo $row['consultation_hours_number']; ?>
                </div>
                </div>
                <div class="container-box course_description">
    </div>

                <div class="container-box desc">
    <div class="header mt-4">COURSE DESCRIPTION:</div>
    <div class="text-wrap descriptions"><?php echo $row['course_description']; ?></div>
 <!-- Close the container -->

                <?php
        }
        ?>
    <?php
} else {
    echo "<div class='container'><br>";
    echo "0 results";
    echo "</div> ";
}

// Close database connection
$mysqli->close();
?>


</div> 
<div class="mt-5 header-title"><br>
    <div class="header mt-4">COURSE LEARNING OUTCOMES:</div>
    <p> By the end of this course, students are expected to: </p>
</div>
</div> 
                    <button type="button" class="btn btn-primary add_databtn" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button>

                    <!-- Modal -->
 <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Learning Outcome </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_course_learning_outcome.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                            <label> Computer Laboratory </label>
                            <input type="text" name="comlab" id="comlab" class="form-control"
                                placeholder="Enter Computer Laborator">
                        </div>

                    
                        <label for="learn_out">Course Learning Outcomes</label><br>
                        <textarea name="learn_out" id="learn_out" row="70" cols="50" class="form-control" placeholder="Course Learning Outcomes"></textarea>
                

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>





                    
                 
                    <div class="container mt-5">

                    <?php
                     
           
                     // Database connection
                     
                     
                     $connection = mysqli_connect("localhost","root","","syllabus");
                     if (mysqli_connect_errno()){
                         echo "Failed to connect to MySQL: " . mysqli_connect_error();
                         die();
                         }
                 
                

                     $query = "SELECT * FROM course_leaning";
                     $query_run = mysqli_query($connection, $query);
        ?>  
                <table id="datatableid">
                    <thead>
                        <!-- <tr>
                            <th scope="col">description</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Action</th>
                        </tr> -->
                    </thead>
                    <?php
            if($query_run)
            {
                foreach($query_run as $row)
                {
        ?>
                    <tbody>
                      
                        <tr>
                            <td class="hide-id"> <?php echo $row['id']; ?> </td>
                            <td><?php echo $row['comlab']; ?></td>
                            <td><?php echo "."; ?></td>
                            <td><?php echo $row['learn_out']; ?></td>
                            <td class="hide-id"><?php echo $row['topic_learn_out']; ?></td>
                            <td class="table-button">
                            <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                            <button type="button" class="btn btn-success editbtn_learning_out"><i class="lni lni-pencil"></i></button>

                            <button type="button" class="btn btn-danger deletebtn_learning_out"><i class="lni lni-trash-can"></i></button>
                            </td>
                        </tr>
                    </tbody>
                    <?php           
                }
            }
            else 
            {
                echo "No Record Found";
            }
        ?>
                </table>
           

                 
                    </div>

                    <div class="mt-5 header-title"><br>
                    <b><a>LEARNING PLAN</a></b><br>
                    <b><a>Learning Outcomes for Midterm Period </a></b>
                    </div>
             

        
                    <div class="container mt-5">

                    
                    <?php
                     
           
                     // Database connection
                     
                     
                     $connection = mysqli_connect("localhost","root","","syllabus");
                     if (mysqli_connect_errno()){
                         echo "Failed to connect to MySQL: " . mysqli_connect_error();
                         die();
                         }
                 
                

                     $query = "SELECT * FROM course_leaning";
                     $query_run = mysqli_query($connection, $query);
        ?>  
                <table id="datatableid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Course Learning Outcomes</th>
                            <th scope="col">Topic Learning Outcomes</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php
            if($query_run)
            {
                foreach($query_run as $row)
                {
        ?>
                    <tbody>
                      
                    <tr>
                            <td class="hide-id"> <?php echo $row['id']; ?> </td>
                            <td class=""><?php echo $row['comlab']; ?><?php echo "."; ?><?php echo $row['learn_out']; ?></td>
                            <td class=""><?php
                        if (strpos($row['topic_learn_out'], 'TLO') !== false || strpos($row['topic_learn_out'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['topic_learn_out']);
                        } else {
                            echo $row['topic_learn_out'];
                        }
                        ?></td>
                            <td class="table-button">
                            <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                            <button type="button" class="btn btn-success editbtn_learning_out_table"><i class="lni lni-pencil"></i></button>

                            <!-- <button type="button" class="btn btn-danger deletebtn_learning_out_table"><i class="lni lni-trash-can"></i></button> -->
                            </td>
                        </tr>
                    </tbody>
                    <?php           
                }
            }
            else 
            {
                echo "No Record Found";
            }
        ?>
                </table>

           

                    </div>



                    <button type="button" class="btn btn-primary add_databtn" data-toggle="modal" data-target="#addmodal_module_learning">
                        ADD DATA
                    </button>

                    <!-- Modal module_learning-->
 <div class="modal fade" id="addmodal_module_learning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Learning Outcome </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_course_module_learning.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                        <label for="module_no1">Module No and Learning Outcomes</label>
                        <textarea name="module_no" id="module_no1" class="editor1" placeholder="Module No and Learning Outcomes" cols="50" rows="5"></textarea>
                    </div>

                        <div class="form-group">
                            <label>Week No</label>
                            <input type="text" name="week" id="week1" class="form-control"
                                placeholder="Enter Week No">
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" id="date1" class="form-control"
                                placeholder="Enter Date">
                        </div>

                        <div class="form-group">
                        <label for="teaching_activities1">Teaching-Learning Activities / Assessment Strategy</label>
                        <textarea name="teaching_activities" id="teaching_activities1" class="editor2" placeholder="Enter Teaching-Learning Activities / Assessment Strategy" cols="50" rows="5"></textarea>
                    </div>


                        
                        
                        <div class="form-group">
                            <label>Technology Enabler</label>
                            <input type="text" name="technology" id="technology1" class="form-control"
                            placeholder="Enter Technology Enabler">
                        </div>
                        
                        <div class="form-group">
                    <label>
                        <input type="checkbox" name="onsite5" value="1" id="onsite5">
                        Onsite / F2F
                    </label><br>
                    <label>
                        <input type="checkbox" name="asy5" value="1" id="asynchronous5">
                        Asynchronous
                    </label>
                </div>
                <label>Alloted Hours</label>
                        <input type="text" name="hours" id="alloted_hours5" class="form-control"
                            placeholder="Enter Alloted Hours">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

<!-- EDIT POP UP FORM LEARNING MODULE TABLE (Bootstrap MODAL) -->
 <div class="modal fade" id="editmodal_module_learning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1"> Topic Learning Outcomes  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_module_learning.php" method="POST">

                    <div class="modal-body">
                        
                    <input type="hidden" name="update_id3" id="update_id3">

                    <div class="form-group">
                    <label for="module_no">Module No and Learning Outcomes</label>
                    <textarea name="module_no" id="module_no" class="form-control" placeholder="Enter Module No and Learning Outcomes" cols="50" rows="5"></textarea>
                </div>

                        <div class="form-group">
                            <label>Week No</label>
                            <input type="text" name="week" id="week" class="form-control"
                                placeholder="Enter Week No">
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" id="date" class="form-control"
                                placeholder="Enter Date">
                        </div>

                        <div class="form-group">
                    <label for="teaching_activities">Teaching-Learning Activities / Assessment Strategy</label>
                    <textarea name="teaching_activities" id="teaching_activities" class="form-control" placeholder="Enter Teaching-Learning Activities / Assessment Strategy" cols="50" rows="5"></textarea>
                </div>


                        
                        
                        <div class="form-group">
                            <label>Technology Enabler</label>
                            <input type="text" name="technology" id="technology" class="form-control"
                            placeholder="Enter Technology Enabler">
                        </div>
                        
                        <div class="form-group">
                    <label>
                        <input type="checkbox" name="onsite" value="1" id="onsite">
                        Onsite / F2F
                    </label><br>
                    <label>
                        <input type="checkbox" name="asy" value="1" id="asynchronous">
                        Asynchronous
                    </label>
                </div>

                
                <div class="form-group">
                            <label>Alloted Hours</label>
                            <input type="text" name="alloted_hours" id="alloted_hours" class="form-control"
                                placeholder="Enter Alloted Hours">
                        </div>


                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata3" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
   



    <div class="container mt-5">
    <table id="datatableid" class="table table-bordered">
        <thead>
            
            <tr>
            
                <th class="" scope="col">Module No and Learning Outcomes</th>
                <th class="" class="" scope="col">Week No</th>
                <th class="" scope="col">Date</th>
                <th class="" scope="col">Teaching-Learning Activities / Assessment Strategy</th>
                <th class="" scope="col">Technology Enabler</th>
                <th class="" scope="col">Onsite / F2F</th>
                <th class="" scope="col">Asynchronous</th>
                <th class="" scope="col">Alloted Hours</th>
                <th class="" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $connection = mysqli_connect("localhost", "root", "", "syllabus");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                die();
            }

            // Calculate total hours
            $total_hour_query = "SELECT `hours`,`asy`,`onsite`,
            SUM(hours) as total_hours, 
            SUM(asy) as total_asy_hours,
            SUM(onsite) as total_onsite_hours 
        FROM 
            module_learning";
            $total_hour_result = mysqli_query($connection, $total_hour_query);
            $total_hour_row = mysqli_fetch_assoc($total_hour_result);

            $hours = $total_hour_row['hours'];
            $onsite = $total_hour_row['onsite'];
            $asy = $total_hour_row['asy'];
            $total_hour = $total_hour_row['total_hours'];
            $total_asy_hours = $total_hour_row['total_asy_hours'];
            $total_onsite_hours = $total_hour_row['total_onsite_hours'];

            // Fetch module learning records
            $query = "SELECT 
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

            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                                <tr>
                    <td class="hide-id"><?php echo $row['id']; ?></td>
                    <td class=""><?php
                        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
                        } else {
                            echo $row['module_no'];
                        }
                        ?></td>
                    <td><?php echo $row['week']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['teaching_activities']; ?></td>
                    <td><?php echo $row['technology']; ?></td>
                    <td><?php echo ($row['onsite'] == 1) ? '/' : ''; ?></td>
                    <td><?php echo ($row['asy'] == 1) ? '/' : ''; ?></td>
                    <td><?php echo $row['hours']; ?></td>
                    <td class="table-button">
                        <button type="button" class="btn btn-success editbtn_module_learning"><i class="lni lni-pencil"></i></button>
                        <button type="button" class="btn btn-danger deletebtn_module_learning"><i class="lni lni-trash-can"></i></button>
                    </td>
                </tr>

            <?php
                }
            } else {
                echo "No Record Found";
            }
            ?>
            <tr>
                <td colspan="5">TOTAL</td>
                <td><?php echo $total_onsite_hours * $hours; ?></td>
                <td><?php echo $total_asy_hours * $hours; ?></td>
                <td><?php echo $total_hour; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Learning Outcomes for Final Period Table -->

  <!-- DELETE POP UP FORM  for Final Period Table (Bootstrap MODAL) -->
  <div class="modal fade" id="deletemodal_learn_out__final_period_table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel5"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel5"> Delete Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_course_module_learning_final_period.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id6" id="delete_id6">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


 <!-- EDIT POP UP for Final Period Table (Bootstrap MODAL) -->
 <div class="modal fade" id="editmodal_learn_out__final_period_table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel6"> Topic Learning Outcomes  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_learning_outcome_final_period_table.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id5" id="update_id5">

                        <div class="form-group">
                            <label> Course Learning Outcomes  </label>
                            <input type="text" name="final_learning_out" id="final_learning_out" class="form-control"
                                placeholder="Enter Course Learning Outcomes">
                        </div>

                        <div class="form-group">
                        <label>Topic Learning Outcomes</label>
                        <textarea name="final_topic_leaning_out" id="final_topic_leaning_out" class="form-control" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
                    </div>


                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedatatable" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




  <!--Add Modal Final Period Table -->
<button type="button" class="btn btn-primary add_databtn_final" data-toggle="modal" data-target="#studentaddmodal15">
                        ADD DATA
                    </button>

                    <!-- Modal -->
 <div class="modal fade" id="studentaddmodal15" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Learning Outcomes for Final Period </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_course_learning_outcome_final.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                            <label> Course Learning Outcomes  </label>
                            <input type="text" name="final_learning_out" id="final_learning_out6" class="form-control"
                                placeholder="Enter Course Learning Outcomes">
                        </div>

                        <div class="form-group">
                        <label>Topic Learning Outcomes</label>
                        <textarea name="final_topic_leaning_out" id="final_topic_leaning_out6" class="editor3" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    

<br>

<div class="mt-5 header-title">
<a>Learning Outcomes for Final Period</a>
</div>



<div class="container mt-5">


<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



 $query = "SELECT * FROM  laerning_final";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered">
<thead>
    <tr>
        <th scope="col">Course Learning Outcomes</th>
        <th scope="col">Topic Learning Outcomes</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<?php
if($query_run)
{
foreach($query_run as $row)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $row['id']; ?> </td>
        <td class=""><?php echo $row['final_learning_out']; ?></td>
        <td class=""><?php
                        if (strpos($row['final_topic_leaning_out'], 'TLO') !== false || strpos($row['final_topic_leaning_out'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['final_topic_leaning_out']);
                        } else {
                            echo $row['final_topic_leaning_out'];
                        }
                        ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_learning_out_final_period_table"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_learning_out_final_period_table"><i class="lni lni-trash-can"></i></button>
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>



</div>

<button type="button" class="btn btn-primary add_databtn_final" data-toggle="modal" data-target="#addmodal_module_learning_final">
                        ADD DATA
                    </button>

                    <!-- Modal module_learning-->
 <div class="modal fade" id="addmodal_module_learning_final" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Learning Outcome </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_course_module_learning_final.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                        <label for="module_no1">Module No and Learning Outcomes</label>
                        <textarea name="module_no" id="module_no1" class="editor4" placeholder="Enter Module No and Learning Outcomes" cols="50" rows="5"></textarea>
                    </div>

                        <div class="form-group">
                            <label>Week No</label>
                            <input type="text" name="week" id="week1" class="form-control"
                                placeholder="Enter Week No">
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" id="date1" class="form-control"
                                placeholder="Enter Date">
                        </div>

                        <div class="form-group">
                        <label for="teaching_activities1">Teaching-Learning Activities / Assessment Strategy</label>
                        <textarea name="teaching_activities" id="teaching_activities1" class="editor5" placeholder="Enter Teaching-Learning Activities / Assessment Strategy" cols="50" rows="5"></textarea>
                    </div>


                        
                        
                        <div class="form-group">
                            <label>Technology Enabler</label>
                            <input type="text" name="technology" id="technology1" class="form-control"
                            placeholder="Enter Technology Enabler">
                        </div>
                        
                        <div class="form-group">
                    <label>
                        <input type="checkbox" name="onsite" value="1" id="1onsite">
                        Onsite / F2F
                    </label><br>
                    <label>
                        <input type="checkbox" name="asy" value="1" id="1asynchronous">
                        Asynchronous
                    </label>
                </div>

                <label>Alloted Hours</label>
                        <input type="text" name="hours" id="1hours" class="form-control"
                            placeholder="Enter Alloted Hours">


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>



    <!-- EDIT POP UP FORM LEARNING MODULE TABLE (Bootstrap MODAL) -->
 <div class="modal fade" id="editmodal_module_learning_final" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1"> Topic Learning Outcomes  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_module_learning_final.php" method="POST">

                    <div class="modal-body">
                        
                    <input type="hidden" name="update_id15" id="update_id15">

                    <div class="form-group">
                    <label for="module_no">Module No and Learning Outcomes</label>
                    <textarea name="module_no" id="1module_no" class="form-control" placeholder="Enter Module No and Learning Outcomes" cols="50" rows="5"></textarea>
                </div>

                        <div class="form-group">
                            <label>Week No</label>
                            <input type="text" name="week" id="1week" class="form-control"
                                placeholder="Enter Week No">
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <input type="text" name="date" id="1date" class="form-control"
                                placeholder="Enter Date">
                        </div>

                        <div class="form-group">
                    <label for="teaching_activities">Teaching-Learning Activities / Assessment Strategy</label>
                    <textarea name="teaching_activities" id="1teaching_activities" class="form-control" placeholder="Enter Teaching-Learning Activities / Assessment Strategy" cols="50" rows="5"></textarea>
                </div>


                        
                        
                        <div class="form-group">
                            <label>Technology Enabler</label>
                            <input type="text" name="technology" id="1technology" class="form-control"
                            placeholder="Enter Technology Enabler">
                        </div>
                        
                        <div class="form-group">
                    <label>
                        <input type="checkbox" name="onsite1" value="1" id="1onsite">
                        Onsite / F2F
                    </label><br>
                    <label>
                        <input type="checkbox" name="asy1" value="1" id="1asynchronous">
                        Asynchronous
                    </label>
                </div>

                <div class="form-group">
                            <label>Alloted Hours</label>
                            <input type="text" name="alloted_hours2" id="alloted_hours2" class="form-control"
                                placeholder="Enter Alloted Hours">
                        </div>


                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata15" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    

 <!-- DELETE POP UP FORM  FOR LEARNING MODULE(Bootstrap MODAL) -->
 <div class="modal fade" id="deletemodal_module_learning_final" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_course_module_learning_final.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id15" id="delete_id15">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata15" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<div class="container mt-5 me-5">
    <table id="datatableid" class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Module No and Learning Outcomes</th>
                <th scope="col">Week No</th>
                <th scope="col">Date</th>
                <th scope="col">Teaching-Learning Activities / Assessment Strategy</th>
                <th scope="col">Technology Enabler</th>
                <th scope="col">Onsite / F2F</th>
                <th scope="col">Asynchronous</th>
                <th scope="col">Alloted Hours</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $connection = mysqli_connect("localhost", "root", "", "syllabus");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                die();
            }

            // Calculate total hours
            $total_hour_query = "SELECT `hours`,`asy`,`onsite`,
            SUM(hours) as total_hours, 
            SUM(asy) as total_asy_hours,
            SUM(onsite) as total_onsite_hours 
        FROM 
        module_learning_final";
            $total_hour_result = mysqli_query($connection, $total_hour_query);
            $total_hour_row = mysqli_fetch_assoc($total_hour_result);

            $hours = $total_hour_row['hours'];
            $onsite = $total_hour_row['onsite'];
            $asy = $total_hour_row['asy'];
            $total_hour = $total_hour_row['total_hours'];
            $total_asy_hours = $total_hour_row['total_asy_hours'];
            $total_onsite_hours = $total_hour_row['total_onsite_hours'];

            // Fetch module learning records
            $query = "SELECT 
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

            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                    <tr>
                    <td class="hide-id"><?php echo $row['id']; ?></td>
                    
                    <td class=""><?php
                        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
                        } else {
                            echo $row['module_no'];
                        }
                        ?></td>
                    <td><?php echo $row['week']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['teaching_activities']; ?></td>
                    <td><?php echo $row['technology']; ?></td>
                    <td><?php echo ($row['onsite'] == 1) ? '/' : ''; ?></td>
                    <td><?php echo ($row['asy'] == 1) ? '/' : ''; ?></td>
                    <td><?php echo $row['hours']; ?></td>
                    <td class="table-button">
                        <button type="button" class="btn btn-success editbtn_module_learning_final"><i class="lni lni-pencil"></i></button>
                        <button type="button" class="btn btn-danger deletebtn_module_learning_final"><i class="lni lni-trash-can"></i></button>
                    </td>
                </tr>

            <?php
                }
            } else {
                echo "No Record Found";
            }
            ?>
            <tr>
                <td colspan="5">TOTAL</td>
                <td><?php echo $total_onsite_hours * $hours; ?></td>
                <td><?php echo $total_asy_hours * $hours; ?></td>
                <td><?php echo $total_hour; ?></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>




<!--Add Modal PERCENT GRADING -->

                    <!-- Modal -->
 <div class="modal fade" id="percent_grading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Grading System </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_percentage.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                            <label> Description  </label>
                            <input type="text" name="description" id="description6" class="form-control"
                                placeholder="Enter Description">
                        </div>

                        <div class="form-group">
                            <label> Percent  </label>
                            <input type="text" name="percent" id="percent6" class="form-control"
                                placeholder="Enter Percent">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




    <!--EDIT PERCENTAGE-->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_percentage" tabindex="-1" role="dialog" aria-labelledby="editpercentage"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editpercentage"> EDIT GRADING SYSTEM </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_percentage.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id20" id="update_id20">

                        <div class="form-group">
                            <label> Description </label>
                            <input type="text" name="description" id="description" class="form-control"
                                placeholder="Enter Description">
                        </div>

                        <div class="form-group">
                            <label> Percent </label>
                            <input type="text" name="percents" id="percents" class="form-control"
                                placeholder="Enter Percent">
                        </div>


                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <!-- DELETE PERCENTAGE --> 

    <div class="modal fade" id="deletemodal_percentage" tabindex="-1" role="dialog" aria-labelledby="onsite_reffence"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="onsite_reffence"> DELETE Grading Systems </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_percentage.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id20" id="delete_id20">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>



                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


<div class="card custom-card">
<div class="card-body">
<button type="button" class="btn btn-primary percent_grading" data-toggle="modal" data-target="#percent_grading">ADD DATA
</button> 
<div class="container mt-5 me-5">
    
    <table id="datatableid" class="table table-bordered">
        <thead>
            <tr>
                <th colspan="3" scope="col">GRADING SYSTEM</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $connection = mysqli_connect("localhost", "root", "", "syllabus");
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                die();
            }

    
            $total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent";
            $total_percent_result = mysqli_query($connection, $total_percent_query);
            $total_percent_row = mysqli_fetch_assoc($total_percent_result);
            
            $total_percent = $total_percent_row['total_percent'];
            
     


            // Fetch module learning records
            $query = "SELECT `id`, `description`, `percents` FROM `percent`";

            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                    <tr>
                        <td class="hide-id"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                 
                       

                        <td><?php echo $row['percents']; ?></td>
                        
                        <td class="table-button">
                            <button type="button" class="btn btn-success editbtn_percentage"><i class="lni lni-pencil"></i></button>
                            <button type="button" class="btn btn-danger deletebtn_percentage"><i class="lni lni-trash-can"></i></button>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "No Record Found";
            }
            ?>
            <tr>
                <td colspan="5">TOTAL <a style="margin-left:8rem;"><?php echo  $total_percent; ?></a>%</td>
                
               
            </tr>
        </tbody>
    </table>
</div>
</div>
</div>







<div class="text-wrap container-box mt-5">




<span style="margin-left:4rem;"><b>Overall Final Grade</b><a> = Midterm + Final</a></span>
<a style="margin-left:22rem;">2</a>


<div class="mt-5 text-wrap container-fluid">
<a><b>COURSE POLICIES AND REQUIREMENTS </b></a><br>

<b>1. Office365 Activation.</b> <a>Please ensure that your Office365 account is working. Your Office365 
    account is needed to access both Schoolbook and MS Teams where your asynchronous and 
    synchronous classes will be held.</a><br><br>
<b>2. Enrollment in an E-Class.</b> <a>You will automatically be enrolled in your e-class which is based on 
    your enrollment data.</a><br><br>
<b>3. Traditional Blended Learning Model</b>    <a>This course adopts the traditional blended learning model. 
    This means that there will be a mix of face-to-face and asynchronous classes. Majority of teaching-learning activities and assessments are undertaken onsite. The total number of onsite classes shall 
    be 50% of the number of hours allotted for the whole semester.</a><br><br>
<b>4. Online Asynchronous Sessions. </b><br>
<br>

<div class="text-indent">
  
<b>a. Schoolbook (SB)</b>
    <a>Schoolbook shall be the only platform for asynchronous sessions.</a><br>

<b>b. Modules</b>
    <a>Modules are self-paced learning resources for asynchronous sessions. These can be accessed in Schoolbook.</a><br>

<b>c. References</b>
    <a>Each page section may contain uploaded references. These learning resources may be downloaded.</a><br>

<b>d. Asynchronous Activities</b>
    <a>You are expected to read the modules as soon as they are uploaded. The learning content of the modules complements the online synchronous and face-to-face sessions.</a><br>

<b>e. Asynchronous Engagement</b>
    <a>Your activities in the course can be tracked by your professor. This includes the time you spend in reading the lessons and answering the assessments.</a><br>

<b>f. Schoolbook Forum</b>
    <a>All general concerns about the lessons and assessments in asynchronous sessions must be posted in the Schoolbook Forum. Response shall be made by your teacher within 48 hours.</a><br>

<b>g. Schoolbook Messaging</b>
    <a>This shall be the mode of communication for private and/or confidential communications. Response shall be made by your teacher within 48 hours upon receipt of the same unless it falls on weekends or holidays, which shall be handled promptly the following working day.</a><br>


</div>

<br>
    
<b>5. Onsite / Face-to-face (F2F) Sessions. </b><br><br>

<div class="text-indent">

<b>a. Face-to-face engagement.</b>
    <a>Your engagement in face-to-face classes is graded based on your class participation.</a><br>

<b>b. Classroom.</b>
    <a>F2F classes shall be held at the classroom indicated in your Certificate of Registration. Should there be changes in the classroom venue, information will be given in advance.</a><br>

<b>c. Gospel Reading and Prayer.</b>
    <a>Each F2F session shall start with a Gospel reading and prayer. Your teacher may assign you, in advance, to do this.</a><br>

<b>d. F2F Meeting Schedule.</b>
    <a>The meeting schedule shall follow the time indicated in your official registration. The dates of F2F meetings are identified in the learning plan.</a><br>

<b>e. Attendance.</b>
    <a>Attendance in F2F meetings is required. Absence beyond 20% of the total number of F2F meetings will automatically be given a 0.0 grade in the subject.</a><br>

<b>f. Tardiness.</b>
    <a>A student who comes in 1-30 minutes after the start of the face-to-face meeting is considered late. Three tardy attendances are equivalent to 1 absence.</a><br>

<b>g. Absence.</b>
    <a>A student is considered absent 30 minutes after the official class schedule.</a><br>

<b>h. Excuse from F2F classes.</b>
    <a>Students are excused from F2F classes based on the provisions in the latest version of the Student Handbook.</a><br>

<b>i. Uniform.</b>
    <a>Wearing of prescribed uniform could be worn on Mondays, Thursdays, and Fridays, while Wednesdays and Saturdays are designated as wash days. Wearing of corporate attire could be worn every Tuesdays. Civilian attire should follow the policy on dress code as stipulated in the latest version of the Student Handbook.</a><br><br>

</div>

<b>6. Assessment and Grading System.</b><br><br>

<div class="text-indent">

<b>a. Formative assessments.</b>
    <a>These are ungraded assessments. These may be considered as practice assessments that lead towards achieving outcomes without fear of receiving a failing grade.</a><br>

<b>b. Enabling assessments.</b>
    <a>These will comprise most of your graded assessments. These are designed to achieve topic learning outcomes that lead towards achieving the course learning outcomes. A maximum of two enabling assessments shall be allowed during the week. Please pay attention to the duration and number of attempts. As a general rule, quiz-type enabling assessments shall be open for only a minimum of 24 hours, while output-based enabling assessments shall be open for at least 6 days.</a><br>

<b>c. No. of Attempts.</b>
    <a>All enabling assessments, if given onsite, shall have 1 attempt only. For online enabling assessments, there shall be a maximum of 2 attempts. Summative assessments shall be given onsite and shall have 1 attempt only.</a><br>

<b>d. Summative assessments.</b>
<ol class="c">
    <li>There shall be two summative assessments (midterm and final exams) for the entire semester. These are designed to achieve the course learning outcomes.</li>
    <li>Summative assessment shall be given onsite.</li>
    <li>Output-based summative assessment shall be given to students at least fifteen days prior to scheduled Summative Exam Week.</li>
</ol>

<b>e. Lifeline.</b>
    <a>Only students with (1) valid reasons as stated in the Student Handbook and IRR, and (2) given their proof of excuse on or before the next synchronous/F2F session, shall be given a lifeline on the enabling and summative assessments.</a><br>

<b>f. Rubric.</b>
    <a>All online non-quiz or non-discrete types of assessments (essay, drop box, output-based, etc.) shall have a rubric or criteria for rating the students’ tasks. A student may refuse to answer these types of assessments in the absence of a rubric or criteria for grading, and the assessment shall be deemed invalid and shall not be part of the student’s grades.</a><br>

<b>g. Grading.</b>
    <a>All online assessments should be checked and graded by the teacher before the submission of midterm and final grades.</a><br>

<b>h. Grading system.</b>
<ol class="c">
    <li>Enabling Assessments: 50%</li>
    <li>Class Participation: 20%</li>
    <li>Summative Assessments: 30%</li>
</ol>

<b>i. Gradebook.</b>
    <a>Students can see the breakdown of grades in their Assessment tab.</a><br><br>

    </div>

<b>7. Self-Care</b><br><br>

<div class="text-indent">

<b>a. Schedule.</b>
    <a>The schedule of self-care week for the second semester 2022-2023 is on April 24 to April 29. During this week, there shall be no asynchronous/synchronous meetings, F2F classes, new modules, new assessments, and deadlines.</a><br>

<b>b. Prerogative.</b>
    <a>Students may avail of the self-care program, whether online or onsite, provided by the different units of the University.</a><br><br>

    </div>

<b>8. Data Privacy. </b><br><br>

<div class="text-indent">

<b>a. Access to the MS Teams.</b>
        <a>Only students who are officially enrolled shall be part of the MS Teams and have access to all the resources including the recording. Students are not allowed to download the recordings. Screen recording is not allowed.</a><br>
    
    <b>b. Guests.</b>
        <a>Inviting people that are not part of the class in synchronous meetings is strictly prohibited, unless approved by the subject teacher.</a><br><br>

        </div>

<b>9.  Copyright and Plagiarism. </b><br><br>

<div class="text-indent">

    <a>a. Using of any illegally obtained software and other technology tools is strictly prohibited.</a><br>
    <a>b. Students are encouraged to use their original photos, videos, and other resources. 
    Otherwise, students can use royalty-free resources or embed the sources in their 
    submissions to avoid copyright infringement and/or plagiarism. 
    </a><br>
    <a>c. Giving of password to Schoolbook and Office 365 is strictly prohibited. Likewise, 
    accessing Schoolbook and Office 365 account other than the students’ personal account 
    is also strictly prohibited. Violating students will be reported to the Student Welfare and 
    Formation Office (SWAFO). 
    </a><br>
    <a>d. This subject shall abide by the policies pertaining to intellectual property, copyright, 
    and plagiarism as stipulated in the latest edition of the Student Handbook. 
    </a><br>
    <a>e. Any plagiarized work, whether in part or full, shall mean a grade of 0.0 for the 
    assessment.</a><br><br>

    </div>

    <a>10. This course shall abide by any institutional policies that may be released after the approval of this 
    syllabus. Any such policy shall be posted within the e-class at the forums section, news feed. It 
    will also be briefly discussed during the soonest synchronous meeting. </a><br><br>
</div>
</div>


<!-- GRADING SYSTEM -->









<!-- END OF GRADING SYSTEM -->



<!-- COURSE POLICIES AND REQUIREMENTS -->



<!-- ONSITE REFFERENCE -->

<!-- ADD ONSITE REFFERENCE -->

<!--Add Modal Final Period Table -->
<button type="button" class="btn btn-primary onsite_reffence_tables" data-toggle="modal" data-target="#onsite_reffence_tables">
                        ADD DATA
                    </button>

                    <!-- Modal -->
 <div class="modal fade" id="onsite_reffence_tables" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Learning Outcomes for Final Period </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_Reference Material.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                            <label> Provider  </label>
                            <input type="text" name="Provider" id="Provider6" class="form-control"
                                placeholder="Enter Provider">
                        </div>

                        <div class="form-group">
                        <label>Reference Material</label>
                        <textarea name="Reference_Material" id="Reference_Material6" class="editor7" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


<!-- EDIT ONSITE REFFERENCE -->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_onsite_reffence" tabindex="-1" role="dialog" aria-labelledby="editonsite_reffence"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editonsite_reffence"> COURSE LEARNING OUTCOMES </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_onsite_refference.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id6" id="update_id6">

                        <div class="form-group">
                            <label> Provider </label>
                            <input type="text" name="Provider" id="Provider" class="form-control"
                                placeholder="Enter Computer Provider">
                        </div>

                        <div class="form-group">
                        <label for="Reference_Material">Reference Material</label>
                        <textarea  name="Reference_Material" id="Reference_Material" class="form-control" placeholder="Enter Reference Material" cols="50" rows="5"></textarea>
                    </div>


                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- DELETE ONSITE REFFERENCE --> 

     <div class="modal fade" id="deletemodal_onsite_refference" tabindex="-1" role="dialog" aria-labelledby="onsite_reffence"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="onsite_reffence"> Delete On-Site References </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_onsite_reffence.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id7" id="delete_id7">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<div class="container-fluid mt-5 header-title ms-5">
<a><b>REFERENCES</b></a><br>
<a><b>On-Site References</b></a>
</div>


<div class="container mt-5">


<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



 $query = "SELECT * FROM  onsite_reffence";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered">
<thead>
    <tr>
        <th scope="col">Provider</th>
        <th scope="col">Reference Material</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<?php
if($query_run)
{
foreach($query_run as $row)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $row['id']; ?> </td>
        <td class=""><?php echo $row['Provider']; ?></td>
        <td class=""><?php echo $row['Reference_Material']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_onsite_reffence"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_onsite_refference"><i class="lni lni-trash-can"></i></button>
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>



</div>


<!-- online REFFERENCE -->

<!-- ADD online REFFERENCE -->

<!--Add Modal Final Period Table -->
<button type="button" class="btn btn-primary online_reffence" data-toggle="modal" data-target="#online_reffence">
                        ADD DATA
                    </button>

                    <!-- Modal -->
 <div class="modal fade" id="online_reffence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Online References</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_Online_Reference_Material.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                            <label> Call Number / E-provider  </label>
                            <input type="text" name="e_provider" id="e_provider6" class="form-control"
                                placeholder="Enter Provider">
                        </div>

                        <div class="form-group">
                        <label>Reference Material</label>
                        <textarea name="refference_material" id="refference_material6" class="Editor8" placeholder="Enter Reference Material" cols="50" rows="5"></textarea>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


<!-- EDIT online REFFERENCE -->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_online_refference" tabindex="-1" role="dialog" aria-labelledby="editonline_reffence"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editonline_reffence"> COURSE LEARNING OUTCOMES </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_online_refference.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id8" id="update_id8">

                        <div class="form-group">
                            <label> Call Number / E-provider </label>
                            <input type="text" name="e_provider" id="e_provider" class="form-control"
                                placeholder="Enter Computer Provider">
                        </div>

                        <div class="form-group">
                        <label for="refference_material">Reference Material</label>
                        <textarea  name="refference_material" id="refference_material" class="form-control" placeholder="Enter Reference Material" cols="50" rows="5"></textarea>
                    </div>


                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- DELETE online REFFERENCE --> 

     <div class="modal fade" id="deletemodal_online_refference" tabindex="-1" role="dialog" aria-labelledby="online_reffence"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="online_reffence"> Delete On-Site References </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_online_refference.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id8" id="delete_id8">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<div class="container-fluid mt-5 header-title ms-5">
<a><b>Online References</b></a>
</div>


<div class="container mt-5">


<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



 $query = "SELECT * FROM  online_refference";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered">
<thead>
    <tr>
        <th scope="col">Provider</th>
        <th scope="col">Reference Material</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<?php
if($query_run)
{
foreach($query_run as $row)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $row['id']; ?> </td>
        <td class=""><?php echo $row['e_provider']; ?></td>
        <td class=""><?php echo $row['refference_material']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_online_refference"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_online_refference"><i class="lni lni-trash-can"></i></button>
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>




</div>

<!-- EDIT SEMESTRAL -->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_semestral" tabindex="-1" role="dialog" aria-labelledby="edit_semestral"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_semestral"> EDIT SEMESTER </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_semestral.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id9" id="update_id9">
                        
                        <div class="form-group">
                        <label for="term">Term</label>
                        <select name="term" id="term" class="form-control">
                        <option value="1<sup>st</sup> Semester">1st Semester</option>
                            <option value="2<sup>nd</sup> Semester">2nd Semester</option>
                            <option value="Special Term">Special Term</option>
                        </select>
                    </div>

                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="year" id="year" class="form-control"
                                placeholder="Enter Year">
                        </div>



                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



<!-- SEMESTRAL -->
<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



 $query = "SELECT * FROM  semestral";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid">
<thead>
    <tr>
        <!-- <th scope="col">Provider</th>
        <th scope="col">Reference Material</th>
        <th scope="col">Action</th> -->
    </tr>
</thead>
<?php
if($query_run)
{
foreach($query_run as $row)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $row['id']; ?> </td>
        <td class="hide-id"><?php echo $row['term']; ?></td>
        <td class="hide-id"><?php echo $row['year']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_semestral sysllabus_button m-3"><i class="lni lni-pencil"></i></button><a>EDIT SEMESTER</a>

        <!-- <button type="button" class="btn btn-danger deletebtn_online_refference"><i class="lni lni-trash-can"></i></button> -->
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>


<div class="container-box mt-5 header-title mb-5">
<span><b>Prepared:</b><b><a class="course">  <?php echo ($course_departments); ?></a></b></span>



<a class="term_year"><td><?php echo $row['term']; ?> <?php echo $row['year']; ?></a></td><br><br>








<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_signature" tabindex="-1" role="dialog" aria-labelledby="edit_signature" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_signature">UPLOAD SIGNATURE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_signature_form" action="Course_Syllabus/update_signature.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="update_id22" id="update_id22">
                    <div class="form-group">
                        <label for="dept_signature">Dept Signature</label>
                        <input type="file" name="dept_signature" id="dept_signature" class="form-control">
                        <!-- Display a preview of the selected image -->
                        <img src="#" id="preview_dept_signature" style="display:none; max-width: 100px; max-height: 100px;" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Your custom script -->
<script>
$(document).ready(function(){

    $('#categorySelect').on('change', function(){
        var categoryId = $(this).val();
        $.ajax({
            url: 'get_cities.php',
            type: 'POST',
            data: {catid: categoryId},
            success: function(response){
                $('#courseDropdown').html(response);
            }
        });
    });

    // Save button action (just an example)
    $('#saveSelection').on('click', function(){
        var category = $('#categorySelect option:selected').text();
        var course = $('#courseSelect option:selected').text();
        alert('Selected category: ' + category + ', course: ' + course);
    });
});
</script>

</body>
</html>

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_signature_dean" tabindex="-1" role="dialog" aria-labelledby="edit_signature_dean" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_signature_dean">UPLOAD SIGNATURE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_signature_dean_form" action="Course_Syllabus/update_signature_dean.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="update_id23" id="update_id23">
                    <div class="form-group">
                        <label for="dean_signature">Dean Signature</label>
                        <input type="file" name="dean_signature" id="dean_signature" class="form-control">
                        <!-- Display a preview of the selected image -->
                        <img src="#" id="preview_dean_signature" style="display:none; max-width: 100px; max-height: 100px;" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- SEMESTRAL -->
<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



     $email = $_SESSION['email'];
     $query1 = "SELECT 
                 u.`first_name`, 
                 u.`last_name`, 
                 u.`department`, 
                 u.`catid`, 
                 u.`phone_number`, 
                 u.`email`, 
                 u.`password`, 
                 p.`name` AS `position`,
                 c.`id` AS `category_id`,
                 c.`name` AS `category_name`,
                 c.`initial` AS `category_initial`,
                 c.`dean_name` AS `deans`,
                 c.`dean_position` AS `deans_position`,
                 c.`dean_signature` AS `dean_signatures`,
                 co.`cname`,
                 co.`course_department` AS `course_departments`,
                 co.`id` AS `course_id`,
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
 $query_run1 = mysqli_query($connection, $query1);
?>  
<table id="datatableid">
<thead>
    <tr>
        <!-- <th scope="col">Provider</th>
        <th scope="col">Reference Material</th>
        <th scope="col">Action</th> -->
    </tr>
</thead>
<?php
if($query_run1)
{
foreach($query_run1 as $rows)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $rows['course_id']; ?> </td>
        <td class="hide-id"><?php echo $rows['dept_signatures']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_signature m-3"><i class="lni lni-pencil"></i></button><a>UPLOAD SIGNATURE</a>

    
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>








<span><b></b><b><a class="initial"><img src="<?php echo $dept_head_signature; ?>" alt="Department Head Signature"></a></b></span>
<span><b>Approved:</b><b><a class="dept_name"><?php echo $dept_head; ?></a></b></span>
<span><a class="initial"><?php echo $dept_head_position ." , ". $course_initial; ?></a></span><br><br>




<!-- SEMESTRAL -->
<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



     $email = $_SESSION['email'];
     $query2 = "SELECT 
                 u.`first_name`, 
                 u.`last_name`, 
                 u.`department`, 
                 u.`catid`, 
                 u.`phone_number`, 
                 u.`email`, 
                 u.`password`, 
                 p.`name` AS `position`,
                 c.`id` AS `category_id`,
                 c.`name` AS `category_name`,
                 c.`initial` AS `category_initial`,
                 c.`dean_name` AS `deans`,
                 c.`dean_position` AS `deans_position`,
                 c.`dean_signature` AS `dean_signatures`,
                 co.`cname`,
                 co.`course_department` AS `course_departments`,
                 co.`id` AS `course_id`,
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
 $query_run2 = mysqli_query($connection, $query2);
?>  
<table id="datatableid">
<thead>
    <tr>
        <!-- <th scope="col">Provider</th>
        <th scope="col">Reference Material</th>
        <th scope="col">Action</th> -->
    </tr>
</thead>
<?php
if($query_run2)
{
foreach($query_run2 as $table_rows)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $table_rows['category_id']; ?> </td>
        <td class="hide-id"><?php echo $table_rows['dean_signatures']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_signature_dean m-3"><i class="lni lni-pencil"></i></button><a>UPLOAD SIGNATURE</a>

    
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>













<!-- FOR REVISED -->
<span><b></b><b><a class="initial"><img src="<?php echo $deans_category_signature; ?>" alt="Department Head Signature"></a></b></span>
<span><b>Endorsed:</b><b><a class="dept_name"><?php echo $category_dean; ?></a></b></span>
<span><a class="initial"><?php echo $category_dean_position ." , ". $category_initial; ?></a></span>



</div>

<style>
    .term_year, .initial{
        margin-left: 9rem;
    }

    .course, .dept_name{
        margin-left: 3rem;
    }
    
</style>


<!-- MAPPING HEADER -->
<div class="card custom-card">
<div class="card-body">
<div class="pt-5 pb-4">
        <img src="../img/logos.png" class="logos" alt="">
        
   
    </div>
    <div class="text-center">
    <h4>DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4><?php echo strtoupper($category_name);?> </h4>
    <h4><?php echo strtoupper($course_departments);?> </h4>
    <p class="pb-3"></p>
    <h4>COURSE SYLLABUS</h4>
    </div>


    <!-- MAPPING TABLE -->


    <?php
                     
           
                     // Database connection
                     
                     $connection = mysqli_connect("localhost","root","","syllabus");
                         if (mysqli_connect_errno()){
                             echo "Failed to connect to MySQL: " . mysqli_connect_error();
                             die();
                             }
                     

                         $query = "SELECT * FROM course_syllabus";
                         $query_run = mysqli_query($connection, $query);
            ?>  
                    <table id="datatableid">
                        <thead>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td class="hide-id"> <?php echo $row['id']; ?> </td>
                                <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_code']; ?></td>

                            <td class="hide-id"  style="border: 1px solid white;"><?php echo $row['course_tittle']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_Type']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_credit']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['learning_modality']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['pre_requisit']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['co_pre_requisit']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['professor']; ?></td>

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_date']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_room']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_number']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours_email']; ?></td>
                            
                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['course_description']; ?></td>
                                
                            <!-- <td>
                                <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button>

                                <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i></button>

                                <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i></button>
                                </td> -->
                            </tr>
                        </tbody>
                        <?php           
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            ?>
                    </table>
           
                    <div class="container text-left">
    <div class=" header text-left">COURSE CODE</div>
    <div class="">:</div>
    <div class=""><?php echo $row['course_code']; ?></div>
  
    <div class=" header text-left">COURSE TITLE</div>
    <div class="">:</div>
    <div class=""><?php echo $row['course_tittle']; ?></div>

    <div class=" header text-left">COURSE TYPE</div>
    <div class="">:</div>
    <div class=""><?php echo $row['course_Type']; ?></div>
   
    <div class=" header text-left">COURSE CREDIT</div>
    <div class="">:</div>
    <div class=""><?php echo $row['course_credit']; ?></div>

    <div class=" header text-left">LEARNING MODALITY</div>
    <div class="">:</div>
    <div class=""><?php echo $row['learning_modality']; ?></div>

    <div class=" header text-left">PRE-REQUISITES</div>
    <div class="">:</div>
    <div class=""><?php echo $row['pre_requisit']; ?></div>

    <div class=" header text-left">CO-REQUISITES</div>
    <div class="">:</div>
    <div class=""><?php echo $row['co_pre_requisit']; ?></div>


</div>


<button type="button" class="btn btn-primary add_databtn_mapping_table" data-toggle="modal" data-target="#mapping_table">
                        ADD DATA
                    </button>

                    <!-- Modal -->
 <div class="modal fade" id="mapping_table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Learning Outcome </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_mapping_table.php" method="POST">

                    <div class="modal-body">
                   

                        <div class="form-group">

                        <textarea type="text" name="learn_out_mapping" col="40" cols="50" rows="5" id="learn_out_mappings" class="Editor9"
                                placeholder="Enter Computer Laborator"></textarea>
                        

                        </div>


                        <div class="form-group">

                        <label>Course Learning Outcomes</label><br>
                        <label for="pl1">PLO1</label>
                        <label style="margin-left: 5px;" for="pl2">PLO2</label>
                        <label style="margin-left: 5px;" for="pl3">PLO3</label>
                        <label style="margin-left: 5px;" for="pl4">PLO4</label>
                        <label style="margin-left: 5px;" for="pl5">PLO5</label>
                        <label style="margin-left: 5px;" for="pl6">PLO6</label>
                        <label style="margin-left: 5px;" for="pl7">PLO7</label>
                        <label style="margin-left: 5px;" for="pl8">PLO8</label>
                        <label style="margin-left: 5px;" for="pl9">PLO9</label>

                        </div>

                        <div class="form-group" Style="Display:flex;">

                        
                        <input type="checkbox" name="pl1_s" id="pl1s" value="/" class="form-control">
                        

                        <input type="checkbox" name="pl2_s" id="pl2s" value="/" class="form-control">
                        

                        <input type="checkbox" name="pl3_s" id="pl3s" value="/" class="form-control">
                    

                        <input type="checkbox" name="pl4_s" id="pl4s" value="/" class="form-control">
                     

                        <input type="checkbox" name="pl5_s" id="pl5s" value="/" class="form-control">
                    

                        <input type="checkbox" name="pl6_s" id="pl6s" value="/" class="form-control">
                      

                        <input type="checkbox" name="pl7_s" id="pl7s" value="/" class="form-control">
                    

                        <input type="checkbox" name="pl8_s" id="pl8s" value="/" class="form-control">
                  

                        <input type="checkbox" name="pl9_s" id="pl9s" value="/" class="form-control">
                       
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<!-- EDIT MAPPING TABLE REFFERENCE -->

<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_mapping_tablespls" tabindex="-1" role="dialog" aria-labelledby="editmapping_tablespls"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmapping_tablespls"> COURSE LEARNING OUTCOMES </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_mapping_tablespls.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id10" id="update_id10">

                        <div class="form-group">
                            <label> Computer Laboratory </label>
                            <textarea type="text" name="learn_out_mapping" col="40" cols="50" rows="5" id="learn_out_mapping" class="form-control"
                                placeholder="Enter Computer Laborator"></textarea>
                        </div>

                        <div class="form-group">

                        <label>Course Learning Outcomes</label><br>
                        <label for="pl1">PLO1</label>
                        <label style="margin-left: 5px;" for="pl2">PLO2</label>
                        <label style="margin-left: 5px;" for="pl3">PLO3</label>
                        <label style="margin-left: 5px;" for="pl4">PLO4</label>
                        <label style="margin-left: 5px;" for="pl5">PLO5</label>
                        <label style="margin-left: 5px;" for="pl6">PLO6</label>
                        <label style="margin-left: 5px;" for="pl7">PLO7</label>
                        <label style="margin-left: 5px;" for="pl8">PLO8</label>
                        <label style="margin-left: 5px;" for="pl9">PLO9</label>

                        </div>

                        <div class="form-group" Style="Display:flex;">

                        
                        <input type="checkbox" name="pl1" id="pl1" value="/" class="form-control pls">
                        

                        <input type="checkbox" name="pl2" id="pl2" value="/" class="form-control pls">
                        

                        <input type="checkbox" name="pl3" id="pl3" value="/" class="form-control pls">
                    

                        <input type="checkbox" name="pl4" id="pl4" value="/" class="form-control pls">
                     

                        <input type="checkbox" name="pl5" id="pl5" value="/" class="form-control pls">
                    

                        <input type="checkbox" name="pl6" id="pl6" value="/" class="form-control pls">
                      

                        <input type="checkbox" name="pl7" id="pl7" value="/" class="form-control pls">
                    

                        <input type="checkbox" name="pl8" id="pl8" value="/" class="form-control pls">
                  

                        <input type="checkbox" name="pl9" id="pl9" value="/" class="form-control pls">

                
                       
                    </div>



                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="goback()">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- DELETE MAPPING TABLE PLS --> 

    <div class="modal fade" id="deletemodal_mapping_tablepls" tabindex="-1" role="dialog" aria-labelledby="online_reffence"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="online_reffence"> Delete On-Site References </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_mapping_tablepls.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id10" id="delete_id10">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

<div class="container mt-5">



<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



 $query = "SELECT * FROM  mapping_table";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered b-5">
<thead>
    <tr>
        <th rowspan="2" scope="col">Course Learning Outcome</th>
        <th class="text-center" colspan="9" scope="col">Program Learning Outcomes</th>
    </tr>
        <tr>
        <th scope="col">PLO1</th>
        <th scope="col">PLO2</th>
        <th scope="col">PLO3</th>
        <th scope="col">PLO4</th>
        <th scope="col">PLO5</th>
        <th scope="col">PLO6</th>
        <th scope="col">PLO7</th>
        <th scope="col">PLO8</th>
        <th scope="col">PLO9</th>
        <th scope="col">ACTION</th>
        </tr>
       
    </tr>
</thead>
<?php
if($query_run)
{
foreach($query_run as $row)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $row['id']; ?> </td>
        <td class=""><?php echo $row['learn_out_mapping']; ?></td>
        <td class="text-center"><?php echo $row['pl1']; ?></td>
        <td class="text-center"><?php echo $row['pl2']; ?></td>
        <td class="text-center"><?php echo $row['pl3']; ?></td>
        <td class="text-center"><?php echo $row['pl4']; ?></td>
        <td class="text-center"><?php echo $row['pl5']; ?></td>
        <td class="text-center"><?php echo $row['pl6']; ?></td>
        <td class="text-center"><?php echo $row['pl7']; ?></td>
        <td class="text-center"><?php echo $row['pl8']; ?></td>
        <td class="text-center"><?php echo $row['pl9']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_mapping_tablepls"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_mapping_tablepls"><i class="lni lni-trash-can"></i></button>
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>








</div>



<!-- GRADUATE ATTRIBUTES -->

<div class="pt-5 pb-4">
        <img src="../img/logos.png" class="logos" alt="">
        
   
    </div>
    <div class="text-center">
    <h4>DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4><?php echo strtoupper($category_name);?> </h4>
    <h4><?php echo strtoupper($course_departments);?> </h4>
    <p class="pb-3"></p>
    <h4>GRADUATE ATTRIBUTES (DESCRIPTORS/INSTITUTIONAL LEARNING OUTCOMES) – </h4>
    <h4>PROGRAM LEARNING OUTCOME MAPPING TABLE FOR </h4>
    <h4><?php echo strtoupper($cname);?></h4>
    </div>


<!-- ADD MODAL GRADUATE ATTRIBUTES -->
<button type="button" class="btn btn-primary add_databtn_decriptors" data-toggle="modal" data-target="#decriptors">
                        ADD DATA
                    </button>

                    <!-- Modal -->
 <div class="modal fade" id="decriptors" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Learning Outcome </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_decriptors.php" method="POST">

                    <div class="modal-body">
                   

                        <div class="form-group">

                        <label>Program Learning Outcomes</label><br>
                        <textarea type="text" name="program_learn" col="40" cols="50" rows="5" class="Editor10"
                                placeholder="Enter Computer Laborator"></textarea>
                        

                        </div>


                        <div class="form-group">
                     
                        
                    </div>
                    
                    <div class="form-group">
                        
                        
                        <input type="checkbox" name="rate1_s"value="/">
                        <label style="margin-left: 5px;">1</label><br>
                        

                        <input type="checkbox" name="rate2_s" value="/">
                        <label style="margin-left: 5px;">2</label><br>

                        <input type="checkbox" name="rate3_s" value="/">
                        <label style="margin-left: 5px;">3</label><br>

                        <input type="checkbox" name="rate4_s" value="/">
                        <label style="margin-left: 5px;">4</label><br>

                        <input type="checkbox" name="rate5_s" value="/">
                        <label style="margin-left: 5px;">5</label>
                      
                       
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>




<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_decriptors" tabindex="-1" role="dialog" aria-labelledby="editdecriptors" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editdecriptors"> COURSE LEARNING OUTCOMES </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="Course_Syllabus/update_decriptors.php" method="POST">

                <div class="modal-body">

                    <input type="hidden" name="update_id11" id="update_id11">

                    <div class="form-group">
                        <label> Computer Laboratory </label>
                        <textarea type="text" name="program_learn" col="40" cols="50" rows="5" id="program_learn" class="form-control"
                            placeholder="Enter Computer Laborator"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="rate1" id="rate1" value="/">
                        <label for="">1</label>

                        <input type="checkbox" name="rate2" id="rate2" value="/">
                        <label for="">2</label>

                        <input type="checkbox" name="rate3" id="rate3" value="/">
                        <label for="">3</label>

                        <input type="checkbox" name="rate4" id="rate4" value="/">
                        <label for="">4</label>

                        <input type="checkbox" name="rate5" id="rate5" value="/">
                        <label for="">5</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                </div>
            </form>

        </div>
    </div>
</div>

    <!-- DELETE MAPPING TABLE PLS --> 

    <div class="modal fade" id="deletemodal_decriptors" tabindex="-1" role="dialog" aria-labelledby="decriptors"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="decriptors"> Delete On-Site References </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_decriptors.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id11" id="delete_id11">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>




<!-- GRADUATES ATTRIBUTES -->


    


<div class="container mt-5">



<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



 $query = "SELECT * FROM decriptors";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered b-5">
<thead>
    <tr>
        <th class="text-center" scope="col">Program Learning Outcomes</th>
        <th class="text-center"  scope="col">1</th>
        <th class="text-center"  scope="col">2</th>
        <th class="text-center"  scope="col">3</th>
        <th class="text-center"  scope="col">4</th>
        <th class="text-center"  scope="col">5</th>
        <th class="text-center"  scope="col">ACTION</th>
    </tr>
</thead>
<?php
if($query_run)
{
foreach($query_run as $row)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $row['id']; ?> </td>
        <td class=""><?php echo $row['program_learn']; ?></td>
        <td class=""><?php echo $row['rate1']; ?></td>
        <td class=""><?php echo $row['rate2']; ?></td>
        <td class=""><?php echo $row['rate3']; ?></td>
        <td class=""><?php echo $row['rate4']; ?></td>
        <td class=""><?php echo $row['rate5']; ?></td>

        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_decriptors"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_decriptors"><i class="lni lni-trash-can"></i></button>
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>

</div>







<!-- GRADUATE ATTRIBUTE -->

<div class="pt-5 pb-4">
        <img src="../img/logos.png" class="logos" alt="">
        
   
    </div>
    <div class="text-center">
    <h4>DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4><?php echo strtoupper($category_name);?> </h4>
    <h4><?php echo strtoupper($course_departments);?> </h4>
    <p class="pb-3"></p>
    <h4>GRADUATES ATTRIBUTES AND INSTITUTIONAL LEARNING OUTCOMES (ILOs)</h4>
    </div>




<!-- ADD online REFFERENCE -->

<!--Add Modal Final Period Table -->
<button type="button" class="btn btn-primary graduate_attribute" data-toggle="modal" data-target="#graduate_attribute">
                        ADD DATA
                    </button>

                    <!-- Modal -->
 <div class="modal fade" id="graduate_attribute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Online References</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_graduate_attribute.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                            <label> Graduate Attribute (GA)  </label>
                            <input type="text" name="graduate_att" id="graduate_att6" class="form-control"
                                placeholder="Enter Graduate Attribute (GA)">
                        </div>

                        <div class="form-group">
                        <label>Descriptors (Institutional Learning Outcome)</label>
                        <textarea name="descriptors_learn_out" id="descriptors_learn_out6" class="Editor11" placeholder="Enter Descriptors (Institutional Learning Outcome)" cols="50" rows="5"></textarea>
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_graduate_attributes" tabindex="-1" role="dialog" aria-labelledby="editgraduate_attributes"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editgraduate_attributes"> COURSE LEARNING OUTCOMES </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_graduate_attributes.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id12" id="update_id12">

                        <div class="form-group">
                            <label> Graduate Attribute (GA) </label>
                            <input type="text" name="graduate_att" id="graduate_att" class="form-control"
                                placeholder="Enter Graduate Attribute (GA)">
                        </div>

                        <div class="form-group">
                        <label for="descriptors_learn_out">Descriptors (Institutional Learning Outcome)</label>
                        <textarea  name="descriptors_learn_out" id="descriptors_learn_out" class="form-control" placeholder="Enter Descriptors (Institutional Learning Outcome)" cols="50" rows="5"></textarea>
                    </div>


                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


      <!-- DELETE GRADUATE ATTRIBUTES --> 

      <div class="modal fade" id="deletemodal_graduate_attributes" tabindex="-1" role="dialog" aria-labelledby="gradute_attributes"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gradute_attributes"> Delete On-Site References </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_graduate_attributes.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id12" id="delete_id12">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


<div class="container mt-5">




<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



 $query = "SELECT * FROM  graduates_attributes";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered">
<thead>
    <tr>
        <th scope="col">Graduate Attribute (GA)</th>
        <th scope="col">Descriptors (Institutional Learning Outcome)</th>
        <th scope="col">Action</th>
    </tr>
</thead>
<?php
if($query_run)
{
foreach($query_run as $row)
{
?>
<tbody>
  
<tr>
        <td class="hide-id"> <?php echo $row['id']; ?> </td>
        
        <td class=""><?php echo $row['graduate_att']; ?></td>
        <td class=""><?php
                        if (strpos($row['descriptors_learn_out'], 'TLO') !== false || strpos($row['descriptors_learn_out'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['descriptors_learn_out']);
                        } else {
                            echo $row['descriptors_learn_out'];
                        }
                        ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_graduate_attributes"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_graduate_attributes"><i class="lni lni-trash-can"></i></button>
        </td>
    </tr>



</tbody>
<?php           
}
}
else 
{
echo "No Record Found";
}
?>
</table>


</div>



<div class="container mt-5 font-italic">

<a>Approved in </a><?php echo date("F") ." ".date("Y"); ?>  <a>during a multi-sectoral committee specifically convened for the purpose of coming up with 
descriptions for the graduate attributes.</a>
</div>



                 
               
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

    

    <script>
    $(document).ready(function () {

        $('.editbtn').on('click', function () {

            $('#editmodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_idsyslabus').val(data[0]);
            $('#course_code').val(data[1]);
            $('#course_tittle').val(data[2]);

            // Auto check checkbox for course_Type
            var courseType = data[3];
            $('input[name="course_Type"][value="' + courseType + '"]').prop('checked', true);

            $('#course_credit').val(data[4]);

            // Auto check checkbox for learning_modality
            var learningModality = data[5];
            $('input[name="learning_modality"][value="' + learningModality + '"]').prop('checked', true);

            $('#pre_requisit').val(data[6]);
            $('#co_pre_requisit').val(data[7]);
            $('#professor').val(data[8]);
            $('#consultation_hours_date').val(data[9]);
            $('#consultation_hours_room').val(data[10]);
            $('#consultation_hours_email').val(data[11]);
            $('#consultation_hours_number').val(data[12]);
            $('#course_description').val(data[13]);
        });
    });

</script>


    <script>
    $(document).ready(function () {

        $('.editbtn_learning_out').on('click', function () {

            $('#editmodal_learn_out').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id').val(data[0]);
            $('#comlab').val(data[1]);
            $('#learn_out').val(data[3]);
        });
    });
</script>

<script>
    $(document).ready(function () {

        $('.editbtn_learning_out_table').on('click', function () {

            $('#editmodal_learn_out_table').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id1').val(data[0]);
            $('#topic_learn_out').val(data[2]);
        });
    });
</script>








<script>
        $(document).ready(function () {

            $('.deletebtn_learning_out').on('click', function () {

                $('#deletemodal_learning_out').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>


<script>
        $(document).ready(function () {

            $('.deletebtn_module_learning').on('click', function () {

                $('#deletemodal_module_learning').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id3').val(data[0]);

            });
        });
    </script>



<script>
    $(document).ready(function () {
        $('.editbtn_module_learning').on('click', function () {
            $('#editmodal_module_learning').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            console.log(data);
            $('#update_id3').val(data[0]);
            $('#module_no').val(data[1]);
            $('#week').val(data[2]);
            $('#date').val(data[3]);
            $('#teaching_activities').val(data[4]);
            $('#technology').val(data[5]);
            
            // Handling the 'onsite' checkbox
            var onsite = data[6];
            if (onsite === '/') {
                $('input[name="onsite"]').prop('checked', true);
            } else {
                $('input[name="onsite"]').prop('checked', false);
            }
            
            // Handling the 'asy' checkbox
            var asy = data[7];
            if (asy === '/') {
                $('input[name="asy"]').prop('checked', true);
            } else {
                $('input[name="asy"]').prop('checked', false);
            }

            $('#alloted_hours').val(data[8]);
        });
    });
</script>



<script>
    $(document).ready(function () {

        $('.editbtn_module_learning_final').on('click', function () {

            $('#editmodal_module_learning_final').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id15').val(data[0]);
            $('#1module_no').val(data[1]);
            $('#1week').val(data[2]);    

            // Auto check checkbox for course_Type
            
            $('#1date').val(data[3]);
            $('#1teaching_activities').val(data[4]);
            $('#1technology').val(data[5]);
            var onsite1 = data[6];
            if (onsite1 === '/') {
                $('input[name="onsite1"]').prop('checked', true);
            } else {
                $('input[name="onsite1"]').prop('checked', false);
            }
            
            // Handling the 'asy' checkbox
            var asy1 = data[7];
            if (asy1 === '/') {
                $('input[name="asy1"]').prop('checked', true);
            } else {
                $('input[name="asy1"]').prop('checked', false);
            }

            $('#alloted_hours2').val(data[8]);

        });
    });

</script>

<script>
        $(document).ready(function () {

            $('.deletebtn_module_learning_final').on('click', function () {

                $('#deletemodal_module_learning_final').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id15').val(data[0]);

            });
        });
    </script>

<!-- EDIT BTN FOR FINAL PERIOD TABLE -->

<script>
    $(document).ready(function () {

        $('.editbtn_learning_out_final_period_table').on('click', function () {

            $('#editmodal_learn_out__final_period_table').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id5').val(data[0]);
            $('#final_learning_out').val(data[1]);
            $('#final_topic_leaning_out').val(data[2]);
        });
    });
</script>

<!-- DELETE BTN FOR FINAL PERIOD TABLE -->

<script>
        $(document).ready(function () {

            $('.deletebtn_learning_out_final_period_table').on('click', function () {

                $('#deletemodal_learn_out__final_period_table').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id6').val(data[0]);

            });
        });
    </script>


<!-- EDIT BTN FOR ONSITE REFFERENCE -->

<script>
    $(document).ready(function () {

        $('.editbtn_onsite_reffence').on('click', function () {

            $('#editmodal_onsite_reffence').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id6').val(data[0]);
            $('#Provider').val(data[1]);
            $('#Reference_Material').val(data[2]);
        });
    });
</script>

<!-- DELETE BTN FOR ONSITE REFFERENCE -->

<script>
        $(document).ready(function () {

            $('.deletebtn_onsite_refference').on('click', function () {

                $('#deletemodal_onsite_refference').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id7').val(data[0]);

            });
        });
    </script>



<!-- EDIT BTN FOR ONSITE REFFERENCE -->

<script>
    $(document).ready(function () {

        $('.editbtn_online_refference').on('click', function () {

            $('#editmodal_online_refference').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id8').val(data[0]);
            $('#e_provider').val(data[1]);
            $('#refference_material').val(data[2]);
        });
    });
</script>

<!-- DELETE BTN FOR ONSITE REFFERENCE -->

<script>
        $(document).ready(function () {

            $('.deletebtn_online_refference').on('click', function () {

                $('#deletemodal_online_refference').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id8').val(data[0]);

            });
        });
    </script>



<!-- EDIT BTN FOR SEMESTRAL -->

<script>
    $(document).ready(function () {

        $('.editbtn_semestral').on('click', function () {

            $('#editmodal_semestral').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id9').val(data[0]);
            $('#term').val(data[1]);
            $('#year').val(data[2]);
        });
    });
</script>


<script>
    $(document).ready(function () {
        $('.editbtn_signature').on('click', function () {
            $('#editmodal_signature').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            $('#update_id22').val(data[0]);
            // Clear any previously selected file
            $('#dept_signature').val('');
        });

        // Preview the selected image
        $('#dept_signature').change(function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview_dept_signature').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#preview_dept_signature').hide();
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.editbtn_signature_dean').on('click', function () {
            $('#editmodal_signature_dean').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();
            $('#update_id23').val(data[0]);
            // Clear any previously selected file
            $('#dean_signature').val('');
        });

        // Preview the selected image
        $('#dean_signature').change(function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview_dean_signature').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(file);
            } else {
                $('#preview_dean_signature').hide();
            }
        });
    });
</script>



<!-- EDIT BTN FOR MAPPING TABLE PLS -->

<script>
    $(document).ready(function () {

        $('.editbtn_mapping_tablepls').on('click', function () {

            $('#editmodal_mapping_tablespls').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id10').val(data[0]);
            $('#learn_out_mapping').val(data[1]);
            var pl1 = data[2];
            if (pl1 === '/'){
                $('input[name="pl1"]').prop('checked', true);
            }else{
                $('input[name="pl1"]').prop('checked', false);
            }
            var pl2 = data[3];
            if (pl2 === '/'){
                $('input[name="pl2"]').prop('checked', true);
            }else{
                $('input[name="pl2"]').prop('checked', false);
            }

            var pl3 = data[4];
            if (pl3 === '/'){
                $('input[name="pl3"]').prop('checked', true);
            }else{
                $('input[name="pl3"]').prop('checked', false);
            }

            var pl4 = data[5];
            if (pl4 === '/'){
                $('input[name="pl4"]').prop('checked', true);
            }else{
                $('input[name="pl4"]').prop('checked', false);
            }

            var pl5 = data[6];
            if (pl5 === '/'){
                $('input[name="pl5"]').prop('checked', true);
            }else{
                $('input[name="pl5"]').prop('checked', false);
            }

            var pl6 = data[7];
            if (pl6 === '/'){
                $('input[name="pl6"]').prop('checked', true);
            }else{
                $('input[name="pl6"]').prop('checked', false);
            }

            var pl7 = data[8];
            if (pl7 === '/'){
                $('input[name="pl7"]').prop('checked', true);
            }else{
                $('input[name="pl7"]').prop('checked', false);
            }

            var pl8 = data[9];
            if (pl8 === '/'){
                $('input[name="pl8"]').prop('checked', true);
            }else{
                $('input[name="pl8"]').prop('checked', false);
            }
            
            var pl9 = data[10];
            if (pl9 === '/'){
                $('input[name="pl9"]').prop('checked', true);
            }else{
                $('input[name="pl9"]').prop('checked', false);
            }
            
            
            


          
        });
    });
</script>



<script>
        $(document).ready(function () {

            $('.deletebtn_mapping_tablepls').on('click', function () {

                $('#deletemodal_mapping_tablepls').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id10').val(data[0]);

            });
        });
    </script>



<script>
    $(document).ready(function () {

        $('.editbtn_decriptors').on('click', function () {

            $('#editmodal_decriptors').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id11').val(data[0]);
            $('#program_learn').val(data[1]);
            var rate1 = data[2];
            if (rate1 === '/'){
                $('input[name="rate1"]').prop('checked', true);
            }else{
                $('input[name="rate1"]').prop('checked', false);
            }

            var rate2 = data[3];
            if (rate2 === '/'){
                $('input[name="rate2"]').prop('checked', true);
            }else{
                $('input[name="rate2"]').prop('checked', false);
            }

            var rate3 = data[4];
            if (rate3 === '/'){
                $('input[name="rate3"]').prop('checked', true);
            }else{
                $('input[name="rate3"]').prop('checked', false);
            }

            var rate4 = data[5];
            if (rate4 === '/'){
                $('input[name="rate4"]').prop('checked', true);
            }else{
                $('input[name="rate4"]').prop('checked', false);
            }

            var rate5 = data[6];
            if (rate5 === '/'){
                $('input[name="rate5"]').prop('checked', true);
            }else{
                $('input[name="rate5"]').prop('checked', false);
            }
            


          
        });
    });
</script>


<script>
        $(document).ready(function () {

            $('.deletebtn_decriptors').on('click', function () {

                $('#deletemodal_decriptors').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id11').val(data[0]);

            });
        });
    </script>


<script>
    $(document).ready(function () {

        $('.editbtn_graduate_attributes').on('click', function () {

            $('#editmodal_graduate_attributes').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id12').val(data[0]);
            $('#graduate_att').val(data[1]);
            $('#descriptors_learn_out').val(data[2]);
        });
    });
</script>



<script>
        $(document).ready(function () {

            $('.deletebtn_graduate_attributes').on('click', function () {

                $('#deletemodal_graduate_attributes').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id12').val(data[0]);

            });
        });
    </script>


<script>
    $(document).ready(function () {

        $('.editbtn_percentage').on('click', function () {

            $('#editmodal_percentage').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function () {
                return $(this).text();
            }).get();

            console.log(data);

            $('#update_id20').val(data[0]);
            $('#description').val(data[1]);
            $('#percents').val(data[2]);
        });
    });
</script>

<!-- DELETE BTN FOR PERCENTAGE -->

<script>
        $(document).ready(function () {

            $('.deletebtn_percentage').on('click', function () {

                $('#deletemodal_percentage').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id20').val(data[0]);

            });
        });
    </script>


<script>
    function goback() {
        window.history.back();
    }
</script>


<script>
                    ClassicEditor
    .create( document.querySelector( '.editor' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>


<script>
                    ClassicEditor
    .create( document.querySelector( '.editor1' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.editor2' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.editor3' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.editor4' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.editor5' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.editor6' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.editor7' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.Editor8' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.Editor9' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.Editor10' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>
<script>
                    ClassicEditor
    .create( document.querySelector( '.Editor11' ) ) // Change from querySelector to querySelectorAll
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

    </script>

</body>
</html>
