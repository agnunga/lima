<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");

global $db;
$limit = (intval($_GET['limit']) != 0 ) ? $_GET['limit'] : 10;
$offset = (intval($_GET['offset']) != 0 ) ? $_GET['offset'] : 0;

$sql = "SELECT countries_name FROM countries WHERE 1 ORDER BY countries_name ASC LIMIT $limit OFFSET $offset";

$results = $db->select($sql, NULL, NULL);
if (!empty($results)) {
    foreach ($results as $res) {
        echo '<div style="max-heiht:400px; color:blue; border:1px solid black;">';
        echo '<h3>' . $res['countries_name'] . '</h3>';
        echo '</div';
    }
}