<?php include_once 'index.php';?>

<?php

// Database connection
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

$sql = "SELECT * FROM position";
$result = mysqli_query($conn, $sql);
$positions = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>








<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


<style>
    .hide-id{
        display: none;
    }
</style>
            


  







<div class="container-fluid">
<h1>Category</h1>


        <!-- Modal module_learning-->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Admin_Crud/insert_category.php" method="POST">

                    <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input name="name" id="name1" class="form-control" placeholder="Enter Category Name">
                    </div>

                        <div class="form-group">
                            <label>Initial</label>
                            <input type="text" name="initial" id="initial1" class="form-control"
                                placeholder="Enter Initial">
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
 <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1"> Category  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Admin_Crud/edit_users.php" method="POST">

                    <div class="modal-body">
                        
                    <input type="text" name="update_id" id="update_id">

                   
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input name="first_name" id="first_name" class="form-control" placeholder="Enter First Name">
                    </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control"
                                placeholder="Enter last_name">
                        </div>
                        

        <div class="form-group">

                                        <?php
                // Database connection
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "syllabus";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT id, name FROM category";
                $result = $conn->query($sql);

                // Generate the category dropdown
                $categoryDropdown = '<select name="department" id="categorySelect" class="form-control">';
                // Add a default "Select Category" option
                $categoryDropdown .= '<option value="">Select Category</option>';

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Check if this is the first iteration, then set it as selected
                        $selected = ($row['id'] == 1) ? 'selected' : '';
                        $categoryDropdown .= '<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].'</option>';
                    }

                    $categoryDropdown .= '</select>';
                    echo $categoryDropdown;
                } else {
                    echo 'Invalid request!';
                }

                $conn->close();
                ?>
</div>
                    <!-- course dropdown will be loaded dynamically -->
                    
             
                 
                    <div id="courseDropdown"></div>
                


    <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control"
                                placeholder="Enter contact">
                        </div>
   
   
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Enter email">
                        </div>


                        <!-- Dropdown for Position -->
    <div class="form-group">
    <div class="dropdown">
        <select id="position" class="custom-select fadeIn sixth" name="position" required>
            <option value="" selected disabled>Select Position</option>
            <?php foreach ($positions as $position) { ?>
                <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
            <?php } ?>
        </select>
    </div>
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
    

 <!-- DELETE POP UP FORM FOR LEARNING MODULE (Bootstrap MODAL) -->
 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Admin_Crud/delete_users.php" method="POST">
                    <div class="modal-body">
                        <input type="text" name="delete_id" id="delete_id">
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



   

<!-- <button type="button" class="btn btn-primary add_databtn_final mb-2" data-toggle="modal" data-target="#addmodal">
                        ADD DATA
                    </button> -->


                    <?php
    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "syllabus");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die();
    }

    $query = "SELECT 
                u.`id`  AS `user_id`, 
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
                co.`dept_signature` AS `dept_signatures`,
                pos.`id` AS `position_id`,  /* Added position id */
                pos.`name` AS `position_name`  /* Added position name */
            FROM 
                `users` AS u 
            LEFT JOIN 
                `position` AS p ON u.`position` = p.`id`
            LEFT JOIN 
                `category` AS c ON u.`department` = c.`id`
            LEFT JOIN
                `course` AS co ON u.`catid` = co.`id`
            LEFT JOIN
                `position` AS pos ON u.`position` = pos.`id`";  /* Added position table */
    $query_run = mysqli_query($connection, $query);

    ?>



<table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th class="hide-id">ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Department</th>
                <th>Course</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Position</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetching data from the database and displaying it in the table
            while ($row = mysqli_fetch_assoc($query_run)) {
                ?>
                <tr>
                    <td class="hide-id"> <?= $row['user_id']; ?> </td>
                    <td> <?= $row['first_name']; ?> </td>
                    <td> <?= $row['last_name'];  ?> </td>
                    <td> <?= $row['category_name'];  ?> </td>
                    <td> <?= $row['cname'];  ?> </td>
                    <td> <?= $row['phone_number'];  ?> </td>
                    <td> <?= $row['email'];  ?> </td>
                    <td> <?= $row['position_name'];  ?> </td>
                    <td>
                        <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i></button>
                        <button type="button" class="btn btn-danger deletebtn"><i class="lni lni-trash-can"></i></button>
                    </td>
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
$(document).ready(function() {
    $('#myTable').DataTable({
    	pageLength : 10

    });
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

            $('#update_id').val(data[0]); // User ID
            $('#first_name').val(data[1]); // First Name
            $('#last_name').val(data[2]); // Last Name
            $('#department').val(data[3]); // Category ID
            $('#catid').val(data[4]); // Category ID
            $('#phone_number').val(data[5]); // Contact
            $('#email').val(data[6]); // Email
            $('#position').val(data[7]); // Email
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
$(document).ready(function(){

    $('#categorySelect').on('change', function(){
        var categoryId = $(this).val();
        $.ajax({
            url: 'data.php',
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



</div>