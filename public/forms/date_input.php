<span class="my_whole_yob">
    <style>
        .my_yob{
            margin-left: -4px;
            padding: 0;
            height: 25px;
        }
        .my_whole_yob{
            margin: 10px;
        }
    </style>
    <select aria-label="Month" name="birthday_month" id="month" title="Month" class="my_yob">
        <option value="0" selected="1">Month</option>
        <option value="1">Jan</option><option value="2">Feb</option><option value="3">Mar</option><option value="4">Apr</option><option value="5">May</option><option value="6">Jun</option><option value="7">Jul</option><option value="8">Aug</option><option value="9">Sep</option><option value="12">Dec</option>
    </select>
    <select aria-label="Day" name="birthday_day" id="day" title="Day" class="my_yob">
        <option value="0" selected="1">Day</option>
        <?php for ($i = 1; $i <= 31; $i++) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        } ?>
    </select>
    <select aria-label="Year" name="birthday_year" id="year" title="Year" class="my_yob">
        <option value="0" selected="1">Year</option>
<?php for ($i = date('Y')-$start_age; $i >= date('Y')-$end_age; $i--) {
    echo '<option value="' . $i . '">' . $i . '</option>';
} ?>
    </select>
</span>

