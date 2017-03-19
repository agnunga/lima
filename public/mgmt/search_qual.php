<?php

require_once ("../../include/config.php");
require_once ("../../include/database.php");

$search_key = $_POST['search_key'];

$s_query = "SELECT DISTINCT q.id, q.userid, q.qtitle, q.qualification, q.date_acquired, q.date_posted, e.fname, e.lname, e.phone"
        . " FROM qualifications AS q INNER JOIN employee AS e"
        . " WHERE q.userid = e.employee_no"
        . " AND q.qtitle LIKE '%$search_key%'"
        . " ";
$s_query2 = "SELECT DISTINCT q.id, q.userid, q.qtitle, q.qualification, q.date_acquired, q.date_posted, e.fname, e.lname, e.phone"
        . " FROM qualifications AS q INNER JOIN employee AS e"
        . " WHERE q.userid = e.employee_no"
        . " AND q.qualification LIKE '%$search_key%'"
        . " ";
echo '<div style="border:1px solid lightgrey;">'
 . '<table class="table table table-hover"> <thead> <tr> '
 . '<th>#</th> <th>Employee No.</th> <th>Employee Name</th>  <th>Phone</th> <th>Qualification name</th> '
 . '<th>Qualification description</th> <th>Date Acquired</th> <th>Date posted</th>'
 . '</tr> </thead> <tbody class = "">';

$s_res = $db->select($s_query, NULL, NULL);
$s_res2 = $db->select($s_query2, NULL, NULL);
$no = 0;
if (!empty($s_res)) {
    echo '<h3 style="text-align:center; text-decoration:underline;">Search Results</h3>';
    //    print_r($rese);

    foreach ($s_res as $row) {
        $no++;
        echo '<tr class="info">';
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
} else {
    echo '<tr class="info">';
    echo '<td colspan="8"><h4 style="text-align:center;">No titles found.</h4></td></tr>';
}
if (!empty($s_res2)) {
    foreach ($s_res2 as $row) {
        $no++;
        echo '<tr class="warning">';
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
} else {
    echo '<tr class="warning">';
    echo '<td colspan="8"><h4 style="text-align:center;">Not descriptions found</h4></td></tr>';
}

echo '</tbody></table>'
 . '</div>';
