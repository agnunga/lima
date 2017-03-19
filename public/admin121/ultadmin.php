<?php
include_once ("../includes/header.php");
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
?>
<div class="container-fluid" style="margin:0 15px;">
    <div class="row">
        <div class="col-md-2"  style="background: transparent; min-height: 00px; padding: 0px;">
            <!--the one-->
            <aside class="sidebar"><span class="sidebar-nav-item-icon fa fa-dashboard fa-2x"></span> <span style="font-family: serif; font-size: 25px; letter-spacing: 2px;">Dashboard</span>
                <nav class="sidebar-nav">
                    <ul class="metismenu" id="menu">
                        <li class=""> <a onclick="loadTarget('#content', 'admin_actions.php')" aria-expanded="true"> <span class="sidebar-nav-item-icon fa fa-users"></span> <span class="">Manage management</span> <span class="fa arrow"></span></a>
                            <ul style="height: 0px;" class="collapse" aria-expanded="true">
                                <li><a href="search_man.php" id="the_view_man_link"><span class="sidebar-nav-item-icon fa fa-search"></span>Search </a></li>
                                <li><a onclick="loadTarget('#content', 'admin_actions.php')" id="the_view_man_link"><span class="sidebar-nav-item-icon fa fa-eye"></span>View </a></li>
                                <li><a onclick="loadTarget('#content', 'add_mngmt_form.php')"><span class="sidebar-nav-item-icon fa fa-user-plus"></span>Add </a></li>
                                <li><a href="#"><span class="sidebar-nav-item-icon fa fa-edit"></span>Edit </a></li>
                            </ul>
                        </li>
                        <li class=""><a href="#" aria-expanded="true"><span class="sidebar-nav-item-icon fa fa-briefcase"></span><span class="">Manage Records</span><span class="fa arrow"></span></a>
                            <ul class="collapse" aria-expanded="false">
                                <li><a href="#"><span class="sidebar-nav-item-icon fa fa-file-text-o"></span><span>View</span></a></li>
                                <li><a href="#"><span class="sidebar-nav-item-icon fa fa-edit"></span><span>Edit</span></a></li>
                                <li><a href="#"><span class="sidebar-nav-item-icon fa fa-trash-o"></span><span>Delete</span></a></li>
                            </ul>
                        </li>
                    </ul>
                    <a href="#" id="edit_modal1"><span class="fa fa-edit"> Edit</span></a><br/><br/>
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

</div>