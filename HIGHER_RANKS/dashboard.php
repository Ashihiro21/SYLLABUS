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
</head>
<style>
    body{
        font-family: "Times New Roman", Times, serif;
        font-size: 18px;
    }
    h2{
        text-align: center;
    }
    p {
    margin-right: 1rem;
    text-align: right;
    margin-bottom: 1rem; /* Add space between paragraphs */
}

.hide-id {
        display: none;
    }

    .container {
    display: grid;
    grid-template-columns: repeat(3, auto); /* Two columns */
    grid-auto-rows: min-content; /* Automatically adjust row height based on content */
    gap: 10px; /* Gap between grid items */
    justify-content: center; /* Center content horizontally */
    align-items: center; /* Center content vertically */
}

.grid-item {
    padding: 5px;
    
    word-wrap: break-word; /* Allow text to wrap */
    text-align: left; /* Center text horizontally */
}

.header {
    font-weight: bold; /* Bold font for headers */
}
.course_description{
    /* margin-left: 20.5rem; */
    word-wrap: break-word;
    padding-left: 6rem;
}
.course_description1{
    /* margin-left: 20.5rem; */
    word-wrap: break-word;
    padding-left: 19.7rem;
}
.consultation_hours{
    /* padding-right: 9rem; */
    /* border: 1px solid black; */
}
.add_databtn{
    margin-left: 15px;
}


</style>
<body>
    <div class="container-fluid">
    <h2>Welcome to Dashboard</h2>
   
<span><p><?php echo $position; ?><a href="logout.php">Logout</a></p></span>


 <!-- Modal -->
 <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="insertcode_deduction.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                            <label> Computer Laboratory </label>
                            <input type="text" name="comlab" id="comlab" class="form-control"
                                placeholder="Enter Computer Laborator">
                        </div>

                        <div class="form-group">
                            <label> Course Learning Outcomes  </label>
                            <input type="text" name="learn_out" id="learing Outcome" class="form-control"
                                placeholder="Enter Learning Outcome">
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
                            <label for="consultation_hours">Consultation Hours</label>
                            <textarea id="consultation_hours" name="consultation_hours" id="consultation_hours" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation hours"></textarea>
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

                            <td class="hide-id" style="border: 1px solid white;"><?php echo $row['consultation_hours']; ?></td>
                            
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
    <div class="grid-item ">:</div>
    <div class="grid-item consultation_hours"><?php echo $row['consultation_hours']; ?></div>
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
                <table id="datatableid" class="table table-bordered shadow">
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
                            <td> <?php echo $row['comlab']; ?> </td>
                            <td> <?php echo $row['learn_out']; ?> </td>
                            <td>
                            <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                            <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i>EDIT</button>

                            <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can">DELETE</i></button>
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
            $('#consultation_hours').val(data[9]);
            $('#course_description').val(data[10]);
        });
    });
</script>

</body>
</html>
