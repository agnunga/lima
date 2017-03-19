<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
if (isset($_GET['act'])) {
    if ($_GET['act'] == 'c_alo') {
        view_allocated(); //
    }
    if ($_GET['act'] == 'p_alo') {
        past_allocations(); //
    }
}

//view_allocated();
function view_allocated() {
    $cli_no = $_POST['id'];
//    $cli_no = 48;
    $limit = 20;
    $offset = 0;

    $query1 = " SELECT emp.employee_no, emp.fname, emp.lname ,emp.phone, alo.id,  alo.start_date,  alo.end_date, cli.company_name "
            . " FROM allocations alo, employee emp, client cli  "
            . " WHERE emp.employee_no = alo.employee_no"
            . " AND alo.state = '1'"
            . " AND emp.status = '1'"
            . " AND cli.cuname = alo.client_id"
            . " AND cli.id = '$cli_no'"
            . " AND alo.end_date > CURRENT_DATE "
            . " ORDER BY emp.fname DESC"
            . " LIMIT $limit OFFSET $offset";

    global $db;
    $res1 = $db->select($query1, NULL, NULL);

    if (!empty($res1)) {
        echo '<h3 style="text-align:center; text-decoration:underline;"> Currently Allocated Employees </h3>';
        ?>
        <style>
            .alo_emp_d{
                text-align: center;
                width: 150px; margin: 0 10px 20px 10px; padding: 10px;  height: 150px !important; overflow-y: auto;  background: rgba(100,20,80,.015); border: 1px solid lightblue; border-radius: 0px;
            }
        </style>
        <div style = "border: 1px solid lightgrey; border-radius:5px;">
            <table class="table table table-hover"> <thead> <tr> 
                        <th>#</th> <th>Employee No:</th> <th>Name</th><th>Phone</th> 
                        <th>Start date</th> <th>End Date</th> <th>Recommendation</th> 
                    </tr> </thead> <tbody class = "">
                    <?php
                    foreach ($res1 as $result_set) {

                        $alo_id = $result_set['id'];
                        $emp_no = $result_set['employee_no'];
                        $fname = $result_set['fname'];
                        $lname = $result_set['lname']; //
                        $phone = $result_set['phone']; //
                        $company_name = $result_set['company_name']; //
                        $start_date = $result_set['start_date']; //
                        $end_date = $result_set['end_date']; //
                        ?>
                        <tr>
                            <td><?php echo $alo_id ?>&nbsp;&nbsp;<?php
                                $ppic = '../images/thumb_nails/thumb_' . $emp_no . '.png';
                                if (is_file($ppic)) {
                                    echo '<img src="../images/thumb_nails/thumb_' . $emp_no . '.png">';
                                } else {
                                    ?><i class="fa fa-user fa-3x"></i><?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $emp_no; ?>
                            </td>
                            <td>
                                <?php echo $fname . "  " . $lname; ?>
                            </td>
                            <td>
                                <?php echo $phone; ?>
                            </td>
                            <td>
                                <?php echo $start_date; ?>
                            </td>
                            <td>
                                <?php echo $end_date; ?>
                            </td>
                            <td>
                                <?php echo $alo_id; ?>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody> 
            </table>
        </div>

        <?php
    } else {
        echo 'No Currently allocated employees';
    }
}

//past_allocations();
function past_allocations() {
    $cli_no = $_POST['id'];
    $cuname = $_POST['cuname'];
//    $cli_no = 48;
    $limit = 100;
    $offset = 0;

    $query1 = " SELECT emp.employee_no, emp.fname, emp.lname ,emp.phone, alo.id,  alo.start_date,  alo.end_date, cli.company_name "
            . " FROM allocations alo, employee emp, client cli  "
            . " WHERE emp.employee_no = alo.employee_no"
            . " AND cli.cuname = alo.client_id"
            . " AND alo.state = '0'"
            . " AND emp.status = '1'"
            . " AND alo.client_id = '$cuname'"
            . " AND cli.id = '$cli_no'"
//            . " AND alo.end_date > CURRENT_DATE "
            . " ORDER BY alo.id"
            . " LIMIT $limit OFFSET $offset";


    global $db;
    $res1 = $db->select($query1, NULL, NULL);

    if (!empty($res1)) {

        echo '<h3 style="text-align:center; text-decoration:underline;"> Last Allocation. </h3>';
        ?>
        <div id="allocate_div">
            <script>
                $(document).ready(function () {
                    $("#alo_s_date").datepicker({
                        dateFormat: "yy-mm-dd",
                        defaultDate: +2,
                        showAnim: "slide",
                        minDate: "+1d",
                        maxDate: "+1m"
                    });
                    $("#alo_e_date").datepicker({
                        dateFormat: "yy-mm-dd",
                        defaultDate: +3,
                        showAnim: "slide",
                        minDate: "+7d",
                        maxDate: "+1y"
                    });
                });
            </script>
            <form  class = "form-inline" method="post" action ="" style="width: 100%;">
                <div class="form-group" style="width: 100%;"  style="text-align: left;">
                    <div class="row" style="text-align: left;"><?php
                        foreach ($res1 as $result_set) {

                            $alo_id = $result_set['id'];
                            $emp_no = $result_set['employee_no'];
                            $fname = $result_set['fname'];
                            $lname = $result_set['lname']; //
                            $phone = $result_set['phone']; //
                            $company_name = $result_set['company_name']; //
                            $start_date = $result_set['start_date']; //
                            $end_date = $result_set['end_date']; //
                            ?>
                            <style>
                                .alo_emp_d{
                                    text-align: center;
                                    width: 150px; margin: 0 10px 20px 10px; padding: 10px;  height: 150px !important; overflow-y: auto;  background: rgba(100,20,80,.015); border: 1px solid lightblue; border-radius: 0px;
                                }
                            </style>
                            <div class="col-xs-2 alo_emp_d">
                                <input style="float: left;" type="checkbox" name="alo_id[]" value="<?php echo $alo_id ?>"/>&nbsp;&nbsp;<?php echo $emp_no ?><br/>
                                <?php
                                $ppic = '../images/thumb_nails/thumb_' . $emp_no . '.png';
                                if (is_file($ppic)) {
                                    echo '<img src="../images/thumb_nails/thumb_' . $emp_no . '.png"><br/>';
                                } else {
                                    ?><i class="fa fa-user fa-3x"></i><br/><?php } ?>
                                <span style="font-size: 18px; color: lightseagreen;"> <?php echo $lname . '  ' . $fname ?></span>
                                <br/><span style="font-size: 10px; color: lightlue;">(&nbsp; <?php echo $start_date . " to " . $end_date ?>&nbsp;)</span><br/> 
                            </div>

                            <?php
                        }
                        ?></div>
                    <!--<hr/>-->
                    <h3 style="text-align:center; text-decoration:underline;"> Allocate Checked Employees </h3>
                    <input type="text" name="al_client" value="<?php echo $cuname; ?>">
                    <label>&nbsp;&nbsp;Start date: </label>
                    <input class="form-control" type="text" id="alo_s_date" name="sdate" required  size="" maxlength="15" placeholder="yyy-mm-dd">
                    <label>&nbsp;&nbsp;End date:</label>
                    <input class="form-control" type="text" id="alo_e_date" name="edate" required size="" maxlength="15" placeholder="yyy-mm-dd">
                    <input type="submit" name="allocate" class="btn btn-info" style="float: next;" value="Allocate"><br/>
                </div>
            </form>
        </div>
        <?php
    } else {
        ?><p style="color: #00aeef;">No previously allocated employees allocated to you are available for re-allocation.</p><?php
    }
}

function requests() {
    
}
