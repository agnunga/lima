<?php

require_once ("../../include/redirect.php");
require_once ("../../include/config.php");
require_once ("../../include/database.php");
header('Content-type: application/pdf');

$uid = $_POST['uid'];
$cv_name = $_POST['name'];

$query = "SELECT uploaded_to FROM cv "
        . " WHERE user_id = '$uid' LIMIT 1";
global $db;
$res = $db->select($query, NULL, NULL);
if (!empty($res)) {
    foreach ($res as $row) {
        echo $row['uploaded_to'];
//        Redirect::to($row['uploaded_to']);
//        header('Content-Disposition: attachment; filename="$cv_name"');
//        readfile($row['uploaded_to']);
//        file($row['uploaded_to']);
    }
} else {
    echo 'CV DOES NOT EXIST';
}


