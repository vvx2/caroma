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
        <h1 class="page-title">Our Store</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.php" class="permal-link">Home</a></li>
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
                                <a href="products-detail.php" class="icon-for-mobile">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                                <div class="wrap-selectors">
                                    <form action="#" name="frm-refine" method="get">
                                        <span class="title-for-mobile">Refine Products By</span>
                                        <div data-title="Price:" class="selector-item">
                                            <select name="price" class="selector">
                                                <option value="all">Price</option>
                                                <option value="class-1st">Less than 5RM</option>
                                                <option value="class-2nd">RM5-10RM</option>
                                                <option value="class-3rd">RM10-20RM</option>
                                                <option value="class-4th">RM20-45RM</option>
                                                <option value="class-5th">RM45-100RM</option>
                                                <option value="class-6th">RM100-150RM</option>
                                                <option value="class-7th">More than 150RM</option>
                                            </select>
                                        </div>
                                        <div data-title="Brand:" class="selector-item">
                                            <select name="brad" class="selector">
                                                <option value="all">Top brands</option>
                                                <option value="br2">Top Sales</option>
                                                <option value="br3">Hot Sales</option>
                                                <option value="br4">Latest Product</option>
                                            </select>
                                        </div>
                                        <div data-title="Avalability:" class="selector-item">
                                            <select name="ability" class="selector">
                                                <option value="all">On Stock</option>
                                                <option value="vl2">Out Of Stock</option>
                                            </select>
                                        </div>
                                        <p class="btn-for-mobile"><button type="submit" class="btn-submit">Go</button></p>
                                    </form>
                                </div>
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
                                    <div class="selector-item viewmode-selector">
                                        <a href="category-grid-left-sidebar.php" class="viewmode grid-mode active"><i class="biolife-icon icon-grid"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <ul class="products-list">
                                <?php
                                $i = 1;
                                $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name";
                                $tb = "product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id";
                                $opt = 'pt.language = ? && pp.type =? && ct.language =? ORDER BY p.date_modified DESC';
                                $arr = array("en", "3", "en");
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
                                <?php
                                    $i++;
                                }
                                ?>
                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
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
                                </li>

                                <li class="product-item col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                    <div class="contain-product layout-default">
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
                                                <img src="assets/images/products/p-18.jpg" alt="dd" width="270" height="270" class="product-thumnail">
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
                                                <img src="assets/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
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
                                                <img src="assets/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
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

                            </ul>
                        </div>

                        <div class="biolife-panigations-block">
                            <ul class="panigation-contain">
                                <li><span class="current-page">1</span></li>
                                <li><a href="#" class="link-page">2</a></li>
                                <li><a href="#" class="link-page">3</a></li>
                                <li><span class="sep">....</span></li>
                                <li><a href="#" class="link-page">20</a></li>
                                <li><a href="#" class="link-page next"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>

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
                                    <li class="cat-list-item"><a href="#" class="cat-link">Ginger</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Honey</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Matcha Fruits</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Coconut</a></li>
                                    <li class="cat-list-item"><a href="#" class="cat-link">Soy</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget price-filter biolife-filter">
                            <h4 class="wgt-title">Price</h4>
                            <div class="wgt-content">
                                <div class="frm-contain">
                                    <form action="#" name="price-filter" id="price-filter" method="get">
                                        <p class="f-item">
                                            <label for="pr-from">RM</label>
                                            <input class="input-number" type="number" id="pr-from" value="" name="price-from">
                                        </p>
                                        <p class="f-item">
                                            <label for="pr-to">to RM</label>
                                            <input class="input-number" type="number" id="pr-to" value="" name="price-from">
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
                            <h4 class="wgt-title">Popular Size</h4>
                            <div class="wgt-content">
                                <ul class="check-list bold multiple">
                                    <li class="check-list-item"><a href="#" class="check-link">8oz</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">15oz</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">6oz</a></li>
                                    <li class="check-list-item"><a href="#" class="check-link">30oz</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="widget biolife-filter">
                            <h4 class="wgt-title">Latest Products</h4>
                            <div class="wgt-content">
                                <ul class="products">
                                    <li class="pr-item">
                                        <div class="contain-product style-widget">
                                            <div class="product-thumb">
                                                <a href="#" class="link-to-product" tabindex="0">
                                                    <img src="assets/images/products/p-13.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">Fresh Fruit</b>
                                                <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="pr-item">
                                        <div class="contain-product style-widget">
                                            <div class="product-thumb">
                                                <a href="#" class="link-to-product" tabindex="0">
                                                    <img src="assets/images/products/p-14.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">Fresh Fruit</b>
                                                <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="pr-item">
                                        <div class="contain-product style-widget">
                                            <div class="product-thumb">
                                                <a href="#" class="link-to-product" tabindex="0">
                                                    <img src="assets/images/products/p-10.jpg" alt="dd" width="270" height="270" class="product-thumnail">
                                                </a>
                                            </div>
                                            <div class="info">
                                                <b class="categories">Fresh Fruit</b>
                                                <h4 class="product-title"><a href="#" class="pr-name" tabindex="0">National Fresh Fruit</a></h4>
                                                <div class="price">
                                                    <ins><span class="price-amount"><span class="currencySymbol">RM</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">RM</span>95.00</span></del>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                </aside>
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