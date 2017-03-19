<?php
require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
Session::confirm_logged_in('uname');
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
require_once("../forms/register_new_user_modal.php");

if (isset($_GET['act'])) {

    switch ($_GET['act']) {

        case "checkin":
            echo 'SELECT';
            emp_checkin();
            break;

        case "select":
            echo 'SELECT';
            view_checked_in();
            break;

        case "checkout":
            echo 'CHECKIN';
            emp_checkout();
            break;

        default :
            echo 'NOTHONG';
    }
} else {
    
}

function emp_checkin() {

    if (isset($_POST['check_in'])) {

        global $db;
        $nat_id = $_POST['natid'];
        $manid = $_SESSION['uname'];

        $query_in = "INSERT INTO attendance (natid, check_in, checkin_by) VALUES (?, CURRENT_TIMESTAMP, ?)";

        $type_array = array('i', 's');
        $data_array = array($nat_id, $manid);

        if ($db->insert($query_in, $type_array, $data_array) == 1) {

            echo 'Checked in by: ' . $manid;
        } else {

            echo 'FAILED!!';
        }
    }
    ?><div id="check_out">
        <fieldset style="width: 180px; height: 110px; text-align: center; border-radius: 10px; border: 1px solid blue;" >
            <h4 style="text-align: center;">Checking in.</h4>
            <form method="post" action="">
                <label>Enter ID.:&nbsp;&nbsp;</label>
                <input type="text" name="natid" autofocus size="7" minlength="8" maxlength="8">
                <input type="submit" name="check_in" value="Check in" title="Confirm Attendance and report to work" style="margin: 5px;">
            </form>
        </fieldset>
    </div><?php
}

function view_checked_in() {

    $output = '';
    global $db;
    $query = "SELECT natid FROM attendance WHERE checkout_by = ''";

    $res = $db->select($query, NULL, NULL);
    foreach ($res as $row) {

        $output.= '<input type="checkbox" name="natid[]" value="' . $row['natid'] . '"/>' . $row['natid'] . '<br/>';
    }
    return $output;
}

function emp_checkout() {

    $sel_id = array();
    if (isset($_POST['check_out'])) {

        global $db;
        $manid = $_SESSION['uname'];
        echo '<br/>' . $manid;
        $nat_ids = $_POST['natid'];

        foreach ($nat_ids as $nat_id) {

            echo $nat_id;
            $query_out = "UPDATE attendance SET check_out = CURRENT_TIMESTAMP, checkout_by = ? WHERE attendance.natid = ?";

            $type_array = array('s', 'i');
            $data_array = array($manid, $nat_id,);

            if ($db->update($query_out, $type_array, $data_array) == 1) {

                echo 'Checked Out by : ' . $manid;
            } else {

                echo 'FAILED!!';
            }
            $sel_id[] = $nat_id;
        }
    }
    ?><div id="check_out_confirm">
        <form method="post" action ="">
            <input type="submit" name="check_out" value="CHECK OUT MARKED"><br/>
            <?php echo view_checked_in(); ?>
            <input type="submit" name="check_out" value="CHECK OUT MARKED">
        </form>
    </div><?php
}

emp_checkin();
emp_checkout();
