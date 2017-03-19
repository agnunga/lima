<?php
//require_once ("../../include/config.php");
//require_once ("../../include/database.php");
//require_once ("../../include/user.php");
require_once ("../includes/header.php");
?>
<form>
    <legend>Request emergency loan</legend>
    <label>Amount requesting: </label><input type="text" name="em_loan" required="" size="6" maxlength="5"><br/>
    <input type="submit" name="req_em_loan" value="Send request">
</form>