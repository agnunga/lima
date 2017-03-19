
<?php
session_start();
include_once ("../includes/header.php");

require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
$users->user_login();
$who = "<h3 style=\"text-align: center; color: lightskyblue;\">LOGIN</h3>";
$lith = "job_seeker";
$placeholder = "ID Number";
$las = "job_seeker";
//if(isset($_SESSION['id'])){
//    header("Location: home.php");
//}
//require_once ("");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <title>
            Login page
        </title>

        <style>
            #mgmtlogin{
                max-width: 450px;
                margin: 5% auto auto auto;
                padding: 0 20px 0 0;
                border: 1px solid lightskyblue;
                border-radius: 10px;
            }

        </style>
    </head>
    <body>
        <div class="m-container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"> LIMAQ ILTMS </a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="message" style="text-align: center">

                <?php
                if (isset($_GET['reg'])) {
                    if ($_GET['reg'] == 1) {
                        echo 'Registration successful. Use your ID number and parrword to login.';
                    } elseif ($_GET['reg'] == 0) {
                        echo 'Registration failed. Try again.';
                    }
                }
                ?>

            </div>
            <div id="mgmtlogin">

                <?php
                if (isset($_GET['reg'])) {
                    if ($_GET['reg'] == 1) {
                        require_once ("../forms/login_form.php");
                        echo '
                        
                        <div class="row">
                            <div class="col-md-offset-2 col-md-8 col-md-offset-2" style="text-align: center; margin-top: 10px">
                                Does not have an account? <a href="../index.php">Click here</a> to register.
                            </div>
                        </div>
                            ';
                    } elseif ($_GET['reg'] == 0) {
                        
                    }
                }
                ?>

            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-2">
                    <a>Job adverts</a>
                    <a>Job adverts</a>
                    <a>Job adverts</a>
                    <a>Job adverts</a>
                </div>
                <div class="col-md-8">
                    
                </div>
            </div>
        </div>
    </body>
</html>
