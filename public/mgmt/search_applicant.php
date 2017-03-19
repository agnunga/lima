<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
global $db;
$sby = $_POST['sby']; //, keyw
$keyw = $_POST['keyw']; // "qual"  
$search_col = "";
$search_col2 = "";


switch ($sby) {
    case "qual":
        $search_col = "qual.qtitle";
        $search_col1 = "app.relevance";
        break;
    case "doap":
        $search_col = "appl.applied_on";
        $search_col1 = "app.time_applied";
        break;
    case "dead":
        $search_col = "adv.apply_before";
        $search_col1 = "adv.apply_before";
        break;
    default :
        $search_col = "adv.position";
        $search_col1 = "adv.position";
        break;
}

$querye = "SELECT DISTINCT adv.apply_before, adv.interview_date, adv.position,"
        . " emp.employee_no, emp.fname, emp.lname, emp.phone, "
        . " qual.qtitle, appl.applied_on "
        . " FROM job_advert adv, employee emp, qualifications qual, applications appl "
        . " WHERE adv.apply_before < CURRENT_DATE"
        . " AND appl.advert_id = adv.id"
        . " AND appl.applicant_id = emp.employee_no"
        . " AND appl.ligible = 'p'"
        . " AND appl.applicant_id = qual.userid  "
        . " AND $search_col LIKE '%$keyw%' "
        . " ORDER BY adv.position ASC";


$queryj = "SELECT  adv.apply_before, adv.interview_date, adv.position, "
        . " app.advert_id, app.natid, app.phone, app.full_name, app.relevance, app.time_applied "
        . " FROM js_applications  app, job_advert adv "
        . " WHERE ligible = 'p'"
        . " AND $search_col1 LIKE '%$keyw%' "
        . " AND app.advert_id LIKE adv.id"
        . " ";

$rese = $db->select($querye, NULL, NULL);
$resj = $db->select($queryj, NULL, NULL);
//    print_r($rese);
echo '<div style="border:1px solid black;">';
echo '<table class="table table table-hover"> <thead> <tr> '
 . '<th>#</th><th>Position</th><th>Applicant Name</th> '
 . '<th>Phone NO:</th> <th>Qualification</th> <th>Applied on</th> <th>Deadline</th> <th><i class="fa fa-eye"></i>CV</th>  <th><i class="fa fa-send"></i>SMS</th> '
 . '</tr> </thead> <tbody class = "">';
$no = 0;
if (!empty($rese)) {
    ?>

    <script>
        //            $(document).on('click', '#download_cv', function () {
        //                alert('Download Cv');
        //                $.fileDownload('../uploads/14595727622146235418830.pdf')
        //                        .done(function () {
        //                            alert('File download a success!');
        //                        })
        //                        .fail(function () {
        //                            alert('File download failed!');
        //                        });
        //            });


        function send_name_n_loc(loc, name) {
            var name = name;
            var uid = loc;
            //                alert(uid + '  ' + name);

            if (confirm("Download " + name + "'s CV?")) {
                $.ajax({
                    url: "view_pdf.php",
                    method: "POST",
                    data: {name: name, uid: uid},
                    dataType: "text",
                    success: function (data) {
                        if (data === 'CV DOES NOT EXIST') {
                            alert(data);
                        } else {
                            window.open(data, '_blank');
                        }
                        //                            '<a href="' + data + '" download="cvjsxz"><button>Download CV</button></a>'));
                        //                            alert(data);
                    },
                    fail: function () {
                        alert("Failed!");
                    }

                });
            }
        }

        function send_name_n_contact(phone, name, intv_date) {
            if (confirm("Send interview invitation SMS to " + name + "?" + intv_date)) {
//                alert('Sent to ' + name + ', ' + phone + '.');//
                $.ajax({
                    url: "../sms/sendJobsms.php",
                    method: "POST",
                    data: {intv_date: intv_date, phone: phone},
                    dataType: "text",
                    success: function (data) {
                        alert(data);
                    },
                    fail: function () {
                        alert("Failed!");
                    }

                });
            }
        }
    </script>




    <?php
    foreach ($rese as $row) {
//            ' . $row['uploaded_to'] . '
        $no++;
        echo '<tr class="info">';
        echo '<td>' . $no . '</td>';
        echo '<td>' . $row['position'] . '</td>';
//            echo '<td>' . $row['employee_no'] . '</td>';
        echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['qtitle'] . '</td>';
        echo '<td>' . $row['applied_on'] . '</td>';
        echo '<td>' . $row['apply_before'] . '</td>'
        . '';
        ?>

        <td><button id="download_cv" onclick="send_name_n_loc('<?php echo $row['employee_no']; ?>', '<?php echo $row['fname'] . $row['lname']; ?>');" style="color: red;"><i class="fa fa-file-pdf-o"></i></button></td>

        <td> <button onclick="send_name_n_contact('<?php echo $row['phone']; ?>', '<?php echo $row['lname']; ?>', '<?php echo $row['interview_date']; ?>');"><i class="fa fa-envelope" style="color: green;"></i></button><button onclick="send_name_n_contact('<?php echo $row['phone']; ?>', '<?php echo $row['lname']; ?>');"><i class="fa fa-trash-o"></i></button> </td> 
        <?php
        echo '</tr>';
    }
}
if (!empty($resj)) {
    foreach ($resj as $row) {
        $no++;
        echo '<tr class="warning">';
        echo '<td>' . $no . '</td>';
        echo '<td>' . $row['position'] . '</td>';
        echo '<td>' . $row['full_name'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['relevance'] . '</td>';
        echo '<td>' . $row['time_applied'] . '</td>';
        echo '<td>' . $row['apply_before'] . '</td>'
        . '<td>';
        ?>

        <button onclick="send_name_n_loc('<?php echo $row['natid']; ?>', '<?php echo $row['full_name']; ?>');"><i class="fa fa-file-pdf-o" style="color: red;"></i></button> </td>
        <td><span><button  onclick="send_name_n_contact('<?php echo $row['phone']; ?>', '<?php echo $row['full_name']; ?>', '<?php echo $row['interview_date']; ?>');"><i class="fa fa-envelope" style="color: blue;"></i></button><button  onclick="send_name_n_contact('<?php echo $row['phone']; ?>', '<?php echo $row['full_name']; ?>');"><i class="fa fa-trash"></i></button></span></td>

        <?php
        echo '</tr>';
    }
}
echo '</div>';
