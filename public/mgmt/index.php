<?php
require_once ("../../include/config.php");
require_once ("../../include/redirect.php");
require_once ("../../include/database.php");
require_once ("../../include/session.php");
Session::confirm_logged_in('uname');
include_once ("../includes/header.php");
Session::confirm_password_chanded('mngmt', 'uname', $_SESSION['uname']);
require_once ("../../include/user.php");
include_once ("../mgmt/mgmt_actions.php");

function count_notifications($s) {
    global $mysqli;
    $query = "SELECT COUNT( id) FROM off_duty_requests WHERE response='p'";
    $query1 = "SELECT COUNT( id) FROM client_requests WHERE response='p'";
    $query0 = "SELECT COUNT( id) FROM client WHERE status='0'";
    $querye = "SELECT COUNT( id) FROM enquiries WHERE response=''";

    $result1 = $mysqli->query($query1);
    while ($resultset1 = mysqli_fetch_row($result1)) {
        $p_client_requests = $resultset1['0'];
//        echo' ' . $client_requests;
    }
    $result = $mysqli->query($query);
    while ($resultset = mysqli_fetch_row($result)) {
        $p_off_duty_requests = $resultset['0'];
//        echo' ' . $off_duty_requests;
    }
    $result0 = $mysqli->query($query0);
    while ($resultset0 = mysqli_fetch_row($result0)) {
        $p_client = $resultset0['0'];
//        echo' ' . $client;
    }
    $resulte = $mysqli->query($querye);
    while ($resultsete = mysqli_fetch_row($resulte)) {
        $p_enquiries = $resultsete['0'];
//        echo' ' . $enquiries;
    }

    $p_total = $p_client_requests + $p_enquiries + $p_off_duty_requests + $p_client;
//    echo ' ' . $total_not;

    if ($s == 't') {
        return $p_total;
    } elseif ($s == 'r') {
        return $p_client_requests;
    } elseif ($s == 'e') {
        return $p_enquiries;
    } elseif ($s == 'o') {
        return $p_off_duty_requests;
    } elseif ($s == 'c') {
        return $p_client;
    }
}

(isset($_GET['rdr']) && ($_GET['rdr'] == "logout") ? Session::logout() : '');
?>
<div class="container-fluid">
    <nav class="navbar">
        <div class="navbar navbar-fixed-top" style="border-bottom: 1px solid lightgrey; background: #1ABB9C;">
            <!--    E7E7E7-->
            <div class="row">
                <div class="col-md-offset-0 col-md-12"style="padding-right:29px;">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="../home/index.php">ILTS </a>
                    </div>
                    <ul class="nav navbar-nav">
                        <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "man_jnr") ? ' class="active"' : ''); ?> ><a href="?action=man_jnr">Jobs and recruitment</a></li>

                        <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "man_cli") ? ' class="active"' : ''); ?> ><a href="?action=man_cli">Manage Clients</a></li>
                        <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "man_emp") ? ' class="active"' : ''); ?> ><a href="?action=man_emp">Manage Employees</a></li>
                        <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "man_ate") ? ' class="active"' : ''); ?> ><a href="?action=man_ate">Attendance</a></li>

                        <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "man_alo") ? ' class="active"' : ''); ?> ><a href="?action=man_alo">Allocations</a></li>

                        <li <?php echo ((isset($_GET['action']) && $_GET['action'] == "man_rep") ? ' class="active"' : ''); ?> ><a href="?action=man_rep">Enquiries</a></li>
                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
                        <li><a a class="dropdown-toggle" data-toggle="dropdown" href="?action=notif">Pending<i class="fa fa-bell"></i><div class="noti_bubble"> <?php echo count_notifications('t'); ?> </div></a>
                            <ul class="dropdown-menu dropdown-user" style="text-align: left;">
                                <li ><a href="http://localhost/lima/public/mgmt/index.php?action=man_cli&sub=req"> Client's Requests.<span class="float_right"> <i  class="glyphicon glyphicon-info-sign"> <div class="noti_bubble_sub"> <?php echo count_notifications('r'); ?> </div></i></span></a> </li>
                                <li><a href="http://localhost/lima/public/mgmt/index.php?action=man_rep&sub=em_enq"> Enquiries.<span class="float_right"> <i  class="glyphicon glyphicon-info-sign"> <div class="noti_bubble_sub"> <?php echo count_notifications('e'); ?> </div></i></span></a> </li>
                                <li><a href="http://localhost/lima/public/mgmt/index.php?action=man_emp&sub=onl"> off/leave Requests.<span class="float_right"> <i  class="glyphicon glyphicon-info-sign"> <div class="noti_bubble_sub"> <?php echo count_notifications('o'); ?></div></i></span></a> </li>
                                <li><a href="http://localhost/lima/public/mgmt/index.php?action=man_rep&sub=req_b_cli"> requests to be client.<span class="float_right"> <i  class="glyphicon glyphicon-info-sign"> <div class="noti_bubble_sub"> <?php echo count_notifications('c'); ?></div></i></span></a> </li>
                            </ul>
                        </li>
                                <!--<li><a href="#"><i class="fa fa-envelope"></i><div class="noti_bubble"> 20 </div></a></li>-->
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="?action=man_pro">
                                <?php
                                $profile_pic = '../images/thumb_nails/thumb_' . $_SESSION['uname'] . '.png';
                                echo ((is_file($profile_pic) && getimagesize($profile_pic)['mime'] == 'image/png') ? '<i><img width="30px" height="30px" style = "border:1px solid black; border-radius:50%; margin: -8px 0 auto 0;" src="' . $profile_pic . '"></i>' : '<i class="fa fa-user fa-1x"></i>');
                                ?>
                            </i><?php print $_SESSION['fname']; ?>&nbsp;<i class="fa fa-caret-down"></i></a>
                    <ul class="dropdown-menu dropdown-user" style="text-align: left;">
                        <li><a href="http://localhost/lima/public/mgmt/index.php?action=man_pro"><i  class="glyphicon glyphicon-user"> </i>  User Profile </a> </li>
                        <li><a href="?rdr=logout"><i  class="glyphicon glyphicon-log-out"></i>logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</nav> 
<?php
if (isset($_GET['action'])) {
    ?> 
    <style>
        .active{
            background: #f2f2f2;
        }
    </style>
    <div class="row" style="padding: 0 10px 0 10px;">
        <div class="col-md-offset-0 col-md-2 mngmt_sidebar " style="border-radius: 5px; border: 1px solid lightblue; padding: 0;">
            <!--menus go here for all the management divisions-->
            <?php
            if ($_GET['action'] == 'man_cli') {
                echo '<h4 style="text-align:center;">Clients</h4>';
                ?>
                <!--the menu for manage clients and -->
                <ul class="nav menu">
                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'view') ? 'class = "active"' : ''); ?>><a href="?action=man_cli&sub=view">View client<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'add') ? 'class = "active"' : ''); ?>><a href="?action=man_cli&sub=add">Add client<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'req') ? 'class = "active"' : ''); ?>><a href="?action=man_cli&sub=req">Client Requests<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'non_req') ? 'class = "active"' : ''); ?>><a href="?action=man_cli&sub=non_req">Non-client Requests<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                </ul>

                <?php
            } elseif ($_GET['action'] == 'man_emp') {
                echo '<h4 style="text-align:center;"> Employees</h4>';
                ?>
                <ul class="nav menu">
                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'view') ? 'class = "active"' : ''); ?>><a href="?action=man_emp&sub=view">View Employee<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'add') ? 'class = "active"' : ''); ?>><a href="?action=man_emp&sub=add">Add employee<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'onl') ? 'class = "active"' : ''); ?>><a href="?action=man_emp&sub=onl">Off and Leaves<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
        <!--                    <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'comm') ? 'class = "active"' : ''); ?>><a href="?action=man_emp&sub=comm">Communicate<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                </ul>-->

                    <?php
                } elseif ($_GET['action'] == 'man_ate') {
                    echo '<h4 style="text-align:center;"> Attendance</h4>';
                    ?>
                    <ul class="nav menu">
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'chk_i_o') ? 'class = "active"' : ''); ?>><a href="?action=man_ate&sub=chk_i_o">Check in/out<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'view') ? 'class = "active"' : ''); ?>><a href="?action=man_ate&sub=view">View Attendance<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'search') ? 'class = "active"' : ''); ?>><a href="?action=man_ate&sub=search">Search attendance<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    </ul>

                    <?php
                } elseif ($_GET['action'] == 'man_jnr') {
                    echo '<h4 style="text-align:center;">Jobs and recruitments</h4>';
                    ?>
                    <ul class="nav menu">
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'search_qual') ? 'class = "active"' : ''); ?>><a href="?action=man_jnr&sub=search_qual">Search qualification<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'view') ? 'class = "active"' : ''); ?>><a href="?action=man_jnr&sub=view">View job adverts<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'add') ? 'class = "active"' : ''); ?>><a href="?action=man_jnr&sub=add">Add job advert<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'aplcnt') ? 'class = "active"' : ''); ?>><a href="?action=man_jnr&sub=aplcnt">View all applicants<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    </ul>

                    <?php
                } elseif ($_GET['action'] == 'man_rep') {
                    echo '<h4 style="text-align:center;">Enquiries</h4>';
                    ?>
                    <ul class="nav menu">
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'cl_enq') ? 'class = "active"' : ''); ?>><a href="?action=man_rep&sub=cl_enq">Clients' enquiries<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'em_enq') ? 'class = "active"' : ''); ?>><a href="?action=man_rep&sub=em_enq">Employees' enquiries<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'req_b_cli') ? 'class = "active"' : ''); ?>><a href="?action=man_rep&sub=req_b_cli">Requests to be client<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'cont_us_m') ? 'class = "active"' : ''); ?>><a href="?action=man_rep&sub=cont_us_m">Contact Us Messages<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    </ul>
                    <!---->

                    <?php
                } elseif ($_GET['action'] == 'man_pro') {
//                echo '<h4 style="text-align:center;">Manager profile</h4>';
                    ?>
                    <!--                <ul class="nav menu">
                                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'view') ? 'class = "active"' : ''); ?>><a href="?action=man_pro&sub=view">My profile<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'edit') ? 'class = "active"' : ''); ?>><a href="?action=man_pro&sub=edit">Edit<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'log') ? 'class = "active"' : ''); ?>><a href="?action=man_pro&sub=log">Logout<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                                    </ul>-->
                    <?php
                } elseif ($_GET['action'] == 'man_alo') {
//                echo '<h4 style="text-align:center;">Manager profile</h4>';
                    ?>
                    <ul class="nav menu">
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'alo') ? 'class = "active"' : ''); ?>><a href="?action=man_alo&sub=alo">Allocate Employees<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                        <li <?php echo ((isset($_GET['sub']) && $_GET['sub'] == 'view') ? 'class = "active"' : ''); ?>><a href="?action=man_alo&sub=view">Allocated Employees<span class="fa fa-arrow-circle-o-right my_menu_arrow_icon"></span></a></li>
                    </ul>
                    <?php
                } else {
                    echo 'Wrong option';
                }
                ?> 
        </div><!--The content is displayed in this div when a link in the side bar is clicked-->
        <div class="col-md-10 mngmt_content"><!--the content of the page is ent<irely in this div-->
            <?php
            if ($_GET['action'] == 'man_cli') {
                if (isset($_GET['sub'])) {
                    switch ($_GET['sub']) {
                        case 'view':

//                                        echo 'All clients<br/>';
                            (isset($_GET['e_c']) ? edit_client() : '');
                            echo view_clients('1');
                            break;
                        case 'add':

//                                        echo 'Add a client<br/>';
                            add_client();
                            break;
                        case 'req':

                            echo '<h3 style="text-align: center;">Client requests</h3>';
                            (isset($_GET['resp']) ? respond_to_client() : '');
                            ?>
                            <a style="float: right;" href="http://localhost/lima/public/mgmt/index.php?action=man_cli&sub=req&responded=yes"><button>Responded to requests</button></a>
                            <?php
                            (isset($_GET['responded']) ? view_clients_requests("!=") : view_clients_requests('='));
                            break;

                        case 'non_req':

                            echo '<h3 style="text-align: center;">Non-Client requests</h3>';
                            (isset($_GET['non_resp']) ? view_non_clients_requests('p') : '');
                            ?>
                            <a style="float: right;" href="http://localhost/lima/public/mgmt/index.php?action=man_cli&sub=non_req&responded=y"><button>Responded to requests</button></a>
                            <?php
                            (isset($_GET['responded']) && $_GET['responded'] === 'y' ? view_non_clients_requests('y') : view_non_clients_requests('p'));
                            break;

                        default :

                            echo 'Incorrect url<br/>';
                    }
                } elseif (isset($_GET['cli'])) {
                    $cli_id = $_GET['cli'];
                    echo 'ID ' . $cli_id;
                    $query = "SELECT * FROM `client` WHERE id='$cli_id'";
                    global $db;
                    $res = $db->select($query, NULL, NULL);
//                    print_r($res);
                    foreach ($res as $row) {
                        $id = $row['id'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $company_name = $row['company_name'];
                        $location = $row['location'];
                        $status = $row['status'];
                        $natid = $row['natid'];
                        $cuname = $row['cuname'];
                        echo ' ' . $cuname;
                    }
                    ?>
                    <nav class="navbar" >
                        <ul class="nav navbar-nav">
                            <li><a onclick="view_allocations('<?php echo $cli_id ?>', '<?php echo $cuname ?>')">View Current allocation</a></li>
                            <li><a onclick="view_past_allocations('<?php echo $cli_id ?>', '<?php echo $cuname ?>')"> Previous allocation </a></li>
                            <!--<li><a onclick="view_requests('<?php echo $cli_id ?>', '<?php echo $cuname ?>')">View Requests</a></li>-->
                        </ul>
                    </nav>
                    <div id="cli_content">
                        <table>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Name:</td><td> <?php echo $lname . '  ' . $fname ?></td></tr>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Phone:&nbsp;&nbsp;</td><td> <?php echo $phone ?></td></tr>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Enail:</td><td> <?php echo $email ?></td></tr>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Location:&nbsp;&nbsp;</td><td> <?php echo $location ?></td></tr>
                            <tr style="font-size: 18px; color: lightseagreen;"><td>Username:</td><td> <?php echo $cuname ?></td></tr>

                            <tr style="font-size: 18px; color: lightseagreen;"><td>Station : </td><td><?php echo $company_name ?></td></tr>
                        </table>
                    </div>
                    <script>
                        function view_allocations(id) {
            //                            alert("view_allocations" + id);
                            $.ajax({
                                url: "man_cli.php?act=c_alo",
                                method: "POST",
                                data: {id: id},
                                dataType: "text",
                                success: function (data) {
            //                                    alert(data);
                                    $('#cli_content').empty().append(data);
                                }
                            });
                        }
                        function view_past_allocations(id, cuname) {
            //                            alert("view_past_allocations" + id + cuname);
                            $.ajax({
                                url: "man_cli.php?act=p_alo",
                                method: "POST",
                                data: {id: id, cuname: cuname},
                                dataType: "text",
                                success: function (data) {
            //                                    alert(data);
                                    $('#cli_content').empty().append(data);
                                }
                            });
                        }
                        function view_requests(id) {
            //                            alert("view_requests" + id);
                            $.ajax({
                                url: "man_cli.php?act=v_req",
                                method: "POST",
                                data: {id: id},
                                dataType: "text",
                                success: function (data) {
            //                                    alert(data);
                                    $('#cli_content').empty().append(data);
                                }
                            });
                        }
                    </script>
                    <?php
                } else {
                    ?>
                    <style>
                        .f_client_d{
                            width: 180px; margin: 0 10px 20px 10px; padding: 10px;  height: 220px !important; overflow-y: auto;  background: rgba(100,20,80,.015); border: 1px solid lightblue; border-radius: 0px;
                        }
                    </style>
                    <?php
                    global $db;
                    $output = '<div style = "border: 1px solid lightgrey; border-radius:5px;">';
                    $query = "SELECT id, fname, lname, email, phone, company_name, location, status, natid, cuname FROM client WHERE status=? ORDER BY id DESC";

                    $state = 1;
                    $type_array = array('s');
                    $data_array = array($state);
                    $res = $db->select($query, $type_array, $data_array);
                    if (!empty($res)) {
                        echo '<div class="row">';
                        $no = 0;
                        foreach ($res as $row) {
                            $no++;
                            $id = $row['id'];
                            $fname = $row['fname'];
                            $lname = $row['lname'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $company_name = $row['company_name'];
                            $location = $row['location'];
                            $status = $row['status'];
                            $natid = $row['natid'];
                            $cuname = $row['cuname'];
                            ?>
                            <div class="f_client_d col-xs-1" style="">
                                <a href="http://localhost/lima/public/mgmt/index.php?action=man_cli&cli=<?php echo $id; ?>" style="text-align: center;"><div style="width:150px; height: 55px; background: rgba(200,150,80,.0);">
                                        <?php
                                        $profile_pic = '../images/thumb_nails/thumb_' . $row['cuname'] . '.png';
                                        echo ((is_file($profile_pic) && getimagesize($profile_pic)['mime'] == 'image/png') ? '<img width="55px" style = "border:1px solid black;" src="' . $profile_pic . '">' : '<i class="fa fa-user fa-3x"></i>');
                                        ?>
                                        <!--<i class="fa fa-user fa-5x" style="width:100%;"></i>-->
                                    </div></a>
                                <div><?php echo $company_name; ?></div>
                                <div><?php echo 'Name:' . $fname . ' ' . $lname . '<br/>Phone: ' . $phone . ' '; ?></div>
                                <div style="background: rgba(255,255,255,.95); z-index:10000; position: absolute; padding:5px; height:35px; width:100%; bottom: 0; left: 0; text-align: right;">
                                    <a href="http://localhost/lima/public/mgmt/index.php?action=man_cli&cli=<?php echo $id; ?>">More&nbsp;&nbsp;<i class="fa fa-arrow-circle-o-right"></i></a></div>
                            </div>
                            <?php
                        }
                        echo '</div>';
                    }
                }
            } elseif ($_GET['action'] == 'man_emp') {
                if (isset($_GET['sub'])) {
                    switch ($_GET['sub']) {
                        case "view":

                            (isset($_GET['edit_emp']) ? edit_employee() : '');
                            (isset($_GET['remove_emp']) ? remove_employee('0') : '');
                            ?>
                            <a href=""></a>
                            <?php
                            if ($_SESSION['uname'] == 'admin') {
                                ?> 
                                <button id="view_mgmt" onclick="" class="btn btn-sm btn-success"<i class="fa fa-user"> </i> View management</button>
                                <?php
                            }
                            ?>
                            <script>
                                $(document).on('click', '#view_mgmt', function view_mgmt() {
                                    $.ajax({
                                        url: "man_mgmt.php?act=view",
                                        method: "POST",
                                        data: {},
                                        dataType: "text",
                                        success: function (data) {
                                            //                                            alert(data);
                                            $(".mngmt_content").empty().append(data);
                                            //                $('#success_alert_message').append(data);
                                            $('#id_brief_description').val('');
                                            //                $('#success_alert_message').removeClass('hidden');
                                            //                faddingAllert('#success_alert_message');
                                        }
                                    });
                                });
                                function delete_man(id) {
                                    if (confirm(' delete_man ' + id)) {
                                        $.ajax({
                                            url: "man_mgmt.php?act=del",
                                            method: "POST",
                                            data: {id: id},
                                            dataType: "text",
                                            success: function (data) {
                                                //                                                alert(data);
                                                $('#success_alert_message').removeClass('hidden');
                                                faddingAllert('#success_alert_message');
                                            }
                                        });
                                    }
                                }
                            </script>



                            <?php
                            echo view_employees('1');
                            break;
                        case "add":

//                                        echo 'Add employee';
                            if ($_SESSION['uname'] == 'admin') {
                                require '../modals/add_mngmt_modal.php';
                                ?> 
                                <button onclick="" class="btn btn-sm btn-success"
                                        data-toggle="modal" data-target="#add_mgmt_modal"><i class="fa fa-user"> </i> Add management
                                </button>

                                <?php
                            }
                            ?>

                            <?php
                            add_employee();
                            break;
                        case "onl":

                            echo '<h3 style="text-align: center;">Respond to off and leave requests</h3>';
                            off_n_leaaves();
                            break;
                        case "comm":

                            echo 'Communicate to employee employee';
                            break;

                        default :

                            echo 'Incorrect url<br/>';
                    }
                } else {
                    add_employee();
                }
            } elseif ($_GET['action'] == 'man_ate') {
                if (isset($_GET['sub'])) {
                    switch ($_GET['sub']) {
                        case 'chk_i_o':

                            echo 'Check in Employees when they report<br/>';
                            emp_checkin();
                            emp_checkout();
                            break;

                        case 'view':

                            echo 'Search attendance by date, month, employee';
                            break;
                        default :

                            echo 'Incorrect url<br/>';
                    }
                } else {

                    emp_checkin();
                    emp_checkout();
                }
            } elseif ($_GET['action'] == 'man_jnr') {
                if (isset($_GET['sub'])) {
                    switch ($_GET['sub']) {
                        case 'search_qual':
                            echo '<div id="qual_search_form" class="row">';
                            require ("../forms/search_form.php");
                            echo '</div>';
                            echo '<div id="qual_search_res"  class="row">';
                            search_qualifications();
                            echo '</div>';
                            break;
                        case 'view':

//                                        echo 'Viw job adverts';
                            (isset($_GET['edit']) ? edit_job_advert() : '');
                            (isset($_GET['v_aplcnts']) ? view_applicants() : '');
                            view_job_adverts();
                            view_job_adverts_applicants();
                            break;
                        case 'add':

//                                        echo 'Add job adverts';
                            advertise_job();
                            break;
                        case 'aplcnt':
                            view_all_applicants();
                            break;
                        default :

                            echo 'Incorrect url<br/>';
                            view_job_adverts();
                    }
                } else {
                    ?>
                    <!--<a href="">View Applicants</a>-->
                    <h4 style="text-align: center;">Closed job advertisements</h4>
                    <?php
                    global $db;
                    $query = "SELECT id, position, number_needed, apply_before, interview_date, time_posted FROM `job_advert`"
                            . " WHERE apply_before < CURRENT_DATE"
                            . " AND interview_date > CURRENT_DATE"
                            . " ORDER BY interview_date DESC"
                            . " LIMIT 20";

                    $res = $db->select($query, NULL, NULL);
//
//                  
                    ?>
                    <div style="border:1px solid black;">
                        <table class="table table table-hover"> <thead> <tr> 
                                    <th>#</th><th>Position</th><th>Advertised On</th> 
                                    <th>Application deadline</th> <th>Interview date</th> <th>Take Action</th>

                                </tr> </thead> <tbody class = "">
                                <?php
                                if (!empty($res)) {
                                    $no = 0;
                                    foreach ($res as $row) {
                                        $no++;
                                        echo '<tr class="info"   id="sms_s' . $no . '">';
                                        echo '<td>' . $no . '</td>';
                                        echo '<td>' . $row['position'] . '</td>';
                                        echo '<td>' . $row['time_posted'] . '</td>';
                                        echo '<td>' . $row['apply_before'] . '</td>';
                                        echo '<td>' . $row['interview_date'] . '</td>';
                                        echo '<td>';
                                        ?>

                            <a href="?ja_id=<?php echo $row['id']; ?>"<button class="btn btn-xs btn-success" onclick="send_name_n_loc('<?php echo $row['natid']; ?>', '<?php echo $row['full_name']; ?>');"><i class="fa fa-eye" style="color: blue;"></i>&nbsp;Applicants</button> </a>
                                    <button onclick="send_name_n_loc('<?php echo $row['natid']; ?>', '<?php echo $row['full_name']; ?>');"><i class="fa fa-trash-o" style="color: red;">&nbsp;Delete</i></button> </td>


                                    <?php
                                    echo '</tr>';
                                }
                            }
                            ?></div>
                </div>
                <?php
            }
        } elseif ($_GET['action'] == 'man_rep') {
            if (isset($_GET['sub'])) {
                switch ($_GET['sub']) {
                    case 'cl_enq':

                        echo '<h3 style="text-align:center">Clients\' Enquiries</h3>';
                        view_enquires('=', 'client', 'cuname');
                        break;

                    case 'em_enq':

                        echo '<h3 style="text-align:center">Employees\' Enquiries</h3>';
                        view_enquires('=', 'employee', 'employee_no');
                        break;

                    case 'req_b_cli':

                        echo '<h3 style="text-align:center">Requests to be client</h3>';
                        process_requests_b_c(0);
//                            echo view_clients('0');
                        break;


                    case 'cont_us_m':

                        echo '<h3 style="text-align:center">Contact Us Messages</h3>';
                        contact_us_mes();
                        break;

                    default :

                        echo '<h3 style="text-align:center">Contact Us Messages<br/>';
                        process_requests_b_c(0);
                }
            } else {
                echo '<h3 style="text-align: center;">Requests to be clients</h3>';
                process_requests_b_c(0);
            }
        } elseif ($_GET['action'] == 'man_pro') {
            if (isset($_GET['sub'])) {
                
            } else {
                echo '<div class="row">';
                echo '<div class="col-md-5">';
                global $users;
                $table_name = "mngmt";
                $user_col = "uname";
                $pwd_col = "pwd";
                $user = $_SESSION['uname'];
                $users->change_pwd($table_name, $user_col, $pwd_col, $user);
                echo '</div>';
                echo '<div class="col-md-5">';
                echo '<div style="margin:10px; padding:10px; max-width:350px; border-radius:10px; background:rgba(20, 50, 100, .05);">';
                echo '<h4 style="text-align: center;">Change profile picture</h4>';
                $users->add_profile_pic($_SESSION['uname']);
                echo '</div>';
                echo '<div style="margin:10px; padding:10px; max-width:350px; border-radius:10px; background:rgba(20, 50, 100, .05);">';
                ?>
                <h4 style="text-align: center;">Remove profile picture</h4>
                <?php
                $profile_pic = '../images/thumb_nails/thumb_' . $_SESSION['uname'] . '.png';
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
        } elseif ($_GET['action'] == 'man_alo') {
            if (isset($_GET['sub'])) {
                switch ($_GET['sub']) {
                    case 'alo':
                        allocate_emp();
                        break;
                    case 'view':
                        unallocate_employees();
                        break;
                }
            } else {
                allocate_emp();
            }
        } else {
            echo 'Does not exist';
        }//if GETaction  is not set
        ?>
    </div>
    </div><!-- Clossing the sidebar and the content div when the GET isset-->
    <?php
} else {
    ?>
    <!--This will only appear if there is no any argument in the url-->
    <div class="row" style="text-align: center;">
        <?php
        if (isset($_GET['rdr']) && $_GET['rdr'] == "100") {
            echo '<h4>Welcome, ' . $_SESSION['fname'] . '</h4>';
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-offset-2 col-md-8 ">
            <div class="col-sm-4 ">
                <a href="?action=man_cli"><div class="mngmt_menu"><i class=" fa fa-users fa-5x"></i><br/>Manage clients</div></a>
            </div>
            <div class="col-sm-4">
                <a href="?action=man_emp"><div class="mngmt_menu"><i class=" fa fa-file-excel-o fa-5x"></i><br/>Employees' Records</div></a>
            </div>
            <div class="col-sm-4">
                <!-- <a href="?action=man_ate"><div class="mngmt_menu"><i class=" fa fa-adn fa-5x"></i><br/>Attendance</div></a> -->
                <a href="?action=man_alo"><div class="mngmt_menu"><i class=" fa fa-adn fa-5x"></i><br/>Allocations</div></a>
            </div>
        </div>
        <div class="col-md-offset-2 col-md-8 ">
            <div class="col-sm-4 ">
                <a href="?action=man_jnr"><div class="mngmt_menu"><i class=" fa fa-street-view fa-5x"></i><br/>Jobs and recruitment</div></a>
            </div>
            <div class="col-sm-4">
                <a href="?action=man_rep"><div class="mngmt_menu"><i class=" fa fa-bar-chart-o fa-5x"></i><br/>Enquiries</div></a>
            </div>
            <div class="col-sm-4">
                <a href="?action=man_pro"><div class="mngmt_menu"><i class=" fa fa-user fa-5x"></i><br/>Profile</div></a>
            </div>
        </div>
    </div>
    <?php
}
?>
</div><!--Clossin m_container No html beyond this-->
</body>
</html>

<?php

//show_notifications();

function show_notifications() {
    $query = "SELECT `off_type`, `time_posted` FROM `off_duty_requests` WHERE response='p'";
    global $db;

    $res = $db->select($query, NULL, NULL);
    if (!empty($res)) {
        echo '<div class="row">';
        $no = 0;
        foreach ($res as $row) {
            $off_type = $row['off_type'];
            $time_posted = $row['time_posted'];
            ?>
            <div><?php echo $off_type; ?></div>
            <div><?php echo $time_posted; ?></div>
            <?php
        }
        echo '</div>';
    }
}
