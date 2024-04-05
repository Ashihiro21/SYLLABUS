<?php

include('../Database/connection.php');

// Check if the 'category' parameter is set in the POST request
if(isset($_POST['category'])) {
    // Sanitize the input (assuming category is an integer)
    $category = intval($_POST['category']);

    // Prepare the SQL statement using prepared statement
    $sql = "SELECT cname, id FROM course WHERE catid=?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $category);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Initialize output
    $output = '<option>Select Course</option>';

    // Fetch data and append options
    while ($data = mysqli_fetch_array($result)) {
        $output .= "<option value='" . $data['id'] . "'>" . $data['cname'] . "</option>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);

    // Output the options
    echo $output;
} else {
    // Handle case where 'category' parameter is not set
    echo "No category selected.";
}

?>
