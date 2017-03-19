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
        ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-success", "Request sent successfully.");
        </script><?php
    } else {
//        Redirect::to("client.php?tobeclient=0");
        ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-success", "Request sending failed.");
        </script>
        <?php
    }
}
?>