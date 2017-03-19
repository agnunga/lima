<?php
require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
(Session::logged_in('employee_no') ? Redirect::to("index.php") : '');
require_once ("../includes/header.php");
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");


$users->user_login();
$las = "employee";
$lith = "employee";
$placeholder = "Employee Number";
$who = "<h3 style=\"text-align: center; color: lightseagreen;\">EMPLOYEE LOGIN</h3>";
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
            #clientlogin{
                max-width: 450px;
                margin: 5% auto auto auto;
                padding: 0 20px 0 0;
                border: 1px solid lightseagreen;
                border-radius: 10px;
            }

        </style>
    </head>
    <body>
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
        <div id="clientlogin">
            <?php require_once ("../forms/login_form.php"); ?>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-md-offset-2" style="text-align: center; margin-top: 10px">
                For employees. Are you? If not, <a href="../index.php">Click here</a>
            </div>
    </body>
</html>