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

$status_color = "bg-green";
$status_show = "To Complete ";
$status_desc = "Complete the order.The order will be Completed status.<br> **Make sure the item is delivered**";



?>
<!-- get from here -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 class="modal-title" id="myLargeModalLabel">Order To Complete</h5>
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
                <form data-toggle="validator" role="form" id="form_complete" action="api/user_sql.php?type=order_complete&tb=user" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="form-group">
                        <div class="form-group col-sm-12 no-padding">
                            <label class="control-label mb-10">Are you sure to complete this order?</label>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success btn-anim" name="btnAction" value="<?php echo $id ?>"><i class="icon-rocket"></i><span class="btn-text">Yes! Complete</span></button>
                    </div>
                </form>
            </blockquote>
        </div>
    </div>

</div>
<div class="modal-footer footer-div-table">
    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
</div>