<?php

session_start();
include_once("../../include/config.php");
include_once("../../include/database.php");

class alertJob {

    var $phone;
    var $intv_date;

    function __construct($phone, $intv_date) {
        $this->phone = urlencode($phone);
        $this->intv_date = urlencode($intv_date);
        $this->sendSms($this->phone, $this->intv_date);
    }

    public function sendSms($phone, $intv_date) {
        $msg = urlencode("We are glad to inform you that you are invited for an interview on $intv_date. Thank you in advance. ILTS.");
        $url = "http://localhost:603/cgi-bin/sendsms?username=kannel&password=kannel&to=$phone&text=$msg";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);
        echo "Message sent successfully to ".urldecode($phone)."";

        $table = $_POST['table'];
        $id = $_POST['id'];
        $query = "UPDATE $table SET ligible = 'y' WHERE id = $id";

        global $db;
        if ($db->update($query, NULL, NULL) == 1) {
//            echo 'Edit Suceess';
        } else {
            echo 'Failed to update';
        }
    }

    public static function delete_application() {
        global $mysqli;
        $table = $_POST['table'];
        $id = $_POST['id'];
        $query = "DELETE FROM $table WHERE $table.id = $id";

        if (mysqli_query($mysqli, $query)) {
//            echo 'DELETED Successfully';
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
            new alertJob($_POST["phone"], $_POST["intv_date"]);
            break;

        case "delete" :
//            echo 'delete';
            alertJob::delete_application();
            break;

        default :
            echo 'UNKNOWN';
    }
} else {
    echo 'NOT SET';
}

