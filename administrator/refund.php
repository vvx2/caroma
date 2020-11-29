<?php
require_once('inc/init.php');
$PageName = "refund";

if (isset($_REQUEST['page'])) {
    $refund_type = $_REQUEST['page'];
} else {
    $refund_type = 1;
}


?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <!-- left nav -->
        <?php include_once('inc/admin_nav.php'); ?>
        <!-- left nav -->
        <div id="page-wrapper" class="gray-bg">
            <!-- top nav -->
            <?php include_once('inc/top_nav.php'); ?>
            <!-- top nav -->
            <div class="wrapper wrapper-content wrapperes">

                <div class="wrapper wrapper-content animated fadeInRight wrapper_table">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Product</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Status</th>
                                                    <th>Amount</th>
                                                    <th>Distributor</th>
                                                    <th>Date Created</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                $col = "*, dw.id as refund_id, dw.date_created as request_date";
                                                $tb = "distributor_wallet_transaction dw left join users u on dw.distributor_id = u.id";
                                                $opt = 'dw.status = ? ORDER BY dw.date_modified DESC';
                                                $arr = array($refund_type);
                                                $refund = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($refund as $row) {

                                                    $id = $row['refund_id'];
                                                    $status = $row['status'];

                                                    //approve refund
                                                    $btn_approve = '<a data-remote="ajax/refund_approve.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Approve</a>';
                                                    //to reject refund, status -> failed/rejected
                                                    $btn_cancel = '<a data-remote="ajax/refund_cancel.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Cancel</a>';
                                                    //view refund
                                                    $btn_view = '<a data-remote="ajax/refund_view.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">View</a>';

                                                    switch ($status) {
                                                        case "1":
                                                            $status_color = "text-warning";
                                                            $status_display = "Pending";
                                                            $status_desc = "This refund request is waiting admin to approve.";
                                                            $btn_action = $btn_view . $btn_approve;
                                                            break;
                                                        case "2":
                                                            $status_color = "text-success";
                                                            $status_display = "Success";
                                                            $status_desc = "This refund was approved and completed.";
                                                            $btn_action = $btn_view;
                                                            break;
                                                        case "3":
                                                            $status_color = "text-success";
                                                            $status_display = "Rejected";
                                                            $status_desc = "This refund was rejected.";
                                                            $btn_action = $btn_view . $btn_cancel;
                                                    }

                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><span class="<?php echo $status_color; ?> font-weight-bold"><?php echo $status_display; ?></span></td>
                                                        <td><?php echo number_format($row['amount'], 2); ?></td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['request_date']; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php echo $btn_action; ?>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                <?php $i++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    </div>

    </div>
    <!-- this is for display modal by ajax -->
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">

            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        //this script for modal 
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
        });

        $(document).ready(function() {

            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [

                    {
                        extend: 'csv',
                    },
                    {
                        extend: 'excel',
                        title: 'Product',
                    }
                ],

            });




        });
    </script>

</body>

</html>