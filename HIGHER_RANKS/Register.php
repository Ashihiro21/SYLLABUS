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
        <select id="SelectA" onchange="my_fun(this.value);" name="department" required>
            <option value="cbaa">College of Business Administration and Accountancy</option>
            <option value="ccje">College of Criminal Justice Education</option>
            <option value="ce">College of Education</option>
            <option value="ceat">College of Engineering, Architecture and Technology</option>
            <option value="clac">College of Liberal Arts and Communication</option>
            <option value="cscs">College of Science and Computer Studies</option>
            <option value="cthm">College of Tourism and Hospitality Management</option>
        </select><br><br>


        <label for="courses">Courses:</label><br>
        <input type="text" id="courses" name="courses"><br><br>

        <label for="phone_number">Phone Number:</label><br>
        <input type="tel" id="phone_number" name="phone_number"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>


        <input type="submit" value="Register">
    </form>
</body>
</html>
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    position ENUM('faculty', 'curriculum_committee', 'department_chair', 'dean') NOT NULL,
    department VARCHAR(50) NOT NULL,
    courses VARCHAR(255),
    phone_number VARCHAR(15),
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);
