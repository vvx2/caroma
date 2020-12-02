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

$status_color = "bg-blue";
$status_show = "Bank Details ";
$status_desc = "Bank Name and Bank Account for admin to refund.";

$col = "*";
$tb = "user_distributor";
$opt = 'user_id = ?';
$arr = array($user_id);
$distributor = $db->advwhere($col, $tb, $opt, $arr);
$wallet_amt = $distributor[0]['distributor_wallet'];
$bank_name = $distributor[0]['bank_name'];
$bank_account = $distributor[0]['bank_account'];

?>
<!-- get from here -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 class="modal-title" id="myLargeModalLabel">Update Bank Details</h5>
</div>
<div class="modal-body">
    <div class="panel-wrapper collapse in">
        <div class="panel-body no-padding">
            <blockquote class="<?php echo $status_color; ?>">
                <table class="table-widths">
                    <tr>
                        <th class="spacing-titles"><i class="fa fa-cube"></i></th>
                        <th class="spacing-titles1"><?php echo $status_show; ?><br><span><?php echo $status_desc; ?><span></th>
                    </tr>
                </table>
            </blockquote>
            <blockquote>
                <form data-toggle="validator" role="form" id="form_bank" action="api/distributor_sql.php?type=bank_update&tb=distributor" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="form-group">
                        <div class="form-group col-sm-12 no-padding">
                            <label for="bank_name" class="control-label mb-10">Bank Name</label>
                            <div class="input-group">
                                <div class="input-group-addon">Name</div>
                                <input type="text" class="form-control" id="bank_name" name="bank_name"  value="<?php echo $bank_name; ?>" placeholder="CIMB" required>
                            </div>
                        </div>
                        <div class="form-group col-sm-12 no-padding">
                            <label for="bank_account" class="control-label mb-10">Bank Account</label>
                            <div class="input-group">
                                <div class="input-group-addon">Acc</div>
                                <input type="text" class="form-control" id="bank_account" name="bank_account"  value="<?php echo $bank_account; ?>" placeholder="613989745668" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-0">
                        <button type="submit" class="btn btn-success btn-anim" name="btnAction"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
                    </div>
                </form>
            </blockquote>
        </div>
    </div>

</div>
<div class="modal-footer footer-div-table">
    <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
</div>