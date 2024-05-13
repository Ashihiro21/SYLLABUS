<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Table Example</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
  <h2 class="text-center mb-4">Bootstrap Table Example</h2>
  <!-- Centered table and button -->
  <div class="row justify-content-center mb-4">
    <div class="col-md-6 text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Course Learning outcomes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
          
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Centered button to trigger modal -->
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addDataModal">Add New Data</button>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="addDataModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Text field for input -->
                <div class="form-group">
                    <label for="newDataInput">Input Data:</label>
                    <input type="text" class="form-control" id="newDataInput" placeholder="Enter your data">
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveData()">Save Data</button>
            </div>
        </div>
    </div>
</div>

<script>
    function saveData() {
        var newData = document.getElementById("newDataInput").value;
        var table = document.querySelector(".table");
        var newRow = table.insertRow(-1); // Insert new row at the end of the table
        var cell = newRow.insertCell(-1); // Insert new cell in the new row
        cell.innerHTML = newData; // Set the content of the cell to the new data
        $('#addDataModal').modal('hide'); // Hide the modal after saving data
    }
</script>


  <table class="table table-bordered mt-4" id="mainTable">
    <thead>
      <tr>
        <th>Course learning outcomes</th>
        <th>Topic Learning outcomes</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td id="topicOutcome">
          <!-- Table for topic outcomes -->
          <table class="table table-bordered" id="topicTable">
            <thead>
              <tr>
                <th>Outcome</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- PHP script will insert rows here -->
            </tbody>
          </table>
        </td>
        <td>
          <!-- Button to trigger modal -->
          <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Action</button>
        </td>
      </tr>
    </tbody>
  </table>
</div>

<!-- Centered Modal -->
<!-- <div class="modal fade" id="centeredModal" tabindex="-1" role="dialog" aria-labelledby="centeredModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="centeredModalLabel">Add New Column</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="newColumnName">Column Name:</label>
          <input type="text" class="form-control" id="newColumnName" placeholder="Enter column name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addColumn()">Save</button>
      </div>
    </div>
  </div>
</div> -->

<!-- Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Text field for input -->
        <div class="form-group">
          <label for="dataInput">Input Sentence:</label>
          <input type="text" class="form-control" id="dataInput" placeholder="Enter your sentence">
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="updateTopicOutcome()">Save</button>
      </div>
      
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Add your PHP code for database connection and insertion -->
<?php
// Database configuration
$servername = "localhost"; // Change this to your database server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "sample_db"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['newDataInput'])) {
    $newData = $_POST['newDataInput'];
    // SQL to insert data into course_learning table
    $sql = "INSERT INTO course_learning (learning_outcome) VALUES ('$newData')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<script>
  function updateTopicOutcome() {
    var inputValue = document.getElementById("dataInput").value;
    // AJAX request to save data into database
    $.ajax({
        type: "POST",
        url: "save_data.php", // Change this to your PHP file name
        data: { newDataInput: inputValue },
        success: function(response) {
            // If data is successfully saved, create a new row in the table
            var newRow = document.createElement("tr");
            newRow.innerHTML = `
              <td>${inputValue}</td>
              <td><button class="btn btn-danger" onclick="deleteRow(this)">Delete</button></td>
            `;
            document.querySelector("#topicOutcome table tbody").appendChild(newRow);
            $('#myModal').modal('hide');
            alert("Data saved successfully");
        },
        error: function(xhr, status, error) {
            alert("An error occurred: " + xhr.status + " " + error);
            // Handle errors if needed
        }
    });
  }

  function deleteRow(button) {
    button.closest("tr").remove();
  }

  function addColumn() {
    var newColumnName = document.getElementById("newColumnName").value;
    var newColumn = document.createElement("th");
    newColumn.textContent = newColumnName;
    var mainTableHeader = document.querySelector("#mainTable thead tr");
    mainTableHeader.appendChild(newColumn);
    $('#centeredModal').modal('hide');
  }
</script>


</body>
</html>
