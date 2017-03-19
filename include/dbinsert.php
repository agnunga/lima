<?php

require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");

class dbinsert {

    public function edit_management() {
        global $mysqli;
        require_once ("./edit_man_modal.php");
        if (isset($_GET['empnote'])) {

            $query = "UPDATE mngmt SET emp_no = ?, uname = ?, level = ? WHERE idmngmt = ? ";
            $id = $_GET['empnote'];
            $empno = $_POST['empno'];
            $uname = $_POST['uname'];
            $level = $_POST['level'];

            $stm = $mysqli->prepare($query);
            $stm->bind_param('isii', $empno, $uname, $level, $id);
            $stm->execute();
            if($stm->affected_rows()==1){
                echo 'SUCCESS UPDATE';
            }  else {
                echo 'UPDATE FAILED';    
            }
        }
    }

}

$dbin = new dbinsert();
