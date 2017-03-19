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
<form id="" class="form-horizontal my_add_mngmt" method="post" action="#">
    <?php
    if (isset($_POST['add_mngmt'])) {
        
        $users->add_mngmt();
    }
    ?>
    <fieldset>
        <legend>Edit Management</legend>
        <div class="my_control_mngmt">
            <label>Username</label> <input class="my_mn_input" type="text" name="uname" required placeholder="username" maxlength="40"/>
        </div>

        <div>
            <label>Employee No</label><input class="my_mn_input" type="text" name="empno"  placeholder="Employee Number" maxlength="12" size="8" required/>
        </div>

        <div class="my_control_mngmt">
            <label>Level:&nbsp;&nbsp;</label>
            <select class="my_sel_level_mngmt" name="mngmt_level" selected="0">
                <option value="0" >None</option>
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    echo '<option value="' . $i . '" >' . $i . '</option>';
                }
                ?>
            </select>
        </div>

        <input type="submit" name="add_mngmt" value="Add"/>

    </fieldset>
</form>


