<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
//require_once ("../../include/user.php");
//require_once ("../includes/header.php");

if (isset($_GET["act"])) {
    if ($_GET["act"] === "view") {
        view_management();
    }
    if ($_GET["act"] === "edit") {
        edit_mgmt();
    }
    if ($_GET["act"] === "add") {
        add_mngmt();
    }
    if ($_GET["act"] === "del") {
        remove();
    }
}

function edit_mgmt() {
    global $mysqli;
    require_once ("./edit_man_modal.php");
    if (isset($_GET['empnote'])) {
        $table_name = "mngmt";
        $emp_no = $_GET['empnote'];
        $query = "SELECT `emp_no`, `uname`, `fname`, `lname` ,level FROM `$table_name` WHERE emp_no = $emp_no";
        $mn_result = $mysqli->query($query);

        if ($mn_result->num_rows > 0) {
            while ($result_set = mysqli_fetch_assoc($mn_result)) {
                $emp_no = $result_set['emp_no'];
//                $post = $result_set['post'];
                $uname = $result_set['uname'];
                $fname = $result_set['fname'];
                $lname = $result_set['lname'];
                $level = $result_set['level'];

                echo $uname;
                echo '&nbsp;' . $fname;
                echo '&nbsp;' . $lname;
                echo '&nbsp;' . $level;
            }
        } else
            echo 'Error' . $mysqli->error;
    }
}

function remove() {
    global $db;
    $id = $_POST['id'];
    $query = "UPDATE `mngmt` SET `status` = '0' WHERE `mngmt`.`id` = '$id'";
    if ($db->update($query, NULL, NULL) == 1) {
        echo 'Removed';
    } else {
        echo 'Failed';
    }
}

function view_management() {
    global $db;
    global $mysqli;

    $query = "SELECT m.id, m.emp_no, m.uname, m.level,  e.fname, e.lname, e.phone, e.email"
            . " FROM mngmt m, employee e "
            . " WHERE m.emp_no =  e.employee_no"
            . " AND m.status =  '1'";

    $table_name = "mngmt";
    $no = 0;
    echo '<div style = "border: 1px solid lightgrey; border-radius:5px;">'
    . '<h3 style="text-align:center;">View Management</h3><hr/>';
    $res = $db->select($query, NULL, NULL);
    if (!empty($res)) {

        echo'<table class="table table table-hover"> <thead> <tr> '
        . '<th>#</th> <th>Full Name</th> <th>Employee No.</th> <th>Username</th> '
        . '<th>Phone</th> <th>Email</th> <th>Level</th> <th>Remove</th>'
        . '</tr> </thead> <tbody class = "">';

        foreach ($res as $row) {
            $no++;
            $id = $row['id'];
            echo'<tr>';
            echo'<td>' . $no . '</td> <td>' . $row['fname'] . ' ' . $row['lname'] . '</td> <td>' . $row['emp_no'] . '</td> '
            . '<td>' . $row['uname'] . '</td> <td>' . $row['phone'] . '</td> <td>' . $row['email'] . '<td>' . $row['level'] . '</td> </td>';

            echo'<td>';
            ?>&nbsp;&nbsp;
            <button onclick="delete_man('<?php echo$id ?>')" class="btn btn-danger btn-xs fa fa-trash"></button><?php
            echo '</td>';
            echo'</tr>';
        }
        echo'</tbody> </table>';
    } else {
        echo 'No management!!';
    }
    echo'</div>';
}

function add_mngmt() {
    global $db;
    $tablename = 'mngmt';
    $uname = $_POST['uname'];
    $fname = $_POST['fname'];
    $pwd = sha1($_POST['uname']);
    $empno = $_POST['emp_no'];
    $mngmt_level = 3;

    $data = array($empno, $uname, $fname, $mngmt_level, $pwd);
    $type = array('i', 's', 's', 'i', 's');

    $query = "INSERT INTO $tablename "
            . "(`emp_no`, `uname`, `fname`, `level`, `pwd`)"
            . " VALUES (?,?,?,?,?)";

    if ($db->insert($query, $type, $data) == 1) {
        echo 'Management added Successfully.';
    } else {
        echo 'Failed to add management! Management must have an existing employee\'s number';
    }
}
?>