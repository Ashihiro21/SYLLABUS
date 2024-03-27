<?php 
include('../Database/connection.php');

// Fetch positions from the database
$sql = "SELECT * FROM position";
$result = mysqli_query($conn, $sql);
$positions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>

<form action="register_process.php" method="POST">

        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>

        <label for="department">Department</label><br><br>
        <select name="department" id="parentbox">
        <option>Select Category</option><br><br>

        <?php
        $sql="SELECT * FROM category";
        $result=mysqli_query($conn,$sql);

        while($data=mysqli_fetch_array($result))
        {?>
        <option value="<?php echo $data['id']?>"><?php echo $data['name'];?></option>
        <?php } ?>

        </select><br><br>

        <label for="courses">Course</label><br><br>
        <select name="courses" id="childbox">
        <option>Select Courses</option>
        </select><br><br>

        <label for="phone_number">Phone Number:</label><br><br>
        <input type="tel" id="phone_number" name="phone_number"><br><br>

        <label for="position">Position:</label><br>
        <select id="position" name="position" required>
            <option value="">Select Position</option>
            <?php foreach ($positions as $position) { ?>
                <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
            <?php } ?>
        </select><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Register">
</form>

<script>
$("#parentbox").change(function() {
    $category = $("#parentbox").val();
    
    $.ajax({
        url: 'data.php',
        method: 'POST',
        data: {'category': $category},
        success: function(response) {
            $("#childbox").html(response);
        }
    });
});
</script>

</body>
</html>
