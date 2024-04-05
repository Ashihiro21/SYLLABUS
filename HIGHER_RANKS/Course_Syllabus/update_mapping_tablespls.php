<?php
$connection = mysqli_connect("localhost", "root", "", "syllabus");

if(isset($_POST['updatedata'])) {   
    $id = $_POST['update_id10'];
    
    $learn_out_mapping = $_POST['learn_out_mapping'];
    $pl1 = $_POST['pl1'];
    $pl2 = $_POST['pl2'];
    $pl3 = $_POST['pl3'];
    $pl4 = $_POST['pl4'];
    $pl5 = $_POST['pl5'];
    $pl6 = $_POST['pl6'];
    $pl7 = $_POST['pl7'];
    $pl8 = $_POST['pl8'];
    $pl9 = $_POST['pl9'];
    
    $query = "UPDATE mapping_table SET learn_out_mapping='$learn_out_mapping', pl1='$pl1' , pl2='$pl2' , pl3='$pl3' , pl4='$pl4' , pl5='$pl5' , pl6='$pl6' , pl7='$pl7' , pl8='$pl8' , pl9='$pl9' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run) {
        echo '<script> alert("Data Updated"); </script>';
        header("Location: ../dashboard.php");
    } else {
        echo '<script> alert("Data Not Updated"); </script>';
    }
}

?>