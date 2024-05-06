<?php
session_start(); // Start the session

$response = array(); // Initialize response array

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both email and password are provided
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        // Get email and password from form
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Connect to your database
        $servername = "localhost";
        $username = "root";
        $password_db = "";
        $dbname = "syllabus";

        // Create connection
        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            $response["success"] = false;
            $response["message"] = "Database connection failed.";
        } else {
            // Check if user is in the users table
            $sql_users = "SELECT * FROM users WHERE email = ?";
            $stmt_users = $conn->prepare($sql_users);
            $stmt_users->bind_param("s", $email);
            $stmt_users->execute();
            $result_users = $stmt_users->get_result();

            // Check if user is in the admins table
            $sql_admins = "SELECT * FROM admins WHERE email = ?";
            $stmt_admins = $conn->prepare($sql_admins);
            $stmt_admins->bind_param("s", $email);
            $stmt_admins->execute();
            $result_admins = $stmt_admins->get_result();

            if ($result_users->num_rows == 1) {
                // User found in users table, verify the password
                $row = $result_users->fetch_assoc();
                $hashed_password = $row["password"];
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set session variables
                    $_SESSION["email"] = $email;
                    $_SESSION["logged_in"] = true;
                    $_SESSION["role"] = "user"; // Set role as "user"

                    $response["success"] = true;
                    $response["message"] = "User login successful.";
                    $response["redirect"] = "dashboard.php"; // Set the redirect URL for user
                } else {
                    // Password is incorrect
                    $response["success"] = false;
                    $response["message"] = "Invalid email or password.";
                }
            } else if ($result_admins->num_rows == 1) {
                // User found in admins table, verify the password
                $row = $result_admins->fetch_assoc();
                $hashed_password = $row["password"];
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set session variables
                    $_SESSION["email"] = $email;
                    $_SESSION["logged_in"] = true;
                    $_SESSION["role"] = "admin"; // Set role as "admin"

                    $response["success"] = true;
                    $response["message"] = "Admin login successful.";
                    $response["redirect"] = "../Admin/department.php"; // Set the redirect URL for admin
                } else {
                    // Password is incorrect
                    $response["success"] = false;
                    $response["message"] = "Invalid email or password.";
                }
            } else {
                // User not found in users or admins table
                $response["success"] = false;
                $response["message"] = "Invalid email or password.";
            }

            // Close statements
            $stmt_users->close();
            $stmt_admins->close();
            $conn->close();
        }
    } else {
        // If email or password is not provided
        $response["success"] = false;
        $response["message"] = "Email and password are required.";
    }
} else {
    // If not a POST request
    $response["success"] = false;
    $response["message"] = "Invalid request method.";
}

// Return JSON response
echo json_encode($response);
?>
