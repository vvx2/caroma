<?php
include_once('inc/init.php');
$PageName = "index";

$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

if (isset($_REQUEST['from'])) {
    $from = $_REQUEST['from'];
} else {
    echo "<script>alert(\" No Date From. Please select your date. Thank You.\");
               window.location.href='index.php';</script>";
    exit();
}

if (isset($_REQUEST['to'])) {
    $to = $_REQUEST['to'];
} else {
    echo "<script>alert(\" No Date To. Please select your date. Thank You.\");
               window.location.href='index.php';</script>";
    exit();
}

if (isset($_REQUEST['status'])) {
    $status = $_REQUEST['status'];
} else {
    $status = 4;
}

if ($to == '' || $to == NULL) {
    $to = date('Y-m-d H:i:s');
}
$from = strtotime($from);
$from_display = date('Y-m-d', $from);
$from = date('Y-m-d H:i:s', $from);

$to = strtotime($to);
$to_display = date('Y-m-d', $to);
$to = date('Y-m-d H:i:s', $to);

$admin_id = 0;

switch ($status) {
    case "1":
        $status_summary_display = "Failed / Canceled";
        break;
    case "2":
        $status_summary_display = "To Ship";
        break;
    case "3":
        $status_summary_display = "Shipping";
        break;
    case "4":
        $status_summary_display = "Completed";
        break;
    case "5":
        $status_summary_display = "To Cancel";
}
?>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
</head>

<body class="white-bg">
    <div class="ibox-content p-xl">


        <?php
        $col = 'SUM(total_payment) as total_payment, SUM(total_price) as total_price, SUM(discount_amount) as discount_amount, SUM(discount_reward) as discount_reward, SUM(shipping_fee) as shipping_fee';
        $tb = ' orders';
        $opt = 'date_modified >= ? AND DATE_ADD(date_modified, INTERVAL -1 DAY) <= ? AND status = ? AND admin_id = ?';
        $arr = array($from, $to, $status, $admin_id);
        $get_result_payment = $db->advwhere($col, $tb, $opt, $arr);
        if ($get_result_payment[0]['total_payment'] == NULL) {
            $total_payment = 0;
            $total_price = 0;
            $total_shipping = 0;
            $total_discount = 0;
            $total_point_discount = 0;
        } else {
            $total_payment = $get_result_payment[0]['total_payment'];
            $total_price = $get_result_payment[0]['total_price'];
            $total_shipping = $get_result_payment[0]['shipping_fee'];
            $total_discount = $get_result_payment[0]['discount_amount'];
            $total_point_discount = $get_result_payment[0]['discount_reward'];
        }


        $col = 'SUM(oi.qty) as total_item';
        $tb = 'order_items oi left join orders o on oi.order_id = o.id';
        $opt = 'o.date_modified >= ? AND DATE_ADD(o.date_modified, INTERVAL -1 DAY) <= ? AND o.status = ? AND o.admin_id = ?';
        $arr = array($from, $to, 4, 0);
        $result = $db->advwhere($col, $tb, $opt, $arr);

        if ($result[0]['total_item'] == NULL) {
            $total_item = 0;
        } else {
            $total_item = $result[0]['total_item'];
        }
        // var_dump($result);

        ?>

        <div class="ibox-content">
            <div class="col-lg-12">
                <div class="contact-box ">

                    <h2 class="m-b-xs">
                        <strong>Order <?php echo $status_summary_display; ?>:</strong>
                        <h3>Order Ranged
                            <?php
                            echo '  from: ' . $from_display;
                            echo ' to: ' . $to_display;
                            ?>
                        </h3>
                    </h2>
                    <br>
                    <table class="table">

                        <thead>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Total Order Price</td>
                                <td>RM <?php echo number_format($total_price, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Total Discount Price</td>
                                <td>-RM <?php echo number_format($total_discount, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Total Point Discount</td>
                                <td>-RM <?php echo number_format($total_point_discount, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Total Shipping</td>
                                <td>RM <?php echo number_format($total_shipping, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Total Order Payment (Counted Shipping & Discount)</td>
                                <td>RM <?php echo number_format($total_payment, 2); ?></td>
                            </tr>
                            <tr>
                                <td>Total Item Quantity</td>
                                <td><?php echo $total_item; ?></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>

                    </table>

                    <div class="table-responsive m-t">
                        <table class="table invoice-table">
                            <thead>
                                <tr>
                                    <th>Item List</th>
                                    <th>Quantity</th>
                                    <th>Sales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $col = "SUM(oi.qty) as product_qty, SUM(oi.price * oi.qty) as product_price, pt.name as product_name";
                                $tb = 'order_items oi left join orders o on oi.order_id = o.id left join product_translation pt on pt.product_id = oi.product_id';
                                $opt = 'o.admin_id = ? AND o.date_modified >= ? AND DATE_ADD(o.date_modified, INTERVAL -1 DAY) <= ? AND o.status = ? AND pt.language = ? AND o.admin_id = 0 GROUP BY pt.name ORDER BY pt.name ASC';
                                $arr = array($admin_id, $from, $to, $status, "en");
                                $result_item = $db->advwhere($col, $tb, $opt, $arr);
                                foreach ($result_item as $row) {
                                ?>
                                    <tr>
                                        <td>
                                            <div><strong><?php echo $row["product_name"]; ?></strong></div>
                                        </td>
                                        <td><?php echo $row["product_qty"]; ?></td>
                                        <td>RM <?php echo number_format($row["product_price"], 2); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <!-- Mainly scripts -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script type="text/javascript">
            window.print();
        </script>

</body>

</html>