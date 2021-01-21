<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
// $name = $_REQUEST['name'];

//echo 'ID:'.$id;
$title = "Delete";
$message = "Are you sure you want to <strong>Delete</strong> this GeoZone?";
$button = "Yes! Delete It!";

?>

<form role="form" id="form_approve" action="admin_sql.php?type=geo_zone_delete&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-laptop modal-icon"></i>
        <h4 class="modal-title"><?php echo $title; ?></h4>

    </div>
    <div class="modal-body text-center">
        <h2><strong><?php echo $message; ?></h2>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary  btn-lg-dim" name="btnAction" value="<?php echo $id ?>"><?php echo $button; ?></button>
    </div>
</form>