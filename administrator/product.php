<?php
require_once('inc/init.php');
$PageName = "product";
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
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
                            <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_product"> &nbsp;Add Product</a>

                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------- -->
                <!--            Modal To Add Product             -->
                <!-- ------------------------------------------- -->
                <div class="modal inmodal" id="add_product" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content animated fadeIn">
                            <form role="form" id="form_product" action="admin_sql.php?type=product_add&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                    <h4 class="modal-title">Add Product</h4>
                                </div>
                                <div class="modal-body">


                                    <div class="form-group"><label>Name (English)</label> <input type="text" placeholder="Enter Product Name" class="form-control" name="name_en" value=''></div>
                                    <div class="form-group text-left"><label>Description (English)</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_en" rows="5"></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group"><label>Name (Chinese)</label> <input type="text" placeholder="Enter Product Name" class="form-control" name="name_cn" value=''></div>
                                    <div class="form-group text-left"><label>Description (Chinese)</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_cn" rows="5"></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group"><label>Name (Malay)</label> <input type="text" placeholder="Enter Product Name" class="form-control" name="name_my" value=''></div>
                                    <div class="form-group text-left"><label>Description (Malay)</label>
                                        <textarea type="text" placeholder="Enter Description" class="form-control" name="desc_my" rows="5"></textarea>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="font-normal">Under Which Category<span class="text-danger"></span></label>
                                        <div>
                                            <select class="chosen-select" name="category" tabindex="2">

                                                <option data-option="" value="">Select Category</option>
                                                <?php

                                                $tb = "category left join category_translation on category.id = category_translation.category_id";
                                                $col = "category.id as id, category_translation.name as name";
                                                $opt = 'status = ? && category_translation.language = ?';
                                                $arr = array(1, "en");
                                                $result = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($result as $category) {
                                                ?>
                                                    <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>


                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group"><label>Stock</label> <input type="number" placeholder="Enter Stock " class="form-control" name="stock" value='' min="0"></div>
                                    <div class="form-group"><label>Point</label> <input type="number" placeholder="Enter Point" class="form-control" name="point" value='' min="0"></div>
                                    <hr>
                                    <div class="form-group"><label>Price (Normal User)</label> <input type="number" placeholder="Enter User Price" class="form-control" name="user_price" value='' min="0"></div>
                                    <div class="form-group"><label>Price (Distributor)</label> <input type="number" placeholder="Enter Distributor Price" class="form-control" name="distributor_price" value='' min="0"></div>
                                    <div class="form-group"><label>Price (Dealer)</label> <input type="number" placeholder="Enter Dealer Price" class="form-control" name="dealer_price" value='' min="0"></div>
                                    <hr>
                                    <div class="form-group">
                                        <label class="font-normal">Length</label>
                                        <input class="length" type="text" value="0" name="length">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Width</label>
                                        <input class="width" type="text" value="0" name="width">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Height</label>
                                        <input class="height" type="text" value="0" name="height">
                                    </div>
                                    <div class="form-group">
                                        <label class="font-normal">Weight</label>
                                        <input class="weight" type="text" value="0" name="weight">
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label>Product Image</label>
                                        <input class="form-control" type="file" name="img" accept=".jpg,.png,.jpeg,.pdf">
                                        </span>
                                    </div>

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
                <!--           /Modal To Add Product             -->
                <!-- ------------------------------------------- -->

                <div class="wrapper wrapper-content animated fadeInRight wrapper_table">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Product</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link">
                                            <i class="fa fa-chevron-up"></i>
                                        </a>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="fa fa-wrench"></i>
                                        </a>
                                        <a class="close-link">
                                            <i class="fa fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="ibox-content">

                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Status</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Stock</th>
                                                    <th>Point</th>
                                                    <th>User Price</th>
                                                    <th>Distributor Price</th>
                                                    <th>Dealer Price</th>
                                                    <th>Category</th>
                                                    <th>Date Modified</th>
                                                    <th>Image</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                $tb = "product left join product_translation on product.id = product_translation.product_id left join category_translation on product.category = category_translation.category_id";
                                                $col = "*,product.id as product_id, product_translation.description as product_description, product_translation.name as product_name, category_translation.name as category_name";
                                                $opt = 'product_translation.language = ? && category_translation.language = ? ORDER BY date_modified DESC';
                                                $arr = array("en", "en");
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

                                                    $btn_edit = '<a data-remote="ajax/product_edit.php?p=' . $product_id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                                    $btn_delete = '<a data-remote="ajax/delete_data.php?p=' . $product_id . '&table=product&page=product" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                                    $btn_action = $btn_edit . $btn_delete;

                                                    $col = "*";
                                                    $table = "product_role_price";
                                                    $opt = 'product_id= ? && type = ?';

                                                    $arr = array($product_id, "1");
                                                    $product_price = $db->advwhere($col, $table, $opt, $arr);
                                                    $user_price = $product_price[0]['price'];

                                                    $arr = array($product_id, "2");
                                                    $product_price = $db->advwhere($col, $table, $opt, $arr);
                                                    $distributor_price = $product_price[0]['price'];

                                                    $arr = array($product_id, "3");
                                                    $product_price = $db->advwhere($col, $table, $opt, $arr);
                                                    $dealer_price = $product_price[0]['price'];

                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><span class="<?php echo $status_color; ?> font-weight-bold"><?php echo $status_display; ?></span></td>
                                                        <td><?php echo $row['product_name']; ?></td>
                                                        <td><?php echo $row['product_description']; ?></td>
                                                        <td><?php echo $row['stock']; ?></td>
                                                        <td><?php echo $row['point']; ?></td>
                                                        <td><?php echo number_format($user_price, 2); ?></td>
                                                        <td><?php echo number_format($distributor_price, 2); ?></td>
                                                        <td><?php echo number_format($dealer_price, 2); ?></td>
                                                        <td><?php echo $row['category_name']; ?></td>
                                                        <td><?php echo $row['date_modified']; ?></td>
                                                        <td>
                                                            <a href="../img/product/<?php echo $row['image']; ?>" target="_blank">
                                                                <span hidden><?php echo $path . "/img/product/" . $row["image"]; ?></span>
                                                                <i style="color:blue" class="fa fa-chevron-circle-right fa-lg"></i>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php echo $btn_action; ?>
                                                            </div>
                                                        </td>



                                                    </tr>
                                                <?php $i++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
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
    <!-- TouchSpin -->
    <script src="js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        //this script for modal 
        $('body').on('click', '[data-toggle="modal"]', function() {
            $($(this).data("target") + ' .modal-content').load($(this).data("remote"));
        });
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

            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [

                    {
                        extend: 'csv',
                    },
                    {
                        extend: 'excel',
                        title: 'Product',
                    }
                ],

            });

            $("#form_product").validate({
                rules: {
                    name_en: {
                        required: true,

                    },
                    name_cn: {
                        required: true,

                    },
                    name_my: {
                        required: true,

                    },
                    desc_en: {
                        required: true,

                    },
                    desc_cn: {
                        required: true,

                    },
                    desc_my: {
                        required: true,

                    },
                    stock: {
                        required: true,

                    },
                    point: {
                        required: true,

                    },
                    user_price: {
                        required: true,

                    },
                    distributor_price: {
                        required: true,

                    },
                    dealer_price: {
                        required: true,

                    },
                    img: {
                        required: true,

                    },
                    category: {
                        required: true,

                    },
                    length: {
                        required: true,

                    },
                    width: {
                        required: true,

                    },
                    height: {
                        required: true,

                    },
                    weight: {
                        required: true,

                    }

                }
            });

            $(".length").TouchSpin({
                min: 0,
                max: 9999999,
                step: 0.001,
                decimals: 3,
                postfix: 'CM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            $(".width").TouchSpin({
                min: 0,
                max: 9999999,
                step: 0.001,
                decimals: 3,
                postfix: 'CM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            $(".height").TouchSpin({
                min: 0,
                max: 9999999,
                step: 0.001,
                decimals: 3,
                postfix: 'CM',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });
            $(".weight").TouchSpin({
                min: 0,
                max: 9999999,
                step: 0.001,
                decimals: 3,
                postfix: 'KG',
                buttondown_class: 'btn btn-white',
                buttonup_class: 'btn btn-white'
            });

        });
    </script>

</body>

</html>