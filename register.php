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
        <h1 class="page-title"><?php echo $lang['lang-member_registration']; ?></h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link"><?php echo $lang['lang-home']; ?></a></li>
                <li class="nav-item"><span class="current-page"><?php echo $lang['lang-member_registration']; ?></span></li>
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
                                <input type="hidden" name="token" id="form_token" value="<?php echo $token; ?>" />
                                <p class="form-row">
                                    <div class="col-sm-6 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="name"><?php echo $lang['lang-full_name']; ?></label>
                                        <input class="input-width" type="text" name="name" id="name" value="" placeholder="Your Name" >
                                        <span class="error_form" id="name_error_message"></span>
                                    </div>
                                    <div class="col-sm-6 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="email"><?php echo $lang['lang-email']; ?></label>
                                        <input class="input-width" type="email" name="email" id="email" value="" placeholder="Your email" >
                                        <span class="error_form" id="email_error_message"></span>
                                    </div>
                                    <div class="col-sm-6 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="password"><?php echo $lang['lang-password']; ?></label>
                                        <input class="input-width" type="password" name="password" id="password" value="" placeholder="Your Password" >
                                        <span class="error_form" id="password_error_message"></span>
                                    </div>
                                    <div class="col-sm-6 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="c_password"><?php echo $lang['lang-confirm_password']; ?></label>
                                        <input class="input-width" type="password" name="c_password" id="c_password" value="" placeholder="Confirm Password" >
                                        <span class="error_form" id="retype_password_error_message"></span>
                                    </div>
                                    <div class="col-sm-12 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="contact"><?php echo $lang['lang-contact_number']; ?></label>
                                        <input class="input-width" type="tel" name="contact" id="contact" value="" placeholder="Your Contact" >
                                        <span class="error_form" id="phone_error_message"></span>
                                    </div>
                                    <div class="col-sm-12 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="address"><?php echo $lang['lang-address']; ?></label>
                                        <input class="input-width" type="text" name="address" id="address" value="" placeholder="Your Address" >
                                        <span class="error_form" id="address_error_message"></span>
                                    </div>
                                    <div class="col-sm-4 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="state"><?php echo $lang['lang-state']; ?></label>
                                        <select class="input-width error-select" style="border: 1px solid #e6e6e6;" name="state" id="state" tabindex="2" >
                                            <option data-option="" selected value="">Select State</option>
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
                                        <span class="error_form" id="state_error_message"></span>
                                    </div>
                                    <div class="col-sm-4 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="city"><?php echo $lang['lang-city']; ?></label>
                                        <input class="input-width" type="text" name="city" id="city" value="" placeholder="Your City" >
                                        <span class="error_form" id="city_error_message"></span>
                                    </div>
                                    <div class="col-sm-4 col-12 no-padding-left reg-height">
                                        <label class="label-width" for="postcode"><?php echo $lang['lang-zip_code']; ?></label>
                                        <input class="input-width" type="text" name="postcode" maxlength="5" onkeypress=" return isNumber(event)" id="postcode" value="" placeholder="Your Zip Code" >
                                        <span class="error_form" id="zip_error_message"></span>
                                    </div>
                                    <div class="col-sm-12 col-12 no-padding-left reg-height reg-style wrap-btn reg-button">
                                        <button class="btn btn-submit btn-bold reg-but" type="submit" name="btnAction"><?php echo $lang['lang-register_now']; ?></button>
                                    </div>
                                </p>
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
    <script src="assets/js/register_validation.js"></script>
    <script src="assets/js/numberic.js"></script>
    <script src="cart.js"></script>
    <script>
        $(document).ready(function() {
            LoadCart();
        });
    </script>
</body>

</html>