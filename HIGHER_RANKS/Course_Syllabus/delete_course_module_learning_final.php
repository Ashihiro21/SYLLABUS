<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'syllabus');

if(isset($_POST['deletedata15']))
{
    $id = $_POST['delete_id15'];

    $query = "DELETE FROM `module_learning_final` WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location: ../dashboard.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

?>