<?php
require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
(Session::logged_in('cuname') ? Redirect::to("../client/index.php?rdr=100") : '');
(Session::logged_in('uname') ? Redirect::to("../mgmt/index.php?rdr=100") : '');
(Session::logged_in('employee_no') ? Redirect::to("../employee/index.php?rdr=100") : '');
include_once ("../includes/header.php");
?>
<style> 
    #mgmtlogin{
        max-width: 350px;
        position: static;
        margin: 1.5% auto auto auto;
        padding: 0;
        /* border: 1px solid lightskyblue; */
        /* border-radius: 10px; */
    }
    .login_content {
        margin: 0 auto;
        padding: 25px 0 0;
        position: relative;
        text-align: center;
        text-shadow: 0 1px 0 #fff;
        min-width: 280px;
    }
    .login_content h1 {
        font: normal 25px Helvetica, Arial, sans-serif;
        color: #777;
        letter-spacing: -0.05em;
        line-height: 20px;
        margin: 10px 0 30px;
    }
    .login_content h1:before, .login_content h1:after {
        content: "";
        height: 1px;
        position: absolute;
        top: 10px;
        width: 27%;
    }
    .login_content h1:after {
        background: rgb(126, 126, 126);
        background: -moz-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -webkit-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -o-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -ms-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        right: 0;
    }
    .login_content h1:before {
        background: rgb(126, 126, 126);
        background: -moz-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -webkit-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -o-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -ms-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        left: 0;
    }
    .login_content h1:before, .login_content h1:after {
        content: "";
        height: 1px;
        position: absolute;
        top: 10px;
        width: 20%;
    }
    .login_content h1:after {
        background: rgb(126, 126, 126);
        background: -moz-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -webkit-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -o-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -ms-linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: linear-gradient(left, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        right: 0;
    }
    .login_content h1:before {
        background: rgb(126, 126, 126);
        background: -moz-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -webkit-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -o-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: -ms-linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        background: linear-gradient(right, rgba(126, 126, 126, 1) 0%, rgba(255, 255, 255, 1) 100%);
        left: 0;
    }
    .login_content form {
        margin: 20px 0;
        position: relative
    }
    .login_content form input[type = "text"], .login_content form input[type = "email"], .login_content form input[type = "password"] {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        -ms-border-radius: 3px;
        -o-border-radius: 3px;
        border-radius: 3px;
        -webkit-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
        -moz-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
        -ms-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
        -o-box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
        box-shadow: 0 1px 0 #fff, 0 -2px 5px rgba(0, 0, 0, 0.08) inset;
        -webkit-transition: all 0.5s ease;
        -moz-transition: all 0.5s ease;
        -ms-transition: all 0.5s ease;
        -o-transition: all 0.5s ease;
        transition: all 0.5s ease;
        border: 1px solid #c8c8c8;
        color: #777;
        margin: 0 0 20px;
        width: 100%;
    }
    .login_content form input[type = "text"]:focus, .login_content form input[type = "email"]:focus, .login_content form input[type = "password"]:focus {
        -webkit-box-shadow: 0 0 2px #AA77B4 inset;
        -moz-box-shadow: 0 0 2px #ed1c24 inset;
        -ms-box-shadow: 0 0 2px #ed1c24 inset;
        -o-box-shadow: 0 0 2px #ed1c24 inset;
        box-shadow: 0 0 2px #A97AAD inset;
        background-color: #fff;
        border: 1px solid #A878AF;
        outline: none;
    }
    #username {
        background-position: 10px 10px!important
    }
    #password {
        background-position: 10px -53px!important
    }
    .login_content form div a {
        font-size: 12px;
        margin: 10px 15px 0 0;
    }
    .reset_pass {
        margin-top: 10px!important;
    }
    .login_content div .reset_pass {
        margin-top: 13px!important;
        margin-right: 39px;
        float: right;
    }
    .separator {
        border-top: 1px solid #D8D8D8;
        margin-top: 10px;
        padding-top: 10px;
    }
    .button {
        background: rgb(247, 249, 250);
        background: -moz-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
        background: -webkit-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
        background: -o-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
        background: -ms-linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
        background: linear-gradient(top, rgba(247, 249, 250, 1) 0%, rgba(240, 240, 240, 1) 100%);
        /* filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#f7f9fa', endColorstr='#f0f0f0', GradientType=0); */
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
        -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
        -ms-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
        -o-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1) inset;
        -webkit-border-radius: 0 0 5px 5px;
        -moz-border-radius: 0 0 5px 5px;
        -o-border-radius: 0 0 5px 5px;
        -ms-border-radius: 0 0 5px 5px;
        border-radius: 0 0 5px 5px;
        border-top: 1px solid #CFD5D9;
        padding: 15px 0;
    }
    .login_content form input[type = "submit"], #content form .submit {
        float: left;
        margin-left: 38px;
    }
</style>
<div class = "container-fluid">

    <div style="text-align: center; margin: 0px; padding: 5px; width: 100%; background: #1ABB9C;">
        <h3><img src="../icon.png" width="100px" alt=""/>
            <br/>
            LIMMA Labor Management System.
        </h3>
    </div>
    <div id = "mgmtlogin"> 
        <section class = "login_content">
            <form method = "post" action = "">
                <h1>Sign In</h1>
                <input id="uname_l_d" type = "text" class = "form-control" name = "uname" placeholder = "Username" required>

                <input id="pwd_l_d" type = "password" class = "form-control" id = "pwd" name = "pwd" placeholder = "Password" required>
                <div class = " col-sm-offset-3 col-sm-offset-8">
                    <input type = "submit" id = "o_login_btn" class = "btn btn-default" name = "login" value = "Log in" style = "width: 100px;">
                </div> <div class = "clearfix"></div>
                <div class = "separator">
                    <div class = "clearfix"></div>

                    <a href = "index.php" style = "text-decoration: none;"><h3><i class = "fa fa-th-large" style = "font-size: 26px;"></i> LLT System.</h3> </a>

                    <p style="text-align: center;">&COPY;
                        <?php echo date("Y");
                        ?> All Rights Reserved. LIMMA  Limited Portal.</p>
                </div>
            </form>
            <!-- form -->
            <hr/>
        </section>
    </div>
</div>
<script>
    $(document).on('click', '#o_login_btn', function (e) {
        e.preventDefault();
        var uname = $('#uname_l_d').val();
        var pwd = $('#pwd_l_d').val();
//        alert(uname + '  ' + pwd);
        $.ajax({
            url: "../../include/process_login.php",
            method: "POST",
            data: {uname: uname, pwd: pwd},
            dataType: 'text',
            success: function (data) {
                if (data == '000') {
//                    alert(data);
                    alert('Invalid username');
                    $('#pwd_l_d').val("");
                    $('#uname_l_d').val("");
                    $('#uname_l_d').focus();
                } else if (data == "100" || data == "010" || data == "001") {
//                    alert(data);
                    alert('Wrong password!');
                    $('#pwd_l_d').val("");
                    $('#pwd_l_d').focus();
                } else {
//                    alert(data);
                    window.open("../home/login.php", '_self');
                }
            },
            fail: function () {
                alert('Failure');
            }
        });
    });
</script>