
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">


        <link rel="shortcut icon" href="../icon1.png"/>    

        <link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.css" type="text/css" media = "all"/>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css" type="text/css" media = "all"/>

        <!--        <link rel="stylesheet" href="../bootstrap/cupertino/jquery-ui.css" type="text/css" media = "all"/>
                <link rel="stylesheet" href="../bootstrap/cupertino/theme.css" type="text/css" media = "all"/>-->
        <link rel="stylesheet" href="../bootstrap/smoothnes/jquery-ui.css" type="text/css" media = "all"/>
        <link rel="stylesheet" href="../bootstrap/smoothnes/theme.css" type="text/css" media = "all"/>

        <link rel="stylesheet" href="../bootstrap/css/metisMenu.css" type="text/css" media = "all"/>
        <link rel="stylesheet" href="../bootstrap/css/metisMenudemomini.css" type="text/css" media = "all"/>

        <link rel="stylesheet" href="../bootstrap/font-awesome/css/font-awesome.css" type="text/css" media = "all"/>

        <link rel="stylesheet" href="../bootstrap/css/fullcalendar.css" type="text/css" media = "all"/>

        <link rel="stylesheet" href="../bootstrap/css/mymain.css" type="text/css" media = "all"/>



        <script type="text/javascript" src="../bootstrap/js/jquery-2.1.4.min.js"></script>

        <script type="text/javascript" src="../bootstrap/js/jquery.form.js"></script>

        <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>	

        <script type="text/javascript" src="../bootstrap/js/jquery-ui.js"></script>

        <script type="text/javascript" src="../bootstrap/js/metisMenu.js"></script>

        <script type="text/javascript" src="../bootstrap/js/jquery.cycle.all.js"></script>

        <script type="text/javascript" src="../bootstrap/js/moment.min.js"></script>
        <script type="text/javascript" src="../bootstrap/js/fullcalendar.js"></script>
        <script type="text/javascript" src="../bootstrap/js/my_callender_js.js"></script>

        <script type="text/javascript" src="../bootstrap/js/mymain.js"></script>
        <script type="text/javascript" src="../bootstrap/js/db.js"></script>


        <title>ILTS- <?php
            require_once ("../../include/functions.php");
            echo give_title()
            ?></title>
    </head>
    <body style="background:#F7F7F7;">
        <?php

        function confirm_password_chanded($table, $user_col, $session) {
//            $pwd = sha1($session);
//            $query = "SELECT $user_col FROM $table WHERE $user_col = '$session' "
//                    . " AND pwd = '$pwd'";
//            if($res=$db->select($query, NULL, NULL)==1){
//                Redirect::to("http://localhost/lima/public/mgmt/index.php?action=man_pro");
//            }
        }
        ?>
        <div id="alert_message" class="hidden alert" style=" margin: auto; width:400px; text-align: center; position: fixed; top: 30%; left: 35%; z-index: 1000;" >
            <span class="close" data-dismiss="alert">&times;</span>
            <span><strong>Failed!</strong>Impossible option.</span>
        </div>