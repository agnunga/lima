<?php
include_once("../includes/header.php");
?>
<div class="container-fluid">
    <nav class="navbar">
        <div class="navbar navbar-fixed-top" style="border-bottom: 1px solid lightgrey; background: rgba(240,240,240,0.98);">
            <div class="row">
                <div class="col-md-offset-0 col-md-12" style="padding-right: 35px;">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="../home/index.php">ILTS </a>
                    </div>
                    <ul class="nav navbar-nav">

                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<!--    <form class = "form-inline form-search" method = "post" action = "" enctype = "multipart.form-data" style="margin: -7px 10px 0 10px; padding: 10px; border-radius: 10px; background: rgba(00, 80, 120, .10);">
        <div class="form-group">
            <label>Search by: </label>
            <select id="sby_d" class="form-control" name = "search_by" required style = "text-align: center;">
                <option value = "posi">Position advertised</option>
                <option value = "qual">Qualifications requirements</option> 
            </select>

            <input id="keyw_d" type = "text" name = "key_word" class="form-control" required style="width: 400px;">
            <button id="search_appl" type = "submit" name = "search" class = "btn btn-sm btn-info" style="width: 70px;"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
        </div>
    </form>-->
    
    <br/>
    <div class="row">
        <div class="col-md-2">.</div>
        <!-- this will hold all the data -->
        <div class="col-md-8"><h1 style="text-align: center; margin-top: -15px; text-decoration: underline;">&nbsp;Vacancies&nbsp;</h1>
            <div id="appl_display">
                <div id="results"></div>
                <!-- loading image -->
                <div id="loader_image"><img src="../sys_images/ajax-loader.gif" alt="" width="24" height="24"> Loading...please wait</div>
                <!-- for message if data is avaiable or not -->
                <div id="loader_message"></div>
            </div>
        </div>
        <div class="col-md-2">.</div>
    </div>
</div>
<script type="text/javascript">
    var busy = false;
    var limit = 4;
    var offset = 0;

    function displayRecords(lim, off) {
        $.ajax({
            type: "GET",
            async: false,
            url: "view_job_adverts_autoload.php",
            data: "limit=" + lim + "&offset=" + off,
            cache: false,
            beforeSend: function () {
                $("#loader_message").html("").hide();
                $('#loader_image').show();
            },
            success: function (html) {
                $("#results").append(html);
                $('#loader_image').hide();
                if (html == "") {
                    $("#loader_message").html('<button data-atr="nodata" class="btn btn-default" type="button">No more job Adverts  .</button>').show();
                } else {
                    $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
                }
                window.busy = false;

            }
        });
    }

    $(document).ready(function () {
        if (busy == false) {
            busy = true;
            // start to load the first set of data
            displayRecords(limit, offset);
        }
    });

    $(document).ready(function () {

        $(window).scroll(function () {
            // make sure u give the container id of the data to be loaded in.
            if ($(window).scrollTop() + $(window).height() > $("#results").height() && !busy) {
                busy = true;
                offset = limit + offset;

                displayRecords(limit, offset);

            }
        });

    });
</script>
<?php
