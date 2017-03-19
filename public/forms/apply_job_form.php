<?php
require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
Session::confirm_logged_in('employee_no');
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/docs_upload.php");
require_once ("../includes/header.php");

global $db;


?>
<form enctype="multipart/form-data" method="post" action="#" >
    <legend>Apply for job:</legend>
    <table class="table_forms">
        <tr>
            <td colspan="3"> <label>Position applying for:</label><br/>
                <input <?php echo (isset($_GET['aply']) ? 'readonly value="' . $position . '"' : ''); ?>
                    type="text" name="position_applied" required  placeholder="" style="width: 100%"/><br/><br/></td>
        </tr>

        <tr>
            <td colspan="3"> <label>Briefly define yourself with relevance to the job:</label><br/>
                <textarea cols="55" rows="5" name="brief_description" required placeholder=""></textarea><br/><br/></td>
        </tr>
<!--        <tr>
            <td><label>Upload Cover letter:</label></td><td><input type="file" name="cover_leter" ></td>
        </tr>-->
        <tr>
            <td><label>Upload CV:</label></td><td><input type="file" name="cv"></td>
        </tr>

        <tr>
            <th colspan="1" style="text-align: right;"><input class="btn btn-sm btn-info" type="submit" name="submit_application" value="Submit Application"/></th>
        </tr>
    </table>
</form>