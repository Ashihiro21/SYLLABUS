<?php
session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || $_SESSION["role"] !== "admin") {
    // If user is not logged in or not an admin, redirect to login page
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];


// Include the database connection securely
require_once '../Database/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SYLLABUS</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/png" href="../img/DLSU-D.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container-box">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                        <ion-icon name='people'></ion-icon>
                        </span>
                        <span class="title"><?php echo $email; ?></span>
                    </a>
                </li>

                <!-- <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li> -->

                <li>
                    <a href="department.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Category</span>
                    </a>
                </li>

                <li>
                    <a href="course.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Courses</span>
                    </a>
                </li>

                <li>
                    <a href="users.php">
                        <span class="icon">
                        <ion-icon name="person-add"></ion-icon>
                        </span>
                        <span class="title">Users</span>
                    </a>
                </li>

                <li>
                    <a href="position.php">
                        <span class="icon">
                            <ion-icon name="briefcase-outline"></ion-icon>
                        </span>
                        <span class="title">Position</span>
                    </a>
                </li>

                <li>
                    <a href="syllabus_status.php">
                        <span class="icon">
                        <ion-icon name="folder-outline"></ion-icon>
                        </span>
                        <span class="title">Syllabus Status</span>
                    </a>
                </li>
<!-- 
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li> -->

                <li>
                    <a href="sign_out.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <!-- <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div> -->

                <!-- <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div> -->
            </div>

            <!-- ======================= Cards ================== -->
           

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>