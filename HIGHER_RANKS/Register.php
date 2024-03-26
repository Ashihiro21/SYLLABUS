<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form action="register_process.php" method="POST">
        <label for="first_name">First Name:</label><br>
        <input type="text" id="first_name" name="first_name" required><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" id="last_name" name="last_name" required><br><br>
        
        <label for="position">Position:</label><br>
        <select id="position" name="position" required>
            <option value="faculty">Faculty</option>
            <option value="curriculum_committee">Curriculum Committee</option>
            <option value="department_chair">Department Chair</option>
            <option value="dean">Dean</option>
        </select><br><br>

        <label for="department">Department:</label><br>
        <select id="department" onchange="getCourses(this.value);" name="department" required>
            <option value="CBAA">College of Business Administration and Accountancy</option>
            <option value="CCJE">College of Criminal Justice Education</option>
            <option value="CE">College of Education</option>
            <option value="CEAT">College of Engineering, Architecture and Technology</option>
            <option value="CLAC">College of Liberal Arts and Communication</option>
            <option value="CSCS">College of Science and Computer Studies</option>
            <option value="CTHM">College of Tourism and Hospitality Management</option>
        </select><br><br>

        <label for="course">Course:</label><br>
        <select name="course" id="course">
            <option value="">Select Courses</option>
        </select><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="tel" id="phone_number" name="phone_number"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>


        <input type="submit" value="Register">
    </form>

   <script>
    function getCourses(department){
        if(window.XMLHttpRequest){
            xmlhttp = new XMLHttpRequest();
        }else{
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function(){
            if(this.readyState==4 && this.status==200){
                document.getElementById('course').innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET","helper.php?department="+department, true);
        xmlhttp.send();
    }
   </script> 
</body>
</html>
