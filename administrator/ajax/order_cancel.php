<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];

//echo 'ID:'.$id;

$col = "o.*, o.id as order_id, st.name as state_name, o.reason as reason";
$tb = "orders o left join state st on o.customer_state = st.id";
$opt = 'o.id = ?';
$arr = array($id);
$order = $db->advwhere($col, $tb, $opt, $arr);
$order = $order[0];

$status = $order['status'];

$title = "Cancel Order";
$message = "Are you sure you want to <strong>Cancel</strong> to this Order?";
$button = "Yes! Cancel!";

if ($status == 5) {
    $title = "Order To Cancel ";
    $message = "Are you sure you want to <strong>Cancel</strong> to this Order?<br><br> Cancel the order.The order will be Canceled status.<br> For record purpose, if status is To Cancel, Please write down the your comment under the reason start with word '&lsaquo;br&rsaquo;'";
}



?>
<form role="form" id="form_approve" action="admin_sql.php?type=order_cancel&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-laptop modal-icon"></i>
        <h4 class="modal-title"><?php echo $title; ?></h4>

    </div>
    <div class="modal-body text-center">
        <h2><strong><?php echo $message; ?></h2>
        <div class="form-group text-left"><label>Reason</label>
            <textarea type="text" placeholder="Please Enter Cancel Reason" class="form-control" name="reason" required><?php echo ($status == 5) ? $order['reason'] : ""; ?></textarea>
        </div>
        <div class="form-group text-left">
            <label>Proof Image</label>
            <input class="form-control" type="file" name="img" accept=".jpg,.png,.jpeg,.pdf">
            </span>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary  btn-lg-dim" name="btnAction" value="<?php echo $id ?>"><?php echo $button; ?></button>
    </div>
</form>

<script>
    $(document).ready(function() {

        $("#form_approve").validate({
            rules: {
                reason: {
                    required: true,

                },

            }
        });


    });
</script>