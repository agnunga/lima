<?php
require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
Session::confirm_logged_in('cuname');
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
//require_once("../../include/user.php");
require_once("../client/client_actions.php");

(isset($_GET['rdr']) && ($_GET['rdr'] == "logout") ? Session::logout() : '');
?>
<div class="container-fluid">
    <nav class="navbar">
        <div class="navbar navbar-fixed-top" style="border-bottom: 1px solid lightgrey; background: #E7E7E7;">
            <div class="row">
                <div class="col-md-offset-0 col-md-12" style="padding-right: 35px;">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="../home/index.php">ILTS </a>
                    </div>
                    <ul class="nav navbar-nav">

                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
<!--                        <li><a href="#"><i class="fa fa-envelope"></i><div class="noti_bubble"> 20 </div></a></li>
                        <li><a href="#"><i class="fa fa-bell"></i><div class="noti_bubble"> 3 </div></a></li>-->
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?action=man_pro">
                                <?php
                                $profile_pic = '../images/thumb_nails/thumb_' . $_SESSION['cuname'] . '.png';
                                echo ((is_file($profile_pic) && getimagesize($profile_pic)['mime'] == 'image/png') ? '<i><img width="30px" height="30px" style = "border:1px solid black; border-radius:50%; margin: -8px 0 auto 0;" src="' . $profile_pic . '"></i>' : '<i class="fa fa-user fa-1x">');
                                ?>
                            </i><?php print $_SESSION['fname'] ?>&nbsp;<i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu dropdown-user" style="text-align: left;">
                        <li><a href="http://localhost/lima/public/client/index.php?action=profile"><i  class="glyphicon glyphicon-user"> </i>  User Profile </a> </li>
                        <li><a href="?rdr=logout"><i  class="glyphicon glyphicon-log-out"></i>logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</nav> 
<style>
    .active{
        background: #f2f2f2;
    }
</style>
<div class="row"><!--Create a row when the get-action is set. it has two cols, the sidebar and content-->
    <div class="col-md-offset-1 col-md-2 mngmt_sidebar " style="border-radius: 5px; border: 1px solid lightblue; padding: 0;">
        <!--menus go here for all the management divisions--> 
        <ul class="nav menu">
            <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "req_em") ? ' class="active"' : ''); ?>><a href="?action=req_em">Request Employees</a></li>
            <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "make_enq") ? ' class="active"' : ''); ?>><a href="?action=make_enq">Make enquiries</a></li> 
            <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "records") ? ' class="active"' : ''); ?>><a href="?action=records">Past Requests</a></li></ul> 
    </div><!-- the end of the right side navbar-->
    <div class="col-md-8"><!-- The right side of the navbar that contains the content of the page-->
        <?php
        if (isset($_GET['action'])) {
            //Navigate thro to bring relevant clicked link content to the content section
            if ($_GET['action'] == "req_em") {
                //Call to the request workers funtion in the client_actions files
                request_workers();
            } elseif ($_GET['action'] == "make_enq") {
                //Call to the make_enquery(); funtion in the client_actions files
                make_enquery();
                ?>
                <button id="Reques_leav" class="req_lv" style="float: left;">View past enquiries</button>
                <script>
                    $(document).on('click', '#Reques_leav', function () {
                        $('#drequest_off_n_leav').removeClass('hidden');
                        $('#Reques_leav').addClass('hidden');
                    });
                    $(document).on('click', '#hide_reques_leav', function () {
                        $('#drequest_off_n_leav').addClass('hidden');
                        $('#Reques_leav').removeClass('hidden');
                    });
                </script> 
                <div id="drequest_off_n_leav" class="hidden">
                    <!--<button id="hide_reques_leav" class="hide_req_lv"  style="float: right;">Hide Request for Off/Leave Form</button>-->
                    <?php past_enquery(); ?>
                </div>
                <?php
            } elseif ($_GET['action'] == "records") {
                //Call to the make_enquery(); funtion in the client_actions files
                clients_past_requests();
            } elseif ($_GET['action'] == "profile") {
                echo '<div class="row">';
                echo '<div class="col-md-5">';
                global $users;
                $table_name = "client";
                $user_col = "cuname";
                $pwd_col = "pwd";
                $user = $_SESSION['cuname'];
                $users->change_pwd($table_name, $user_col, $pwd_col, $user);
                echo '</div>';
                echo '<div class="col-md-5">';
                echo '<div style="margin:10px; padding:10px; max-width:350px; border-radius:10px; background:rgba(20, 50, 100, .05);">';
                echo '<h4 style="text-align: center;">Change profile picture</h4>';
                $users->add_profile_pic($_SESSION['cuname']);
                echo '</div>';
                echo '<div style="margin:10px; padding:10px; max-width:350px; border-radius:10px; background:rgba(20, 50, 100, .05);">';
                ?>
                <h4 style="text-align: center;">Remove profile picture</h4>
                <?php
                $profile_pic = '../images/thumb_nails/thumb_' . $_SESSION['cuname'] . '.png';
                echo ((is_file($profile_pic) && getimagesize($profile_pic)['mime'] == 'image/png') ? ' '
                        . '<i><img width="45px" height="45px" style = "border:1px solid black; border-radius:0%; margin: 0px 0 auto 0;"'
                        . ' src="' . $profile_pic . '"></i>&nbsp;<button class="btn btn-danger" onclick="delete_pic();">'
                        . '<i class=" fa fa-trash fa-2x"></i>'
                        . '</button>'
                        . '&nbsp;Delete current profile picture' :
                        '<h5 style="color: brown;"><i class="fa fa-user fa-1x"></i>&nbsp;&nbsp;No profile picture to delete</h5>');
                ?>
                <script>
                    function delete_pic() {
                        var pic = "<?php echo $profile_pic; ?>";
                        var current_page = "<?php echo $_SERVER['REQUEST_URI'] ?>"
                        if (confirm("Delete profile picture?")) {
                            //                                alert(pic);
                            //                                alert(current_page);
                            $.ajax({
                                method: "POST",
                                url: "../includes/delete_file.php?func=delete_file",
                                dataType: "text",
                                data: {my_file: pic},
                                success: function (data) {
                                    alert(data);
                                    window.open(current_page, "_self");
                                },
                                error: function () {
                                    alert("Delete failed: Error!");
                                }
                            });
                        }
                    }
                </script>
                <?php
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <?php
    } elseif (!isset($_GET['action'])) {//If the $_GET['action'] is not set
        ?>
        <div class="row"> <!-- A row on its own that will only appear when there is no selection in the navbar-->
            <div class="col-md-offset-1 col-md-10">
                <h3>Welcome, <?php echo $_SESSION['fname']; ?></h3>
                <?php
                $cuname = $_SESSION['cuname'];
                $query1 = " SELECT * FROM  client"
                        . " WHERE  cuname = '$cuname'";

                global $db;
                $res1 = $db->select($query1, NULL, NULL);

                if (!empty($res1)) {
                    foreach ($res1 as $result_set) {


                        $fname = $result_set['fname'];
                        $lname = $result_set['lname'];
                        $company_name = $result_set['company_name'];
                        $phone = $result_set['phone'];
                        $email = $result_set['email'];
                        $cuname = $result_set['cuname'];
                        ?>
                        <div class="">
                            <?php
                            $ppic = '../images/thumb_nails/thumb_' . $cuname . '.png';
                            if (is_file($ppic)) {
                                echo '<img src="../images/thumb_nails/thumb_' . $cuname . '.png"><br/>';
                            } else {
                                ?><i class="fa fa-user fa-3x"></i><br/><?php } ?>
                            <table>
                                <tr style="font-size: 18px; color: lightseagreen;"><td>NAME:</td><td> <?php echo $lname . '  ' . $fname ?></td></tr>
                                <tr style="font-size: 18px; color: lightseagreen;"><td>Username:</td><td> <?php echo $cuname ?></td></tr>
                                <tr style="font-size: 18px; color: lightseagreen;"><td>Phone:</td><td> <?php echo $phone ?></td></tr>
                                <tr style="font-size: 18px; color: lightseagreen;"><td>Company:</td><td> <?php echo $company_name ?></td></tr>
                            </table>

                        </div>

                        <?php
                    }
                } else {
                    echo 'Not allocated.';
                }
                ?>
            </div><!-- The end of A row on its own that will only appear when there is no selection in the navbar-->
        </div>
        <?php
    }
    ?>
</div>
<!--<script> faddingAllert("#alert_message","alert-warning", "Close the sshiit nowClose the sshiit nowClose the sshiit nowClose the sshiit nowClose the sshiit nowClose the sshiit now");</script>-->
</div>
