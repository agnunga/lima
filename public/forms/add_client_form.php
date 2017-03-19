<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");
?>
<?php
if (isset($_POST['add_client'])) {

    global $db;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company_name = $_POST['coname'];
    $location = $_POST['loc'];
    $pwd = sha1($_POST['uname']);
    $status = '1';
    $natid = $_POST['natid'];
    $uname = $_POST['uname'];

    $query = "INSERT INTO client ( fname, lname, email, phone, company_name, location, pwd, status, natid, cuname, created_on)"
            . " VALUES (?,?,?,?,?,?,?,?,?,?,CURRENT_TIMESTAMP)";
    $data_array = array($fname, $lname, $email, $phone, $company_name, $location, $pwd, $status, $natid, $uname);
    $type_array = array('s', 's', 's', 's', 's', 's', 's', 's', 'i', 's');

    if ($db->insert($query, $type_array, $data_array) == 1) {
//        echo 'Successfully added Client';
        ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-success", "Client added successfully.");
        </script><?php
    } else {
//        echo 'Failed to add client.';
        ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-error", "Failed to add client.");
        </script><?php
    }
} elseif (isset($_POST['save_edited_client'])) {

    global $db;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company_name = $_POST['coname'];
    $location = $_POST['loc'];
    $pwd = sha1($_POST['uname']);
    $status = '1';
    $natid = $_POST['natid'];
    $uname = $_POST['uname'];

    $id = $_GET['e_c'];

    $query = "UPDATE client SET fname = ?, lname = ?, email = ?, phone = ?, company_name = ?, location = ?, pwd = ?, status = ?, natid = ?, cuname = ? WHERE id = ?";

    $data_array = array($fname, $lname, $email, $phone, $company_name, $location, $pwd, $status, $natid, $uname, $id);
    $type_array = array('s', 's', 's', 's', 's', 's', 's', 's', 'i', 's', 'i');

    if ($db->update($query, $type_array, $data_array) == 1) {
//        echo 'Changes Successfully Saved';
        ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-success", "Changes Successfully Saved.");
        </script><?php
    } else {
//        echo 'Failed to update client.';
        ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-error", "An errror occured. Changes not saved Saved.");
        </script><?php
    }
}
?>

<form class=" <?php echo (isset($_POST['save_edited_client']) ? 'hidden' : ''); ?> form-horizontal add_client_form" method="post" action="">
    <fieldset>
        <legend><?php echo (isset($_GET['e_c']) ? 'Edit Client' : 'Add client'); ?> .</legend>
        <table class="table_forms">
            <tr style="padding: 5px;">
                <td>First name:&nbsp;</td><td><input class="" type="text" name="fname" <?php echo (isset($_GET['e_c']) ? 'value="' . $fname . '"' : ''); ?>  required placeholder="First name"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>Last name:</td><td><input class="" type="text" name="lname" <?php echo (isset($_GET['e_c']) ? 'value="' . $fname . '"' : ''); ?> required placeholder="Last name"/></td>
            </tr>
            <tr>
                <td>Username:</td><td><input class="" type="text" name="uname" <?php echo (isset($_GET['e_c']) ? 'value="' . $uname . '"' : ''); ?> required placeholder="username" maxlength="40"/></td>
                <td>National ID:&nbsp;</td><td><input class="" type="text" name="natid" <?php echo (isset($_GET['e_c']) ? 'value="' . $natid . '"' : ''); ?>  placeholder="ID Number" maxlength="8" required/></td>
            <tr>
                <td>Phone</td><td><input class="" type="text" name="phone" <?php echo (isset($_GET['e_c']) ? 'value="' . $phone . '"' : ''); ?>  value="+254"  required placeholder=""/></td>
                <td>Email:</td><td><input class="" type="email" name="email" <?php echo (isset($_GET['e_c']) ? 'value="' . $email . '"' : ''); ?>  placeholder="email@example.com" required/></td>

                <!--                -->
            <tr>
                <td>Company:</td><td><input class="" type="text" name="coname" <?php echo (isset($_GET['e_c']) ? 'value="' . $company_name . '"' : ''); ?>  required placeholder="Company name"/></td>
                <td>Location:</td><td><input class="" type="text" name="loc" <?php echo (isset($_GET['e_c']) ? 'value="' . $location . '"' : ''); ?>  required placeholder="A place in Nairobi"/></td>
            </tr>
<!--            <tr>
                <td>Duration:</td><td colspan="1"><select name="job_duration">
                        <option value="0">Choose job deration</option>
                        <option value="1">Short term inconsistent</option>
                        <option value="2">Short term consistent</option>
                        <option value="3">Long term inconsistent</option>
                        <option value="4">Long term consistent</option>
                    </select></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category:</td><td><select name="client_category">
                        <option value="0">Select category</option>
                        <option value="1">Small business</option>
                        <option value="2">Company</option>
                    </select></td>
            </tr>-->
            <tr>
                <td></td><td style="text-align: center;"> <input class="btn btn-sm btn-primary" id="reg" type="submit" <?php echo (isset($_GET['e_c']) ? 'name="save_edited_client" value="Save changes"' : 'name="add_client" value="Add client"'); ?> /> </td>
            </tr>
        </table>
    </fieldset>
</form>


