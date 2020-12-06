<?php
require_once('inc/init.php');
$PageName = "shipping";
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
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
                <div class="col-lg-12" style="padding-left:0px ; padding-right :0px ; padding-bottom : 20px">
                    <div class="row">

                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3 text-center product_btns">
                            <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_shipping"> &nbsp;Add Shipping</a>

                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------- -->
                <!--            Modal To Add GeoZone             -->
                <!-- ------------------------------------------- -->
                <div class="modal inmodal" id="add_shipping" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content animated fadeIn">
                            <form role="form" id="form_geozone" action="admin_sql.php?type=shipping_add&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                    <h4 class="modal-title">Add Shipping</h4>
                                </div>
                                <div class="modal-body">


                                    <div class="form-group"><label>Title</label> <input type="text" placeholder="Enter Title" class="form-control" name="name" value='' required></div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="font-normal">Geo Zone<span class="text-danger"></span></label>
                                        <div>
                                            <select class="chosen-select" name="zone" tabindex="2" required>

                                                <option data-option="" value="">Select Geo Zone</option>
                                                <?php
                                                $col = "*";
                                                $tb = " geo_zone ";
                                                $opt = 'admin_id = ? ORDER BY name ASC';
                                                $arr = array(0);
                                                $result = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($result as $zone) {
                                                ?>
                                                    <option value="<?php echo $zone['id']; ?>"><?php echo $zone['name']; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="font-normal">First Weight*</label>
                                        <input class="first_weight" type="text" value="0" name="first_weight" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Price for First Weight*</label>
                                        <input class="first_price" type="text" value="0" name="first_price" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Repeating Next Weight*</label>
                                        <input class="next_weight" type="text" value="0" name="next_weight" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Price for Repeating Next Weight*</label>
                                        <input class="next_price" type="text" value="0" name="next_price" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Additional Fee Charge</label>
                                        <input class="charge" type="number" value="0" name="charge">
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
                <!--           /Modal To Add GeoZone             -->
                <!-- ------------------------------------------- -->

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
                                                    <th>Title</th>
                                                    <th>Geo Zone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                $col = "*,s.id as shipping_id,s.status as shipping_status, s.name as shipping_name, g.name as geo_zone_name";
                                                $tb = "shipping s left join geo_zone g on s.geo_zone = g.id";
                                                $opt = 's.admin_id = ? ORDER BY s.date_modified';
                                                $arr = array(0);
                                                $shipping = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($shipping as $shipping) {

                                                    $name = $shipping['shipping_name'];
                                                    $shipping_id = $shipping['shipping_id'];
                                                    $status = $shipping['shipping_status'];
                                                    $geo_zone_name = $shipping['geo_zone_name'];

                                                    if ($status == 1) {
                                                        $status_display = "Activate";
                                                        $status_color = "text-success";
                                                    } else {
                                                        $status_display = "Deactivate";
                                                        $status_color = "text-danger";
                                                    }

                                                    $btn_edit = '<a data-remote="ajax/shipping_edit.php?p=' . $shipping_id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                                    $btn_delete = '<a data-remote="ajax/shipping_delete.php?p=' . $shipping_id . '&table=product&page=product" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                                    $btn_action = $btn_edit . $btn_delete;


                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><span class="<?php echo $status_color; ?> font-weight-bold"><?php echo $status_display; ?></span></td>
                                                        <td><?php echo $name; ?></td>
                                                        <td><?php echo $geo_zone_name; ?></td>
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
    <!-- TouchSpin -->
    <script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

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

            $(".first_weight").TouchSpin({
                min: 0.001,
                max: 9999999,
                step: 0.001,
                decimals: 3,
                postfix: 'KG',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            $(".first_price").TouchSpin({
                min: 0.01,
                max: 9999999,
                step: 0.01,
                decimals: 2,
                postfix: 'RM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            $(".next_weight").TouchSpin({
                min: 0.001,
                max: 9999999,
                step: 0.001,
                decimals: 3,
                postfix: 'KG',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            $(".next_price").TouchSpin({
                min: 0.01,
                max: 9999999,
                step: 0.01,
                decimals: 2,
                postfix: 'RM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            $(".charge").TouchSpin({
                min: 0,
                max: 9999999,
                step: 1,
                postfix: '%',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
        });
    </script>

</body>

</html>