<?php
include_once('../connection/PDO_db_function.php');
$db = new DB_Functions();

$id = $_REQUEST['p'];
//echo 'ID:'.$id;


$title = "Edit Distributor";
$message = "Are you sure you want to <strong>Edit</strong> this Distributor ?";
$button = "Edit";

$col = "*, users.name as name, users.status as status, user_address.status as address_status, user_address.name as adddress_name";
$table = "users left join user_distributor on users.id = user_distributor.user_id left join user_address on users.id = user_address.user_id";
$opt = 'users.id = ?';
$arr = array($id);
$distributor = $db->advwhere($col, $table, $opt, $arr);
$distributor = $distributor[0];

$status = $distributor['status'];
$name = $distributor['name'];
$email = $distributor['email'];
$contact = $distributor['contact'];
$password = encrypt_decrypt('decrypt', $distributor['password']);
$address = $distributor['address'];
$postcode = $distributor['postcode'];
$city = $distributor['city'];



?>
<form role="form" id="form_distributor_edit" action="admin_sql.php?type=distributor_edit&tb=admin" method="post" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $token; ?>" />
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <i class="fa fa-laptop modal-icon"></i>
        <h4 class="modal-title"><?php echo $title; ?></h4>

    </div>


    <div class="modal-body">

        <div class="form-group"><label>Status</label>
            <div class="row">
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="1" <?php echo ($status == 1) ? "checked" : "" ?>>Activate</div>
                <div class="i-checks col-md-3 text-center"><input type="radio" name="status" value="0" <?php echo ($status == 0) ? "checked" : "" ?> />Deactivate</div>
            </div>
        </div>
        <hr>
        <div class="form-group"><label>Name</label> <input type="text" placeholder="Enter Distributor Name" class="form-control" name="name" value='<?php echo $name; ?>'></div>
        <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter Distributor Email" class="form-control" name="email" value='<?php echo $email; ?>'></div>
        <div class="form-group"><label>Contact Number</label> <input type="tel" placeholder="Enter Distributor Contact Number" class="form-control" name="contact" value='<?php echo $contact; ?>'></div>
        <div class="form-group"><label>Password</label> <input type="password" placeholder="Enter Distributor Password" class="form-control" name="password" value='<?php echo $password; ?>'></div>
        <div class="form-group"><label>Address</label> <input type="text" placeholder="Enter Distributor Address" class="form-control" name="address" value='<?php echo $address; ?>'></div>
        <div class="form-group">
            <label class="font-normal">State<span class="text-danger"></span></label>
            <div>
                <select class="chosen-select" name="state" tabindex="2">

                    <option data-option="" value="">Select State</option>
                    <?php

                    $tb = "state";
                    $col = "id, name";
                    $opt = 'id != ?';
                    $arr = array(0);
                    $result = $db->advwhere($col, $tb, $opt, $arr);
                    foreach ($result as $state) {
                    ?>
                        <option value="<?php echo $state['id']; ?>" <?php echo ($state['id'] == $distributor['state']) ? "selected" : "" ?>><?php echo $state['name']; ?></option>


                    <?php
                    } ?>
                </select>
            </div>
        </div>
        <div class="form-group"><label>Postcode</label> <input type="text" placeholder="Enter Distributor Postcode" class="form-control" name="postcode" value='<?php echo $postcode; ?>'></div>
        <div class="form-group"><label>City</label> <input type="text" placeholder="Enter Distributor City" class="form-control" name="city" value='<?php echo $city; ?>'></div>
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

        $("#form_distributor_edit").validate({
            rules: {
                    name: {
                        required: true,

                    },
                    email: {
                        required: true,

                    },
                    contact: {
                        required: true,

                    },
                    password: {
                        required: true,

                    },
                    address: {
                        required: true,

                    },
                    postcode: {
                        required: true,
                        minlength: 5,
                        maxlength: 5,
                        digits: true

                    },
                    city: {
                        required: true,

                    },
                    state: {
                        required: true,

                    }

                }
        });


    });
</script>