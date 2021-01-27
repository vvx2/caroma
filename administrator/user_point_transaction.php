<?php
require_once('inc/init.php');
$PageName = "user";

if (isset($_REQUEST['p'])) {
    $user_id = $_REQUEST['p'];
} else {
    echo "<script>alert(\"Please select a User\");
	window.location.href='user.php';</script>";
    exit();
}

$col = "up.point as point, u.name as name";
$tb = "user_point up left join users u on up.user_id = u.id";
$opt = 'user_id = ?';
$arr = array($user_id);
$user_point = $db->advwhere($col, $tb, $opt, $arr);

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
                <div class="row">
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Points</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"><?php echo number_format($user_point[0]['point'], 2); ?> Points</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>NAME</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"> <?php echo $user_point[0]['name']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content wrapperes">

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>User Point Transaction History</h5>

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
                            <input type="text" class="form-control form-control-sm m-b-xs" id="filter_point" placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="8" data-limit-navigation="5" data-filter=#filter_point>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Balance</th>
                                        <th>DateTime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    $col = "*";
                                    $tb = "user_point_transaction_history";
                                    $opt = 'user_id = ? ORDER BY date_modified DESC';
                                    $arr = array($user_id);
                                    $user_point_history = $db->advwhere($col, $tb, $opt, $arr);

                                    foreach ($user_point_history as $point) {
                                        $amount = $point['point'];
                                        $desc = $point['description'];
                                        if ($amount >= 0) {
                                            $text_color = "text-success";
                                        } else {
                                            $text_color = "text-danger";
                                        }
                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td class="<?php echo $text_color; ?>"><strong><?php echo $amount; ?> Points</strong></td>
                                            <td>

                                                <?php
                                                echo $desc;

                                                if (strpos($desc, 'Sale.') !== false) {
                                                    $gateway_order_id = substr($desc, strpos($desc, "Id:") + 4);
                                                    $btn_view_point = '&nbsp <a data-remote="ajax/point_detail.php?p=' . $gateway_order_id . '" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" style="color:white;"><strong>View Point Details</strong></a>';
                                                    echo $btn_view_point;
                                                }
                                                ?>

                                            </td>
                                            <td><strong><?php echo $point['current_point']; ?> point</strong></td>
                                            <td><?php echo $point['date_modified']; ?></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination float-right"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
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
    <script>
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
        });
    </script>


</body>

</html>