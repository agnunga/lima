<?php

require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
Session::confirm_logged_in('employee_no');
//include_once ("../includes/header.php");
include_once ("../includes/docs_upload.php");
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");

global $db;
//emp_id gotten from session
$emp_id = $_SESSION['employee_no'];
$off_type = $_POST['oftype'];
$sdate = $_POST['sdat'];
$edate = $_POST['edat'];
$off_desc = $_POST['off_desc'];

$array_type = array('i', 'i', 's', 's', 's');
$array_data = array($emp_id, $off_type, $sdate, $edate, $off_desc);
$query = "INSERT INTO off_duty_requests"
        . " (emp_id, off_type, start, end, off_desc)"
        . " VALUES (?,?,?,?,?)";
if ($db->insert($query, $array_type, $array_data) == 1) {
    echo 'Request send.';
} else {
    echo 'Sending failed.';
}
//    echo $off_type . '&nbsp;&nbsp;&nbsp;' . $sdate . '&nbsp;&nbsp;&nbsp;' . $edate . '&nbsp;&nbsp;&nbsp;' . $off_desc;