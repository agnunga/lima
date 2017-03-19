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
            sectionsColor: ['#1bbc9b', '#4BBFC3', '#7BAABE', '#ffffff'],
            anchors: ['home', 'about', 'contact', 'more'],
            menu: '#menu'
        });
    });
</script>
<ul id="menu">
    <li data-menuanchor="more"><a href="#more">More</a></li>
    <li data-menuanchor="contact"><a href="#contact">Contact Us</a></li>
    <li data-menuanchor="about"><a href="#about">About Us</a></li>
    <li data-menuanchor="home"><a href="#home">Home</a></li>
</ul>

<div id="fullpage">
    <div class="section " id="home">
        <div class="intro">
            <div class="col-md-offset-1 col-md-10 optionlist my_home_starter">
                <h2>Welcome to <span style="letter-spacing: 2px; color: white; font-family: serif; ">ILTS,</span> Integrated Labour Tracking and Management System.</h2>
                <!--<a href="#"> <h1>Apply for job.</h1></a><p>This will require you to <a href="#">login</a></p>-->

                <div class="col-sm-6">
                    <h5> In need of casual workers? Click the button.</h5>
                    <a href="client.php"><button class="home_btn_my btn btn-lg btn-primary" name="get_workers">GET WORKERS</button></a><br/>
                </div>
                <div class="col-sm-6">

                    <h5>Seeking job? Click here to create an account jobs.</h5>
                    <a id="new_user_reg_modal"><button class="home_btn_my btn btn-lg btn-primary">REGISTER NOW</button></a>
                </div>
            </div>
        </div>
    </div>
    <div class="section" id="about">
        <div class="col-md-offset-1 col-md-10">
            <h3> What we do and how we do it. </h3>
            <h5>
                ILTS reach for qualified individuals, both skilled and unskilled resourceful persons.
                We have place for casual, seasonal and partially permanent employees. We contract the manpower to 
                companies in need of workers for the period they need the service. In this we connect persons seeking for jobs 
                with those seeking manpower.
                We provide casual workers to individuals and companies in need. We get and accumulate the pay for agreed
                for say a week/month then we give the worker his/her right. We guarantee full and on time payments.
            </h5>
        </div>
    </div>
    <div class="section" id="contact"> 
        <div style="    margin: 50px auto auto auto;">
            <div class="col-md-offset-0 col-md-6">
                <h5 style="text-align: center;">RECENTLY ADVERTISED VACANCIES</h5>
                <?php
                global $mysqli;
                $total_empoyees = 0;
                $total_hob_seekers;
                $query = "SELECT COUNT(employee_no) FROM employee WHERE status='1'";
                $query0 = "SELECT COUNT(id) FROM users WHERE status='1'";

                if ($result = $mysqli->query($query)) {
                    while ($resultset = mysqli_fetch_row($result)) {
                        $total_empoyees = $resultset['0'];
                        echo'We currently have <span style="color: blue">' . $total_empoyees . '</span> employees already working for our different clients. <br/>';
                    }
                } else {
                    echo $mysqli->error;
                }
                $result0 = $mysqli->query($query0);
                while ($resultset0 = mysqli_fetch_row($result0)) {
                    $total_hob_seekers = $resultset0['0'];
                    echo'There are <span style="color: blue">' . $total_hob_seekers . '</span> persons with different qualifications interested in getting hired. <br/>' . '<br/>';
                }
                $total_manpower = $total_empoyees + $total_hob_seekers;
                echo 'And that sums up to <span style="color: blue">' . $total_manpower . '</span> persons with different qualifications available to get your job done with utmost skills within you set time.<br/>';
                ?>
            </div>
            <div class="col-md-6" >
                <h5 style="text-align: center;">AVAILABLE QUALIFIED PERSONS</h5>
                <?php view_qualified(); ?>
            </div>
        </div>
    </div>
    <div class="section row" id="more">
        <div class="intro">
            <h1>No CSS3? No problem!</h1>
            <p>If CSS3 is not available, animations will fall back to jQuery animate.</p>
        </div>
    </div>
</body>
</html>