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

</style>
<body>
    <div class="container-fluid">
    <h2>Welcome to Dashboard</h2>
   
<span><p><?php echo $position; ?><a href="logout.php">Logout</a></p></span>















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

                <form action="updatecode_deduction.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group">
                            <label> course_code </label>
                            <input type="text" name="course_code" id="course_code" class="form-control"
                                placeholder="Enter course_code">
                        </div>

                        <div class="form-group">
                            <label> Course Tittle </label>
                            <input type="text" name="course_tittle" id="course_tittle" class="form-control" placeholder="Enter Course Tittle">
                        </div>

                        <div class="form-group">
                            <label>Choose Type:</label><br>
                            <label><input type="radio" name="course_type" id="course_type" value="lecture"> Lecture</label><br>
                            <label><input type="radio" name="course_type" id="course_type" value="lab"> Lab</label>
                        </div>

                        <div class="form-group">
                            <label> Course credit </label>
                            <input type="text" name="course_credit" id="course_credit" class="form-control" placeholder="Enter Course credit">
                        </div>

                        <div class="form-group">
                        <fieldset>
                            <legend>Learning Modality</legend>
                            <div>
                                <input type="radio" id="traditional" name="learning_modality" id="course_credit" value="Traditional">
                                <label for="traditional">Traditional</label>
                            </div>
                            <div>
                                <input type="radio" id="flex_blended" name="learning_modality" id="course_credit" value="Flex Blended">
                                <label for="flex_blended">Flex Blended</label>
                            </div>
                            <div>
                                <input type="radio" id="fully_onsite" name="learning_modality" id="course_credit" value="Fully Onsite">
                                <label for="fully_onsite">Fully Onsite</label>
                            </div>
                        </fieldset>
                    </div>



                        <div class="form-group">
                            <label> pre_requisit </label>
                            <input type="text" name="pre_requisit" id="pre_requisit" class="form-control" placeholder="Enter pre_requisit">
                        </div>

                        <div class="form-group">
                            <label> co_pre_requisit </label>
                            <input type="text" name="co_pre_requisit" id="co_pre_requisit" class="form-control" placeholder="Enter co_pre_requisit">
                        </div>

                        <div class="form-group">
                            <label> professor </label>
                            <input type="text" name="professor" id="professor" class="form-control" placeholder="Enter professor">
                        </div>

                        <div class="form-group">
                            <label for="consultation_hours">Consultation Hours</label>
                            <textarea id="consultation_hours" name="consultation_hours" id="consultation_hours" class="form-control" rows="5" cols="50" style="width: 300px;" placeholder="Enter consultation hours"></textarea>
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
                    <table id="datatableid" class="table table-bordered shadow">
                        <thead>
                            <tr>
                            <th scope="col" style='border: 1px solid white;'>ID</th>
                            <th scope="col" style='border: 1px solid white;'>COURSE CODE</th>
                            <th scope="col" style='border: 1px solid white;'>COURSE TITLE:</th>
                            <th scope="col" style='border: 1px solid white;'>COURSE TYPE:</th>
                            <th scope="col" style='border: 1px solid white;'>COURSE CREDIT:</th>
                            <th scope="col" style='border: 1px solid white;'>LEARNING MODALITY:</th>
                            <th scope="col" style='border: 1px solid white;'>PRE-REQUISITES:</th>
                            <th scope="col" style='border: 1px solid white;'>CO-REQUISITES:</th>
                            <th scope="col" style='border: 1px solid white;'>PROFESSOR:</th>
                            <th scope="col" style='border: 1px solid white;'>CONSULTATION HOURS:</th>
                            <th scope="col" style='border: 1px solid white;'>ACTION</th>
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
                                <td style="border: 1px solid white;"><?php echo $row['course_code']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['course_tittle']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['course_type']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['course_credit']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['learning_modality']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['pre_requisit']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['co_pre_requisit']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['professor']; ?></td>

                            <td style="border: 1px solid white;"><?php echo $row['consultation_hours']; ?></td>
                                <td>
                                <!-- <button type="button" class="btn btn-info viewbtn"><i class="lni lni-eye"></i></button> -->

                                <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i>EDIT</button>

                                <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i>DELETE</button>
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
                $('#course_type').val(data[3]);
                $('#course_credit').val(data[4]);
                $('#learning_modality').val(data[5]);
                $('#pre_requisit').val(data[6]);
                $('#co_pre_requisit').val(data[7]);
                $('#professor').val(data[8]);
                $('#consultation_hours').val(data[9]);
            });
        });
    </script>
</body>
</html>
