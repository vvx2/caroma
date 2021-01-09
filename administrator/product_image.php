<?php
require_once('inc/init.php');
$PageName = "product";

if (isset($_REQUEST['p'])) {
    $product_id = $_REQUEST['p'];
} else {
    echo "<script>alert(\"Please select a User\");
	window.location.href='user.php';</script>";
    exit();
}

$tb = "product left join product_translation on product.id = product_translation.product_id left join category_translation on product.category = category_translation.category_id";
$col = "*,product.id as product_id, product_translation.description as product_description, product_translation.name as product_name, category_translation.name as category_name";
$opt = 'product.id =? && product_translation.language = ? && category_translation.language = ? ORDER BY date_modified DESC';
$arr = array($product_id, "en", "en");
$product = $db->advwhere($col, $tb, $opt, $arr);
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
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>NAME</h5>
                            </div>
                            <div class="ibox-content">
                                <h1 class="no-margins"> <?php echo $product[0]['product_name']; ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3 text-center product_btns">
                        <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_image"> &nbsp;Add Images</a>

                    </div>
                </div>

            </div>

            <!-- ------------------------------------------- -->
            <!--            Modal To Add Product             -->
            <!-- ------------------------------------------- -->
            <div class="modal inmodal" id="add_image" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content animated fadeIn">
                        <form role="form" id="form_product" action="admin_sql.php?type=product_add_image&tb=admin" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="token" value="<?php echo $token; ?>" />

                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                <h4 class="modal-title">Add Product</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <input class="form-control" type="file" name="img[]" accept=".jpg,.png,.jpeg,.pdf" multiple="multiple" required>
                                    </span>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnAction" value="<?php echo $product_id; ?>"><strong>Confirm</strong></button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- ------------------------------------------- -->
            <!--           /Modal To Add Product             -->
            <!-- ------------------------------------------- -->

            <div class="wrapper wrapper-content wrapperes">

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Product Images - <span class="text-success">color mean image primary to display </span></h5>

                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <input type="text" class="form-control form-control-sm m-b-xs" id="filter_point" placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="8" data-limit-navigation="5" data-filter=#filter_point>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    $col = "*";
                                    $tb = "product_image";
                                    $opt = 'product_id = ?';
                                    $arr = array($product_id);
                                    $product_image = $db->advwhere($col, $tb, $opt, $arr);

                                    foreach ($product_image as $image) {
                                        $image_name = $image['image'];
                                        $product_id = $image['product_id'];
                                        $image_id = $image['id'];

                                        $col = "*";
                                        $tb = "product";
                                        $opt = 'image = ? && id = ?';
                                        $arr = array($image_name, $product_id);
                                        $check_primary_image = $db->advwhere($col, $tb, $opt, $arr);

                                        $btn_edit = '<a data-remote="ajax/product_image_set_primary.php?p=' . $image_id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Set Primary</a>';
                                        $btn_delete = '<a data-remote="ajax/product_image_delete.php?p=' . $image_id . '&table=product_&page=product" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                        $btn_action = $btn_edit . $btn_delete;

                                        if (count($check_primary_image) != 0) {
                                            $text_color = "text-success";
                                            $btn_action = "";
                                        } else {
                                            $text_color = "";
                                            $btn_action = $btn_edit . $btn_delete;
                                        }



                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td class="<?php echo $text_color; ?>"><?php echo $image_name; ?></td>
                                            <td><img src="../img/product/<?php echo $image_name; ?>"></td>
                                            <td>
                                                <div class="btn-group">
                                                    <?php echo $btn_action; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <ul class="pagination float-right"></ul>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


    </div>
    <!-- this is for display modal by ajax -->
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeIn">

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

    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>

    <script>
        //this script for modal 
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
        });
    </script>


</body>

</html>