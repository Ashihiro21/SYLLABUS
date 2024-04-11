<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'syllabus');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id20'];

    $query = "DELETE FROM `percent` WHERE id='$id'";
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