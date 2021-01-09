<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    $time = date('Y-m-d H:i:s');
    if ($user_type == 3) {
        //get distributor id that dealer under with
        $table = 'user_dealer';
        $col = "*";
        $opt = 'user_id =?';
        $arr = array($user_id);
        $dealer = $db->advwhere($col, $table, $opt, $arr);
        $under_distributor = $dealer[0]['under_distributor'];
        $admin_id = $under_distributor;
    }
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

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            <!-- Block 01: Main slide block-->
            <div class="main-slide block-slider">
                <ul class="biolife-carousel nav-none-on-mobile" data-slick='{"arrows": true, "autoplaySpeed": 5000, "autoplay": true, "dots": false, "slidesMargin": 0, "slidesToShow": 1, "infinite": true, "speed": 800}'>
                    <li>
                        <div class="slide-contain slider-opt03__layout01 mode-02 slide-bgr-01">
                            <div class="media slidersz"></div>
                            <div class="text-content">
                                <i class="first-line">Health & Natural</i>
                                <h3 class="second-line">Caroma Malaysia</h3>
                                <p class="third-line">Drink life to the fullest with caroma</p>
                                <p class="buttons">
                                    <a href="shop.php" class="btn btn-bold">Shop now</a>
                                    <a href="news.php" class="btn btn-thin">Promotion</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="slide-contain slider-opt03__layout01 mode-02 slide-bgr-02">
                            <div class="media slidersz"></div>
                            <div class="text-content">
                                <i class="first-line">Health & Natural</i>
                                <h3 class="second-line">Caroma Malaysia</h3>
                                <p class="third-line">Drink life to the fullest with caroma</p>
                                <p class="buttons">
                                    <a href="shop.php" class="btn btn-bold">Shop now</a>
                                    <a href="news.php" class="btn btn-thin">Promotion</a>
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="slide-contain slider-opt03__layout01 mode-02 slide-bgr-03">
                            <div class="media slidersz"></div>
                            <div class="text-content">
                                <i class="first-line">Health & Natural</i>
                                <h3 class="second-line">Caroma Malaysia</h3>
                                <p class="third-line">Drink life to the fullest with caroma</p>
                                <p class="buttons">
                                    <a href="shop.php" class="btn btn-bold">Shop now</a>
                                    <a href="news.php" class="btn btn-thin">Promotion</a>
                                </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!--Block 05: Banner promotion 02-->
            <div class="banner-promotion-02 z-index-20">
                <div class="biolife-banner promotion2 biolife-banner__promotion2 advance">
                    <div class="banner-contain">
                        <div class="container">
                            <div class="media"></div>
                            <div class="text-content">
                                <span class="second-line"><i>Welcome to Caroma</i></span>
                                <p class="third-line">Caroma loves to bring for you naturally and easily. We dedicate you and your family the best of organic beverage. Be with Caroma to get natural taste and stay healthy always.</p>
                                <p class="buttons">
                                    <a href="about-us.php" class="btn btn-bold">Read More</a>
                                    <a href="shop.php" class="btn btn-thin">Shop Now</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Block 02: Banner-->
            <div class="special-slide fresh-content">
                <div class="container">
                    <div class="biolife-service type01 biolife-service__type01 sm-margin-top-0 xs-margin-top-45px">
                        <b class="txt-show-01">100%Nature</b>
                        <i class="txt-show-02">Fresh & Healthy</i>
                        <ul class="services-list">
                            <li>
                                <div class="service-inner">
                                    <span class="biolife-icon biolife-icon-types icon-leaf2"></span>
                                    <span class="srv-name" href="#">100% Natural</span>
                                    <p class="srv-details">We only use the freshest home-grown Bentong ginger from our plantation for <br>our beverages.</p>
                                </div>
                            </li>
                            <li>
                                <div class="service-inner">
                                    <span class="biolife-icon biolife-icon-types icon-shield"></span>
                                    <span class="srv-name" href="#">Best Quality</span>
                                    <p class="srv-details">Our products are filtered carefully before going with clients. Best quality is a must at Caroma for any categories.</p>
                                </div>
                            </li>
                            <li>
                                <div class="service-inner">
                                    <span class="biolife-icon biolife-icon-types icon-heathly"></span>
                                    <span class="srv-name" href="#">Healthy</span>
                                    <p class="srv-details">Our ingredient is ginger, which is contains high levels of vitamin C, magnesium and other minerals that are beneficial to your overall health.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <!-- Block 02: Product Tab-->
            <div class="product-tab z-index-20 sm-margin-top-61px xs-margin-top-80px">
                <div class="container">

                    <div class="biolife-title-box biolife-title-box__icon-at-top-style hidden-icon-on-mobile">
                        <span class="icon-at-top biolife-icon icon-organic"></span>
                        <span class="subtitle">All the best item for You</span>
                        <h3 class="main-title">Bestseller Products</h3>
                    </div>

                    <div class="biolife-tab biolife-tab-contain sm-margin-top-34px">
                        <div class="tab-head tab-head__icon-top-layout icon-top-layout type-02">
                            <ul class="tabs md-margin-bottom-35-im sm-margin-bottom-57-im">
                                <?php
                                $col = "c.id as c_id, ct.name as ct_name";
                                $tb = "category c left join category_translation ct on c.id = ct.category_id";
                                $opt = 'ct.language =? ORDER BY c.date_modified DESC';
                                $arr = array($language);
                                $result_category = $db->advwhere($col, $tb, $opt, $arr);
                                $i = 1;

                                foreach ($result_category as $cate) {
                                    if ($i == 1) {
                                        $active_display = "active";
                                    } else {
                                        $active_display = "";
                                    }
                                    $i++;

                                    $col = "name";
                                    $tb = " category_translation ";
                                    $opt = 'category_id =? && language =?';
                                    $arr = array($cate['c_id'], "en");
                                    $category_name = $db->advwhere($col, $tb, $opt, $arr);
                                ?>
                                    <li class="tab-element <?php echo $active_display; ?>">
                                        <a href="#category_<?php echo $cate['c_id']; ?>" class="tab-link"><span class="biolife-icon icon-<?php echo strtolower($category_name[0]["name"]) ?>"></span><?php echo $cate['ct_name']; ?></a>
                                    </li>

                                <?php } ?>

                                <!-- <li class="tab-element">
                                    <a href="#tab01_2nd" class="tab-link"><span class="biolife-icon icon-coffee"></span>Coffee</a>
                                </li>
                                <li class="tab-element">
                                    <a href="#tab01_3rd" class="tab-link"><span class="biolife-icon icon-matcha"></span>Matcha</a>
                                </li>
                                <li class="tab-element">
                                    <a href="#tab01_4th" class="tab-link"><span class="biolife-icon icon-coconut"></span>Coconut</a>
                                </li>
                                <li class="tab-element">
                                    <a href="#tab01_5th" class="tab-link"><span class="biolife-icon icon-soy"></span>Soy</a>
                                </li>
                                <li class="tab-element">
                                    <a href="#tab01_6th" class="tab-link"><span class="biolife-icon icon-chocolate"></span>Chocolate</a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="tab-content">
                            <?php
                            $col = "c.id as c_id, ct.name as ct_name";
                            $tb = "category c left join category_translation ct on c.id = ct.category_id";
                            $opt = 'ct.language =? ORDER BY c.date_modified DESC';
                            $arr = array($language);
                            $result_category = $db->advwhere($col, $tb, $opt, $arr);
                            $i = 1;
                            foreach ($result_category as $cate) {
                                if ($i == 1) {
                                    $active_display = "active";
                                } else {
                                    $active_display = "";
                                }
                                $i++;
                            ?>
                                <div id="category_<?php echo $cate['c_id']; ?>" class="tab-contain <?php echo $active_display; ?>">
                                    <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile eq-height-contain" data-slick='{"rows":1 ,"arrows":true,"dots":false,"infinite":true,"speed":400,"slidesMargin":10,"slidesToShow":4, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "rows":2, "slidesMargin":20}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "rows":2 ,"slidesMargin":15}}]}'>
                                        <?php

                                        $sqlorder = "rating DESC"; //this "rating" is count by quantity
                                        $offset = 0;
                                        if ($user_type == 3) {

                                            $filter_table = "";
                                            $filter_opt = " ";
                                            $filter_arr = array($cate['c_id'], $admin_id, $language, $user_type, $language, 1);

                                            $col = "*,dp.stock as dis_stock, p.stock as admin_stock, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                                            $tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                                            $opt = 'p.category = ? && dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder;
                                            $arr = $filter_arr;
                                            $hot_result = $db->advwhere($col, $tb, $opt, $arr);
                                        } else {

                                            $filter_table = "";
                                            $filter_opt = " ";
                                            $filter_arr = array($cate['c_id'], $language, $user_type, $language, 1);
                                            $check_sql = "none";

                                            $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                                            $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                                            $opt = 'p.category = ? && pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder;
                                            $arr = $filter_arr;
                                            $hot_result = $db->advwhere($col, $tb, $opt, $arr);
                                        }
                                        foreach ($hot_result as $hot) {

                                            $normal_price = $hot['price'];
                                            if ($user_type == 1) {
                                                $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                                $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                                $opt = 'prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
                                                $arr = array($hot['p_id'], $time, $time);
                                                $check_promotion_prodcut = $db->advwhere($col, $tb, $opt, $arr);

                                                if (count($check_promotion_prodcut) != 0) {
                                                    $check_promotion_prodcut = $check_promotion_prodcut[0];
                                                    if ($check_promotion_prodcut["type"] == 1) {
                                                        $promo_price = $normal_price - $check_promotion_prodcut["amt"];
                                                    } else {
                                                        $promo_price = $normal_price - ($normal_price * $check_promotion_prodcut["percentage"] / 100);
                                                    }
                                                    $hidden_promo = "";
                                                    $price_display = $promo_price;
                                                } else {
                                                    $hidden_promo = "hidden";
                                                    $price_display = $normal_price;
                                                }
                                            } else {
                                                $hidden_promo = "hidden";
                                                $price_display = $normal_price;
                                            }

                                        ?>

                                            <li class="product-item">
                                                <div class="contain-product layout-default">
                                                    <div class="product-thumb">
                                                        <a href="products-detail.php?p=<?php echo $hot['p_id']; ?>" class="link-to-product">
                                                            <img src="img/product/<?php echo $hot['image']; ?>" alt="<?php echo $hot['ct_name']; ?>" width="270" height="270" class="product-thumnail">
                                                        </a>
                                                        <a class="lookup btn_call_quickview" href="products-detail.php?p=<?php echo $hot['p_id']; ?>"><i class="biolife-icon icon-search"></i></a>
                                                    </div>
                                                    <div class="info">
                                                        <b class="categories"><?php echo $hot['ct_name']; ?></b>
                                                        <h4 class="product-title"><a href="products-detail.php?p=<?php echo $hot['p_id']; ?>" class="pr-name"><?php echo $hot['ct_name']; ?></a></h4>
                                                        <div class="price ">
                                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($price_display, 2); ?></span></ins>
                                                            <del class="<?php echo $hidden_promo; ?>"><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($normal_price, 2); ?></span></del>
                                                        </div>
                                                        <div class="slide-down-box">
                                                            <p class="message">All products are carefully selected to ensure food safety.</p>
                                                            <div class="buttons">
                                                                <button class="btn add-to-cart-btn btnAddCart" style="width: 100%;" data-value="<?php echo $hot['p_id']; ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        <?php
                                        }
                                        ?>

                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>

            <!--Block 06: Products-->
            <div class="Product-box sm-margin-top-96px xs-margin-top-0">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-6">
                            <div class="advance-product-box">
                                <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                                    <h3 class="title">Deals of the day</h3>
                                </div>
                                <ul class="products biolife-carousel nav-top-right nav-none-on-mobile" data-slick='{"arrows":true, "autoplaySpeed": 5000, "autoplay": true, "dots":false, "infinite":false, "speed":400, "slidesMargin":30, "slidesToShow":1}'>
                                    <?php



                                    $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                    $tb = "promotion";
                                    $opt = 'start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
                                    $arr = array($time, $time);
                                    $promotion_result = $db->advwhere($col, $tb, $opt, $arr);

                                    if ($user_type == 1) {


                                        if (count($promotion_result) == 0) {
                                            echo "<p class='title text-info'>PROMOTION IS COMMING SOON</p>";
                                        } else {
                                            $promotion_result = $promotion_result[0];

                                            $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                                            $tb = " promotion_product prp left join product p on prp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id ";
                                            $opt = 'prp.promotion_id = ? && pt.language = ? && pp.type =? && ct.language =? && p.status =? ORDER BY rating DESC LIMIT 6';
                                            $arr = array($promotion_result['id'], $language, $user_type, $language, 1);
                                            $promotion_product_result = $db->advwhere($col, $tb, $opt, $arr);



                                            foreach ($promotion_product_result as $promo) {


                                    ?>

                                                <li class="product-item">
                                                    <div class="contain-product deal-layout contain-product__deal-layout">
                                                        <div class="product-thumb">
                                                            <a href="products-detail.php?p=<?php echo $promo['p_id']; ?>" class="link-to-product">
                                                                <img src="img/product/<?php echo $promo['image']; ?>" alt="<?php echo $promo['ct_name']; ?>" width="330" height="330" class="product-thumnail">
                                                            </a>
                                                            <div class="labels">
                                                                <span class="sale-label">
                                                                    <?php
                                                                    $normal_price = $promo['price'];
                                                                    if ($promotion_result["type"] == 1) {

                                                                        $promo_price = $normal_price - $promotion_result["amt"];
                                                                        echo "- RM" . number_format($promotion_result["amt"], 2);
                                                                    } else {

                                                                        $promo_price = $normal_price - ($normal_price * $promotion_result["percentage"] / 100);
                                                                        echo $promotion_result["percentage"] . "%";
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="info">
                                                            <div class="biolife-countdown" data-datetime="<?php echo $promotion_result['new_end_date']; ?>"></div>
                                                            <b class="categories">Fresh Fruit</b>
                                                            <h4 class="product-title"><a href="products-detail.php?p=<?php echo $promo['p_id']; ?>" class="pr-name">National Fresh Fruit</a></h4>
                                                            <div class="price ">
                                                                <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($promo_price, 2); ?></span></ins>
                                                                <del><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($normal_price, 2); ?></span></del>
                                                            </div>
                                                            <div class="slide-down-box">
                                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                                <div class="buttons">
                                                                    <button class="btn add-to-cart-btn btnAddCart" style="width: 100%;" data-value="<?php echo $promo['p_id']; ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                    <?php
                                            }
                                        }
                                    } else {
                                        echo "<p class='title text-info'>PROMOTION ONLY FOR NORMAL USER</p>";
                                    }
                                    ?>



                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-sm-6">
                            <div class="advance-product-box">
                                <div class="biolife-title-box bold-style biolife-title-box__bold-style">
                                    <h3 class="title">Top Rated Products</h3>
                                </div>
                                <ul class="products biolife-carousel eq-height-contain nav-center-03 nav-none-on-mobile row-space-29px" data-slick='{"rows":2,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":30,"slidesToShow":2,"responsive":[{"breakpoint":1200,"settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":992, "settings":{ "rows":2, "slidesToShow": 1}},{"breakpoint":768, "settings":{ "rows":2, "slidesToShow": 2}},{"breakpoint":500, "settings":{ "rows":2, "slidesToShow": 1}}]}'>

                                    <?php

                                    $sqlorder = "rating DESC"; //this "rating" is count by quantity
                                    $offset = 0;
                                    if ($user_type == 3) {

                                        $filter_table = "";
                                        $filter_opt = " ";
                                        $filter_arr = array($admin_id, $language, $user_type, $language, 1);

                                        $col = "*,dp.stock as dis_stock, p.stock as admin_stock, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating, rate.rate_total as rate_total";
                                        $tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(rate)) as rating, count(product_id) as rate_total FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id ";
                                        $opt = 'dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =? ORDER BY rating DESC LIMIT 8';
                                        $arr = $filter_arr;
                                        $top_result = $db->advwhere($col, $tb, $opt, $arr);
                                    } else {

                                        $filter_table = "";
                                        $filter_opt = " ";
                                        $filter_arr = array($language, $user_type, $language, 1);
                                        $check_sql = "none";

                                        $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating, rate.rate_total as rate_total";
                                        $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating, count(product_id) as rate_total FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                                        $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 8 OFFSET ' . $offset . '';
                                        $arr = $filter_arr;
                                        $top_result = $db->advwhere($col, $tb, $opt, $arr);
                                    }
                                    foreach ($top_result as $top) {

                                        if ($top['rating'] == NULL) {
                                            $top['rating'] = 5;
                                        }

                                        $rate_per = ($top['rating'] / 5) * 100;

                                        $normal_price = $top['price'];
                                        if ($user_type == 1) {
                                            $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                            $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                            $opt = 'prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
                                            $arr = array($top['p_id'], $time, $time);
                                            $check_promotion_prodcut = $db->advwhere($col, $tb, $opt, $arr);

                                            if (count($check_promotion_prodcut) != 0) {
                                                $check_promotion_prodcut = $check_promotion_prodcut[0];
                                                if ($check_promotion_prodcut["type"] == 1) {
                                                    $promo_price = $normal_price - $check_promotion_prodcut["amt"];
                                                } else {
                                                    $promo_price = $normal_price - ($normal_price * $check_promotion_prodcut["percentage"] / 100);
                                                }
                                                $hidden_promo = "";
                                                $price_display = $promo_price;
                                            } else {
                                                $hidden_promo = "hidden";
                                                $price_display = $normal_price;
                                            }
                                        } else {
                                            $hidden_promo = "hidden";
                                            $price_display = $normal_price;
                                        }

                                    ?>

                                        <li class="product-item">
                                            <div class="contain-product right-info-layout contain-product__right-info-layout">
                                                <div class="product-thumb">
                                                    <a href="products-detail.php?p=<?php echo $top['p_id']; ?>" class="link-to-product">
                                                        <img src="img/product/<?php echo $top['image']; ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <b class="categories"><?php echo $top['ct_name']; ?></b>
                                                    <h4 class="product-title"><a href="products-detail.php?p=<?php echo $top['p_id']; ?>" class="pr-name"><?php echo $top['pt_name']; ?></a></h4>
                                                    <div class="price ">
                                                        <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($price_display, 2); ?></span></ins>
                                                        <del class="<?php echo $hidden_promo; ?>"><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($normal_price, 2); ?></span></del>
                                                    </div>
                                                    <div class="rating">
                                                        <p class="star-rating"><span class="width-percent" style="width: <?php echo $rate_per; ?>%;">></span></p>
                                                        <span class="review-count">(<?php echo number_format($top['rate_total'], 0); ?> Reviews)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    <?php
                                    }
                                    ?>




                                </ul>
                                <div class="biolife-banner style-01 biolife-banner__style-01 xs-margin-top-80px-im sm-margin-top-30px-im">
                                    <div class="banner-contain">
                                        <div class="text-content">
                                            <span class="first-line color-whites">Daily Fresh</span>
                                            <b class="second-line color-whites">Natural</b>
                                            <i class="third-line color-whites">Fresh Food</i>
                                            <span class="fourth-line color-whites">Premium Quality</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Block 05: Banner Promotion-->
            <div class="banner-promotion xs-margin-top-0 sm-margin-top-60px xs-margin-top-100">
                <div class="biolife-banner promotion6 biolife-banner__promotion6">
                    <div class="banner-contain">
                        <div class="media">
                            <div class="img-moving position-1">
                                <a href="#" class="banner-link">
                                    <img src="assets/images/custom/test.png" alt="img msv">
                                </a>
                            </div>
                        </div>
                        <div class="text-content">
                            <i class="text1">Sumer Fruit</i>
                            <b class="text2">100% Pure Natural Fruit Juice</b>
                            <p class="buttons">
                                <a href="shop.php" class="btn btn-thin">Shop Now</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Block 10: Brands-->
            <div class="biolife-brand-block sm-padding-top-14px xs-margin-bottom-90px sm-margin-top-50px xs-margin-top-90px center-align-on-mobile">
                <div class="container">
                    <ul class="biolife-carousel add-border-on-mobile nav-center nav-none-on-mobile" data-slick='{"rows":1, "autoplaySpeed": 3000, "autoplay": true, "arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 5}},{"breakpoint":992, "settings":{ "slidesToShow": 4}},{"breakpoint":768, "settings":{ "slidesToShow": 3}},{"breakpoint":600, "settings":{ "slidesToShow": 2}},{"breakpoint":480, "settings":{ "slidesToShow": 1}}]}'>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/aa-pharmacy-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/ascen-pharmacy-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/be-pharmacy-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/big-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/camy-babyland-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/cold-storage-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/joymix-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/lazada-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/mercato-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/m-plus-pharmacy.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/multicare-pharmacy-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/presto-mall-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/qoo10-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/robinson-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/shopee-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/sogo-kl-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/the-natural-marketplace-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/tmc-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="link-brand-item">
                                <img src="assets/images/partner/village-grocer-01.png" width="234" height="121" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>

    <?php
    require_once('inc/footer.php');
    require_once('inc/mobile_footer.php');
    ?>

    <!--Quickview Popup-->
    <!-- <div id="biolife-quickview-block" class="biolife-quickview-block">
        <div class="quickview-container">
            <a href="#" class="btn-close-quickview" data-object="open-quickview-block"><span class="biolife-icon icon-close-menu"></span></a>
            <div class="biolife-quickview-inner">
                <div class="media">
                    <ul class="biolife-carousel quickview-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".quickview-nav"}'>
                        <li><img src="assets/images/details-product/detail_01.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_02.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_03.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_04.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_05.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_06.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_07.jpg" alt="" width="500" height="500"></li>
                    </ul>
                    <ul class="biolife-carousel quickview-nav" data-slick='{"arrows":true,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":3,"slidesToScroll":1,"asNavFor":".quickview-for"}'>
                        <li><img src="assets/images/details-product/thumb_01.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_02.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_03.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_04.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_05.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_06.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_07.jpg" alt="" width="88" height="88"></li>
                    </ul>
                </div>
                <div class="product-attribute">
                    <h4 class="title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                    <div class="rating">
                        <p class="star-rating"><span class="width-80percent"></span></p>
                    </div>

                    <div class="price price-contain">
                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                    </div>
                    <p class="excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel maximus lacus. Duis ut mauris eget justo dictum tempus sed vel tellus.</p>
                    <div class="from-cart">
                        <div class="qty-input">
                            <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                            <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                            <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        </div>
                        <div class="buttons">
                            <a href="#" class="btn add-to-cart-btn btn-bold">add to cart</a>
                        </div>
                    </div>

                    <div class="product-meta">
                        <div class="product-atts">
                            <div class="product-atts-item">
                                <b class="meta-title">Categories:</b>
                                <ul class="meta-list">
                                    <li><a href="#" class="meta-link">Milk & Cream</a></li>
                                    <li><a href="#" class="meta-link">Fresh Meat</a></li>
                                    <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                                </ul>
                            </div>
                            <div class="product-atts-item">
                                <b class="meta-title">Tags:</b>
                                <ul class="meta-list">
                                    <li><a href="#" class="meta-link">food theme</a></li>
                                    <li><a href="#" class="meta-link">organic food</a></li>
                                    <li><a href="#" class="meta-link">organic theme</a></li>
                                </ul>
                            </div>
                            <div class="product-atts-item">
                                <b class="meta-title">Brand:</b>
                                <ul class="meta-list">
                                    <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                                </ul>
                            </div>
                        </div>
                        <span class="sku">SKU: N/A</span>
                        <div class="biolife-social inline add-title">
                            <span class="fr-title">Share:</span>
                            <ul class="socials">
                                <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

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