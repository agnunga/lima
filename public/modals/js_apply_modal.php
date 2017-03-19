
<div class = "modal fade" id="js_apply_modal" role = "dialog" data-backdrop = "true" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-lg" style="margin: auto; width: 500px;">
            <div class = "modal-header">
                <button class = "close" data-dismiss = "modal">&times; </button>
                <input id="m_id" value="" hidden="">
                <h4 id='m_pos' style="text-align: center;"></h4>
            </div>
            <div class = "modal-body">

                <script src="../includes/upload_cv.js" type="text/javascript"></script>
                <link href="../bootstrap/css/file_upload_style.css" rel="stylesheet" type="text/css"/>
                <div id="upload-wrapper" class="">
                    <div align="center">
                        <div id="upload_cv_fm">
                            <h4>Start with CV Upload</h4>
                            <form action="../includes/processupload_cv_js.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
                                <input name="FileInput" id="FileInput" type="file" />
                                <input type="submit"  id="submit-btn" class="btn btn-info fa fa-upload btn-lg" value="&nbsp;&nbsp;&nbsp;&nbsp;Upload&nbsp;&nbsp;&nbsp;&nbsp;" />
                                <img src="../sys_images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
                            </form>
                            <div id="progressbox" ><div id="progressbar"></div ><div id="statustxt">0%</div></div>
                        </div>
                        <div id="cv_success" class="hidden" style="text-align: center; color: #00aeef;">CV Uploaded Successfully! Fill description and send.</div>
                        <div id="output"></div>
                    </div>
                </div>
                <div class="form-horizontal" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 10px auto;">
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="">National ID:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_natid" value="" required placeholder="" maxlength="8" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Full name:</label>
                        <div class="col-sm-8">
                            <input type="text" name="full_name" class="form-control" id="id_full_name" value="" required placeholder=""  maxlength="32">
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="control-label col-sm-4">Phone No.:</label>
                        <div class="col-sm-8">          
                            <input type="tel" class="form-control" name="phone" id="id_phone" value="+2547" required placeholder=""  maxlength="13">
                        </div>
                    </div> 

                    <!--                    <div>
                                            <script src="../includes/upload_cv.js" type="text/javascript"></script>
                                            <link href="../bootstrap/css/file_upload_style.css" rel="stylesheet" type="text/css"/>
                                            <div id="upload_cv_fm">
                                                <form action="../includes/processupload_cv_js.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
                    
                                                    <label class="col-sm-1">CV:</label>
                                                    <input class="col-sm-9" name="FileInput" id="FileInput" type="file" />
                                                    <input style="margin-right:0px;" class="col-sm-2 btn btn-success btn-sm"  type="submit"  id="submit-btn" value="Upload" />
                    
                                                </form>
                                            </div>
                                            <div id="cv_success" class="hidden" style="text-align: center; color: #00aeef;">CV Uploaded Successfully</div>
                                            <div class="" id="output"></div>
                                        </div> -->


                    <div class="form-group"> 
                    </div>
                    <div class="form-group">
                        <label class="col-sm-offset-1 col-sm-11">Brief description yourself with relevance to the job:</label>

                        <div class="col-sm-offset-0 col-sm-12">          
                            <textarea style="margin-bottom: 10px;" cols="50" rows="5" id="id_brief_description" name="brief_description" placeholder=""></textarea>
                        </div>
                    </div>
                    <!--                        <div class="form-group">
                                                                  <label class="control-label col-sm-4">Upload CV:</label>
                                                                  <div class="col-sm-8">          
                                                                      <input type="file" class="" name="cv" id="id_cv" value="<?php echo ""; ?>" placeholder="" required maxlength="40">
                                                                  </div>
                                                              </div>-->
                    <div class="form-group">
                        <p class="control-label col-sm-7">Cannot send before CV is uploaded.</p>
                        <div class="col-sm-3">
                            <button id="id_js_aply" class="btn btn-info disabled" data-dismiss = "modal">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script>
    $(document).on('blur', '#id_natid', function () {
        if ($('#id_natid').val() <= 10000000 || $('#id_natid').val() >= 40000000) {
            alert('Invalid ID Number');
            $('#id_natid').val('');
            return false;
        }
    });
    $(document).on('click', '#id_js_aply', function () {
        var adv_id = $('#m_id').val();
        //        alert(adv_id);
        var natid = $('#id_natid').val();
        var full_name = $('#id_full_name').val();
        var phone = $('#id_phone').val();
        var b_desc = $('#id_brief_description').val();
        var cv = $('#output').html();


        //        alert(natid + ' ' + adv_id + ' ' + full_name + ' ' + phone + ' ' + b_desc + ' ' + cv + ' ');
        $.ajax({
            url: "home_actions.php?home_act=js_apply",
            method: "POST",
            data: {adv_id: adv_id, natid: natid, full_name: full_name, phone: phone, b_desc: b_desc, cv: cv},
            dataType: "text",
            success: function (data) {
//                alert(data);
                $('#id_natid').val('');
                $('#id_full_name').val('');
                $('#id_phone').val('');
                $('#id_brief_description').val('');
                $('#success_alert_message').removeClass('hidden');
               faddingAllert("#alert_message", "alert-success", "Job application successfull.");
            }
        });
    });
</script>
