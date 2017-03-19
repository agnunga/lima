<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");

global $mysqli;
$table_name = "mngmt";
$sql = "SELECT COUNT(emp_no) FROM $table_name";
$run_sql = $mysqli->query($sql);
$row = mysqli_fetch_row($run_sql);
$total_rows = $row[0];

$rpp = 2;
$last = ceil($total_rows / $rpp);
if ($last < 1) {
    $last = 1;
}
require_once ("../includes/header.php");
global $db;
$db->close_db();
?>

<script>
    var rpp =<?php echo $rpp; ?>;
    var last =<?php echo $last; ?>;
    function  request_page(pn) {
        var result_box = document.getElementById("result_box");
        var pagination_controls = document.getElementById("pagination_controls");
        result_box.innerHTML = '<span class="fa fa-spinner fa-spin fa-5x"></span><span class="fa fa-5x">Loading...</span>';
        var hr = new XMLHttpRequest();
        hr.open("GET", "pagination_parser.php", true);
        hr.setRequestHeader("Content_type", "application/x-www-form-urlencoded");
        hr.onreadystatechange = function () {
            if (hr.readyState == 4 && hr.status == 200) {
                var dataArray = hr.responseText.split("||");
                var html_output = "";
                for (i = 0; i < dataArray.length - 1; i++) {
                    var itemArray = dataArray[i].split("|");
                    html_output += " Empno: " + itemArray[0] + " Name: " + itemArray[1] + " " + itemArray[2] + " Level: " + itemArray[3] + "</br>";
                }
                result_box.innerHTML = html_output;
            }
        }
        hr.send("rpp=" + rpp + "&last=" + last + "&pn=" + pn);
//        alert("rpp=" + rpp + "&last=" + last + "&pn=" + pn);
        var paginationCtrls = "";
        if (last != 1) {
            if (pn > 1) {
                paginationCtrls += '<button onclick="request_page(' + (pn - 1) + ')">&lt;</button>';
            }
            paginationCtrls += '&nbsp;&nbsp;<b>Page ' + pn + ' of ' + last + '</b>&nbsp;&nbsp;';
            if (pn != last) {
                paginationCtrls += '<button onclick="request_page(' + (pn + 1) + ')">&gt;</button>';
            }
        }
        pagination_controls.innerHTML = paginationCtrls;
    }

</script>
<div id="pagination_controls">

</div>
<div id="result_box">

</div>
<script>
    request_page(1);
</script>