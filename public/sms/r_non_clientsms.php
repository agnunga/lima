<?php

session_start();
include_once("../../include/config.php");
include_once("../../include/database.php");

class alertClient {

    var $phone;
    var $intv_date;

    function __construct($phone, $message) {
        $this->phone = urlencode($phone);
        $this->intv_date = urlencode($message);
        $this->sendSms($this->phone, $this->intv_date);
    }

    public function sendSms($phone, $message) {
        $msg = urlencode("$message. Thank you in advance. ILTS.");
        $url = "http://localhost:603/cgi-bin/sendsms?username=kannel&password=kannel&to=$phone&text=$msg";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);
        echo "Message sent successfully to $phone($message)";

        $id = $_POST['id'];
        $query = "UPDATE `non_client_requests` SET `response` = 'y', resp_sms = '$message', time_responded=CURRENT_TIMESTAMP WHERE `non_client_requests`.`id` = $id;";

        global $db;
        if ($db->update($query, NULL, NULL) == 1) {
            echo 'Edit Suceess';
        } else {
            echo 'Failed to update';
        }
    }

    public static function delete() {
        global $mysqli;
        $id = $_POST['id'];
        $query = "DELETE FROM non_client_requests WHERE id = $id";

        if (mysqli_query($mysqli, $query)) {
            echo 'DELETED Successfully';
        } else {
            echo 'Failed to delete.' . mysqli_error($mysqli);
        }
//        echo 'Deleted*' . $table . ' ' . $id . ' ';
    }

}

if (isset($_GET['act'])) {
    $fun = $_GET['act'];
    switch ($fun) {
        case "sms" :
//            echo 'sms';
            new alertClient($_POST["phone"], $_POST["msg"]);
            break;

        case "delete" :
//            echo 'delete';
            alertClient::delete();
            break;

        default :
            echo 'UNKNOWN';
    }
} else {
    echo 'NOT SET';
}

