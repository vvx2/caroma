<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();
$id = $_REQUEST['p'];

$col = "o.*, o.id as order_id, st.name as state_name, u.name as user_name, o.reason as reason";
$tb = "orders o left join state st on o.customer_state = st.id left join users u on u.id = o.users_id";
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
        $status_show = "To Ship";
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
        $status_desc = "The order is pending to cancel. You have to refund back the money or Contact your client";
        break;
    default:
        $status_color = "";
        $status_show = "";
        $status_desc = "";
}


?>
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title">Order Details</h4>

</div>
<div class="modal-body">


    <div class="ibox-content">
        <div class="col-lg-12">
            <div class="contact-box ">

                <h2 class="m-b-xs"><strong><?php echo $status_show; ?></strong><br><span class=""><?php echo $status_desc; ?><span></h2>


                <br>
                <table class="table">

                    <thead>
                    </thead>

                    <tbody>
                        <?php if ($status == 1 || $status == 5) { ?>
                            <tr>
                                <td>
                                    Cancel Reason
                                    <?php
                                    if ($order["proof_image"] != NULL || $order["proof_image"] != "") {
                                    ?>
                                        - <a href="../img/refund/<?php echo $order['proof_image']; ?>" target="_blank">Proof</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $order["reason"]; ?>
                                </td>
                            </tr>

                        <?php } ?>
                        <tr>
                            <td>Customer Name</td>
                            <td><?php echo $order["customer_name"]; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Email</td>
                            <td><?php echo $order["customer_email"]; ?></td>
                        </tr>
                        <tr>
                            <td>Customer Contact</td>
                            <td><?php echo $order["customer_contact"]; ?></td>
                        </tr>
                        <tr>
                            <td>Delivery Address</td>
                            <td>
                                <span><?php echo $order['customer_address']; ?>, <?php echo $order['customer_postcode']; ?>, <?php echo $order['customer_city']; ?>, <?php echo $order['state_name']; ?>.<br><span>
                            </td>
                        </tr>
                        <tr>
                            <td>Shipping Information</td>
                            <?php
                            if ($order['delivery_type'] == 1) {
                            ?>
                                <td><span>Citilink: <strong><?php echo ($order['consignment_number'] == "") ? "-" : $order['consignment_number'];; ?></strong><span>
                                            <br><a style="color : #1a0dab" class="a-links" target="_blank" href="https://www.tracking.my/">Check Now</a></td>
                            <?php
                            } else {
                            ?>
                                <span>
                                    <td> Self Taking</td>
                                </span>
                            <?php
                            }
                            ?>

                        </tr>
                        <tr>
                            <td>Order ID</td>
                            <td><?php echo $order["gateway_order_id"]; ?></td>
                        </tr>
                        <tr>
                            <td>Payment Method</td>
                            <td><?php echo $payment_display; ?></td>
                        </tr>
                        <tr>
                            <td>Coupon Code</td>
                            <td><?php echo ($order["coupon_code"] == "") ? "-" : $order["coupon_code"]; ?></td>
                        </tr>
                        <tr>
                            <td>Point Earn</td>
                            <td><strong style="color:green;"><?php echo $order["reward_point"]; ?> Points</strong></td>
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
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php


                            $table = "order_items o left join product p on o.product_id = p.id left join product_translation pt on o.product_id = pt.product_id";
                            $col = "o.id as id, o.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, o.price as price";
                            $opt = 'o.order_id = ? AND pt.language = ? ';
                            $arr = array($id, $_SESSION['language']);
                            $order_item = $db->advwhere($col, $table, $opt, $arr);

                            foreach ($order_item as $item) {
                            ?>
                                <tr>
                                    <td>
                                        <div><strong><?php echo $item["name"]; ?></strong></div>
                                    </td>
                                    <td><?php echo $item["qty"]; ?></td>
                                    <td><?php echo number_format($item["price"], 2); ?></td>
                                    <?php
                                    $total =  $item["qty"] * $item["price"];
                                    ?>
                                    <td><?php echo number_format($total, 2); ?></td>
                                </tr>
                            <?php

                            } ?>



                        </tbody>
                    </table>
                </div>
                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td><strong>Subtotal</strong></td>
                            <td class="total-details-titles">RM <?php echo number_format($order["total_price"], 2); ?></td>
                        </tr>

                        <tr>
                            <td><strong>Delivery Fee</strong></td>
                            <td class="total-details-titles">+ RM <?php echo number_format($order["shipping_fee"], 2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Coupon</strong></td>
                            <td class="total-details-titles">- RM <?php echo number_format($order["discount_amount"], 2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Caroma Coin</strong></td>
                            <td class="total-details-titles">- RM <?php echo number_format($order["discount_reward"], 2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>GST Tax (<?php echo $order["gst_rate"]; ?>%)</strong></td>
                            <td class="total-details-titles">+ RM <?php echo number_format($order["gst_fee"], 2); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Payment Price :</strong></td>
                            <td class="total-details-titles total-details-title-last">RM <?php echo number_format($order["total_payment"], 2); ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
</div>