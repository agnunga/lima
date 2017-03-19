<div class = "modal fade" id="send_cli_sms_modal" role = "dialog" data-backdrop = "true" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <input id="s_cli_phone" type="hidden">
        <input id="s_cli_id" type="hidden">
        <div class = "modal-content modal-lg" style="margin: auto; width: 400px;">
            <div class = "modal-header" style="padding: 5px; margin: 0;">
                <button class = "close" data-dismiss = "modal">&times; </button>
                <h4 id='m_rec_cli' style="text-align: center; margin: 0;"></h4>
            </div>
            <div class="form-horizontal" style="border: 1px solid lightblue; border-radius: 10px; padding:10px; margin: 10px auto;"> 
                <textarea style="margin-bottom: 10px;" onkeyup="ckeck_des_len()" cols="42" rows="5" id="mesg_cli" name="brief_description" required  placeholder="Type your message here..."></textarea>

                <button id="send_cli_sms"  class="btn btn-xs btn-info hiddenX" data-dismiss = "modal">Send</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-xs" data-dismiss = "modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<script>

    function r_cli_sendId(id, fname, phone) {
//        alert(id + fname + phone);
        $('#s_cli_id').val(id);
        $('#s_cli_phone').val(phone);
        $('#m_rec_cli').empty().append('Send SMS to ' + fname + ' (' + phone + ')');
    }

    $(document).on('click', '#send_cli_sms', function () {
        var id = $('#s_cli_id').val();
        var phone = $('#s_cli_phone').val();
        var msg = $('#mesg_cli').val();
        if (msg.length < 10) {
            alert("Not allowed! Message too short.");
            return false;
        }
//        alert(phone + '  ' + msg + id);
        $.ajax({
            url: "../sms/r_clientsms.php?act=sms",
            method: "POST",
            data: {msg: msg, phone: phone, id: id},
            dataType: "text",
            success: function (data) {
//                alert(data);
                faddingAllert("#alert_message", "alert-success", "SMS sent successfully.");
                $('#mesg_cli').val('');
                $('#tr_' + id).addClass('hidden');
            }
        });
    });
</script>
