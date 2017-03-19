<?php
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
require_once("../../include/redirect.php");
require_once("../home/home_actions.php");
?>
<!--<script src="custom.js" type="text/javascript"></script>-->
<link href="custom.css" rel="stylesheet" type="text/css"/>
<body style="background:#F7F7F7;">
    <div class="container-fluid"> 
        <div class="row" style="margin: -20px 0 0 -20px;"><hr/></div>
        <div class="">
            <a class="hiddenanchor" id="toregister"></a>
            <a class="hiddenanchor" id="tologin"></a>

            <div id="wrapper">
                <div id="login" class="animate form">
                    <section class="login_content">
                        <form method="post" action="">
                            <h1>Sign In</h1>
                            <div>
                                <input id="unamel" type="text" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input id="pwdl" type="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button id="login_btn" class="btn btn-default submit" style="width: 100px;"  href="index.html">Log in</button>
                                <!--<a class="reset_pass" href="#">Lost your password?</a>-->
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator">

<!--                            <p class="change_link"> Don't have an account?
                                <a href="#toregister" class="to_register"> Create Account </a>
                            </p>-->
                                <div class="clearfix"></div>

                                <a href="index.php" style="text-decoration: none;"><h3><i class="fa fa-th-large" style="font-size: 26px;"></i> LLT System.</h3> </a>

                                <p>&COPY; <?php echo date("Y"); ?> All Rights Reserved. LIMMA Limited Portal.</p>
                            </div>
                        </form>
                        <!-- form -->
                    </section>
                    <!-- content -->
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script>

    $(document).on('click', '#submit-btn', function () {
        var des_len = $("#unamel").val().length;
        if (des_len < 1) {
            $("#len_warn").addClass('hidden');
            $('#id_em_aply').removeClass('disabled');
        }
    });
    function ckeck_des_len() {
        var des_len = $("#id_brief_description").val().length;
        if (des_len > 50) {
            $("#len_warn").addClass('hidden');
            $('#id_em_aply').removeClass('disabled');
        }
    }



    $(document).on('click', '#id_em_aply', function () {
        var adv_id = $('#m_id').val();
//        alert(adv_id);
//        var natid = $('#id_natid').val();
//        var full_name = $('#id_full_name').val();
//        var phone = $('#id_phone').val();
        var b_desc = $('#id_brief_description').val();
        //            var cv = $('#id_cv').val();

        alert(adv_id + '<br/>' + b_desc + '<br/>');
        $.ajax({
            url: "login.php",
            method: "POST",
            data: {adv_id: adv_id, b_desc: b_desc},
            dataType: "text",
            success: function (data) {
                alert(data);
//                $('#success_alert_message').append(data);
                $('#id_brief_description').val('');
//                $('#success_alert_message').removeClass('hidden');
//                faddingAllert('#success_alert_message');
            }
        });
    });
</script>
