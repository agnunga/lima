<?php
include_once("../includes/header.php");
require_once("../../include/functions.php");
require_once("../../include/config.php");
require_once("../../include/database.php");
require_once("../../include/user.php");
?>
<script type="text/javascript">
    $(document).ready(function () {
        setInterval(function () {
            $('#users').load('maintrial.php')
        }, 5000);
    });
</script>s
<div id="users">
    Loading users...
</div>
<div class="container">

    <body >
        <br><br>
        <div class="container">
            <div id="alert_message" class="alert" style=" margin: auto; width:400px; text-align: center; position: fixed; top: 30%; left: 35%; z-index: 1000;" >
                <span class="close" data-dismiss="alert">&times;</span>
                <span><strong>Failed!</strong>Impossible option.</span>
            </div>
            <script> faddingAllert("#alert_message","alert-warning", "Close the sshiit nowClose the sshiit nowClose the sshiit nowClose the sshiit nowClose the sshiit nowClose the sshiit now");</script>
        </div>  
</div>


<div class="accordion" id="accordion2" style="width: 50%; margin: 0 auto;">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                Collapsible Group Item #1
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse in">
            <div class="accordion-inner">
                Anim pariatur nim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                cliche...
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                Collapsible Group Item #2
            </a>
        </div>
        <div id="collapseTwo" class="accordion-body collapse">
            <div class="accordion-inner">
                Anim parianim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                tur cliche...
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#oloo">
                oloo
            </a>
        </div>
        <div id="oloo" class="accordion-body collapse">
            <div class="accordion-inner">
                Anim parianim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                tur cliche...
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#pol">
                pol
            </a>
        </div>
        <div id="pol" class="accordion-body collapse">
            <div class="accordion-inner">
                Anim parianim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                tur cliche...
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#kuta">
                kuta
            </a>
        </div>
        <div id="kuta" class="accordion-body collapse">
            <div class="accordion-inner">
                Anim parianim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                tur cliche...
            </div>
        </div>
    </div>
</div>
...