<?php
include_once('../../administrator/connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];

$col = "o.*, o.id as order_id, st.name as state_name";
$tb = "orders o left join state st on o.customer_state = st.id";
$opt = 'o.id = ?';
$arr = array($id);
$order = $db->advwhere($col, $tb, $opt, $arr);
$order = $order[0];

$status = $order['status'];
$payment_type = $order['payment_type'];

if ($payment_type == 1) {
    $payment_display = "Online Payment";
} else {
    $payment_display = "Cash";
}

switch ($status) {
    case "1":
        $status_color = "bg-red";
        $status_show = "Failed / Canceled";
        $status_desc = "This order was rejected, or your order payment was failed.";
        break;
    case "2":
        $status_color = "bg-yellow";
        $status_show = "Pending";
        $status_desc = "Waiting for the Caroma Malaysia to ship out the products.";
        break;
    case "3":
        $status_color = "bg-success";
        $status_show = "Shipping";
        $status_desc = "This order had been shipped.";
        break;
    case "4":
        $status_color = "bg-green";
        $status_show = "Completed";
        $status_desc = "The order was delivered.";
        break;
    case "5":
        $status_color = "bg-black";
        $status_show = "To Cancel";
        $status_desc = "The order is pending to cancel. ";
        break;
    default:
        $status_color = "";
        $status_show = "";
        $status_desc = "";
}


?>
<!-- get from here -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 class="modal-title" id="myLargeModalLabel">Order Details</h5>
</div>
<div class="modal-body">
    <div class="panel-wrapper collapse in">
        <div class="panel-body no-padding">
            <blockquote class="<?php echo $status_color; ?>">
                <table class="table-widths">
                    <tr>
                        <th class="spacing-titles"><i class="fa fa-cube"></i></th>
                        <th class="spacing-titles1"><?php echo $status_show; ?><br><span><?php echo $status_desc; ?><span></th>
                    </tr>
                </table>
            </blockquote>
            <?php if ($status == 1 || $status == 5) { ?>
                <blockquote class="bg-warning">
                    <table class="table-widths">
                        <tr>
                            <th class="spacing-titles"><i class="fa fa-info-circle"></i></th>
                            <th class="spacing-titles1">Reason
                                <?php
                                if ($order["proof_image"] != NULL || $order["proof_image"] != "") {
                                ?>
                                    - <a href="../img/refund/<?php echo $order['proof_image']; ?>" target="_blank" style="color:blue;">Proof</a>
                                    <- click for view <?php
                                                    }
                                                        ?> <br><span><?php echo $order['reason']; ?><span>
                            </th>
                        </tr>
                    </table>
                </blockquote>
            <?php } ?>
            <blockquote>
                <table class="table-widths">
                    <tr>
                        <th class="spacing-titles"><i class="fa fa-map-marker"></i></th>
                        <th class="spacing-titles1">Delivery Address<br><span><?php echo $order['customer_name']; ?><br><?php echo $order['customer_contact']; ?><br><?php echo $order['customer_address']; ?>, <?php echo $order['customer_postcode']; ?>, <?php echo $order['customer_city']; ?>, <?php echo $order['state_name']; ?>.<br><span></th>
                    </tr>
                </table>
            </blockquote>
            <blockquote>
                <table class="table-widths">
                    <tr>
                        <th class="spacing-titles"><i class="fa fa-truck"></i></th>
                        <th class="spacing-titles1">Shipping Information<br>
                            <?php
                            if ($order['delivery_type'] == 1) {
                            ?>
                                <span>Citylink: <?php echo ($order['consignment_number'] == "") ? "-" : $order['consignment_number'];; ?><span>
                                        <br><a style="color : #1a0dab" class="a-links" target="_blank" href="https://www.tracking.my/">Check Now</a>
                                    <?php
                                } else {
                                    ?>
                                        <span>
                                            Self Taking
                                        </span>
                                    <?php
                                }
                                    ?>
                        </th>
                    </tr>
                </table>

            </blockquote>
            <blockquote>
                <table class="table-widths">
                    <tr>
                        <th class="spacing-titles"><i class="fa fa-info-circle"></i></th>
                        <th class="spacing-titles1">Order ID<br><span><?php echo $order['gateway_order_id']; ?><span></th>
                    </tr>
                </table>
            </blockquote>

            <blockquote>
                <table class="table-widths">
                    <tr>
                        <th class="spacing-titles"><i class="fa fa-money"></i></th>
                        <th class="spacing-titles1">Payment Method<br><span><?php echo $payment_display; ?><span></th>
                    </tr>
                </table>
            </blockquote>


            <blockquote>
                <?php

                $table = "order_items o left join product p on o.product_id = p.id left join product_translation pt on o.product_id = pt.product_id";
                $col = "o.id as id, o.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, o.price as price";
                $opt = 'o.order_id = ? AND pt.language = ? ';
                $arr = array($id, $_SESSION['language']);
                $order_item = $db->advwhere($col, $table, $opt, $arr);

                foreach ($order_item as $item) {

                ?>

                    <div class="table-mxsp">
                        <a href="../products-detail.php?p=<?php echo $item['p_id'] ?>" target="_blank">
                            <table class="table-widths">
                                <tr>
                                    <td class="product-imgsx" rowspan="3">
                                        <image width="100px" height="100px" src="../img/product/<?php echo $item['image']; ?>">
                                    </td>
                                    <td class="product-detailsx title-bold"><?php echo $item['name']; ?></td>
                                </tr>
                                <tr>
                                    <td class="product-detailsx">x<?php echo $item['qty']; ?></td>
                                </tr>
                                <tr>
                                    <td class="product-detailsx">RM <?php echo number_format($item["price"], 2); ?></td>
                                </tr>
                            </table>
                        </a>
                    </div>

                <?php } ?>

                <div class="break-lines-klx"></div>

                <div class="table-mxsp">
                    <table class="table-widths">
                        <tr>
                            <td class="total-details-title">Subtotal</td>
                            <td class="total-details-titles">RM <?php echo number_format($order["total_price"], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-details-title">Shipping</td>
                            <td class="total-details-titles">+RM <?php echo number_format($order["shipping_fee"], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-details-title">Coupon</td>
                            <td class="total-details-titles">-RM <?php echo number_format($order["discount_amount"], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-details-title">Caroma Coin</td>
                            <td class="total-details-titles">-RM <?php echo number_format($order["discount_reward"], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-details-title">GST Tax (<?php echo $order["gst_rate"]; ?>%)</td>
                            <td class="total-details-titles">+RM <?php echo number_format($order["gst_fee"], 2); ?></td>
                        </tr>
                        <tr>
                            <td class="total-details-title total-details-title-last">Total</td>
                            <td class="total-details-titles total-details-title-last">RM <?php echo number_format($order["total_payment"], 2); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="break-lines-klx"></div>
                <div class="table-mxsp">
                    <table class="table-widths">
                        <tr>
                            <td class="total-details-title total-details-title-last">Coupon Code</td>
                            <td class="total-details-titles total-details-title-last"><?php echo ($order["coupon_code"] == "") ? "-" : $order["coupon_code"]; ?></td>
                        </tr>
                        <?php
                        if ($_SESSION['type'] == "1") {
                            $user_point = $db->where("point", "user_point", "user_id", $_SESSION['user_id']);
                            if (count($user_point) != 0) {
                                $point = $user_point[0]['point'];
                            } else {
                                $point = 0;
                            }
                        ?>
                            <tr>
                                <td class="total-details-title total-details-title-last">Point Earn</td>
                                <td class="total-details-titles total-details-title-last" style="color:green;"><?php echo $order["reward_point"]; ?> Points</td>
                            </tr>
                            <tr>
                                <td class="total-details-title total-details-title-last">Balance</td>
                                <td class="total-details-titles total-details-title-last" style="color:green;"><?php echo $point; ?> Points</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </blockquote>

        </div>
    </div>
    <p class="disclaration">THE SERVICES ARE PROVIDED "AS IS" AND WITHOUT ANY WARRANTIES, CLAIMS OR REPRESENTATIONS MADE BY CAROMA MALAYSIA OF ANY KIND EITHER EXPRESSED, IMPLIED OR STATUTORY WITH RESPECT TO THE SERVICES, INCLUDING, WITHOUT LIMITATION, WARRANTIES OF QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE, NOR ARE THERE ANY WARRANTIES CREATED BY COURSE OF DEALING, COURSE OF PERFORMANCE OR TRADE USAGE.</p>
</div>
<div class="modal-footer footer-div-table">
    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
</div>