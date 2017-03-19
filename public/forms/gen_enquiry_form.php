<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");

if (isset($_POST['submit_enquiry'])) {
    $full_name = $_POST['full_name'];
    $ugrup = 'j';
    $email = $_POST['email'];
    $title = $_POST['title'];
    $brief_description = $_POST['brief_description'];
    $query = "INSERT INTO `enquiries`"
            . " (`full_name`, `user_grup`, `email`, `title`, `brief_description`)"
            . " VALUES (?,?,?,?,?)";

    $users->make_enquiries($full_name, $ugrup, $email, $title, $brief_description, $query);
}
?>
<form action="#" method="post" enctype="multipart/form-data">
    <legend>Make enquiries</legend>
    <table class="table_forms">
        <tr>
            <td><label>Full Name:</label></label></td>
            <td><input type="text" name="full_name" required placeholder="Fistname and last name" maxlength="45" style="width:100%;"/></td>
        </tr>
        <tr>
            <td><label>Email:</label></td>
            <td><input type="text" name="email" required placeholder="email@example.com" maxlength="45" style="width:100%;"/></td>
        </tr>
<!--        <tr>
            <td colspan="3"><label>Issue relating to:</label> &nbsp;&nbsp;<select name="issue" style="width: 260px; text-align: center;">
                    <option value="0">--Select--</option>
                    <option value="1">Job seekers</option>
                    <option value="2">Clients</option>
                    <option value="2">Other persons</option>
                </select></td>
        </tr>-->
        <tr>
            <td colspan="3"> <label>State your issue:</label><br/>
                <input type="text" name="title" required  placeholder="" style="width:100%;"/><br/><br/></td>
        </tr>

        <tr>
            <td colspan="3"> <label>Briefly describe your issue :</label><br/>
                <textarea cols="40" rows="4" name="brief_description" required placeholder=""></textarea><br/><br/></td>
        </tr>
        <tr>
            <th colspan="2">&nbsp;&nbsp;&nbsp;<input type="submit" class="btn btn-sm btn-info" name="submit_enquiry" value="Submit Enquiry"/></th>
        </tr>
    </table>
</form>
