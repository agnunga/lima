<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");

if (isset($_POST['add_employee'])) {
    
        global $db;
        $empno = $_POST['emp_no'];
        $natid = $_POST['natid'];
        $job_desc = $_POST['job_desc'];
//        $dptcode = $_POST['dpt'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $salary = 0;
        $phone = $_POST['phone'];
        $emp_as = $_POST['emp_as'];
        $pwd = sha1($empno);
//            $nssfno = $_POST['nssf'];
//            $nhifno = $_POST['nhif'];
//            $krapin = $_POST['kra'];

        $type = array('d', 'd', 's', 's', 's', 's', 'd', 's', 's', 's');
        $data = array($empno, $natid, $job_desc, $fname, $lname, $email, $salary, $phone, $emp_as, $pwd);

        $query = "INSERT INTO `employee` "
                . "(`employee_no`, `natid`, `job_desc`, `fname`, `lname`, `email`, `salary`, `phone`,`parmanent`, `pwd`) "
                . "VALUES (?,?,?,?,?,?,?,?,?,?)";
        if ($db->insert($query, $type, $data) == 1) {
//            echo 'Employee added successfully.';
             ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-success", "Employee added Successfully.");
        </script><?php
        } else{
//            echo 'Employee addition FAILED!';
             ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-error", "Adding employee failed.");
        </script><?php
        }
}
if (isset($_POST['edit_employee_save'])) {
    global $db;

    $id = $_GET['edit_emp'];
    $empno = $_POST['emp_no'];
    $natid = $_POST['natid'];
    $job_desc = $_POST['job_desc'];
//    $dptcode = $_POST['dpt'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $salary = 0;
    $phone = $_POST['phone'];
    $emp_as = $_POST['emp_as'];
    $pwd = sha1($empno);
//            $nssfno = $_POST['nssf'];
//            $nhifno = $_POST['nhif'];
//            $krapin = $_POST['kra'];

    $query = "UPDATE employee SET employee_no = ?, natid = ?, job_desc = ?, fname = ?, lname = ?, email = ?, salary = ?, phone = ?, parmanent = ?, pwd = ? WHERE id = ?";
    $type_array = array('d', 'd', 's', 's', 's', 's', 'd', 's', 's', 's', 'i');
    $data_array = array($empno, $natid, $job_desc, $fname, $lname, $email, $salary, $phone, $emp_as, $pwd, $id);

    if ($db->insert($query, $type_array, $data_array) == 1) {
//        echo 'Changes saved successfully.';
        ?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-success", "Changes Successfully Saved.");
        </script><?php
    } else{
        //        echo 'Saving changes FAILED!';
?><script type="text/javascript">
            faddingAllert("#alert_message", "alert-error", "An error occured. Changes not Saved.");
        </script><?php
    }
}
?>
<form <?php echo (isset($_POST['edit_employee_save']) ? 'class="hidden"' : ''); ?> class="form-horizontal add_employee_form" method="post" action="">
    <fieldset>
        <legend><?php echo (isset($_GET['edit_emp']) ? 'Edit employee' : 'Add Employee'); ?></legend>
        <table>
            <tr>
                <!--$emp_no, $natid, $jobdesc, $depcode, $fname, $lname, $email, $phone-->
                <td>First name:</td><td><input class="" type="text" name="fname" <?php echo (isset($_GET['edit_emp']) ? 'value="' . $fname . '"' : ''); ?>  required placeholder="First name"/></td>
                <td>Last name:</td><td><input class="" type="text" name="lname" <?php echo (isset($_GET['edit_emp']) ? 'value="' . $lname . '"' : ''); ?>  required placeholder="Lastst name"/></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td>National ID:&nbsp;&nbsp;&nbsp;</td><td><input class="" type="text" name="natid" <?php echo (isset($_GET['edit_emp']) ? 'value="' . $natid . '"' : ''); ?>    placeholder="ID Number" maxlength="8" required/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>Employee No:&nbsp;&nbsp;&nbsp;</td><td><input class="" type="text" name="emp_no" <?php echo (isset($_GET['edit_emp']) ? 'value="' . $employee_no . '"' : ''); ?>   required placeholder="Employee No" maxlength="9"/></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td>Email:</td><td><input class="" type="email" name="email" <?php echo (isset($_GET['edit_emp']) ? 'value="' . $email . '"' : ''); ?>   placeholder="email@example.com" required/></td>
                <td>Phone:</td><td><input class="" type="tel" name="phone" <?php echo (isset($_GET['edit_emp']) ? 'value="' . $phone . '"' : ''); ?>   maxlength="13" required placeholder=""/></td>
            </tr>
            <tr style="height: 10px;"></tr>
            <tr>
                <td>Duty:</td><td colspan="3"><input class=""  style="width: 100%;" type="text" name="job_desc" <?php echo (isset($_GET['edit_emp']) ? 'value="' . $job_desc . '"' : ''); ?>   placeholder="Brief name/description of employee job" required/></td>
            </tr>
            <tr style="height: 10px;"></tr>
<!--               <tr>
                <td colspan="3">Gender:
                    <input type="radio" name="sex" value="m">Male&nbsp;&nbsp;
                    <input type="radio" name="sex" value="f">Female</td>
                <td></td><td></td>
            </tr>-->
            <tr>
                <td colspan="3">Type of employment:
                    <input type="radio" name="emp_as" value="0">Casual&nbsp;&nbsp;
                    <input type="radio" name="emp_as" value="1">Permanent</td>
                <td></td><td></td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td colspan="2" style="height: 60px;">
                    <input class="btn btn-primary" id="reg" type="submit" <?php echo (isset($_GET['edit_emp']) ? 'name="edit_employee_save" value="Savechanges"' : 'name="add_employee" value="Add employee"'); ?> />
                </td>
            </tr>
        </table>
    </fieldset>
</form>


