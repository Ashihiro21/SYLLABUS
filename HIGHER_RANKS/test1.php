<?php 
session_start();
require_once '../Database/connection.php';

// Fetch positions from the database
$sql = "SELECT * FROM position";
$result = mysqli_query($conn, $sql);
$positions = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Process registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch data from the registration form
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $department = $_POST['department'];
    $courses = $_POST['courses'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $position = $_POST['position'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format!";
    } else {
        // Check if email already exists in the database
        $sql_check_email = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt_check_email = $conn->prepare($sql_check_email);
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $stmt_check_email->bind_result($email_count);
        $stmt_check_email->fetch();
        $stmt_check_email->close();

        if ($email_count > 0) {
            $error_message = "Email already exists!";
        } else {
            // Hash password
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);

            // Insert data into the database
            $sql = "INSERT INTO users (first_name, last_name, department, courses, phone_number, email, password, position) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $first_name, $last_name, $department, $courses, $phone_number, $email, $password_hashed, $position);
            $stmt->execute();

            // Check if registration was successful
            if ($stmt->affected_rows > 0) {
                // Registration successful
                $success_message = "Registration successful!";
            } else {
                // Registration failed
                $error_message = "Registration failed!";
            }
        }
    }
}
?>
<?php 
include('../Database/connection.php');

// Fetch positions from the database
$sql = "SELECT * FROM position";
$result = mysqli_query($conn, $sql);
$positions = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>dlsud registration</title>
    <style>
        html {
            background-color: #000;
        }

        body {
            background-image: url('../img/dlsud.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            height: 100vh;
            font-family: "Poppins", sans-serif;
            overflow: hidden;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 128, 0, 0.2);
        }

        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 100%;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        #formContent {
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.8); /* Adjusted background color with transparency */
            padding: 30px;
            width: 100%;
            max-width: 500px;
            position: relative;
            text-align: center;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-column {
            display: flex;
            justify-content: space-between;
        }

        .form-column .form-group {
            width: 48%;
        }

        input[type=button],
        input[type=submit],
        input[type=reset] {
            background-color: #56baed;
            border: none;
            color: white;
            padding: 15px 30px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            text-transform: uppercase;
            font-size: 13px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type=button]:hover,
        input[type=submit]:hover,
        input[type=reset]:hover {
            background-color: #39ace7;
        }

        a {
            color: #92badd;
            text-decoration: none;
        }

        a:hover {
            color: #0d0d0d;
        }
        
#icon {
  width:30%;
  height:auto;
}
/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}
.fadeIn.fifth {
  -webkit-animation-delay: 1.2s;
  -moz-animation-delay: 1.2s;
  animation-delay: 1.2s;
}
.fadeIn.sixth {
  -webkit-animation-delay: 1.4s;
  -moz-animation-delay: 1.4s;
  animation-delay: 1.4s;
}
.fadeIn.seventh {
  -webkit-animation-delay: 1.6s;
  -moz-animation-delay: 1.6s;
  animation-delay: 1.6s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
} 


        body {}

.fancy-alert {
    font-family: sans-serif;
    color: white;
    width: 78px;
    z-index: 1020;
    top: 0px;
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    position: fixed;
    overflow: hidden;
    box-shadow: 0 4px rgba(0, 0, 0, 0.3);
    opacity: 0;
    height: 78px;
    background-color: gray;
    transform: scale(0);
    transition: all 0.5s;

}

.fancy-alert.fancy-alert__active {
    opacity: 1;
    top: 20px;
    transform: scale(1);
}

.fancy-alert.fancy-alert__extended {
    width: 800px;
}

.fancy-alert.fancy-alert__extended .fancy-alert--content {
    opacity: 1;
    transition: all 0.5s;
}

.fancy-alert.fancy-alert__extended .fancy-alert--words {
    top: 18px;
    opacity: 1;
}

.fancy-alert.error {
    background-color: #D64646;
}

.fancy-alert.success {
    background-color: #3CB971;
}

.fancy-alert.info {
    background-color: #E8C22C;
}

.fancy-alert a {
    color: white;
    text-decoration: underline;
}

.fancy-alert--content {
    padding: 10px;
    opacity: 0;
}

.fancy-alert--words {
    font-size: 18px;
    font-weight: bold;
    padding: 0 18px 0 90px;
    max-width: 80%;
    position: relative;
    top: -50px;
    opacity: 0;
    height: 60px;
    transition: all 0.3s;
    transition-delay: 0.5s;
}

.fancy-alert--icon {
    padding: 26px;
    float: left;
    font-size: 26px;
    background-color: rgba(3, 3, 3, 0.15);
}

.fancy-alert--close {
    position: absolute;
    text-decoration: none;
    right: 10px;
    top: 10px;
    font-size: 15px;
    padding: 6px 9px;
    background: rgba(0, 0, 0, 0.12);
}

.container {
    text-align: center;
    margin: 200px 0;
}

.show-alert {
    border: 0;
    background: #F2F2F2;
    padding: 15px 70px;
    font-weight: bold;
    border-radius: 5px;
    border-bottom: 3px solid #C8C8C8;
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.23), inset 0 -53px 20px -30px rgba(59, 65, 74, 0.06);
    margin: 0 10px;
    font-size: 16px;
    cursor: pointer;
    color: #808080;
    text-shadow: 0 1px #FFF;
    outline: 0;
    position: relative;
}

.show-alert:active {
    border: 0;
    box-shadow: none;
    top: 2px;
}

.show-alert__info {
    color: #E8C22C;
}

.show-alert__success {
    color: #3CB971;
}

.show-alert__error {
    color: #D64646;
}

    </style>
</head>
<body aria-label="Background image, DLSUD-rotonda">
<div class="overlay"></div>

<div class="wrapper  fadeInDown">
    <div id="formContent">
        <div class="fadeIn first">
            <img src="../img/DLSU-D.png" id="icon" alt="User Icon"/>
            <h6>Register for DLSUD.Syllabus</h6>
        </div>

        <form action=" " method="POST">
    <div class="form-column">
        <div class="form-group">
            <input type="text" id="first_name" name="first_name" class="fadeIn first"  placeholder="First name" required>
        </div>
        <div class="form-group">
            <input type="text" id="last_name" name="last_name" class="fadeIn first" placeholder="Last name" required>
        </div>
    </div>

    <div class="form-group">
        <input type="email" id="email" name="email" class="fadeIn second"  placeholder="Email" required>
    </div>
    <div class="form-group">
        <input type="password" id="password" name="password" class="fadeIn third" name="password" placeholder="Password" required>
    </div>
    <div class="form-group">
        <input type="text" id="phone_number" name="phone_number" class="fadeIn third"  placeholder="phone number" required>
    </div>

    <!-- Dropdown for Department -->
    <div class="form-group">
    <div class="dropdown">
        <select id="parentbox" name="department" class="custom-select fadeIn fourth"  required>
            <option value="" selected disabled>Select Department</option>
            <?php
            $sql = "SELECT * FROM category";
            $result = mysqli_query($conn, $sql);

            while ($data = mysqli_fetch_array($result)) {
                ?>
                <option value="<?php echo $data['id']; ?>"><?php echo $data['name']; ?></option>
            <?php } ?>
        </select>
    </div>
</div>


    <!-- Dropdown for Courses -->
    <div class="form-group">
        <div class="dropdown">
            <select class="custom-select fadeIn fifth" name="courses"  id="childbox">
                <option>Select Courses</option>
                <!-- Add more options as needed -->
            </select>
        </div>
    </div>

    <!-- Dropdown for Position -->
    <div class="form-group">
    <div class="dropdown">
        <select id="position" class="custom-select fadeIn sixth" name="position" required>
            <option value="" selected disabled>Select Position</option>
            <?php foreach ($positions as $position) { ?>
                <option value="<?php echo $position['id']; ?>"><?php echo $position['name']; ?></option>
            <?php } ?>
        </select>
    </div>
</div>


    <input type="submit" class="fadeIn fourth" value="Register">
</form>

        <!-- Remind Passowrd -->
        <div id="formFooter" class="fadeIn seventh">
            <p>Already have an account? Login <a href="login.php">here</a>.</p>
        </div>
    </div>
</div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function() {
    $('.show-alert__error').click(function() {
        FancyAlerts.show({msg: 'Uh oh something went wrong!',type: 'error'})
    })
    $('.show-alert__success').click(function() {
        FancyAlerts.show({msg: 'successfully registered!'})
    })
    $('.show-alert__info').click(function() {
        FancyAlerts.show({msg: 'So long and thanks for all the shoes.',type: 'info'})
    });
})


var FancyAlerts = (function() {
    
    var self = this;
    
    self.show = function(options) {
            if($('.fancy-alert').length > -1) {
                FancyAlerts.hide();
            }
            var defaults = {
                type: 'success',
                msg: 'Success',
                timeout: 5000,
                icon: 'fa fa-check',
                onClose: function() {}
            };

            if(options.type === 'error' && !options.icon) options.icon = 'fa fa-exclamation-triangle';
            if(options.type === 'info' && !options.icon) options.icon = 'fa fa-cog';

            var options = $.extend(defaults, options);

            var $alert = $('<div class="fancy-alert '+ options.type +' ">' +
                                '<div class="">' +
                                    '<i class="fancy-alert--icon ' + options.icon + '"></i>' +
                                    '<div class="fancy-alert--content">' +
                                        '<div class="fancy-alert--words">' +options.msg + '</div>' +
                                        '<a class="fancy-alert--close" href="#"><i class="fa fa-times"></i></a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>');
            
            $('body').prepend($alert);
            setTimeout(function() {
                $alert.addClass('fancy-alert__active');
            }, 10);

            setTimeout(function() {
                $alert.addClass('fancy-alert__extended');
            }, 500);

            if(options.timeout) {
                self.hide(options.timeout);    
            }
            $('.fancy-alert--close').on('click', function(e) {
                e.preventDefault();
                self.hide();
            });

            $alert.on('fancyAlertClosed', function() {
                options.onClose();
            });
        };
    
    
        self.hide = function(_delay) {
            var delay = _delay || 0;

            var $alert = $('.fancy-alert');
            setTimeout(function() {
                setTimeout(function() {
                    $alert.removeClass("fancy-alert__extended");
                }, 10);

                setTimeout(function() {
                    $alert.removeClass('fancy-alert__active');
                }, 500);
                setTimeout(function() {
                    $alert.trigger('fancyAlertClosed');
                    $alert.remove();
                }, 1000);
            }, delay);
        }
    
    return self;
    
})();
</script>

</body>
</html>
