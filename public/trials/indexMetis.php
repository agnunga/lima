<?php
include_once ("../includes/header.php");
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
?>
<script>
    $(function () {
        $('#menu').metisMenu({
            toggle: false
        });
    });</script>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">ILTMS </a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li><a href="<?php $_SERVER['PHP_SELF'] ?>?act=man"> Management  </a> </li>
                <li class="left dropdown">
                    <a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
                        POPE<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                        <li><a href="<?php $_SERVER['PHP_SELF'] ?>?act=man"> Management  </a> </li>
                        <li><a href="<?php $_SERVER['PHP_SELF'] ?>?act=man"> Management  </a> </li>
                        <li><a href="<?php $_SERVER['PHP_SELF'] ?>?act=man"> Management  </a> </li>
                        <li><a href="<?php $_SERVER['PHP_SELF'] ?>?act=man"> Management  </a> </li>
                        <li><a href="<?php $_SERVER['PHP_SELF'] ?>?act=man"> Management  </a> </li>
                    </ul>
                </li>
            </ul>
        </div>
</nav>
<div class="m-containerx" style="margin:0 15px;">

    <div class="row">
        <div class="col-md-2"  style="background: transparent; min-height: 00px; padding: 0px;">
            <!--the one-->
            <aside class="sidebar"><span class="sidebar-nav-item-icon fa fa-user fa-2x"></span> <span style="font-family: serif; font-size: 25px; letter-spacing: 2px;">Client</span>
                <nav class="sidebar-nav">
                    <ul class="metismenu" id="menu">
                        <li class=""> <a href="../forms/search_form.php" aria-expanded="false"> <span class="sidebar-nav-item-icon fa fa-users"></span> <span class="">Workers</span> <span class="fa arrow"></span></a>
                            <ul class="collapsing" aria-expanded="true">
                                <li><a id="" onclick="loadTarget('#content', '../forms/search_form.php')"><span class="sidebar-nav-item-icon fa fa-search"></span>Search </a></li>
                                <li><a id="" onclick="loadTarget('#content', '.php')"><span class="sidebar-nav-item-icon fa fa-eye"></span>View</a></li>
                                <li><a id="" onclick="loadTarget('#content', '../forms/request_workers_form.php')"><span class="sidebar-nav-item-icon fa fa-edit"></span> Request</a></li>
                            </ul>
                        </li>
                        <li class=""><a href="#" aria-expanded="false"><span class="sidebar-nav-item-icon fa fa-briefcase"></span><span class="">Records</span><span class="fa arrow"></span></a>
                            <ul class="collapsing" aria-expanded="true">
                                <li><a id="" onclick="loadTarget('#content', '.php')"><span class="sidebar-nav-item-icon fa fa-file-text-o"></span><span>View</span></a></li>
                                <li><a id="" onclick="loadTarget('#content', '.php')"><span class="sidebar-nav-item-icon fa fa-edit"></span><span>Edit</span></a></li>
                                <li><a id="" onclick="loadTarget('#content', '.php')"><span class="sidebar-nav-item-icon fa fa-trash-o"></span><span>Delete</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </aside>

        </div>
        <!--Page content goes here-->
        <div class="col-md-8" id="the_content" style="background: transparent;  min-height: 00px;">
            <div id="content">
                <!--        the second...-->
                <?php
//            if (isset($_GET['action']) == 'viev') {
//                require_once("./admin_actions.php");
//                view_management();
//            }
                ?>
            </div>
        </div>
        <!--Other important stuff navigator-->
        <div class="col-md-2"  style="background: transparent; min-height: 00px;">
            <!--        the three-->
        </div>

    </div>

</div><script>
    $(document).ready(function () {
        $('#open_edit_man_modal').click(function () {
            $('#modal_edit_man').modal();
        });
    });
//    $(document).ready(function () {
//        $('#the_view_man_link').click(function () {
//            $('#the_content').load('admin_actions.php');
//        });
//    });
</script>
<?php
// include '../forms/request_workers_form.php'; 
//<!--Closed divm-container---- no html should be beyond t-->
//global $mysqli;
//$age = $_GET['age'];
//$sex = $_GET['sex'];
//$wpm = $_GET['wpm'];
//
//// Escape User Input to help prevent SQL Injection
//$age = mysql_real_escape_string($age);
//$sex = mysql_real_escape_string($sex);
//$wpm = mysql_real_escape_string($wpm);
//
////build query
//$query = "SELECT * FROM ajax_example WHERE sex = '$sex'";
//
//if (is_numeric($age))
//    $query .= " AND age <= $age";
//
//if (is_numeric($wpm))
//    $query .= " AND wpm <= $wpm";
//
////Execute query
//$qry_result = $mysqli->execute($query);
//
////Build Result String
//$display_string = "<table>";
//$display_string .= "<tr>";
//$display_string .= "<th>Name</th>";
//$display_string .= "<th>Age</th>";
//$display_string .= "<th>Sex</th>";
//$display_string .= "<th>WPM</th>";
//$display_string .= "</tr>";
//
//// Insert a new row in the table for each person returned
//while ($row = mysql_fetch_array($qry_result)) {
//    $display_string .= "<tr>";
//    $display_string .= "<td>$row[name]</td>";
//    $display_string .= "<td>$row[age]</td>";
//    $display_string .= "<td>$row[sex]</td>";
//    $display_string .= "<td>$row[wpm]</td>";
//    $display_string .= "</tr>";
//}
//echo "Query: " . $query . "<br />";
//
//$display_string .= "</table>";
//echo $display_string;
//?>