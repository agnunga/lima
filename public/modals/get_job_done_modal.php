<div class = "modal fade" id="get_work_done_modal" role = "dialog" data-backdrop = "true" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-lg" style="margin: auto; width: 600px;">
            <div class = "modal-header">
                <button class = "close" data-dismiss = "modal">&times; </button>
                <input id="m_id" value="" hidden="">
                <h5 id='m_pos' style="text-align: center; margin: 0;">Get your work done, Request for employees</h5>
            </div>
            <div class = "modal-body" style="margin: 0; padding: 5px;">
                <form id="get_jo_done_form" class="form-horizontal"  data-toggle="validator" role="form" method="post" action="" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 10px auto;">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Full Name:</label>
                        <div class="col-sm-8">          
                            <input class="form-control"  type="text" name="full_name" id="full_name"  maxlength="30" required>
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
                            <input class="form-control"  type="text" name="company_name" id="company_name"  maxlength="30" required>
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
                            <input  type="text" readonly name="job_sdate" id="job_sdate" size="15" required>
                            <label>&nbsp;&nbsp;Ending date:</label> 
                            <input  type="text" readonly  name="job_edate" id="job_edate" size="15" required>
                            <script type="text/javascript">
                                $(document).ready(function () {

                                    $("#job_sdate").datepicker({
                                        dateFormat: "yy-mm-dd",
                                        defaultDate: +2,
                                        showAnim: "slide",
                                        minDate: "+1d",
                                        maxDate: "+1m"
                                    });
                                    $("#job_edate").datepicker({
                                        dateFormat: "yy-mm-dd",
                                        defaultDate: +3,
                                        showAnim: "slide",
                                        minDate: "+7d",
                                        maxDate: "+1y"
                                    });
                                });</script>
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
                            <input type="submit" data-dismiss = "modal" id="get_job_done" name="get_job_done" class="btn btn-info" value="Submit request">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="margin: 0; padding: 5px; text-align: center;">
                <?php require_once ("../modals/request_to_be_client_modal.php"); ?>
                <span> If you are already our client <a href="../home/login.php" style="cursor: pointer;text-align: left;"> click here </a> to login </span>
                &nbsp;&nbsp;|&nbsp;&nbsp; 
                Join us. 
                <a href="http://localhost/lima/public/home/client.php">
                    <span style="text-align: right; color: blue;cursor: pointer" data-toggle="modal" data-target="#req_tb_modal">
                        Request to be our client</span></a>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '#get_job_done', function (e) {
        e.preventDefault();
        var full_name = $('#full_name').val();
        var phone = '+254' + $('#phone').val(); //
        var company_name = $('#company_name').val();
        var location = $('#location').val();
        var job_sdate = $('#job_sdate').val();
        var job_edate = $('#job_edate').val();
        var job_type = $('#job_type').val();
        var job_description = $('#job_description').val();

//        alert('full_name:' + full_name + 'phone:' + phone + 'company_name:' + company_name + ', location:' + location + ', job_sdate: ' + job_sdate + ', job_edate:' + job_edate + ' job_type:' + job_type + ', job_description: ' + job_description)
        $.ajax({
            url: "../home/home_actions.php?act=get_job_done",
            method: "POST",
            data: {full_name: full_name, phone: phone, company_name: company_name, location: location, job_sdate: job_sdate, job_edate: job_edate,
                job_type: job_type, job_description: job_description},
            dataType: "text",
            success: function (data) {
//                alert(data);
                faddingAllert("#alert_message", "alert-success", "Request sent successfully!");
            },
            fail: function () {
                alert("FAILED");
            }
        });
    });
</script>