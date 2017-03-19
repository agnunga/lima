<?php
//    echo $who;
echo'';
echo '<input type="hidden" readonly name="lias" value="' . $las . '"><input type="hidden" readonly name="liwth" value="' . $lith . '">';
?> 
<input type="text" class="form-control" name="uname" placeholder="<?php echo $placeholder; ?>"  required>

<input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password" required>

<!--

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
        </div>
    </div>--> 
<div class=" col-sm-offset-3 col-sm-offset-8">
    <input type="submit" id = "login_btn" class="btn btn-default" name="login" value="Log in" style="width: 100px;">
</div> 

