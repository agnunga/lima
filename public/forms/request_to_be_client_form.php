<?php
require_once ("../includes/header.php");
require_once ("../../include/redirect.php");
require_once ("../../include/config.php");
require_once ("../../include/database.php");

if (isset($_POST['req_to_be_client'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $coname = $_POST['coname'];
    $loc = $_POST['loc'];

    $array_type = array('s', 's', 's', 's', 's', 's', 's');
    $array_data = array($email, $fname, $lname, $email, $phone, $coname, $loc);

    $query = "INSERT INTO client (cuname, fname, lname, email, phone, company_name, location)"
            . " VALUES (?,?,?,?,?,?,?)";

    if ($db->insert($query, $array_type, $array_data) == 1) {
//        Redirect::to("client.php?tobeclient=1");
        echo '<div id="off_req_alert_message" class="alert alert-success" style=" margin: auto; width:400px; text-align: center; position: fixed; top: 20%; left: 35%; z-index: 1000;" >
                <span class="close" data-dismiss="alert">&times;</span>
                <span><strong>SUCCESS!</strong> Request send.</span>
            </div>'; //
    } else {
//        Redirect::to("client.php?tobeclient=0");
        echo '<div id="off_req_alert_message1" class="alert alert-danger" style=" margin: auto; width:400px; text-align: center; position: fixed; top: 20%; left: 35%; z-index: 1000;" >
                <span class="close" data-dismiss="alert">&times;</span>
                <span><strong>FAILED!</strong>Try again later.</span>
            </div>';
        echo '<script>alert("Failed.")</script>';

//        echo 'Query: ' . $query;
    }
}
?>

<form class="form-horizontal" role="form" method="post" action="" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 10px auto;">
    <legend style="text-align: center;">Request to be a client</legend>
    <div class="form-group">
        <label class="control-label col-sm-2" for="">First name:</label>
        <div class="col-sm-10">
            <input type="text" name="fname" class="form-control" id="" value="<?php echo ""; ?>" required placeholder="" maxlength="32" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Last name:</label>
        <div class="col-sm-10">
            <input type="text" name="lname" class="form-control" id="lname" value="<?php echo ""; ?>" required placeholder=""  maxlength="32">
        </div>
    </div>  
    <div class="form-group">
        <label class="control-label col-sm-2">Email:</label>
        <div class="col-sm-10">          
            <input type="email" class="form-control" name="email"  value="<?php echo ""; ?>" id="" required placeholder=""  maxlength="32">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Phone No.:</label>
        <div class="col-sm-10">          
            <input type="text" class="form-control" name="phone"  value="+254" id="" required placeholder=""  maxlength="13">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Company Name:</label>
        <div class="col-sm-10">          
            <input type="text" class="form-control" name="coname"  value="<?php echo ""; ?>" id="" required placeholder="" maxlength="60">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Location:</label>
        <div class="col-sm-10">          
            <input type="text" class="form-control" name="loc"  value="<?php echo ""; ?>" id="" placeholder="" required maxlength="40">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-3">
            <input type="submit" name="req_to_be_client" class="btn btn-info" value="Submit request">
        </div>
        <div class="col-sm-7">
            <!--If you are already our client <a id="index_client_login" style="cursor: pointer"> click here </a> to login-->
            If you are already our client <a href="../home/login.php" style="cursor: pointer"> click here </a> to login
        </div>
    </div>

</form>
<?php // require_once ("../modals/login_client_modal.php"); ?>
<script>
    //    $(document).ready(function () {
    //        $('#index_client_login').click(function () {
    //            $("#client_login").modal();
    //        });
    //    });
</script>