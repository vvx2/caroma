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
    </script>
</body>

</html>