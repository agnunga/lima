<form class = "form-inline form-search" method = "post" action = "" enctype = "multipart.form-data" style="margin: -7px 10px 0 10px; padding: 10px; border-radius: 10px; background: rgba(00, 80, 120, .10);">
    <div class="form-group">
        <label>Search by: </label>
        <select id="sby_d" class="form-control" name = "search_by" required style = "text-align: center;">
            <option value = "posi">Position applied</option>
            <option value = "qual">Qualifications</option> 
        </select>

        <input id="keyw_d" type = "text" name = "key_word" class="form-control" required style="width: 400px;">
        <button id="search_appl" type = "submit" name = "search" class = "btn btn-sm btn-info" style="width: 70px;"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</button>
    </div>
</form>
<div id="appl_display">

    <div id="results"></div>
    <!-- loading image -->
    <!--<div id="loader_image" class="fa fa-spinner"><img src="../sys_images/ajax-loader.gif" alt="" width="24" height="24"> Loading...please wait</div>-->
    <!-- for message if data is avaiable or not -->
    <div id="loader_message"></div> 
</div>
<script type="text/javascript">
    var busy = false;
    var limit = 55;
    var offset = 0;
    function displayRecords(lim, off) {
        $.ajax({
            type: "GET",
            async: false,
            url: "allocate_load.php",
            data: "limit=" + lim + "&offset=" + off,
            cache: false,
            beforeSend: function () {
                $("#loader_message").html("").hide();
                $('#loader_image').show();
            },
            success: function (html) {
                $("#results").append(html);
                $('#loader_image').hide();
                if (html === "") {
                    $("#loader_message").html('<button data-atr="nodata" class="btn btn-default" type="button">No more job Adverts  .</button>').show();
                } else {
//                    $("#loader_message").html('<button class="btn btn-default" type="button">Loading please wait...</button>').show();
                }
                window.busy = false;
            }
        });
    }



    $(document).ready(function () {
        if (busy === false) {
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
    $(document).on('click', '#search_appl', function (e) {
        e.preventDefault();
        if (busy === false) {
            busy = true;
            var limit = 5;
            var offset = 0;
            var sby = $('#sby_d').val();
            var keyw = $('#keyw_d').val();
//            alert(sby + ' ' + keyw);
            displayRecordsSearch(limit, offset, sby, keyw);
        }
    });
    function displayRecordsSearch(limit, offset, sby, keyw) {
        $.ajax({
            type: "POST",
            async: false,
            url: "search_employee.php",
            data: {limit: limit, offset: offset, sby: sby, keyw: keyw},
            cache: false,
            beforeSend: function () {
                $("#loader_message").html("").hide();
                $('#loader_image').show();
            },
            success: function (html) {
                $("#results").empty().append(html);
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
</script>


