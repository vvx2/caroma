<?php
require_once('inc/init.php');
$PageName = "index";

//-----------------------
//      get point value
$result_point_value = $db->get("*", "reward_point_value", 1);
if (count($result_point_value) != 0) {
    $point_value = $result_point_value[0]['value'];
} else {
    $point_value = 1;
}

$result_gst_value = $db->get("*", "gst_value", 1);
if (count($result_gst_value) != 0) {
    $gst_value = $result_gst_value[0]['value'];
} else {
    $gst_value = 0;
}

$result_coupon_email = $db->get("*", "coupon_email", 1);
if (count($result_coupon_email) != 0) {
    $coupon_id = $result_coupon_email[0]['coupon_id'];
    $tb = "coupon left join coupon_translation on coupon.id = coupon_translation.coupon_id";
    $col = "coupon.id as id, coupon.code as code, coupon_translation.name as name";
    $opt = 'coupon.id = ? && coupon_translation.language = ?';
    $arr = array($coupon_id, "en");
    $result_coupon = $db->advwhere($col, $tb, $opt, $arr);
    if (count($result_coupon) != 0) {
        $coupon_name = $result_coupon[0]['name'];
        $coupon_id = $result_coupon[0]['id'];
        $coupon_code = "- Code: " . $result_coupon[0]['code'];
    } else {
        $coupon_id = 0;
        $coupon_name = "no coupon";
        $coupon_code = "";
    }
} else {
    $coupon_id = 0;
    $coupon_name = "no coupon";
    $coupon_code = "";
}
//-----------------------

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

$table = "users";
$col = "id";
$opt = 'type = ?';
$arr = array(1);
$count_user = $db->advwhere($col, $table, $opt, $arr);
$count_user = count($count_user);

$table = "users";
$col = "id";
$opt = 'type = ?';
$arr = array(2);
$count_distributor = $db->advwhere($col, $table, $opt, $arr);
$count_distributor = count($count_distributor);

$table = "users";
$col = "id";
$opt = 'type = ?';
$arr = array(3);
$count_dealer = $db->advwhere($col, $table, $opt, $arr);
$count_dealer = count($count_dealer);

$table = "coupon";
$col = "id";
$opt = 'status = ?';
$arr = array(1);
$count_coupon = $db->advwhere($col, $table, $opt, $arr);
$count_coupon = count($count_coupon);

$table = "promotion";
$col = "id";
$opt = 'status = ?';
$arr = array(1);
$count_promotion = $db->advwhere($col, $table, $opt, $arr);
$count_promotion = count($count_promotion);

$table = "product";
$col = "id";
$opt = 'stock <= ? ';
$arr = array(10);
$count_stock = $db->advwhere($col, $table, $opt, $arr);
$count_stock = count($count_stock);

$table = "distributor_wallet_transaction";
$col = "id";
$opt = 'status = ?';
$arr = array(1);
$count_refund_pending = $db->advwhere($col, $table, $opt, $arr);
$count_refund_pending = count($count_refund_pending);

$table = "distributor_wallet_transaction";
$col = "id";
$opt = 'status = ?';
$arr = array(2);
$count_success = $db->advwhere($col, $table, $opt, $arr);
$count_success = count($count_success);

$table = "distributor_wallet_transaction";
$col = "id";
$opt = 'status = ?';
$arr = array(3);
$count_reject = $db->advwhere($col, $table, $opt, $arr);
$count_reject = count($count_reject);

?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>

    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
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

                <div class="ibox-content" style="background-color: #f8d7da; border-color: #f8d7da;">

                    <div class="form-group" id="data_5">
                        <label class="font-bold">Reporting Management</label>
                        <form role="form" id="form_get_order" method="post">

                            <div class="input-daterange input-group" id="datepicker">
                                <span class="input-group-addon">&nbsp; Date From &nbsp;</span>
                                <input type="text" class="form-control-sm form-control" placeholder="Please Select Date Period" name="min" id="min" value="" />
                                <span class="input-group-addon">&nbsp;&nbsp; Date To &nbsp;</span>
                                <input type="text" class="form-control-sm form-control" placeholder="Please Select Date Period" name="max" id="max" value="" />
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
                            window.open("report.php?from=" + from.value + "&to=" + to.value, '_blank');
                        }
                    </script>

                </div>
                <br>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-4">
                                    <a data-toggle="modal" data-target="#gst_value_edit" style="color:white;"><i class="fa fa-cog fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <strong><span> GST Value % </span></strong>
                                    <h2 class="font-bold"><?php echo $gst_value; ?> %</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-4">
                                    <a data-toggle="modal" data-target="#point_value_edit" style="color:white;"><i class="fa fa-cog fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <strong><span> Reward Point Value (per) </span></strong>
                                    <h2 class="font-bold"><?php echo $point_value; ?> Sen</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-4">
                                    <a data-toggle="modal" data-target="#coupon_email_edit" style="color:white;"><i class="fa fa-cog fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <strong><span> Coupon for new user <?php echo $coupon_code; ?></span></strong>
                                    <h2 class="font-bold"><?php echo $coupon_name; ?> </h2>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <div class="col-4">
                                    <a href="coupon.php" style="color:white;"><i class="fa fa-ticket fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Coupon </span>
                                    <h2 class="font-bold"><?php echo $count_coupon; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <div class="col-4">
                                    <a href="promotion.php" style="color:white;"><i class="fa fa-money fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Promotion </span>
                                    <h2 class="font-bold"><?php echo $count_promotion; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="widget style1 blue-bg">
                            <div class="row">
                                <div class="col-4">
                                    <a href="stock.php" style="color:white;"><i class="fa fa-exclamation-circle fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Replenish Stock (less than 10)</span>
                                    <h2 class="font-bold"><?php echo $count_stock; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <a href="user.php">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Normal User</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo $count_user; ?></h1>
                                    <small>Total</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="distributor.php">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Distributor</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo $count_distributor; ?></h1>
                                    <small>Total</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="dealer.php">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Dealer</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo $count_dealer; ?></h1>
                                    <small>Total</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <a href="refund.php?page=1">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Refund Pending</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo $count_refund_pending; ?></h1>
                                    <small>Total</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="refund.php?page=2">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Refund Success</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo $count_success; ?></h1>
                                    <small>Total</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <a href="refund.php?page=3">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Refund Rejected</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo $count_reject; ?></h1>
                                    <small>Total</small>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-3">
                        <a href="order.php?page=2">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Order Pending</h5>
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
                                    <h5>Order Shipping</h5>
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
                                    <h5>Order Complete</h5>
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
                                    <h5>Order Canceled/Rejected</h5>
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

            <!-- <div class="ibox-content" style="background-color: #f8d7da; border-color: #f8d7da;">

                <div class="form-group" id="data_5">
                    <label class="font-bold">Date From to Date To </label>
                    <form role="form" id="form_get_order" method="post">

                        <div class="input-daterange input-group" id="datepicker">
                            <span class="input-group-addon">to</span>
                            <input type="text" class="form-control-sm form-control" name="min" id="min" value="" />
                            <span class="input-group-addon">to</span>
                            <input type="text" class="form-control-sm form-control" name="max" id="max" value="" />
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
                        window.open("report.php?from=" + from.value + "&to=" + to.value, '_blank');
                    }
                </script>

            </div> -->

        </div>
    </div>
    <div class="modal inmodal" id="point_value_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <form role="form" id="form_point" action="admin_sql.php?type=point_value_edit&tb=admin" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Edit Point Value</h4>
                    </div>
                    <div class="modal-body text-center">

                        <h4><strong>Enter Point Value ( 1 point to (?) sen )</strong></h4>
                        <div class="form-group"><label>Point Value</label> <input type="number" placeholder="Enter Point Value" class="form-control" name="point_value" value="<?php echo $point_value; ?>" required></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary  btn-lg-dim" value="<?php echo $result_point_value[0]['id'] ?>" name="btnAction">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="gst_value_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <form role="form" id="form_gst" action="admin_sql.php?type=gst_value_edit&tb=admin" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Edit GST Value</h4>
                    </div>
                    <div class="modal-body text-center">

                        <h4><strong>Enter GST Value ( % )</strong></h4>
                        <div class="form-group"><label>GST Value</label> <input type="number" placeholder="Enter Point Value" class="form-control" name="gst_value" value="<?php echo $result_gst_value[0]['value']; ?>" required></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary  btn-lg-dim" value="<?php echo $result_gst_value[0]['id'] ?>" name="btnAction">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal inmodal" id="coupon_email_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <form role="form" id="form_coupon_email" action="admin_sql.php?type=coupon_email_edit&tb=admin" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Coupon For New User</h4>
                    </div>
                    <div class="modal-body text-center">

                        <div class="form-group">
                            <label class="font-normal">Select Coupon For New User<span class="text-danger"></span></label>
                            <div>
                                <select class="chosen-select" name="coupon_email" tabindex="2">

                                    <option data-option="" value="">Select Coupon</option>
                                    <?php

                                    $tb = "coupon left join coupon_translation on coupon.id = coupon_translation.coupon_id";
                                    $col = "coupon.id as id, coupon.code as code, coupon_translation.name as name";
                                    $opt = 'status = ? && coupon_translation.language = ?';
                                    $arr = array(1, "en");
                                    $result = $db->advwhere($col, $tb, $opt, $arr);
                                    foreach ($result as $coupon) {
                                    ?>
                                        <option value="<?php echo $coupon['id']; ?>" <?php echo ($coupon_id == $coupon['id']) ? "selected" : "" ?>><?php echo $coupon['name'] . " - " . $coupon['code']; ?></option>

                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary  btn-lg-dim" value="<?php echo $result_point_value[0]['id'] ?>" name="btnAction">Confirm</button>
                    </div>
                </form>
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
    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $('.chosen-select').chosen({
            width: "100%"
        });
        $.validator.setDefaults({
            ignore: ":hidden:not(.chosen-select)"
        }) //for all select having class .chosen-select

        $(document).ready(function() {
            $("#form_coupon_email").validate({
                rules: {
                    coupon: {
                        required: true,
                    },
                }
            });

        });
    </script>
</body>

</html>