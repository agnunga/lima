<?php

require_once ("../../include/config.php");
require_once ("../../include/database.php");
//require_once ("../../include/user.php");
//require_once ("../includes/header.php"); 

global $db;
$response = $_POST['resp'];
$id = $_POST['id'];

$query = "UPDATE enquiries SET response = ?, date_responded = CURRENT_TIMESTAMP WHERE id = ?";
$data_array = array($response, $id);
$type_array = array('s', 'i');

if ($db->update($query, $type_array, $data_array) == 1) {
    echo 'Response sent successfully.';
} else {
    echo 'Failed to send response.';
}

