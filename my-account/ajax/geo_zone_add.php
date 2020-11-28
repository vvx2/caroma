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
                <form data-toggle="validator" role="form" id="form_geo_zone" action="api/distributor_sql.php?type=geo_zone_add&tb=distributor" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="form-group">
                        <label class="control-label mb-10">Title</label>
                        <div class="input-group">

                            <div class="input-group-addon text-danger">*</div>
                            <input type="text" class="form-control" name="name" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label mb-10">Description</label>
                        <div class="input-group">
                            <div class="input-group-addon text-danger">*</div>
                            <input type="text" class="form-control" name="description" value="" required>
                        </div>
                    </div>
                    <div class="add_product col-12">
                        <div class="product col-12">
                            <blockquote>
                                <table class="table-widths">
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <label class="control-label mb-10">Geo Zone</label>
                                            <select class="input-width state_select form-control" name="zone[]" tabindex="2" required>
                                                <option data-option="" value="">Select Zones</option>
                                                <option data-option="" value="0">All Zones</option>
                                                <?php
                                                $col = "*";
                                                $tb = "state";
                                                $opt = 'state_status = ? ORDER BY name ASC';
                                                $arr = array(1);
                                                $result = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($result as $state) {
                                                ?>
                                                    <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>

                                                <?php } ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </table>
                            </blockquote>
                        </div>
                    </div>

                    <!-- Add more product -->
                    <div class="col-sm-12 text-right">
                        <a class="btn-add-more-product mb-3"></i> Add More Geo Zone</a>
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