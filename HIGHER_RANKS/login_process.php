<?php
session_start(); // Start the session

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
            die("Connection failed: " . $conn->connect_error);
        }

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

                // Redirect user to a dashboard or another page
                header("Location: dashboard.php");
                exit;
            } else {
                // Password is incorrect, redirect back to login page with error message
                $_SESSION["error"] = "Invalid email or password.";
                header("Location: login.php");
                exit;
            }
        } else {
            // User not found, redirect back to login page with error message
            $_SESSION["error"] = "Invalid email or password.";
            header("Location: login.php");
            exit;
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        // If email or password is not provided, redirect back to login page with error message
        $_SESSION["error"] = "Email and password are required.";
        header("Location: login.php");
        exit;
    }
} else {
    // If not a POST request, handle the error
    $_SESSION["error"] = "Invalid request method.";
    header("Location: login.php");
    exit;
}
?>
