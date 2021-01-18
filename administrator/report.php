<?php
require_once('inc/init.php');
$PageName = "index";

$hide_cosignment = "hidden";

if (isset($_REQUEST['from'])) {
    $from = $_REQUEST['from'];
} else {
    echo "<script>alert(\" No Date From. Please select your date. Thank You.\");
               window.location.href='index.php';</script>";
    exit();
}

if (isset($_REQUEST['to'])) {
    $to = $_REQUEST['to'];
} else {
    echo "<script>alert(\" No Date To. Please select your date. Thank You.\");
               window.location.href='index.php';</script>";
    exit();
}

if (isset($_REQUEST['status'])) {
    $status = $_REQUEST['status'];
} else {
    $status = 4;
}

if ($to == '' || $to == NULL) {
    $to = date('Y-m-d H:i:s');
}


$from = strtotime($from);
$from_display = date('Y-m-d', $from);
$from = date('Y-m-d H:i:s', $from);

$to = strtotime($to);
$to_display = date('Y-m-d', $to);
$to = date('Y-m-d H:i:s', $to);

$admin_id = 0;

switch ($status) {
    case "1":
        $status_summary_display = "Failed / Canceled";
        break;
    case "2":
        $status_summary_display = "To Ship";
        break;
    case "3":
        $status_summary_display = "Shipping";
        break;
    case "4":
        $status_summary_display = "Completed";
        break;
    case "5":
        $status_summary_display = "To Cancel";
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <?php require_once('inc/admin_nav.php'); ?>
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <!-- top nav -->
            <?php include_once('inc/top_nav.php'); ?>
            <!-- top nav -->

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Order Report</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Report</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">

                <br>

                <div class="row">
                    <div class="col-md-9 text-center">

                    </div>
                    <div class="col-md-3 text-center">
                        <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#summary"> &nbsp;View Summary</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <a href="report.php?from=<?php echo $_REQUEST['from']; ?>&to=<?php echo $_REQUEST['to']; ?>&status=2">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Order Pending</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="report.php?from=<?php echo $_REQUEST['from']; ?>&to=<?php echo $_REQUEST['to']; ?>&status=3">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Order Shipping</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="report.php?from=<?php echo $_REQUEST['from']; ?>&to=<?php echo $_REQUEST['to']; ?>&status=4">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Order Complete</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3">
                        <a href="report.php?from=<?php echo $_REQUEST['from']; ?>&to=<?php echo $_REQUEST['to']; ?>&status=1">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Order Canceled/Rejected</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <br>
                <div class="ibox-content">

                    <div class="form-group" id="data_5">
                        <label class="font-normal">Range select</label>
                        <form role="form" id="form_get_order" method="post">

                            <div class="input-daterange input-group" id="datepicker">

                                <input type="text" class="form-control-sm form-control" name="min" id="min" value="" required />
                                <span class="input-group-addon">to</span>
                                <input type="text" class="form-control-sm form-control" name="max" id="max" value="" required />
                                &nbsp;


                                <a id="get_order" class="btn btn-white btn-xs" onclick="get_order();"><i class="fa fa-search"></i> Search </a>

                            </div>
                        </form>
                    </div>

                    <script type="text/javascript">
                        var from;
                        var to;


                        function get_order() {
                            from = document.getElementById("min");
                            to = document.getElementById("max");
                            window.open("report.php?from=" + from.value + "&to=" + to.value, '');
                        }
                    </script>
                </div>
                <br>

                <div class="modal inmodal" id="summary" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content animated fadeIn">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Order Summary</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                $col = 'SUM(total_payment) as total_payment, SUM(total_price) as total_price, SUM(discount_amount) as discount_amount, SUM(discount_reward) as discount_reward, SUM(shipping_fee) as shipping_fee';
                                $tb = ' orders';
                                $opt = 'date_modified >= ? AND DATE_ADD(date_modified, INTERVAL -1 DAY) <= ? AND status = ? AND admin_id = ?';
                                $arr = array($from, $to, $status, $admin_id);
                                $get_result_payment = $db->advwhere($col, $tb, $opt, $arr);
                                if ($get_result_payment[0]['total_payment'] == NULL) {
                                    $total_payment = 0;
                                    $total_price = 0;
                                    $total_shipping = 0;
                                    $total_discount = 0;
                                    $total_point_discount = 0;
                                } else {
                                    $total_payment = $get_result_payment[0]['total_payment'];
                                    $total_price = $get_result_payment[0]['total_price'];
                                    $total_shipping = $get_result_payment[0]['shipping_fee'];
                                    $total_discount = $get_result_payment[0]['discount_amount'];
                                    $total_point_discount = $get_result_payment[0]['discount_reward'];
                                }

                                $col = 'SUM(oi.qty) as total_item';
                                $tb = 'order_items oi left join orders o on oi.order_id = o.id';
                                $opt = 'o.date_modified >= ? AND DATE_ADD(o.date_modified, INTERVAL -1 DAY) <= ? AND o.status = ? AND o.admin_id = ?';
                                $arr = array($from, $to, $status, $admin_id);
                                $result = $db->advwhere($col, $tb, $opt, $arr);

                                if ($result[0]['total_item'] == NULL) {
                                    $total_item = 0;
                                } else {
                                    $total_item = $result[0]['total_item'];
                                }
                                // var_dump($result);

                                ?>

                                <div class="ibox-content">
                                    <div class="col-lg-12">
                                        <div class="contact-box ">
                                            <h2 class="m-b-xs">
                                                <strong>Order <?php echo $status_summary_display; ?>:</strong>
                                                <h3>Order Ranged
                                                    <?php
                                                    echo '  from: ' . $from_display;
                                                    echo ' to: ' . $to_display;
                                                    ?>
                                                </h3>
                                            </h2>
                                            <br>
                                            <table class="table">

                                                <thead>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Total Order Price</td>
                                                        <td>RM <?php echo number_format($total_price, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Discount Price</td>
                                                        <td>-RM <?php echo number_format($total_discount, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Point Discount</td>
                                                        <td>-RM <?php echo number_format($total_point_discount, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Shipping</td>
                                                        <td>RM <?php echo number_format($total_shipping, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Order Payment (Counted Shipping & Discount)</td>
                                                        <td>RM <?php echo number_format($total_payment, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Item Quantity</td>
                                                        <td><?php echo $total_item; ?></td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>

                                            </table>

                                            <div class="table-responsive m-t">
                                                <table class="table invoice-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Item List</th>
                                                            <th>Quantity</th>
                                                            <th>Sales</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $col = "SUM(oi.qty) as product_qty, SUM(oi.price * oi.qty) as product_price, pt.name as product_name";
                                                        $tb = 'order_items oi left join orders o on oi.order_id = o.id left join product_translation pt on pt.product_id = oi.product_id';
                                                        $opt = 'o.admin_id = ? AND o.date_modified >= ? AND DATE_ADD(o.date_modified, INTERVAL -1 DAY) <= ? AND o.status = ? AND pt.language = ? AND o.admin_id = 0 GROUP BY pt.name ORDER BY pt.name ASC';
                                                        $arr = array($admin_id, $from, $to, $status, "en");
                                                        $result_item = $db->advwhere($col, $tb, $opt, $arr);
                                                        foreach ($result_item as $row) {

                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <div><strong><?php echo $row["product_name"]; ?></strong></div>
                                                                </td>
                                                                <td><?php echo $row["product_qty"]; ?></td>
                                                                <td>RM <?php echo number_format($row["product_price"], 2); ?></td>
                                                            </tr>
                                                        <?php

                                                        }

                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <a href="print_summary.php?from=<?php echo $from; ?>&&to=<?php echo $to; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print </a>
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12">

                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Order Ranged
                                    <?php
                                    echo '  from: ' . $from_display;
                                    echo ' to: ' . $to_display;
                                    ?>
                                </h5>
                            </div>
                            <div class="ibox-content">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Status</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Postcode</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Contact</th>
                                                <th>Total Price</th>
                                                <th>Coupon</th>
                                                <th>Discount Percentage</th>
                                                <th>Discount Amount</th>
                                                <th>Shipping Fee</th>
                                                <th>Total Payment</th>
                                                <th <?php echo $hide_cosignment; ?>>Consignment Number</th>
                                                <th>Order Id</th>
                                                <th>User</th>
                                                <th>Date Settle</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $i = 1;
                                            $col = "o.*, st.name as state_name, u.name as user_name";
                                            $tb = "orders o left join state st on o.customer_state = st.id left join users u on u.id = o.users_id";
                                            $opt = 'o.date_modified >= ? AND DATE_ADD(o.date_modified, INTERVAL -1 DAY) <= ? AND o.status = ? && o.admin_id = ? ORDER BY o.date_modified DESC';
                                            $arr = array($from, $to, $status, $admin_id);
                                            $product = $db->advwhere($col, $tb, $opt, $arr);
                                            foreach ($product as $row) {

                                                $id = $row['id'];
                                                $order_status = $row['status'];

                                                //view order
                                                $btn_view = '<a data-remote="ajax/order_view.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">View</a>';

                                                switch ($order_status) {
                                                    case "1":
                                                        $status_color = "text-danger";
                                                        $status_display = "Failed / Canceled";
                                                        $status_desc = "This order was rejected, or your order payment was failed.";
                                                        $btn_action = $btn_view;
                                                        break;
                                                    case "2":
                                                        $status_color = "text-warning";
                                                        $status_display = "To Ship";
                                                        $status_desc = "Waiting for the Caroma Malaysia to ship out the products.";
                                                        $btn_action = $btn_view;
                                                        break;
                                                    case "3":
                                                        $status_color = "text-success";
                                                        $status_display = "Shipping";
                                                        $status_desc = "This order had been shipped.";
                                                        $btn_action = $btn_view;
                                                        break;
                                                    case "4":
                                                        $status_color = "text-info";
                                                        $status_display = "Completed";
                                                        $status_desc = "The order was delivered.";
                                                        $btn_action = $btn_view;
                                                        break;
                                                    case "5":
                                                        $status_color = "text-dark";
                                                        $status_display = "To Cancel";
                                                        $status_desc = "The order is pending to Cancel.";
                                                        $btn_action =  $btn_view;
                                                }

                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><span class="<?php echo $status_color; ?> font-weight-bold"><?php echo $status_display; ?></span>
                                                    </td>
                                                    <td><?php echo $row['customer_name']; ?></td>
                                                    <td><?php echo $row['customer_email']; ?></td>
                                                    <td><?php echo $row['customer_address']; ?></td>
                                                    <td><?php echo $row['customer_postcode']; ?></td>
                                                    <td><?php echo $row['customer_city']; ?></td>
                                                    <td><?php echo $row['state_name']; ?></td>
                                                    <td><?php echo $row['customer_contact']; ?></td>
                                                    <td><?php echo number_format($row['total_price'], 2); ?></td>
                                                    <td><?php echo ($row['coupon_code'] != "") ? $row['coupon_code'] : "-"; ?>
                                                    </td>
                                                    <td><?php echo intval($row['discount_percent']); ?>%</td>
                                                    <td><?php echo number_format($row['discount_amount'], 2); ?></td>
                                                    <td><?php echo number_format($row['shipping_fee'], 2); ?></td>
                                                    <td><?php echo number_format($row['total_payment'], 2); ?></td>
                                                    <td <?php echo $hide_cosignment; ?>>
                                                        <?php echo $row['consignment_number']; ?></td>
                                                    <td><?php echo $row['gateway_order_id']; ?></td>
                                                    <td><?php echo $row['user_name']; ?></td>
                                                    <td><?php echo $row['date_modified']; ?></td>
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

                <div class="row">
                    <div class="col-lg-12">

                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Order Ranged
                                    <?php
                                    echo '  from: ' . $from_display;
                                    echo ' to: ' . $to_display;
                                    ?>
                                </h5>
                            </div>
                            <div class="ibox-content">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item List</th>
                                                <th>Quantity</th>
                                                <th>Sales</th>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $i = 1;

                                            foreach ($result_item as $row) {

                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><strong><?php echo $row["product_name"]; ?></strong></td>
                                                    <td><?php echo $row["product_qty"]; ?></td>
                                                    <td>RM <?php echo number_format($row["product_price"], 2); ?></td>

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
                

                <div class="row">
                    <div class="col-lg-6" style="display: none;">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Line Chart Example
                                    <small>With custom colors.</small>
                                </h5>
                            </div>
                            <div class="ibox-content">
                                <div>
                                    <canvas id="lineChart" height="140"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Top Selling Product Bar Chart</h5>
                            </div>
                            <div class="ibox-content">
                                <div>
                                    <canvas id="barChart" height="140"></canvas>
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
    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>
    <script src="js/demo/chartjs-demo.js"></script>


    <!-- Page-Level Scripts -->
    <script>
        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        //this script for modal 
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
        });
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [{
                        extend: 'csv'
                    },
                    {
                        extend: 'excel',
                        title: 'ExampleFile'
                    },
                    {
                        extend: 'print',
                        customize: function(win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });


        });
    </script>



</body>

</html>