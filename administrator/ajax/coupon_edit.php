<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Edit Coupon";
$message = "Are you sure you want to <strong>Edit</strong> this Coupon ?";
$button = "Edit";

$col = "*";
$table = "coupon";
$opt = 'id = ?';
$arr = array($id);
$coupon = $db->advwhere($col, $table, $opt, $arr);
$coupon = $coupon[0];

$start = date("Y-m-d", strtotime($coupon['start']));
$end = date("Y-m-d", strtotime($coupon['end']));
$type = $coupon['type'];
$amt = $coupon['amt'];
$percentage = $coupon['percentage'];
$min_spend = $coupon['min_spend'];
$capped = $coupon['capped'];
$user_per_coupon = $coupon['user_per_coupon'];
$usage_limit = $coupon['usage_limit'];
$total_usage_limit = $coupon['total_usage_limit'];
$status = $coupon['status'];
$coupon_code = $coupon['code'];
$delivery_type = $coupon['free_delivery'];
$coupon_user = $coupon['coupon_user'];

$col = "*";
$table = "coupon_translation";
$opt = 'coupon_id = ? && language = ?';

$arr = array($id, "en");
$coupon_name = $db->advwhere($col, $table, $opt, $arr);
$coupon_name_en = $coupon_name[0]['name'];
$coupon_description_en = $coupon_name[0]['description'];

$arr = array($id, "cn");
$coupon_name = $db->advwhere($col, $table, $opt, $arr);
$coupon_name_cn = $coupon_name[0]['name'];
$coupon_description_cn = $coupon_name[0]['description'];

$arr = array($id, "my");
$coupon_name = $db->advwhere($col, $table, $opt, $arr);
$coupon_name_my = $coupon_name[0]['name'];
$coupon_description_my = $coupon_name[0]['description'];




?>
<form role="form" id="form_coupon_edit" action="coupon_generate.php?type=coupon_edit&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-laptop modal-icon"></i>
        <h4 class="modal-title"><?php echo $title; ?></h4>

    </div>

    <div class="modal-body">

        <div class="form-group"><label>Status</label>
            <div class="row">
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="1" <?php echo ($status == 1) ? "checked" : "" ?>>Activate</div>
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="0" <?php echo ($status == 0) ? "checked" : "" ?> />Deactivate</div>
            </div>
        </div>
        <hr>
        <div class="form-group">
            <label>Coupon Code</label>
            <input type="text" placeholder="Enter Coupon Code" class="form-control" name="coupon_code" value='<?php echo $coupon_code ?>'>
        </div>
        <div class="form-group"><label>Name(English)</label> <input type="text" placeholder="Enter Coupon Name (English)" class="form-control" name="name_en" value='<?php echo $coupon_name_en ?>'></div>
        <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_en" rows="4"><?php echo $coupon_description_en ?></textarea>
        </div>

        <div class="form-group"><label>Name(Chinese)</label> <input type="text" placeholder="Enter Coupon Name (Chinese)" class="form-control" name="name_cn" value='<?php echo $coupon_name_cn ?>'></div>
        <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description " class="form-control" name="desc_cn" rows="4"><?php echo $coupon_description_cn ?></textarea>
        </div>

        <div class="form-group"><label>Name(Malay)</label> <input type="text" placeholder="Enter Coupon Name (Malay)" class="form-control" name="name_my" value='<?php echo $coupon_name_my ?>'></div>
        <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_my" rows="4"><?php echo $coupon_description_my ?></textarea>
        </div>
        <hr>
        <div class="form-group" id="date">
            <label class="font-normal">Date Range select</label>
            <div class="input-daterange input-group" id="datepicker">
                <input type="text" class="form-control-sm form-control" name="start" value="<?php echo $start ?>" />
                <span class="input-group-addon">to</span>
                <input type="text" class="form-control-sm form-control" name="end" value="<?php echo $end ?>" />
            </div>
        </div>
        <hr>
        <label class="font-normal">Free Delivery</label>
        <div class="">
            <input type="radio" name="free_delivery" id="delivery_1" value="1" <?php echo ($delivery_type == 1) ? 'checked="" ' : ''; ?>>
            <label for="delivery_1">
                Free Delivery
            </label>
        </div>
        <div class="">
            <input type="radio" name="free_delivery" id="delivery_2" value="0" <?php echo ($delivery_type == 0) ? 'checked="" ' : ''; ?>>
            <label for="delivery_2">
                No
            </label>
        </div>
        <hr>
        <label class="font-normal">User type</label>
        <div class="">
            <input type="radio" name="coupon_user" id="coupon_user1" value="1" <?php echo ($coupon_user == 1) ? 'checked="" ' : ''; ?>>
            <label for="coupon_user1">
                Normal User
            </label>
        </div>
        <div class="">
            <input type="radio" name="coupon_user" id="coupon_user2" value="2" <?php echo ($coupon_user == 2) ? 'checked="" ' : ''; ?>>
            <label for="coupon_user2">
                Distributor
            </label>
        </div>
        <div class="">
            <input type="radio" name="coupon_user" id="coupon_user3" value="3" <?php echo ($coupon_user == 3) ? 'checked="" ' : ''; ?>>
            <label for="coupon_user3">
                Dealer
            </label>
        </div>
        <hr>
        <label class="font-normal">Coupon Type</label>
        <div class="">
            <input type="radio" name="coupon_type" class="coupon_type" id="coupon_type_1" value="1" <?php echo ($type == 1) ? 'checked="" ' : ''; ?>>
            <label for="coupon_type_1">
                Amount
            </label>
        </div>
        <div class="">
            <input type="radio" name="coupon_type" class="coupon_type" id="coupon_type_2" value="2" <?php echo ($type == 2) ? 'checked="" ' : ''; ?>>
            <label for="coupon_type_2">
                Percentange
            </label>
        </div>
        <hr>
        <div class="amount_part_edit" <?php echo ($type == 1) ? '' : 'style="display:none;"'; ?>>
            <div class="form-group">
                <label class="font-normal">Amount Discount</label>
                <input class="amount" type="text" value="<?php echo $amt ?>" name="amount">
            </div>
        </div>
        <div class="percentage_part_edit" <?php echo ($type == 2) ? '' : 'style="display:none;"'; ?>>
            <div class="form-group">
                <label class="font-normal">Percentage Discount</label>
                <input class="percentage" type="text" value="<?php echo $percentage ?>" name="percentage">
            </div>
            <div class="form-group">
                <label class="font-normal">Discount Capped - <span class="text-success">Maximum amount to discount (When type is percentage, leave it 0 if type = Amount)</span></label>
                <input class="dis_capped" type="text" value="<?php echo $capped ?>" name="dis_capped">

            </div>
        </div>

        <hr>
        <div class="form-group">
            <label class="font-normal">Minimum Spend</label>
            <input class="min_spend" type="text" value="<?php echo $min_spend ?>" name="min_spend">

        </div>
        <hr>
        <div class="form-group" hidden>
            <label class="font-normal">User per coupon - <span class="text-danger">How many coupons users can hold</span></label>
            <input class="user_per_coupon" type="text" value="<?php echo $user_per_coupon ?>" name="user_per_coupon">
        </div>
        <div class="form-group">
            <label class="font-normal">Usage limit per coupon code use - <span class="text-danger">How many times can the coupon be used per user</span></label>
            <input class="usage_limit" type="text" value="<?php echo $usage_limit ?>" name="usage_limit">
        </div>
        <div class="form-group">
            <label class="font-normal">Total Usage limit with this coupon - <span class="text-danger">Total how many times can the coupon be used</span></label>
            <input class="total_usage_limit" type="text" value="<?php echo $total_usage_limit ?>" name="total_usage_limit">
        </div>
        <hr>
        <div class="form-group">
            <label class="font-normal">Product Available for this coupon - <span class="text-success">Only available when the product in cart</span></label>
            <select class="form-control dual_select " name="product[]" multiple required>
                <?php

                $tb = "product left join product_translation on product.id = product_translation.product_id";
                $col = "product.id as id, product_translation.name as name";
                $opt = 'status = ? && product_translation.language = ?';
                $arr = array(1, "en");
                $result = $db->advwhere($col, $tb, $opt, $arr);
                foreach ($result as $product) {

                    $col = "product_id";
                    $table = "coupon_product";
                    $opt = 'coupon_id =? && product_id = ?';
                    $arr = array($id, $product['id']);
                    $coupon_product = $db->advwhere($col, $table, $opt, $arr);

                ?>
                    <option value="<?php echo $product['id']; ?>" <?php echo (count($coupon_product) != 0) ? "selected" : ""; ?>><?php echo $product['name']; ?></option>


                <?php
                } ?>
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary  btn-lg-dim" name="btnAction" value="<?php echo $id ?>"><?php echo $button; ?></button>
    </div>
</form>

<script>
    $('.chosen-select').chosen({
        width: "100%"
    });
    $.validator.setDefaults({
        ignore: ":hidden:not(.dual_select)"
    }) //for all select having class .chosen-select

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $('[class="coupon_type"]').change(function() {
        var coupon_type = $('[class="coupon_type"]:checked').val()

        if (coupon_type == 1) {
            $('.amount_part_edit').show();
            $('.percentage_part_edit').hide();
        } else if (coupon_type == 2) {
            $('.amount_part_edit').hide();
            $('.percentage_part_edit').show();
        }
    });

    $(document).ready(function() {


        jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");

        $("#form_coupon_edit").validate({
            rules: {
                coupon_code: {
                    required: true,
                    noSpace: true
                },
                name_en: {
                    required: true,

                },
                name_cn: {
                    required: true,

                },
                name_my: {
                    required: true,

                },
                coupon_desc_en: {
                    required: true,

                },
                coupon_desc_cn: {
                    required: true,

                },
                coupon_desc_my: {
                    required: true,

                },
                start: {
                    required: true,

                },
                end: {
                    required: true,

                },
                amount: {
                    required: true,
                    min: 0

                },
                percentage: {
                    required: true,
                    min: 0
                },
                min_spend: {
                    required: true,
                    min: 0
                },
                dis_capped: {
                    required: true,
                    min: 0
                },
                usage_limit: {
                    required: true,
                    min: 1
                },
                total_usage_limit: {
                    required: true,
                    min: 0
                },
                coupon_generate: {
                    required: true,
                    min: 1
                },
                user_per_coupon: {
                    required: true,
                    min: 1
                }

            }
        });

        $('#date .input-daterange').datepicker({
            format: 'yyyy-mm-dd',
            keyboardNavigation: false,
            forceParse: false,
            autoclose: true
        });

        $(".amount").TouchSpin({
            min: 0,
            max: 9999999,
            decimals: 2,
            postfix: 'RM',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".percentage").TouchSpin({
            min: 0,
            max: 100,
            postfix: '%',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".min_spend").TouchSpin({
            min: 0,
            max: 9999999,
            postfix: 'RM',
            decimals: 2,
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".dis_capped").TouchSpin({
            min: 0,
            max: 9999999,
            postfix: 'RM',
            decimals: 2,
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".user_per_coupon").TouchSpin({
            min: 1,
            max: 9999999,
            postfix: 'User per coupon',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".usage_limit").TouchSpin({
            min: 1,
            max: 9999999,
            postfix: 'Times',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $(".total_usage_limit").TouchSpin({
            min: 1,
            max: 9999999,
            postfix: 'Times',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 160
        });


    });
</script>