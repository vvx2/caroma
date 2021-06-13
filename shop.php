<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    $time = date('Y-m-d H:i:s');


    //when user type is dealer, admin id will be distributor id - to identify the order belong who
    if ($user_type == 3) {
        //get distributor id that dealer under with
        $table = 'user_dealer';
        $col = "*";
        $opt = 'user_id =?';
        $arr = array($user_id);
        $dealer = $db->advwhere($col, $table, $opt, $arr);
        $under_distributor = $dealer[0]['under_distributor'];
        $admin_id = $under_distributor;


        if (isset($_REQUEST["category"]) && $_REQUEST["category"] != 0) {
            $filter_table = " left join category c on p.category = c.id";
            $filter_opt = " && c.status =? && p.category =? ";
            $filter_arr = array($admin_id, $language, $user_type, $language, 1, 1, $_REQUEST["category"]);
        } else if ((isset($_REQUEST["price_from"]) && isset($_REQUEST["price_to"])) && ($_REQUEST["price_from"] != 0 && $_REQUEST["price_to"] != 0)) {
            $filter_table = "";
            $filter_opt = " && pp.price BETWEEN ? AND ? ";
            $filter_arr = array($admin_id, $language, $user_type, $language, 1, $_REQUEST["price_from"], $_REQUEST["price_to"]);
        } else {
            $filter_table = "";
            $filter_opt = " ";
            $filter_arr = array($admin_id, $language, $user_type, $language, 1);
        }

        $col = "*,dp.stock as dis_stock, p.stock as admin_stock, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
        $tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
        $opt = 'dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =?' . $filter_opt;
        $arr = $filter_arr;
        $count_product_result = $db->advwhere($col, $tb, $opt, $arr);
    } else {

        if (isset($_REQUEST["category"]) && $_REQUEST["category"] != 0) {
            $filter_table = " left join category c on p.category = c.id";
            $filter_opt = " && c.status =? && p.category =? ";
            $filter_arr = array($language, $user_type, $language, 1, 1, $_REQUEST["category"]);
            $check_sql = "category";
        } else if ((isset($_REQUEST["price_from"]) && isset($_REQUEST["price_to"])) && ($_REQUEST["price_to"] != 0)) {
            $filter_table = "";
            $filter_opt = " && pp.price BETWEEN ? AND ? ";
            $filter_arr = array($language, $user_type, $language, 1, $_REQUEST["price_from"], $_REQUEST["price_to"]);
            $check_sql = "price";
        } else {
            $filter_table = "";
            $filter_opt = " ";
            $filter_arr = array($language, $user_type, $language, 1);
            $check_sql = "none";
        }

        $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
        if (isset($_REQUEST["new_arrival"]) && $_REQUEST["new_arrival"] == 1) {
            $tb = " new_arrival na left join product p on na.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
        } else {
            $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
        }
        $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt;
        $arr = $filter_arr;
        $count_product_result = $db->advwhere($col, $tb, $opt, $arr);
    }

    $count_product_result = count($count_product_result);
    ?>

    <style>
        .pagination>.active>a,
        .pagination>.active>span,
        .pagination>.active>a:hover,
        .pagination>.active>span:hover,
        .pagination>.active>a:focus,
        .pagination>.active>span:focus {
            z-index: 3;
            color: #fff;
            background-color: #005f2a;
            border-color: #005f2a;
        }
    </style>
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
        <h1 class="page-title"><?php echo $lang['lang-our_store']; ?></h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link"><?php echo $lang['lang-home']; ?></a></li>
                <li class="nav-item"><span class="current-page"><?php echo $lang['lang-shop']; ?></span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain category-page left-sidebar">
        <div class="container">
            <div class="row">
                <!-- Main content -->
                <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">

                    <div class="block-item recently-products-cat md-margin-bottom-39">
                        <h3 class="title-product-content"><?php echo $lang['lang-hot_sales']; ?></h3>
                        <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile product_display_hot" data-slick='{"rows":1,"arrows":true, "autoplaySpeed": 1500, "autoplay": true, "dots":false,"infinite":true,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":30}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>

                            <?php

                            $sqlorder = "rating DESC"; //this "rating" is count by quantity
                            $offset = 0;
                            if ($user_type == 3) {

                                $filter_table = "";
                                $filter_opt = " ";
                                $filter_arr = array($admin_id, $language, $user_type, $language, 1);

                                $col = "*,dp.stock as dis_stock, p.stock as admin_stock, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                                $tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                                $opt = 'dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 10 OFFSET ' . $offset . '';
                                $arr = $filter_arr;
                                $hot_result = $db->advwhere($col, $tb, $opt, $arr);
                            } else {

                                $filter_table = "";
                                $filter_opt = " ";
                                $filter_arr = array($language, $user_type, $language, 1);
                                $check_sql = "none";

                                $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                                $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                                $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 10 OFFSET ' . $offset . '';
                                $arr = $filter_arr;
                                $hot_result = $db->advwhere($col, $tb, $opt, $arr);
                            }
                            foreach ($hot_result as $hot) {

                                $normal_price = $hot['price'];
                                if ($user_type == 1) {
                                    $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                    $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                    $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified DESC';
                                    $arr = array(1, $hot['p_id'], $time, $time);
                                    $check_promotion_prodcut = $db->advwhere($col, $tb, $opt, $arr);

                                    if (count($check_promotion_prodcut) != 0) {
                                        $check_promotion_prodcut = $check_promotion_prodcut[0];
                                        if ($check_promotion_prodcut["type"] == 1) {
                                            $promo_price = $normal_price - $check_promotion_prodcut["amt"];
                                            $discount_type = "- RM" . number_format($check_promotion_prodcut["amt"], 2);
                                        } else {
                                            $promo_price = $normal_price - ($normal_price * $check_promotion_prodcut["percentage"] / 100);
                                            $discount_type = "Discount " . $check_promotion_prodcut["percentage"] . "%";
                                        }
                                        if ($promo_price <= 0) {
                                            $promo_price = 0;
                                        }
                                        $is_promo = 1;
                                        $price_display = $promo_price;
                                        $del_hidden = "class=''";
                                    } else {
                                        $discount_type = "";
                                        $is_promo = 0;
                                        $price_display = $normal_price;
                                        $del_hidden = "class='hidden'";
                                    }
                                } else {
                                    $discount_type = "";
                                    $is_promo = 0;
                                    $price_display = $normal_price;
                                    $del_hidden = "class='hidden'";
                                }

                            ?>
                                <li class="product-item">
                                    <div class="contain-product layout-02">
                                        <div class="product-thumb">
                                            <a href="products-detail.php?p=<?php echo $hot['p_id']; ?>" class="link-to-product">
                                                <img src="img/product/<?php echo $hot['image']; ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                            <div class="labels">
                                                <span class="sale-label">
                                                    <?php
                                                    echo $discount_type;
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="info">
                                            <b class="categories"><?php echo $hot['ct_name']; ?></b>
                                            <h4 class="product-title"><a href="products-detail.php?p=<?php echo $hot['p_id']; ?>" class="pr-name"><?php echo $hot['pt_name']; ?></a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($price_display, 2); ?></span></ins>
                                                <del <?php echo $del_hidden; ?>><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($normal_price, 2); ?></span></del>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            <?php
                            }
                            ?>

                        </ul>
                    </div>

                    <div class="product-category grid-style">

                        <div id="top-functions-area" class="top-functions-area">
                            <div class="flt-item to-left group-on-mobile">
                                <span class="flt-title"><?php echo $lang['lang-refine']; ?></span>
                            </div>
                            <div class="flt-item to-right">
                                <span class="flt-title"><?php echo $lang['lang-sort']; ?></span>
                                <div class="wrap-selectors">
                                    <div class="selector-item orderby-selector">
                                        <select name="orderby" class="orderby" aria-label="Shop order">
                                            <option value="popularity" selected="selected"><?php echo $lang['lang-popularity']; ?></option>
                                            <option value="rating"><?php echo $lang['lang-average']; ?></option>
                                            <option value="date"><?php echo $lang['lang-newness']; ?></option>
                                            <option value="price"><?php echo $lang['lang-low_price']; ?></option>
                                            <option value="price-desc"><?php echo $lang['lang-high_price']; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="margin:15px 5px;"> <!--- Search Box --->
                            <form class="form-search" method="get" action="#">
                                <div class="row">
                                    <div class="col-sm-10 col-xs-8">
                                        <input type="search" name="search" placeholder="search your items here for..">
                                    </div>
                                    <div class="col-sm-2 col-xs-2">
                                        <button type="submit">Search</button>
                                    </div> 
                                </div>  
                            </form>
                        </div>
                        <input value='0' id='get_total_product' hidden>
                        <div class="row">
                            <ul class="products-list product_display">

                                <!--
                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="products-detail.php" class="link-to-product">
                                                <img src="assets/images/products/p-16.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                            </a>
                                        </div>
                                        <div class="info">
                                            <b class="categories">Fresh Fruit</b>
                                            <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                            <div class="price">
                                                <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                                <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                            </div>
                                            <div class="shipping-info">
                                                <p class="shipping-day">3-Day Shipping</p>
                                                <p class="for-today">Pree Pickup Today</p>
                                            </div>
                                            <div class="slide-down-box">
                                                <p class="message">All products are carefully selected to ensure food safety.</p>
                                                <div class="buttons">

                                                    <a href="products-detail.php" class="btn add-to-cart-btn"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li> 
                                -->

                            </ul>
                        </div>

                        <hr>
                        <br>
                        <div class="text-center">
                            <ul class=" panigation-contain" id="pagination"></ul>
                        </div>
                        <br>

                    </div>

                </div>
                <!-- Sidebar -->
                <aside id="sidebar" class="sidebar col-lg-3 col-md-4 col-sm-12 col-xs-12">
                    <div class="biolife-mobile-panels">
                        <span class="biolife-current-panel-title"><?php echo $lang['lang-side_bar']; ?></span>
                        <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
                    </div>
                    <div class="sidebar-contain">
                        <div class="widget biolife-filter">
                            <h4 class="wgt-title"><?php echo $lang['lang-category']; ?></h4>
                            <div class="wgt-content">

                                <ul class="cat-list">

                                    <li class="cat-list-item"><a href="shop.php" class="cat-link"><?php echo $lang['lang-all']; ?></a></li>
                                    <li class="cat-list-item"><a href="shop.php?new_arrival=1" class="cat-link"><?php echo $lang['lang-new_arrival']; ?></a></li>
                                    <?php if ($user_type == 1) { ?>
                                        <li class="cat-list-item"><a href="shop.php?is_promotion=1" class="cat-link"><?php echo $lang['lang-promotion']; ?></a></li>
                                    <?php } ?>
                                    <?php
                                    $col = "c.id as c_id, ct.name as ct_name";
                                    $tb = "category c left join category_translation ct on c.id = ct.category_id";
                                    $opt = 'ct.language =? ORDER BY c.date_modified DESC';
                                    $arr = array($language);
                                    $result_category = $db->advwhere($col, $tb, $opt, $arr);

                                    foreach ($result_category as $cate) {


                                    ?>
                                        <li class="cat-list-item"><a href="shop.php?category=<?php echo $cate['c_id']; ?>" class="cat-link"><?php echo $cate['ct_name']; ?></a></li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>

                        <div class="widget price-filter biolife-filter">
                            <h4 class="wgt-title"><?php echo $lang['lang-price']; ?></h4>
                            <div class="wgt-content">
                                <div class="frm-contain">
                                    <form action="" name="price-filter" id="price-filter" method="get">
                                        <p class="f-item">
                                            <label for="pr-from">RM</label>
                                            <input class="input-number" type="number" id="pr-from" value="0" min="0" name="price-from">
                                        </p>
                                        <p class="f-item">
                                            <label for="pr-to">to RM</label>
                                            <input class="input-number" type="number" id="pr-to" value="0" min="0" name="price-to">
                                        </p>
                                        <p class="f-item"><button class="btn-submit" type="submit">go</button></p>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title"><?php echo $lang['lang-latest_product']; ?></h4>
                            <div class="wgt-content">
                                <ul class="products">

                                    <?php

                                    $sqlorder = "p.date_modified DESC";
                                    $offset = 0;
                                    if ($user_type == 3) {

                                        $filter_table = "";
                                        $filter_opt = " ";
                                        $filter_arr = array($admin_id, $language, $user_type, $language, 1);

                                        $col = "*,dp.stock as dis_stock, p.stock as admin_stock, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                                        $tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                                        $opt = 'dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 5 OFFSET ' . $offset . '';
                                        $arr = $filter_arr;
                                        $result_latest_product = $db->advwhere($col, $tb, $opt, $arr);
                                    } else {

                                        $filter_table = "";
                                        $filter_opt = " ";
                                        $filter_arr = array($language, $user_type, $language, 1);
                                        $check_sql = "none";

                                        $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                                        $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                                        $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 5 OFFSET ' . $offset . '';
                                        $arr = $filter_arr;
                                        $result_latest_product = $db->advwhere($col, $tb, $opt, $arr);
                                    }


                                    foreach ($result_latest_product as $latest_product) {


                                        $normal_price = $latest_product['price'];
                                        if ($user_type == 1) {
                                            $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                            $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                            $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified DESC';
                                            $arr = array(1, $latest_product['p_id'], $time, $time);
                                            $check_promotion_prodcut = $db->advwhere($col, $tb, $opt, $arr);

                                            if (count($check_promotion_prodcut) != 0) {
                                                $check_promotion_prodcut = $check_promotion_prodcut[0];
                                                if ($check_promotion_prodcut["type"] == 1) {
                                                    $promo_price = $normal_price - $check_promotion_prodcut["amt"];
                                                    $discount_type = "- RM" . number_format($check_promotion_prodcut["amt"], 2);
                                                } else {
                                                    $promo_price = $normal_price - ($normal_price * $check_promotion_prodcut["percentage"] / 100);
                                                    $discount_type = "Dis " . $check_promotion_prodcut["percentage"] . "%";
                                                }
                                                if ($promo_price <= 0) {
                                                    $promo_price = 0;
                                                }
                                                $is_promo = 1;
                                                $price_display = $promo_price;
                                                $del_hidden = "class=''";
                                            } else {
                                                $discount_type = "";
                                                $is_promo = 0;
                                                $price_display = $normal_price;
                                                $del_hidden = "class='hidden'";
                                            }
                                        } else {
                                            $discount_type = "";
                                            $is_promo = 0;
                                            $price_display = $normal_price;
                                            $del_hidden = "class='hidden'";
                                        }

                                    ?>
                                        <li class="pr-item">
                                            <div class="contain-product style-widget">
                                                <div class="product-thumb">
                                                    <a href="products-detail.php?p=<?php echo $latest_product["p_id"] ?>" class="link-to-product" tabindex="0">
                                                        <img src="img/product/<?php echo $latest_product["image"] ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <b class="categories"><?php echo $latest_product["ct_name"] ?></b>
                                                    <h4 class="product-title"><a href="products-detail.php?p=<?php echo $latest_product["p_id"] ?>" class="pr-name" tabindex="0"><?php echo $latest_product["pt_name"] ?></a></h4>
                                                    <div class="price">
                                                        <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($price_display, 2); ?></span></ins>
                                                        <del <?php echo $del_hidden; ?>><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($normal_price, 2); ?></span></del>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                    </div>

                </aside>
            </div>
        </div>
    </div>

    <!-- /Page Content -->
    <div id='loadDiv' style='position: fixed; width: 100%; height: 100%; left: 0; top: 0; background: rgba(51,51,51,0.2); z-index: 9999; display:none;'><i class="fa fa-spin fa-spinner fa-5x text-success" style='position: fixed; left: 50%; top: 50%;'></i></div>

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
    <!-- Pagination JS -->
    <script src="assets/js/jquery.twbsPagination.js"></script>
    <script src="cart.js"></script>
    <script>
        $(document).ready(function() {
            LoadCart();
            LoadProduct(1)

            window.pagObj = $('#pagination').twbsPagination({
                totalPages: Math.ceil(<?php echo $count_product_result / 15 ?>),
                visiblePages: 5,
                onPageClick: function(event, page) {
                    console.info(page + ' (from options)');
                    $('#loadDiv').show();

                    setTimeout(function() {
                        LoadProduct(page)
                        $('#loadDiv').hide();
                    }, 300);
                    // document.documentElement.scrollTop = 0;
                }
            })

        });

        //for onclick
        function paging() {
            var count_result = $('[id="get_total_product"]').val();
            console.log('ourpage:' + count_result);
            $('#pagination').twbsPagination('destroy');
            $('#pagination').twbsPagination({
                totalPages: Math.ceil(count_result / 15),
                visiblePages: 5,
                onPageClick: function(event, page) {
                    console.info(page + ' (from options paging())');
                    $('#loadDiv').show();

                    setTimeout(function() {
                        var count_result = $('[id="get_total_product"]').val();
                        console.log('inpage:' + count_result);
                        LoadProduct(page)
                        $('#loadDiv').hide();
                    }, 300);
                    // document.documentElement.scrollTop = 0;
                }
            })
        }

        $('[name="orderby"]').change(function() {
            LoadProduct(1);
        });


        function LoadProduct(page) {

            var page = page;
            var orderby = $('[name="orderby"]').children("option:selected").val();
            var new_arrival = <?php echo (isset($_REQUEST["new_arrival"]) && $_REQUEST["new_arrival"] != 0) ? $_REQUEST["new_arrival"] : 0 ?>;
            var is_promotion = <?php echo (isset($_REQUEST["is_promotion"]) && $_REQUEST["is_promotion"] != 0) ? $_REQUEST["is_promotion"] : 0 ?>;
            var category = <?php echo (isset($_REQUEST["category"]) && $_REQUEST["category"] != 0) ? $_REQUEST["category"] : 0 ?>;
            var price_from = <?php echo (isset($_REQUEST["price-from"])) ? $_REQUEST["price-from"] : 0 ?>;
            var price_to = <?php echo (isset($_REQUEST["price-to"])) ? $_REQUEST["price-to"] : 0 ?>;
            $.post('api/product.php', {
                page: page,
                orderby: orderby,
                new_arrival: new_arrival,
                is_promotion: is_promotion,
                category: category,
                price_from: price_from,
                price_to: price_to
            }, function(data) {

                // console.log(data);
                data = JSON.parse(data)
                console.log("getproduct:");
                console.log(data);
                if (data["Status"]) {
                    //Success Action
                    let product_item = '';
                    $.each(data["product"], function(key, product) {
                        if (product.is_promo == 1) {
                            display_ori_price = '                   <del ><span class="price-amount"><span class="currencySymbol">RM</span>' + parseFloat(product.ori_price).toFixed(2) + '</span></del>\n'
                        } else {
                            display_ori_price = '                   '
                        }
                        product_item = product_item +
                            '<li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6" id="product_' + product.product_id + '">\n' +
                            '       <div class="contain-product layout-default">\n' +
                            '           <div class="product-thumb">\n' +
                            '               <a href="products-detail.php?p=' + product.product_id + '" class="link-to-product">\n' +
                            '                   <img src="img/product/' + product.image + '" alt="dd" width="270" height="270" class="product-thumnail">\n' +
                            '               </a>\n' +
                            '<div class="labels">\n' +
                            '<span class="sale-label">\n' +
                            product.discount_type +
                            '</span>\n' +
                            '</div>\n' +
                            '           </div>\n' +
                            '           <div class="info">\n' +
                            '               <b class="categories">' + product.category_name + '</b>\n' +
                            '               <h4 class="product-title"><a href="products-detail.php?p=' + product.product_id + '" class="pr-name">' + product.product_name + '</a></h4>\n' +
                            '               <div class="price">\n' +
                            '                   <ins><span class="price-amount"><span class="currencySymbol">RM</span>' + parseFloat(product.price).toFixed(2) + '</span></ins>\n' +
                            display_ori_price +
                            '               </div>\n' +
                            '               <div class="slide-down-box">\n' +
                            '                   <p class="message">All products are carefully selected to ensure food safety.</p>\n' +
                            '                   <div class="buttons">\n' +
                            '                       <button class="btn add-to-cart-btn btnAddCart" style="width: 100%;" data-value="' + product.product_id + '"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>\n' +
                            '                   </div>\n' +
                            '               </div>\n' +
                            '           </div>\n' +
                            '       </div>\n' +
                            '</li>\n';
                    });
                    $(".product_display").html(product_item);
                    $("#get_total_product").val(data["count_result"]);
                } else {
                    $(".product_display").html(data["msg"]);
                    $("#get_total_product").val(0);
                }
            });
        }
    </script>
</body>

</html>