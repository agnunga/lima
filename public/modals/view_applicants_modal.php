
<div class = "modal fade" id="view_applicants_modal" role = "dialog" data-backdrop = "true" data-keyboard = "false" data-show = "true">
    <div class = "modal-dialog">
        <div class = "modal-content modal-lg" style="margin: 0 auto auto -300px; width: 1200px;">
            <div class = "modal-header">
                <button class = "close"- data-dismiss = "modal">&times; </button>
                <form>
                    <input id="m_id" name="id">
                </form>
                <h4 id='m_pos' style="text-align: center;"></h4>
            </div>
            <div class = "modal-body">
                <?php
                $v_aplcnts = 0;
                if (isset($_SESSION["adv_id"])) {
                    $v_aplcnts = $_SESSION["adv_id"];
//                    echo 'POP' . $v_aplcnts;
                    unset($_SESSION["adv_id"]);
//                    echo 'The unset sesIn' . $_SESSION["adv_id"];
                } else {

//                    echo 'The unset sesOu' . $_SESSION["adv_id"];
                }
                echo '$v_aplcnts2F' . $v_aplcnts;
                

                global $db;
                $querye = "SELECT  emp.employee_no, emp.fname, emp.lname ,emp.phone , c.uploaded_to, app.applied_on , app.relevance, app.ligible"
                        . " FROM applications app, employee emp, cv c"
                        . " WHERE app.advert_id = ?"
                        . " AND app.applicant_id = emp.employee_no"
                        . " AND c.user_id = emp.employee_no";

                $queryj = "SELECT advert_id, natid, phone, full_name, relevance, time_applied, marked FROM js_applications "
                        . " WHERE advert_id = '$v_aplcnts' AND marked = 'p' ORDER BY id DESC";

                $data_arraye = array($v_aplcnts);
                $type_arraye = array('i');
                $rese = $db->select($querye, $type_arraye, $data_arraye);
                $resj = $db->select($queryj, NULL, NULL);

                echo '<table class="table table table-hover"> <thead> <tr> '
                . '<th>#</th> <th>Identity.</th> <th>Name</th> <th>Phone</th> '
                . '<th>CV</th> <th>Applied on</th> <th>Relevance</th> <th>Status</th> <th></th> '
                . '</tr> </thead> <tbody class = "">';
                $no = 0;
                if (!empty($rese)) {
                    foreach ($rese as $row) {
                        $no++;
                        echo '<tr class="info">';
                        echo '<td>' . $no . '</td>';
                        echo '<td>' . $row['employee_no'] . '</td>';
                        echo '<td>' . $row['fname'] . ' ' . $row['lname'] . '</td>';
                        echo '<td>' . $row['phone'] . '</td>';
                        echo '<td>' . $row['uploaded_to'] . '</td>';
                        echo '<td>' . $row['applied_on'] . '</td>';
                        echo '<td>' . $row['relevance'] . '</td>';
                        echo '<td>' . $row['ligible'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo 'No applicants for this position<br>';
                }
                if (!empty($resj)) {
                    foreach ($resj as $row) {
                        $no++;
                        echo '<tr class="warning">';
                        echo '<td>' . $no . '</td>';
                        echo '<td>' . $row['natid'] . '</td>';
                        echo '<td>' . $row['full_name'];
                        echo '<td>' . $row['phone'] . '</td>';
//                        echo '<td>' . $row['uploaded_to'] . '</td>';
                        echo '<td>CV</td>';
                        echo '<td>' . $row['time_applied'] . '</td>';
                        echo '<td>' . $row['relevance'] . '</td>';
                        echo '<td>' . $row['marked'] . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</tbody></table>';
                ?>
                <button id="close_view_ap"  class="btn btn-info disabled hidden" data-dismiss = "modal">Close</button>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '#close_view_ap', function () {
        $.ajax({
            url: "home_actions.php?home_act=js_apply",
            method: "POST",
            data: {adv_id: adv_id, natid: natid, full_name: full_name, phone: phone, b_desc: b_desc},
            dataType: "text",
            success: function (data) {
                alert(data);
//                $('#success_alert_message').append(data);
                $('#id_natid').val('');
                $('#id_full_name').val('');
                $('#id_phone').val('');
                $('#id_brief_description').val('');
                $('#success_alert_message').removeClass('hidden');
                faddingAllert('#success_alert_message');
            }
        });
    });
</script>
