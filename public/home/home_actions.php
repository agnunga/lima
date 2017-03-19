<?php
//include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");

(isset($_GET['home_act']) && $_GET['home_act'] == "js_apply") ? apply_job() : '';

function request_to_be_client() {
    include ("../forms/request_to_be_client_form.php");
}

if (isset($_GET['act']) && $_GET['act'] === 'get_job_done') {
    get_job_done();
}

function get_job_done() {
    global $db;
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $company_name = $_POST['company_name'];
    $location = $_POST['location'];
    $job_sdate = $_POST['job_sdate'];
    $job_edate = $_POST['job_edate'];
    $job_type = $_POST['job_type'];
    $job_description = $_POST['job_description'];

    $query = "INSERT INTO `non_client_requests` "
            . "(`full_name`, `phone`, `company_name`, `location`, `job_sdate`, `job_edate`, `job_type`, `job_description`)"
            . " VALUES (?,?,?,?,?,?,?,?)";

    $type_array = array('s', 's', 's', 's', 's', 's', 's', 's');
    $data_array = array($full_name, $company_name, $phone, $location, $job_sdate, $job_edate, $job_type, $job_description);
    if ($db->insert($query, $type_array, $data_array) == 1) {
        echo '';
        ?><script> faddingAllert("#alert_message", "alert-success", "Request successfully sent");
        </script><?php
    } else {
//        echo 'Insert failed';
        ?><script> faddingAllert("#alert_message", "alert-error", "Failed to send request Success");
        </script><?php
    }
}

function apply_job() {
    global $db;
    $adv_id = $_POST['adv_id'];
    $natid = $_POST['natid'];
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $b_desc = $_POST['b_desc'];
    $cv = $_POST['cv'];
    $query = "SELECT advert_id, natid FROM js_applications WHERE advert_id = ? AND natid = ?";

    $type_array = array('i', 's');
    $data_array = array($adv_id, $natid);
    if (empty($db->select($query, $type_array, $data_array))) {
        $query = "INSERT INTO js_applications (advert_id, natid, full_name, phone, relevance)"
                . " VALUES (?, ?, ?, ?, ?)";
        $type_array = array('i', 'i', 's', 'i', 's');
        $data_array = array($adv_id, $natid, $full_name, $phone, $b_desc);
        if ($db->insert($query, $type_array, $data_array) == 1) {
            echo 'Job request send successfully';
        } else {
            echo 'Failed to send.';
        }
        $query1 = "INSERT INTO `cv` "
                . "(`user_id`, `uploaded_to`)"
                . " VALUES (?,?)";
        $type_array1 = array('i', 's');
        $data_array1 = array($natid, $cv);
        if ($db->insert($query1, $type_array1, $data_array1) == 1) {
            echo 'CV Inserted';
        } else {
            echo 'CV F I';
        }
    } else {
        echo 'Cannot reapply. You had alredy applied for this job';
    }
}

function add_qualifications() {
    include ("../forms/add_qualifications_form.php");
}

function add_profile_pic() {
    include ("../forms/add_profile_pic_form.php");
}

function upload_cv() {
    include ("../forms/");
}

function view_job_adverts() {
//    include '../home/view_job_adverts_autoload.php';
}

function view_qualified() {
    global $mysqli;
    $total_empoyees = 0;
    $total_hob_seekers;
    $query = "SELECT COUNT(employee_no) FROM employee WHERE status='1'";
    $query0 = "SELECT COUNT(id) FROM users WHERE status='1'";

    $result = $mysqli->query($query);
    while ($resultset = mysqli_fetch_row($result)) {
        $total_empoyees = $resultset['0'];
        echo'<h6>We have <span style="color: blue">' . $total_empoyees . '</span> employees already working for our various clients, ';
    }
    $result0 = $mysqli->query($query0);
    while ($resultset0 = mysqli_fetch_row($result0)) {
        $total_hob_seekers = $resultset0['0'];
        echo'and over <span style="color: blue">' . $total_hob_seekers . '</span> potential persons with different qualifications interested in getting hired. </h6>' . '<br/>';
    }
}

//view_qualified(); 

