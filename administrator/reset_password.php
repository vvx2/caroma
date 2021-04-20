<?php
require_once('inc/init.php');
$PageName = "reset_password";
?>
<!DOCTYPE html>
<html>

<head>
    <?php include_once('inc/header.php'); ?>
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <style>
        .hero-image {
            background-color: gray;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
        }
    </style>
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

            <div class="middle-box text-center loginscreen animated fadeInDown">

                <div class="row">
                    <div class="container">
                        <div class="loginbox">
                            <div class="hero-image">
                                <div class="login-left">
                                    <img src="img/logo.svg" width="100%">
                                </div>
                            </div>
                            <br>
                            <h3>Reset Password</h3>
                            <p class="account-subtitle">Content Management System Of Caroma</p>

                            <!-- Form -->
                            <form role="form" id="form_resetpassword" action="reset_password_sql.php?type=reset_password&tb=admin" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />
                                <div class="form-group">
                                    <input class="form-control" type="password" id="old_pass" name="old_pass" placeholder="Old password" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" id="new_pass" name="new_pass" placeholder="New password" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="password" id="c_pass" name="c_pass" placeholder="Confirm password" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit" name="btnsubmit" id="btnsubmit">RESET</button>
                                </div>
                                <div class="form-group">
                                    <span class="text-danger" id="error_msg"></span>
                                </div>
                            </form>
                            <!-- /Form -->

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

    <!-- Page-Level Scripts -->
    <script>
        $("#btnsubmit").click(function() {
            old_pass = $("#old_pass").val();
            new_pass = $("#new_pass").val();
            c_pass = $("#c_pass").val();

            if (new_pass != c_pass) {
                $('#error_msg').html('<b>New password and Confirm password must be same</b>');
                $("#c_pass").focus();
                return false;
            } else if (new_pass == c_pass) {
                $('#error_msg').html('<b></b>');
                return true
            }

        });
    </script>


</body>

</html>