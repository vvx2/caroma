<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Generate Coupon";
$message = "Are you sure you want to <strong>Generate</strong> more Coupon ?";
$button = "Generate";




?>
<form role="form" id="form_coupon_generate_new" action="coupon_generate.php?type=coupon_generate_new&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-laptop modal-icon"></i>
        <h4 class="modal-title"><?php echo $title; ?></h4>

    </div>

    <div class="modal-body">

        <div class="form-group">
            <label class="font-normal">Number of coupon to generate</label>
            <input class="coupon_generate" type="text" value="0" name="coupon_generate">

        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary  btn-lg-dim" name="btnAction" value="<?php echo $id ?>"><?php echo $button; ?></button>
    </div>
</form>

<script>
    $(document).ready(function() {

        $("#form_coupon_generate_new").validate({
            rules: {
                coupon_generate: {
                    required: true,
                    min: 1
                },
            }
        });


        $(".coupon_generate").TouchSpin({
            min: 1,
            max: 9999999,
            postfix: 'Coupon Generate',
            buttondown_class: 'btn btn-white',
            buttonup_class: 'btn btn-white'
        });



    });
</script>