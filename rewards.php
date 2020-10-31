<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    if ($login != 1) {
        echo "<script>window.location.replace('login.php')</script>";
        exit();
    }
    ?>
    <link rel="stylesheet" href="assets/css/rewards.css">
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
        <h1 class="page-title">Daily Check-In</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Rewards</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">

        <!-- Main content -->
        <div id="main-content" class="main-content bg_coin">
            <div class="container">

                <div class="row">
                    <div class="col-sm-3 col-12 center-profiles">
                        <div class="center">

                            <div class="profile">
                                <div class="image">
                                    <div class="circle-1"></div>
                                    <div class="circle-2"></div>
                                    <img src="https://100dayscss.com/codepen/jessica-potter.jpg" width="70" height="70" alt="Jessica Potter">
                                </div>

                                <div class="name">Jessica Potter</div>
                                <div class="job">Distributor</div>

                                <div class="actions">
                                    <button class="btn">Member Center</button>
                                    <button class="btn">Check In</button>
                                </div>
                            </div>

                            <div class="stats">
                                <div class="box">
                                    <span class="value">Total Order</span>
                                    <span class="parameter">37</span>
                                </div>
                                <div class="box">
                                    <span class="value">Total Coin</span>
                                    <span class="parameter">3,124</span>
                                </div>
                                <div class="box">
                                    <span class="value">Cart Item</span>
                                    <span class="parameter">12</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 col-12">
                        <div class="timeline">

                            <div class="timeline-item">
                                <div class="timeline-icon-checked"></div>
                                <div class="timeline-content">
                                    <p class="timeline-content-date">Today</h2>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon"></div>
                                <div class="timeline-content right">
                                    <p class="timeline-content-date">Day Two</h2>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon"></div>
                                <div class="timeline-content">
                                    <p class="timeline-content-date">Day Three</h2>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon"></div>
                                <div class="timeline-content right">
                                    <p class="timeline-content-date">Day Four</h2>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon"></div>
                                <div class="timeline-content">
                                    <p class="timeline-content-date">Day Friday</h2>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon"></div>
                                <div class="timeline-content right">
                                    <p class="timeline-content-date">Day Six</h2>
                                </div>
                            </div>

                            <div class="timeline-item">
                                <div class="timeline-icon"></div>
                                <div class="timeline-content">
                                    <p class="timeline-content-date">Day Seven</h2>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>





            </div>

        </div>

    </div>

    </div>

    <!-- FOOTER -->
    <footer id="footer" class="footer layout-02">
        <div class="footer-content background-footer-03">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-xs-12">
                        <section class="footer-item">
                            <a href="index.php" class="logo footer-logo"><img src="assets/images/caroma-logo.png" alt="Caroma Logo" width="135" height="34"></a>
                            <div class="footer-phone-info mode-02">
                                <i class="biolife-icon icon-head-phone"></i>
                                <p class="r-info">
                                    <span>Got Questions ?</span>
                                    <span class="number">+603 6272 5229</span>
                                </p>
                            </div>
                            <div class="contact-info-block footer-layout simple-info">
                                <h4 class="title">Contact info</h4>
                                <div class="info-item">
                                    <img src="assets/images/location-icon.png" width="22" height="26" alt="" class="icon">
                                    <p class="desc">No. 1&3, Jalan Tembaga SD 5/2D, Bandar Sri Damansara, 52200 Kuala Lumpur, Malaysia.</p>
                                </div>
                            </div>
                            <div class="biolife-social inline circle-hover">
                                <ul class="socials">
                                    <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                    <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-5 col-md-8 col-xs-12 lg-margin-top-14px md-margin-top-50px xs-margin-top-40px">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 col-xs-6">
                                <section class="footer-item">
                                    <h3 class="section-title">My Account</h3>
                                    <div class="wrap-custom-menu vertical-menu-2 bigger">
                                        <ul class="menu">
                                            <li><a href="login.php">Sign In</a></li>
                                            <li><a href="shopping-cart.php">View Cart</a></li>
                                            <li><a href="tracking">Track My Order</a></li>
                                            <li><a href="#">Help</a></li>
                                            <li><a href="news.php">Promotion</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12 sm-margin-top-0 xs-margin-top-40px">
                                <section class="footer-item">
                                    <h3 class="section-title">Information</h3>
                                    <div class="wrap-custom-menu vertical-menu-2 bigger">
                                        <ul class="menu">
                                            <li><a href="news.php">News</a></li>
                                            <li><a href="about-us.php">About Our Shop</a></li>
                                            <li><a href="shop.php">Secure Shopping</a></li>
                                            <li><a href="#">Delivery infomation</a></li>
                                            <li><a href="#">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                            <div class="col-lg-4 col-sm-4 col-xs-12 sm-margin-top-0 xs-margin-top-40px">
                                <section class="footer-item">
                                    <h3 class="section-title">Product</h3>
                                    <div class="wrap-custom-menu vertical-menu-2 bigger">
                                        <ul class="menu">
                                            <li><a href="shop.php">Ginger</a></li>
                                            <li><a href="shop.php">Honey</a></li>
                                            <li><a href="shop.php">Matcha</a></li>
                                            <li><a href="shop.php">Coconut</a></li>
                                            <li><a href="shop.php">Soy</a></li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12 lg-margin-top-14px md-margin-top-50px xs-margin-top-40px">
                        <section class="footer-item">
                            <h3 class="section-title">Browse My Mobile</h3>
                            <div class="instagram-block footer-layout">
                                <div class="lst-media">
                                    <img src="assets/images/partner/QR.png" width="80%" alt="Delivery">
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="footer-midle-pst v2 footer-midle-pstx">
                    <div class="wrap-custom-menu horizontal-menu-v2">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-xs-12">
                                <h3 class="section-title">Payment Methods</h3>
                                <div class="payment-methods">
                                    <img src="assets/images/partner/payment-white-1024x213.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-xs-12">
                                <h3 class="section-title">Delivery Services</h3>
                                <div class="payment-methods">
                                    <img src="assets/images/partner/delivery3-1.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-3 col-xs-12">
                                <h3 class="section-title">Verified by</h3>
                                <div class="payment-methods">
                                    <img src="assets/images/partner/haccp-n-logo1.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-midle-pst v2">
                    <div class="wrap-custom-menu horizontal-menu-v2">
                        <ul class="menu">
                            <li><a href="contact-us.php">Contact us</a></li>
                            <li><a href="about-us.php">About us</a></li>
                            <li><a href="#">Policy of shopping</a></li>
                            <li><a href="#">Customer services</a></li>
                            <li><a href="#">Terms of use</a></li>
                        </ul>
                    </div>
                    <p class="announce-text">Copyright © 2020 Caroma Malaysia All Rights Reserved. Powered by <a href="http://nkwhouse.com">NK Web House</a>.</p>
                </div>
            </div>
        </div>
    </footer>

    <!--Footer For Mobile-->
    <div class="mobile-footer">
        <div class="mobile-footer-inner">
            <div class="mobile-block block-menu-main">
                <a class="menu-bar menu-toggle btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                    <span class="fa fa-bars"></span>
                    <span class="text">Menu</span>
                </a>
            </div>
            <div class="mobile-block block-sidebar">
                <a class="menu-bar filter-toggle btn-toggle" data-object="open-mobile-filter" href="javascript:void(0)">
                    <i class="fa fa-sliders" aria-hidden="true"></i>
                    <span class="text">Sidebar</span>
                </a>
            </div>
            <div class="mobile-block block-minicart">
                <a class="link-to-cart" href="shopping-cart.php">
                    <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                    <span class="text">Cart</span>
                </a>
            </div>
            <div class="mobile-block block-global">
                <a class="menu-bar myaccount-toggle btn-toggle" data-object="global-panel-opened" href="javascript:void(0)">
                    <span class="fa fa-globe"></span>
                    <span class="text">Global</span>
                </a>
            </div>
        </div>
    </div>

    <div class="mobile-block-global">
        <div class="biolife-mobile-panels">
            <span class="biolife-current-panel-title">Global</span>
            <a class="biolife-close-btn" data-object="global-panel-opened" href="#">&times;</a>
        </div>
        <div class="block-global-contain">
            <div class="glb-item my-account">
                <b class="title">My Account</b>
                <ul class="list">
                    <li class="list-item"><a href="login.php">Login/register</a></li>
                    <li class="list-item"><a href="checkout.php">Checkout</a></li>
                    <li class="list-item"><a href="rewards.php">Rewards</a></li>
                </ul>
            </div>
            <div class="glb-item languages">
                <b class="title">Language</b>
                <ul class="list inline">
                    <li class="list-item"><a href="#"><img class="flag-imgs" src="assets/images/languages/malaysia-flag-icon-32.png" alt="flag"></a></li>
                    <li class="list-item"><a href="#"><img class="flag-imgs" src="assets/images/languages/united-states-of-america-flag-icon-32.png" alt="flag"></a></li>
                    <li class="list-item"><a href="#"><img class="flag-imgs" src="assets/images/languages/china-flag-icon-32.png" alt="flag"></a></li>
                </ul>
            </div>
        </div>
    </div>


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
    </script>
</body>

</html>