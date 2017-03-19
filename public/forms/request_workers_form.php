<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");
if (isset($_POST['request_workers'])) {
    global $db;
    $no_w = $_POST['no_workers'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $response = "";
    $brief_description = $_POST['brief_description'];
    $req_client_id = $_SESSION['cuname'];
    $respondent_id = '';

    $query = "INSERT INTO `client_requests` (num_req, start_date, end_date, response, req_desc, req_client_id, time_requested, respondent_id) VALUES (?,?,?,?,?,?,CURRENT_TIMESTAMP,?)";

    $data_array = array($no_w, $start_date, $end_date, $response, $brief_description, $req_client_id, $respondent_id);
    $type_array = array('i', 's', 's', 's', 's', 's', 's');

    if ($db->insert($query, $type_array, $data_array) == 1) {
        echo 'Request send successfull';
    } else {
        echo 'FAILED to send request';
    }
}
?>
<form action="#" method="post">
    <legend>Request for workers</legend>
    <table class="table_forms">
        <tr>
            <td colspan="2"><label> Number of workers: </label> <input type="text"  name="no_workers" required="" size="3" maxlength="3">  workers</td> 
        </tr>
        <tr>
            <td><label>Starting on: </label> 
                <?php
//                $start_age = 0;
//                $end_age = 0;
//                require_once ("../forms/date_input.php");
                ?>
            </td><td><input type="text" name="start_date" id="work_start_date" readonly required></td>
        </tr>
        <tr><td><label>Ending on: </label> </td>
            <td><input type="text" name="end_date" id="work_end_date" readonly required></td>
        </tr>

        <tr>
            <td colspan="3"><label> Brief description of the work</label></td>
        </tr>
        <tr>
            <td colspan="3"><textarea cols="36" rows="3" name="brief_description" required placeholder=""></textarea></td>
        </tr>
<!--        <tr>
            <td>
                <label>Kind: </label> 
                <input type="checkbox" value="s">Skilled
                <input type="checkbox" value="m">Semi skilled
            </td>
        </tr>-->

<!--        <tr>
            <td>
                <label>The job will take:</label> <input type="text"  name="days" required="" size="1" maxlength="2">   days<br/>
            </td>
        </tr>-->
        <tr>
            <td colspan="" style="text-align: center;"><input type="submit" class="btn btn-sm btn-info" name="request_workers" value="Submit request"/></td>
        </tr>
    </table>
</form>