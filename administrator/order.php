<?php
require_once('inc/init.php');
$PageName = "order";

if (isset($_REQUEST['page'])) {
    $pagetype = $_REQUEST['page'];
} else {
    $pagetype = 2;
}

if ($pagetype == 2) {
    $hide_cosignment = "hidden";
} else {
    $hide_cosignment = "";
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
                <?php

                $table = "orders";
                $col = "id";
                $opt = 'status = ? && admin_id = ? ';
                $arr = array(2, 0);
                $count_pending = $db->advwhere($col, $table, $opt, $arr);
                $count_pending = count($count_pending);

                $table = "orders";
                $col = "id";
                $opt = 'status = ? && admin_id = ? ';
                $arr = array(3, 0);
                $count_shipping = $db->advwhere($col, $table, $opt, $arr);
                $count_shipping = count($count_shipping);

                $table = "orders";
                $col = "id";
                $opt = 'status = ? && admin_id = ? ';
                $arr = array(4, 0);
                $count_complete = $db->advwhere($col, $table, $opt, $arr);
                $count_complete = count($count_complete);

                $table = "orders";
                $col = "id";
                $opt = 'status = ? && admin_id = ? ';
                $arr = array(1, 0);
                $count_cancel = $db->advwhere($col, $table, $opt, $arr);
                $count_cancel = count($count_cancel);
                ?>

                <div class="wrapper wrapper-content wrapperes">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="order.php?page=2">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Pending</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins"><?php echo $count_pending; ?></h1>
                                        <small>Total</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="order.php?page=3">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Shipping</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins"><?php echo $count_shipping; ?></h1>
                                        <small>Total</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="order.php?page=4">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Complete</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins"><?php echo $count_complete; ?></h1>
                                        <small>Total</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-3">
                            <a href="order.php?page=1">
                                <div class="ibox ">
                                    <div class="ibox-title">
                                        <h5>Canceled/Rejected</h5>
                                    </div>
                                    <div class="ibox-content">
                                        <h1 class="no-margins"><?php echo $count_cancel; ?></h1>
                                        <small>Total</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

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
                                                    <th>User Type</th>
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
                                                    <th>Discount Caroma Coin</th>
                                                    <th>Shipping Fee</th>
                                                    <th>Gst Rate</th>
                                                    <th>Gst Tax</th>
                                                    <th>Total Payment</th>
                                                    <th <?php echo $hide_cosignment; ?>>Consignment Number</th>
                                                    <th>Order Id</th>
                                                    <th>Order Item</th>
                                                    <th>User</th>
                                                    <th>Date Create</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                $col = "o.*, st.name as state_name, u.name as user_name , u.type as user_type";
                                                $tb = "orders o left join state st on o.customer_state = st.id left join users u on u.id = o.users_id";
                                                $opt = 'o.status = ? && o.admin_id = ? ORDER BY o.date_modified DESC';
                                                $arr = array($pagetype, 0);
                                                $product = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($product as $row) {

                                                    $id = $row['id'];
                                                    $status = $row['status'];

                                                    //approve order when order is status "Failed / Canceled", maybe some reason cause order failed, can approve again with this button
                                                    $btn_approve = '<a data-remote="ajax/order_approve.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Approve</a>';
                                                    //to assign consignment number, status -> shipping
                                                    $btn_assign_cosignment = '<a data-remote="ajax/order_assign.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Assign Consignment number</a>';
                                                    //to reject order, status -> failed/rejected
                                                    $btn_cancel = '<a data-remote="ajax/order_cancel.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Cancel</a>';
                                                    //order deliverd, status -> completed
                                                    $btn_complete = '<a data-remote="ajax/order_complete.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">To Complete</a>';
                                                    //view order
                                                    $btn_view = '<a data-remote="ajax/order_view.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">View</a>';

                                                    switch ($status) {
                                                        case "1":
                                                            $status_color = "text-danger";
                                                            $status_display = "Failed / Canceled";
                                                            $status_desc = "This order was rejected, or your order payment was failed.";
                                                            $btn_action = $btn_view . $btn_approve;
                                                            break;
                                                        case "2":
                                                            $status_color = "text-warning";
                                                            $status_display = "To Ship";
                                                            $status_desc = "Waiting for the Caroma Malaysia to ship out the products.";
                                                            $btn_action = $btn_view . $btn_assign_cosignment . $btn_cancel;
                                                            break;
                                                        case "3":
                                                            $status_color = "text-success";
                                                            $status_display = "Shipping";
                                                            $status_desc = "This order had been shipped.";
                                                            $btn_action = $btn_view . $btn_complete;
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
                                                            $btn_action =  $btn_view . $btn_cancel;
                                                    }

                                                    if ($row['user_type'] == 1) {
                                                        $order_user_type = "Normal User";
                                                    } else if ($row['user_type'] == 2) {
                                                        $order_user_type = "Distributor";
                                                    } else {
                                                        $order_user_type = "Dealer";
                                                    }

                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><span class="<?php echo $status_color; ?> font-weight-bold"><?php echo $status_display; ?></span>
                                                        </td>
                                                        <td><?php echo $order_user_type; ?></td>
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
                                                        <td><?php echo number_format($row['discount_reward'], 2); ?></td>
                                                        <td><?php echo number_format($row['shipping_fee'], 2); ?></td>
                                                        <td><?php echo intval($row['gst_rate']); ?>%</td>
                                                        <td><?php echo number_format($row['gst_fee'], 2); ?></td>
                                                        <td><?php echo number_format($row['total_payment'], 2); ?></td>
                                                        <td <?php echo $hide_cosignment; ?>>
                                                            <?php echo $row['consignment_number']; ?></td>
                                                        <td><?php echo $row['gateway_order_id']; ?></td>
                                                        <td>

                                                            <table width="350">

                                                                <tr>
                                                                <th>Product</th>
                                                                <th>Qty</th>
                                                                </tr>
                                                                <?php

                                                                $table = "order_items o left join product p on o.product_id = p.id left join product_translation pt on o.product_id = pt.product_id";
                                                                $col = "o.id as id, o.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, o.price as price";
                                                                $opt = 'o.order_id = ? AND pt.language = ? ';
                                                                $arr = array($id, $_SESSION['language']);
                                                                $order_item = $db->advwhere($col, $table, $opt, $arr);

                                                                foreach ($order_item as $item) {
                                                                ?>
                                                                    <tr>
                                                                        <td> <?php echo $item['name']; ?> </td>
                                                                        <td><?php echo $item['qty']; ?></td>


                                                                    </tr>

                                                                <?php } ?>

                                                            </table>

                                                        </td>
                                                        <td><?php echo $row['user_name']; ?></td>
                                                        <td><?php echo $row['date_created']; ?></td>
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
        $('.chosen-select').chosen({
            width: "100%"
        });
        $.validator.setDefaults({
            ignore: ":hidden:not(.chosen-select)"
        }) //for all select having class .chosen-select


        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
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

            $("#form_product").validate({
                rules: {
                    name_en: {
                        required: true,

                    },
                    name_cn: {
                        required: true,

                    },
                    name_my: {
                        required: true,

                    },
                    desc_en: {
                        required: true,

                    },
                    desc_cn: {
                        required: true,

                    },
                    desc_my: {
                        required: true,

                    },
                    stock: {
                        required: true,

                    },
                    point: {
                        required: true,

                    },
                    user_price: {
                        required: true,

                    },
                    distributor_price: {
                        required: true,

                    },
                    dealer_price: {
                        required: true,

                    },
                    img: {
                        required: true,

                    },
                    category: {
                        required: true,

                    }

                }
            });



        });
    </script>

</body>

</html>