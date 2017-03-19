<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
require_once ("../includes/header.php");

if (isset($_POST['contact_us'])) {
    global $db;
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $desc = $_POST['desc'];

        $query = "INSERT INTO `contact_us` (`fname`, `lname`, `phone`, `email`, `subject`, `detailed`) VALUES (?,?,?,?,?,?)";
    $type_array = array('s', 's', 'i', 's', 's', 's');
    $data_array = array($fname, $lname, $phone, $email, $title, $desc);
    if ($db->insert($query, $type_array, $data_array) == 1) {
        echo '<p style="color:lightblue; text-align:center;">Message sent sucessfully</p>';
    } else {
        echo 'Sennding failed';
    }
}
?>
<form class="form-horizontal" role="form" method="post" action="" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 10px auto; max-width: 500px;">
    <legend style="text-align: center;">Contact us.</legend>
    <div class="form-group">
        <label class="control-label col-sm-3" for="">First name:</label>
        <div class="col-sm-9">
            <input type="text" name="fname" class="form-control" id=""  required placeholder="" maxlength="32" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Last name:</label>
        <div class="col-sm-9">
            <input type="text" name="lname" class="form-control" id="lname"  required placeholder=""  maxlength="32">
        </div>
    </div> 
    <div class="form-group">
        <label class="control-label col-sm-3">Phone No.:</label>
        <div class="col-sm-9">          
            <input type="tel" class="form-control" name="phone"  id="" required placeholder=""  maxlength="13">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Email:</label>
        <div class="col-sm-9">          
            <input type="email" class="form-control" name="email" id="" required placeholder=""  maxlength="32">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Subject: </label>
        <div class="col-sm-9">
            <input type="text" name="title" class="form-control" id=""  required placeholder=""  maxlength="32">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Description:</label>
        <div class="col-sm-9"> <textarea class="form-control" name="desc" cols="" rows="5"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3"></label>
        <div class="col-sm-3">
            <input class="btn btn-sm btn-primary" id="reg" type="submit" name="contact_us" value="Send"/>
        </div>
        <div class="col-sm-8">
        </div>
    </div>

</form>