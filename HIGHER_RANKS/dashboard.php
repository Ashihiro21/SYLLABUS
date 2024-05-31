<?php include 'nav.php' ?>
   
    <div class="card custom-card" >
    <div class="card-body">

    <div class="pt-5 pb-4">
    <span class="inline-images">
        <a><img src="../img/DLSU-D.png" width="150" alt=""></a>
        <a><img src="../Admin/uploads/<?php echo isset($categories_logo) ? $categories_logo : 'No_signature'; ?>" alt="" width="150" class="img-inline"></a>
    </span>
</div>


    
    <div class="text-center">
    <h4>DE LA SALLE UNIVERSITY-DASMARINAS</h4>
    <h4><?php echo strtoupper($category_name);?> </h4>
    <h4><?php echo strtoupper($course_departments);?> </h4>
    <p class="pb-3"></p>
    <h4>COURSE SYLLABUS</h4>
    </div>
    
    <div class="container-fluid">


    <? 
    
    $position = $_SESSION['position'];

    ?>
    <?php if ($position == 'Department Chair') {
        echo '
        <button type="button" class="btn btn-primary float" data-toggle="modal" data-target="#addmodal">
            Add Course
        </button>';
    } else {
        echo '
        <button type="button" class="btn btn-primary float" data-toggle="modal" data-target="#addmodal" disabled>
            Add Course
        </button>';
    }
    ?>


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
                    <div class="form-group">
    <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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
                        <textarea class="form-control" name="learn_out" id="learn_out" placeholder="Enter Course Learning Outcome" cols="50" rows="5"></textarea>
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


    
 <!-- EDIT POP UP FORM TABLE (Bootstrap MODAL)
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
    </div> -->

  



    <?php
                     
           
                     // Database connection
                     
                     $connection = mysqli_connect("localhost","root","","syllabus");
                         if (mysqli_connect_errno()){
                             echo "Failed to connect to MySQL: " . mysqli_connect_error();
                             die();
                             }
                        $position = $_SESSION['position'];
                         $department = $_SESSION['department'];
                         $catid = $_SESSION['catid'];  
                         $catid = $_SESSION['catid']; 

                         $query = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department='$department' AND catid='$catid'";
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
                              
                              
                               
                                <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
                                    echo '<button type="button" class="btn sysllabus_button btn-success editbtn"><i class="lni lni-pencil"></i></button>';
                                } else{
                                    echo '<button disabled type="button" class="btn sysllabus_button btn-success editbtn"><i class="lni lni-pencil"></i></button>';
                                }

                                ?>
                                

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
            $position = $_SESSION['position'];
            $department = $_SESSION['department'];
            $catid = $_SESSION['catid']; 
            $catid = $_SESSION['catid'];  
            // Prepare SQL query
            $sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus`  WHERE department='$department' AND catid='$catid'";

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
</div> 

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
                        <div style="margin-left:16.5rem; margin-top: 4rem;">
                        <div class="font-weight-bold">COURSE LEARNING OUTCOMES:</div>
                        <p> By the end of this course, students are expected to: </p>
                        </div>
                        </div>
                        
                     
                  <?php $position = $_SESSION['position'];?>
                <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value      
                    echo '<button type="button" class="btn btn-primary add_databtn" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button>';

                }else{
                    echo '<button disabled type="button" class="btn btn-primary add_databtn" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button>';
                }

                ?>

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
                        <textarea name="learn_out" id="learn_out" rows="5" cols="50" class="form-control" placeholder="Course Learning Outcomes"></textarea>

                        <label for="topic_learn_out">Topic Learning Outcomes</label><br>
                        <textarea name="topic_learn_out" id="topic_learn_out" rows="5" cols="50" class="form-control" placeholder="Topic Learning Outcomes"></textarea>
                

                                            <div class="form-group">
                        <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary" >Save Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>



     <!-- Modal -->
 <div class="modal fade" id="studentaddmodal_tlo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Learning Outcome </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/add_tlo.php" method="POST">

                    <div class="modal-body">
                
                    
                        <label for="tloNumber">Course Learning Outcomes</label><br>
                        <textarea name="tloNumber" id="tloNumber" rows="15" cols="50" class="form-control" placeholder="Course Learning Outcomes"></textarea>
                

                                            <div class="form-group">
                        <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                    </div>

                    <div class="form-group">
                        <input type="text" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary" >Save Data</button>
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
                 
                
                         $department = $_SESSION['department'];
                         $catid = $_SESSION['catid']; 
                         $query = "SELECT * FROM course_leaning WHERE department='$department' AND catid='$catid' ORDER BY id ASC";
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
                            <td class=""><?php
                        if (strpos($row['learn_out'], 'CLO') !== false || strpos($row['learn_out'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['learn_out']);
                        } else {
                            echo $row['learn_out'];
                        }
                        ?></td>
                            <td class="hide-id"><?php echo $row['topic_learn_out']; ?></td>
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




                    <div class="container mt-1" style="margin-left:-5rem;">

                    <?php
                    

                    // Database connection
                    
                    
                    $connection = mysqli_connect("localhost","root","","syllabus");
                    if (mysqli_connect_errno()){
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        die();
                        }


                        $department = $_SESSION['department'];
                        $catid = $_SESSION['catid']; 
                        $query = "SELECT * FROM laerning_final WHERE department='$department' AND catid='$catid' ORDER BY id ASC";
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
                            <td class=""><?php
                        if (strpos($row['final_learning_out'], 'CLO') !== false || strpos($row['final_learning_out'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['final_learning_out']);
                        } else {
                            echo $row['final_learning_out'];
                        }
                        ?></td>
                            <td class="hide-id"><?php echo $row['final_topic_leaning_out']; ?></td>
                           
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


                    

<div class="container-fluid header-title"><br>
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


     $department = $_SESSION['department'];
     $catid = $_SESSION['catid']; 
 $query = "SELECT * FROM  course_leaning WHERE department='$department' AND catid='$catid'";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered">
<thead>
    <tr>
        <th colspan="3">Course Learning Outcomes</th>
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
        <td style="border-right:1px solid white;"><?php echo $row['comlab']; ?></td>
        <td style="border-left:1px solid white;border-right:1px solid white; padding-left:0px;padding-right:0px;"><?php echo "."; ?></td>
        <td class=""><?php echo $row['learn_out']; ?></td>
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
       <?php $position = $_SESSION['position']; ?>
        <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
        echo'<button type="button" class="btn btn-success editbtn_learning_out_table"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_learning_out"><i class="lni lni-trash-can"></i></button>';
        }else{
            echo'<button disabled type="button" class="btn btn-success editbtn_learning_out_table"><i class="lni lni-pencil"></i></button>

            <button disabled type="button" class="btn btn-danger deletebtn_learning_out"><i class="lni lni-trash-can"></i></button>';
        }
            ?>           
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



 <!-- EDIT POP UP for Final Period Table (Bootstrap MODAL) -->
 <div class="modal fade" id="editmodal_learn_out_table" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel6"> Topic Learning Outcomes1  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_learning_outcome_table.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id1" id="update_id1">

                        <div class="form-group">
                            <label> Computer Laboratory </label>
                            <input type="text" name="comlab" id="comlab1" class="form-control"
                                placeholder="Enter Computer Laboratory">
                        </div>

                        <div class="form-group">
                        <label for="learn_out">Course Learning Outcome</label>
                        <textarea class="form-control" name="learn_out" id="learn_out1" placeholder="Enter Course Learning Outcome" cols="50" rows="5"></textarea>
                    </div>


                        <div class="form-group">
                        <label>Topic Learning Outcomes</label>
                        <textarea name="topic_learn_out" id="topic_learn_out1" class="form-control" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
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
    $position = $_SESSION['position'];
    ?>

<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<!-- end course table modals  -->
  <button type="button" class="btn btn-primary add_databtn" data-toggle="modal" data-target="#addmodal_module_learning">ADD DATA</button>';

}else{
    echo '
    <!-- end course table modals  -->
      <button disabled type="button" class="btn btn-primary add_databtn" data-toggle="modal" data-target="#addmodal_module_learning">ADD DATA</button>';
}

?>

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
                        <textarea name="module_no" id="module_no1" class="form-control 1" placeholder="Module No and Learning Outcomes" cols="50" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="title1">Title</label>
                        <input type="text" name="title" id="title1" class="form-control"
                                placeholder="Enter Title">
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
                        <textarea name="teaching_activities" id="teaching_activities1" class="form-control 2" placeholder="Enter Teaching-Learning Activities / Assessment Strategy" cols="50" rows="5"></textarea>
                    </div>


                                    <div class="form-group">
                    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                </div>

                <div class="form-group">
                    <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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
                        <label for="title1">Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter Title">
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
                <th style="width:5px; text-align:center"  class="" scope="col">Module No and Learning Outcomes</th>
                <th style="text-align:center;" class="" class="" scope="col">Title</th>
                <th style="text-align:center;" class="" class="" scope="col">Week No</th>
                <th style="padding-left:35px;padding-right:35px; text-align:center;" class="" scope="col">Date</th>
                <th style="text-align: center;" class="" scope="col"><p>Teaching-Learning Activities  / </p>Assessment Strategy</th>
                <th style="width:5px;" class="" scope="col">Technology Enabler</th>
                <th class="text-rotate" scope="col">Onsite / F2F</th>
                <th class="text-rotate" scope="col">Asynchronous</th>
                <th class="text-rotate" scope="col">Alloted Hours</th>
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

            
            $department = $_SESSION['department'];
            $catid = $_SESSION['catid']; 
        
            // Calculate total hours
            $total_hour_query = "SELECT `hours`,`asy`,`onsite`,
            SUM(hours) as total_hours, 
            SUM(asy) as total_asy_hours,
            SUM(onsite) as total_onsite_hours 
        FROM 
            module_learning WHERE department='$department' AND catid='$catid'";
            $total_hour_result = mysqli_query($connection, $total_hour_query);
            $total_hour_row = mysqli_fetch_assoc($total_hour_result);

            $hours = $total_hour_row['hours'];
            $onsite = $total_hour_row['onsite'];
            $asy = $total_hour_row['asy'];
            $total_hour = $total_hour_row['total_hours'];
            $total_asy_hours = $total_hour_row['total_asy_hours'];
            $total_onsite_hours = $total_hour_row['total_onsite_hours'];
            $department = $_SESSION['department'];
            $catid = $_SESSION['catid']; 
            // Fetch module learning records
            $query = "SELECT 
                        `id`, 
                        `module_no`, 
                        `title`, 
                        `week`, 
                        `date`, 
                        `teaching_activities`, 
                        `technology`, 
                        `onsite`, 
                        `asy`, 
                        `hours`
                    FROM 
                        `module_learning` WHERE department='$department' AND catid='$catid'";

            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                                <tr>
                    <td style="text-align: center;" class="hide-id"><?php echo $row['id']; ?></td>
                    <td style="text-align: center;" class=""><?php
                        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
                        } else {
                            echo $row['module_no'];
                        }
                        ?></td>
                        <td style="text-align: center;"><?php echo $row['title']; ?></td>
                    <td style="text-align: center;"><?php echo $row['week']; ?></td>
                    <td style="text-align: center;"><?php echo $row['date']; ?></td>
                    <td style="" class=""><?php
                        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
                        } else {
                            echo $row['teaching_activities'];
                        }
                        ?></td>
                    <td style="text-align: center;"><?php echo $row['technology']; ?></td>
                    <td style="text-align: center;"><?php echo ($row['onsite'] == 1) ? '/' : ''; ?></td>
                    <td style="text-align: center;"><?php echo ($row['asy'] == 1) ? '/' : ''; ?></td>
                    <td style="text-align: center;"><?php echo $row['hours']; ?></td>
                    <td style="text-align: center;" class="table-button">
                    
                    <?php
                    $position = $_SESSION['position'];
                    ?>
                    <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
                    echo '<button type="button" class="btn btn-success editbtn_module_learning"><i class="lni lni-pencil"></i></button>
                        <button type="button" class="btn btn-danger deletebtn_module_learning"><i class="lni lni-trash-can"></i></button>';
                    }else{
                        echo '<button disabled type="button" class="btn btn-success editbtn_module_learning"><i class="lni lni-pencil"></i></button>
                        <button disabled type="button" class="btn btn-danger deletebtn_module_learning"><i class="lni lni-trash-can"></i></button>';
                    }
                ?>
                    </td>
                </tr>

            <?php
                }
            } else {
                echo "No Record Found";
            }
            ?>
            <tr style="background-color:#F4A460;">
                <td style="text-align: center; background-color:#F4A460;" colspan="5"><b>TOTAL</b></td>
                <td style="text-align: center; background-color:#F4A460;"><?php echo (is_numeric($total_onsite_hours) && is_numeric($hours)) ? ($total_onsite_hours * $hours) : 0; ?></td>
                <td style="text-align: center; background-color:#F4A460;"><?php echo (is_numeric($total_asy_hours) && is_numeric($hours)) ? ($total_asy_hours * $hours) : 0; ?></td>
                <td style="text-align: center; background-color:#F4A460;"><?php echo is_numeric($total_hour) ? $total_hour : 0; ?></td>
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
                    <h5 class="modal-title" id="exampleModalLabel6"> Topic Learning Outcomes1  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/update_course_learning_outcome_final_period_table.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id5" id="update_id5">

                        <div class="form-group">
                            <label> Computer Laboratory </label>
                            <textarea type="text" name="comlab" id="comlab_6" class="form-control"
                                placeholder="Enter Computer Laboratory"></textarea>
                        </div>

                        <div class="form-group">
                            <label> Course Learning Outcomes  </label>
                            <textarea type="text" name="final_learning_out" id="final_learning_out" class="form-control"
                                placeholder="Enter Course Learning Outcomes" cols="50" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                        <label>Topic Learning Outcomes</label>
                        <textarea name="final_topic_leaning_out" id="final_topic_leaning_out" class="form-control" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
                    </div>


                        <div class="form-group">
            <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
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
    $position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
  <!--Add Modal Final Period Table -->
<button type="button" class="btn btn-primary add_databtn_final" data-toggle="modal" data-target="#studentaddmodal15">
                        ADD DATA
                    </button>';
}else{
    echo '
    <!--Add Modal Final Period Table -->
  <button disabled type="button" class="btn btn-primary add_databtn_final" data-toggle="modal" data-target="#studentaddmodal15">
                          ADD DATA
                      </button>';
}

?>

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
                            <label> Computer Laboratory </label>
                            <input type="text" name="comlab" id="comlab6" class="form-control"
                                placeholder="Enter Computer Laboratory">
                        </div>

                    <div class="form-group">
                            <label> Course Learning Outcomes  </label>
                            <textarea type="text" name="final_learning_out" id="final_learning_out6" class="form-control"
                                placeholder="Enter Course Learning Outcomes" cols="50" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                        <label>Topic Learning Outcomes</label>
                        <textarea name="final_topic_leaning_out" id="final_topic_leaning_out6" class="form-control 3" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
                    </div>

                    <div class="form-group">
    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
            </div>

            <div class="form-group">
    <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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

<div class="container-fluid mt-5 header-title">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a>Learning Outcomes for Final Period</a>
</div>



<div class="container mt-5">


<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }


     $department = $_SESSION['department'];
     $catid = $_SESSION['catid']; 
 $query = "SELECT * FROM  laerning_final WHERE department='$department' AND catid='$catid'";
 $query_run = mysqli_query($connection, $query);
?>  
<table id="datatableid" class="table table-bordered">
<thead>
    <tr>
        <th colspan="3">Course Learning Outcomes</th>
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
        <td style="border-right:1px solid white;"><?php echo $row['comlab']; ?></td>
        <td style="border-left:1px solid white;border-right:1px solid white; padding-left:0px;padding-right:0px;"><?php echo "."; ?></td>
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
        <?php
        $position = $_SESSION['position'];
        ?>
    <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
                echo '
            <button type="button" class="btn btn-success editbtn_learning_out_final_period_table"><i class="lni lni-pencil"></i></button>

            <button type="button" class="btn btn-danger deletebtn_learning_out_final_period_table"><i class="lni lni-trash-can"></i></button>';
    }else{
        echo '
        <button disabled type="button" class="btn btn-success editbtn_learning_out_final_period_table"><i class="lni lni-pencil"></i></button>

        <button disabled type="button" class="btn btn-danger deletebtn_learning_out_final_period_table"><i class="lni lni-trash-can"></i></button>';
    }
    ?>
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
<?php
$position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary add_databtn_final" data-toggle="modal" data-target="#addmodal_module_learning_final">
                        ADD DATA
                    </button>';
}else{
    echo '
    <button disabled type="button" class="btn btn-primary add_databtn_final" data-toggle="modal" data-target="#addmodal_module_learning_final">
                            ADD DATA
                        </button>';
}
?>

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
                        <textarea name="module_no" id="module_no1" class="form-control 4" placeholder="Enter Module No and Learning Outcomes" cols="50" rows="5"></textarea>
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
                        <textarea name="teaching_activities" id="teaching_activities1" class="form-control 5" placeholder="Enter Teaching-Learning Activities / Assessment Strategy" cols="50" rows="5"></textarea>
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


                            <div class="form-group">
                    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                </div>

                <div class="form-group">
    <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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
            <tr>
                <th style="width:5px; text-align:center"  class="" scope="col">Module No and Learning Outcomes</th>
                <th style="text-align:center;" class="" class="" scope="col">Week No</th>
                <th style="padding-left:35px;padding-right:35px; text-align:center;" class="" scope="col">Date</th>
                <th style="text-align: center;" class="" scope="col"><p>Teaching-Learning Activities  / </p>Assessment Strategy</th>
                <th style="width:5px;" class="" scope="col">Technology Enabler</th>
                <th class="text-rotate" scope="col">Onsite / F2F</th>
                <th class="text-rotate" scope="col">Asynchronous</th>
                <th class="text-rotate" scope="col">Alloted Hours</th>
                <th class="" scope="col">Actions</th>
            </tr>
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
        module_learning_final WHERE department='$department' AND catid='$catid'";
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
                        `module_learning_final` WHERE department='$department' AND catid='$catid'";

            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                      <tr>
                    <td style="text-align: center;" class="hide-id"><?php echo $row['id']; ?></td>
                    <td style="text-align: center;" class=""><?php
                        if (strpos($row['module_no'], 'TLO') !== false || strpos($row['module_no'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['module_no']);
                        } else {
                            echo $row['module_no'];
                        }
                        ?></td>
                    <td style="text-align: center;"><?php echo $row['week']; ?></td>
                    <td style="text-align: center;"><?php echo $row['date']; ?></td>
                    <td style="" class=""><?php
                        if (strpos($row['teaching_activities'], '•') !== false || strpos($row['teaching_activities'], "\n") !== false) {
                            // If 'TLO' or a line break is found, replace it with <br>
                            echo str_replace(array('', "\n"), '<br>', $row['teaching_activities']);
                        } else {
                            echo $row['teaching_activities'];
                        }
                        ?></td>
                    <td style="text-align: center;"><?php echo $row['technology']; ?></td>
                    <td style="text-align: center;"><?php echo ($row['onsite'] == 1) ? '/' : ''; ?></td>
                    <td style="text-align: center;"><?php echo ($row['asy'] == 1) ? '/' : ''; ?></td>
                    <td style="text-align: center;"><?php echo $row['hours']; ?></td>
                    <td style="text-align: center;" class="table-button">
                    <?php
                    $position = $_SESSION['position'];
                    ?>
            <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
                        echo '
                        <button type="button" class="btn btn-success editbtn_module_learning"><i class="lni lni-pencil"></i></button>
                        <button type="button" class="btn btn-danger deletebtn_module_learning"><i class="lni lni-trash-can"></i></button>';
            }else{
                echo '
                <button disabled type="button" class="btn btn-success editbtn_module_learning"><i class="lni lni-pencil"></i></button>
                <button disabled type="button" class="btn btn-danger deletebtn_module_learning"><i class="lni lni-trash-can"></i></button>';
            }
            ?>
                    </td>
                </tr>


            <?php
                }
            } else {
                echo "No Record Found";
            }
            ?>
             <tr style="background-color:#F4A460;">
                <td style="text-align: center; background-color:#F4A460;" colspan="5"><b>TOTAL</b></td>
                <td style="text-align: center; background-color:#F4A460;"><?php echo (is_numeric($total_onsite_hours) && is_numeric($hours)) ? ($total_onsite_hours * $hours) : 0; ?></td>
                <td style="text-align: center; background-color:#F4A460;"><?php echo (is_numeric($total_asy_hours) && is_numeric($hours)) ? ($total_asy_hours * $hours) : 0; ?></td>
                <td style="text-align: center; background-color:#F4A460;"><?php echo is_numeric($total_hour) ? $total_hour : 0; ?></td>
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


                        
                    <div class="form-group">
                        <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                    </div>

                    
            <div class="form-group">
                <input type="text" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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
<div class="card-body ">
<?php
$position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary percent_grading " data-toggle="modal" data-target="#percent_grading" style="margin-left: 18.9rem;">ADD DATA
</button>';

}else{
    echo '
    <button disabled type="button" class="btn btn-primary percent_grading " data-toggle="modal" data-target="#percent_grading" style="margin-left: 18.9rem;">ADD DATA
    </button>';
    
}

?>
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

    
            $total_percent_query = "SELECT SUM(`percents`) AS total_percent FROM percent WHERE department='$department' AND catid='$catid'";
            $total_percent_result = mysqli_query($connection, $total_percent_query);
            $total_percent_row = mysqli_fetch_assoc($total_percent_result);
            
            $total_percent = $total_percent_row['total_percent'];
            
     


            // Fetch module learning records
            $query = "SELECT `id`, `description`, `percents` FROM `percent` 
            WHERE department='$department' AND catid='$catid'";

            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
                    <tr>
                        <td class="hide-id"><?php echo $row['id']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                 
                       

                        <td><?php echo $row['percents']; ?></td>
                        
                        <td class="table-button">
                        <?php
                        $position = $_SESSION['position'];
                        ?>
            <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
                        echo '
                            <button type="button" class="btn btn-success editbtn_percentage"><i class="lni lni-pencil"></i></button>
                            <button type="button" class="btn btn-danger deletebtn_percentage"><i class="lni lni-trash-can"></i></button>';

            }else{
                echo '
                <button disabled type="button" class="btn btn-success editbtn_percentage"><i class="lni lni-pencil"></i></button>
                <button disabled type="button" class="btn btn-danger deletebtn_percentage"><i class="lni lni-trash-can"></i></button>';
                        }

                        ?>
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
<span style="margin-left:4rem;"><b>Overall Final Grade</b><a> = Midterm + Final</a></span>
<a style="margin-left:22rem;">2</a>
<br>
<br>
<br>
<br>
<br>
<br>


</div>
</div>












<div class="card custom-policy">
<div class="card-body">
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
<style>
ul { list-style-type: lower-roman; padding: 0; }
</style>

<?php
// Establishing a connection to your database
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

// Assuming $_SESSION['department'] contains the department value
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  

// Query to fetch data from the database based on the department
$sql = "SELECT * FROM percent WHERE department='$department' AND catid='$catid' ORDER BY id ASC";
$result = $conn->query($sql);

// HTML generation
$html = ''; // Initialize the variable to store HTML content
if ($result->num_rows > 0) {
    $html .= '<ol class="c">'; // Start ordered list
    while ($row = $result->fetch_assoc()) {
        $html .= '<li><span><a>' . $row['description'] . "  " . $row['percents'] . '</a></span></li>';
    }
    $html .= '</ol>'; // End ordered list
}

// Close the database connection
$conn->close();

// Output the generated HTML
echo $html;
?>


</ol>

<b>i. Gradebook.</b>
    <a>Students can see the breakdown of grades in their Assessment tab.</a><br><br>

    </div>

<b>7. Self-Care</b><br><br>

<div class="text-indent">

<b>a. Schedule.</b>
<?php
// Establishing a connection to your database
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

// Assuming $_SESSION['department'] contains the department value
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  

// Query to fetch data from the database based on the department
$sql = "SELECT * FROM semestral WHERE department='$department' AND catid='$catid' ORDER BY id ASC";
$result = $conn->query($sql);

// HTML generation
$html = ''; // Initialize the variable to store HTML content
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<p>a. <b>Schedule. </b>The schedule of self-care week for the ' . $row['second_call'] . ' ' . $row['year'] . ' is on ';
    }
}

// Close the database connection
$conn->close();

// Output the generated HTML
echo $html;
?>
 <?php
// Establishing a connection to your database
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

// Assuming $_SESSION['department'] contains the department value
$department = $_SESSION['department'];
$catid = $_SESSION['catid'];  

// Query to fetch data from the database based on the department
$sql = "SELECT `date` FROM module_learning_final WHERE department = '$department' ORDER BY id ASC LIMIT 1";
$result = $conn->query($sql);

// HTML generation
$html = ''; // Initialize the variable to store HTML content
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= $row['date'] . '. During this week, there shall be no asynchronous/synchronous meetings, F2F classes, new modules, new assessments, and deadlines.</p>';
    }
}

// Close the database connection
$conn->close();

// Output the generated HTML
echo $html;
?>
 During this week, there shall be no asynchronous/synchronous meetings, F2F classes, new modules, new assessments, and deadlines.</a><br>

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
    accessing Schoolbook and Office 365 account other than the students personal account 
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
        </div>
        </div>

<!-- GRADING SYSTEM -->









<!-- END OF GRADING SYSTEM -->



<!-- COURSE POLICIES AND REQUIREMENTS -->



<!-- ONSITE REFFERENCE -->

<!-- ADD ONSITE REFFERENCE -->

<!--Add Modal Final Period Table -->
<div class="card custom-card">
<div class="card-body">
        <?
    $position = $_SESSION['position'];
    ?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary onsite_reffence_tables" data-toggle="modal" data-target="#onsite_reffence_tables" style="margin-left: 8.8rem;">
                        ADD DATA
                    </button>';

}else{
    echo '
    <button disabled type="button" class="btn btn-primary onsite_reffence_tables" data-toggle="modal" data-target="#onsite_reffence_tables" style="margin-left: 8.8rem;">
                            ADD DATA
                        </button>';
}

?>

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
                        <textarea name="Reference_Material" id="Reference_Material6" class="form-control 7" placeholder="Enter Learning Outcome" cols="50" rows="5"></textarea>
                    </div>

                    <div class="form-group">
                <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
            </div>

            
            <div class="form-group">
                <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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


     $department = $_SESSION['department'];
     $catid = $_SESSION['catid']; 

 $query = "SELECT * FROM  onsite_reffence WHERE department='$department' AND catid='$catid'";
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
        <?php
            $position = $_SESSION['position'];

            ?>

            <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
        <button type="button" class="btn btn-success editbtn_onsite_reffence"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_onsite_refference"><i class="lni lni-trash-can"></i></button>';
            }else{
                echo '
                <button disabled type="button" class="btn btn-success editbtn_onsite_reffence"><i class="lni lni-pencil"></i></button>
        
                <button disabled type="button" class="btn btn-danger deletebtn_onsite_refference"><i class="lni lni-trash-can"></i></button>';
            }
            ?>
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
<?php
$position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary online_reffence" data-toggle="modal" data-target="#online_reffence" style="margin-left: 8.8rem;">
                        ADD DATA
                    </button>';
}else{
    echo '
    <button disabled type="button" class="btn btn-primary online_reffence" data-toggle="modal" data-target="#online_reffence" style="margin-left: 8.8rem;">
                            ADD DATA
                        </button>';
}?>



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
                        <textarea name="refference_material" id="refference_material6" class="form-control 8" placeholder="Enter Reference Material" cols="50" rows="5"></textarea>
                    </div>


                    <div class="form-group">
                    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                </div>

                
            <div class="form-group">
                <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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


 $department = $_SESSION['department'];
 $catid = $_SESSION['catid']; 
 $query = "SELECT * FROM  online_refference WHERE department='$department' AND catid='$catid'";
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
        <?php
            $position = $_SESSION['position'];

            ?>

            <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
        <button type="button" class="btn btn-success editbtn_online_refference"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_online_refference"><i class="lni lni-trash-can"></i></button>';
            }{
                echo '
                <button disabled type="button" class="btn btn-success editbtn_online_refference"><i class="lni lni-pencil"></i></button>
        
                <button disabled type="button" class="btn btn-danger deletebtn_online_refference"><i class="lni lni-trash-can"></i></button>';
            }

            ?>
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
<?php
$position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary add_semester float" data-toggle="modal" data-target="#add_semester" style="margin-left: 8.8rem;">
                        ADD DATA
                    </button>';
}else{
    echo '
    <button disabled type="button" class="btn btn-primary add_semester float" data-toggle="modal" data-target="#add_semester" style="margin-left: 8.8rem;">
                            ADD DATA
                        </button>';
}

?>

                    <!-- Modal -->
 <div class="modal fade" id="add_semester" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Online References</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_semester.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
    <label for="term">Term</label>
    <select name="term" id="term1" class="form-control">
        <option value="--select semester--" disabled selected>select semester</option>
        <option value="1<sup>st</sup> Semester">1st Semester</option>
        <option value="2<sup>nd</sup> Semester">2nd Semester</option>
        <option value="Special Term">Special Term</option>
    </select>
</div>

<select style="display:none" name="second_call" id="second_call1" class="form-control">
    <option value=""></option>
</select>


<script>
    document.getElementById('term1').addEventListener('change', function () {
        var term = this.value;
        var secondCallDropdown = document.getElementById('second_call1');
        
        // Clear existing options
        secondCallDropdown.innerHTML = '';
        
        // Depending on the selected term, populate the second call options dynamically
        if (term === '1<sup>st</sup> Semester') {
            // Add options for 1st Semester
            addOptions(secondCallDropdown, [
                { value: 'first semester', text: 'first semester' },
            ]);
        } else if (term === '2<sup>nd</sup> Semester') {
            // Add options for 2nd Semester
            addOptions(secondCallDropdown, [
                { value: 'second semester', text: 'second semester' },
            ]);
        } else if (term === 'Special Term') {
            // Add options for Special Term
            addOptions(secondCallDropdown, [
                { value: 'special term', text: 'special term' },
            ]);
        }
    });

    // Function to add options to a dropdown
    function addOptions(selectElement, options) {
        options.forEach(function (option) {
            var optionElement = document.createElement('option');
            optionElement.value = option.value;
            optionElement.textContent = option.text;
            selectElement.appendChild(optionElement);
        });
    }
</script>

                    





                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="year" id="year1" class="form-control"
                                placeholder="Enter Year">
                        </div>


                    <div class="form-group">
                    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                    </div>

                                
                    <div class="form-group">
                        <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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
                            <option value="--select semester--" disabled selected>select semester</option>
                            <option value="1<sup>st</sup> Semester">1st Semester</option>
                            <option value="2<sup>nd</sup> Semester">2nd Semester</option>
                            <option value="Special Term">Special Term</option>
                        </select>
                    </div>

                    <select style="display:none" name="second_call" id="second_call" class="form-control">
                        <option value=""></option>
                    </select>


<script>
    document.getElementById('term').addEventListener('change', function () {
        var term = this.value;
        var secondCallDropdown = document.getElementById('second_call');
        
        // Clear existing options
        secondCallDropdown.innerHTML = '';
        
        // Depending on the selected term, populate the second call options dynamically
        if (term === '1<sup>st</sup> Semester') {
            // Add options for 1st Semester
            addOptions(secondCallDropdown, [
                { value: 'first semester', text: 'first semester' },
            ]);
        } else if (term === '2<sup>nd</sup> Semester') {
            // Add options for 2nd Semester
            addOptions(secondCallDropdown, [
                { value: 'second semester', text: 'second semester' },
            ]);
        } else if (term === 'Special Term') {
            // Add options for Special Term
            addOptions(secondCallDropdown, [
                { value: 'special term', text: 'special term' },
            ]);
        }
    });

    // Function to add options to a dropdown
    function addOptions(selectElement, options) {
        options.forEach(function (option) {
            var optionElement = document.createElement('option');
            optionElement.value = option.value;
            optionElement.textContent = option.text;
            selectElement.appendChild(optionElement);
        });
    }
</script>

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


    
</div>




<!-- SEMESTRAL -->
<div class="container-box mt-5 header-title mb-5">
<div style="margin-right:60rem;">
<span ><b style="white-space: nowrap;">Prepared:</b><b><a class="course" style="white-space: nowrap;">  <?php echo ($course_departments); ?></a></b></span>

<!-- SEMESTRAL -->
<?php
// Database connection
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

$department = $_SESSION['department'];
$catid = $_SESSION['catid']; 

$query = "SELECT * FROM semestral WHERE department='$department' AND catid='$catid'";
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
    <tbody>
        <?php
        if ($query_run) {
            while ($row = mysqli_fetch_assoc($query_run)) {
                $id = $row['id'];
                $term = $row['term'];
                $year = $row['year'];
        ?>
                <tr>
                    <td class="hide-id"> <?php echo $id; ?> </td>
                    <td class="hide-id"><?php echo $term; ?></td>
                    <td class="hide-id"><?php echo $year; ?></td>
                    
                <a class="term_year"><?php echo $term . ' ' . $year; ?></a><br><br>
                    <td class="table-button">
                    <?php
                    $position = $_SESSION['position'];
                    ?>
                <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
                            echo '
                        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->
                        <button type="button" class="btn btn-success editbtn_semestral sysllabus_button m-3"><i class="lni lni-pencil"></i></button><a>EDIT SEMESTER</a>';

                }{
                    echo '
                    <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->
                    <button disabled type="button" class="btn btn-success editbtn_semestral sysllabus_button m-3"><i class="lni lni-pencil"></i></button><a>EDIT SEMESTER</a>';
                }

                ?>
                        <!-- <button type="button" class="btn btn-danger deletebtn_online_refference"><i class="lni lni-trash-can"></i></button> -->
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='3'>No Record Found</td></tr>";
        }
        ?>
    </tbody>
</table>













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


<!-- EDIT POP UP FORM (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_status_commitee" tabindex="-1" role="dialog" aria-labelledby="edit_status_commitee" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_status_commitee">EDIT APPROVAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edit_status_commitee_form" action="Course_Syllabus/update_signature_commitee.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="update_id45" id="update_id45">
                    <div class="form-group">
                        <label for="commitee_signature">Committee Approval</label>
                        <select name="commitee_signature" id="commitee_signature" class="form-control">
                            <option value="" disabled>Select Status</option>
                            <!-- Add available options here -->
                            <option value="Approve">Approve</option>
                            <option value="Disapprove">Disapprove</option>
                            <option value="Pending">Pending</option>
                            <!-- You can add more options as needed -->
                        </select>
                    </div>
                    <label>Commitee Comments</label>
                        <textarea name="commitee_comment" id="commitee_comment6" class="form-control 7" placeholder="Enter Commitee Comments" cols="50" rows="5"></textarea>
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
                 co.`dean_signature` AS `dean_signatures`,
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
        <?php
        $position = $_SESSION['position'];
        ?>
        <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
        <button type="button" class="btn btn-success editbtn_signature m-3"><i class="lni lni-pencil"></i></button><a>UPLOAD SIGNATURE</a>';
        }else{
            echo '
            <button disabled type="button" class="btn btn-success editbtn_signature m-3"><i class="lni lni-pencil"></i></button><a>UPLOAD SIGNATURE</a>';
        }
        ?>
    
        </td>
    </tr>



</tbody>
<?php           
}
}
?>
</table>








<span>
    <b>
        <a class="initial">
            <img src="<?php echo isset($dept_head_signature) ? $dept_head_signature : "No_signature"; ?>" alt="Please Upload Signature" width="100px">
        </a>
    </b>
</span>




<span><b>Approved:</b><b><a class="dept_name"><?php echo $dept_head;
 ?></a></b></span>
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
                 co.`dean_signature` AS `dean_signatures`,
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
        <td class="hide-id"> <?php echo $rows['course_id']; ?> </td>
        <td class="hide-id"><?php echo $table_rows['dean_signatures']; ?></td>
        <td class="table-button">
        <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->
        <?php
        $position = $_SESSION['position'];
        ?>
        <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
        <button type="button" class="btn btn-success editbtn_signature_dean m-3"><i class="lni lni-pencil"></i></button><a>UPLOAD SIGNATURE</a>';
        
        }else{
            echo '
            <button disabled type="button" class="btn btn-success editbtn_signature_dean m-3"><i class="lni lni-pencil"></i></button><a>UPLOAD SIGNATURE</a>';
        }
        
        
        
        ?>

    
        </td>
    </tr>



</tbody>
<?php           
}
}
?>
</table>













<!-- FOR REVISED -->
<span  style="white-space: nowrap;"><b></b><b><a class="initial"><img src="<?php echo $deans_category_signature; ?>" alt="Department Head Signature" width="100px"></a></b></span><br>
<span><b>Endorsed:</b><b><a class="dept_name"><?php echo $category_dean; ?></a></b></span>
<span><a class="initial"><?php echo $category_dean_position ." , ". $category_initial; ?></a></span>


</div>
</div>
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
    <span class="inline-images">
        <a><img src="../img/DLSU-D.png" width="150" alt=""></a>
        <a><img src="../Admin/uploads/<?php echo isset($categories_logo) ? $categories_logo : 'No_signature'; ?>" alt="" width="150" class="img-inline"></a>
    </span>
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
                     
                         $department = $_SESSION['department'];
                         $catid = $_SESSION['catid'];  

                         $query = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department='$department' AND catid='$catid'";
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
                                <?php $position = $_SESSION['position'];?>
                              <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
                                    echo '<button type="button" class="btn sysllabus_button btn-success editbtn"><i class="lni lni-pencil"></i></button>';
                                } else{
                                    echo '<button disabled type="button" class="btn sysllabus_button btn-success editbtn"><i class="lni lni-pencil"></i></button>';
                                }

                                ?>
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
            $catid = $_SESSION['catid'];  
            // Prepare SQL query
            $sql = "SELECT `id`, `course_code`, `course_tittle`, `course_Type`, `course_credit`, `learning_modality`, `pre_requisit`, `co_pre_requisit`, `professor`, `consultation_hours_date`, `consultation_hours_room`, `consultation_hours_email`, `consultation_hours_number`, `course_description`, `email`, `department` FROM `course_syllabus` WHERE department='$department' AND catid='$catid'";

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

    
</div>


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
<?php
$position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary add_databtn_mapping_table" data-toggle="modal" data-target="#mapping_table">
                        ADD DATA
                    </button>';
}else{
    echo '
    <button disabled type="button" class="btn btn-primary add_databtn_mapping_table" data-toggle="modal" data-target="#mapping_table">
                            ADD DATA
                        </button>';
}

?>

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

                        <textarea type="text" name="learn_out_mapping" col="40" cols="50" rows="5" id="learn_out_mappings" class="form-control 9"
                                placeholder="Enter Computer Laborator"></textarea>
                        

                        </div>

                                            <div class="form-group">
                        <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                    </div>

                    
                    <div class="form-group">
                        <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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


     $department = $_SESSION['department'];
     $catid = $_SESSION['catid']; 
    $query = "SELECT * FROM  mapping_table WHERE department='$department' AND catid='$catid'";
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
           
            <?php
            $position = $_SESSION['position'];

            ?>

            <?php if ($position == 'Dean')  { // Change 'curriculum committee' to the appropriate value
            echo '

            <button type="button" class="btn btn-success editbtn_mapping_tablepls"><i class="lni lni-pencil"></i></button>

            <button type="button" class="btn btn-danger deletebtn_mapping_tablepls"><i class="lni lni-trash-can"></i></button>';
            }else{
                echo '

            <button disabled type="button" class="btn btn-success editbtn_mapping_tablepls"><i class="lni lni-pencil"></i></button>

            <button disabled type="button" class="btn btn-danger deletebtn_mapping_tablepls"><i class="lni lni-trash-can"></i></button>';
            }

            ?>
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
    <span class="inline-images">
        <a><img src="../img/DLSU-D.png" width="150" alt=""></a>
        <a><img src="../Admin/uploads/<?php echo isset($categories_logo) ? $categories_logo : 'No_signature'; ?>" alt="" width="150" class="img-inline"></a>
    </span>
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
<?php
$position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary add_databtn_decriptors" data-toggle="modal" data-target="#decriptors">
                        ADD DATA
                    </button>';
}else{
    echo '
    <button disabled type="button" class="btn btn-primary add_databtn_decriptors" data-toggle="modal" data-target="#decriptors">
                            ADD DATA
                        </button>';
}
?>

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
                        <textarea type="text" name="program_learn" col="40" cols="50" rows="5" class="form-control 10"
                                placeholder="Enter Computer Laborator"></textarea>
                        

                        </div>

                                            <div class="form-group">
                        <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                    </div>


                    
            <div class="form-group">
                <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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



     $department = $_SESSION['department'];
     $catid = $_SESSION['catid']; 
 $query = "SELECT * FROM decriptors WHERE department='$department' AND catid='$catid'";
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
        <?php
        $position = $_SESSION['position'];
        ?>
        <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
        <button type="button" class="btn btn-success editbtn_decriptors"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_decriptors"><i class="lni lni-trash-can"></i></button>';
        }else{
            echo '
            <button disabled type="button" class="btn btn-success editbtn_decriptors"><i class="lni lni-pencil"></i></button>
    
            <button disabled type="button" class="btn btn-danger deletebtn_decriptors"><i class="lni lni-trash-can"></i></button>';
        }

        ?>
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
    <span class="inline-images">
        <a><img src="../img/DLSU-D.png" width="150" alt=""></a>
        <a><img src="../Admin/uploads/<?php echo isset($categories_logo) ? $categories_logo : 'No_signature'; ?>" alt="" width="150" class="img-inline"></a>
    </span>
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
<?php
$position = $_SESSION['position'];
?>
<?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
<button type="button" class="btn btn-primary graduate_attribute" data-toggle="modal" data-target="#graduate_attribute">
                        ADD DATA
                    </button>';

}else{
    echo '
<button disabled type="button" class="btn btn-primary graduate_attribute" data-toggle="modal" data-target="#graduate_attribute">
                        ADD DATA
                    </button>';
}

?>

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
                        <textarea name="descriptors_learn_out" id="descriptors_learn_out6" class="form-control 11" placeholder="Enter Descriptors (Institutional Learning Outcome)" cols="50" rows="5"></textarea>
                    </div>

                                    <div class="form-group">
                    <input type="hidden" id="department" name="department" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['department']) ? $_SESSION['department'] : ''; ?>">
                </div>

                
                <div class="form-group">
                    <input type="hidden" id="catid" name="catid" class="form-control" style="width: 450px;" placeholder="Enter Course Description" value="<?php echo isset($_SESSION['catid']) ? $_SESSION['catid'] : ''; ?>">
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


     $department = $_SESSION['department'];
     $catid = $_SESSION['catid']; 
 $query = "SELECT * FROM  graduates_attributes 
 WHERE department='$department' AND catid='$catid'";
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
        <?php
        $position = $_SESSION['position'];
        ?>
        <?php if ($position == 'Department Chair')  { // Change 'curriculum committee' to the appropriate value
            echo '
        <button type="button" class="btn btn-success editbtn_graduate_attributes"><i class="lni lni-pencil"></i></button>

        <button type="button" class="btn btn-danger deletebtn_graduate_attributes"><i class="lni lni-trash-can"></i></button>';
        }else{
            echo '
            <button disabled type="button" class="btn btn-success editbtn_graduate_attributes"><i class="lni lni-pencil"></i></button>
    
            <button disabled type="button" class="btn btn-danger deletebtn_graduate_attributes"><i class="lni lni-trash-can"></i></button>';
        }
        ?>
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





<?php
// Start the session

// Database connection
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

$email = $_SESSION['email'];
$position = $_SESSION['position']; // Get the position from the session

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
             co.`dean_signature` AS `dean_signatures`,
             co.`cname`,
             co.`course_department` AS `course_departments`,
             co.`id` AS `course_id`,
             co.`initial` AS `course_initial`,
             co.`department_name` AS `course_dept_name`,
             co.`department_position` AS `dept_position`,
             co.`dept_signature` AS `dept_signatures`,
             co.`commitee_signature` AS `commitee_signatures`,
             co.`commitee_comment` AS `commitee_comments`
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
        <!-- Add your table headers here -->
    </tr>
</thead>
<?php
if ($query_run2) {
    foreach ($query_run2 as $table_rows) {
?>
<tbody>
    <tr>
        <td class="hide-id"> <?php echo $table_rows['course_id']; ?> </td>
        <td class="hide-id"><?php echo $table_rows['commitee_signatures']; ?></td>
        <td class="hide-id"><?php echo $table_rows['commitee_comments']; ?></td>
        <td class="table-button">
        <?php if ($position == 'Curriculum Committee')  { // Change 'curriculum committee' to the appropriate value
            echo '<button type="button" class="btn btn-success editbtn_signature_committee m-3"><i class="lni lni-pencil"></i></button><a>APPROVAL</a>';
        } else {
            echo '<button type="button" class="btn btn-success editbtn_signature_committee m-3" disabled><i class="lni lni-pencil"></i></button><a>APPROVAL</a>';
        }
        ?>
        </td>
    </tr>
</tbody>
<?php
    }
}
?>
</table>














<!-- FOR REVISED -->
<span  style="white-space: nowrap;"><b></b><b><a class="initial_1"><?php echo $commitee_dept_signature; ?></a></b></span><br>
<span  style="white-space: nowrap;"><b></b><b><a class="initial_1"><?php echo $commitee_commnet; ?></a></b></span><br>

<p>__________________________________</p>

<div class="container mt-5 font-italic">



<a>Approved in </a><?php echo date("F") ." ".date("Y"); ?>  <a>during a multi-sectoral committee specifically convened for the purpose of coming up with 
descriptions for the graduate attributes.</a>
</div>



                 
               
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script src="script1.js"></script>


    

   


</body>
</html>
