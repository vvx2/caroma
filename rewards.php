<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    if ($login != 1) {
        echo "<script>alert(\" Please Login.\");
        window.location.replace('login.php')</script>";
        exit();
    }
    if ($user_type != 1) {
        echo "<script>alert(\" Only For Normal User\");
        window.location.href='index.php';</script>";
        exit();
    }

    $tb = "users u left join user_address ua on u.id = ua.user_id";
    $col = "u.name as name,u.type as user_type,u.image as image, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state";
    $opt = 'u.id = ?';
    $arr = array($user_id);
    $result_user = $db->advwhere($col, $tb, $opt, $arr);
    $result_user = $result_user[0];

    $user_img = $result_user['image'];
    if ($user_img != "" || $user_img != NULL) {
        $image_path = "img/profile/" . $user_img;
    } else {
        $image_path = "my-account/dist/img/user1.png";
    }

    $user_order = $db->where("id", "orders", "users_id", $user_id);
    $user_cart = $db->where("id", "cart", "customer_id", $user_id);

    $count_order = count($user_order);
    $count_cart = count($user_cart);

    $user_point = $db->where("*", "user_point", "user_id", $user_id);
    if (count($user_point) != 0) {
        $point = $user_point[0]['point'];
    } else {
        $point = 0;
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
        <h1 class="page-title"><?php echo $lang['lang-reward']; ?></h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link"><?php echo $lang['lang-home']; ?></a></li>
                <li class="nav-item"><span class="current-page"><?php echo $lang['lang-reward']; ?></span></li>
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
                                    <img src="<?php echo $image_path; ?>" width="70" height="70" alt="Profile Picture">
                                </div>

                                <div class="name"><?php echo $result_user['name']; ?></div>
                                <div class="job"><?php echo $lang['lang-normal_user']; ?></div>

                                <div class="actions">
                                    <a class="btn" href="my-account/profile.php"><?php echo $lang['lang-member_center']; ?></a>
                                    <a class="btn" href="api/checkin.php"><?php echo $lang['lang-checkin']; ?></a>
                                </div>
                            </div>

                            <div class="stats">
                                <div class="box">
                                    <span class="value"><?php echo $lang['lang-total_order']; ?></span>
                                    <span class="parameter"><?php echo $count_order; ?></span>
                                </div>
                                <div class="box">
                                    <span class="value"><?php echo $lang['lang-total_point']; ?></span>
                                    <span class="parameter"><?php echo $point; ?></span>
                                </div>
                                <div class="box">
                                    <span class="value"><?php echo $lang['lang-cart_item']; ?></span>
                                    <span class="parameter"><?php echo $count_cart; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-9 col-12">
                        <div class="timeline">
                            <?php
                            $date = new DateTime(); // For today/now, don't pass an arg.
                            $today = $date->format("Y-m-d");
                            $date->modify("-1 day");
                            $yesterday = $date->format("Y-m-d");

                            $check_date = $user_point[0]["check_date"];

                            if ($check_date == $today) {
                                $icon_check = "timeline-icon-checked";
                                if ($user_point[0]["day_continue"] == 1) {
                                    $day_continue = $user_point[0]["day_continue"];
                                } else {
                                    $day_continue = $user_point[0]["day_continue"] - 1;
                                }
                            } else if ($check_date == $yesterday) {
                                $icon_check = "timeline-icon";
                                if ($user_point[0]["day_continue"] == 1) {
                                    $day_continue = $user_point[0]["day_continue"] + 1;
                                } else {
                                    if ($user_point[0]["day_continue"] >= 8) {
                                        $day_continue = 1;
                                    } else {
                                        $day_continue = $user_point[0]["day_continue"];
                                    }
                                }
                            } else {
                                $icon_check = "timeline-icon";
                                $day_continue = 1;
                            }
                            ?>

                            <div class="timeline-item">
                                <div class="<?php echo $icon_check; ?>"></div>
                                <div class="timeline-content">
                                    <p class="timeline-content-date">Today (+<?php echo $day_continue; ?> Points)</p>
                                </div>
                            </div>

                            <?php
                            $y = 1;
                            for ($i = 1; $i <= 6; $i++) {
                                if ($day_continue + $y >= 8) {
                                    $day_continue = 1;
                                    $y = 0;
                                }
                            ?>
                                <div class="timeline-item">
                                    <div class="timeline-icon"></div>
                                    <div class="timeline-content right">
                                        <p class="timeline-content-date">Day
                                            <?php
                                            echo $day_continue + $y;
                                            ?>
                                            (+
                                            <?php
                                            echo $day_continue + $y;
                                            $i++;
                                            $y++;
                                            ?> Points)
                                        </p>
                                    </div>
                                </div>
                                <div class="timeline-item">
                                    <div class="timeline-icon"></div>
                                    <div class="timeline-content">
                                        <p class="timeline-content-date">Day <?php echo $day_continue + $y; ?> (+<?php echo $day_continue + $y; ?> Points)</p>
                                    </div>
                                </div>

                            <?php
                                $y++;
                            }
                            ?>


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