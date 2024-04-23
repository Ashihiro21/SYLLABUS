<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dlsud registration</title>
    <style>
        html {
            background-color: #000;
        }

        body {
            background-color: #f6f6f6;
            font-family: "Poppins", sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #formContent {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: #56baed;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #39ace7;
        }

        a {
            color: #92badd;
            text-decoration: none;
        }

        a:hover {
            color: #0d0d0d;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div id="formContent">
        <div class="fadeIn first">
            <h6>Register for DLSUD.Syllabus</h6>
        </div>

        <form action="Register_process_dupli.php" method="POST">
            <div class="form-group">
                <input type="text" id="username" name="username" class="fadeIn second" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="text" id="password" name="password" class="fadeIn third" placeholder="Password" required>
            </div>

            <input type="submit" class="fadeIn fourth" value="Register">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter" class="fadeIn fifth">
            <p>Already have an account? Login <a href="login.php">here</a>.</p>
        </div>
    </div>
</div>
</body>
</html>
