<?php
include_once('../../administrator/connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];

$col = "o.*, o.id as order_id, st.name as state_name, o.reason as reason";
$tb = "orders o left join state st on o.customer_state = st.id";
$opt = 'o.id = ?';
$arr = array($id);
$order = $db->advwhere($col, $tb, $opt, $arr);
$order = $order[0];

$status = $order['status'];

$status_color = "bg-red";
$status_show = "Cancel ";
$status_desc = "Cancel the order.The order will be Canceled status.";

if ($status == 5) {
    $status_show = "To Cancel ";
    $status_desc = "Cancel the order.The order will be Canceled status.<br> For record purpose, if status is To Cancel, Please write down the your comment under the reason start with word '&lsaquo;br&rsaquo;' ";
}


?>
<!-- get from here -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 class="modal-title" id="myLargeModalLabel">Order Cancel</h5>
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
            <blockquote>
                <form data-toggle="validator" role="form" id="form_cancel" action="api/distributor_sql.php?type=order_cancel&tb=distributor" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="form-group">
                        <div class="form-group col-sm-12 no-padding">
                            <label for="order_cancel" class="control-label mb-10">Are you sure to cancel this order? Write the Reasons</label>
                            <textarea data-match-error="consignment_number Is Required" rows="5" type="text" class="form-control" id="order_cancel" name="reason" placeholder="Wirte the reason" required><?php echo ($status == 5) ? $order['reason'] : ""; ?></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="proofimage" class="control-label mb-10">Proof Image</label>
                        <input type="file" class="form-control" id="proofimage" name="img" accept="image/x-png,image/gif,image/jpeg" data-error="Only for .jpg .jpeg .png">
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success btn-anim" name="btnAction" value="<?php echo $id ?>"><i class="icon-rocket"></i><span class="btn-text">Yes! Cancel</span></button>
                    </div>
                </form>
            </blockquote>
        </div>
    </div>

</div>
<div class="modal-footer footer-div-table">
    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
</div>