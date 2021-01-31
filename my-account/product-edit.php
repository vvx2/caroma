<?php
require_once('inc/init.php');
$PageName = "order-list";
if ($login != 1) {
    echo "<script>window.location.replace('../login.php')</script>";
    exit();
}
if ($user_type != 2) {
    echo "<script>alert(\" Your are not Distributor\");
	window.location.href='index.php';</script>";
    exit();
}

if (isset($_REQUEST['p'])) {
    $product_id = $_REQUEST['p'];
} else {
    echo "<script>alert(\" No Data, Please Select Again\");
    window.location.href='product.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Caroma Malaysia | Member Center</title>
    <meta name="description" content="Kenny is a Dashboard & Admin Site Responsive Template by hencework." />
    <meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Kenny Admin, kennyadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
    <meta name="author" content="hencework" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- bootstrap-touchspin CSS -->
    <link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Colorpicker CSS -->
    <link href="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />

    <!-- select2 CSS -->
    <link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

    <!-- switchery CSS -->
    <link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css" />

    <!-- bootstrap-select CSS -->
    <link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

    <!-- bootstrap-tagsinput CSS -->
    <link href="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />

    <!-- bootstrap-touchspin CSS -->
    <link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

    <!-- multi-select CSS -->
    <link href="vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Switches CSS -->
    <link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Datetimepicker CSS -->
    <link href="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

    <!-- Custom CSS -->
    <link href="dist/css/custom.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!--Preloader-->
    <div class="preloader-it">
        <div class="la-anim-1"></div>
    </div>
    <!--/Preloader-->
    <div class="wrapper">
        <!-- Top Menu Items -->
        <?php require_once('inc/top_nav.php'); ?>
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        <?php require_once('inc/side_bar.php'); ?>
        <!-- /Left Sidebar Menu -->

        <!-- Main Content -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <!-- Title -->
                <div class="row heading-bg bg-pink">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h5 class="txt-light">Product Management</h5>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default card-view">
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="form-wrap">
                                        <form data-toggle="validator" role="form" id="form_approve" action="api/distributor_sql.php?type=product_edit&tb=distributor" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="token" value="<?php echo $token; ?>" />
                                            <h6 class="txt-dark capitalize-font"><i class="icon-list mr-10"></i>Product Stock Availability</h6>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Product Name</label>
                                                        <select class="form-control" data-placeholder="Choose a Product" tabindex="1" name="product">
                                                            <?php


                                                            $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name";
                                                            $tb = "product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id ";
                                                            $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =? ORDER BY pt.name ASC';
                                                            $arr = array($language, 3, $language, 1);
                                                            $result = $db->advwhere($col, $tb, $opt, $arr);

                                                            $col = "*";
                                                            $tb = "distributor_product";
                                                            $opt = 'user_id =? && product_id =?';
                                                            $arr = array($user_id, $product_id);
                                                            $distributor_product = $db->advwhere($col, $tb, $opt, $arr);
                                                            if (count($distributor_product) != 0) {
                                                                $distributor_product = $distributor_product[0];
                                                                $stock = $distributor_product['stock'];
                                                                $status = $distributor_product['status'];
                                                                $id = $distributor_product['id'];
                                                            } else {
                                                                echo "<script>alert(\" No Data, Please Select Again\");
                                                                        window.location.href='product.php';</script>";
                                                                die;
                                                            }

                                                            $product_category = "";
                                                            $product_price = 0;
                                                            $product_image = "";
                                                            $product_length = 0;
                                                            $product_width = 0;
                                                            $product_height = 0;
                                                            $product_weight = 0;

                                                            foreach ($result as $product) {
                                                                if ($product['p_id'] == $product_id) {
                                                                    $product_category = $product['ct_name'];
                                                                    $product_price = $product['price'];
                                                                    $product_image = $product['image'];
                                                                    $product_length = $product['length'];
                                                                    $product_width = $product['width'];
                                                                    $product_height = $product['height'];
                                                                    $product_weight = $product['weight'];
                                                                }

                                                            ?>
                                                                <option value="<?php echo $product['p_id']; ?>" <?php echo ($product['p_id'] == $product_id) ? "selected" : ""; ?>><?php echo $product['pt_name']; ?></option>

                                                            <?php
                                                            } ?>
                                                        </select>


                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Stock </label><!-- <span>[Stock Available : 38]</span> -->
                                                        <input id="tch3" type="text" value="<?php echo $stock; ?>" name="stock" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!-- Row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Product Categories</label>
                                                        <input type="text" id="get_category" disabled value="<?php echo $product_category; ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Product Price (Dealer View)</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">RM</div>
                                                            <input type="text" class="form-control" id="get_price" disabled value="<?php echo number_format($product_price, 2); ?>" placeholder="188">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Product Length</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">CM</div>
                                                            <input type="text" class="form-control" id="get_length" disabled value="<?php echo number_format($product_length, 3); ?>" placeholder="188">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Product Width</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">CM</div>
                                                            <input type="text" class="form-control" id="get_width" disabled value="<?php echo number_format($product_width, 3); ?>" placeholder="188">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Row -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Product Height</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">CM</div>
                                                            <input type="text" class="form-control" id="get_height" disabled value="<?php echo number_format($product_height, 3); ?>" placeholder="188">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Product Weight</label>
                                                        <div class="input-group">
                                                            <div class="input-group-addon">KG</div>
                                                            <input type="text" class="form-control" id="get_weight" disabled value="<?php echo number_format($product_weight, 3); ?>" placeholder="188">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" hidden>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Logistic Company</label>
                                                        <select class="form-control" data-placeholder="Choose a Category" tabindex="1">
                                                            <option value="Product 1">DHL</option>
                                                            <option value="Product 2">POS LAJU</option>
                                                            <option value="Product 3">SHOPEE EXPRESS</option>
                                                            <option value="Product 4">FMX EXPRESS</option>
                                                            <option value="Product 4">SELF HANDLE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Delivery Price</label> <span>[**Per kg**]</span>
                                                        <div class="input-group">
                                                            <div class="input-group-addon"><i class="fa fa-truck"></i></div>
                                                            <div class="input-group-addon">RM</div>
                                                            <input type="text" class="form-control" id="exampleInputuname_1" placeholder="10">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Status</label>
                                                        <div class="radio-list">
                                                            <div class="radio-inline pl-0">
                                                                <div class="radio radio-info">
                                                                    <input <?php echo ($status == 1) ? "checked" : "" ?> type="radio" name="status" id="radio1" value="1">
                                                                    <label for="radio1">Activate</label>
                                                                </div>
                                                            </div>
                                                            <div class="radio-inline">
                                                                <div class="radio radio-info">
                                                                    <input <?php echo ($status == 0) ? "checked" : "" ?> type="radio" name="status" id="radio2" value="0">
                                                                    <label for="radio2">Deactivate</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="seprator-block"></div>
                                            <h6 class="txt-dark capitalize-font"><i class="icon-picture mr-10"></i>Product Images</h6>
                                            <hr>
                                            <div class="row" id="image_display">
                                                <?php
                                                // echo $product['p_id'];
                                                $col = "*";
                                                $tb = "product_image";
                                                $opt = 'product_id = ?';
                                                $arr = array($product_id);
                                                $product_image = $db->advwhere($col, $tb, $opt, $arr);

                                                foreach ($product_image as $image) {
                                                ?>
                                                    <div class="col-lg-3">
                                                        <div class="img-upload-wrap padding-15-t-b">
                                                            <img class="img-responsive" src="../img/product/<?php echo $image['image']; ?>" alt="upload_img">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="seprator-block"></div>
                                            <div class="form-actions">
                                                <button class="btn btn-success btn-icon left-icon mr-10" name="btnAction" value="<?php echo $id; ?>"> <i class="fa fa-check"></i> <span>save</span></button>
                                                <i data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-danger">Delete</i>
                                            </div>


                                            <!-- sample modal content -->
                                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h5 class="modal-title" id="myLargeModalLabel">Order Confirm</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="panel-wrapper collapse in">
                                                                <div class="panel-body no-padding">
                                                                    <blockquote class="bg-yellow">
                                                                        <table class="table-widths">
                                                                            <tr>
                                                                                <th class="spacing-titles"><i class="fa fa-cube"></i></th>
                                                                                <th class="spacing-titles1">
                                                                                    Delete Product
                                                                                    <br>
                                                                                    <h3>
                                                                                        <span>
                                                                                            Are you sure you want to DELETE this product?
                                                                                        </span>
                                                                                    </h3>

                                                                                </th>
                                                                            </tr>
                                                                        </table>
                                                                    </blockquote>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer footer-div-table">
                                                            <button class="btn btn-success" name="btnDelete" value="<?php echo $id; ?>">Yes! Delete</button>
                                                            <button type="button" class="btn btn-danger text-left" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Row -->

            </div>
            <div id='loadDiv' style='position: fixed; width: 100%; height: 100%; left: 0; top: 0; background: rgba(51,51,51,0.2); z-index: 9999; display:none;'><i class="fa fa-spin fa-spinner fa-5x text-success" style='position: fixed; left: 50%; top: 50%;'></i></div>

            <!-- Footer -->
            <footer class="footer container-fluid pl-30 pr-30">
                <?php require_once('inc/footer.php'); ?>
            </footer>
            <!-- /Footer -->

        </div>
        <!-- /Main Content -->
    </div>
    <!-- /#wrapper -->


    <!-- JavaScript -->

    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- jQuery -->
    <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Moment JavaScript -->
    <script type="text/javascript" src="vendors/bower_components/moment/min/moment-with-locales.min.js"></script>

    <!-- Bootstrap Colorpicker JavaScript -->
    <script src="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

    <!-- Switchery JavaScript -->
    <script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- Bootstrap Tagsinput JavaScript -->
    <script src="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <!-- Bootstrap Touchspin JavaScript -->
    <script src="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

    <!-- Multiselect JavaScript -->
    <script src="vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>


    <!-- Bootstrap Switch JavaScript -->
    <script src="vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

    <!-- Bootstrap Datetimepicker JavaScript -->
    <script type="text/javascript" src="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

    <!-- Form Advance Init JavaScript -->
    <script src="dist/js/form-advance-data.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Init JavaScript -->
    <script src="dist/js/init.js"></script>

    <script>
        //for check coupon
        $('[name="product"]').blur(function() {
            var product_id = $(this).val()
            $('#loadDiv').show();
            $.post('api/get_product_details.php', {
                product_id: product_id
            }, function(data) {
                setTimeout(function() {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data);
                    if (data["Status"]) {
                        let product_image = '';
                        // $("#get_img").attr("src", "../img/product/" + data["image"]);
                        $.each(data["image"], function(key, image) {
                            product_image = product_image +
                                '	<div class="col-lg-3">\n' +
                                '		<div class="img-upload-wrap padding-15-t-b" id="image_display">\n' +
                                '			<img class="img-responsive" src="../img/product/' + image + '" alt="upload_img">\n' +
                                '		</div>\n' +
                                '	</div>\n';
                        });
                        $("#image_display").html(product_image);
                        $("#get_coupon_msg").html("");
                        $("#get_price").val(parseFloat(data["price"]).toFixed(2));
                        $("#get_category").val(data["category"]);
                        $("#get_length").val(parseFloat(data["length"]).toFixed(3));
                        $("#get_width").val(parseFloat(data["width"]).toFixed(3));
                        $("#get_height").val(parseFloat(data["height"]).toFixed(3));
                        $("#get_weight").val(parseFloat(data["weight"]).toFixed(3));
                    }
                    $('#loadDiv').hide();
                }, 500);

            });
        });
    </script>

</body>

</html>