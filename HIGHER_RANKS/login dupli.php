<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">                                                                         
    <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
    <title>dlsud syllabus</title>
    <Style>
        html {
  background-color: #000; /* Adjust this color to match the dominant color in your image */
}
        body {
            background-image: url('../img/dlsud.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            height: 100vh;
            font-family: "Poppins", sans-serif;
            overflow: hidden; /* Prevent the semi-transparent overlay from creating scrollbars */
        }
         /* Semi-transparent overlay */
         .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 128, 0, 0.2); /* Adjust the color and opacity as needed */
        }


a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}



/* Structure */
.wrapper {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            width: 100%;
            min-height: 100%;
            padding: 20px;
            position: relative; /* Ensure positioning of absolute element relative to body */
            z-index: 1; /* Ensure the form content appears above the overlay */
        }

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: rgba(255, 255, 255, 0.8); /* Adjusted background color with transparency */
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

#formFooter {
    background: rgba(255, 255, 255, 0.8); /* Adjusted background color with transparency */
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset]  {
  background-color: #56baed;
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

input[type=text] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=email]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=email]:placeholder {
  color: #cccccc;
}
/* Password Input */
input[type="password"],input[type="email"] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px; /* Apply the same padding as text input */
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
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

#icon {
  width:30%;
  height:auto;
}
/* alert message */

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

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
        <img src="../img/DLSU-D.png" id="icon" alt="User Icon"/>
        <h6>Login to DLSUD.Syllabus</h6>
        </div>

        <form action="login_process.php" method="POST">
            <input type="text"  class="fadeIn second" name="email" placeholder="Email" required><br>
            <input type="password"  class="fadeIn third" name="password" placeholder="Password" required><br>
            <input type="submit" class="fadeIn fourth" value="Login">
        </form>
        <!-- Remind Passowrd -->
        <div id="formFooter">
            <p>don't have an account? click <a class="underlineHover" href="Register.php">Here.</a><p>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        
        // Submit form via AJAX
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Show success message using FancyAlerts
                    FancyAlerts.show({msg: response.message, type: 'success'});
                    // Optional: Add transition effect
                    $('body').fadeOut(4500, function() {
                        // Redirect to dashboard page after a delay
                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 1000); // 1000 milliseconds = 1 second
                    });
                } else {
                    // Show error message using FancyAlerts
                    FancyAlerts.show({msg: response.message, type: 'error'});
                }
            },
            error: function(xhr, status, error) {
                // Show error message if AJAX request fails
                FancyAlerts.show({msg: 'An error occurred while processing your request.', type: 'error'});
            }
        });
    });
});



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
