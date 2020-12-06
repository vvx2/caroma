<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Edit Shipping";
$message = "Are you sure you want to <strong>Edit</strong> this Shipping ?";
$button = "Edit";

$col = "*";
$tb = "shipping";
$opt = 'id = ?';
$arr = array($id);
$shipping = $db->advwhere($col, $tb, $opt, $arr);
$shipping = $shipping[0];
$status = $shipping['status'];


?>
<form role="form" id="form_geozone" action="admin_sql.php?type=shipping_edit&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

        <h4 class="modal-title">Edit Shipping</h4>
    </div>
    <div class="modal-body">
        <div class="form-group"><label>Status</label>
            <div class="row">
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="1" <?php echo ($status == 1) ? "checked" : "" ?>>Activate</div>
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="0" <?php echo ($status == 0) ? "checked" : "" ?> />Deactivate</div>
            </div>
        </div>

        <div class="form-group"><label>Title</label> <input type="text" placeholder="Enter Title" class="form-control" name="name" value='<?php echo $shipping['name']; ?>' required></div>
        <hr>
        <div class="form-group">
            <label class="font-normal">Geo Zone<span class="text-danger"></span></label>
            <div>
                <select class="chosen-select" name="zone" tabindex="2" required>

                    <option data-option="" value="">Select Geo Zone</option>
                    <?php
                    $col = "*";
                    $tb = " geo_zone ";
                    $opt = 'admin_id = ? ORDER BY name ASC';
                    $arr = array(0);
                    $result = $db->advwhere($col, $tb, $opt, $arr);
                    foreach ($result as $zone) {
                    ?>
                        <option value="<?php echo $zone['id']; ?>" <?php echo ($shipping["geo_zone"] == $zone['id']) ? "selected" : "" ?>><?php echo $zone['name']; ?></option>

                    <?php } ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label class="font-normal">First Weight*</label>
            <input class="first_weight" type="text" value="<?php echo $shipping['first_weight']; ?>" name="first_weight" required>
        </div>
        <div class="form-group">
            <label class="font-normal">Price for First Weight*</label>
            <input class="first_price" type="text" value="<?php echo $shipping['first_price']; ?>" name="first_price" required>
        </div>
        <div class="form-group">
            <label class="font-normal">Repeating Next Weight*</label>
            <input class="next_weight" type="text" value="<?php echo $shipping['next_weight']; ?>" name="next_weight" required>
        </div>
        <div class="form-group">
            <label class="font-normal">Price for Repeating Next Weight*</label>
            <input class="next_price" type="text" value="<?php echo $shipping['next_price']; ?>" name="next_price" required>
        </div>
        <div class="form-group">
            <label class="font-normal">Additional Fee Charge</label>
            <input class="charge" type="number" value="<?php echo $shipping['charge']; ?>" name="charge">
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="btnAction" value="<?php echo $id; ?>"><strong>Confirm</strong></button>
    </div>

</form>

<script>
    $('.chosen-select').chosen({
        width: "100%"
    });
    $.validator.setDefaults({
        ignore: ":hidden:not(.chosen-select)"
    }) //for all select having class .chosen-select

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $(document).ready(function() {
        $(".first_weight").TouchSpin({
            min: 0.001,
            max: 9999999,
            step: 0.001,
            decimals: 3,
            postfix: 'KG',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $(".first_price").TouchSpin({
            min: 0.01,
            max: 9999999,
            step: 0.01,
            decimals: 2,
            postfix: 'RM',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $(".next_weight").TouchSpin({
            min: 0.001,
            max: 9999999,
            step: 0.001,
            decimals: 3,
            postfix: 'KG',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $(".next_price").TouchSpin({
            min: 0.01,
            max: 9999999,
            step: 0.01,
            decimals: 2,
            postfix: 'RM',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $(".charge").TouchSpin({
            min: 0,
            max: 9999999,
            step: 1,
            postfix: '%',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

    });
</script>