<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");
require_once ("../mgmt/mgmt_actions.php");


global $db;

if (isset($_POST['submit_j_adv'])) {

    $position_applied = $_POST['position_applied'];
    $number_needed = $_POST['number_needed'];
    $apply_before = $_POST['apl_edate'];
    $interview_date = $_POST['interview_date'];
    $qualification_req = $_POST['qualification_req'];
    $duties = $_POST['duties'];
    $adv_by = $_SESSION['uname'];

    $query = "INSERT INTO job_advert"
            . " (advert_by, position, number_needed, apply_before, interview_date, qualifications_needed, duties) "
            . "VALUES (?,?,?,?,?,?,?)";

    $type_array = array('s', 's', 'i', 's', 's', 's', 's');
    $data_array = array($adv_by, $position_applied, $number_needed, $apply_before, $interview_date, $qualification_req, $duties);


    if ($db->insert($query, $type_array, $data_array) == 1) {
        echo 'Success! Posted.';
    } else {
        echo 'FAILED. Try again later.';
    }
} elseif (isset($_POST['submit_save_adv_changes'])) {


    $position_applied = $_POST['position_applied'];
    $number_needed = $_POST['number_needed'];
    $apply_before = $_POST['apl_edate'];
        $interview_date = $_POST['interview_date'];
    $qualification_req = $_POST['qualification_req'];
    $duties = $_POST['duties'];
    $adv_by = $_SESSION['uname'];
    $status = $_POST['status'];

    $id = $_GET['edit'];
    $query = "UPDATE job_advert"
            . " SET advert_by = ?, position = ?, number_needed = ?, apply_before = ?, interview_date = ?, qualifications_needed = ?, duties = ?, status = ? WHERE id = ?";

    $type_array = array('s', 's', 'i', 's', 's','s', 's', 's', 'i');
    $data_array = array($adv_by, $position_applied, $number_needed, $apply_before,$interview_date, $qualification_req, $duties, $status, $id);

    if ($db->update($query, $type_array, $data_array) == 1) {
        echo 'Success! Edited and Saved.<br/>';
    } else {
        echo 'FAILED. Try again later.';
    }
}
?>
<form <?php echo '' . (isset($_POST['submit_save_adv_changes']) ? 'class="hidden"' : ''); ?> action="" method="post" class="create_job_advert_form">
    <legend><?php echo (isset($_GET['edit']) ? 'Edit job advert' : 'Create a job advert'); ?></legend>
    <table>
<!--        <tr>
            <td>National ID Number:</td>
            <td><input type="text" name="national_id" required autofocus placeholder="ID number"/></td>
        </tr>-->
        <tr <?php echo (isset($_GET['edit']) ? '' : 'class="hidden"') ?>>
            <td colspan="1"><label> Visible:</label></td>
            <td colspan="2">
                <input type="radio" name="status" value="1" checked>Visible&nbsp;&nbsp;
                <input type="radio" name="status" value="0" >Not visible&nbsp;&nbsp;
                <input type="radio" name="status" value="2" >Expired</td>
        </tr>
        <tr>
            <td colspan="1"><label> Position:</label></td>
        </tr>
        <tr>
            <td colspan="3"><input type="text" name="position_applied" required <?php echo (isset($_GET['edit']) ? 'value="' . $position . '"' : ''); ?> placeholder="" style="width:100%;" maxlength="255"/></td>
        </tr>
        <tr style="height: 12px;"></tr>
        <tr>
            <td colspan="1"> <label>Persons need:&nbsp;</label><input type="text" name="number_needed"  <?php echo (isset($_GET['edit']) ? 'value="' . $number_needed . '"' : ''); ?>  required  placeholder="" size="6" maxlength="4"/></td>
            <td colspan="1">&nbsp;&nbsp;&nbsp;&nbsp; Apply before:&nbsp;<input type="text" name="apl_edate"  <?php echo (isset($_GET['edit']) ? 'value="' . $apply_before . '"' : ''); ?>  id="apl_edate" readonly required</td>
        </tr>
        <tr style="height: 12px;"></tr>
        <tr>
            <td colspan="2"><label> Qualification Requirements:</label></td>
        </tr>
        <tr>
            <td colspan="3"><textarea cols="54" rows="3" name="qualification_req"    required placeholder="" maxlength="1000"><?php echo (isset($_GET['edit']) ? $qualifications_needed : ''); ?></textarea></td>
        </tr>
        <tr style="height: 12px;"></tr>
        <tr>
            <td colspan="2"><label> Duties & responsibilities:</label></td>
        </tr>
        <tr>
            <td colspan="3"><textarea cols="54" rows="5" name="duties"    required placeholder="" maxlength="1000"><?php echo (isset($_GET['edit']) ? $duties : ''); ?></textarea></td>
        </tr>
        <tr style="height: 12px;"></tr>
        <tr>
            <td colspan="2"><label> Interview Date:&nbsp;</label><input type="text" name="interview_date"  <?php echo (isset($_GET['edit']) ? 'value="' . $interview_date . '"' : ''); ?>  id="interview_date" readonly required</td>
        </tr>
        <tr style="height: 12px;"></tr>
        <tr>
            <th colspan="2"><input type="submit" class="btn btn-sm btn-info"  <?php echo (isset($_GET['edit']) ? 'name="submit_save_adv_changes" value="Save changes"' : 'name="submit_j_adv" value="Advertise Job"'); ?>/></th>
        </tr>
    </table>
</form>
<script>
    $(function () {

        $("#apl_edate").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: +7,
            showAnim: "slide",
            minDate: "+10d",
            maxDate: "+1m"
        });
        $("#interview_date").datepicker({
            dateFormat: "yy-mm-dd",
            defaultDate: +7,
            showAnim: "slide",
            minDate: "+10d",
            maxDate: "+2m"
        });
        //
    });
</script>