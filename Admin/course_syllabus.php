<?php include_once 'index.php';

?>





    <!-- EDIT POP UP FORM LEARNING MODULE TABLE (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="Admin_Crud/edit_course_policies.php" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="update_id" id="update_id">

                    <div class="form-group">
                        <label for="description">COURSE POLICIES</label>
                        <textarea name="description" id="description" cols="10"  rows="30" class="form-control" placeholder="Enter Course Policies"></textarea>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="Admin_Crud/delete_course_policies.php" method="POST">

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






<div class="card custom-policy">
<div class="card-body">
<div class="mt-5 text-wrap container-fluid">
<a><b>COURSE POLICIES AND REQUIREMENTS </b></a><br><br><br>


<?php
                     
           
                     // Database connection
                     
                     
                     $connection = mysqli_connect("localhost","root","","syllabus");
                     if (mysqli_connect_errno()){
                         echo "Failed to connect to MySQL: " . mysqli_connect_error();
                         die();
                         }
                 
                         $query = "SELECT * FROM course_policies";
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
    <td class="hide-id" style="display:none;"> <?php echo $row['id']; ?> </td>
    <td class="">
    <?php
$description = $row['description'];

// Replace 'CLO' and newline characters with <br>
if (strpos($description, 'CLO') !== false || strpos($description, "\n") !== false) {
    $description = str_replace(array('CLO', "\n"), '<br>', $description);
}

function indentText($text) {    
    $lines = explode('<br>', $text); // Split the text by <br> tags
    foreach ($lines as &$line) {
        if (preg_match('/^\s*\d+\./', $line)) {
            // Add indentation if the line starts with a numeral followed by a period
            $line = '<div class="course_policies" style="padding-left: 10px;">' . $line . '</div>';
        } elseif (preg_match('/^\s*[a-z]+\./', $line) && !preg_match('/^\s*(i|ii|iii|iv|v|vi|vii|viii|ix|x)\./', $line)) {
            // Add indentation if the line starts with a lowercase letter followed by a period
            // and does not start with a lowercase Roman numeral followed by a period
            $line = '<div class="course_policies" style="padding-left: 60px;">' . $line . '</div>';
        } elseif (preg_match('/^\s*(i|ii|iii|iv|v|vi|vii|viii|x)\./', $line)) {
            // Add more indentation if the line starts with a lowercase Roman numeral followed by a period
            $line = '<div class="course_policies" style="padding-left: 80px;">' . $line . '</div>';
            // Remove bold formatting from all words following the lowercase Roman numeral
        } else {
            // No indentation for other lines
            $line = '<div class="course_policies">' . $line . '</div>';
        }

       

    }
    return implode('<br>', $lines);
}




// Apply the indentText function to the description
echo indentText($description);
?>


    </td>

    <td style="position: absolute;top:0; left:0;">
            <button type="button" class="btn btn-success editbtn"><i class="lni lni-pencil"></i></button>
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
</div>
</div>
        </div>
        </div>

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

            var logoSrc = $tr.find('img').attr('src');

            console.log(data);

            $('#update_id').val(data[0]);
            $('#description').val(data[1]);
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