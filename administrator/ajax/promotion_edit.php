<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Edit promotion";
$message = "Are you sure you want to <strong>Edit</strong> this promotion ?";
$button = "Edit";

$col = "*";
$table = "promotion";
$opt = 'id = ?';
$arr = array($id);
$promotion = $db->advwhere($col, $table, $opt, $arr);
$promotion = $promotion[0];

$start = date("Y-m-d", strtotime($promotion['start']));
$end = date("Y-m-d", strtotime($promotion['end']));
$type = $promotion['type'];
$amt = $promotion['amt'];
$percentage = $promotion['percentage'];
$capped = $promotion['capped'];
$status = $promotion['status'];

$col = "*";
$table = "promotion_translation";
$opt = 'promotion_id = ? && language = ?';

$arr = array($id, "en");
$promotion_name = $db->advwhere($col, $table, $opt, $arr);
$promotion_name_en = $promotion_name[0]['name'];
$promotion_description_en = $promotion_name[0]['description'];

$arr = array($id, "cn");
$promotion_name = $db->advwhere($col, $table, $opt, $arr);
$promotion_name_cn = $promotion_name[0]['name'];
$promotion_description_cn = $promotion_name[0]['description'];

$arr = array($id, "my");
$promotion_name = $db->advwhere($col, $table, $opt, $arr);
$promotion_name_my = $promotion_name[0]['name'];
$promotion_description_my = $promotion_name[0]['description'];




?>
<form role="form" id="form_promotion_edit" action="promotion_generate.php?type=promotion_edit&tb=admin" method="post" enctype="multipart/form-data">
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
        <div class="form-group"><label>Name(English)</label> <input type="text" placeholder="Enter promotion Name (English)" class="form-control" name="name_en" value='<?php echo $promotion_name_en ?>'></div>
        <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_en" rows="4"><?php echo $promotion_description_en ?></textarea>
        </div>

        <div class="form-group"><label>Name(Chinese)</label> <input type="text" placeholder="Enter promotion Name (Chinese)" class="form-control" name="name_cn" value='<?php echo $promotion_name_cn ?>'></div>
        <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description " class="form-control" name="desc_cn" rows="4"><?php echo $promotion_description_cn ?></textarea>
        </div>

        <div class="form-group"><label>Name(Malay)</label> <input type="text" placeholder="Enter promotion Name (Malay)" class="form-control" name="name_my" value='<?php echo $promotion_name_my ?>'></div>
        <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_my" rows="4"><?php echo $promotion_description_my ?></textarea>
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
        <label class="font-normal">Promotion Type</label>
        <div class="">
            <input type="radio" name="promotion_type" class="promotion_type" id="promotion_type_1" value="1" <?php echo ($type == 1) ? 'checked="" ' : ''; ?>>
            <label for="promotion_type_1">
                Amount
            </label>
        </div>
        <div class="">
            <input type="radio" name="promotion_type" class="promotion_type" id="promotion_type_2" value="2" <?php echo ($type == 2) ? 'checked="" ' : ''; ?>>
            <label for="promotion_type_2">
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
            <label class="font-normal">Product Available for this promotion - <span class="text-success">Promotion product</span></label>
            <select class="form-control dual_select" name="product[]" multiple required>
                <?php

                $tb = "product left join product_translation on product.id = product_translation.product_id";
                $col = "product.id as id, product_translation.name as name";
                $opt = 'status = ? && product_translation.language = ?';
                $arr = array(1, "en");
                $result = $db->advwhere($col, $tb, $opt, $arr);
                foreach ($result as $product) {

                    $col = "product_id";
                    $table = "promotion_product";
                    $opt = 'promotion_id =? && product_id = ?';
                    $arr = array($id, $product['id']);
                    $promotion_product = $db->advwhere($col, $table, $opt, $arr);

                ?>
                    <option value="<?php echo $product['id']; ?>" <?php echo (count($promotion_product) != 0) ? "selected" : ""; ?>><?php echo $product['name']; ?></option>


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

    $('[class="promotion_type"]').change(function() {
        var promotion_type = $('[class="promotion_type"]:checked').val()

        if (promotion_type == 1) {
            $('.amount_part_edit').show();
            $('.percentage_part_edit').hide();
        } else if (promotion_type == 2) {
            $('.amount_part_edit').hide();
            $('.percentage_part_edit').show();
        }
    });


    $(document).ready(function() {


        jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        }, "No space please and don't leave it empty");

        $("#form_promotion_edit").validate({
            rules: {
                name_en: {
                    required: true,

                },
                name_cn: {
                    required: true,

                },
                name_my: {
                    required: true,

                },
                promotion_desc_en: {
                    required: true,

                },
                promotion_desc_cn: {
                    required: true,

                },
                promotion_desc_my: {
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
                dis_capped: {
                    required: true,
                    min: 0
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

        $(".dis_capped").TouchSpin({
            min: 0,
            max: 9999999,
            postfix: 'RM',
            decimals: 2,
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });


        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 160
        });


    });
</script>