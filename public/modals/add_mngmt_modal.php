<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");
?>
<style>
    legend{
        margin-bottom: 10px;
        text-align: center;
    }
    .my_mn_input{
        width: 100%;
        line-height: 28px;
        padding: 2px 5px 2px 5px;
        border: 1px solid lightgray;
        border-radius: 4px;
    }
    .my_control_mngmt{
        margin: 7px 0 6px 0;
    }
    .my_add_mngmt{
        width: 250px;
        border: 1px solid darkslategrey;
        border-radius: 5px;
        padding: 10px;
        margin: 5px;
    }
    .my_sel_level_mngmt{
        height: 25px;
        width: 70px;
        border:1px solid grey;
        border-radius: 3px;
    }
    .my_sel_level_mngmt option{
        text-align: center; 
    }
</style>
<div class = "modal fade" id="add_mgmt_modal" role = "dialog" data-backdrop = "true" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-lg" style="margin: auto; width: 290px;">
            <div class = "modal-header">
                <button class = "close" data-dismiss = "modal">&times; </button>
                <input id="m_id" value="" hidden="">
                <h4 id='m_pos' style="text-align: center; margin: 0;">Add Management </h4>
            </div>
            <div class = "modal-body">
                <form id="" class="form-horizontal my_add_mngmt" method="post" action="#">
                    <fieldset>
                        <div>
                            <label>Employee No</label><input id="emp_no" class="my_mn_input" type="text" name="empno" placeholder="Employee Number" maxlength="10" size="8" required/>
                        </div>
                        <div class="my_control_mngmt">
                            <label>Username</label> <input id="uname" class="my_mn_input" type="text" name="uname" required placeholder="username" maxlength="40"/>
                        </div>
                        <div class="my_control_mngmt">
                            <label>Name</label> <input id="fname" class="my_mn_input" type="text" name="fname" required placeholder="First name" maxlength="40"/>
                        </div>
                        <div class="my_control_mngmt hidden">
                            <label>Level:&nbsp;&nbsp;</label>
                            <select class="my_sel_level_mngmt" name="mngmt_level" selected="0">
                                <?php
                                for ($i = 3; $i >= 1; $i--) {
                                    echo '<option value="' . $i . '" >' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="my_control_mngmt">
                            <input id="btn_add_man" type="submit" data-dismiss = "modal" class="btn btn-success btn-sm" style="width: 100px; float: right;" name="add_mngmt" value="Add"/>
                        </div>
                    </fieldset>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#btn_add_man', function (e) {
        e.preventDefault();
        var emp_no = $('#emp_no').val();
        var uname = $('#uname').val();
        var fname = $('#fname').val();

        $.ajax({
            url: "man_mgmt.php?act=add",
            method: "POST",
            data: {emp_no: emp_no, uname: uname, fname:fname},
            dataType: "text",
            success: function (data) {
                alert(data);
//                $('#success_alert_message').append(data);
//                $('#success_alert_message').removeClass('hidden');
//                faddingAllert('#success_alert_message');
            }
        });
    });
</script>


