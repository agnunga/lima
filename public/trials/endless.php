<?php
include_once ("../includes/header.php");
?>
<!-- this will hold all the data -->
<div id="results"></div>
<!-- loading image -->
<div id="loader_image"><img src="../sys_images/ajax-loader.gif" alt="" width="24" height="24"> Loading...please wait</div>
<!-- for message if data is avaiable or not -->
<div id="loader_message"></div>

<script type="text/javascript">
    var busy = false;
    var limit = 15;
    var offset = 0;

    function displayRecords(lim, off) {
        $.ajax({
            type: "GET",
            async: false,
            url: "endless_fetch.php",
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
                    $("#loader_message").html('<button data-atr="nodata" class="btn btn-default" type="button">No more records.</button>').show();
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