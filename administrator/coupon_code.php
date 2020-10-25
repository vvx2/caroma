<?php
require_once('inc/init.php');
$PageName = "coupon";
if (isset($_REQUEST['coupon'])) {
    $coupon_id = $_REQUEST['coupon'];
    //-------------------------------
    //  get coupon details
    //-------------------------------
    $col = "name";
    $tb = "coupon_translation";
    $opt = 'coupon_id = ? && language = ?';
    $arr = array($coupon_id, "en");
    $result_coupon_detail = $db->advwhere($col, $tb, $opt, $arr);
    $result_coupon_detail = $result_coupon_detail[0];
?>
    <!DOCTYPE html>
    <html>

    <head>
        <?php include_once('inc/header.php'); ?>

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

                    <div class="col-lg-12">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Coupon - [ <?php echo $result_coupon_detail["name"]; ?> ]</h5>

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
                                            <th>Coupon Code</th>
                                            <th>Times Used</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $col = "*";
                                        $tb = "coupon_code";
                                        $opt = 'coupon_id = ? ORDER BY date_modified DESC';
                                        $arr = array($coupon_id);
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

                                        ?>
                                            <tr class="gradeX">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $coupon["code"]; ?></td>
                                                <td><?php echo $coupon["times_used"]; ?></td>
                                                <td class="<?php echo $status_color; ?>"><?php echo $status_display; ?></td>
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

        <!-- Page-Level Scripts -->
        <script>
            //this script for modal 
            $('body').on('click', '[data-toggle="modal"]', function() {
                $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
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
            });
        </script>


    </body>

    </html>
<?php
} else {
    echo "<script>
    alert('Please select a Coupon.');
    window.location.href='coupon.php';
    </script>";
}
?>