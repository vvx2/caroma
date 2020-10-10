<?php
require_once('inc/init.php');
$PageName = "distributor";
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
                <div class="col-lg-12" style="padding-left:0px ; padding-right :0px ; padding-bottom : 20px">
                    <div class="row">

                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3 text-center product_btns">
                            <a data-toggle="modal" class="btn btn-primary btn-lg btn-block" href="#add_distributor"> &nbsp;Add Distributor</a>

                        </div>
                    </div>

                </div>
                <!-- ------------------------------------------- -->
                <!--            Modal To Add Distributor         -->
                <!-- ------------------------------------------- -->
                <div class="modal inmodal" id="add_distributor" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content animated fadeIn">
                            <form role="form" id="form_distributor" action="admin_sql.php?type=distributor_add&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />

                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                                    <h4 class="modal-title">Add Distributor</h4>
                                </div>
                                <div class="modal-body">


                                    <div class="form-group"><label>Name</label> <input type="text" placeholder="Enter Distributor Name" class="form-control" name="name" value=''></div>
                                    <div class="form-group"><label>Email</label> <input type="email" placeholder="Enter Distributor Email" class="form-control" name="email" value=''></div>
                                    <div class="form-group"><label>Contact Number</label> <input type="tel" placeholder="Enter Distributor Contact Number" class="form-control" name="contact" value=''></div>
                                    <div class="form-group"><label>Password</label> <input type="password" placeholder="Enter Distributor Password" class="form-control" name="password" value=''></div>
                                    <div class="form-group"><label>Address</label> <input type="text" placeholder="Enter Distributor Address" class="form-control" name="address" value=''></div>
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
                                                    <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>


                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label>Postcode</label> <input type="text" placeholder="Enter Distributor Postcode" class="form-control" name="postcode" value=''></div>
                                    <div class="form-group"><label>City</label> <input type="text" placeholder="Enter Distributor City" class="form-control" name="city" value=''></div>

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
                <!--           /Modal To Add Distributor         -->
                <!-- ------------------------------------------- -->

                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Distributor</h5>

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
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Distributor Code</th>
                                            <th>Status</th>
                                            <th width=20%></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        $col = "*";
                                        $tb = "users left join user_distributor on users.id = user_distributor.user_id";
                                        $opt = 'type = ? ORDER BY date_modified DESC';
                                        $arr = array(2);
                                        $result = $db->advwhere($col, $tb, $opt, $arr);
                                        foreach ($result as $distributor) {
                                            $status = $distributor["status"];

                                            if ($status == 1) {
                                                $status_display = "Activate";
                                                $status_color = "text-success";
                                            } else {
                                                $status_display = "Deactivate";
                                                $status_color = "text-danger";
                                            }

                                            $btn_edit = '<a data-remote="ajax/distributor_edit.php?p=' . $distributor["id"] . '" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Edit</a>';
                                            $btn_delete = '<a data-remote="ajax/delete_data.php?p=' . $distributor["id"] . '&table=users&page=distributor" class="btn btn-white btn-xs" data-toggle="modal" data-target="#myModal">Delete</a>';

                                            $btn_action = $btn_edit . $btn_delete;

                                        ?>
                                            <tr class="gradeX">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $distributor["name"]; ?></td>
                                                <td><?php echo $distributor["email"]; ?></td>
                                                <td><?php echo $distributor["distributor_code"]; ?></td>
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

        $('.chosen-select').chosen({
            width: "100%"
        });
        $.validator.setDefaults({
            ignore: ":hidden:not(.chosen-select)"
        }) //for all select having class .chosen-select

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

            $("#form_distributor").validate({
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


</body>

</html>