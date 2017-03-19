<?php

//Automatic decoration of navbar for the current page
function this_page() {
    $currentPage = basename($_SERVER['SCRIPT_FILENAME']);
    ?> 
    <ul id="nav"> 
        <li><a href="index.php" <?php
            if ($currentPage == 'index.php') {
                echo 'id="here"';
            }
            ?>>Home</a></li> 
        <li><a href="blog.php" <?php
            if ($currentPage == 'blog.php') {
                echo 'id="here"';
            }
            ?>>Blog</a></li> 
        <li><a href="gallery.php" <?php
            if ($currentPage == 'gallery.php') {
                echo 'id="here"';
            }
            ?>>Gallery</a></li> 
        <li><a href="contact.php" <?php
            if ($currentPage == 'contact.php') {
                echo 'id="here"';
            }
            ?>>Contact</a></li> 
    </ul> <?php
}

//FOR SLIDE SHOW
function file_upload() {
    $images = array(
        array('file' => 'kinkakuji',
            'caption' => 'The Golden Pavilion in Kyoto'),
        array('file' => 'maiko',
            'caption' => 'Maiko&#8212;trainee geishas in Kyoto'),
        array('file' => 'maiko_phone',
            'caption' => 'Every maiko should have one&#8212;a mobile, of course'),
        array('file' => 'monk',
            'caption' => 'Monk begging for alms in Kyoto'),
        array('file' => 'fountains',
            'caption' => 'Fountains in central Tokyo'),
        array('file' => 'ryoanji',
            'caption' => 'Autumn leaves at Ryoanji temple, Kyoto'),
        array('file' => 'menu',
            'caption' => 'Menu outside restaurant in Pontocho, Kyoto'),
        array('file' => 'basin',
            'caption' => 'Water basin at Ryoanji temple, Kyoto')
    );
    $i = rand(0, count($images) - 1);
    $selectedImage = "images/{$images[$i]['file']}.jpg";
    $caption = $images[$i]['caption'];
}
?>

<script>
    $("#myform").click(function () {
        var data = $("#myform : input").serializeArray();
        $.post($("#myform").attr("action"), data, function (info) {
            $("#result").html(info);
        });
    });
</script>
<?php
$register = "SELECT emp.employee_id, emp.firstname, emp.lastname, emp.email,
COUNT(att.absence) AS absences, COUNT(att.vacation) AS vacation,
SUM(comp.bonus) AS bonus
FROM employees emp, attendance att, compensation comp
WHERE emp.employee_id = att.employee_id
AND emp.employee_id = comp.employee_id
GROUP BY emp.employee_id ASC
ORDER BY emp.lastname;#006600";
$sql = 'SELECT * FROM `mngmt` JOIN MANAGES
    ON BOOK.SERIAL_NUM = MANAGES.SERIAL_NUMBER JOIN LIBRARIAN
    ON MANAGES.ID_NUMBER = LIBRARIAN.ID_NUMBER 
    WHERE `BOOK`.`TITLE` like ?';

$stmt = $db->prepare($sql);
$stmt->bind_param('s', $title);
$stmt->execute();

$result = $stmt->get_result();
//bearerbox -v 0 /etc/kannel/kannel.conf
//http://localhost:603/cgi-bin/sendsms?username=kannel&password=kannel&to=+254712929181&text=hpppp

//<div class="input-group">
//    <span class="input-group-addon">@</span>
//    <input type="text" class="form-control" id="inputGroupSuccess1" aria-describedby="inputGroupSuccess1Status">
//  </div>