<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    ?>
</head>

<body class="biolife-body">

    <!-- Preloader -->
    <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div>

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-02">
        <div class="header-top bg-main hidden-xs">
            <?php
            require_once('inc/header.php');
            ?>
        </div>
        <div class="header-middle biolife-sticky-object ">
            <div class="container">
                <?php
                require_once('inc/top_nav.php');
                ?>
            </div>
        </div>
    </header>

    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">Authentication</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Authentication</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">

                <div class="row">

                    <!--Form Sign In-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="signin-container">
                            <form action="login.php" name="frm-login" method="post">
                                <p class="form-row">
                                    <label for="uname">Email Address:<span class="requite">*</span></label>
                                    <input type="email" id="uname" name="email" value="" class="txt-input" required>
                                </p>
                                <p class="form-row">
                                    <label for="pword">Password:<span class="requite">*</span></label>
                                    <input type="password" id="pword" name="password" value="" class="txt-input" required>
                                </p>
                                <div class="form-group">
                                    <span class="text-danger" id="error_msg"></span>
                                </div>
                                <p class="form-row wrap-btn">
                                    <button class="btn btn-submit btn-bold" type="submit" id="btnsubmit">sign in</button>
                                    <a href="#" class="link-to-help">Forgot your password</a>
                                </p>
                            </form>
                        </div>
                    </div>

                    <!--Go to Register form-->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="register-in-container">
                            <div class="intro">
                                <h4 class="box-title">New Customer?</h4>
                                <p class="sub-title">Create an account with us and you’ll be able to:</p>
                                <ul class="lis">
                                    <li>Check out faster</li>
                                    <li>Access your order history</li>
                                    <li>Track new orders</li>
                                    <li>Save items to your Wishlist</li>
                                </ul>
                                <a href="register.php" class="btn btn-bold">Create an account</a>
                                <a href="register_dealer.php" class="btn btn-bold">Join with Dealer</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <?php
    require_once('inc/footer.php');
    require_once('inc/mobile_footer.php');
    ?>


    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery.nicescroll.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/biolife.framework.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="cart.js"></script>
    <script>
        $(document).ready(function() {
            LoadCart();
        });

        $('#btnsubmit').click(function(e) {
            var uname = $('#uname').val();
            var pword = $('#pword').val();

            if (uname != "" && pword != "") {
                e.preventDefault();

                $.post('api/login.php', {
                    Uname: uname,
                    Pword: pword
                }, function(data) {
                    console.info(data);
                    data = JSON.parse(data);
                    if (data[0]) {
                        window.location.replace('api/routing.php?login_key=' + data[1]);
                    } else {
                        $('#error_msg').html('<b>Wrong Username Or Password</b>');
                    }
                });

            }

        })
    </script>
</body>

</html>