<?php
require_once('inc/init.php');
$PageName = "order";
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
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
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Postcode</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th>Contact</th>
                                                    <th>Total Price</th>
                                                    <th>Coupon</th>
                                                    <th>Discount Percentage</th>
                                                    <th>Discount Amount</th>
                                                    <th>Total Payment</th>
                                                    <th>Track Code</th>
                                                    <th>Order Id</th>
                                                    <th>User</th>
                                                    <th>Date Create</th>
                                                    <th>Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $i = 1;
                                                $tb = "orders o left join users u on o.users_id = u.id";
                                                $col = "o.*, u.name as user_name";
                                                $opt = 'o.status != ? ORDER BY o.date_modified DESC';
                                                $arr = array(0);
                                                $product = $db->advwhere($col, $tb, $opt, $arr);
                                                foreach ($product as $row) {

                                                    $id = $row['id'];
                                                    $status = $row['status'];
                                                    if ($status == 1) {
                                                        $status_display = "Activate";
                                                        $status_color = "text-success";
                                                    } else {
                                                        $status_display = "Deactivate";
                                                        $status_color = "text-danger";
                                                    }

                                                    $btn_edit = '<a data-remote="ajax/product_edit.php?p=' . $id . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                                    $btn_delete = '<a data-remote="ajax/delete_data.php?p=' . $id . '&table=product&page=product" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                                    $btn_action = $btn_edit . $btn_delete;


                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><span class="<?php echo $status_color; ?> font-weight-bold"><?php echo $status_display; ?></span></td>
                                                        <td><?php echo $row['customer_name']; ?></td>
                                                        <td><?php echo $row['customer_email']; ?></td>
                                                        <td><?php echo $row['customer_address']; ?></td>
                                                        <td><?php echo $row['customer_postcode']; ?></td>
                                                        <td><?php echo $row['customer_city']; ?></td>
                                                        <td><?php echo $row['customer_state']; ?></td>
                                                        <td><?php echo $row['customer_contact']; ?></td>
                                                        <td><?php echo number_format($row['total_price'], 2); ?></td>
                                                        <td><?php echo $row['coupon_code']; ?></td>
                                                        <td><?php echo $row['discount_percent']; ?></td>
                                                        <td><?php echo number_format($row['discount_amount'], 2); ?></td>
                                                        <td><?php echo number_format($row['total_payment'], 2); ?></td>
                                                        <td><?php echo $row['track_code']; ?></td>
                                                        <td><?php echo $row['gateway_order_id']; ?></td>
                                                        <td><?php echo $row['user_name']; ?></td>
                                                        <td><?php echo $row['date_created']; ?></td>
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

                    }

                }
            });



        });
    </script>

</body>

</html>