<?php
require_once ("../includes/header.php");
if (isset($_GET['tobeclient'])) {
    if (($_GET['tobeclient']) == 1) {
        echo 'Registered';
    } elseif (($_GET['tobeclient']) == 0) {
        echo 'Registration dailed!';
    }
}
?>
<div class="container-fluid">
    <nav class="navbar">
        <div class="navbar navbar-fixed-top" style="border-bottom: 1px solid lightgrey; background: rgba(240,240,240,0.98);">
            <div class="row">
                <div class="col-md-offset-0 col-md-12" style="padding-right: 35px;">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="../home/index.php">ILTS </a>
                    </div>
                    <ul class="nav navbar-nav">

                    </ul> 
                    <ul class="nav navbar-nav navbar-right">
                    </ul>
                </div>
            </div>
        </div>
    </nav> 
    <div class="row">
        <div class="col-md-offset-3 col-md-6" id="request_to_be_client">
            <h2 style="text-align: center; text-decoration: underline; margin-top: -15px;">&nbsp;Request to be our client.&nbsp;</h2>
            <p>Fill in <b>Request to be a client</b> form. This is for an individual, an organization or company representative that 
                desires to be our client and enjoy the ease of communication and employee acquisition. </p>
            <!--<p>We shall confirm and add you as our client shortly.</p>-->
            <?php require_once ("../forms/request_to_be_client_form.php"); ?>
            <?php // require_once '../forms/get_job_done_form.php'; ?>

        </div>
    </div>

</div>

<div id="alert" style="position: fixed; top: 25px; z-index: 10000; left: 39%; background: white; width: 350px;">
    <?php
    echo ((isset($_GET['tobeclient']) && $_GET['tobeclient'] == 0) ? '<p style="color:red;text-align: center;">Failed. You had alredy send a request.</p>' : '');
    echo ((isset($_GET['tobeclient']) && $_GET['tobeclient'] == 1) ? '<p style="color:blue;text-align: center;">Request sent successfully.</p>' : '');
    ?>
</div>