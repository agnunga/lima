<?php
require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
Session::confirm_logged_in('employee_no');
include_once ("../includes/header.php");
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../employee/employee_actions.php");

(isset($_GET['rdr']) && ($_GET['rdr'] == "logout") ? Session::logout() : '');

function em_proile() {
    echo '<div class="row litl_tab_nav">';
    echo '<a id=""  style="border:1px solid black; border-radius:4px 0 0 4px; margin: 0 -2px 0 10px; padding:1px; text-decoration:none;" href="http://localhost/lima/public/employee/index.php?content=profile&sub=qual"> Qualifications </a>';
    echo '<a id=""  style="border:1px solid black; margin:0px; padding:1px;" href="http://localhost/lima/public/employee/index.php?content=profile&sub=pic"> Profile pic</a> ';
    echo '<a id=""  style="border:1px solid black; border-radius:0 4px 4px 0; margin:-5px; padding:1px;" href="http://localhost/lima/public/employee/index.php?content=profile&sub=pwd"> Change password</a> ';
//                    echo '<a id=""  style="border:1px solid black;" href="http://localhost/lima/public/employee/index.php?content=profile&sub=cont"> Contact info </a>';
//                    echo '<a id=""  style="border:1px solid black;" href="http://localhost/lima/public/employee/index.php?content=profile&sub=res"> Residence </a>';

    if (isset($_GET['sub'])) {
        switch (($_GET['sub'])) {
            case "qual":

//                                echo 'Qual';
                add_qualifications();
                break;
            case 'pic':

//                                echo 'Ppic';
                global $users;
                echo '<div style="margin:10px; padding:10px; max-width:350px; border-radius:10px; background:rgba(20, 50, 100, .05);">';
                echo '<h4 style="text-align: center;">Change profile picture</h4>';
                $users->add_profile_pic($_SESSION['employee_no']);
                echo '</div>';
                echo '<div style="margin:10px; padding:10px; max-width:350px; border-radius:10px; background:rgba(20, 50, 100, .05);">';
                ?>
                <h4 style="text-align: center;">Remove profile picture</h4>
                <?php
                $profile_pic = '../images/thumb_nails/thumb_' . $_SESSION['employee_no'] . '.png';
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

                break;
            case 'pwd':

//                                echo 'Pwd';
                global $users;
                $table_name = "employee";
                $user_col = "employee_no";
                $pwd_col = "pwd";
                $user = $_SESSION['employee_no'];

                $users->change_pwd($table_name, $user_col, $pwd_col, $user);
                break;
            case "cont":

                echo 'Cont';
                break;
            case "res":

                echo 'Residence';
                break;
            default :
        }
    } else {
        ?>
        <h4>My details.</h4>

        <?PHP
        $emp_no = $_SESSION['employee_no'];
//                        `client_id`, ``, `end_date`, `allocated_by`, `state`, `last_updated`, `recommendation`
        $query1 = " SELECT emp.employee_no, emp.fname, emp.lname ,emp.phone,"
                . " alo.id,  alo.start_date,  alo.end_date,  cli.company_name,  alo.recommendation "
                . " FROM allocations alo, employee emp,  client cli"
//                                . " WHERE alo.employee_no = '$emp_no'"
                . " WHERE emp.employee_no = $emp_no"
                . " AND cli.cuname = alo.client_id"
                . " AND alo.state = '1'"
                . " AND emp.status = '1'"
                . " AND alo.end_date > CURRENT_DATE "
                . " LIMIT 1";

        $query2 = " SELECT emp.employee_no, emp.fname, emp.lname ,emp.phone,"
                . " alo.id,  alo.start_date,  alo.end_date,  cli.company_name,  alo.recommendation "
                . " FROM allocations alo, employee emp,  client cli"
                . " WHERE emp.employee_no = $emp_no"
                . " LIMIT 1";

        global $db;
        $res1 = $db->select($query1, NULL, NULL);

        if (!empty($res1)) {
            foreach ($res1 as $result_set) {

                $alo_id = $result_set['id'];
                $emp_no = $result_set['employee_no'];
                $fname = $result_set['fname'];
                $lname = $result_set['lname']; //company_name
                $company_name = $result_set['company_name'];
                $recommendation = $result_set['recommendation'];
                $start_date = $result_set['start_date'];
                $end_date = $result_set['end_date'];
                $phone = $result_set['phone'];
                ?>
                <div class="">
                    <?php
                    $ppic = '../images/thumb_nails/thumb_' . $emp_no . '.png';
                    if (is_file($ppic)) {
                        echo '<img src="../images/thumb_nails/thumb_' . $emp_no . '.png"><br/>';
                    } else {
                        ?><i class="fa fa-user fa-3x"></i><br/><?php } ?>
                    <table>
                        <tr style="font-size: 18px; color: lightseagreen;"><td>Name:</td><td> <?php echo $lname . '  ' . $fname ?></td></tr>
                        <tr style="font-size: 18px; color: lightseagreen;"><td>Phone:&nbsp;&nbsp;</td><td> <?php echo $phone ?></td></tr>
                    </table>
                    <h4>My current working station.</h4>
                    <table>
                        <tr style="font-size: 18px; color: lightseagreen;"><td>Station : </td><td><?php echo $company_name ?></td></tr>
                        <tr style="font-size: 18px; color: lightseagreen;"><td>Start Date</td><td> <?php echo $start_date ?></td></tr>
                        <tr style="font-size: 18px; color: lightseagreen;"><td>End date:</td><td> <?php echo $end_date ?></td></tr>
                        <tr style="font-size: 18px; color: lightseagreen;"><td>Recommendation: </td><td> <?php echo $recommendation ?></td></tr>
                    </table>
                </div>

                <?php
            }
        } else {
            echo 'Not allocated.';
            $res1 = $db->select($query2, NULL, NULL);

            if (!empty($res1)) {
                foreach ($res1 as $result_set) {

                    $alo_id = $result_set['id'];
                    $emp_no = $result_set['employee_no'];
                    $fname = $result_set['fname'];
                    $lname = $result_set['lname']; //company_name
                    $company_name = $result_set['company_name'];
                    $recommendation = $result_set['recommendation'];
                    $start_date = $result_set['start_date'];
                    $end_date = $result_set['end_date'];
                    $phone = $result_set['phone'];
                    ?>
                    <div class="">
                        <?php
                        $ppic = '../images/thumb_nails/thumb_' . $emp_no . '.png';
                        if (is_file($ppic)) {
                            echo '<img src="../images/thumb_nails/thumb_' . $emp_no . '.png"><br/>';
                        } else {
                            ?><i class="fa fa-user fa-3x"></i><br/><?php } ?>
                        <table>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Name:</td><td> <?php echo $lname . '  ' . $fname ?></td></tr>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Phone:</td><td> <?php echo $phone ?></td></tr>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Email:</td><td> <?php echo $phone ?></td></tr>
                        </table>
                    </div>

                    <?php
                }
            }
        }
    }
}
?>
<div class="container-fluid">
    <nav class="navbar">
        <div class="navbar navbar-fixed-top" style="border-bottom: 1px solid lightgrey; background: #E7E7E7;">
            <div class="row">
                <div class="col-md-offset-1 col-md-10">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="../home/index.php">ILTS </a>
                    </div>
                    <ul class="nav navbar-nav">
                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
                        <!--<li><a href="#"><i class="fa fa-envelope"></i><div class="noti_bubble"> 20 </div></a></li>-->
                        <!--<li><a href="#"><i class="fa fa-bell"></i><div class="noti_bubble"> 3 </div></a></li>-->
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?action=man_pro">
                                <?php
                                $profile_pic = '../images/thumb_nails/thumb_' . $_SESSION['employee_no'] . '.png';
                                echo ((is_file($profile_pic) && getimagesize($profile_pic)['mime'] == 'image/png') ? '<i><img width="30px" height="30px" style = "border:1px solid black; border-radius:50%; margin: -8px 0 auto 0;" src="' . $profile_pic . '"></i>' : '<i class="fa fa-user fa-1x">');
                                ?>
                            </i><?php print $_SESSION['fname'] ?>&nbsp;<i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu dropdown-user" style="text-align: left;">
                        <li><a href="http://localhost/lima/public/employee/index.php?content=profile"><i  class="glyphicon glyphicon-user"> </i>  User Profile </a> </li>
                        <li><a href="?rdr=logout"><i  class="glyphicon glyphicon-log-out"></i>logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</nav> 
<script type="text/javascript">
    function show_notification() {
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
<div class="row">
    <div class="col-md-offset-1 col-md-2" style="border-radius: 5px; border: 1px solid lightblue; padding: 0;">
        <ul class="nav menu">
            <li<?php echo ((isset($_GET['content']) && $_GET['content'] == "profile") ? ' class="active"' : ''); ?>><a href="?content=profile">My profile<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>
            <li<?php echo ((isset($_GET['content']) && $_GET['content'] == "view") ? ' class="active"' : ''); ?>><a href="?content=view"> Job adverts<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>
<!--            <li<?php echo ((isset($_GET['content']) && $_GET['content'] == "duty") ? ' class="active"' : ''); ?>><a href="?content=duty">Duty roster<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>-->
            <li<?php echo ((isset($_GET['content']) && $_GET['content'] == "leave") ? ' class="active"' : ''); ?>><a href="?content=leave"> Leave and offs<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>
            <!--<li<?php echo ((isset($_GET['content']) && $_GET['content'] == "salary") ? ' class="active"' : ''); ?>><a href="?content=salary">Salary and allowances<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>-->
            <!--<li<?php echo ((isset($_GET['content']) && $_GET['content'] == "events") ? ' class="active"' : ''); ?>><a href="?content=events">Events<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>-->
            <li<?php echo ((isset($_GET['content']) && $_GET['content'] == "enquiry") ? ' class="active"' : ''); ?>><a href="?content=enquiry">Enquires<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>
<!--            <li<?php echo ((isset($_GET['content']) && $_GET['content'] == "discipline") ? ' class="active"' : ''); ?>><a href="?content=discipline">Discipline<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span> </a></li>-->
        </ul>

    </div>
    <div class="col-md-8" style="margin: 10px;">
        <style>
            .litl_tab_nav a{
                background: rgba(00, 00, 255, .05);
            }
            .litl_tab_nav a:hover{
                background: rgba(00, 00, 255, .15);
            }
        </style>
        <?php
//Get content as per the clicked link that sets the url get content
        if (isset($_GET['content'])) {

            switch ($_GET['content']) {

                case "profile":

//                    echo 'My profile.';

                    em_proile();

                    break;
                case "view" :

//                    echo 'Advertised jobs.<br/>';
                    if (isset($_GET['aply'])) {

                        $id = $_GET['aply'];
                        apply_job();
                    }
                    view_job_adverts();
                    break;
                case "duty":

//                    echo 'Duty roster.';
                    echo ' <!--this is the duty roster, in a calender like presentation-->';
                    echo '<div id="calendar" style = "max-width:750px;"></div>';
                    break;
                case "leave":
                    ?>
                    <button id="Reques_leav" class="req_lv" style="float: right;">Request for Off/Leave Form</button>
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
                    <?php
                    echo '<div id="drequest_off_n_leav" class="hidden">';
                    echo '<button id="hide_reques_leav" class="hide_req_lv"  style="float: right;">Hide Request for Off/Leave Form</button>';
                    require("../forms/request_off_n_leave_form.php");
                    echo '</div>';
                    echo '<div id="dview_leav"';
                    echo view_leave_info();
                    echo '</div>';
                    break;
                case "salary":

                    echo 'Salary and allowances.';
                    break;
                case "enquiry":

//                    echo 'Make Enquiries.';
                    make_enquery();
                    ?>
                    <button id="Reques_leav" class="req_lv" style="float: left;">Past Enquiries</button>
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
                    break;
                case "events":
                    ?>
                    <h2 style="text-align: center; text-decoration: underline;margin-top: -20px;">&nbsp;All Events, Meetings, Seminars&nbsp;</h2>
                    <div id="calendar" style = "max-width:100%;"></div>   
                    <?php
                    break;
                case "discipline":

                    echo 'Misconduct records.';
                    break;
                case "notifications":

                    echo 'Notifications.';
                    break;
                default :
                    echo 'No content selected';
            }
        } else {
            em_proile();
            ?>
            <!--            <h2 style="text-align: center; text-decoration: underline;margin-top: -20px;">&nbsp;All Events, Meetings, Seminars&nbsp;</h2>
                        <div id="calendar" style = "max-width:100%;"></div>   -->
            <?php
        }
        ?>
    </div>
</div>
</div> 

<?php
show_notifications();

function show_notifications() {
    
}
