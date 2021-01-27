<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Edit Geo Zone";
$message = "Are you sure you want to <strong>Edit</strong> this Geo Zone ?";
$button = "Edit";

$col = "*";
$tb = "geo_zone";
$opt = 'id = ?';
$arr = array($id);
$geo_zone = $db->advwhere($col, $tb, $opt, $arr);
$geo_zone = $geo_zone[0];


?>
<form role="form" id="form_geozone" action="admin_sql.php?type=geo_zone_edit&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

        <h4 class="modal-title">Edit Geo Zone</h4>
    </div>
    <div class="modal-body">


        <div class="form-group"><label>Title</label> <input type="text" placeholder="Enter Title" class="form-control" name="name" value='<?php echo $geo_zone['name']; ?>' required></div>

        <div class="form-group"><label>Description</label> <input type="text" placeholder="Enter Description" class="form-control" name="description" value='<?php echo $geo_zone['description']; ?>' required></div>
        <hr>
        <div class="add_product col-12">
            <div class="product col-12">
                <div class="form-group">
                    <label class="font-normal">Geo Zone<span class="text-danger"></span></label>
                    <div>
                        <select class="dual_select" name="zone[]" tabindex="2" multiple required>
                            <?php
                            $col = "geo_zone_id";
                            $table = "geo_zone_list";
                            $opt = 'geo_zone_id =? && state_id = ?';
                            $arr = array($id, 0);
                            $geo_zone_list_all = $db->advwhere($col, $table, $opt, $arr);

                            ?>
                            <option data-option="" value="0" <?php echo (count($geo_zone_list_all) != 0) ? "selected" : "" ?>>All Zones</option>
                            <?php
                            $col = "*";
                            $tb = "state";
                            $opt = 'state_status = ? ORDER BY name ASC';
                            $arr = array(1);
                            $result = $db->advwhere($col, $tb, $opt, $arr);
                            foreach ($result as $state) {
                                $col = "geo_zone_id";
                                $table = "geo_zone_list";
                                $opt = 'geo_zone_id =? && state_id = ?';
                                $arr = array($id, $state['id']);
                                $geo_zone_list = $db->advwhere($col, $table, $opt, $arr);

                            ?>
                                <option value="<?php echo $state['id']; ?>" <?php echo (count($geo_zone_list) != 0) ? "selected" : ""; ?>><?php echo $state['name']; ?></option>
                            <?php
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>


        <!-- Add more product -->
        <div class="col-sm-12 text-right">
            <a class="btn-add-more-product mb-3"></i> Add More Geo Zone</a>
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
        ignore: ":hidden:not(.dual_select)"
    }) //for all select having class .chosen-select

    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    $(document).ready(function() {
        $('.dual_select').bootstrapDualListbox({
            selectorMinimalHeight: 160
        });


    });
</script>