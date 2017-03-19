<?php
if (isset($_POST['add_qualif'])) {
    global $db;
    $qtitle = $_POST['qtitle'];
    $qualif = $_POST['qualif'];
    $userid = $_SESSION['employee_no'];
    $date = $_POST['date_aqcuired'];

    $query = "INSERT INTO `qualifications` (`userid`,`qtitle`, `qualification`, `date_acquired`)"
            . " VALUES (?,?,?,?)";
    $type_array = array('i', 's', 's' , 's');
    $data_array = array($userid, $qtitle, $qualif, $date);
    if ($db->insert($query, $type_array, $data_array) == 1) {
        echo 'Added successfully';
    }
}
?>
<form enctype="multipart/form-data" method="post" action="">
    <legend>Add qualification:</legend>
    <table class="table_forms">
        <tr>
            <td colspan="3"><label>Qualification name:</label><br/>
                <input type="text" name="qtitle" required="" maxlength="70" placeholder=""  style="width:100%;"><br/><br/></td>
        </tr>
        <tr>
            <td colspan="3"><label>Qualification:</label><br/>
                <textarea name="qualif" cols="36" rows="3" maxlength="255" placeholder="Type qualification here..."></textarea></td>
        </tr>
        <tr>
            <td><label>Date acquired:</label></td><td><input type="date" id="qual_aqcuired_date" readonly name="date_aqcuired" required size="" maxlength="15" placeholder="dd/mm/yyy"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;"><input type="submit" class="btn btn-sm btn-info" name="add_qualif" value="Add qualification"></td>
        </tr>
    </table>
</form>