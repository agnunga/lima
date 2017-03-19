<?php

include_once ("../include/session.php");
require_once ("../include/config.php");
require_once ("../include/database.php");
require_once ("../include/redirect.php");


//$username = "cuname";
//$table_name = 'client';
login_user('uname', 'mngmt');
login_user('cuname', 'client');
login_user('employee_no', 'employee');

$output = "";

function login_user($username, $table_name) {
    global $db;
    $user = $_POST['uname']; //uname, pwd
    $pwd = sha1($_POST['pwd']);
    $query = "SELECT $username, fname, pwd  FROM $table_name WHERE $username = ? AND pwd = ? LIMIT 1";
    $type_array = array('s', 's');
    $data_array = array($user, $pwd);

    $res = $db->select($query, $type_array, $data_array);
    if (!empty($res)) {
        foreach ($res as $row) {
            $_SESSION[$username] = $row[$username];
            $empno = $_SESSION[$username];
            $_SESSION['fname'] = $row['fname'];
//        echo 'Login success';
//        echo 'SESSION NAME' . $_SESSION['fname'];
//        Redirect::to("../client/index.php?rdr=1");
            $output = 'A';
        }
    } else {
        $query = "SELECT fname $username, pwd  FROM $table_name WHERE $username = ?";
        $type_array = array('s');
        $data_array = array($user);

        $res = $db->select($query, $type_array, $data_array);
        if (!empty($res)) {
            $output = '1';
//                    echo '.' . $user . '.' . $pwd . '.' . $login . '.';
        } else {
            $output = '0';
        }
    }
    echo $output;
}
