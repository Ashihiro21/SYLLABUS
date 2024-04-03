<?php

session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

include('../Database/connection.php');

$email = $_SESSION['email'];
$sql = "SELECT position FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $position = $row["position"];
    }
} else {
    $position = "Position not found";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
 
 .hide-id {
    display: none;
}

</style>
<body>
    <div class="container-fluid">
    <h2>Welcome to Dashboard</h2>
   
<span><p><?php echo $position; ?><a href="logout.php">Logout</a></p></span>


 
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

                <form action="Course_Syllabus/update_course_learning_outcome.php" method="POST">

                    <div class="modal-body">

                        <input type="text" name="update_id" id="update_id">

                        <div class="form-group">
                            <label> Computer Laboratory </label>
                            <input type="text" name="comlab" id="comlab" class="form-control"
                                placeholder="Enter Computer Laboratory">
                        </div>

                        <div class="form-group">
                        <label for="learn_out">Course Learning Outcome</label>
                        <textarea  name="learn_out" id="learn_out" class="form-control" placeholder="Enter Course Learning Outcome" cols="50" rows="5"></textarea>
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

 


    


    







     <!-- EDIT POP UP FORM FOR COURSE SYLLABUS (Bootstrap MODAL) -->
     <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Employee Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_syllabus.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

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
                            <textarea id="course_description" name="course_description" id="course_description" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter Course Description"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
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

    <!-- <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button> -->




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
                                
                            <td>
                                <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                                <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i>EDIT</button>

                                <!-- <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i>DELETE</button> -->
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
           
                    <div class="container">
    <div class="grid-item header">COURSE CODE</div>
    <div class="grid-item ">:</div>
    <div class="grid-item "><?php echo $row['course_code']; ?></div>
  
    <div class="grid-item header">COURSE TITLE</div>
    <div class="grid-item ">:</div>
    <div class="grid-item"><?php echo $row['course_tittle']; ?></div>

    <div class="grid-item header">COURSE TYPE</div>
    <div class="grid-item ">:</div>
    <div class="grid-item"><?php echo $row['course_Type']; ?></div>
   
    <div class="grid-item header">COURSE CREDIT</div>
    <div class="grid-item ">:</div>
    <div class="grid-item"><?php echo $row['course_credit']; ?></div>

    <div class="grid-item header">LEARNING MODALITY</div>
    <div class="grid-item ">:</div>
    <div class="grid-item"><?php echo $row['learning_modality']; ?></div>

    <div class="grid-item header">PRE-REQUISITES</div>
    <div class="grid-item ">:</div>
    <div class="grid-item"><?php echo $row['pre_requisit']; ?></div>

    <div class="grid-item header">CO-REQUISITES</div>
    <div class="grid-item ">:</div>
    <div class="grid-item"><?php echo $row['co_pre_requisit']; ?></div>
 
    <div class="grid-item header">PROFESSOR</div>
    <div class="grid-item ">:</div>
    <div class="grid-item"><?php echo $row['professor']; ?></div>

    <div class="grid-item header">CONSULTATION HOURS</div>
    <div class="grid-item">:</div>
    <div class="grid-item"><?php echo $row['consultation_hours_date']; ?></div>
    <div class="grid-item"><?php echo $row['consultation_hours_room']; ?></div>
    <div class="grid-item"><?php echo $row['consultation_hours_email']; ?></div>
    <div class="grid-item"><?php echo $row['consultation_hours_number']; ?></div>

    <div class="header grid-item mt-4">COURSE DESCRIPTION:</div>
    
</div>

<div class="container course_description">
<?php echo $row['course_description']; ?>

</div>

<div class="container-fluid course_description1 mt-5">
<div class="header">COURSE DESCRIPTION:</div>
<a>By the end of this course, students are expected to: </a>
</div>










    
                

                    </div> 


                    <button type="button" class="btn btn-primary float-left add_databtn" data-toggle="modal" data-target="#studentaddmodal">
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

                        <div class="form-group">
                        <label for="learn_out">Course Learning Outcomes</label>
                        <textarea name="learn_out" id="learn_out" class="form-control" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
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

                            <button type="button" class="btn btn-success editbtn_learning_out"><i class="lni lni-pencil"></i>EDIT</button>

                            <button type="button" class="btn btn-danger deletebtn_learning_out"><i class="lni lni-trash-can">DELETE</i></button>
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
                            <td class=""><?php echo $row['topic_learn_out']; ?></td>
                            <td class="table-button">
                            <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                            <button type="button" class="btn btn-success editbtn_learning_out_table"><i class="lni lni-pencil"></i>EDIT</button>

                            <!-- <button type="button" class="btn btn-danger deletebtn_learning_out_table"><i class="lni lni-trash-can">DELETE</i></button> -->
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



                    <button type="button" class="btn btn-primary float-left add_databtn" data-toggle="modal" data-target="#addmodal_module_learning">
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
                        <textarea name="module_no" id="module_no1" class="form-control" placeholder="Enter Module No and Learning Outcomes" cols="50" rows="5"></textarea>
                    </div>

                        <div class="form-group">
                            <label>Week No</label>
                            <input type="text" name="week" id="week1" class="form-control"
                                placeholder="Enter Week No">
                        </div>

                        <div class="form-group">
                            <label>Week No</label>
                            <input type="text" name="date" id="date1" class="form-control"
                                placeholder="Enter Date">
                        </div>

                        <div class="form-group">
                        <label for="teaching_activities1">Teaching-Learning Activities / Assessment Strategy</label>
                        <textarea name="teaching_activities" id="teaching_activities1" class="form-control" placeholder="Enter Teaching-Learning Activities / Assessment Strategy" cols="50" rows="5"></textarea>
                    </div>


                        
                        
                        <div class="form-group">
                            <label>Technology Enabler</label>
                            <input type="text" name="technology" id="technology1" class="form-control"
                            placeholder="Enter Technology Enabler">
                        </div>
                        
                        <div class="form-group">
                    <label>
                        <input type="radio" name="onsite" value="1" id="onsite1">
                        Onsite / F2F
                    </label><br>
                    <label>
                        <input type="radio" name="asy" value="1" id="asynchronous1">
                        Asynchronous
                    </label>
                </div>
                <label>Alloted Hours</label>
                        <input type="text" name="hours" id="hours1" class="form-control"
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
                        
                    <input type="text" name="update_id3" id="update_id3">

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
                            <label>Week No</label>
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
                        <input type="radio" name="onsite" value="1" id="onsite">
                        Onsite / F2F
                    </label><br>
                    <label>
                        <input type="radio" name="asy" value="1" id="asynchronous">
                        Asynchronous
                    </label>
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
    

    





    <!-- EDIT POP UP FORM TABLE (Bootstrap MODAL)
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

                <form action="Course_Syllabus/update_course_learning_outcome_table.php" method="POST">

                    <div class="modal-body">

                        <input type="text" name="update_id3" id="update_id3">

                        <div class="form-group">
                            <label> Course Learning Outcome </label>
                            <textarea name="module_no" id="module_no" class="form-control" placeholder="Enter Course Learning Outcome" cols="90" rows="5"></textarea>
                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedatatable" class="btn btn-primary">Update Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div> -->

   



    <div class="container mt-5">
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
                        <td><?php echo $row['module_no']; ?></td>
                        <td><?php echo $row['week']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['teaching_activities']; ?></td>
                        <td><?php echo $row['technology']; ?></td>
                        <td><?php echo $row['onsite'] == 1 ? '/' : ''; ?></td>
                        <td><?php echo $row['asy'] == 1 ? '/' : ''; ?></td>

                        <td><?php echo $row['hours']; ?></td>
                        <td class="table-button">
                            <button type="button" class="btn btn-success editbtn_module_learning"><i class="lni lni-pencil"></i>EDIT</button>
                            <button type="button" class="btn btn-danger deletebtn_module_learning"><i class="lni lni-trash-can"></i>DELETE</button>
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
                    <h5 class="modal-title" id="exampleModalLabel5"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/delete_course_module_learning_final_period.php" method="POST">

                    <div class="modal-body">

                        <input type="text" name="delete_id6" id="delete_id6">

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

                        <input type="text" name="update_id5" id="update_id5">

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
<button type="button" class="btn btn-primary float-left add_databtn_final" data-toggle="modal" data-target="#studentaddmodal15">
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
                        <textarea name="final_topic_leaning_out" id="final_topic_leaning_out6" class="form-control" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
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

<a>Learning Outcomes for Final Period</a>

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
        <td class=""><?php echo $row['final_topic_leaning_out']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

        <button type="button" class="btn btn-success editbtn_learning_out_final_period_table"><i class="lni lni-pencil"></i>EDIT</button>

        <button type="button" class="btn btn-danger deletebtn_learning_out_final_period_table"><i class="lni lni-trash-can">DELETE</i></button>
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






<div class="container mt-5">
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
                        <td><?php echo $row['module_no']; ?></td>
                        <td><?php echo $row['week']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['teaching_activities']; ?></td>
                        <td><?php echo $row['technology']; ?></td>
                        <td><?php echo $row['onsite'] == 1 ? '/' : ''; ?></td>
                        <td><?php echo $row['asy'] == 1 ? '/' : ''; ?></td>

                        <td><?php echo $row['hours']; ?></td>
                        <td class="table-button">
                            <button type="button" class="btn btn-success editbtn_module_learning"><i class="lni lni-pencil"></i>EDIT</button>
                            <button type="button" class="btn btn-danger deletebtn_module_learning"><i class="lni lni-trash-can"></i>DELETE</button>
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




















<div class="container float-left mt-5">
        
        </div>
          
         
         
        </div>
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

            $('#update_id').val(data[0]);
            $('#course_code').val(data[1]);
            $('#course_tittle').val(data[2]);

            // Auto check radio for course_Type
            var courseType = data[3];
            $('input[name="course_Type"][value="' + courseType + '"]').prop('checked', true);

            $('#course_credit').val(data[4]);

            // Auto check radio for learning_modality
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

            // Auto check radio for course_Type
            
            $('#date').val(data[3]);
            $('#teaching_activities').val(data[4]);
            $('#technology').val(data[5]);
            var onsite = data[6];
            $('input[name="onsite"][value="' + onsite + '"]').prop('checked', true);

            // Auto check radio for learning_modality
            var asy = data[7];
            $('input[name="asy"][value="' + asy + '"]').prop('checked', true);


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




</body>
</html>