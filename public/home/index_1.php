<?php
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
require_once("../../include/redirect.php");
require_once("../home/home_actions.php");
?>
<link href="jquery.fullPage.css" rel="stylesheet" type="text/css"/>
<script src="jquery.fullPage.js" type="text/javascript"></script>
<script src="examples.js" type="text/javascript"></script>
<link href="examples.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
    $(document).ready(function () {
        $('#fullpage').fullpage({
//            F7F7F7 sectionsColor: ['#1bbc9b', '#4BBFC3', 'whitesmoke', '#7BAABE', '#ccddff', '#4BBFC3', '#7BAABE', 'whitesmoke', '#ccddff'],
            sectionsColor: ['whitesmoke', 'whitesmoke', 'whitesmoke'],
            anchors: ['firstPage', 'secondPage', '3rdPage', 'lastPage'],
            menu: '#menu'
        });
    });
</script>
<div id="menu">
    <li data-menuanchor="3rdPage"><a href="#3rdPage">Contact Us</a></li>
    <li data-menuanchor="secondPage"><a href="#secondPage">About Us</a></li>
    <li data-menuanchor="firstPage"><a href="#firstPage">Home</a></li>

</div>
<div id="menu_login" style=""><li><a href="../home/login.php"> &nbsp; <i class="glyphicon glyphicon-log-in">    </i> &nbsp; Members Login &nbsp; </a> </li></div>


<div id="fullpage">
    <div class="section " id="section0">
        <div class="intro">
            <div class="col-md-offset-1 col-md-10 optionlist my_home_starter">
                <h3>Welcome to <span style="letter-spacing: 2px; color: grey; font-family: serif; ">ILTS,</span> Integrated Labour Tracking and Management System.</h3><br/><br/>
                <!--<a href="#"> <h1>Apply for job.</h1></a><p>This will require you to <a href="#">login</a></p>-->

                <div class="col-sm-6">
                    <h5 style="text-align: center;">AVAILABLE RESOURCEFUL PERSONS</h5>
                    <?php view_qualified(); ?>
                    <h5> In need of workers?</h5>
                    <?php require '../modals/get_job_done_modal.php' ?>
                    <button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#get_work_done_modal" style="margin: 10px">GET  0 0WORKERS</button>
                    <a href="client.php"><button class="home_btn_my btn btn-lg btn-primary" name="get_workers" style="margin: 10px">GET WORKERS</button></a><br/>
                </div>
                <div class="col-sm-6">
                    <h5 style="text-align: center;">OUR EMPLOYMENT CAPACITY</h5>
                    <?php
                    global $mysqli;
                    $total_empoyees = 0;
                    $total_hob_seekers;
                    $query = "SELECT COUNT( id) FROM job_advert";
                    $query1 = "SELECT COUNT( id) FROM client";
                    $query0 = "SELECT SUM(number_needed) FROM job_advert";

                    $result1 = $mysqli->query($query1);
                    while ($resultset1 = mysqli_fetch_row($result1)) {
                        $total_clients = $resultset1['0'];
                        echo'<h6>We have <span style="color: blue">' . $total_clients . '</span> clients hiring  workers, ';
                    }
                    $result = $mysqli->query($query);
                    while ($resultset = mysqli_fetch_row($result)) {
                        $total_adverts = $resultset['0'];
                        echo'and over <span style="color: blue">' . $total_adverts . '</span>  advertised job vacancies ';
                    }
                    $result0 = $mysqli->query($query0);
                    while ($resultset0 = mysqli_fetch_row($result0)) {
                        $emp_capacity = $resultset0['0'];
                        echo'that will give oportunity to over <span style="color: blue">' . $emp_capacity . '</span> persons with different qualifications to get hired.</h6> <br/>';
                    }
                    ?>
                    <h5>Seeking job?</h5>
                    <a href="view_job_adverts.php" id="new_user_reg_modal"><button class="home_btn_my btn btn-lg btn-primary" style="margin: 10px">VIEW ADVERTISED JOBS</button></a>
                </div>
            </div>
        </div>
        <div class="row">
        </div>
    </div>
    <div class="section" id="section1">
        <div class="col-md-offset-1 col-md-10">
            <h3> What we do and how we do it. </h3><br/><br/>
            <h5>
                ILTS reach for qualified individuals, both skilled and unskilled resourceful persons.
                We have place for casual, seasonal and partially permanent employees. We contract the manpower to 
                companies in need of workers for the period they need the service. In this we connect persons seeking for jobs 
                with those seeking manpower.
                We provide casual workers to individuals and companies in need. We get and accumulate the pay till
                end month then we give the worker his/her right. We guarantee full and on time payments.
            </h5>
        </div>
    </div>
    <div class="section" id="section2"> 
        <div style="    margin: 50px auto auto auto;">
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
</body>
</html>