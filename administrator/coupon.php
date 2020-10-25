<?php
require_once('inc/init.php');
$PageName = "coupon";
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
    <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
    <link href="css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
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
                <div class="col-lg-12" style="padding-left:0px ; padding-right :0px ; padding-bottom : 20px">
                    <div class="row">

                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3 text-center product_btns">
                            <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_coupon"> &nbsp;Add Coupon</a>

                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------- -->
                <!--            Modal To Add coupon             -->
                <!-- ------------------------------------------- -->
                <div class="modal inmodal" id="add_coupon" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content animated fadeIn">
                            <form role="form" id="form_coupon" action="coupon_generate.php?type=coupon_generate&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                    <h4 class="modal-title">Add Coupon</h4>
                                </div>
                                <div class="modal-body">


                                    <div class="form-group"><label>Name(English)</label> <input type="text" placeholder="Enter Coupon Name (English)" class="form-control" name="name_en" value=''></div>
                                    <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_en" rows="4"></textarea>
                                    </div>

                                    <div class="form-group"><label>Name(Chinese)</label> <input type="text" placeholder="Enter Coupon Name (Chinese)" class="form-control" name="name_cn" value=''></div>
                                    <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description " class="form-control" name="desc_cn" rows="4"></textarea>
                                    </div>

                                    <div class="form-group"><label>Name(Malay)</label> <input type="text" placeholder="Enter Coupon Name (Malay)" class="form-control" name="name_my" value=''></div>
                                    <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_my" rows="4"></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group" id="date">
                                        <label class="font-normal">Date Range select</label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control-sm form-control" name="start" value="" />
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="form-control-sm form-control" name="end" value="" />
                                        </div>
                                    </div>
                                    <hr>
                                    <label class="font-normal">Coupon Type</label>
                                    <div class="radio">
                                        <input type="radio" name="coupon_type" id="coupon_type_1" value="1" checked="">
                                        <label for="coupon_type_1">
                                            Amount
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="coupon_type" id="coupon_type_2" value="2">
                                        <label for="coupon_type_2">
                                            Percentange
                                        </label>
                                    </div>

                                    <div class="form-group">
                                        <label class="font-normal">Amount Discount</label>
                                        <input class="amount" type="text" value="0" name="amount">

                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Percentage Discount</label>
                                        <input class="percentage" type="text" value="0" name="percentage">

                                    </div>
                                    <hr>

                                    <div class="form-group">
                                        <label class="font-normal">Minimum Spend</label>
                                        <input class="min_spend" type="text" value="0" name="min_spend">

                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Discount Capped - <span class="text-success">Maximum amount to discount (When type is percentage, leave it 0 if type = Amount)</span></label>
                                        <input class="dis_capped" type="text" value="0" name="dis_capped">

                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="font-normal">User per coupon - <span class="text-danger">How many coupons users can hold</span></label>
                                        <input class="user_per_coupon" type="text" value="0" name="user_per_coupon">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Usage limit per coupon code use - <span class="text-danger">How many times can the coupon be used</span></label>
                                        <input class="usage_limit" type="text" value="0" name="usage_limit">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Total Usage limit with this coupon - <span class="text-danger">Total how many times can the coupon be used</span></label>
                                        <input class="total_usage_limit" type="text" value="0" name="total_usage_limit">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="font-normal">Number of coupon to generate</label>
                                        <input class="coupon_generate" type="text" value="0" name="coupon_generate">

                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Product Available for this coupon - <span class="text-success">Only available when the product in cart</span></label>
                                        <select class="form-control dual_select " name="product[]" multiple required>
                                            <?php

                                            $tb = "product left join product_translation on product.id = product_translation.product_id";
                                            $col = "product.id as id, product_translation.name as name";
                                            $opt = 'status = ? && product_translation.language = ?';
                                            $arr = array(1, "en");
                                            $result = $db->advwhere($col, $tb, $opt, $arr);
                                            foreach ($result as $product) {
                                            ?>
                                                <option value="<?php echo $product['id']; ?>"><?php echo $product['name']; ?></option>


                                            <?php
                                            } ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnAction"><strong>Confirm</strong></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- ------------------------------------------- -->
                <!--           /Modal To Add coupon             -->
                <!-- ------------------------------------------- -->

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Coupon</h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Total usage limit</th>
                                        <th>Total times used</th>
                                        <th>Coupon Generated</th>
                                        <th>Status</th>
                                        <th width=20%></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $col = "*";
                                    $tb = "coupon";
                                    $opt = 'id != ? ORDER BY date_modified DESC';
                                    $arr = array(0);
                                    $result = $db->advwhere($col, $tb, $opt, $arr);
                                    foreach ($result as $coupon) {
                                        $status = $coupon["status"];

                                        if ($status == 1) {
                                            $status_display = "Activate";
                                            $status_color = "text-success";
                                        } else {
                                            $status_display = "Deactivate";
                                            $status_color = "text-danger";
                                        }

                                        $btn_edit = '<a data-remote="ajax/coupon_edit.php?p=' . $coupon["id"] . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                        $btn_generate = '<a data-remote="ajax/coupon_generate_new.php?p=' . $coupon["id"] . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Generate more Coupon</a>';
                                        $btn_delete = '<a data-remote="ajax/delete_data.php?p=' . $coupon["id"] . '&table=coupon&page=coupon" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';
                                        $btn_view_code = '<a href="coupon_code.php?coupon=' . $coupon["id"] . '" target="blank" class="btn btn-white btn-xs">View Code</a>';

                                        $btn_action = $btn_edit . $btn_delete . $btn_generate . $btn_view_code;
                                        //-------------------------------
                                        //  get coupon details
                                        //-------------------------------
                                        $col = "*";
                                        $tb = "coupon_translation";
                                        $opt = 'coupon_id = ? && language = ?';
                                        $arr = array($coupon["id"], "en");
                                        $result_coupon_detail = $db->advwhere($col, $tb, $opt, $arr);
                                        $result_coupon_detail = $result_coupon_detail[0];

                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $result_coupon_detail["name"]; ?></td>
                                            <td><?php echo $coupon["total_usage_limit"]; ?></td>
                                            <td><?php echo $coupon["total_times_used"]; ?></td>
                                            <td><?php echo $coupon["coupon_qty"]; ?></td>
                                            <td class="<?php echo $status_color; ?>"><?php echo $status_display; ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php echo $btn_action; ?>
                                                </div>
                                            </td>


                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
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

    <!-- TouchSpin -->
    <script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Dual Listbox -->
    <script src="js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        //this script for modal 
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
        });

        $.validator.setDefaults({
            ignore: ":hidden:not(.dual_select)"
        }) //for all select having class .dual_select
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

            $("#form_coupon").validate({
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
                    coupon_desc_en: {
                        required: true,

                    },
                    coupon_desc_cn: {
                        required: true,

                    },
                    coupon_desc_my: {
                        required: true,

                    },
                    start: {
                        required: true,

                    },
                    end: {
                        required: true,

                    },
                    amount: {
                        required: true,
                        min: 0

                    },
                    percentage: {
                        required: true,
                        min: 0
                    },
                    min_spend: {
                        required: true,
                        min: 0
                    },
                    dis_capped: {
                        required: true,
                        min: 0
                    },
                    usage_limit: {
                        required: true,
                        min: 1
                    },
                    total_usage_limit: {
                        required: true,
                        min: 0
                    },
                    coupon_generate: {
                        required: true,
                        min: 1
                    },
                    user_per_coupon: {
                        required: true,
                        min: 1
                    }

                }
            });

            $('#date .input-daterange').datepicker({
                format: 'yyyy-mm-dd',
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

            $(".amount").TouchSpin({
                min: 0,
                max: 9999999,
                decimals: 2,
                postfix: 'RM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".percentage").TouchSpin({
                min: 0,
                max: 100,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".min_spend").TouchSpin({
                min: 0,
                max: 9999999,
                decimals: 2,
                postfix: 'RM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".dis_capped").TouchSpin({
                min: 0,
                max: 9999999,
                decimals: 2,
                postfix: 'RM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".user_per_coupon").TouchSpin({
                min: 1,
                max: 9999999,
                postfix: 'User per coupon',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".usage_limit").TouchSpin({
                min: 1,
                max: 9999999,
                postfix: 'Times',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".total_usage_limit").TouchSpin({
                min: 1,
                max: 9999999,
                postfix: 'Times',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

            $(".coupon_generate").TouchSpin({
                min: 1,
                max: 9999999,
                postfix: 'Coupon Generate',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });


            $('.dual_select').bootstrapDualListbox({
                selectorMinimalHeight: 160
            });


        });
    </script>


</body>

</html>