<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />


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

$status_color = "bg-green";
$status_show = "Rate";
$status_desc = "Rate The Product. Please leave a valuable rating";

?>
<!-- get from here -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 class="modal-title" id="myLargeModalLabel">Product Rating</h5>
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
            <form role="form" id="form_rate" action="api/user_sql.php?type=order_product_rate&tb=user" method="post" enctype="multipart/form-data">
                <input type="hidden" name="token" value="<?php echo $token; ?>" />
                <blockquote>
                    <?php

                    $table = "order_items o left join product p on o.product_id = p.id left join product_translation pt on o.product_id = pt.product_id";
                    $col = "o.id as id, o.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, o.price as price, o.rate as rate";
                    $opt = 'o.order_id = ? AND pt.language = ? ';
                    $arr = array($id, $_SESSION['language']);
                    $order_item = $db->advwhere($col, $table, $opt, $arr);

                    foreach ($order_item as $item) {

                    ?>

                        <div class="table-mxsp">

                            <table class="table-widths">
                                <div class="hidden">
                                    <input type="text" class="form-control" name="id[]" value="<?php echo $item['p_id'] ?>" />
                                </div>
                                <tr>
                                    <td class="product-imgsx" rowspan="3">
                                        <image width="100px" height="100px" src="../img/product/<?php echo $item['image']; ?>">
                                    </td>
                                    <td class="product-imgsx" rowspan="3">
                                        <!--rating here-->
                                        <input id="input-1" name="rate[]" class="rating rating-loading" value="<?php echo $item['rate']; ?>" data-min="0" data-max="5" data-step="1" data-size="xs" />
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

                        </div>

                    <?php } ?>

                    <div class="break-lines-klx"></div>

                </blockquote>
                <blockquote>
                    <div class="footer-div-table">
                        <button type="submit" class="btn btn-success btn-anim" name="btnAction" value="<?php echo $id ?>"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
                    </div>
                </blockquote>
            </form>


        </div>
    </div>
    <p class="disclaration">THE SERVICES ARE PROVIDED "AS IS" AND WITHOUT ANY WARRANTIES, CLAIMS OR REPRESENTATIONS MADE BY CAROMA MALAYSIA OF ANY KIND EITHER EXPRESSED, IMPLIED OR STATUTORY WITH RESPECT TO THE SERVICES, INCLUDING, WITHOUT LIMITATION, WARRANTIES OF QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE, NOR ARE THERE ANY WARRANTIES CREATED BY COURSE OF DEALING, COURSE OF PERFORMANCE OR TRADE USAGE.</p>
</div>
<div class="modal-footer footer-div-table">
    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
<script>
    $("#input-id").rating();
</script>