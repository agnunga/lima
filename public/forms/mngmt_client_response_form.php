<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");
?>
<?php
if (isset($_POST['respond_to_client'])) {

    global $db;
    $id = $_GET['resp'];
    $respondent_id = $_SESSION['uname'];
    $response = $_POST['response'];
    $resp_desc = $_POST['resp_desc'];

    $query = "UPDATE client_requests SET response = ?, resp_desc = ?, respondent_id = ?, time_responded = CURRENT_TIMESTAMP WHERE id = ?";
    $data_array = array($response, $resp_desc, $respondent_id, $id);
    $type_array = array('s', 's', 's', 'i');

    if ($db->update($query, $type_array, $data_array) == 1) {
        echo 'Response sent successfully<br/>';
    } else {
        echo 'Failed to send response.<br/>';
    }
}
?>
<div class="">
    <form <?php echo (isset($_POST['respond_to_client']) || isset($_POST['cancel_responce']) ? 'class = "hidden"' : '') ?> class="form-horizontal" role="form" method="post" action="" style="border: 1px solid lightblue; border-radius: 10px; padding:10px 20px; max-width: 380px;; margin: 10px">
        <legend style="text-align: center;">Respond to client</legend>
        <div class="form-group">
            <label>Response:&nbsp;</label>
            <input type="radio" name="response" value="n" required>No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="response" value="y" required>Yes
        </div>
        <div class="form-group">
            <label>Reason for response:</label>
        </div>
        <div class="form-group">
            <textarea cols="40" rows="2" name="resp_desc" placeholder=""></textarea>   
        </div>
        <div class="form-group">
            <div class="col-sm-offset-1">
                <input type="submit" name="respond_to_client" class="col-sm-3 btn btn-xs btn-success" value="  Send  "><span class="col-sm-2"></span>
                <input type="submit" name="cancel_responce" class="col-sm-4  btn btn-xs btn-warning" value="Cancel">
            </div>
        </div>
    </form>
</div>