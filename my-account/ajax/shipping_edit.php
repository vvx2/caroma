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

$id = $_REQUEST['p'];

$col = "*";
$tb = "shipping";
$opt = 'id = ?';
$arr = array($id);
$shipping = $db->advwhere($col, $tb, $opt, $arr);
$shipping = $shipping[0];
$status = $shipping['status'];
?>
<!-- get from here -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 class="modal-title" id="myLargeModalLabel">Edit Geo Zone</h5>
</div>
<div class="modal-body">
    <div class="panel-wrapper collapse in">
        <div class="panel-body no-padding">
            <div class="form-wrap">
                <form data-toggle="validator" role="form" id="form_geo_zone" action="api/distributor_sql.php?type=shipping_edit&tb=distributor" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />

                    <div class="form-group">
                        <label class="control-label mb-10">Title</label>
                        <div class="input-group">
                            <div class="input-group-addon text-danger">*</div>
                            <input type="text" class="form-control" name="name" value="<?php echo $shipping['name']; ?>" required>
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
                                            <option value="<?php echo $zone['id']; ?>" <?php echo ($shipping["geo_zone"] == $zone['id']) ? "selected" : "" ?>><?php echo $zone['name']; ?></option>

                                        <?php } ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label for="first_weight" class="control-label mb-10">First Weight*</label>
                                    <input type="text" class="form-control" name="first_weight" placeholder="0.001" value="<?php echo $shipping['first_weight']; ?>" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <label for="first_price" class="control-label mb-10">Price for First Weight*</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">RM</div>
                                        <input type="text" class="form-control" name="first_price" value="<?php echo $shipping['first_price']; ?>" placeholder="5.40" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label for="next_weight" class="control-label mb-10">Repeating Next Weight*</label>
                                    <input type="text" class="form-control" name="next_weight" placeholder="0.025" value="<?php echo $shipping['next_weight']; ?>" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <label for="next_price" class="control-label mb-10">Price for Repeating Next Weight*</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">RM</div>
                                        <input type="text" class="form-control" name="next_price" value="<?php echo $shipping['next_price']; ?>" placeholder="5.40" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <label for="charge" class="control-label mb-10">Additional Fee Charge ( % )</label>
                                    <input type="text" class="form-control" name="charge" value="<?php echo $shipping['charge']; ?>">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Status</label>
                                        <div class="radio-list">
                                            <div class="radio-inline pl-0">
                                                <div class="radio radio-info">
                                                    <input <?php echo ($status == 1) ? "checked" : "" ?> type="radio" name="status" id="radio1" value="1">
                                                    <label for="radio1">Activate</label>
                                                </div>
                                            </div>
                                            <div class="radio-inline">
                                                <div class="radio radio-info">
                                                    <input <?php echo ($status == 0) ? "checked" : "" ?> type="radio" name="status" id="radio2" value="0">
                                                    <label for="radio2">Deactivate</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </table>
                    </blockquote>
                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success btn-anim" value="<?php echo $id; ?>" name="btnAction"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="modal-footer footer-div-table">
    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
</div>