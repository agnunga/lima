<?php require_once ("../includes/header.php"); ?>
<div class="form-search form-horizontal">
    <div class="col-sm-10">
        <input type="text" id="key_word_id" name="key_word" class="form-control search-query input-group-lg" placeholder="Search for a qualification here" required>
    </div>
    <div class="col-sm-2">
        <button id="search_qual" type="submit" name="search" class="btn btn-info"><i class='fa fa-search'></i>&nbsp; Search</button>
    </div>
</div>
<script>
    $(document).on('click', '#search_qual', function () {
        var search_key = $('#key_word_id').val();
        alert(search_key);

        $.ajax({
//            url: "mgmt_actions.php?em_act=search_qual",
            url: "search_qual.php",
            method: "POST",
            data: {search_key: search_key},
            dataType: "text",
            success: function (data) {
                alert(data);
                $('#qual_search_res').empty().append(data);
            }
        });
    });
</script>