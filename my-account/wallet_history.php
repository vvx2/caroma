<?php
require_once('inc/init.php');
$PageName = "wallet_history";
if ($login != 1) {
    echo "<script>window.location.replace('../login.php')</script>";
    exit();
}
if ($user_type != 2) {
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
                        <h5 class="txt-light"><?php echo $lang['lang-transcation_history']; ?></h5>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <div class="panel panel-default card-view pa-0">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body pa-0">
                                    <div class="sm-data-box bg-green">
                                        <div class="row ma-0">
                                            <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                                <i class="icon-briefcase txt-light"></i>
                                            </div>
                                            <div class="col-xs-7 text-center data-wrap-right">
                                                <h5 class="txt-light">RM</h5>
                                                <span class="txt-light counter counter-anim">
                                                    <?php
                                                    $col = "*";
                                                    $tb = "user_distributor";
                                                    $opt = 'user_id = ?';
                                                    $arr = array($user_id);
                                                    $distributor = $db->advwhere($col, $tb, $opt, $arr);
                                                    echo number_format($distributor[0]['distributor_wallet'], 2);
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Row -->

                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-heading">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark"><?php echo $lang['lang-wallet_transcation_history']; ?></h6>
                                </div>
                                <div class="pull-right">
                                    <h6 class="panel-title txt-light">
                                        <i data-remote="ajax/distributor_refund.php" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success"><strong><?php echo $lang['lang-withdrawal_request']; ?></strong></i>
                                    </h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <p class="text-muted"><?php echo $lang['lang-ple_check_your_wallet']; ?></p>
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
                                                                                    <th><?php echo $lang['lang-name']; ?></th>
                                                                                    <th><?php echo $lang['lang-amount']; ?></th>
                                                                                    <th><?php echo $lang['lang-transcation_description']; ?></th>
                                                                                    <th><?php echo $lang['lang-balance']; ?></th>
                                                                                    <th><?php echo $lang['lang-date_time']; ?></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tfoot>
                                                                                <tr>
                                                                                    <th>#</th>
                                                                                    <th><?php echo $lang['lang-name']; ?></th>
                                                                                    <th><?php echo $lang['lang-amount']; ?></th>
                                                                                    <th><?php echo $lang['lang-transcation_description']; ?></th>
                                                                                    <th><?php echo $lang['lang-balance']; ?></th>
                                                                                    <th><?php echo $lang['lang-date_time']; ?></th>
                                                                                </tr>
                                                                            </tfoot>
                                                                            <tbody>
                                                                                <?php

                                                                                $i = 1;
                                                                                $col = "d.*, u.name as user_name";
                                                                                $tb = "distributor_wallet_transaction_history d left join users u on d.distributor_id = u.id";
                                                                                $opt = 'distributor_id = ? ORDER BY date_modified';
                                                                                $arr = array($user_id);
                                                                                $distributor_wallet_history = $db->advwhere($col, $tb, $opt, $arr);
                                                                                foreach ($distributor_wallet_history as $wallet) {

                                                                                    $amount = number_format($wallet['amount'], 2);
                                                                                    $desc = $wallet['description'];

                                                                                    if ($amount >= 0) {
                                                                                        $text_color = "text-success";
                                                                                    } else {
                                                                                        $text_color = "text-danger";
                                                                                    }
                                                                                ?>

                                                                                    <tr>
                                                                                        <td><?php echo $i; ?></td>
                                                                                        <td><?php echo $wallet['user_name']; ?></td>
                                                                                        <td class="<?php echo $text_color; ?>"><strong><?php echo $amount; ?></strong></td>
                                                                                        <td><?php echo $desc; ?></td>
                                                                                        <td><strong><?php echo $wallet['current_amount']; ?></strong></td>
                                                                                        <td><?php echo $wallet['date_modified']; ?></td>
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

    <!-- Vector Maps JavaScript -->
    <script src="vendors/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/vectormap-data.js"></script>

    <!-- Calender JavaScripts -->
    <script src="vendors/bower_components/moment/min/moment.min.js"></script>
    <script src="vendors/jquery-ui.min.js"></script>
    <script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="dist/js/fullcalendar-data.js"></script>

    <!-- Progressbar Animation JavaScript -->
    <script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="vendors/bower_components/Counter-Up/jquery.counterup.min.js"></script>

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

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Sparkline JavaScript -->
    <script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

    <script src="vendors/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
    <script src="dist/js/skills-counter-data.js"></script>

    <script src="vendors/bower_components/bootstrap-validator/dist/validator.min.js"></script>


    <!-- Morris Charts JavaScript -->
    <script src="vendors/bower_components/raphael/raphael.min.js"></script>
    <script src="vendors/bower_components/morris.js/morris.min.js"></script>
    <script src="dist/js/morris-data.js"></script>

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