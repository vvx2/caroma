<?php
require_once('inc/init.php');
$PageName = "geo_zone";
if ($login != 1) {
    echo "<script>window.location.replace('../login.php')</script>";
    exit();
}
if($user_type != 2){
	echo "<script>alert(\" Your are not Distributor\");
	window.location.href='index.php';</script>";
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once('inc/head.php'); ?>
</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper">
        <!-- Top Menu Items -->
        <?php require_once('inc/top_nav.php'); ?>
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        <?php require_once('inc/side_bar.php'); ?>

        <!-- /Left Sidebar Menu -->


        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid">

                <!-- Title -->
                <div class="row heading-bg  bg-blue">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-light">Geo Zone</h5>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Your Geo Zone</h6>
                                </div>
                                <div class="pull-right">
                                    <h6 class="panel-title txt-light">
                                        <i data-remote="ajax/geo_zone_add.php" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success"><strong>Add Geo Zone</strong></i>
                                    </h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <p class="text-muted">Please check your<code> Geo Zone</code> in this list.</p>
                                    <div class="pills-struct mt-40">
                                        <ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_11">
                                        </ul>
                                        <div class="tab-content" id="myTabContent_11">
                                            <div id="home_11" class="tab-pane fade active in" role="tabpanel">
                                                <div class="col-sm-12 no-padding">
                                                    <div class="panel panel-default card-view no-padding">
                                                        <div class="panel-heading">
                                                            <div class="pull-left">
                                                                <h6 class="panel-title txt-dark">Export</h6>
                                                            </div>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body">
                                                                <div class="table-wrap">
                                                                    <div class="table-responsive">
                                                                        <table id="example" class="table table-hover display pb-30">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Title</th>
                                                                                    <th>Description</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Title</th>
                                                                                    <th>Description</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>
                                                                                <?php

                                                                                $i = 1;
                                                                                $col = "*";
                                                                                $tb = "geo_zone";
                                                                                $opt = 'admin_id = ? ORDER BY date_modified';
                                                                                $arr = array($user_id);
                                                                                $geo_zone = $db->advwhere($col, $tb, $opt, $arr);
                                                                                foreach ($geo_zone as $geo_zone) {

                                                                                    $btn_geo_zone_edit = '<i data-remote="ajax/geo_zone_edit.php?p=' . $geo_zone['id'] . '" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success">Edit</i>';
                                                                                    $btn_action = $btn_geo_zone_edit;
                                                                                    $name = $geo_zone['name'];
                                                                                    $description = $geo_zone['description'];
                                                                                ?>

                                                                                    <tr>
                                                                                        <td><?php echo $i; ?></td>
                                                                                        <td><?php echo $name; ?></td>
                                                                                        <td><?php echo $description; ?></td>
                                                                                        <td><?php echo $btn_action; ?></td>
                                                                                    </tr>
                                                                                <?php $i++;} ?>
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
                        </div>
                    </div>
                </div>

            </div>
            <!-- Footer -->
            <footer class="footer container-fluid pl-30 pr-30">
                <?php require_once('inc/footer.php'); ?>
            </footer>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->

    </div>
    <!-- /#wrapper -->

    <!-- /Main Content -->

    <!-- sample modal content -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Calender JavaScripts -->
    <script src="vendors/bower_components/moment/min/moment.min.js"></script>
    <script src="vendors/jquery-ui.min.js"></script>
    <script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="dist/js/fullcalendar-data.js"></script>

    <!-- Data table JavaScript -->
    <script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/bower_components/jszip/dist/jszip.min.js"></script>
    <script src="vendors/bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/bower_components/pdfmake/build/vfs_fonts.js"></script>

    <script src="vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="dist/js/export-table-data.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>
    <script src="dist/js/widgets-data.js"></script>

    <script>
        //this script for modal 
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
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
                '<blockquote><div class="pull-right text-danger btn-remove-product">**Remove**</div>' +
                '   <table class="table-widths">' +
                '       <div class="row">' +
                '           <div class="col-sm-12 col-12">' +
                '               <label class="control-label mb-10">Geo Zone</label>' +
                '               <select class="input-width state_select form-control" name="zone[]" tabindex="2" required>' +
                '                 <option data-option="" value="">Select Zones</option>' +
                '                 <option data-option="" value="0">All Zones</option>' +
                <?php foreach ($result as $state) { ?> '                 <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>' +
                <?php } ?> '               </select>' +
                '               <div class="help-block with-errors"></div>' +
                '           </div>' +
                '       </div>' +
                '   </table>' +
                '</blockquote>' +
                '</div>';


            $(".add_product").append(product_clone);
        });

        $(document).on('click', '.btn-remove-product', function() {
            $(this).parent().remove();
        });
    </script>

</body>

</html>