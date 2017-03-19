
<div class = "modal fade" id="client_login" role = "dialog" data-backdrop = "false" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-sm" style="width: 450px; margin: 20% auto; ">

            <div class = "modal-body">
                <button class = "close" data-dismiss = "modal">&times;
                </button>
                <?php
                include_once ("../includes/header.php");
                require_once ("../../include/config.php");
                require_once ("../../include/database.php");
                require_once ("../../include/user.php");
                $users->user_login();
                $who = "<h3 style=\"text-align: center; color: blue;\">CLIENTS LOGIN</h3>";
//For col used to log in
                $lith = "user";
                $placeholder = "Username";
//for table
                $las = "client";
//if(isset($_SESSION['id'])){
//    header("Location: home.php");
//}
//require_once ("");
                ?>

                <style>
                    #clientlogin{
                        max-width: 450px;
                        margin: 5% auto auto auto;
                        padding: 0 20px 0 0;
                        border: 1px solid blue;
                        border-radius: 10px;
                    }

                </style>
                <div id="clientlogin">
                    <?php require_once ("../forms/login_form.php"); ?>
                </div>
            </div>
        </div>
    </div>