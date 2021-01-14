<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    $time = date('Y-m-d H:i:s');

    if (isset($_REQUEST['p'])) {
        $product_id = $_REQUEST['p'];
    } else {
        echo "<script>alert(\" No product. Please select a product. Thank You.\");
               window.location.href='shop.php';</script>";
        exit();
    }

    $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating, rate.rate_total as rate_total";
    $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating, count(product_id) as rate_total FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id ";
    $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =? && p.id = ?';
    $arr = array($language, $user_type, $language, 1, $product_id);
    $result = $db->advwhere($col, $tb, $opt, $arr);

    if (count($result) == 0) {
        echo "<script>alert(\" No product. Please select a product. Thank You.\");
               window.location.href='shop.php';</script>";
        exit();
    }
    $result = $result[0];

    if ($user_type == 3) {
        //get distributor id that dealer under with
        $table = 'user_dealer';
        $col = "*";
        $opt = 'user_id =?';
        $arr = array($user_id);
        $dealer = $db->advwhere($col, $table, $opt, $arr);
        $under_distributor = $dealer[0]['under_distributor'];
        $admin_id = $under_distributor;

        $col = "id,stock";
        $tb = "distributor_product";
        $opt = 'product_id = ? && user_id = ? && status = ?';
        $arr = array($product_id, $admin_id, 1);
        $dis_product = $db->advwhere($col, $tb, $opt, $arr);

        if (count($dis_product) != 0) {
            $dis_product = $dis_product[0];
            $stock = $dis_product['stock'];
        } else {
            echo "<script>alert(\" No product. Please select a product. Thank You.\");
            window.location.href='shop.php';</script>";
            exit();
        }
    } else {
        $stock = $result['stock'];
    }

    if ($result['rating'] == NULL) {
        $result['rating'] = 5;
    }

    $rate_per = ($result['rating'] / 5) * 100;

    $normal_price = $result['price'];
    if ($user_type == 1) {
        $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
        $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
        $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
        $arr = array(1, $result['p_id'], $time, $time);
        $check_promotion_prodcut = $db->advwhere($col, $tb, $opt, $arr);

        if (count($check_promotion_prodcut) != 0) {
            $check_promotion_prodcut = $check_promotion_prodcut[0];
            if ($check_promotion_prodcut["type"] == 1) {
                $promo_price = $normal_price - $check_promotion_prodcut["amt"];
            } else {
                $promo_price = $normal_price - ($normal_price * $check_promotion_prodcut["percentage"] / 100);
            }
            if ($promo_price <= 0) {
                $promo_price = 0;
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
    // echo "<pre>";
    // var_dump($result);
    // echo "</pre>";
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
        <h1 class="page-title">Product Detail</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Shop</span></li>
                <li class="nav-item"><span class="current-page">Product Details</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain single-product">
        <div class="container">

            <!-- Main content -->
            <div id="main-content" class="main-content">

                <!-- summary info -->
                <div class="sumary-product single-layout">
                    <div class="media">
                        <ul class="biolife-carousel slider-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                            <?php
                            $col = "*";
                            $tb = "product";
                            $opt = 'id = ?';
                            $arr = array($product_id);
                            $product_main_image = $db->advwhere($col, $tb, $opt, $arr);
                            $product_main_image = $product_main_image[0];
                            ?>
                            <li><img src="img/product/<?php echo $product_main_image['image']; ?>" alt="" width="400" height="400"></li>
                            <?php
                            $col = "*";
                            $tb = "product_image";
                            $opt = 'product_id = ?';
                            $arr = array($product_id);
                            $product_image = $db->advwhere($col, $tb, $opt, $arr);

                            foreach ($product_image as $img) {
                                if ($product_main_image['image'] == $img['image']) {
                                    continue;
                                }
                            ?>
                                <li><img src="img/product/<?php echo $img['image']; ?>" alt="" width="400" height="400"></li>
                            <?php } ?>
                        </ul>
                        <ul class="biolife-carousel slider-nav" data-slick='{"arrows":false,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":4,"slidesToScroll":1,"asNavFor":".slider-for"}'>
                            
                            <li><img src="img/product/<?php echo $product_main_image['image']; ?>" alt="" width="400" height="400"></li>
                            <?php
                            foreach ($product_image as $img) {
                                if ($product_main_image['image'] == $img['image']) {
                                    continue;
                                }
                            ?>
                                <li><img src="img/product/<?php echo $img['image']; ?>" alt="" width="88" height="88"></li>
                            <?php } ?>

                        </ul>
                    </div>
                    <div class="product-attribute">
                        <h3 class="title"><?php echo $result['pt_name']; ?></h3>
                        <div class="rating">
                            <p class="star-rating"><span class="width-percent" style="width: <?php echo $rate_per; ?>%;"></span></p>
                            <span class="review-count"></span>
                            <span class="qa-text">Q&A</span>
                            <b class="category">By: <?php echo $result['ct_name']; ?></b>
                        </div>
                        <span class="sku">Stock: <?php echo $stock; ?></span>
                        <div class="price">
                            <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($price_display, 2); ?></span></ins>
                            <del class="<?php echo $hidden_promo; ?>"><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($normal_price, 2); ?></span></del>
                        </div>
                        <?php
                        if ($user_type == 1 && count($check_promotion_prodcut) != 0) {
                        ?>
                            <div class="biolife-countdown" data-datetime="<?php echo $check_promotion_prodcut['new_end_date']; ?>"></div>
                        <?php
                        }
                        ?>
                        <div class="shipping-info">
                            <p class="shipping-day">3-Day Shipping</p>
                            <p class="for-today">Shipping with CITYLINK</p>
                        </div>
                    </div>
                    <div class="action-form">
                        <div class="quantity-box">
                            <span class="title">Quantity:</span>
                            <div class="qty-input">
                                <input type="text" name="qty_product" value="1" data-max_value="<?php echo $stock; ?>" data-min_value="1" data-step="1">
                                <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <div class="buttons">
                            <button class="btn add-to-cart-btn btnAddCart" style="width: 100%;" data-value="<?php echo $result['p_id']; ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> add to cart</button>
                        </div>
                        <div class="social-media">
                            <ul class="social-list">
                                <li><a href="#" class="social-link"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                <li><a href="#" class="social-link"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="acepted-payment-methods">
                            <ul class="payment-methods">
                                <li><img src="assets/images/card1.jpg" alt="" width="51" height="36"></li>
                                <li><img src="assets/images/card2.jpg" alt="" width="51" height="36"></li>
                                <li><img src="assets/images/card3.jpg" alt="" width="51" height="36"></li>
                                <li><img src="assets/images/card4.jpg" alt="" width="51" height="36"></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tab info -->
                <div class="product-tabs single-layout biolife-tab-contain">
                    <div class="tab-head">
                        <ul class="tabs">
                            <li class="tab-element active"><a href="#tab_1st" class="tab-link">Products Descriptions</a></li>
                            <li class="tab-element"><a href="#tab_4th" class="tab-link">Customer Reviews</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="tab_1st" class="tab-contain desc-tab active">
                            <?php echo $result['pt_description']; ?>
                        </div>
                        <div id="tab_4th" class="tab-contain review-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="rating-info">
                                            <?php
                                            $col = "id";
                                            $tb = "order_items";
                                            $opt = 'product_id = ? && rate = ?';
                                            $arr = array($product_id, 5);
                                            $rate5 = $db->advwhere($col, $tb, $opt, $arr);

                                            $arr = array($product_id, 4);
                                            $rate4 = $db->advwhere($col, $tb, $opt, $arr);

                                            $arr = array($product_id, 3);
                                            $rate3 = $db->advwhere($col, $tb, $opt, $arr);

                                            $arr = array($product_id, 2);
                                            $rate2 = $db->advwhere($col, $tb, $opt, $arr);

                                            $arr = array($product_id, 1);
                                            $rate1 = $db->advwhere($col, $tb, $opt, $arr);


                                            $count_rate1 = count($rate1);
                                            $count_rate2 = count($rate2);
                                            $count_rate3 = count($rate3);
                                            $count_rate4 = count($rate4);
                                            $count_rate5 = count($rate5);
                                            ?>
                                            <p class="index"><strong class="rating"><?php echo number_format($result['rating'], 1); ?></strong>out of 5</p>
                                            <div class="rating">
                                                <p class="star-rating"><span class="width-percent" style="width: <?php echo $rate_per; ?>%;"></span></p>
                                            </div>
                                            <p class="see-all">Total all <?php echo number_format($result['rate_total'], 0); ?> reviews</p>
                                            <?php
                                            // php cant division in 0
                                            if ($result['rate_total'] == 0) {
                                                $result['rate_total'] = 1;
                                            }
                                            ?>
                                            <ul class="options">
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">5stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span class="percent width-100percent" style="width: <?php echo ($count_rate5 / $result['rate_total']) * 100; ?>%;"></span></span>
                                                        </span>
                                                        <span class="number"><?php echo $count_rate5; ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">4stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span class="percent width-100percent" style="width: <?php echo ($count_rate4 / $result['rate_total']) * 100; ?>%;"></span></span>
                                                        </span>
                                                        <span class="number"><?php echo $count_rate4; ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">3stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span class="percent width-100percent" style="width: <?php echo ($count_rate3 / $result['rate_total']) * 100; ?>%;"></span></span>
                                                        </span>
                                                        <span class="number"><?php echo $count_rate3; ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">2stars</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span class="percent width-100percent" style="width: <?php echo ($count_rate2 / $result['rate_total']) * 100; ?>%;"></span></span>
                                                        </span>
                                                        <span class="number"><?php echo $count_rate2; ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="detail-for">
                                                        <span class="option-name">1star</span>
                                                        <span class="progres">
                                                            <span class="line-100percent"><span class="percent width-100percent" style="width: <?php echo ($count_rate1 / $result['rate_total']) * 100; ?>%;"></span></span>
                                                        </span>
                                                        <span class="number"><?php echo $count_rate1; ?></span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- related products -->
                <div class="product-related-box single-layout">
                    <div class="biolife-title-box lg-margin-bottom-26px-im">
                        <span class="biolife-icon icon-capacity-about"></span>
                        <span class="subtitle">All the best item for You</span>
                        <h3 class="main-title">Hot Products</h3>
                    </div>
                    <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>


                        <?php

                        $sqlorder = "rating DESC"; //this "rating" is count by quantity
                        $offset = 0;
                        if ($user_type == 3) {

                            $filter_table = "";
                            $filter_opt = " ";
                            $filter_arr = array($admin_id, $language, $user_type, $language, 1);

                            $col = "*,dp.stock as dis_stock, p.stock as admin_stock, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                            $tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                            $opt = 'dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 5 OFFSET ' . $offset . '';
                            $arr = $filter_arr;
                            $hot_result = $db->advwhere($col, $tb, $opt, $arr);
                        } else {

                            $filter_table = "";
                            $filter_opt = " ";
                            $filter_arr = array($language, $user_type, $language, 1);
                            $check_sql = "none";

                            $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
                            $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(qty) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
                            $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 5 OFFSET ' . $offset . '';
                            $arr = $filter_arr;
                            $hot_result = $db->advwhere($col, $tb, $opt, $arr);
                        }
                        foreach ($hot_result as $hot) {


                            $normal_price = $hot['price'];
                            if ($user_type == 1) {
                                $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
                                $arr = array(1,$hot['p_id'], $time, $time);
                                $check_promotion_prodcut = $db->advwhere($col, $tb, $opt, $arr);

                                if (count($check_promotion_prodcut) != 0) {
                                    $check_promotion_prodcut = $check_promotion_prodcut[0];
                                    if ($check_promotion_prodcut["type"] == 1) {
                                        $promo_price = $normal_price - $check_promotion_prodcut["amt"];
                                    } else {
                                        $promo_price = $normal_price - ($normal_price * $check_promotion_prodcut["percentage"] / 100);
                                    }
                                    if ($promo_price <= 0) {
                                        $promo_price = 0;
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
                                            <img src="img/product/<?php echo $hot['image']; ?>" alt="<?php echo $hot['pt_name']; ?>" width="270" height="270" class="product-thumnail">
                                        </a>
                                        <a class="lookup btn_call_quickview" href="products-detail.php?p=<?php echo $hot['p_id']; ?>"><i class="biolife-icon icon-search"></i></a>
                                    </div>
                                    <div class="info">
                                        <b class="categories"><?php echo $hot['ct_name']; ?></b>
                                        <h4 class="product-title"><a href="products-detail.php?p=<?php echo $hot['p_id']; ?>" class="pr-name"><?php echo $hot['pt_name']; ?></a></h4>
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