<?php

require_once('../Database/connection.php');

// Fetch courses based on the selected department
if(isset($_GET['department'])){
    $department = $_GET['department'];
    // Example SQL query, replace with your actual query
    $query = "SELECT course, department FROM courses WHERE department = :department";
    // Prepare the statement
    $stmt = $pdo->prepare($query);
    // Bind the parameter
    $stmt->bindParam(':department', $department);
    // Execute the statement
    $stmt->execute();
    // Fetch courses
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Output options for courses
    foreach($courses as $course){
        echo "<option value='".$course['course']."'>".$course['course']."</option>";
    }
}

?>
