<?php
require_once ("../includes/header.php");
?>
<script>
    $(function () {
        $("#accordion").accordion({
            collapsible: true
        });
    });
</script> 
<div id="accordion" style="max-width:200px; overflow-y: hidden;">
    <h3>Section 1</h3>
    <ul>
        <li><a href="#"> Add  </a> </li>
        <li><a href="#"> Remove </a> </li>
    </ul>
    <h3>Section 2</h3>
        <ul>
        <li><a href="#"> Remove </a> </li>
        <li><a href="#"> Reports </a> </li>
    </ul>
    <h3>Section 3</h3>
        <ul>
        <li><a href="#"> Add management </a> </li>
        <li><a href="#"> Remove  </a> </li>
    </ul>
    <h3>Section 4</h3>
        <ul>
        <li><a href="#"> Remove </a> </li>
        <li><a href="#"> Reports </a> </li>
    </ul>
</div>


</body>
</html>