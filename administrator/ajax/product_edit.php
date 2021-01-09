<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Edit Product";
$message = "Are you sure you want to <strong>Edit</strong> this Product ?";
$button = "Edit";

$col = "*";
$table = "product";
$opt = 'id = ?';
$arr = array($id);
$product = $db->advwhere($col, $table, $opt, $arr);
$product = $product[0];

$product_id = $product['id'];


$col = "*";
$table = "product_translation";
$opt = 'product_id = ? && language = ?';

$arr = array($product_id, "en");
$product_translation = $db->advwhere($col, $table, $opt, $arr);
$product_name_en = $product_translation[0]['name'];
$product_desc_en = $product_translation[0]['description'];

$arr = array($product_id, "cn");
$product_translation = $db->advwhere($col, $table, $opt, $arr);
$product_name_cn = $product_translation[0]['name'];
$product_desc_cn = $product_translation[0]['description'];

$arr = array($product_id, "my");
$product_translation = $db->advwhere($col, $table, $opt, $arr);
$product_name_my = $product_translation[0]['name'];
$product_desc_my = $product_translation[0]['description'];


$col = "*";
$table = "product_role_price";
$opt = 'product_id = ? && type = ?';

$arr = array($product_id, "1");
$product_price = $db->advwhere($col, $table, $opt, $arr);
$user_price = $product_price[0]['price'];

$arr = array($product_id, "2");
$product_price = $db->advwhere($col, $table, $opt, $arr);
$distributor_price = $product_price[0]['price'];

$arr = array($product_id, "3");
$product_price = $db->advwhere($col, $table, $opt, $arr);
$dealer_price = $product_price[0]['price'];

$col = "*";
$table = "product";
$opt = 'id = ?';
$arr = array($product_id);
$product = $db->advwhere($col, $table, $opt, $arr);
$product_status = $product[0]['status'];
$product_stock = $product[0]['stock'];
$product_point = $product[0]['point'];
$product_point_allow_discount = $product[0]['point_allow_discount'];
$product_category = $product[0]['category'];

$length = $product[0]['length'];
$width = $product[0]['width'];
$weight = $product[0]['weight'];
$height = $product[0]['height'];



?>
<form role="form" id="form_product_edit" action="admin_sql.php?type=product_edit&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-laptop modal-icon"></i>
        <h4 class="modal-title"><?php echo $title; ?></h4>

    </div>


    <div class="modal-body">

        <div class="form-group"><label>Status</label>
            <div class="row">
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="1" <?php echo ($product_status == 1) ? "checked" : "" ?>>Activate</div>
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="0" <?php echo ($product_status == 0) ? "checked" : "" ?> />Deactivate</div>
            </div>
        </div>
        <hr>
        <div class="form-group"><label>Name (English)</label> <input type="text" placeholder="Enter Product Name" class="form-control" name="name_en" value='<?php echo $product_name_en; ?>'></div>
        <div class="form-group text-left"><label>Description (English)</label>
            <textarea id="summernote_edit" type="text" placeholder="Enter Description" class="form-control" name="desc_en" rows="5"><?php echo $product_desc_en; ?></textarea>
        </div>
        <hr>
        <div class="form-group"><label>Name (Chinese)</label> <input type="text" placeholder="Enter Product Name" class="form-control" name="name_cn" value='<?php echo $product_name_cn; ?>'></div>
        <div class="form-group text-left"><label>Description (Chinese)</label>
            <textarea id="summernote_edit" type="text" placeholder="Enter Description" class="form-control" name="desc_cn" rows="5"><?php echo $product_desc_cn; ?></textarea>
        </div>
        <hr>
        <div class="form-group"><label>Name (Malay)</label> <input type="text" placeholder="Enter Product Name" class="form-control" name="name_my" value='<?php echo $product_name_my; ?>'></div>
        <div class="form-group text-left"><label>Description (Malay)</label>
            <textarea id="summernote_edit" type="text" placeholder="Enter Description" class="form-control" name="desc_my" rows="5"><?php echo $product_desc_my; ?></textarea>
        </div>
        <hr>

        <div class="form-group">
            <label class="font-normal">Under Which Category<span class="text-danger"></span></label>
            <div>
                <select class="chosen-select" name="category" tabindex="2">

                    <option data-option="" value="">Select Category</option>
                    <?php

                    $tb = "category left join category_translation on category.id = category_translation.category_id";
                    $col = "category.id as id, category_translation.name as name";
                    $opt = 'status = ? && category_translation.language = ?';
                    $arr = array(1, "en");
                    $result = $db->advwhere($col, $tb, $opt, $arr);
                    foreach ($result as $category) {
                    ?>
                        <option value="<?php echo $category['id']; ?>" <?php echo ($product_category == $category['id']) ? "selected" : "" ?>><?php echo $category['name']; ?></option>


                    <?php
                    } ?>
                </select>
            </div>
        </div>
        <hr>
        <div class="form-group"><label>Stock</label> <input type="number" placeholder="Enter Stock " class="form-control" name="stock" value='<?php echo $product_stock; ?>' min="0"></div>
        <div class="form-group"><label>Point</label> <input type="number" placeholder="Enter Point" class="form-control" name="point" value='<?php echo $product_point; ?>' min="0"></div>
        <div class="form-group"><label>Point Allow to Discount (Per Item)</label> <input type="number" placeholder="Enter Point Discount" class="form-control" name="point_allow_discount" value='<?php echo $product_point_allow_discount; ?>' min="0"></div>
        <hr>
        <div class="form-group"><label>Price (Normal User)</label> <input type="number" placeholder="Enter User Price" class="form-control" name="user_price" value='<?php echo $user_price; ?>' min="0"></div>
        <div class="form-group"><label>Price (Distributor)</label> <input type="number" placeholder="Enter Distributor Price" class="form-control" name="distributor_price" value='<?php echo $distributor_price; ?>' min="0"></div>
        <div class="form-group"><label>Price (Dealer)</label> <input type="number" placeholder="Enter Dealer Price" class="form-control" name="dealer_price" value='<?php echo $dealer_price; ?>' min="0"></div>
        <hr>
        <div class="form-group">
            <label class="font-normal">Length</label>
            <input class="length" type="text" value="<?php echo $length; ?>" name="length">
        </div>
        <div class="form-group">
            <label class="font-normal">Width</label>
            <input class="width" type="text" value="<?php echo $width; ?>" name="width">
        </div>
        <div class="form-group">
            <label class="font-normal">Height</label>
            <input class="height" type="text" value="<?php echo $height; ?>" name="height">
        </div>
        <div class="form-group">
            <label class="font-normal">Weight</label>
            <input class="weight" type="text" value="<?php echo $weight; ?>" name="weight">
        </div>
        <hr>
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
        ignore: ":hidden:not(.chosen-select)"
    }) //for all select having class .chosen-select

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $(document).ready(function() {

        $('[id=summernote_edit]').summernote({
            placeholder: 'Description content',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ]
        });

        $("#form_product_edit").validate({
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
                desc_en: {
                    required: true,

                },
                desc_cn: {
                    required: true,

                },
                desc_my: {
                    required: true,

                },
                stock: {
                    required: true,

                },
                point: {
                    required: true,

                },
                point_allow_discount: {
                    required: true,

                },
                user_price: {
                    required: true,

                },
                distributor_price: {
                    required: true,

                },
                dealer_price: {
                    required: true,

                },
                category: {
                    required: true,

                },
                length: {
                    required: true,

                },
                width: {
                    required: true,

                },
                height: {
                    required: true,

                },
                weight: {
                    required: true,

                }

            }
        });

        $(".length").TouchSpin({
            min: 0.001,
            max: 9999999,
            step: 0.001,
            decimals: 3,
            postfix: 'CM',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $(".width").TouchSpin({
            min: 0.001,
            max: 9999999,
            step: 0.001,
            decimals: 3,
            postfix: 'CM',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $(".height").TouchSpin({
            min: 0.001,
            max: 9999999,
            step: 0.001,
            decimals: 3,
            postfix: 'CM',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });
        $(".weight").TouchSpin({
            min: 0.001,
            max: 9999999,
            step: 0.001,
            decimals: 3,
            postfix: 'KG',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });

    });
</script>