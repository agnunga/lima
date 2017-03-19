<div class = "modal fade" id="em_apply_modal" role = "dialog" data-backdrop = "true" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-lg" style="margin: auto; width: 500px;">
            <div class = "modal-header">
                <button class = "close" data-dismiss = "modal">&times; </button>
                <input id="m_id" value="" hidden="">
                <h4 id='m_pos' style="text-align: center; margin: 0;">Apply for the job adverted: </h4>
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
                                <input type="submit"  id="submit-btn" value="Upload" />
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
                        <label class="col-sm-offset-1 col-sm-11">Brief description yourself with relevance to the job:</label>
                    </div>
                    <div class="col-sm-offset-0 col-sm-12"> 
                        <div id="len_warn" class="" style="text-align: center; margin: -25px auto 0 auto; color: brown;">(Must be more than 50 characters.)</div>
                        <textarea style="margin-bottom: 10px;" onkeyup="ckeck_des_len()" cols="50" rows="5" id="id_brief_description" name="brief_description" required  placeholder=""></textarea>
                    </div> 

                    <div class="form-group">
                        <label class="control-label col-sm-4"></label>
                        <div class="col-sm-3">
                            <button id="id_em_aply"  class="btn btn-info disabled hidden" data-dismiss = "modal">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
//Check the length of the description , if its less than 50, enable the send button and remove the Warning it must be larger than 50 characters
    function ckeck_des_len() {
        var des_len = $("#id_brief_description").val().length;
        if (des_len > 50) {
            $("#len_warn").addClass('hidden');
            $('#id_em_aply').removeClass('disabled');
        } else if (des_len < 50) {
            $("#len_warn").removeClass('hidden');
            $('#id_em_aply').addClass('disabled');
        }
    }



    $(document).on('click', '#id_em_aply', function () {
        var adv_id = $('#m_id').val();
        var b_desc = $('#id_brief_description').val();
        var cv = $('#output').html();

//        alert(adv_id + '  ' + b_desc + '  ' + cv);
        $.ajax({
            url: "employee_actions.php?em_act=em_apply",
            method: "POST",
            data: {adv_id: adv_id, b_desc: b_desc, cv: cv},
            dataType: "text",
            success: function (data) {
//                alert(data);
                faddingAllert("#alert_message", "alert-success", "Job application successfull.");
                $('#id_brief_description').val('');
            }
        });
    });
</script>
