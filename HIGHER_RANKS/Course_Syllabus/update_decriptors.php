<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id11'];
    
    $program_learn = $_POST['program_learn'];
    $rate1 = $_POST['rate1'];
    $rate2 = $_POST['rate2'];
    $rate3 = $_POST['rate3'];
    $rate4 = $_POST['rate4'];
    $rate5 = $_POST['rate5'];
  
    
    $query = "UPDATE decriptors SET program_learn='$program_learn', rate1='$rate1' , rate2='$rate2' , rate3='$rate3' , rate4='$rate4' , rate5='$rate5' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>