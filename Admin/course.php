<?php include_once 'index.php';

?>

<?php

function populateCetegoryDropdown() {
    // Replace these database connection details with your own
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

    // SQL query to get positions from the database (replace 'your_table_name' with the actual table name)
    $sql = "SELECT * FROM category";
    $result = $conn->query($sql);

    $options = "";

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            $options .= "<option id='catid' value='" . $row["id"] . "'>" . $row["name"] . "</option>";
        }
    } else {
        $options .= "<option value=''>No category found</option>";
    }

    $conn->close();

    return $options;
}




?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


<style>
    .hide-id{
        display: none;
    }
</style>
            


  







<div class="container-fluid">
<h1>Course</h1>


        <!-- Modal module_learning-->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Course </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Admin_Crud/insert_course.php" method="POST">

                    <div class="modal-body">
                        
                    <div class="form-group" id="catid">
                            <label> Category </label>
                            <select name="catid" class="form-control">
                            <?php echo populateCetegoryDropdown(); ?>
                    </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="cname">Course Name</label>
                        <input name="cname" id="cname1" class="form-control" placeholder="Enter Course Name">
                    </div>

                        <div class="form-group">
                            <label>Initial</label>
                            <input type="text" name="initial" id="initial1" class="form-control"
                                placeholder="Enter Course Department Initial">
                        </div>

                        <div class="form-group">
                            <label>Course Department</label>
                            <input type="text" name="course_department" id="course_department1" class="form-control"
                                placeholder="Enter Course Department">
                        </div>
                        
                        <div class="form-group">
                            <label>Department Chair Name</label>
                            <input type="text" name="department_name" id="department_name1" class="form-control"
                                placeholder="Enter Department Chair Name">
                        </div>

                        <div class="form-group">
                            <label>Department Position</label>
                            <input type="text" name="department_position" id="department_position1" value="Chair" class="form-control"
                                placeholder="Enter Department Position">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="dept_signature" id="dept_signature1" value="No Signature" class="form-control"
                                placeholder="Enter Department Position">
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="dean_signature" id="dean_signature1" value="No Signature" class="form-control"
                                placeholder="Enter Department Position">
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



  <!-- EDIT POP UP FORM FOR COURSE TABLE (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1"> Edit Course </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="Admin_Crud/edit_course.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">
                    <div class="form-group">
                        <label> Category </label>
                        <select name="catid" id="edit_catid" class="form-control">
                            <?php
                
                            echo populateCetegoryDropdown(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cname">Course Name</label>
                        <input name="cname" id="edit_cname" class="form-control" placeholder="Enter Course Name">
                    </div>
                    <div class="form-group">
                        <label>Initial</label>
                        <input type="text" name="initial" id="edit_initial" class="form-control" placeholder="Enter Course Department Initial">
                    </div>
                    <div class="form-group">
                        <label>Course Department</label>
                        <input type="text" name="course_department" id="edit_course_department" class="form-control" placeholder="Enter Course Department">
                    </div>

                    <div class="form-group">
                            <label>Department Chair Name</label>
                            <input type="text" name="department_name" id="edit_department_name" class="form-control"
                                placeholder="Enter Department Chair Name">
                        </div>


                    <div class="form-group">
                            <label>Department Chair Name</label>
                            <input type="text" name="department_position" id="edit_department_position" value="Chair" class="form-control"
                                placeholder="Enter Department Chair Name">
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
    

 <!-- DELETE POP UP FORM  FOR LEARNING MODULE(Bootstrap MODAL) -->
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Course </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Admin_Crud/delete_course.php" method="POST">

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


   

<button type="button" class="btn btn-primary add_databtn_final mb-2" data-toggle="modal" data-target="#addmodal">
                        ADD DATA
                    </button>


<?php
 

 // Database connection
 
 
 $connection = mysqli_connect("localhost","root","","syllabus");
 if (mysqli_connect_errno()){
     echo "Failed to connect to MySQL: " . mysqli_connect_error();
     die();
     }



     $query = "SELECT 
     c.id AS course_id, 
     c.catid, 
     c.cname AS course_name, 
     c.initial AS course_initial, 
     c.course_department, 
     c.department_name, 
     c.department_position, 
     c.dept_signature, 
     cat.id AS category_id, 
     cat.name AS category_name, 
     cat.initial AS category_initial 
 FROM 
     course c 
 LEFT JOIN 
     category cat 
 ON 
     c.catid = cat.id 
 ORDER BY 
 category_name  ASC;"; // ASC for ascending order
 $query_run = mysqli_query($connection, $query);
 
?>  



<table id="myTable" class="table table-striped">
    <thead>
        <tr>
            <th class="hide-id">ID</th>
            <th>Category</th>
            <th>Course</th>
            <th>Initial</th>
            <th>Course Department</th>
            <th>Department Chair</th>
            <th>Department Position</th>
            <th>Department Chair Signature</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetching data from the database and displaying it in the table
        while ($row = mysqli_fetch_assoc($query_run)) {
            ?>
            <tr>
            <td class="hide-id"> <?= $row['course_id']; ?> </td>
            <td> <?= $row['category_name']; ?> </td>
            <td> <?= $row['course_name'];  ?> </td>
            <td> <?= $row['course_initial'];  ?> </td>
            <td> <?= $row['course_department'];  ?> </td>
            <td> <?= $row['department_name'];  ?> </td>
            <td> <?= $row['department_position'];  ?> </td>
                    <td>
            <?= isset($row['dept_signature']) && !empty($row['dept_signature']) ? $row['dept_signature'] : 'No signature available'; ?>
        </td>

            <td>
            <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i></button>
            <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i></button>
                </tr>
        
        <?php
        }
        ?>
    </tbody>
</table>

</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>













<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script>
  $('#myTable').DataTable({
    	pageLength : 50

    });
</script>


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
            $('#edit_catid').val(data[1]); // Populate category dropdown with correct category
            $('#edit_cname').val(data[2]);
            $('#edit_initial').val(data[3]);
            $('#edit_course_department').val(data[4]);
            $('#edit_department_name').val(data[5]);
            $('#edit_department_position').val(data[6]);
            
        });
    });
</script>


<script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

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
$("#parentbox").change(function() {
    $category = $("#parentbox").val();
    
    $.ajax({
        url: 'data.php',
        method: 'POST',
        data: {'category': $category},
        success: function(response) {
            $("#childbox").html(response);
        }
    });
});
</script>


</div>