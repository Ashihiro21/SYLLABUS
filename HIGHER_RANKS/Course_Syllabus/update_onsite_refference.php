<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id6'];
    
    $Provider = $_POST['Provider'];
    $Reference_Material = $_POST['Reference_Material'];
    
    $query = "UPDATE onsite_reffence SET Provider='$Provider', Reference_Material='$Reference_Material' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>