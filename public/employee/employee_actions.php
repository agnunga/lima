<?php
require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
Session::confirm_logged_in('employee_no');
//include_once ("../includes/header.php");
include_once ("../includes/docs_upload.php");
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");

if (isset($_GET['em_act']) && $_GET['em_act'] = 'em_apply') {
    apply_job();
}

function view_duty_roster() {
    
}

function add_qualifications() {

    include ("../../public/forms/add_qualifications_form.php");
}

function view_worked_days() {
    
}

function view_job_adverts() {
    require ("../employee/view_job_adverts.php");
}

function apply_job() {
    global $db;
    $advert_id = $_POST['adv_id'];
    $jsid = $_SESSION['employee_no']; //Id to be given by session 
    $desc = $_POST['b_desc'];
    $path_n_name = $_POST['cv'];

    $query0 = "SELECT advert_id, applicant_id FROM applications WHERE advert_id = ? AND applicant_id = ?";

    $type_array0 = array('i', 's');
    $data_array0 = array($advert_id, $jsid);
    if (empty($db->select($query0, $type_array0, $data_array0))) {

        $data1 = array($advert_id, $jsid, $desc);
        $type1 = array('i', 'i', 's');

        $query1 = "INSERT INTO `applications` "
                . " (`advert_id`, `applicant_id`, `relevance`)"
                . " VALUES (?,?,?)";

//Calling the insert method in class database
        if ($db->insert($query1, $type1, $data1) == 1) {
            echo 'Application sucess';
        } else {
            echo 'Submission FAILED';
        }

        $data2 = array($jsid, $path_n_name);
        $type2 = array('i', 's');

        $query2 = "INSERT INTO `cv` "
                . "(`user_id`, `uploaded_to`)"
                . " VALUES (?,?)";

//Calling the insert method in class database
        if ($db->insert($query2, $type2, $data2) == 1) {
            echo ' + CV';
        } else {
            echo 'FL CV';
        }
    } else {
        echo 'Already applied! Cannot reaply.';
    }
}

function view_salary() {
    
}

function view_allowances() {
    
}

function report_issues() {
    
}

function view_leave_info() {
//        require("../forms/request_off_n_leave_form.php");
    global $db;
    $emp_no = $_SESSION['employee_no'];
    $output = '';
    $query = "SELECT odr.emp_id, odr.off_type, odr.start, odr.end, odr.off_desc, odr.response, odr.time_posted "
            . " FROM off_duty_requests odr  "
//            . " WHERE odr.response ='p' "
//            . " AND odr.emp_id = '$emp_no'";
            . " WHERE odr.emp_id = '$emp_no' ORDER BY odr.time_posted DESC LIMIT 10 ";

    $res = $db->select($query, NULL, NULL);
    if (!empty($res)) {
        $output.= '<div style="border:0px solid lightblue; border-radius: 10px;">';
        $output.= '<h4 style="text-align:center; text-decoration:underline;">&nbsp; OFFS AND LEAVES HISTORY. &nbsp;</h4>';
        $output.= '<hr/>';
        $output.= '<table style = "width:100%;" class="table table table-hover table-bordered"> <thead> <tr> '
                . '<th>Date Requested</th> <th>Type</th> <th>Starting.</th> <th>Ending</th> '
                . '<th>Description</th><th>Approved</th>'
                . '</tr> </thead> <tbody class = "">';

// print_r($res);
        foreach ($res as $row) {
            $postedon = $row['time_posted'];
            $off = $row['off_type'];
            $start = $row['start'];
            $end = $row['end'];
            $desc = $row['off_desc'];
            $re = $row['response'];

            switch ($re) {
                case 'p':
                    $resp = '<p style="color:brown;">Pending</p>';
                    break;
                case 'g':
                    $resp = 'Granted';
                    break;
                case 'r':
                    $resp = 'Rejected';
                    break;
                default :
                    $resp = 'Rejected';
            }

            switch ($off) {
                case 1:
                    $offtype = 'Sick off';
                    break;
                case 2:
                    $offtype = 'Matanity leave';
                    break;
                case 3:
                    $offtype = 'Partanity leave';
                    break;
                default :
                    $offtype = 'Partanity leave';
            }


            $output.='<tr>';
//                $output.='<td>' . $row['emp_id'] . '</td>';
            $output.='<td>' . $postedon . '</td>';
            $output.='<td>' . $offtype . '</td>';
            $output.='<td>' . $start . '</td>';
            $output.='<td>' . $end . '</td>';
            $output.='<td>' . $desc . '</td>';
            $output.='<td>' . $resp . '</td>';
            $output.='</tr>';
        }
        $output .= '</tbody> </table>';
        $output.='</div>';
    } else {
        $output.= '<h4 style="text-align:center; text-decoration:none;">&nbsp;No records on offs and leaves requested by you.' . $emp_no . ' &nbsp;</h4>';
    }
    return $output;
}

function request_sick_offs_leaves() {
    
}

function request_emmergence_loans() {
    
}

function make_enquery() {
//    echo 'Enq Goes here...';
    if (isset($_POST['send_c_enquiry'])) {
        $title = $_POST['title'];
        $brief_description = $_POST['brief_description'];
        $user = $_SESSION['employee_no'];
        $query = "INSERT INTO `enquiries`"
                . " (`user`, `title`, `brief_description`, `posted_time`)"
                . " VALUES (?,?,?, CURRENT_TIMESTAMP)";
        global $db;
        $data_array = array($user, $title, $brief_description);
        $type_array = array('s', 's', 's');
        if ($db->insert($query, $type_array, $data_array) == 1) {
            echo 'Enquiry send Success.';
        } else {
            echo 'Enquiry sending faled';
        }
    }
    ?>
    <form action="#" method="post" enctype="multipart/form-data">
        <legend>Make enquiry</legend>
        <table  class="table_forms">
            <tr>
                <td colspan="3"> <label>Enquiry Title:</label><br/>
                    <input type="text" name="title" required  placeholder="" style="width:100%;"/><br/><br/>
                </td>
            </tr>
            <tr>
                <td colspan="3"> <label>Enquiry body:</label><br/>
                    <textarea cols="40" rows="4" name="brief_description" required placeholder=""></textarea>
                </td>
            </tr>

            <tr>
                <th colspan="1">&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-sm btn-info" name="send_c_enquiry" value=" Send "/></th>
            </tr>
        </table>
    </form><?php
}

function past_enquery() {
    echo '<h3 style="text-align:center; margin-top:-15px;">Past Enqueries.</h3>';
    global $db;
    $user = $_SESSION['employee_no'];
    $query = "SELECT * FROM `enquiries`"
            . " WHERE user = '$user' "
            . "  ORDER BY `id` DESC";
    $res = $db->select($query, NULL, NULL);
    echo '<div style="margin:30px 10px;padding:0px; border:1px solid lightgrey; border-radius:5px;">';
    if (!empty($res)) {
        $no = 0;
        echo '<table class="table table table-hover"> <thead> <tr> '
        . '<th>#</th> <th>Enquery</th> <th>Description</th> <th>Date of enquery</th> '
        . '<th>Response</th>'
        . '</tr> </thead> <tbody class = "">';
        foreach ($res as $row) {
            $no++;
//            echo $row['id'], $row['user'], $row['title'], $row['brief_description'], $row['posted_time'], $row['response'], $row['date_responded'];
            echo
            '<tr>'
            . ' <td> ' . $no . '</td>'
            . '<td style="text-align:left;">' . $row['title'] . '</td> '
            . ' <td> ' . $row['brief_description'] . '</td>'
            . '<td>  ' . $row['posted_time'] . '</td>';
            if (empty($row['date_responded'])) {

                echo '<td style="color:brown;">Pending</td> ';
            } elseif (!empty($row['date_responded'])) {

                echo '<td> Response: ' . $row['response'] . '<br/> Date: ' . $row['date_responded'] . '</td> ';
            }
            echo '</tr>';
        }
        echo '</tbody> </table>';
    } else {
        echo 'No previous enqueries.';
    }
    echo '</div>';
    ?>

    <?php
}

//view_duty_roster();
//add_qualifications();
//view_worked_days();
//view_job_adverts();
//apply_job();
//add_profile_pic();
//view_salary();
//view_allowances();
//report_issues();
//view_offs();
//view_leave_info();
//request_sick_offs_leaves();
//request_emmergence_loans();