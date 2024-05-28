<?php
include('../Database/connection.php');

if(isset($_POST['catid'])) {
    $catid = $_POST['catid'];
    $sql = "SELECT id, cname FROM course WHERE catid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $catid);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        echo '<option value="">Select Course</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['id'].'">'.$row['cname'].'</option>';
        }
    } else {
        echo '<option value="">No courses available</option>';
    }

    $stmt->close();
    $conn->close();
}
?>
