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
    <h5 class="modal-title" id="myLargeModalLabel">Add Geo Zone</h5>
</div>
<div class="modal-body">
    <div class="panel-wrapper collapse in">
        <div class="panel-body no-padding">
            <div class="form-wrap">
                <form data-toggle="validator" role="form" id="form_geo_zone" action="api/distributor_sql.php?type=shipping_add&tb=distributor" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />

                    <div class="form-group">
                        <label class="control-label mb-10">Title</label>
                        <div class="input-group">
                            <div class="input-group-addon text-danger">*</div>
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>
                    </div>

                    <blockquote>
                        <table class="table-widths">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <label class="control-label mb-10">Geo Zone</label>
                                    <select class="input-width state_select form-control" name="zone" tabindex="2" required>
                                        <option data-option="" value="">Select Zones</option>
                                        <?php
                                        $col = "*";
                                        $tb = " geo_zone ";
                                        $opt = 'admin_id = ? ORDER BY name ASC';
                                        $arr = array($user_id);
                                        $result = $db->advwhere($col, $tb, $opt, $arr);
                                        foreach ($result as $zone) {
                                        ?>
                                            <option value="<?php echo $zone['id']; ?>"><?php echo $zone['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label for="product_qty" class="control-label mb-10">First Weight*</label>
                                    <input type="text" class="form-control" name="first_weight" placeholder="0.001" value="" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <label for="product_price" class="control-label mb-10">Price for First Weight*</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">RM</div>
                                        <input type="text" class="form-control" name="first_price" value="" placeholder="5.40" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label for="product_qty" class="control-label mb-10">Repeating Next Weight*</label>
                                    <input type="text" class="form-control" name="next_weight" placeholder="0.025" value="" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <label for="product_price" class="control-label mb-10">Price for Repeating Next Weight*</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">RM</div>
                                        <input type="text" class="form-control" name="next_price" value="" placeholder="5.40" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label for="product_qty" class="control-label mb-10">Additional Fee Charge ( % )</label>
                                    <input type="text" class="form-control" name="charge" placeholder="" value="">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </table>
                    </blockquote>
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