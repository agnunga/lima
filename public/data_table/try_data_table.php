<?php
require_once ("../../include/config.php");
require_once ("../../include/database.php");
require_once ("../../include/user.php");
include_once ("../includes/header.php");
?>
<link href="jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="dataTables.tableTools.min.css" rel="stylesheet" type="text/css"/>
<script src="jquery.dataTables.min.js" type="text/javascript"></script>
<script src="dataTables.tableTools.js" type="text/javascript"></script>
<script src="dataTables.tableTools.min.js" type="text/javascript"></script>


<script>
    $(document).ready(function () {
        var table = $('#report').dataTable();
        var tableTools = new $.fn.dataTable.TableTools(table, {
            'sSwfPath': '//cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf',
            'aButtons': ['copy', {
                    'sExtends': 'print',
                    'bShowAll': false
                },
                'csv',
                {
                    'sExtends': 'xls',
                    'sFileName': '*.xls',
                    'sButtonText': 'Save To Excel'
                },
                {
                    'sExtends': 'pdf',
                    'bFooter': false
                }
            ]
        });
        $(tableTools.fnContainer()).insertBefore('#report_wrapper');
    });

</script>


</head>
<body>
    <?php
    global $db;
    $output = '';
    $no = 0;
    $output = '<div style = "border: 1px solid lightgrey; border-radius:5px;">'
    ?><h3 style="text-align:center;">View Employees</h3><hr/>
    <?php
    
    $query = "SELECT id, employee_no, natid, job_desc, department_code, fname, lname, email, salary, phone FROM employee";
   
    //    $res = $db->select($query, $type_array, $data_array);
    $res = $db->select($query, NULL, NULL);
    //    print_r($res);
    if (!empty($res)) {
        ?>
        <div class="col-md-12">

        </div>
        <div class="row">

            <section>

                <div style="padding: 10px">
                    <table class="table table-hover table table-responsive" width="100%" id="report">
                        <thead>
                            <tr>
                                <th>Member No </th>
                                <th>Amount</th>
                                <th>Paid Amount</th>
                                <th>Balance</th>
                                <th>Date Paid</th>
                                <th>Deadline</th>
                                <th>Payment Status</th>
                                <th> Fine</th>
                                <th>Month</th>
                                <th>YEAR</th>


                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            foreach ($res as $row) {
                                ?>
                                <tr>

                                    <td><?php echo $row['fname'] ?></td> 
                                    <td><?php echo $row['lname'] ?></td> 
                                    <td><?php echo $row['employee_no'] ?></td> 
                                    <td><?php echo $row['natid'] ?></td> 
                                    <td><?php echo $row['phone'] ?></td> 
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['employee_no'] ?></td> 
                                    <td><?php echo $row['natid'] ?></td> 
                                    <td><?php echo $row['phone'] ?></td> 
                                    <td><?php echo $row['email'] ?></td>


                                </tr>

                                <?php
                            }
                            ?>
                        </tbody>

                    </table>


                </div>

                <?php
            }
            ?>

        </section> 

    </div>
</body>
</html>
