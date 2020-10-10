<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Edit Category";
$message = "Are you sure you want to <strong>Edit</strong> this Category ?";
$button = "Edit";

$col = "*";
$table = "category";
$opt = 'id = ?';
$arr = array($id);
$category = $db->advwhere($col, $table, $opt, $arr);
$category = $category[0];

$category_id = $category['id'];


$col = "*";
$table = "category_translation";
$opt = 'category_id = ? && language = ?';

$arr = array($id, "en");
$category_name = $db->advwhere($col, $table, $opt, $arr);
$category_name_en = $category_name[0]['name'];

$arr = array($id, "cn");
$category_name = $db->advwhere($col, $table, $opt, $arr);
$category_name_cn = $category_name[0]['name'];

$arr = array($id, "my");
$category_name = $db->advwhere($col, $table, $opt, $arr);
$category_name_my = $category_name[0]['name'];



?>
<form role="form" id="form_category_edit" action="admin_sql.php?type=category_edit&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-laptop modal-icon"></i>
        <h4 class="modal-title"><?php echo $title; ?></h4>

    </div>


    <div class="modal-body">


        <div class="form-group"><label>Name(English)</label> <input type="text" placeholder="Enter Category Name (English)" class="form-control" name="name_en" value='<?php echo $category_name_en ?>'></div>
        <!-- <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description" class="form-control" name="cate_desc_en" rows="5"></textarea>
        </div> -->

        <div class="form-group"><label>Name(Chinese)</label> <input type="text" placeholder="Enter Category Name (Chinese)" class="form-control" name="name_cn" value='<?php echo $category_name_cn ?>'></div>
        <!-- <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description " class="form-control" name="cate_desc_cn" rows="5"></textarea>
        </div> -->

        <div class="form-group"><label>Name(Malay)</label> <input type="text" placeholder="Enter Category Name (Malay)" class="form-control" name="name_my" value='<?php echo $category_name_my ?>'></div>
        <!-- <div class="form-group text-left"><label>Description</label>
            <textarea type="text" placeholder="Enter Description" class="form-control" name="cate_desc_my" rows="5"></textarea>
        </div> -->
        <div class="form-group"><label>Status</label>
            <div class="row">
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="1" <?php echo ($category["status"] == 1) ? "checked" : "" ?>>Activate</div>
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="0" <?php echo ($category["status"] == 0) ? "checked" : "" ?> />Deactivate</div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary  btn-lg-dim" name="btnAction" value="<?php echo $id ?>"><?php echo $button; ?></button>
    </div>
</form>

<script>
    $(document).ready(function() {

        $("#form_category_edit").validate({
                rules: {
                    name_en: {
                        required: true,

                    },
                    name_cn: {
                        required: true,

                    },
                    name_my: {
                        required: true,

                    }

                }
            });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>