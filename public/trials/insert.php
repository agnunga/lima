<?php

include_once ("../includes/header.php");
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");

if (isset($_GET['act'])) {
    $fun = $_GET['act'];
    switch ($fun) {
        case "select" :
            echo 'SELECT';
            select();
            break;

        case "insert" :
            echo 'SELECT';
            insert();
            break;

        case "edit" :
            echo 'SELECT';
            update();
            break;

        case"delete":
            echo 'DELETE';
            delete();
            break;

        default :
            echo 'UNKNOWN';
    }
} else {
    echo 'NOT SET';
}

function insert() {
    global $mysqli;
    $sql = "INSERT INTO `tbl_sample` (first_name, last_name) VALUES ('" . $_POST["first_name"] . "', '" . $_POST["last_name"] . "')";
    if (mysqli_query($mysqli, $sql)) {
        echo 'Data inserted';
    }
}

function update() {
    $id = $_POST['id'];
    $text = $_POST['text'];
    $column_name = $_POST['column_name'];

    global $mysqli;
    $sql = "UPDATE tbl_sample SET " . $column_name . " = '" . $text . "' WHERE id=" . $id . "";
    if ($res = mysqli_query($mysqli, $sql)) {
        echo 'Data edited';
    } else {
        echo 'Edit Failed' . mysqli_error($mysqli) . '<br/>';
        echo $sql;
    }
}

function delete() {
    global $mysqli;
    $id = $_POST['id'];
    $sql = "DELETE FROM tbl_sample WHERE id = " . $id . "";
//DELETE FROM `tbl_sample` WHERE `tbl_sample`.`id` = 3 
    if (mysqli_query($mysqli, $sql)) {
        echo 'DELETED Successfully';
    } else {
        echo 'FAILED DELETE' . mysqli_error($mysqli);
    }
}

function select() {
    $output = '';
    $sql = "SELECT * FROM tbl_sample ORDER BY id DESC";
    global $mysqli;
    $result = mysqli_query($mysqli, $sql);
    $output.='<div class="table-responsive">
    <table class="table table-bordered">
        <tr>    
            <th width="10%">ID</th>
            <th width="40%">First</th>
            <th width="40%">Last</th>
            <th width="10%">Delete</th>
        </tr>';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output.='<tr>'
                    . '<td>' . $row['id'] . '</td>'
                    . '<td class="first_name" data-id1="' . $row['id'] . '" contenteditable>' . $row['first_name'] . '</td>'
                    . '<td class="last_name" data-id2="' . $row['id'] . '" contenteditable>' . $row['last_name'] . '</td>'
                    . '<td><button name="btn_delete" class="btn_delete" data-id3="' . $row['id'] . '">x</button></td>'
                    . '</tr>';
        }
        $output.='<tr>'
                . '<td></td>'
                . '<td id="first_name" contenteditable></td>'
                . '<td id="last_name" contenteditable></td>'
                . '<td><button name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>'
                . '</tr>';
    } else {
        $output.='<tr><td colspan="4"></td>Data not found</tr>';
    }
    $output.=' </table>
    </div>';
    echo $output;
}
?>