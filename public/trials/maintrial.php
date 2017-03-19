<?php
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");

function view() {
    global $mysqli;
    $query = "SELECT id, name FROM `aaref` WHERE id > ? ORDER BY `id` ASC";
    $stm = $mysqli->prepare($query);
    $lest_id = 0;
    $stm->bind_param("i", $lest_id);
    $stm->bind_result($id, $name);
    $stm->execute();
    while ($stm->fetch()) {
        echo $id . ': ' . $name . ' <a href="maintrial.php?delete=' . $id . '"> Delete</a>';
        echo '&nbsp; &nbsp;<a href="maintrial.php?edit=' . $id . '"> Edit</a><br/>';
    }
    if (isset($_GET['edit'])) {
        $query = "SELECT id, name FROM `aaref` WHERE id = ? ORDER BY `id` ASC";
        $stm = $mysqli->prepare($query);
        $get_id = $_GET['edit'];
        $stm->bind_param("i", $get_id);
        $stm->bind_result($id, $name);
        $stm->execute();
        $stm->fetch();

        if (isset($_POST['save_changes'])) {
            $edtdname = $_POST['edtuname'];
            $theid = $_GET['edit'];
            $query = " UPDATE aaref SET name = ' ? ' WHERE id = '?'";

            if ($stm = $mysqli->prepare($query)) {
                $stm->bind_param("si", $edtdname, $theid);
                $stm->execute();
                if ($stm->affected_rows == 1) {
                    echo 'UPDATE SICCESS';
                } else {
                    echo 'The failed name ' . $edtdname . 'and failed id id: ' . $theid;
                    echo 'Update failed' . $mysqli->error;
                }
            } else {
                echo 'Failed to prepare'.$query;
                echo '<br/>Thus failed to BIND name ' . $edtdname . '  and id: ' . $theid;
            }
        }
        echo '
            <form class = "" method = "post" action = "" enctype = "multipart.form-data">
                <input type = "text" name = "edtuname" value="' . $name . '">
                <input type = "submit" name = "save_changes" value = "Save changes" class = "btn-sm">
            </form';
    }
    ?>
    <a href="maintrial.php?add=true"><button>Add now</button></a>
    <?php
}

function add() {
    global $mysqli;
    if (isset($_POST['add_uname'])) {
        $query = "INSERT INTO `aaref` (`name`) VALUES (?)";
        $name = $_POST['uname'];
//        $data_array = array($name);
//        $type_array = array('s');
        $stm = $mysqli->prepare($query);
        $stm->bind_param("s", $name);
        $stm->execute();
        if ($stm->affected_rows == 1) {
            echo 'Success<br/>';
        } else {
            echo 'Failed' . $mysqli->error;
        }

        view();
    } else {
        echo '
            <form class = "" method = "post" action = "" enctype = "multipart.form-data">
                <input type = "text" name = "uname">
                <input type = "submit" name = "add_uname" value = "Add user" class = "btn-sm">
            </form';
    }
}

function delete() {
    global $mysqli;
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $query = "DELETE FROM `aaref` WHERE `aaref`.`id` = ?";
        $stm = $mysqli->prepare($query);
        $stm->bind_param("i", $id);
        $stm->execute();
        view();
        if ($stm->affected_rows == 1) {
            echo 'DELETED';
        } else {
            echo 'FAILED' . $mysqli->error;
        }
    }
}

if (!isset($_GET['delete']) && !isset($_GET['add'])) {
    view();
}
if (isset($_GET['add'])) {
    add();
}
if (isset($_GET['delete'])) {
    delete();
}


$indicesServer = array('PHP_SELF',
    'argv',
    'argc',
    'GATEWAY_INTERFACE',
    'SERVER_ADDR',
    'SERVER_NAME',
    'SERVER_SOFTWARE',
    'SERVER_PROTOCOL',
    'REQUEST_METHOD',
    'REQUEST_TIME',
    'REQUEST_TIME_FLOAT',
    'QUERY_STRING',
    'DOCUMENT_ROOT',
    'HTTP_ACCEPT',
    'HTTP_ACCEPT_CHARSET',
    'HTTP_ACCEPT_ENCODING',
    'HTTP_ACCEPT_LANGUAGE',
    'HTTP_CONNECTION',
    'HTTP_HOST',
    'HTTP_REFERER',
    'HTTP_USER_AGENT',
    'HTTPS',
    'REMOTE_ADDR',
    'REMOTE_HOST',
    'REMOTE_PORT',
    'REMOTE_USER',
    'REDIRECT_REMOTE_USER',
    'SCRIPT_FILENAME',
    'SERVER_ADMIN',
    'SERVER_PORT',
    'SERVER_SIGNATURE',
    'PATH_TRANSLATED',
    'SCRIPT_NAME',
    'REQUEST_URI',
    'PHP_AUTH_DIGEST',
    'PHP_AUTH_USER',
    'PHP_AUTH_PW',
    'AUTH_TYPE',
    'PATH_INFO',
    'ORIG_PATH_INFO');

echo '<table cellpadding="15">';
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        echo '<tr><td>' . $arg . '</td><td>' . $_SERVER[$arg] . '</td></tr>';
    } else {
        echo '<tr><td>' . $arg . '</td><td>-</td></tr>';
    }
}
echo '</table>';
