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
    h2{
        text-align: center;
    }
    p {
    margin-right: 1rem;
    text-align: right;
    margin-bottom: 1rem; /* Add space between paragraphs */
}
body{
    background:white;
}
.hide-id {
        display: none;
    }
    tbody,tr,th,
    tbody td {
        border: 1px solid gray;
    }

    .space{
        margin-left: 2rem;
        margin-right: 2rem;
    }

</style>
<body>
    <div class="container">
    <h2>Welcome to Dashboard</h2>
   
<span><p><?php echo $position; ?><a href="logout.php">Logout</a></p></span>















     <!-- Modal -->
     <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Course_Syllabus/insert_course_syllabus.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Course Code </label>
                            <input type="text" name="course_code" class="form-control" placeholder="Enter Course Code">
                        </div>

                        <div class="form-group">
                            <label> Course Tittle </label>
                            <input type="text" name="course_tittle" class="form-control" placeholder="Enter Course Tittle">
                        </div>

                        <div class="form-group">
                            <label>Choose Type:</label><br>
                            <label><input type="radio" name="course_type" value="lecture"> Lecture</label><br>
                            <label><input type="radio" name="course_type" value="lab"> Lab</label>
                        </div>

                        <div class="form-group">
                            <label> Course credit </label>
                            <input type="text" name="course_credit" class="form-control" placeholder="Enter Course credit">
                        </div>

                        <div class="form-group">
                        <fieldset>
                            <legend>Learning Modality</legend>
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
                            <label> pre_requisit </label>
                            <input type="text" name="pre_requisit" class="form-control" placeholder="Enter pre_requisit">
                        </div>

                        <div class="form-group">
                            <label> co_pre_requisit </label>
                            <input type="text" name="co_pre_requisit" class="form-control" placeholder="Enter co_pre_requisit">
                        </div>

                        <div class="form-group">
                            <label> professor </label>
                            <input type="text" name="professor" class="form-control" placeholder="Enter professor">
                        </div>

                        <div class="form-group">
                            <label for="consultation_hours">Consultation Hours</label>
                            <textarea id="consultation_hours" name="consultation_hours" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation hours"></textarea>
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


    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#studentaddmodal">
                        ADD DATA
                    </button>




                    <?php
                     
           
                     // Database connection
                     
                           include('../Database/connection.php');
                         if (mysqli_connect_errno()){
                             echo "Failed to connect to MySQL: " . mysqli_connect_error();
                             die();
                             }
                 

                         $query = "SELECT * FROM course_syllabus";
                         $query_run = mysqli_query($conn, $query);
            ?>  
                    <table id="datatableid" class="table" style='border: 1px solid white;'>
                        <thead>
                        </thead>
                        <?php
                if($query_run)
                {
                    foreach($query_run as $row)
                    {
            ?>
    
                        <tbody style='border: 1px solid white;'>
                             
                                <td class="hide-id"> <?php echo $row['id']; ?> </td>
                            <tr style='border: 1px solid white;'><th style='border: 1px solid white;'>COURSE CODE</th><td style="border: 1px solid white;"><a class="space">:</a></a><?php echo $row['course_code']; ?> </td></tr>
                            <tr style='border: 1px solid white;'><th style='border: 1px solid white;'>COURSE TITLE:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['course_tittle']; ?> </td></tr>
                            <tr style='border: 1px solid white;'><th style='border: 1px solid white;'>COURSE TYPE:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['course_type']; ?> </td></tr>
                            <tr style='border: 1px solid white;'> <th style='border: 1px solid white;'>COURSE CREDIT:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['course_credit']; ?> </td></tr>
                            <tr style='border: 1px solid white;'> <th style='border: 1px solid white;'>LEARNING MODALITY:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['learning_modality']; ?> </td></tr>
                            <tr style='border: 1px solid white;'> <th style='border: 1px solid white;'>PRE-REQUISITES:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['pre_requisit']; ?> </td></tr>
                            <tr style='border: 1px solid white;'> <th style='border: 1px solid white;'>CO-REQUISITES:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['co_pre_requisit']; ?> </td></tr>
                            <tr style='border: 1px solid white;'> <th style='border: 1px solid white;'>PROFESSOR:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['professor']; ?> </td></tr>
                            <tr style='border: 1px solid white;'> <th style='border: 1px solid white;'>CONSULTATION HOURS:</th><td style="border: 1px solid white;"><a class="space">: </a><?php echo $row['consultation_hours']; ?> </td></tr>
                               
                                
                               
                               
                               
                               
                               
                               <tr style='border: 1px solid white;'>   <td style='border: 1px solid white;'>

                            <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i>EDIT</button>

                            <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i>DELETE</button>
</td></tr>
                             

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

    
</body>
</html>
