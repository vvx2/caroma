<?php
require_once('inc/init.php');
$PageName = "promotion";
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
                            <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_promotion"> &nbsp;Add Promotion</a>

                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------- -->
                <!--            Modal To Add promotion             -->
                <!-- ------------------------------------------- -->
                <div class="modal inmodal" id="add_promotion" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content animated fadeIn">
                            <form role="form" id="form_promotion" action="promotion_generate.php?type=promotion_generate&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                    <h4 class="modal-title">Add Promotion</h4>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group"><label>Name(English)</label> <input type="text" placeholder="Enter Promotion Name (English)" class="form-control" name="name_en" value=''></div>
                                    <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_en" rows="4"></textarea>
                                    </div>

                                    <div class="form-group"><label>Name(Chinese)</label> <input type="text" placeholder="Enter Promotion Name (Chinese)" class="form-control" name="name_cn" value=''></div>
                                    <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description " class="form-control" name="desc_cn" rows="4"></textarea>
                                    </div>

                                    <div class="form-group"><label>Name(Malay)</label> <input type="text" placeholder="Enter Promotion Name (Malay)" class="form-control" name="name_my" value=''></div>
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
                                    <label class="font-normal">Promotion Type</label>
                                    <div class="radio">
                                        <input type="radio" name="promotion_type" id="promotion_type_1" value="1" checked="">
                                        <label for="promotion_type_1">
                                            Amount
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="promotion_type" id="promotion_type_2" value="2">
                                        <label for="promotion_type_2">
                                            Percentange
                                        </label>
                                    </div>
                                    <hr>

                                    <div class="amount_part">
                                        <div class="form-group">
                                            <label class="font-normal">Amount Discount</label>
                                            <input class="amount" type="text" value="0" name="amount">

                                        </div>
                                    </div>
                                    <div class="percentage_part" style='display:none;'>
                                        <div class="form-group">
                                            <label class="font-normal">Percentage Discount</label>
                                            <input class="percentage" type="text" value="0" name="percentage">

                                        </div>
                                        <div class="form-group">
                                            <label class="font-normal">Discount Capped - <span class="text-success">Maximum amount to discount (When type is percentage, leave it 0 if type = Amount)</span></label>
                                            <input class="dis_capped" type="text" value="0" name="dis_capped">
                                        </div>
                                    </div>


                                    <hr>
                                    <div class="form-group">
                                        <label class="font-normal">Product Available for this promotion - <span class="text-success">Promotion product</span></label>
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
                <!--           /Modal To Add promotion             -->
                <!-- ------------------------------------------- -->

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Promotion</h5>

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
                                        <th>Amount</th>
                                        <th>Percentage</th>
                                        <th>Discount Capped</th>
                                        <th>Status</th>
                                        <th width=20%></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $col = "*";
                                    $tb = "promotion";
                                    $opt = 'id != ? ORDER BY date_modified DESC';
                                    $arr = array(0);
                                    $result = $db->advwhere($col, $tb, $opt, $arr);
                                    foreach ($result as $promotion) {
                                        $status = $promotion["status"];

                                        if ($status == 1) {
                                            $status_display = "Activate";
                                            $status_color = "text-success";
                                        } else {
                                            $status_display = "Deactivate";
                                            $status_color = "text-danger";
                                        }

                                        $btn_edit = '<a data-remote="ajax/promotion_edit.php?p=' . $promotion["id"] . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                        $btn_delete = '<a data-remote="ajax/delete_data.php?p=' . $promotion["id"] . '&table=promotion&page=promotion" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                        $btn_action = $btn_edit . $btn_delete;
                                        //-------------------------------
                                        //  get promotion details
                                        //-------------------------------
                                        $col = "*";
                                        $tb = "promotion_translation";
                                        $opt = 'promotion_id = ? && language = ?';
                                        $arr = array($promotion["id"], "en");
                                        $result_promotion_detail = $db->advwhere($col, $tb, $opt, $arr);
                                        $result_promotion_detail = $result_promotion_detail[0];

                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $result_promotion_detail["name"]; ?></td>
                                            <td><?php echo $promotion["amt"]; ?></td>
                                            <td><?php echo $promotion["percentage"]; ?></td>
                                            <td><?php echo $promotion["capped"]; ?></td>
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

        $('[name="promotion_type"]').change(function() {
            var promotion_type = $('[name="promotion_type"]:checked').val()

            if (promotion_type == 1) {
                $('.amount_part').show();
                $('.percentage_part').hide();
            } else if (promotion_type == 2) {
                $('.amount_part').hide();
                $('.percentage_part').show();
            }
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

            jQuery.validator.addMethod("noSpace", function(value, element) {
                return value.indexOf(" ") < 0 && value != "";
            }, "No space please and don't leave it empty");

            $("#form_promotion").validate({
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
                    promotion_desc_en: {
                        required: true,

                    },
                    promotion_desc_cn: {
                        required: true,

                    },
                    promotion_desc_my: {
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
                    dis_capped: {
                        required: true,
                        min: 0
                    },


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
                step: 0.01,
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

            $(".dis_capped").TouchSpin({
                min: 0,
                max: 9999999,
                step: 0.01,
                decimals: 2,
                postfix: 'RM',
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