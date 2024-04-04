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
            // Prepare SQL statement to retrieve user's hashed password based on email
            $sql = "SELECT password FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                // User found, verify the password
                $row = $result->fetch_assoc();
                $hashed_password = $row["password"];
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set session variables
                    $_SESSION["email"] = $email;
                    $_SESSION["logged_in"] = true;

                    $response["success"] = true;
                    $response["message"] = "Login successful.";
                } else {
                    // Password is incorrect
                    $response["success"] = false;
                    $response["message"] = "Invalid email or password.";
                }
            } else {
                // User not found
                $response["success"] = false;
                $response["message"] = "Invalid email or password.";
            }

            // Close statement and database connection
            $stmt->close();
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
