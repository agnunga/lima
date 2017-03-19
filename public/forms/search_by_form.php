<?php

function search_by_form($one, $two, $three, $four) {
    echo '<form class="form-search" method="post" action="" enctype="multipart.form-data">
    <label>Search by: </label>
    <select name = "search_by" required style="text-align: center;">
        <option value="1"> ' . $one . '</option>
        <option value="2">  ' . $two . '</option>
        <option value="3"> ' . $three . '</option>
        <option value="3"> ' . $four . '</option>
    </select>

    <input type="text" name="key_word" class="input-medium search-query" required>
    <button type="submit" name="search" class="btn btn-sm btn-info">Search</button>
</form>';
}

//search_by_form("Vacant position", "Job Advert number", "Date posted", "Application deadline date");
