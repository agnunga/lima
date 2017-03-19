<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
include_once ("../includes/header.php");
/*
 * 
 * Management actions on clients
 * 
 */

//class Mgmt_actions {
//em_act=search_qual
//Calls by jquery to phpfunctions
(isset($_GET['em_act']) && $_GET['em_act'] = 'search_qual' ? search_qualifications() : '');

function add_client() {
    require ("../forms/add_client_form.php");
}

function edit_client() {
    if (isset($_GET['e_c'])) {
        global $mysqli, $db;
        $id = $_GET['e_c'];

        $query = "SELECT id, fname, lname, email, phone, company_name, location, status, natid, cuname FROM client WHERE id=? AND status  = '1' ORDER BY id DESC";

        $data_array = array($id);
        $typr_array = array('i');

        $res = $db->select($query, $typr_array, $data_array);
        if (!empty($res)) {
            foreach ($res as $row) {
                $id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
                $phone = $row['phone'];
                $company_name = $row['company_name'];
                $location = $row['location'];
                $status = $row['status'];
                $natid = $row['natid'];
                $uname = $row['cuname'];

                require ("../forms/add_client_form.php");
            }
        }
    }
}

function block_clients() {
    
}

function search_clients() {
    
}

function view_non_clients($state) {
    
}

function view_clients($state) {
    global $db;
    $output = '<div style = "border: 1px solid lightgrey; border-radius:5px;">';
    $query = "SELECT id, fname, lname, email, phone, company_name, location, status, natid, cuname FROM client WHERE status=? ORDER BY id DESC";

    $type_array = array('s');
    $data_array = array($state);
    $res = $db->select($query, $type_array, $data_array);
    if (!empty($res)) {
        $no = 0;
        $output .= '<table class="table table table-hover"> <thead> <tr> '
                . '<th>#</th> <th>Name</th> <th>Email</th> <th>Phone</th> '
                . '<th>Company name</th> <th>Location</th> <th>Username</th> <th>Edit</th> '
                . '</tr> </thead> <tbody class = "">';

        foreach ($res as $row) {
            $no++;
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $phone = $row['phone'];
            $company_name = $row['company_name'];
            $location = $row['location'];
            $status = $row['status'];
            $natid = $row['natid'];
            $cuname = $row['cuname'];
            $output .='<tr>';
            $output .='<td>' . $no . '</td> <td>' . $fname . ' ' . $lname . '</td> <td>' . $email . '</td> '
                    . '<td>' . $phone . '</td> <td>' . $company_name . '</td> <td>' . $location . '</td>'
                    . '<td>' . $cuname . '</td>';
            //echo '<br/>' . $fname . '<br/>' . $cuname . '<br/>' . $lname . '<br/>' . $email . '<br/>' . $phone . '<br/>' . $company_name . '<br/>' . $location . '<br/>' . $status . '<br/>' . $natid . '<br/>';
            if (isset($_GET['e_c'])) {
                //extracting substring from the current uri excluding the last variable in the php QUERY_STRING
                $url = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "&&e_c="));
                $output .= '<td><a href="' . $url . '&&e_c=' . $id . '"><button class="btn btn-xs btn-info fa fa-edit"></button></a></td>';
            } else {
                $output .= '<td><a href="' . $_SERVER['REQUEST_URI'] . '&&e_c=' . $id . '"><button class="btn btn-xs btn-info fa fa-edit"></button></a></td>';
            }
            $output .='</tr>';
        }
        $output .= '</tbody> </table>';
    }
    $output .= '</div>';

    return $output;
}

function view_non_clients_requests($responded) {
    global $db;
    $query = "SELECT * FROM `non_client_requests` WHERE response = '$responded' ORDER BY `id` DESC ";
    $res = $db->select($query, NULL, NULL);
    if (!empty($res)) {
        require_once '../modals/r_non_cli_modal.php';
        ;
        foreach ($res as $row) {
            $id = $row['id'];
            $name = $row['full_name'];
            $phone = $row['phone'];
            $company_name = $row['company_name'];
//        $num_req = $row['num_req'];
            $num_req = '';
            $start_date = $row['job_sdate'];
            $end_date = $row['job_edate'];
            $req_desc = $row['job_description'];
            $time_requested = $row['date_posted'];
            $response = $row['response'];
            $resp_sms = $row['resp_sms'];
            $time_responded = $row['time_responded'];

            echo
            '<div id="tr_' . $id . '" class="col-sm-5" style="max-width: 500px; margin:30px 10px;padding:5px; border:1px solid lightgrey; border-radius:5px;">'
            . ' <strong>Name: </strong> ' . $name . '<span style="float:right;">Sent on:  ' . $time_requested . '</span>'
            . '<br/><b> Company: </b>' . $company_name . '<br/>'
            . '<b> Phone: </b>' . $phone . '<br/>'
            . 'Requesting for <strong> ' . $num_req . ' </strong> employees'
            . ' starting <strong>' . $start_date . '</strong> to '
            . '<strong> ' . $end_date . '</strong><br/>'
            . '<strong> Request description: </strong>  <br/>' . $req_desc . '<br/>';
            if ($responded === 'y') {
                echo '<b>Response SMS:</b>' . $resp_sms . '<br/>'
                . '  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                . '<b>Sent On: </b>' . $time_responded;
            }
            ?>
            <span style="float: right;">
                <button onclick="del_cli_sendId('<?php echo $id; ?>', '<?php echo $name; ?>')"
                        class="btn btn-xs btn-danger fa fa-trash-o"></button>
                        <?php if ($responded === 'p') {
                            ?>
                    <button onclick="r_cli_sendId('<?php echo $id; ?>', '<?php echo $name; ?>', '<?php echo $phone; ?>')"
                            class="btn btn-xs btn-info" data-toggle="modal" data-target="#send_non_cli_sms_modal">Respond by SMS &nbsp;<i class=" fa fa-envelope-o"></i></button>
                            <?php
                        }
                        ?>
            </span><?php
            echo '</div>';
        }
        ?>
        <script>
            function del_cli_sendId(id, name) {
                if (confirm("Delete " + name + "'s request?")) {

                    $.ajax({
                        method: "POST",
                        url: "../sms/r_non_clientsms.php?act=delete",
                        data: {id: id},
                        success: function (data) {
                            //                            alert(data);
                            faddingAllert("#alert_message", "alert-success", "Deleted successfully.");
                            $('#tr_' + id).addClass('hidden');
                        }
                    });
                }
            }

        </script>
        <?php
    } else {
        echo 'No requests by non clients.';
    }
    ?>
    <script type="text/javascript">
        function sms_g_j_d(id, phone) {
            alert(id + ' ' + phone);
        }
        function delete_g_j_d(id, phone) {
            alert(id);
        }
    </script>
    <?php
}

function view_clients_requests($responded) {
    global $db;
//    echo 'To complete a function to collect clien requests from the db';
    $query = "SELECT creq.id, creq.num_req, creq.start_date, creq.end_date, creq.req_desc, creq.req_client_id, creq.time_requested,"
            . " creq.response, creq.resp_desc, creq.respondent_id, creq.time_responded, cli.fname, cli.lname, cli.company_name"
            . " FROM client_requests creq, client cli"
            . " WHERE response $responded 'p'"
            . " AND cli.cuname = creq.req_client_id";

    $res = $db->select($query, NULL, NULL);
//    print_r($res);
    foreach ($res as $row) {
        $id = $row['id'];
        $name = $row['fname'] . ' ' . $row['lname'];
        $company_name = $row['company_name'];
        $num_req = $row['num_req'];
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
        $req_desc = $row['req_desc'];
        $req_client_id = $row['req_client_id'];
        $time_requested = $row['time_requested'];
        $response = $row['response'];
        $resp_desc = $row['resp_desc'];
        $respondent_id = $row['respondent_id'];
        $time_responded = $row['time_responded'];

        echo
        '<div style="max-width: 500px; margin:30px 10px;padding:5px; border:1px solid lightgrey; border-radius:5px;">'
        . ' <strong>From: </strong> ' . $name . ' of ' . $company_name . '<br/>'
        . 'Requesting for <strong> ' . $num_req . ' </strong> workers'
        . ' starting <strong>' . $start_date . '</strong> to '
        . '<strong> ' . $end_date . '</strong><br/>'
        . '<strong> Request description: </strong>  <br/>' . $req_desc . '<br/>'
        . 'Sent on:  ' . $time_requested . '<br/>';
        if (empty($time_responded)) {

            echo '<a  href="http://localhost/lima/public/mgmt/index.php?action=man_cli&&sub=req&&resp=' . $id . '">'
            . '<button class="btn btn-info btn-xs">Respond <i class="fa fa-send"></i></button></a>';
        } elseif (!empty($time_responded)) {
            echo '<b>Response: </b>' . $resp_desc . '<br/>'
            . '<b>On: </b>' . $time_responded . '<br/>';
            echo 'Already responded to: <a  href="http://localhost/lima/public/mgmt/index.php?action=man_cli&sub=req&responded=yes&&resp=' . $id . '">'
            . '<button class="btn btn-danger btn-xs ><i class="fa"></i> Respond differently <i class=" fa fa-send"></i></button></a>'
            . '';
        }
        echo '</div>';
    }
}

function respond_to_client() {

    $id = $_GET['resp'];
//    echo 'OlooId ' . $id . '<br/> <br/>';
    require ("../forms/mngmt_client_response_form.php");
}

/*
 * 
 * Management actiong to employees
 *
 * /
 */

//Allocate a client workers
function allocate_employees() {
    echo 'Allocate a client workers. To e completed';
}

function add_employee() {
    include ("../forms/add_employee_form.php");
}

function block_employee() {
    
}

function search_employee() {
    
}

function terminate_employee() {
    
}

function view_employees($state) {
    global $db;
    $output = '';
    $no = 0;
    $output = '<div style = "border: 1px solid lightgrey; border-radius:5px;">'
            . '<h3 style="text-align:center;">View Employees</h3><hr/>';
    $search_clause = "";

    if (isset($_POST['search'])) {

        $key_word = $_POST['key_word'];
        $search_clause = "AND employee_no = '$key_word'";
    }
    $query = "SELECT id, employee_no, natid, job_desc, department_code, fname, lname, email, salary, phone FROM employee WHERE status = ? $search_clause  ORDER BY fname";
    $data_array = array($state);
    $type_array = array('s');

//    $res = $db->select($query, $type_array, $data_array);
    $res = $db->select($query, $type_array, $data_array);
//    print_r($res);
    if (!empty($res)) {
        $output .= '<table class="table table table-hover"> <thead> <tr> '
                . '<th>#</th> <th>Full Name</th> <th>Employee No.</th> <th>ID Number</th> '
                . '<th>Phone</th> <th>Email</th> <th>Edit</th>'
                . '</tr> </thead> <tbody class = "">';

        foreach ($res as $row) {
            $no++;
            $id = $row['id'];
            $output .='<tr>';
            $output .='<td>' . $no . '</td> <td>' . $row['fname'] . ' ' . $row['lname'] . '</td> <td>' . $row['employee_no'] . '</td> '
                    . '<td>' . $row['natid'] . '</td> <td>' . $row['phone'] . '</td> <td>' . $row['email'] . '</td>';

            $output .= '<td>'
                    . '<a href="http://localhost/lima/public/mgmt/index.php?action=man_emp&&sub=view&&edit_emp=' . $id . '">'
                    . '<button class="btn btn-info btn-xs fa fa-edit"></button></a>'
                    . '&nbsp;&nbsp;'
                    . '<a href="http://localhost/lima/public/mgmt/index.php?action=man_emp&&sub=view&&remove_emp=' . $id . '">'
                    . '<button class="btn btn-danger btn-xs fa fa-trash"></button></a>'
                    . '</td>';
            $output .='</tr>';
        }
        $output .= '</tbody> </table>';
    }
    $output .= '</div>';

    return $output;
}

function edit_employee() {
    global $db;
    $id = $_GET['edit_emp'];
    $query = " SELECT employee_no, natid, job_desc, department_code, fname, lname, email, salary, phone FROM employee WHERE id = ?";

    $data_array = array($id);
    $type_array = array('i');

    $res = $db->select($query, $type_array, $data_array);
    foreach ($res as $row) {

        $employee_no = $row['employee_no'];
        $natid = $row['natid'];
        $job_desc = $row['job_desc'];
        $department_code = $row['department_code'];
        $fname = $row['fname'];
        $email = $row['email'];
        $lname = $row['lname'];
        $salary = $row['salary'];
        $phone = $row['phone'];
    }
    require ("../forms/add_employee_form.php");
//    echo '<br/>';
}

function remove_employee($state) {

    global $db;
    $id = $_GET['remove_emp'];
    $query = "UPDATE employee SET status = ? WHERE id = ?";
    $type_array = array('s', 'i');
    $data_array = array($state, $id);

    if ($db->insert($query, $type_array, $data_array) == 1) {
//        echo 'Removed successfully.<br/>';
        ?><script type="text/javascript">
                    faddingAllert("#alert_message", "alert-success", "Removed successfully.");
        </script><?php
    } else
        echo 'Remove FAILED!<br/>';
    ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-error", "Remove failed.");
    </script><?php
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
            ?><script type="text/javascript">
                            faddingAllert("#alert_message", "alert-success", "Checked.");
            </script><?php
        } else {
            echo 'FAILED!!';
            ?><script type="text/javascript">
                            faddingAllert("#alert_message", "alert-success", "Check in failed.");
            </script><?php
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
        $nat_ids = $_POST['natid'];

        foreach ($nat_ids as $nat_id) {

//            echo $nat_id;
            $query_out = "UPDATE attendance SET check_out = CURRENT_TIMESTAMP, checkout_by = ? WHERE attendance.natid = ?";

            $type_array = array('s', 'i');
            $data_array = array($manid, $nat_id,);

            if ($db->update($query_out, $type_array, $data_array) == 1) {

                echo $nat_id . ' Checked Out by: ' . $manid . ', ';
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

//function resp_off_n_leaaves() {
if (isset($_POST['send_off'])) {//
    $id = $_POST['id'];
    $response = $_POST['response'];
    $res_desc = $_POST['res_desc'];

    $query = "UPDATE off_duty_requests SET response = ?, reason = ? WHERE id = ?";
    $type_array = array('s', 's', 'i');
    $data_array = array($response, $res_desc, $id);
    global $db;
    if ($db->update($query, $type_array, $data_array) == 1) {
//                echo 'Response sent';
        ?><script type="text/javascript">
                    faddingAllert("#alert_message", "alert-success", "Response sent.");
        </script><?php
    } else {
        echo '';
        ?><script type="text/javascript">
                    faddingAllert("#alert_message", "alert-error", "Sennding response failed.");
        </script><?php
    }
}

//}

function off_n_leaaves() {

    global $db;
    $query = "SELECT * FROM `off_duty_requests` WHERE response ='p'";
    $res = $db->select($query, NULL, NULL);
    echo '<div class="row" id="res_offnl" style="max-width: 100%; margin:30px 10px;padding:5px; borderX:1px solid lightgrey; border-radius:5px;">'
    . '';
    if (!empty($res)) {
        foreach ($res as $row) {
            echo '<div class="col-md-5" id="' . $row ['id'] . '_offnl" style="max-width: 400px; border:1px solid lightblue;  border-radius:5px; margin:2px;">';
            echo '<br/><b>From: </b>' . $row ['emp_id'] . ',<b> Sent on: </b>' . $row['time_posted'];
            echo '<br/><b>Requesting </b>' . $row ['off_type'];
            echo ' off <b>from </b>' . $row['start'];
            echo '<b> to </b>' . $row['end'];
            echo '<br/><b>Reason: </b>' . $row['off_desc'];
//                    echo '<br/><b>Response : </b>' . $row['response'];
            echo '<hr/>
                        <h4 style="text-align:center; text-decoration:underline;">Respond to employee request.<h4/>
                        <form class="form-group" method="post" action="">  
                <input type="hidden" name="id" value="' . $row ['id'] . '">
                            <label>Respond:</label>
                            <input type="radio" name="response" required value="g">Grant&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="response" required value="r">Reject  <br/>
                    <label><b>Reason:</b></label><br/>         
                    <textarea id="reason" name="res_desc"></textarea>';
            ?> <input type="submit" class="btn btn-info btn-xs" name="send_off" onclick="send_off_id('<?php echo $row ['id']; ?>')" value="Send"><?php
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo 'No off/leave Requests.';
    }
    echo '</div>';
    echo '</div>';
}

/*
 * 
 * Admin action on job adverts matters and recruitments
 * 
 */

function advertise_job() {
    include ("../forms/create_advert_form.php");
}

function search_job_advert() {
    
}

function delete_job_advert() {

    global $mysqli, $db;
    if (isset($_GET['remov'])) {
        $gid = $_GET['remov'];
        $query = "UPDATE job_advert SET status = '0' WHERE idjob_advert = ?";

        $type_array = array('i');
        $data_array = array($gid);

        if ($db->update($query, $type_array, $data_array) == 1) {
//            echo 'Success! Changes Saved..<br/>';
//            view_job_adverts();
            ?><script type="text/javascript">
                            faddingAllert("#alert_message", "alert-success", "Success! Changes Saved.");
            </script><?php
        } else {
            echo '. Try again later.';
            ?><script type="text/javascript">
                            faddingAllert("#alert_message", "alert-success", "FAILED! Changes not saved.");
            </script><?php
        }
    }
}

//view_job_adverts();
function view_job_adverts() {
    global $db;
    $table_name = "job_advert";
    $query = " SELECT  	id, position, number_needed, apply_before, qualifications_needed, duties FROM $table_name "
            . " WHERE status = '1' "
            . " AND apply_before > CURRENT_DATE "
            . " ORDER BY time_posted DESC";

    $res = $db->select($query, NULL, NULL);
    if (!empty($res)) {
        echo '<script>
                $(function () {
                    $("#accordion_job_adverts").accordion();
                    collapsible: true
                });
            </script>
            <div id="accordion_job_adverts">';
        foreach ($res as $result_set) {
            $id = $result_set['id'];
            $position = $result_set['position'];
            $number_needed = $result_set['number_needed'];
            $apply_before = $result_set['apply_before'];
            $qualifications_needed = $result_set['qualifications_needed'];
            $duties = $result_set['duties'];
            echo '<p style="font-size: 14px; color: lightseagreen;">' . $number_needed . '  ' . $position . ' needed: </span><span>Apply before <b>' . $apply_before . '.</b></p>'
            . '<div>'
            . '<b>Qualification requirement</b><br/>'
            . '<p>' . $qualifications_needed . '</p>'
            . '<b>Duties and responsibilities</b><br/>'
            . '<p>' . $duties . '<p>';
            ?>
            <a onclick="" href="http://localhost/lima/public/mgmt/index.php?action=man_jnr&&sub=view&&edit=<?php echo $id ?>"> <button class="btn btn-sm btn-info"><i class="fa fa-edit"></i> Edit</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo 'No job adverts';
    }
}

function edit_job_advert() {
    global $mysqli;
    $id = $_GET['edit'];
    $query = " SELECT  	id, position, number_needed, apply_before, interview_date, qualifications_needed, duties FROM job_advert where id=" . $id . "  ORDER BY time_posted DESC";

    $results = $mysqli->query($query);
    if ($results->num_rows == 1) {
        $result_set = mysqli_fetch_assoc($results);
        $id = $result_set['id'];
        $position = $result_set['position'];
        $number_needed = $result_set['number_needed'];
        $apply_before = $result_set['apply_before'];
        $interview_date = $result_set['interview_date'];
        $qualifications_needed = $result_set['qualifications_needed'];
        $duties = $result_set['duties'];

//        echo $id, $position, $number_needed, $apply_before, $qualifications_needed, $duties;
        include ("../forms/create_advert_form.php");
        echo '<br/>';
    }
}

function view_applicants() {

    if (isset($_GET['v_aplcnts'])) {
        global $db;
        $v_aplcnts = $_GET['v_aplcnts'];

//         $querye = "SELECT adv.apply_before, adv.position,  emp.fname, emp.lname, emp.phone, qual.qtitle, appl.applied_on"
//            . " FROM job_advert adv, employee emp, qualifications qual, applications appl"
//            . " WHERE appl.advert_id = adv.id"
//            . " AND appl.applicant_id = emp.employee_no"
//            . " AND appl.applicant_id = qual.userid";

        $querye = "SELECT  emp.employee_no, emp.fname, emp.lname ,emp.phone , c.uploaded_to, app.applied_on , app.relevance, app.ligible"
                . " FROM applications app, employee emp, cv c"
                . " WHERE app.advert_id = ?"
                . " AND app.applicant_id = emp.employee_no"
                . " AND c.user_id = emp.employee_no";

        $queryj = "SELECT advert_id, natid, phone, full_name, relevance, time_applied, marked FROM js_applications "
                . " WHERE advert_id = '$v_aplcnts' AND marked = 'p' ORDER BY id DESC";

        $data_arraye = array($v_aplcnts);
        $type_arraye = array('i');
        $rese = $db->select($querye, $type_arraye, $data_arraye);
        $resj = $db->select($queryj, NULL, NULL);

        echo '<table class="table table table-hover"> <thead> <tr> '
        . '<th>#</th> <th>Identity.</th> <th>Name</th> <th>Phone</th> '
        . '<th>CV</th> <th>Applied on</th> <th>Relevance</th> <th>Status</th> <th></th> '
        . '</tr> </thead> <tbody class = "">';
        $no = 0;
        if (!empty($rese)) {
            foreach ($rese as $row) {
                $no++;
                echo '<tr class="info">';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $row['employee_no'] . '</td>';
                echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['uploaded_to'] . '</td>';
                echo '<td>' . $row['applied_on'] . '</td>';
//                echo '<td>' . $row['relevance'] . '</td>';
                echo '<td>' . $row['ligible'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo 'No applicants for this position<br>';
        }
        if (!empty($resj)) {
            foreach ($resj as $row) {
                $no++;
                echo '<tr class="warning">';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $row['natid'] . '</td>';
                echo '<td>' . $row['full_name'];
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['uploaded_to'] . '</td>';
                echo '<td>' . $row['time_applied'] . '</td>';
//                echo '<td>' . $row['relevance'] . '</td>';
                echo '<td>' . $row['marked'] . '</td>';
                ?><td>
                    <button onclick="sendId('<?php echo $position; ?>',<?php echo $id; ?>)" class="btn btn-sm btn-success fa" data-toggle="modal" data-target="#view_applicants_modal"> More
                    </button></td>
                <?php
                echo '</tr>';
            }
        }
        echo '</tbody></table>';
    }
}

function mark_applicant_as_qualified() {
    
}

function view_all_applicants() {
    ?>
    <form class = "form-search" method = "post" action = "" enctype = "multipart.form-data">
        <label>Search applicants by: </label>
        <select id="sby_d" name = "search_by" required style = "text-align: center;">
            <option value = "posi">Position applied</option>
            <option value = "qual">Qualifications</option>
            <option value = "doap">Applied On</option>
            <option value = "dead">Application deadline</option>
        </select>

        <input id="keyw_d" type = "text" name = "key_word" class = "input-medium search-query" required>
        <button id="search_appl" type = "submit" name = "search" class = "btn btn-sm btn-info">Search</button>
    </form>
    <script>
        $(document).on('click', '#search_appl', function (e) {
            e.preventDefault();
            var sby = $('#sby_d').val();
            var keyw = $('#keyw_d').val();
            //            alert(sby + ' ' + keyw);
            $.ajax({
                url: "search_applicant.php",
                method: "POST",
                data: {sby: sby, keyw: keyw},
                dataType: "text",
                success: function (data) {
                    $('#appl_display').empty().append(data);
                },
                fail: function () {
                    alert("Failed");
                }
            });
        });
    </script>
    <div id="appl_display">
        <?php
        global $db;

        $querye = "SELECT DISTINCT appl.id, adv.apply_before, adv.interview_date, adv.position,"
                . " emp.employee_no, emp.fname, emp.lname, emp.phone, "
                . " qual.qtitle, appl.applied_on "
                . " FROM job_advert adv, employee emp, qualifications qual, applications appl "
                . " WHERE adv.apply_before < CURRENT_DATE"
                . " AND appl.advert_id = adv.id"
                . " AND appl.applicant_id = emp.employee_no"
                . " AND appl.ligible = 'p'"
                . " AND appl.applicant_id = qual.userid  ORDER BY adv.apply_before ASC";


        $queryj = "SELECT app.id, adv.apply_before, adv.interview_date, adv.position, "
                . " app.advert_id, app.natid, app.phone, app.full_name, app.relevance, app.time_applied "
                . " FROM js_applications  app, job_advert adv "
                . " WHERE ligible = 'p'"
                . " AND app.advert_id = adv.id"
                . " ";

        $rese = $db->select($querye, NULL, NULL);
        $resj = $db->select($queryj, NULL, NULL);
//    print_r($rese);
        echo '<div style="border:1px solid black;">';
        echo '<table class="table table table-hover"> <thead> <tr> '
        . '<th>#</th><th>Position</th><th>Applicant Name</th> '
        . '<th>Phone NO:</th> <th>Qualification</th> <th>Applied on</th> <th>Deadline</th> <th><i class="fa fa-eye"></i>CV</th>  <th><i class="fa fa-send"></i>SMS</th> '
        . '</tr> </thead> <tbody class = "">';
        $no = 0;
        if (!empty($rese)) {
            ?>

            <script>
                //            $(document).on('click', '#download_cv', function () {
                //                alert('Download Cv');
                //                $.fileDownload('../uploads/14595727622146235418830.pdf')
                //                        .done(function () {
                //                            alert('File download a success!');
                //                        })
                //                        .fail(function () {
                //                            alert('File download failed!');
                //                        });
                //            });


                function send_name_n_loc(loc, name) {
                    var name = name;
                    var uid = loc;
                    //                alert(uid + '  ' + name);

                    if (confirm("Download " + name + "'s CV?")) {
                        $.ajax({
                            url: "view_pdf.php",
                            method: "POST",
                            data: {name: name, uid: uid},
                            dataType: "text",
                            success: function (data) {
                                if (data === 'CV DOES NOT EXIST') {
        //                                    alert(data);
                                    faddingAllert("#alert_message", "alert-danger", "CV Does not exist.");
                                    alert(name + "'s CV does not exist");
                                } else {
                                    window.open(data, '_blank');
                                }
                                //                            '<a href="' + data + '" download="cvjsxz"><button>Download CV</button></a>'));
                                //                            alert(data);
                            },
                            fail: function () {
                                alert("Failed!");
                            }

                        });
                    }
                }

                function send_name_n_contact(div, phone, name, intv_date, table, id) {
                    if (confirm("Send interview invitation SMS to " + name + "?")) {
//                                                alert(div + 'Sent to ' + name + ', ' + phone + '.' + intv_date + 'table  ' + id + table);//
                        $.ajax({
                            url: "../sms/sendJobsms.php?act=sms",
                            method: "POST",
                            data: {intv_date: intv_date, phone: phone, id: id, table: table},
                            dataType: "text",
                            success: function (data) {
                                alert(data);
                                faddingAllert("#alert_message", "alert-success", "SMS sent successfully.");
                                $("#" + div).addClass("hidden");
                            },
                            fail: function () {
                                alert("Failed!");
                            }

                        });
                    }
                }

                function send_name_n_remove(div, id, name, table) {
                    if (confirm("Remove " + name + "'s application")) {
                        //                        alert('Removed ' + name + '.id  ' + id + '  div  ' + div + '   ' + table);
                        $.ajax({
                            url: "../sms/sendJobsms.php?act=delete",
                            method: "POST",
                            data: {id: id, table: table},
                            dataType: "text",
                            success: function (data) {
                                faddingAllert("#alert_message", "alert-success", "Deleted successfully.");
                                $("#" + div).addClass("hidden");
                            },
                            fail: function () {
                                alert("Failed!");
                            }

                        });
                    }
                }
            </script>




            <?php
            foreach ($rese as $row) {
//            ' . $row['uploaded_to'] . '
                $no++;
                echo '<tr class="info"   id="sms_s' . $no . '">';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $row['position'] . '</td>';
//            echo '<td>' . $row['employee_no'] . '</td>';
                echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['qtitle'] . '</td>';
                echo '<td>' . $row['applied_on'] . '</td>';
                echo '<td>' . $row['apply_before'] . '</td>'
                . '';
                ?>

                <td><button id="download_cv" onclick="send_name_n_loc('<?php echo $row['employee_no']; ?>', '<?php echo $row['fname'] . $row['lname']; ?>');" style="color: red;"><i class="fa fa-file-pdf-o"></i></button></td>

                <td> <span><button onclick="send_name_n_contact('sms_s<?php echo$no; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['lname']; ?>', '<?php echo $row['interview_date']; ?>', 'applications', '<?php echo $row['id']; ?>');"><i class="fa fa-envelope-o" style="color: green;"></i></button>
                        <button onclick="send_name_n_remove('sms_s<?php echo$no; ?>', '<?php echo $row['id']; ?>', '<?php echo $row['lname']; ?>', 'applications');"><i class="fa fa-trash-o"></i></button> </span></td> 
                <?php
                echo '</tr>';
            }
        }
        if (!empty($resj)) {
            foreach ($resj as $row) {
                $no++;
                echo '<tr class="warning"   id="sms_s' . $no . '">';
                echo '<td>' . $no . '</td>';
                echo '<td>' . $row['position'] . '</td>';
                echo '<td>' . $row['full_name'] . '</td>';
                echo '<td>' . $row['phone'] . '</td>';
                echo '<td>' . $row['relevance'] . '</td>';
                echo '<td>' . $row['time_applied'] . '</td>';
                echo '<td>' . $row['apply_before'] . '</td>'
                . '<td>';
                ?>

                <button onclick="send_name_n_loc('<?php echo $row['natid']; ?>', '<?php echo $row['full_name']; ?>');"><i class="fa fa-file-pdf-o" style="color: red;"></i></button> </td>
            <td><span><button onclick="send_name_n_contact('sms_s<?php echo$no; ?>', '<?php echo $row['phone']; ?>', '<?php echo $row['full_name']; ?>', '<?php echo $row['interview_date']; ?>', 'js_applications', '<?php echo $row['id']; ?>');"><i class="fa fa-envelope-o" style="color: blue;"></i></button>
                    <button  onclick="send_name_n_remove('sms_s<?php echo$no; ?>', '<?php echo $row['id']; ?>', '<?php echo $row['full_name']; ?>', 'js_applications');"><i class="fa fa-trash-o"></i></button></span></td>

            <?php
            echo '</tr>';
        }
    }
    echo '</div>';
    echo '</div>'; //end of appl_display
}

function search_qualifications() {

    global $db;
    $query = "SELECT DISTINCT q.id, q.userid, q.qtitle, q.qualification, q.date_acquired, q.date_posted, e.fname, e.lname, e.phone"
            . " FROM qualifications q, employee e"
            . " WHERE q.userid = e.employee_no"
            . " ORDER BY q.date_posted DESC";

    $quals = $db->select($query, NULL, NULL);
    if (!empty($quals)) {
        //    print_r($rese);
        echo '<h3 style="text-align:center; text-decoration:underline;">Some of the recently added Qualifications.</h3>';
        echo '<div style="border: 1px solid lightblue; border-radius: 5px;">';
        echo '<table class="table table table-hover table-striped"> <thead> <tr> '
        . '<th>#</th> <th>Employee No.</th> <th>Employee Name</th>  <th>Phone</th> <th>Qualification name</th> '
        . '<th>Qualification description</th> <th>Date Acquired</th> <th>Date posted</th><th></th> '
        . '</tr> </thead> <tbody class = "">';
        $no = 0;
        foreach ($quals as $row) {
            $no++;
            echo '<tr>';
            echo '<td>' . $no . '</td>';
            echo '<td>' . $row['userid'] . '</td>';
            echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td>' . $row['qtitle'] . '</td>';
            echo '<td>' . $row['qualification'] . '</td>';
            echo '<td>' . $row['date_acquired'] . '</td>';
            echo '<td>' . $row['date_posted'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo "</div>";
    } else {
        echo 'No qualifications...';
    }
}

function view_cvs() {
    
}

function send_email() {
    
}

//Reports production
function attendance_xls() {
    require_once("../PHPExcel/Classes/PHPExcel.php");
    convertXLStoCSV('input.xlsx', 'output.csv');
}

function attendance_report() {
    global $db;

    $query = "SELECT att.natid, emp.fname, emp.lname"
            . " FROM attendance att, employee emp"
            . " WHERE att.natid =emp.natid";

//    $query = "SELECT natid as att FROM `attendance` ORDER BY `id` DESC ";
    $no = 0;
    $type_array = array();
    $data_array = array();
    $res = $db->select($query, $type_array, $data_array);
//    print_r($res);
    if (!empty($res)) {

        echo '<table class="table table table-hover table-bordered"> <thead> <tr>'
        . '<th>#</th> <th>ID No.</th> <th>Name</th> ';
        $date1 = 24;
        while ($date1 >= 24 && $date1 <= 31) {
            echo '<th> ' . $date1 . '</th>';
            $date1++;
        }
        $date1 = 1;
        while ($date1 >= 1 && $date1 <= 23) {
            echo '<th> ' . $date1 . '</th>';
            $date1++;
        }
        echo '<th>Total</th>';
//        echo date('l jS F (Y-m-d)', strtotime('-3 days'));

        foreach ($res as $row) {
            $no++;
            echo '<tr>'
            . '<td>' . $no . '</td> '
            . '<td>' . $row['natid'] . '</td> '
            . '<td>' . $row['fname'] . $row['lname'] . '</td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:red;">O</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:black;">__</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:green;">X</span></td>'
            . '<td><span style="color:blue;">TX</span></td>'
            . '</tr>';
        }
        echo '<tr>'
        . '<td colspan="3">Total emplooyees worked</td>';

        for ($i = 1; $i <= 31; $i++) {
            echo '<td>99</td>';
        }
        echo '<td>9999</td>';
        echo '</tr>';
        echo '</tbody> </table>';
    }
    echo "id natid check_in checkin_by check_out checkout_by";
}

function process_requests_b_c($state) {
    global $db;
    echo '<div style = "border: 1px solid lightgrey; border-radius:5px;">';
    $query = "SELECT id, fname, lname, email, phone, company_name, location, status, natid, cuname FROM client WHERE status=? ORDER BY id DESC";

    $type_array = array('s');
    $data_array = array($state);
    $res = $db->select($query, $type_array, $data_array);
    if (!empty($res)) {
        require ("../modals/r_cli_modal.php");
        $no = 0;
        echo'<table class="table table table-hover"> <thead> <tr> '
        . '<th>#</th> <th>Name</th> <th>Email</th> <th>Phone</th> '
        . '<th>Company name</th> <th>Location</th><th>SMS</th> '
        . '</tr> </thead> <tbody class = "">';

        foreach ($res as $row) {
            $no++;
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $phone = $row['phone'];
            $company_name = $row['company_name'];
            $location = $row['location'];
            $status = $row['status'];
            $natid = $row['natid'];
//            $cuname = $row['cuname'];
            echo'<tr id="tr_' . $id . '">';
            echo'<td>' . $no . '</td> <td>' . $fname . ' ' . $lname . '</td> <td>' . $email . '</td> '
            . '<td>' . $phone . '</td> <td>' . $company_name . '</td> <td>' . $location . '</td><td>';
            ?>
            <button onclick="r_cli_sendId('<?php echo $id; ?>', '<?php echo $fname; ?>', '<?php echo $phone; ?>')"
                    class="btn btn-xs btn-info fa fa-envelope-o" data-toggle="modal" data-target="#send_cli_sms_modal"></button>

            <button onclick="del_cli_sendId('<?php echo $id; ?>', '<?php echo $fname; ?>')"
                    class="btn btn-xs btn-danger fa fa-trash-o"></button>
                    <?php
                    echo'</td></tr>';
                }
                echo '</tbody> </table>';
                echo'</div>';
                ?>  <script>
                            function del_cli_sendId(id, name) {
                                if (confirm("Delete " + name + "'s request?")) {

                                    $.ajax({
                                        method: "POST",
                                        url: "../sms/r_clientsms.php?act=delete",
                                        data: {id: id},
                                        success: function (data) {
                                            //                                    alert(data);
                                            faddingAllert("#alert_message", "alert-success", "Deleted successfully.");
                                            $('#tr_' + id).addClass('hidden');
                                        }
                                    });
                                }
                            }

        </script><?php
    } else {
        echo 'No requests...';
    }
}

function contact_us_mes() {
//    echo 'Cont Us WE ARE';
    $query = "SELECT `id`, `fname`, `lname`, `phone`, `email`, `subject`, `detailed` FROM `contact_us`";
    global $db;
    $res = $db->select($query, NULL, NULL);
    if (!empty($res)) {
        echo '<script>
                $(function () {
                    $("#accordion_job_adverts").accordion();
                    collapsible: true
                });
            </script>
            <div id="accordion_job_adverts">';
        foreach ($res as $row) {
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $phone = $row['phone'];
            $email = $row['email'];
            $subject = $row['subject'];
            $detailed = $row['detailed'];
//            echo '<br/>$id ' . $id . '<br/>$fname ' . $fname . '<br/>$lname ' . $lname . '<br/>$phone ' . $phone . '<br/>$email ' . $email . '<br/>$subject ' . $subject . '<br/>$detailed ' . $detailed . '<br/>';


            echo '<p style="font-size: 14px; color: lightseagreen;">' . $fname . '  ' . $lname . ' (' . $email . ') </span><span> <b>' . $phone . '.</b></p>'
            . '<div>'
            . '<b>Subject</b><br/>'
            . '<p>' . $subject . '</p>'
            . '<b>Details</b><br/>'
            . '<p>' . $detailed . '<p>';
            ?>
                                                                                                                                                                                     <!--<button onclick="" class="btn btn-xs btn-info"><i class="fa fa-envelope-o"></i> Reply</button>-->
            <?php
            echo '</div>';
        }
    } else {
        echo 'No Contact_us Messages..';
    }
}

function view_enquires($responded, $table, $user_col) {
    global $db;
//    echo 'To complete a function to collect clien requests from the db';
    $query = "SELECT en.id, en.user, en.title, en.brief_description, en.posted_time, en.response, en.date_responded,"
            . " u.$user_col, u.fname, u.lname"
            . " FROM enquiries en, $table u"
            . " WHERE response $responded ''"
            . " AND u.$user_col = en.user "
            . " AND u.status = '1' ";

    $res = $db->select($query, NULL, NULL);
//    print_r($res);
    if (!empty($res)) {

        foreach ($res as $row) {
            $id = $row['id'];
            $user = $row['user'];
            $name = $row['fname'] . ' ' . $row['lname'];
            $title = $row['title'];
            $req_desc = $row['brief_description'];
            $posted_date = $row['posted_time'];
            $response = $row['response'];
            $time_responded = $row['date_responded'];

            echo
            '<div class="col-sm-5" id="w_' . $id . '" style="max-width: 500px; margin:30px 10px;padding:5px; border:1px solid lightgrey; border-radius:5px;">'
            . '<strong>From: </strong>' . $name . '( ' . $user . ' )<br/>'
            . '<strong> Request description: </strong>  <br/>' . $req_desc . '<br/>'
            . 'Sent on:  ' . $posted_date . '<br/>';
            ?> 
            <hr/>
            <div id="f_<?php echo $id; ?>" class="form-horizontal hidden" role="form" method="post" action="">
                Response:<br/>
                <textarea id="res_<?php echo $id; ?>" cols="40" rows="3" name="resp_desc" placeholder=""></textarea>    
                <button  onclick="btn_sendId('<?php echo $id; ?>', '<?php echo $name; ?>')" id="respond_to_em_cli" class="btn btn-xs btn-success">Send <i class="fa fa-send"></i></button>
            </div>
            <button id="b_<?php echo $id; ?>" onclick="r_sendId('<?php echo $id; ?>', '<?php echo $name; ?>')" class="btn btn-xs btn-info" data-toggle="modal" data-target="#Xrespond_enq">Respond <i class="fa fa-send"></i> </button>
            <?php
            echo '</div>';
        }
    } else {
        echo 'No enqueries.';
    }
    ?>
    <script>
        function r_sendId(id) {
            $('#f_' + id).removeClass('hidden');
            $('#b_' + id).addClass('hidden');
        }


        function btn_sendId(id, name) {
            var resp = $("#res_" + id).val();
            alert(id + name + 'Resp: ' + resp);
            $.ajax({
                method: "POST",
                url: "enq_respond.php",
                data: {id: id, resp: resp},
                success: function (data) {
    //                    alert(data);
                    faddingAllert("#alert_message", "alert-success", "Request sent successfully.");
                    $('#w_' + id).addClass('hidden');
                },
                fail: function () {

                }
            });
        }
    </script>
    <?php
}

function allocate_emp() {
    ?>

    <div id="allocate_div">
        <form  class = "form-inline" method="post" action ="" style="width: 100%;">
            <div class="form-group" style="width: 100%;"  style="text-align: left;">
                <div class="row" style="text-align: left;"><?php view_available_emp(); ?></div>
                <!--<hr/>-->
                <h3 style="text-align:center; text-decoration:underline;"> Allocate Checked Employees </h3>
                <label>Select Station: </label>
                <select class="form-control" name="al_client">
                    <?php option_available_clients() ?>
                </select>
                <label>&nbsp;&nbsp;Start date: </label>
                <input class="form-control" type="text" id="alo_s_date" name="sdate" required  size="" maxlength="15" placeholder="yyy-mm-dd">
                <label>&nbsp;&nbsp;End date:</label>
                <input class="form-control" type="text" id="alo_e_date" name="edate" required size="" maxlength="15" placeholder="yyy-mm-dd">
                <input type="submit" name="allocate" class="btn btn-info" style="float: next;" value="Allocate"><br/>
            </div>
        </form>
    </div>
    <?php
}

function view_available_emp() {
    global $mysqli;
    $limit = 20;
    $offset = 0;

    $query = "SELECT * FROM employee WHERE status = '0'";

    $query1 = " SELECT DISTINCT emp.employee_no, emp.fname, emp.lname ,emp.phone, alo.id,  alo.end_date "
            . " FROM allocations alo, employee emp  "
            . " WHERE emp.employee_no = alo.employee_no"
            . " AND alo.state = 0"
            . " AND emp.status = '1'"
            . " AND alo.end_date <= CURRENT_DATE "
            . " ORDER BY emp.fname DESC"
            . " LIMIT $limit OFFSET $offset";

    global $db;
    $res = $db->select($query, NULL, NULL);
    $res1 = $db->select($query1, NULL, NULL);
    if (!empty($res) || !empty($res1)) {
        echo '<h3 style="text-align:center; text-decoration:underline;"> Unallocated Employees. </h3>';

        if (!empty($res)) {
            foreach ($res as $result_set) {

                $id = $result_set['id'];
                $emp_no = $result_set['employee_no'];
                $fname = $result_set['fname'];
                $lname = $result_set['lname'];
                ?>
                <style>
                    .alo_emp_d{
                        text-align: center;
                        width: 150px; margin: 0 10px 20px 10px; padding: 10px;  height: 150px !important; overflow-y: auto;  background: rgba(100,20,80,.015); border: 1px solid lightblue; border-radius: 0px;
                    }
                </style>
                <div class="col-xs-2 alo_emp_d">
                    <input style="float: left;" type="checkbox" name="employee_no[]" value="<?php echo $emp_no ?>"/>&nbsp;&nbsp;<?php echo $emp_no ?><br/>
                    <?php
                    $ppic = '../images/thumb_nails/thumb_' . $emp_no . '.png';
                    if (is_file($ppic)) {
                        echo '<img src="../images/thumb_nails/thumb_' . $emp_no . '.png"><br/>';
                    } else {
                        ?><i class="fa fa-user fa-3x"></i><br/><?php } ?>
                    <span style="font-size: 18px; color: #00aeef;"> <?php echo $lname . '  ' . $fname ?></span><br/><br/>

                </div>

                <?php
            }
        }

        if (!empty($res1)) {
            foreach ($res1 as $result_set) {

                $id = $result_set['id'];
                $emp_no = $result_set['employee_no'];
                $fname = $result_set['fname'];
                $lname = $result_set['lname'];
                ?>
                <style>
                    .alo_emp_d{
                        text-align: center;
                        width: 150px; margin: 0 10px 20px 10px; padding: 10px;  height: 150px !important; overflow-y: auto;  background: rgba(100,20,80,.015); border: 1px solid lightblue; border-radius: 0px;
                    }
                </style>
                <div class="col-xs-2 alo_emp_d">
                    <input style="float: left;" type="checkbox" name="employee_no[]" value="<?php echo $emp_no ?>"/>&nbsp;&nbsp;<?php echo $emp_no ?><br/>
                    <?php
                    $ppic = '../images/thumb_nails/thumb_' . $emp_no . '.png';
                    if (is_file($ppic)) {
                        echo '<img src="../images/thumb_nails/thumb_' . $emp_no . '.png"><br/>';
                    } else {
                        ?><i class="fa fa-user fa-3x"></i><br/><?php } ?>
                    <span style="font-size: 18px; color: lightseagreen;"> <?php echo $lname . '  ' . $fname ?></span><br/><br/> 
                </div>
                <?php
            }
        }
    } else {
        echo 'No employees to be allocated';
    }
}

function option_available_clients() {
    $query = "SELECT id, fname, lname, email, phone, company_name, location, status, natid, cuname FROM client WHERE status=? ORDER BY id DESC";

    global $db;
    $type_array = array('s');
    $data_array = array(1);
    $res = $db->select($query, $type_array, $data_array);
    if (!empty($res)) {
        foreach ($res as $row) {
            echo '<option value="' . $row['cuname'] . '">' . $row['company_name'] . '</option>';
////            echo $id = $row['id'];
//            echo $fname = $row['fname'];
////            echo $lname = $row['lname'];
////            echo $email = $row['email'];
////            echo $phone = $row['phone'];
//            echo $company_name = $row['company_name'];
////            echo $location = $row['location'];
////            echo $status = $row['status'];
////            echo $natid = $row['natid'];
//            echo $cuname = $row['cuname'];
        }
    }
}

employee_no_allocate();

function employee_no_allocate() {
    $sel_empno = array();
    if (isset($_POST['allocate'])) {
        if (!isset($_POST['employee_no'])) {
            echo 'No employee checkedv for allocation.';
        } else {
            global $db; //
            $manid = $_SESSION['uname'];
            $al_client = $_POST['al_client'];
            $emp_nos = $_POST['employee_no'];
            // print_r($emp_nos);
            $sdate = $_POST['sdate'];
            $edate = $_POST['edate'];
            ?>
            <script type="text/javascript">
                //            alert('oloooooooooooooooo');
            </script>
            <?php
            foreach ($emp_nos as $emp_no) {
                $i = 0;
                $query = "INSERT INTO `allocations` (`employee_no`, `client_id`, `start_date`, `end_date`, `state`, `allocated_by`, `last_updated`) "
                        . " VALUES (?, ?, ?, ?, '1', ?, CURRENT_TIMESTAMP)";

                $query1 = "UPDATE `employee` SET `status` = '1' WHERE employee_no=?";
                $query2 = "UPDATE `allocations` SET `state` = '2' WHERE employee_no=?";

                $type_array = array('i', 's', 's', 's', 's');
                $data_array = array($emp_no, $al_client, $sdate, $edate, $manid);

                $type_array1 = array('i');
                $data_array1 = array($emp_no);


                if ($db->insert($query2, $type_array1, $data_array1) == 1) {
                    $db->insert($query, $type_array, $data_array);
                    $db->insert($query1, $type_array1, $data_array1);
                    $i++;
//                allocate_emp();
                } else {

                    echo 'FAILED!!';
                }

                $sel_empno[] = $emp_no;
            }
            echo ' Employees allocated to ' . $al_client;
        }
    } else {
        echo 'Allocation failed!';
    }
}

function unallocate_employees() {
    ?>
    <div id="allocate_div">
        <form  class = "form-inline" method="post" action ="" style="width: 100%;">
            <div class="form-group" style="width: 100%;"  style="text-align: left;">
                <div class="row" style="text-align: left;"><?php view_allocated(); ?></div>

                <input type="submit" name="unallocate" class="btn btn-info" style="float: next;" value="Unallocate Checked."><br/>
            </div>
        </form>
    </div>
    <?php
}

isset_unallocate();

function isset_unallocate() {
    $sel_empno = array();
    if (isset($_POST['unallocate'])) {
        if (!isset($_POST['alo_id'])) {
            echo 'Make sure to check atleast 1 employee.';
        } else {
            global $db; //
            $manid = $_SESSION['uname'];
            $alo_ids = $_POST['alo_id'];
            // print_r($emp_nos);
            print_r($alo_ids);
            ?>
            <script type="text/javascript">
                // alert('oloooooooooooooooo');
            </script>
            <?php
            foreach ($alo_ids as $alo_id) {

                $i = 0;
                $query = "UPDATE `allocations` SET end_date=CURRENT_DATE, `state`= '0', `last_updated`= CURRENT_TIMESTAMP"
                        . " WHERE  id=?";

                $type_array = array('i');
                $data_array = array($alo_id);

                if ($db->insert($query, $type_array, $data_array) == 1) {
                    $i++;
                    echo 'SUCCESS';
                } else {

                    echo 'FAILED!!';
                }

//                $sel_empno[] = $emp_no;
            }
            echo $i . ' Success';
        }
    }
}

function view_allocated() {
    $limit = 20;
    $offset = 0;

    $query1 = " SELECT emp.employee_no, emp.fname, emp.lname ,emp.phone, alo.id,  alo.end_date, cli.company_name "
            . " FROM allocations alo, employee emp, client cli  "
            . " WHERE emp.employee_no = alo.employee_no"
            . " AND alo.state = '1'"
            . " AND emp.status = '1'"
            . " AND cli.cuname = alo.client_id"
            . " AND alo.end_date > CURRENT_DATE "
            . " ORDER BY emp.fname DESC"
            . " LIMIT $limit OFFSET $offset";

    global $db;
    $res1 = $db->select($query1, NULL, NULL);

    if (!empty($res1)) {
        echo '<h3 style="text-align:center; text-decoration:underline;"> Currently Allocated Employees </h3>';
        foreach ($res1 as $result_set) {

            $alo_id = $result_set['id'];
            $emp_no = $result_set['employee_no'];
            $fname = $result_set['fname'];
            $lname = $result_set['lname']; //
            $company_name = $result_set['company_name']; //
            ?>
            <style>
                .alo_emp_d{
                    text-align: center;
                    width: 150px; margin: 0 10px 20px 10px; padding: 10px;  height: 150px !important; overflow-y: auto;  background: rgba(100,20,80,.015); border: 1px solid lightblue; border-radius: 0px;
                }
            </style>
            <div class="col-xs-2 alo_emp_d">
                <input style="float: left;" type="checkbox" name="alo_id[]" value="<?php echo $alo_id ?>"/>&nbsp;&nbsp;<?php echo $emp_no ?><br/>
                <?php
                $ppic = '../images/thumb_nails/thumb_' . $emp_no . '.png';
                if (is_file($ppic)) {
                    echo '<img src="../images/thumb_nails/thumb_' . $emp_no . '.png"><br/>';
                } else {
                    ?><i class="fa fa-user fa-3x"></i><br/><?php } ?>
                <span style="font-size: 18px; color: lightseagreen;"> <?php echo $lname . '  ' . $fname ?></span>
                <br/><span style="font-size: 10px; color: lightlue;">(&nbsp; <?php echo $company_name ?>&nbsp;)</span><br/> 
            </div>

            <?php
        }
    } else {
        echo 'No Currently allocated employees';
    }
}

function convertXLStoCSV($infile, $outfile) {
    $fileType = PHPExcel_IOFactory::identify($infile);
    $objReader = PHPExcel_IOFactory::createReader($fileType);

    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($infile);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
    $objWriter->save($outfile);
}

//view_clients();
//add_employee();
//add_client();
//advertise_job();
//view_employees();
//edit_employee();
//view_applicants();
//view_job_adverts();
//view_clients_requests();
// $querye = "SELECT adv.apply_before, adv.position,  emp.fname, emp.lname, emp.phone, qual.qtitle, appl.applied_on"
//            . " FROM job_advert adv, employee emp, qualifications qual, applications appl"
//            . " WHERE appl.advert_id = adv.id"
//            . " AND appl.applicant_id = emp.employee_no"
//            . " AND appl.applicant_id = qual.userid";
//attendance_report();

//attendance_xls();
