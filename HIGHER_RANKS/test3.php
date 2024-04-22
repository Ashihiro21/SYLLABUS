<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Dropdown in PHP Modal</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dynamicModal">
        Open Modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="dynamicModal" tabindex="-1" role="dialog" aria-labelledby="dynamicModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dynamicModalLabel">Select category and course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Dropdowns will be loaded here -->
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
                    $categoryDropdown = '<select id="categorySelect" class="form-control">';
                    // Remove the "Select Category" option
                    // $categoryDropdown .= '<option value="">Select Category</option>';

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

                    ?>

                    <!-- course dropdown will be loaded dynamically -->
                    <div id="courseDropdown"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSelection">Save</button>
                </div>
            </div>
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
