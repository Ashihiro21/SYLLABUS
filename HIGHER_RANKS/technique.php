<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/41.2.1/ckeditor.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="nav.css">
    <title>Document</title>
</head>
<style>
    .hide-id{
        display: none;
    }

    .editor{
        text-align: left;
    }
</style>
<body>
    

<div class="editor"></div>
    
<!-- EDIT POP UP FORM LEARNING MODULE TABLE (Bootstrap MODAL) -->
<div class="modal fade" id="editmodal_module_learning" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog" role="document" >
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
                    <div name="module_no" id="module_no" class="editor"></div>
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
                        <input type="checkbox" name="onsite" value="1" id="onsite">
                        Onsite / F2F
                    </label><br>
                    <label>
                        <input type="checkbox" name="asy" value="1" id="asynchronous">
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
                        <td><?php echo $row['onsite']; ?></td>
                        <td><?php echo $row['asy']; ?></td>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>


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

            // Auto check checkbox for course_Type
            
            $('#date').val(data[3]);
            $('#teaching_activities').val(data[4]);
            $('#technology').val(data[5]);
            var onsite = data[6];
            $('input[name="onsite"][value="' + onsite + '"]').prop('checked', true).removeAttr('readonly');

            // Auto check checkbox for learning_modality
            var asy = data[7]; // Check if the data contains '/'
            $('input[name="asy"][value="' + asy + '"]').prop('checked', true).removeAttr('readonly');


        });
    });

</script>


<script>
                        ClassicEditor
                                .create( document.querySelector( '.editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
                </script>


</body>
</html>

