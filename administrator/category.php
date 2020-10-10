<?php
require_once('inc/init.php');
$PageName = "category";
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
                <div class="col-lg-12" style="padding-left:0px ; padding-right :0px ; padding-bottom : 20px">
                    <div class="row">

                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3 text-center product_btns">
                            <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_category"> &nbsp;Add Category</a>

                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------- -->
                <!--            Modal To Add Category             -->
                <!-- ------------------------------------------- -->
                <div class="modal inmodal" id="add_category" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                            <form role="form" id="form_category" action="admin_sql.php?type=category_add&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                    <h4 class="modal-title">Add Product Category</h4>
                                </div>
                                <div class="modal-body">


                                    <div class="form-group"><label>Name(English)</label> <input type="text" placeholder="Enter Category Name (English)" class="form-control" name="name_en" value=''></div>
                                    <!-- <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="cate_desc_en" rows="5"></textarea>
                                    </div> -->

                                    <div class="form-group"><label>Name(Chinese)</label> <input type="text" placeholder="Enter Category Name (Chinese)" class="form-control" name="name_cn" value=''></div>
                                    <!-- <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description " class="form-control" name="cate_desc_cn" rows="5"></textarea>
                                    </div> -->

                                    <div class="form-group"><label>Name(Malay)</label> <input type="text" placeholder="Enter Category Name (Malay)" class="form-control" name="name_my" value=''></div>
                                    <!-- <div class="form-group text-left"><label>Description</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="cate_desc_my" rows="5"></textarea>
                                    </div> -->


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="btnAction"><strong>Confirm</strong></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- ------------------------------------------- -->
                <!--           /Modal To Add Category             -->
                <!-- ------------------------------------------- -->

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Category</h5>

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
                                    $col = "*";
                                    $tb = "category";
                                    $opt = 'id != ? ORDER BY date_modified DESC';
                                    $arr = array(0);
                                    $result = $db->advwhere($col, $tb, $opt, $arr);
                                    foreach ($result as $category) {
                                        $status = $category["status"];

                                        if ($status == 1) {
                                            $status_display = "Activate";
                                            $status_color = "text-success";
                                        } else {
                                            $status_display = "Deactivate";
                                            $status_color = "text-danger";
                                        }

                                        $btn_edit = '<a data-remote="ajax/category_edit.php?p=' . $category["id"] . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                        $btn_delete = '<a data-remote="ajax/delete_data.php?p=' . $category["id"] . '&table=category&page=category" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                        $btn_action = $btn_edit . $btn_delete;
                                        //-------------------------------
                                        //  get category details
                                        //-------------------------------
                                        $col = "*";
                                        $tb = "category_translation";
                                        $opt = 'category_id = ?';
                                        $arr = array($category["id"]);
                                        $result_cate_detail = $db->advwhere($col, $tb, $opt, $arr);
                                        $result_cate_detail = $result_cate_detail[0];

                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $result_cate_detail["name"]; ?></td>
                                            <td class="<?php echo $status_color; ?>"><?php echo $status_display; ?></td>
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

            $("#form_category").validate({
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



        });
    </script>


</body>

</html>