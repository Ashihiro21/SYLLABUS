<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="update_user_details.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                    </div>
                    <div class="form-group">
                        <label for="department">Department</label>
                        <select name="department" id="categorySelect" class="form-control">
                            <option value="">Select Category</option>
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

                                $sql = "SELECT id, name FROM category";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $selected = ($row['id'] == $department) ? 'selected' : '';
                                        echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['name'].'</option>';
                                    }
                                }
                                $conn->close();
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <select name="catid" id="courseSelect" class="form-control">
                            <option value="">Select Course</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Proceed</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Include jQuery and Bootstrap JS for the modal functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('#categorySelect').on('change', function(){
        var categoryId = $(this).val();
        $.ajax({
            url: 'data1.php',
            type: 'POST',
            data: {catid: categoryId},
            success: function(response){
                $('#courseSelect').html(response);
            }
        });
    });
});
</script>
