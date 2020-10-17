<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    require_once('administrator/connection/PDO_db_function.php');
    $db = new DB_FUNCTIONS();
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
        <h1 class="page-title">Registration</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.html" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Registration</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">

                <div class="row">

                    <!--Form Sign In-->
                    <div class="col-sm-12 col-xs-12">
                        <div class="signin-container">
                            <form role="form" id="form_user" action="administrator/user_register.php?type=user_register&tb=user" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" value="<?php echo $token; ?>" />
                                <p class="form-row">
                                    <div class="col-sm-6 col-12 no-padding-left">
                                        <label class="label-width" for="name">Full Name</label>
                                        <input class="input-width" type="text" name="name" id="name" value="" placeholder="Your Name" required>
                                    </div>
                                    <div class="col-sm-6 col-12 no-padding-left">
                                        <label class="label-width" for="email">Email Address</label>
                                        <input class="input-width" type="email" name="email" id="email" value="" placeholder="Your email" required>
                                    </div>
                                    <div class="col-sm-6 col-12 no-padding-left">
                                        <label class="label-width" for="password">Password</label>
                                        <input class="input-width" type="password" name="password" id="password" value="" placeholder="Your Password" required>
                                    </div>
                                    <div class="col-sm-6 col-12 no-padding-left">
                                        <label class="label-width" for="c_password">Confirm Password</label>
                                        <input class="input-width" type="password" name="c_password" id="c_password" value="" placeholder="Confirm Password" required>
                                    </div>
                                    <div class="col-sm-12 col-12 no-padding-left">
                                        <label class="label-width" for="contact">Contact Number</label>
                                        <input class="input-width" type="tel" name="contact" id="contact" value="" placeholder="Your Contact" required>
                                    </div>
                                    <div class="col-sm-12 col-12 no-padding-left">
                                        <label class="label-width" for="address">Address</label>
                                        <input class="input-width" type="text" name="address" id="address" value="" placeholder="Your Address" required>
                                    </div>
                                    <div class="col-sm-4 col-12 no-padding-left">
                                        <label class="label-width" for="state">States</label>
                                        <select class="input-width" style="border: 1px solid #e6e6e6;" name="state" tabindex="2" required>
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
                                    <div class="col-sm-4 col-12 no-padding-left">
                                        <label class="label-width" for="city">City</label>
                                        <input class="input-width" type="text" name="city" id="city" value="" placeholder="Your City" required>
                                    </div>
                                    <div class="col-sm-4 col-12 no-padding-left">
                                        <label class="label-width" for="postcode">Zip Code</label>
                                        <input class="input-width" type="text" name="postcode" id="postcode" value="" placeholder="Your Zip Code" required>
                                    </div>
                                </p>
                                <div class="reg-style wrap-btn reg-button">
                                    <button class="btn btn-submit btn-bold reg-but" type="submit" name="btnAction">Register Now</button>
                                </div>
                            </form>
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
</body>

</html>