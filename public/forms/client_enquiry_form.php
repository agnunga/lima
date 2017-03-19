<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");

if (isset($_POST['send_c_enquiry'])) {
    $title = $_POST['title'];
    $brief_description = $_POST['brief_description'];
    $uname = $_SESSION['cuname'];
    $query = "INSERT INTO `enquiries`"
            . " (`user`, `title`, `brief_description`, `posted_time`)"
            . " VALUES (?,?,?, CURRENT_TIMESTAMP)";
    global $users;
    $users->make_enquiries($uname, $title, $brief_description, $query);
}
?>
<form action="#" method="post" enctype="multipart/form-data">
    <legend>Make enquiries</legend>
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
            <th colspan="1">&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-xs btn-info" name="send_c_enquiry" value=" Send "/></th>
        </tr>
    </table>
</form>
