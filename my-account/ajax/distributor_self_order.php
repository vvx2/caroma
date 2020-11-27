<?php
include_once('../../administrator/connection/PDO_db_function.php');
$db = new DB_Functions();
if (isset($_REQUEST['type']) && isset($_REQUEST['tb'])) {
    $type = $_REQUEST['type'];
    $tb = $_REQUEST['tb'];
}

if (isset($_SESSION['user_id']) && isset($_SESSION['type'])) {
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['type'];
    $login = 1;
    $_SESSION['login'] = $login;
} else {
    $login = 0;
    $_SESSION['login'] = $login;
    $user_type = 1;
}
if (isset($_SESSION['language'])) {

    $language = $_SESSION['language'];
} else {
    $_SESSION['language'] = "en";
    $language = $_SESSION['language'];
}
?>
<!-- get from here -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 class="modal-title" id="myLargeModalLabel">Order Confirm</h5>
</div>
<div class="modal-body">
    <div class="panel-wrapper collapse in">
        <div class="panel-body no-padding">
            <div class="form-wrap">
                <form data-toggle="validator" role="form" id="form_self_order" action="api/distributor_sql.php?type=self_order&tb=distributor" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="form-group">
                        <label class="control-label mb-10">Total Payment</label>
                        <div class="input-group">
                            <div class="input-group-addon">RM</div>
                            <input type="text" class="form-control" name="total_price" value="" placeholder="180.50" required>
                        </div>
                    </div>
                    <div class="add_product col-12">
                        <div class="product col-12">
                            <blockquote>
                                <table class="table-widths">
                                    <div class="row">
                                        <div class="col-sm-4 col-12">
                                            <label class="control-label mb-10">Product</label>
                                            <select class="input-width state_select form-control" name="product_id[]" tabindex="2" required>
                                                <option data-option="" value="">Select product</option>
                                                <?php
                                                $col = "*, p.product_id as p_id, pt.name as pt_name, pt.description as pt_description";
                                                $tb = "distributor_product p left join product_translation pt on p.product_id = pt.product_id";
                                                $opt = 'p.user_id =? && pt.language = ? ORDER BY p.date_modified DESC';
                                                $arr = array($user_id, $language);
                                                $result = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($result as $product) {
                                                ?>
                                                    <option value="<?php echo $product['p_id']; ?>"><?php echo $product['pt_name']; ?></option>

                                                <?php } ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="col-sm-4 col-12">
                                            <label for="product_price" class="control-label mb-10">Product Price</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">RM</div>
                                                <input type="text" class="form-control" name="product_price[]" value="" placeholder="12.50" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 col-12">
                                            <label for="product_qty" class="control-label mb-10">Product Quantity</label>
                                            <input type="number" class="form-control" name="product_qty[]" placeholder="1" min="1" value="" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </table>
                            </blockquote>
                        </div>
                    </div>

                    <!-- Add more product -->
                    <div class="col-sm-12 text-right">
                        <a class="btn-add-more-product mb-3"></i> Add More Product</a>
                    </div>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success btn-anim" name="btnAction"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer footer-div-table">
    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
</div>