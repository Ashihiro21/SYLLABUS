<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">                                                                         
    <script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>

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
<body>
<div class="container">
    <button class="show-alert show-alert__error">Error</button>
    <button class="show-alert show-alert__success">submit</button>
    <button class="show-alert show-alert__info">Info</button>
</div>
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