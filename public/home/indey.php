<?php
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
require_once("../../include/redirect.php");
require_once("../home/home_actions.php");
?>

<div class="m-container">

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header"><a class="navbar-brand" href="#">ILTS <!-- <img src="kuta.png"/> --></a>
            </div>
            <div>
                <ul class="nav navbar-nav">
                    <!--                        <li class=""><a href="#">Get Started</a></li>-->


                </ul>
                <!--                                <?php
                if (!(isset($_GET['reg']))) {
                    echo
                    '
                        ONE
                <ul class="nav navbar-nav navbar-right">
                    <li><a onclick=""><span class="glyphicon glyphicon-log-in"></span> </a></li>
                    <li>
                    <form class = "form-inline" role = "form" style = "margin-top:8px;">
                    <div class = "form-group">
                    <label class = "sr-only" id = "">Username:</label>
                    <input type = "email" class = "form-control" id = "nav_login_uname" placeholder = "Username">
                    </div>
                    <div class = "form-group">
                    <label class = "sr-only" for = "pwd">Password:</label>
                    <input type = "password" class = "form-control" id = "pwd" placeholder = "Password">
                    </div>
                    <div class = "checkbox">
                    <label><input type = "checkbox"><span style = "color: white;"> Remember me</span></label>
                    </div>&nbsp;&nbsp;&nbsp;
                    <button type = "submit" class = "btn btn-default">Login</button>
                    </form>
                    </li>
                                          
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-out"></span> Continue Unregistered</a></li>
                 
                </ul>';
                } elseif ((isset($_GET['reg'])) && ($_GET['reg']) == 1) {
                    echo
                    '    
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Hi, FNAME <span class="glyphicon glyphicon-log-out"></span></a></li>
                </ul>';
                }
                ?> -->
            </div>
        </div>
    </nav>

    <div style="background: url('../bg1.png') fixed no-repeat; margin-top: -20px;">

        <div class="row" style="background-color: rgba(0, 0, 0, 0.5); min-height: 270px;">
            <style>
                .optionlist{
                    text-align: center;
                }
                .optionlist a:hover{
                    text-decoration: none;
                    color: white;
                }
                .optionlist p{
                    color: wheat;
                    text-align: center;
                }
                .optionlist h2{
                    /*letter-spacing: 2px;*/
                    text-align: center;
                    color: white;
                }
                .optionlist h1{
                    letter-spacing: 2px;
                    text-align: left;
                    color: wheat;
                }
                .home_btn_my{
                    height: 56px; 
                    width: 170px;
                    border-radius: 7px;
                }

            </style>
            <!--the bigger part with 2 buttons-->
            <div class="col-md-offset-1 col-md-10 optionlist my_home_starter">
                <h1>Welcome to <span style="letter-spacing: 2px; color: white; font-family: serif; ">ILTS,</span> Integrated Labour Tracking and Management System.</h1>
                <!--<a href="#"> <h1>Apply for job.</h1></a><p>This will require you to <a href="#">login</a></p>-->

                <div class="col-sm-6">
                    <h2> In need of casual workers? Click the button.</h2>
                    <a href="client.php"><button class="home_btn_my btn btn-lg btn-primary" name="get_workers">GET WORKERS</button></a><br/>
                </div>
                <div class="col-sm-6">

                    <h2>Seeking job? Click here to create an account jobs.</h2>
                    <a id="new_user_reg_modal"><button class="home_btn_my btn btn-lg btn-primary">REGISTER NOW</button></a>
                </div>
            </div>

            <div class="col-md-offset-1 col-md-10 optionlist my_home_starter">
                <h1>Welcome to <span style="letter-spacing: 2px; color: white; font-family: serif; ">ILTS,</span> LIMMA LIMITED OFFICIAL WEB PORTAL.</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <!--slight explanation of what we do-->
        <div class="col-md-offset-1 col-md-10">
            <h3 style="text-align: center;">
                What we do and how we do it.
            </h3>
            <p>
                ILTS reach for qualified individuals, both skilled and unskilled resourceful persons.
                We have place for casual, seasonal and partially permanent employees. We contract the manpower to 
                companies in need of workers for the period they need the service. In this we connect persons seeking for jobs 
                with those seeking manpower.
                We provide casual workers to individuals and companies in need. We get and accumulate the pay for agreed
                for say a week/month then we give the worker his/her right. We guarantee full and on time payments.
            </p>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <h3 style="text-align: center;">RECENTLY ADVERTISED VACANCIES</h3>
            <?php view_job_adverts(); ?>
        </div>
        <div class="col-md-5" >
            <h3 style="text-align: center;">AVAILABLE QUALIFIED PERSONS</h3>
            <?php view_qualified(); ?>
        </div>
        <div class="col-md-1"></div>
    </div>



    <script>
        $("#reg").click(function () {

            $.post($("#register_new_user_form").attr("action"), $("#register_new_user_form : input").serializeArray(), function (info) {
                $("#result").html(info);
                clearFields();
            });
        });
        $("#register_new_user_form").submit(function () {
            return false;
        });
        function clearFields() {
            $("#register_new_user_form :input").each(function () {
                $(this).val('');
            }
            );
        }
    </script>
</div><!--no Content beyond this-->
<div id="success_alert_message" class="hidden alert alert-success" style=" margin: auto; width:300px; text-align: center; position: fixed; top: 5%; left: 35%; z-index: 1000;" >
    
</div>
<?php
require_once ("../includes/footer.php");
?>

