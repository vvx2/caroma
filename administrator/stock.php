<?php
require_once('inc/init.php');
$PageName = "stock";
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
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


                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5></h5>

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
                            <input type="text" class="form-control form-control-sm m-b-xs" id="filter_category" placeholder="Search in table">

                            <table class="footable table table-stripped" data-page-size="8" data-limit-navigation="5" data-filter=#filter_category>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th width=20%></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    $tb = "product left join product_translation on product.id = product_translation.product_id left join category_translation on product.category = category_translation.category_id";
                                    $col = "*,product.id as product_id, product_translation.description as product_description, product_translation.name as product_name, category_translation.name as category_name";
                                    $opt = 'product_translation.language = ? && category_translation.language = ? && product.stock <= ? ORDER BY stock ASC';
                                    $arr = array("en", "en", 10);
                                    $product = $db->advwhere($col, $tb, $opt, $arr);
                                    foreach ($product as $row) {

                                        $product_id = $row['product_id'];
                                        $status = $row['status'];
                                        if ($status == 1) {
                                            $status_display = "Activate";
                                            $status_color = "text-success";
                                        } else {
                                            $status_display = "Deactivate";
                                            $status_color = "text-danger";
                                        }

                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <td class="font-bold <?php echo ($row['stock'] <= 10) ? "text-danger" : "text-success" ?>"><?php echo $row['stock']; ?></td>

                                            <td class="<?php echo $status_color; ?>"><?php echo $status_display; ?></td>



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

    </div>

    <!-- this is for display modal by ajax -->
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
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

    <!-- Page-Level Scripts -->
    <script>
        //this script for modal 
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
        });
        $(document).ready(function() {

            $('.footable').footable();
        });
    </script>


</body>

</html>