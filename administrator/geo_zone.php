<?php
require_once('inc/init.php');
$PageName = "geo_zone";
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
                            <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_geozone"> &nbsp;Add GeoZone</a>

                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------- -->
                <!--            Modal To Add GeoZone             -->
                <!-- ------------------------------------------- -->
                <div class="modal inmodal" id="add_geozone" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content animated fadeIn">
                            <form role="form" id="form_geozone" action="admin_sql.php?type=geo_zone_add&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                    <h4 class="modal-title">Add Geo Zone</h4>
                                </div>
                                <div class="modal-body">


                                    <div class="form-group"><label>Title</label> <input type="text" placeholder="Enter Title" class="form-control" name="name" value='' required></div>

                                    <div class="form-group"><label>Description</label> <input type="text" placeholder="Enter Description" class="form-control" name="description" value='' required></div>
                                    <hr>
                                    <div class="add_product col-12">
                                        <div class="product col-12">
                                            <div class="form-group">
                                                <label class="font-normal">Geo Zone<span class="text-danger"></span></label>
                                                <div>
                                                    <select class="chosen-select" name="zone[]" tabindex="2" required>

                                                        <option data-option="" value="">Select State</option>
                                                        <option data-option="" value="0">All Zones</option>
                                                        <?php
                                                        $col = "*";
                                                        $tb = "state";
                                                        $opt = 'state_status = ? ORDER BY name ASC';
                                                        $arr = array(1);
                                                        $result = $db->advwhere($col, $tb, $opt, $arr);
                                                        foreach ($result as $state) {
                                                        ?>
                                                            <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
                                                        <?php
                                                        } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Add more product -->
                                    <div class="col-sm-12 text-right">
                                        <a class="btn-add-more-product mb-3"></i> Add More Geo Zone</a>
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
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                $col = "*";
                                                $tb = "geo_zone";
                                                $opt = 'admin_id = ? ORDER BY date_modified';
                                                $arr = array(0);
                                                $geo_zone = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($geo_zone as $geo_zone) {

                                                    $name = $geo_zone['name'];
                                                    $description = $geo_zone['description'];
                                                    $geozone_id = $geo_zone['id'];
                                                    $status = $geo_zone['status'];

                                                    if ($status == 1) {
                                                        $status_display = "Activate";
                                                        $status_color = "text-success";
                                                    } else {
                                                        $status_display = "Deactivate";
                                                        $status_color = "text-danger";
                                                    }

                                                    $btn_edit = '<a data-remote="ajax/geo_zone_edit.php?p=' . $geozone_id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                                    $btn_delete = '<a data-remote="ajax/geo_zone_delete.php?p=' . $geozone_id . '&table=product&page=product" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                                    $btn_action = $btn_edit . $btn_delete;


                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><span class="<?php echo $status_color; ?> font-weight-bold"><?php echo $status_display; ?></span></td>
                                                        <td><?php echo $name; ?></td>
                                                        <td><?php echo $description; ?></td>
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
                pageLength: 10,
                responsive: true,
                dom: '<"top"<"clear">>p<"html5buttons"B>lTfgitp',
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

        <?php
        $col = "*";
        $tb = "state";
        $opt = 'state_status = ? ORDER BY name ASC';
        $arr = array(1);
        $result = $db->advwhere($col, $tb, $opt, $arr);
        ?>
        $(document).on('click', '.btn-add-more-product', function() {
            let product_clone =
                '<div class="product col-12">' +
                '   <div class="form-group">' +
                '       <div class="pull-right text-danger btn-remove-product">**Remove**</div>' +
                '       <label class="font-normal">Geo Zone<span class="text-danger"></span></label>' +
                '       <div>' +
                '               <select class="chosen-select" name="zone[]" tabindex="2">' +
                '                 <option data-option="" value="">Select Zones</option>' +
                '                 <option data-option="" value="0">All Zones</option>' +
                <?php foreach ($result as $state) { ?> '                 <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>' +
                <?php } ?> '               </select>' +
                '       </div>' +
                '   </div>' +
                '</div>';


            $(".add_product").append(product_clone);

            $('.chosen-select').chosen({
                width: "100%"
            });
        });

        $(document).on('click', '.btn-remove-product', function() {
            $(this).parent().remove();
        });
    </script>

</body>

</html>