<?php
 require_once ("../includes/header.php");
include_once("../home/home_actions.php");
?>

<form id="get_jo_done_form" class="form-horizontal"  data-toggle="validator" role="form" method="post" action="" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 10px auto;">
    <legend style="text-align: center;">Get your work done, Request for employees </legend>
    <div class="form-group">
        <label class="control-label col-sm-3">Full Name:</label>
        <div class="col-sm-8">          
            <input class="form-control"  type="text" name="full_name" id="full_name"  maxlength="10" required>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label class="control-label col-sm-3">Phone number:</label>
        <div class="col-sm-8"> 
            <div class="input-group">    
                <span class="input-group-addon">+254</span>     
                <input class="form-control"  type="text" name="phone" id="phone"  maxlength="9" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Company name:</label>
        <div class="col-sm-8">          
            <input class="form-control"  type="text" name="company_name" id="company_name"  maxlength="10" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Location:</label>
        <div class="col-sm-8">          
            <input class="form-control"  type="text" name="location" id="location"  maxlength="45" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Starting date:</label>
        <div class="col-sm-8">         
            <input  type="text" readonly name="job_sdate" id="job_sdate" size="10" required>
            <label>&nbsp;&nbsp;Ending date:</label> 
            <input  type="text" readonly  name="job_edate" id="job_edate" size="10" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3">Select kind:</label>
        <div class="col-sm-8">
            <select  class="form-control"  id="job_type" name="job_type">
                <option value="1">Data entry</option>
                <option value="2">Documentation</option>
                <option value="3">Electrification</option>
            </select>        
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-1 col-sm-10">          
            <label class="control-label">Brief description of the job to be done:</label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-10">          
            <textarea class="" cols="60" rows="5"  id="job_description" name="job_description" required></textarea>
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-3 col-sm-8">
            <input type="submit" id="get_job_done" name="get_job_done" class="btn btn-info" value="Submit request">
        </div>
    </div>
    <hr/> 
    <div class="form-group">        
        <div class="col-sm-offset-1 col-sm-10">
            <?php require_once ("../modals/request_to_be_client_modal.php"); ?>
            <span> If you are already our client <a href="../home/login.php" style="cursor: pointer;text-align: left;"> click here </a> to login </span>
            &nbsp;&nbsp;|&nbsp;&nbsp; 
            Join us. <span style="text-align: right; color: blue;cursor: pointer" data-toggle="modal" data-target="#req_tb_modal">Request to be our client</span>
        </div>
    </div>
</form>
<?php
if (isset($_POST['get_job_done'])) {
    get_job_done();
}
?>
<script>
    $(document).ready(function () {

        $('#get_job_done').click(function () {
            validateForm();
        });
        function validateForm() {


            var nameReg = /^[A-Za-z]+$/;
            var numberReg = /^[0-9]+$/;
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-] { 2, 4 )?$ /;
            
            var names = $('#full_name').val();
            var company = $('#companyInput').val();
            var email = $('#emailInput').val();
            var telephone = $('#phone').val();
            var message = $('#messageInput').val();
            var inputVal = new Array(names, company, email, telephone, message);
            
            var inputMessage = new Array("name", "company", "email address", "telephone number", "message");
            $('.error').hide();
            
            if (inputVal[0] == "") {
                $('#full_name').after('<span class="error"> Please enter your ' + inputMessage[0] + '</span>');
            } else if (!nameReg.test(names)) {
                $('#full_name').after('<span class="error"> Letters only</span>');
            }

            if (inputVal[1] == "") {
                $('#companyLabel').after('<span class="error"> Please enter your ' + inputMessage[1] + '</span>');
            }

            if (inputVal[2] == "") {
                $('#emailLabel').after('<span class="error"> Please enter your ' + inputMessage[2] + '</span>');
            } else if (!emailReg.test(email)) {
                $('#emailLabel').after('<span class="error"> Please enter a valid email address</span>');
            }

            if (inputVal[3] == "") {
                $('#phone').after('<span class="error"> Please enter your ' + inputMessage[3] + '</span>');
            } else if (!numberReg.test(telephone)) {
                $('#phone').after('<span class="error"> Numbers only</span>');
            }

            if (inputVal[4] == "") {
                $('#messageLabel').after('<span class="error"> Please enter your ' + inputMessage[4] + '</span>');
            }
        }
    });
</script>