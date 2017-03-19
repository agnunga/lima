<?php
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
require_once("../../include/redirect.php");
require_once("../home/home_actions.php");
?>
<head>
    <link rel="stylesheet" type="text/css" href="../jquery.fullPage.css" />
    <link rel="stylesheet" type="text/css" href="examples.css" />
    <link href="examples.css" rel="stylesheet" type="text/css"/> 
    <link href="jquery.fullPage.css" rel="stylesheet" type="text/css"/>
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="../bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>

    <script src="../bootstrap/js/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="../bootstrap/js/jquery-ui.js" type="text/javascript"></script>
    <script src="../bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="jquery.fullPage.js" type="text/javascript"></script>
    <script src="jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="examples.js" type="text/javascript"></script>

    <style>
        /* Centered texts in each section
        * --------------------------------------- */
        .section{
            text-align: justify;
        }

        .section{
            text-align: justify;
        }


        /* Backgrounds will cover all the section
        * --------------------------------------- */
        .section{
            background-size: cover;
        }
        .slide{
            background-size: cover;
        }

        /* Defining each section background and styles
        * --------------------------------------- */
        #section0{
            /*background-image: url(../bg1.png);*/
            padding: 0% 0 0 0;
            /*                color: white;*/
        }
        #section1{
            /*background-image: url(imgs/bg3.jpg);*/
            padding: 0% 0 0 0;
        }

    </style>
    <!--[if IE]>
            <script type="text/javascript">
                     var console = { log: function() {} };
            </script>
    <![endif]-->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#fullpage').fullpage({
//				anchors: ['firstPage', 'secondPage'],//4A6FB1
                sectionsColor: ['whitesmoke', 'whitesmoke'],
                scrollOverflow: true,
                scrollBar: true
            });
        });
    </script>


</head>
<div class="container-fluid">
    <div id="fullpage">
        <div class="section " id="section0">
            <div class="row" style="text-align: center; background: #1ABB9C; margin-top: 0;">
                <h3><img src="../icon.png" width="100px" alt=""/>
                    <br/>
                    LIMMAQ Labor Tracking System.
                </h3>

                <nav class="navbar" 
                     style="border-radius: 0; color: green; background: #1ABB9C;; margin: 0;">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">ILTS <!-- <img src="kuta.png"/> --></a>
                    </div>
                    <!--                            <div>
                                                    <ul class="nav navbar-nav">
                                                        <li class=""><a href="#">Get Started</a></li>
                                                    </ul>
                                                </div>-->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../home/login.php"> &nbsp; <i class="glyphicon glyphicon-log-in">    </i> &nbsp; Members Login &nbsp; </a></li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-sm-6" style="float:left;  border: 1px solid lightblue; margin: 5px; padding: 5px; border-radius: 10px;">
                    <h3 style="text-align: center;">Our range of services.</h3>
                    <ul>
                        <h4 style="text-align: center;">Data entry.</h4>
                        <p style="padding: 10px;">
                            We have employees very proficient in data entry and statistical data analysis for hire.
                            They have good experience in this field.
                        </p>
                        <h4 style="text-align: center;">Catering teams.</h4>
                        <p style="padding: 10px;">There are over a hundred professional catering teams linked to us for hire on demand.
                            They have good experience in catering and hospitality management.
                        </p> 

                        <h4 style="text-align: center;">Drivers.</h4>
                        <p style="padding: 10px;">We offer professional drivers for hire. Both personal and public service vehicle drivers.
                            They have good experience in this field.
                        </p> 

                    </ul>

                </div>
                <div class="col-sm-5" style="float: right; border: 1px solid lightblue; margin: 5px; border-radius: 10px;">

                    <h4 style="text-align: center;">AVAILABLE RESOURCEFUL PERSONS</h4>
                    <?php // view_qualified(); ?>
                    <p>We currently have over 100 employees available for hire. You can request for employees or / and request to be our regular client.</p>
                    <h5 style="color: #1ABB9C; font-weight: bold;"> Seeking employees?</h5>
                    <?php require '../modals/get_job_done_modal.php' ?>
                    <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#get_work_done_modal" style="margin: 10px; text-align: right;">GET EMPLOYEES</button>
                    <!--                        <a href="client.php">
                                                <button class="home_btn_my btn btn-lg btn-primary" name="get_workers" style="margin: 10px">GET WORKERS</button>
                                            </a><br/>-->


                    <h4 style="text-align: center;">OUR EMPLOYMENT CAPACITY</h4>
                    <?php
                    global $mysqli;
                    $total_empoyees = 0;
                    $total_hob_seekers;
                    $query = "SELECT COUNT( id) FROM job_advert WHERE apply_before > CURRENT_DATE";
                    $query1 = "SELECT COUNT( id) FROM client";
                    $query0 = "SELECT SUM(number_needed) FROM job_advert WHERE apply_before > CURRENT_DATE";

                    $result1 = $mysqli->query($query1);
                    while ($resultset1 = mysqli_fetch_row($result1)) {
                        $total_clients = $resultset1['0'];
                        echo'<h5>We have <span style="color: blue">' . $total_clients . ''
                        . '</span> clients hiring  workers, ';
                    }
                    $result = $mysqli->query($query);
                    while ($resultset = mysqli_fetch_row($result)) {
                        $total_adverts = $resultset['0'];
                        echo'and over <span style="color: blue">' . $total_adverts . ''
                        . '</span>  advertised job vacancies ';
                    }
                    $result0 = $mysqli->query($query0);
                    while ($resultset0 = mysqli_fetch_row($result0)) {
                        $emp_capacity = $resultset0['0'];
                        echo'that will give oportunity to over <span style="color: blue">' . $emp_capacity . ''
                        . '</span> persons with different qualifications to get hired.</h5> ';
                    }
                    ?>
                    <h5  style="color: #1ABB9C; font-weight: bold;">Seeking a job?</h5>
                    <a href="view_job_adverts.php" id="new_user_reg_modal">
                        <button class="home_btn_my btn btn-lg btn-primary" style="margin: 10px">VIEW ADVERTISED JOBS</button></a>
<br/><br/>
                </div>
            </div>
        </div>

        <div class="section" id="section1">
            <div class="row">
                <div class="col-md-offset-0 col-md-5">


                    <div class="our_loc_map" style="border: 1px solid lightblue; border-radius: 10px; width: 100%; height: 490px; margin: 10px auto 0 auto;"><div id="map_label" style="position: absolute; top: 10px; left: 20%; background: rgba(250,250,250,.9);color: black; z-index: 1000;">Our Location: Syokimau, Katani Junction, Silver Plaza.</div>
                        <style>
                            #map {
                                width: 100%;
                                height: 100%;
                            }
                        </style>
                        <div id="map"></div>
                        <script>
                            function initMap() {
                                var mapDiv = document.getElementById('map');
                                var map = new google.maps.Map(mapDiv, {
                                    center: {lat: -1.3790, lng: 36.9281},
                                    zoom: 13
                                });
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
                        async defer></script>

                    </div> 
                </div>
                <div class="col-md-2" style="text-align: left;"> <br/><br/>
                    Phone: +254712 929 181<br/><br/>

                    LIMMA LTD, <br/>
                    PO BOX 121525,<br/>
                    NAIROBI.<br/><br/>

                    Email: info@ilts.com<br/><br/>



                </div>
                <div class="col-md-5" >               
                    <!--<h5 style="text-align: center;">CONTACT US</h5>-->
                    <?php require ("../forms/contact_us_form.php"); ?>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>