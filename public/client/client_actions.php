<?php

require_once ("../../include/session.php");
require_once ("../../include/redirect.php");
Session::confirm_logged_in('cuname');
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
require_once("../client/client_actions.php");

function request_workers() {
    require_once ("../forms/request_workers_form.php");
}

function view_workers() {
    //recomendation after viewing call the recomend w function
}

function view_allocation() {
    $query = "";
}

function recommend_workers() {
    
}

function make_enquery() {
    require_once ("../forms/client_enquiry_form.php");
    ?>

    <?php

}

function past_enquery() {
    echo '<h3 style="text-align:center; margin-top:-15px;">Past Enqueries.</h3>';
    global $db;
    $user = $_SESSION['cuname'];
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
        echo 'No previous requests.';
    }
    echo '</div>';
    ?>

    <?php

}

function clients_past_requests() {
    echo '<h3 style="text-align:center; margin-top:-15px;">My past Requests.</h3>';
    $my_uid = $_SESSION['cuname'];
    global $db;
//    echo 'To complete a function to collect clien requests from the db';
    $query = "SELECT creq.id, creq.num_req, creq.start_date, creq.end_date, creq.req_desc, creq.req_client_id, creq.time_requested,"
            . " creq.response, creq.resp_desc, creq.respondent_id, creq.time_responded, cli.fname, cli.lname, cli.company_name"
            . " FROM client_requests creq, client cli"
            . " WHERE creq.req_client_id = cli. cuname"
            . " AND creq.req_client_id = '$my_uid'";

    $res = $db->select($query, NULL, NULL);
//    print_r($res);
    echo '<div style="margin:30px 10px;padding:0px; border:1px solid lightgrey; border-radius:5px;">';
    if (!empty($res)) {
        $no = 0;
        echo '<table class="table table table-hover"> <thead> <tr> '
        . '<th>#</th> <th>Workers requested</th> <th>Work Start date</th> <th>Work End date</th> '
        . '<th>Work Description</th> <th>Request sent on</th> <th>Response status</th>'
        . '</tr> </thead> <tbody class = "">';
        foreach ($res as $row) {
            $no++;
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
            '<tr>'
            . ' <td> ' . $no . '</td>'
//            . ' <td> ' . $name . ' ' . $company_name . '</td>'
            . '<td style="text-align:center;">  ' . $num_req . '</td> '
            . ' <td> ' . $start_date . '</td>'
            . '<td>  ' . $end_date . '</td>'
            . '<td> ' . $req_desc . '</td>'
            . '<td> ' . $time_requested . '</td>    ';
//            . '<td> ' . $time_responded . '<br/><br/>';
            if (empty($time_responded)) {

                echo '<td style="color:brown;">Pending Response</td> ';
            } elseif (!empty($time_responded)) {
                echo '<td>' . $resp_desc . '<br/>On: ' . $time_responded . '</td> ';
            }
            echo '</tr>';
        }
        echo '</tbody> </table>';
    } else {
        echo 'No previous requests.';
    }
    echo '</div>';
}

//view_workers();

