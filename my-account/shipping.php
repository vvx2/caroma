<?php
require_once('inc/init.php');
$PageName = "shipping";
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
                        <h5 class="txt-light">Shipping</h5>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark">Your Shipping</h6>
                                </div>
                                <div class="pull-right">
                                    <h6 class="panel-title txt-light">
                                        <i data-remote="ajax/shipping_add.php" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success"><strong>Add Shipping</strong></i>
                                    </h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <p class="text-muted">Please check your<code> Shipping</code> in this list.</p>
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
                                                                                    <th>Status</th>
                                                                                    <th>Title</th>
                                                                                    <th>Geo Zone</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th>Status</th>
                                                                                    <th>Title</th>
                                                                                    <th>Geo Zone</th>
                                                                                    <th>Action</th>
                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>
                                                                                <?php

                                                                                $i = 1;
                                                                                $col = "*,s.id as shipping_id,s.status as shipping_status, s.name as shipping_name, g.name as geo_zone_name";
                                                                                $tb = "shipping s left join geo_zone g on s.geo_zone = g.id";
                                                                                $opt = 's.admin_id = ? ORDER BY s.date_modified';
                                                                                $arr = array($user_id);
                                                                                $shipping = $db->advwhere($col, $tb, $opt, $arr);
                                                                                foreach ($shipping as $shipping) {

                                                                                    $btn_shipping_edit = '<i data-remote="ajax/shipping_edit.php?p=' . $shipping['shipping_id'] . '" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success">Edit</i>';
                                                                                    $btn_shipping_delete = '<i data-remote="ajax/shipping_delete.php?p=' . $shipping['shipping_id'] . '" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-danger">Delete</i>';
                                                                                    $btn_action = $btn_shipping_edit . " " . $btn_shipping_delete;
                                                                                    $name = $shipping['shipping_name'];
                                                                                    $status = $shipping['shipping_status'];
                                                                                    $geo_zone_name = $shipping['geo_zone_name'];

                                                                                    switch ($status) {
                                                                                        case "1":
                                                                                            $status_color = "text-success";
                                                                                            $status_display = "Activate";
                                                                                            break;
                                                                                        case "0":
                                                                                            $status_color = "text-danger";
                                                                                            $status_display = "Deactivate";
                                                                                    }
                                                                                ?>

                                                                                    <tr>
                                                                                        <td><?php echo $i; ?></td>
                                                                                        <td class="<?php echo $status_color; ?>"><strong><?php echo $status_display; ?></strong></td>
                                                                                        <td><?php echo $name; ?></td>
                                                                                        <td><?php echo $geo_zone_name; ?></td>
                                                                                        <td><?php echo $btn_action; ?></td>
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
    </script>

</body>

</html>