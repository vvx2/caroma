<?php
require_once('inc/init.php');
$PageName = "distributor";

if (isset($_REQUEST['p'])) {
    $distributor_id = $_REQUEST['p'];
} else {
    echo "<script>alert(\"Please select a Distributot\");
	window.location.href='distributor.php';</script>";
    exit();
}

$col = "ud.distributor_wallet as distributor_wallet, u.name as name";
$tb = "user_distributor ud left join users u on ud.user_id = u.id";
$opt = 'user_id = ?';
$arr = array($distributor_id);
$distributor = $db->advwhere($col, $tb, $opt, $arr);

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
                                <h5>WALLET</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins">RM <?php echo number_format($distributor[0]['distributor_wallet'], 2);; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>NAME</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"> <?php echo $distributor[0]['name']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content wrapperes">

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Distributor Refund Transaction History</h5>

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
                            <input type="text" class="form-control form-control-sm m-b-xs" id="filter_wallet" placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="8" data-limit-navigation="5" data-filter=#filter_wallet>
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
                                    $tb = "distributor_wallet_transaction_history";
                                    $opt = 'distributor_id = ? ORDER BY date_modified DESC';
                                    $arr = array($distributor_id);
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
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td class="<?php echo $text_color; ?>"><strong>RM <?php echo $amount; ?></strong></td>
                                            <td><?php echo $desc; ?></td>
                                            <td><strong>RM <?php echo number_format($wallet['current_amount'], 2); ?></strong></td>
                                            <td><?php echo $wallet['date_modified']; ?></td>
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



</body>

</html>