<?php
require_once('inc/init.php');
$PageName = "index";

//-----------------------
//      get point value
$result_point_value = $db->get("*", "reward_point_value", 1);
if (count($result_point_value) != 0) {
    $point_value = $result_point_value[0]['value'];
} else {
    $point_value = 1;
}
//-----------------------
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
</head>

<body>
    <div id="wrapper">
        <!-- left nav -->
        <?php include_once('inc/admin_nav.php'); ?>
        <!-- left nav -->
        <div id="page-wrapper" class="gray-bg">
            <!-- top nav -->
            <?php include_once('inc/top_nav.php'); ?>
            <!-- top nav -->
            <div class="wrapper wrapper-content wrapperes">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 yellow-bg">
                            <div class="row">
                                <div class="col-4">
                                    <a data-toggle="modal" data-target="#point_value_edit" style="color:white;"><i class="fa fa-cog fa-5x"></i></a>
                                </div>
                                <div class="col-8 text-right">
                                    <span> Reward Point Value (per) </span>
                                    <h2 class="font-bold"><?php echo $point_value; ?> Sen</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="modal inmodal" id="point_value_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <form role="form" id="form_ref" action="admin_sql.php?type=point_value_edit&tb=admin" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <i class="fa fa-laptop modal-icon"></i>
                        <h4 class="modal-title">Edit Point Value</h4>
                    </div>
                    <div class="modal-body text-center">

                        <h4><strong>Enter Point Value ( 1 point to (?) sen )</strong></h4>
                        <div class="form-group"><label>Point Value</label> <input type="number" placeholder="Enter Point Value" class="form-control" name="point_value" value="<?php echo $point_value; ?>"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary  btn-lg-dim" value="<?php echo $result_point_value[0]['id'] ?>" name="btnAction">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>

    </script>

</body>

</html>