<?php

require_once ("../../include/session.php");
if (isset($_SESSION["adv_id"])) {
    unset($_SESSION["adv_id"]);
}
$_SESSION["adv_id"] = $_POST["padv_id"];
print "Updated as " . $_SESSION["adv_id"];
