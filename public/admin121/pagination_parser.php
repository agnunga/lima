<?php

require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");

global $mysqli;
$dataString = '';

//if (isset($_GET['pn'])) {
//    $rpp = preg_replace('#[^0-9]#', '', $_GET['rpp']);
//    $last = preg_replace('#[^0-9]#', '', $_GET['last']);
//    $pn = preg_replace('#[^0-9]#', '', $_GET['pn']);
$rpp = 20;
$last = 2;
$pn = 1;
    if ($pn < 1) {
        $pn = 1;
    } elseif ($pn > $last) {
        $pn = $last;
    }
    $table_name = "mngmt";
    $limit = "LIMIT " . ( $pn - 1 ) * $rpp . ", " . $rpp;

    $query = "SELECT emp_no, uname, fname, lname ,level FROM mngmt ORDER BY emp_no DESC $limit";

    $results = mysqli_query($mysqli, $query);
    while ($results_set = mysqli_fetch_assoc($results)) {
        $emp_no = $results_set['emp_no'];
        $fname = $results_set['fname'];
        $lname = $results_set['lname'];
        $level = $results_set['level'];
        $uname = $results_set['uname'];
        $dataString.=$emp_no . '|' . $fname . '|' . $lname . '|' . $level . '|' . $uname . '||';
    }
    global $db;
    $db->close_db();
    echo $dataString;
    exit();
//} //elseif (isset($_GET['rpp'])) {
////    $dataString = "Pn|jap|sa|nothing|bobo||";
////    echo $dataString;
////} elseif (isset($_POST['last'])) {
////    $dataString = "Last|jap|sa|nothing|bobo||";
////    echo $dataString;
////}
//else{
//    $dataString = "None|jap|sa|nothing|bobo||";
//    echo $dataString;
//}