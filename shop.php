<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
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
            background-color: #90bf2a;
            border-color: #90bf2a;
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
        <h1 class="page-title">Our Store</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Shop</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain category-page left-sidebar">
        <div class="container">
            <div class="row">
                <!-- Main content -->
                <div id="main-content" class="main-content col-lg-9 col-md-8 col-sm-12 col-xs-12">

                    <div class="block-item recently-products-cat md-margin-bottom-39">
                        <h3 class="title-product-content">Hot Sales</h3>
                        <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true, "autoplaySpeed": 1500, "autoplay": true, "dots":false,"infinite":true,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 3}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":30}},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>


                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-08.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-11.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-17.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-15.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-09.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-02.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-07.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-03.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="product-item">
                                <div class="contain-product layout-02">
                                    <div class="product-thumb">
                                        <a href="products-detail.php" class="link-to-product">
                                            <img src="assets/images/products/p-21.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <b class="categories">Fresh Fruit</b>
                                        <h4 class="product-title"><a href="products-detail.php" class="pr-name">National Fresh Fruit</a></h4>
                                        <div class="price">
                                            <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                            <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="product-category grid-style">

                        <div id="top-functions-area" class="top-functions-area">
                            <div class="flt-item to-left group-on-mobile">
                                <span class="flt-title">Refine</span>
                            </div>
                            <div class="flt-item to-right">
                                <span class="flt-title">Sort</span>
                                <div class="wrap-selectors">
                                    <div class="selector-item orderby-selector">
                                        <select name="orderby" class="orderby" aria-label="Shop order">
                                            <option value="menu_order" selected="selected">Default sorting</option>
                                            <option value="popularity">popularity</option>
                                            <option value="rating">average rating</option>
                                            <option value="date">newness</option>
                                            <option value="price">price: low to high</option>
                                            <option value="price-desc">price: high to low</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <ul class="products-list">
                                <?php
                                if (isset($_REQUEST["category"])) {
                                    $filter_table = " left join category c on p.category = c.id";
                                    $filter_opt = " && c.status =? && p.category =? ";
                                    $filter_arr = array($language, $user_type, $language, 1, 1, $_REQUEST["category"]);
                                } else if (isset($_REQUEST["price-from"]) && isset($_REQUEST["price-to"])) {
                                    $filter_table = "";
                                    $filter_opt = " && pp.price BETWEEN ? AND ? ";
                                    $filter_arr = array($language, $user_type, $language, 1, $_REQUEST["price-from"], $_REQUEST["price-to"]);
                                } else {
                                    $filter_table = "";
                                    $filter_opt = " ";
                                    $filter_arr = array($language, $user_type, $language, 1);
                                }

                                $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name";
                                $tb = "product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id " . $filter_table;
                                $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . 'ORDER BY p.date_modified DESC';
                                $arr = $filter_arr;
                                $result = $db->advwhere($col, $tb, $opt, $arr);
                                foreach ($result as $product) {

                                ?>
                                    <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6" id="product_<?php echo $product["p_id"] ?>">
                                        <div class="contain-product layout-default">
                                            <div class="product-thumb">
                                                <a href="products-detail.php" class="link-to-product">
                                                    <img src="img/product/<?php echo $product["image"] ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories"><?php echo $product["ct_name"] ?></b>
                                                <h4 class="product-title"><a href="products-detail.php" class="pr-name"><?php echo $product["pt_name"] ?></a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($product["price"], 2, '.', '') ?></span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($product["price"], 2, '.', '') ?></span></del>
                                                </div>
                                                <div class="shipping-info">
                                                    <p class="shipping-day">Description</p>
                                                    <p class="for-today"><?php echo $product["pt_description"] ?></p>
                                                </div>
                                                <div class="slide-down-box">
                                                    <p class="message">All products are carefully selected to ensure food safety.</p>
                                                    <div class="buttons">
                                                        <button class="btn add-to-cart-btn btnAddCart" style="width: 100%;" data-value="<?php echo $product["p_id"] ?>"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i>add to cart</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php }

                                if (count($result) == 0) {
                                    echo "<h1>No Result</h1>";
                                }
                                ?>
                                <input hidden value='<?php echo count($result); ?>' id='get_total_product'>

                                <!-- <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="products-detail.php" class="link-to-product">
                                                <img src="assets/images/products/p-13.jpg" alt="dd" width="270" height="270" class="product-thumnail">
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
                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="products-detail.php" class="link-to-product">
                                                <img src="assets/images/products/p-21.jpg" alt="dd" width="270" height="270" class="product-thumnail">
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

                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="products-detail.php" class="link-to-product">
                                                <img src="assets/images/products/p-14.jpg" alt="dd" width="270" height="270" class="product-thumnail">
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
                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
                                        <div class="product-thumb">
                                            <a href="products-detail.php" class="link-to-product">
                                                <img src="assets/images/products/p-15.jpg" alt="dd" width="270" height="270" class="product-thumnail">
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
                                </li> -->

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
                        <span class="biolife-current-panel-title">Sidebar</span>
                        <a class="biolife-close-btn" href="#" data-object="open-mobile-filter">&times;</a>
                    </div>
                    <div class="sidebar-contain">
                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Categories</h4>
                            <div class="wgt-content">

                                <ul class="cat-list">
                                    <li class="cat-list-item"><a href="shop.php" class="cat-link">ALL</a></li>
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
                            <h4 class="wgt-title">Price</h4>
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
                                <ul class="check-list bold single">
                                    <li class="check-list-item"><a href="#" class="check-link">RM0 - RM20</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">RM21 - RM50</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">RM51 Above</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Product Tags</h4>
                            <div class="wgt-content">
                                <ul class="check-list multiple">
                                    <li class="check-list-item"><a href="#" class="check-link">Ginger</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">Plum Organic</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">Drinks</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">Coffee</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">Tea</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">Merdeka Promotion</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">September Promotion</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Latest Products</h4>
                            <div class="wgt-content">
                                <ul class="products">

                                    <?php

                                    $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name";
                                    $tb = "product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id";
                                    $opt = 'pt.language = ? && pp.type =? && ct.language =? ORDER BY p.date_modified DESC Limit 5';
                                    $arr = array($language, $user_type, $language);
                                    $result_latest_product = $db->advwhere($col, $tb, $opt, $arr);

                                    foreach ($result_latest_product as $latest_product) {
                                    ?>
                                        <li class="pr-item">
                                            <div class="contain-product style-widget">
                                                <div class="product-thumb">
                                                    <a href="products=detail.php?p=<?php echo $latest_product["p_id"] ?>" class="link-to-product" tabindex="0">
                                                        <img src="img/product/<?php echo $latest_product["image"] ?>" alt="dd" width="270" height="270" class="product-thumnail">
                                                    </a>
                                                </div>
                                                <div class="info">
                                                    <b class="categories">Fresh Fruit</b>
                                                    <h4 class="product-title"><a href="products=detail.php?p=<?php echo $latest_product["p_id"] ?>" class="pr-name" tabindex="0"><?php echo $latest_product["pt_name"] ?></a></h4>
                                                    <div class="price">
                                                        <ins><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($latest_product["price"], 2, '.', '') ?></span></ins>
                                                        <del><span class="price-amount"><span class="currencySymbol">RM</span><?php echo number_format($latest_product["price"], 2, '.', '') ?></span></del>
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


            window.pagObj = $('#pagination').twbsPagination({
                totalPages: Math.ceil(5),

                visiblePages: 3,
                onPageClick: function(event, page) {
                    console.info(page + ' (from options)');


                    // var district = $("input[name='district[]']:checkbox:checked").map(function() {
                    //     return $(this).val();
                    // }).get();

                    // var special = $("input[name='special[]']:checkbox:checked").map(function() {
                    //     return $(this).val();
                    // }).get();

                    // var gender = $("input[name='gender[]']:checkbox:checked").map(function() {
                    //     return $(this).val();
                    // }).get();

                    // var search_doctor = $('[name="search_doctor"]').val();

                    $('#loadDiv').show();


                    // $.ajax({
                    //     type: "POST",
                    //     url: "get_doctor.php",
                    //     data: {
                    //         district: district,
                    //         special: special,
                    //         search_doctor: search_doctor,
                    //         gender: gender,
                    //         page: page,
                    //     },
                    //     success: function(data) {
                    //         setTimeout(function() {
                    //             // console.log(data);
                    //             $('.display_doctor').html(data);
                    //             var count_result = $('#get_total_doctor').val();
                    //             $('#count_result').html("已查找到相關的結果： " + count_result + "個");
                    //             $('#loadDiv').hide();
                    //         }, 300);
                    //     }
                    // });

                    setTimeout(function() {
                        $('#loadDiv').hide();
                    }, 300);
                    // document.documentElement.scrollTop = 0;
                }
            })
        });
    </script>
</body>

</html>