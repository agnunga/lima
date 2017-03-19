<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");

global $mysqli;
$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 10;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;

$query = " SELECT id, position, number_needed, apply_before, qualifications_needed, duties FROM job_advert "
        . " WHERE apply_before > CURRENT_DATE ORDER BY time_posted DESC LIMIT $limit OFFSET $offset";
global $db;
$res = $db->select($query, NULL, NULL);
if (!empty($res)) {
    require ("../modals/em_aply_modal.php");
    echo '<h3 style="text-align:center; text-decoration:underline;">&nbsp; Advertised Job  Vacancies. &nbsp;</h3>';
    foreach ($res as $result_set) {

        $id = $result_set['id'];
        $position = $result_set['position'];
        $number_needed = $result_set['number_needed'];
        $apply_before = $result_set['apply_before'];
        $qualifications_needed = $result_set['qualifications_needed'];
        $duties = $result_set['duties'];
        echo '<span style="font-size: 18px; color: lightseagreen;">' . $number_needed . '  ' . $position . ' needed: </span><span>Apply before <b>' . $apply_before . '.</b></span>'
        . '<h5>Qualification requirement</h5>'
        . '<p>' . $qualifications_needed . '</p>'
        . '<h5>Duties and responsibilities</h5>'
        . '<p>' . $duties . '</p>'
//            . '<a href="http://localhost/lima/public/employee/index.php?content=view&aply=' . $id . '"><button class="btn btn-sm btn-success fa">Apply now &nbsp; &nbsp;<span class=" fa fa-edit"></span></button></a><br/><br/><br/>';
        ?>
        <button onclick="sendId('<?php echo $position; ?>',<?php echo $id; ?>)" class="btn btn-sm btn-success" data-toggle="modal" data-target="#em_apply_modal">
            <?php
            echo 'Apply now &nbsp; &nbsp;<span class=" fa fa-edit"></span></button><br/><hr/>';
        }
    }