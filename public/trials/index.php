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
        $("#accordion-1").accordion();
    });
</script>
<script>
    function con() {
        BootstrapDialog.confirm('Hi Apple, are you sure?');
    }
</script>
<!--

<div id="trymodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>One fine body…</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div> /.modal-content 
    </div> /.modal-dialog 
</div> /.modal -->

<button onclick="con()" class="btn btn-sm btn-success fa" data-toggle="modal" data-target="#trymodal"> Try</button>


<div id="accordion-1">
    <p>Job Advert</p>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        seddo eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco 
        laboris nisi ut aliquip <span>ex ea commodo conse</quat. 
    </p>
    <h3>Tab 2</h3>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco 
        laboris nisi ut aliquip ex ea commodo consequat.     
    </p>
    <h3>Tab 3</h3>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco 
        laboris nisi ut aliquip ex ea commodo consequat.     
    </p>
</div>
<script>
    $(document).ready(function () {
        function fetch_data() {
            $.ajax({
                url: "insert.php?act=select",
                method: "POST",
                success: function (data) {
                    $('#live_data').html(data);
                }
            });
        }
        fetch_data();
        $(document).on('click', '#btn_add', function () {
            var first_name = $('#first_name').text();
            var last_name = $('#last_name').text();
            if (first_name == '') {
                alert('First name empty');
                return false;
            }
            if (last_name == '') {
                alert('Larst name empty');
                return false;
            }
            $.ajax({
                url: "insert.php?act=insert",
                method: "POST",
                data: {first_name: first_name, last_name: last_name},
                dataType: "text",
                success: function (data) {
                    alert('Success adding');
                    fetch_data();
                }
            });
        });
        function edit_data(id, text, column_name) {
            $.ajax({
                url: "insert.php?act=edit",
                method: "POST",
                data: {id: id, text: text, column_name: column_name},
                dataType: "text",
                success: function (data) {
                    alert('Edited duccessfully!');
                }
            });
        }

        $(document).on('blur', '.first_name', function () {
            var id = $(this).data("id1");
            var first_name = $(this).text();
            edit_data(id, first_name, "first_name");
        });
        $(document).on('blur', '.last_name', function () {
            var id = $(this).data("id2");
            var last_name = $(this).text();
            edit_data(id, last_name, "last_name");
        });



        $(document).on('click', '.btn_delete', function () {
            if (confirm("Are you sure??")) {
                var id = $(this).data("id3");
                $.ajax({url: "insert.php?act=delete",
                    method: "POST",
                    data: {id: id},
                    dataType: "text",
                    success: function (data) {
                        alert('Deleted Successfully!');
                        fetch_data();

                    }
                });
            }
        });
    });

</script>
<div id="live_data" class="col-md-offset-2 col-md-8">

</div>
<div class="row">
    <div id="djsondata" class="col-md-offset-2 col-md-8">
        Kae
    </div>
</div> 
<section class='notification'>
    <li class='fa fa-user fa-2xyyy' data-count='81'></li>
    <li class='' data-count='12'></li>
    <li class='' data-count='8'></li>
</section> 
<style>
    section.notification {
        float: right;
    }
    section.notification li {
        list-style: none;
        padding: 5px 10px;
        margin: 5px 10px 0 0;
        float: left;
        cursor: pointer;
        display: inline-block;
        background: url(http://twesibly.googlecode.com/files/sprites.png) no-repeat 0 0;
    }
    section.notification li:nth-child(2) {
        background: url(http://twesibly.googlecode.com/files/sprites.png) no-repeat;
        background-position: 0 -128px;
    }
    section.notification li:nth-child(3) {
        background: url(http://twesibly.googlecode.com/files/sprites.png) no-repeat;
        background-position: 0 -64px;
    }
    section.notification li:after {
        content: attr(data-count);
        font-size: 13px;
        background: #0000ff;
        border-radius: 3px;
        color: #fff;
        z-index: 99999;
        font-weight: 600;
        padding: 4px 7px;
        box-shadow: -1px 2px 3px rgba(0,0,0,.3), inset 0 2px 5px rgba(225,225,225,.3);
        position: relative;
        top: -12px;
        left: 7px;
    }

</style>
</div>
<div style="z-index: 10000; position: fixed; top: 20px; left: 20px; width: 40px; height: 40px; padding: 0; margin: 0;">
    <div id="noti_Container">
        <img src="../images/thumb_nails/thumb_856985698.png" alt="profile" />
        <div class="noti_bubble">&nbsp; 122 &nbsp;</div>
    </div>
    <style>
        #noti_Container {
            position:relative;     /* This is crucial for the absolutely positioned element */
            border:1px solid blue; /* This is just to show you where the container ends */
            width:40px;
            height:40px;
            padding: 0;
            margin: 0;
        }
        .noti_bubble {
            position:absolute;    /* This breaks the div from the normal HTML document. */
            right: -5px;
            top:-5px;
            /*            padding:1px 2px 1px 2px;*/
            background-color:red; /* you could use a background image if you'd like as well */
            color:white;
            font-weight:bold;
            font-size:.6em;

            /* The following is CSS3, but isn't crucial for this technique to work. */
            /* Keep in mind that if a browser doesn't support CSS3, it's fine! They just won't have rounded borders and won't have a box shadow effect. */
            /* You can always use a background image to produce the same effect if you want to, and you can use both together so browsers without CSS3 still have the rounded/shadow look. */
            border-radius:30px;
            box-shadow:1px 1px 1px gray;
        }        
    </style>
</div>
<script type="text/javascript" src="try_json.js">


</script>






<div>
    <div class="content">
        <div class="wrapper">
            <div class="box" data-scroll-speed="1">S</div>
            <div class="box" data-scroll-speed="2">C</div>
            <div class="box" data-scroll-speed="1">R</div>
            <div class="box" data-scroll-speed="1">O</div>
            <div class="box" data-scroll-speed="3">L</div>
            <div class="box" data-scroll-speed="2">L</div>
        </div>
    </div>
    <style>
        .content {
            height: 3000px;
        }

        .wrapper {
            position: fixed;
        }

        .wrapper .box {
            width: 100px;
            height: 100px;
            line-height: 100px;
            text-align: center;
            font-size: 160%;
            color: #fff;
            position: absolute;
            background: #ff8330;
        }

        .wrapper .box:nth-of-type(2) {
            left: 100px;
            background: #E01B5D;
        }

        .wrapper .box:nth-of-type(3) {
            left: 200px;
            background: #30FFFF;
        }

        .wrapper .box:nth-of-type(4) {
            left: 300px;
            background: #B3FF30;
        }

        .wrapper .box:nth-of-type(5) {
            left: 400px;
            background: #308AFF;
        }

        .wrapper .box:nth-of-type(6) {
            left: 500px;
            background: #1BE059;
        }
    </style>

    <script>
        $.fn.moveIt = function () {
            var $window = $(window);
            var instances = [];

            $(this).each(function () {
                instances.push(new moveItItem($(this)));
            });

            window.onscroll = function () {
                var scrollTop = $window.scrollTop();
                instances.forEach(function (inst) {
                    inst.update(scrollTop);
                });
            }
        }

        var moveItItem = function (el) {
            this.el = $(el);
            this.speed = parseInt(this.el.attr('data-scroll-speed'));
        };

        moveItItem.prototype.update = function (scrollTop) {
            var pos = scrollTop / this.speed;
            this.el.css('transform', 'translateY(' + -pos + 'px)');
        };

        $(function () {
            $('[data-scroll-speed]').moveIt();
        });

    </script>
</div>
<?php

$my_s_time = microtime(TRUE) * 10000;
echo $my_s_time;
