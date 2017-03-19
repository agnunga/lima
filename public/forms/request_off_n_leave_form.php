<?php require_once ("../includes/header.php"); ?>
<form id="req_off_req_form" class="form-horizontal" role="form" method="post" action="">
    <legend>Request sick off or leave</legend>
    <div class="form-group">
        <label class="control-label col-sm-2">Select kind:</label>
        <div class="col-sm-10">
            <select  id="oftype" name="off_type">
                <option value="1">Sick off</option>
                <option value="2">Maternity leave</option>
                <option value="3">Paternity leave</option>
            </select>        
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Starting date:</label>
        <div class="col-sm-10">          
            <input type="text" readonly name="sdate" id="off_start_date"  maxlength="10" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Ending date:</label>
        <div class="col-sm-10">   
            <input type="text" readonly  name="edate" id="off_end_date" maxlength="10" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Brief<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br/>--> description:</label>
        <div class="col-sm-10">          
            <textarea  id="ofdesc" name="off_desc" required></textarea>
        </div>
    </div>
    <div class="form-group">        
        <div class="col-sm-offset-2 col-sm-8">
            <input type="submit" id="reqoff" name="req_off_leave" class="btn btn-info" value="Submit request">
        </div>
    </div>
</form>
<script>
    $(document).on('click', '#reqoff', function (e) {
        e.preventDefault();
        var oftype = $('#oftype').val();
        var sdat = $('#off_start_date').val(); //off_desc
        var edat = $('#off_end_date').val();
        var off_desc = $('#ofdesc').val();
//            alert(off_desc + sdat + edat + oftype);
        $.ajax({
            url: "../employee/send_off_req.php",
            method: "POST",
            data: {oftype: oftype, sdat: sdat, edat: edat, off_desc: off_desc},
            dataType: "text",
            success: function (data) {
                alert(data);
                $('#req_off_req_form').addClass('hidden');
            },
            fail:function(){
                alert("FAILED");
            }
        });
    });
</script>