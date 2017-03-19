
<div class = "modal fade" id="req_tb_modal" role = "dialog" data-backdrop = "false" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-lg" style="margin: auto; width: 600px;">
            <div class = "modal-header">
                <button class = "close" data-dismiss = "modal">&times; </button>
                <input id="m_id" value="" hidden="">
                <h4 id='m_pos' style="text-align: center; margin: 0;">Request to be a client</h4>
            </div>
            <div class = "modal-body">
                <div class="form-horizontal" role="form" method="post" action="" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 10px auto;">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="">First name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="fname" class="form-control" id="" required placeholder="" maxlength="32" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Last name:</label>
                        <div class="col-sm-9">
                            <input type="text" name="lname" class="form-control" id="lname" required placeholder=""  maxlength="32">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-sm-3">Email:</label>
                        <div class="col-sm-9">          
                            <input type="email" class="form-control" name="email"  id="" required placeholder=""  maxlength="32">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Phone No.:</label>
                        <div class="col-sm-9">          
                            <input type="text" class="form-control" name="phone"  value="+254" id="" required placeholder=""  maxlength="13">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Company Name:</label>
                        <div class="col-sm-9">          
                            <input type="text" class="form-control" name="coname"  id="" required placeholder="" maxlength="60">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3">Location:</label>
                        <div class="col-sm-9">          
                            <input type="text" class="form-control" name="loc"  id="" placeholder="" required maxlength="40">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-3"></label>
                        <div class="col-sm-3">
                            <input type="submit" name="req_to_be_client" class="btn btn-info" value="Submit request">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12" style="text-align: center;">
                            <!--If you are already our client <a id="index_client_login" style="cursor: pointer"> click here </a> to login-->
                            If you are already our client <a href="../home/login.php" style="cursor: pointer"> click here </a> to login
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#get_job_done', function (e) {
        e.preventDefault();
        var full_name = $('#full_name').val();
        var phone = $('#phone').val(); //
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