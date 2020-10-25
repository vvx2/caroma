<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    require_once('administrator/connection/PDO_db_function.php');
    $db = new DB_FUNCTIONS();
    require_once('inc/head.php');
    ?>
    <style>
        label.error {
            color: red;
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
        <h1 class="page-title">Make A Payment</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Check Out</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain checkout">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container sm-margin-top-37px">
                <div class="row mobile-revers">

                    <!--checkout progress box-->
                    <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                        <div class="checkout-progress-wrap">
                            <ul class="steps">
                                <li class="step 1st">
                                    <div class="checkout-act active">
                                        <h3 class="title-box"><span class="number">1</span>Shipping Detail</h3>
                                        <div class="box-content">
                                            <div class="login-on-checkout">
                                                <form role="form" id="form_checkout" action="api/checkout.php?type=checkout&tb=user" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="token" id="form_token" value="<?php echo $token; ?>" />
                                                    <p class="form-row">
                                                        <div class="col-sm-6 col-12 no-padding-left">
                                                            <label class="label-width" for="name">Full Name</label>
                                                            <input class="input-width" type="text" name="name" id="name" value="" placeholder="Your email">
                                                        </div>
                                                        <div class="col-sm-6 col-12 no-padding-left">
                                                            <label class="label-width" for="contact">Contact Number</label>
                                                            <input class="input-width" type="text" name="contact" id="contact" value="" placeholder="Your email">
                                                        </div>
                                                        <div class="col-sm-12 col-12 no-padding-left">
                                                            <label class="label-width" for="email">Email Address</label>
                                                            <input class="input-width" type="email" name="email" id="email" value="" placeholder="Your email">
                                                        </div>
                                                        <div class="col-sm-12 col-12 no-padding-left">
                                                            <label class="label-width" for="address">Address</label>
                                                            <input class="input-width" type="text" name="address" id="address" value="" placeholder="Your email">
                                                        </div>
                                                        <div class="col-sm-4 col-12 no-padding-left">
                                                            <label class="label-width" for="state">States</label>
                                                            <input class="input-width" type="text" name="state" id="state" value="" placeholder="Your email">
                                                        </div>
                                                        <div class="col-sm-4 col-12 no-padding-left">
                                                            <label class="label-width" for="city">City</label>
                                                            <input class="input-width" type="text" name="city" id="city" value="" placeholder="Your email">
                                                        </div>
                                                        <div class="col-sm-4 col-12 no-padding-left">
                                                            <label class="label-width" for="postcode">Zip Code</label>
                                                            <input class="input-width" type="text" name="postcode" id="postcode" value="" maxlength="5" onkeypress=" return isNumber(event)"  placeholder="Your email">
                                                        </div>
                                                    </p>
                                                    <button type="submit" name="btn-sbmt" class="btn custombtn">Continue To Purchase</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--Order Summary-->
                    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 sm-padding-top-48px sm-margin-bottom-0 xs-margin-bottom-15px">
                        <div class="order-summary sm-margin-bottom-80px">
                            <div class="title-block">
                                <h3 class="title">Order Summary</h3>
                                <a href="shopping-cart.php" class="link-forward">Edit cart</a>
                            </div>

                            <div class="cart-list-box short-type">
                                <?php

                                $user_id = 1;
                                $user_type = 3;
                                $language = "en";
                                $item = array();
                                $total_cart_price = 0;
                                $number_cart = 0;
                                $cart_display = "";
                                $sub_total = 0;
                                $discount = 10;
                                $shipping = 10;
                                $total_pay = 0;

                                $table = "cart c left join product p on c.product_id = p.id left join product_translation pt on c.product_id = pt.product_id left join product_role_price pp on c.product_id = pp.product_id";
                                $col = "c.id as id, c.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, pp.price as price";
                                $opt = 'c.customer_id = ? && pt.language = ? && pp.type = ?';
                                $arr = array($user_id, $language, $user_type);
                                $get_cart = $db->advwhere($col, $table, $opt, $arr);
                                if (count($get_cart) != 0) {
                                ?>
                                    <span class="number"><?php echo count($get_cart); ?> items</span>
                                    <ul class="cart-list">

                                        <?php
                                        foreach ($get_cart as $cart) {
                                            $sub_total = $sub_total + ($cart["price"] * $cart["qty"]);
                                            $item[$cart['p_id']] = array("qty" => $cart['qty'], "image" => $cart['image'], "name" => $cart['name'], "price" => $cart['price'], "stock" => $cart['stock'], "product_total_price" => $cart['qty'] * $cart['price']);

                                        ?>
                                            <li class="cart-elem">
                                                <div class="cart-item">
                                                    <div class="product-thumb">
                                                        <a class="prd-thumb" href="#">
                                                            <figure><img src="img/product/<?php echo $cart["image"] ?>" width="113" height="113" alt="shop-cart"></figure>
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <span class="txt-quantity"><?php echo $cart["qty"] ?>X</span>
                                                        <a href="#" class="pr-name"><?php echo $cart["name"] ?></a>
                                                    </div>
                                                    <div class="price price-contain">
                                                        <ins><span class="price-amount"><span class="currencySymbol">RM </span><?php echo number_format($cart["price"] * $cart["qty"], 2, '.', ''); ?></span></ins>
                                                        <del><span class="price-amount"><span class="currencySymbol">RM </span><?php echo number_format($cart["price"] * $cart["qty"], 2, '.', ''); ?></span></del>
                                                    </div>
                                                </div>
                                            </li>


                                    <?php

                                        }
                                        $total_pay = $sub_total + $shipping - $discount;
                                    } else {
                                        echo "<script>alert(\" Your Cart Is Empty. Add Product To Your Cart For Checkout. Thank You.\");
                                               window.location.href='shop.php';</script>";
                                    }


                                    ?>


                                    </ul>
                                    <ul class="subtotal">
                                        <li>
                                            <div class="subtotal-line">
                                                <b class="stt-name">Subtotal</b>
                                                <span class="stt-price">RM <?php echo number_format($sub_total, 2, '.', ''); ?></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="subtotal-line">
                                                <b class="stt-name">Shipping</b>
                                                <span class="stt-price">+ RM <?php echo number_format($shipping, 2, '.', ''); ?></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="subtotal-line">
                                                <b class="stt-name">Discount</b>
                                                <span class="stt-price">- RM <?php echo number_format($discount, 2, '.', ''); ?></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="subtotal-line">
                                                <a href="#" class="link-forward">Promo/Gift Certificate</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="subtotal-line">
                                                <b class="stt-name">total:</b>
                                                <span class="stt-price">RM <?php echo number_format($total_pay, 2, '.', ''); ?></span>
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

    <?php
    require_once('inc/footer.php');
    require_once('inc/mobile_footer.php');
    ?>

    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <!-- Jquery Validate -->
    <script src="administrator/js/plugins/validate/jquery.validate.min.js"></script>
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

            $("#form_checkout").validate({
                rules: {
                    name: {
                        required: true,

                    },
                    contact: {
                        required: true,

                    },
                    email: {
                        required: true,

                    },
                    address: {
                        required: true,

                    },
                    state: {
                        required: true,

                    },
                    city: {
                        required: true,

                    },
                    postcode: {
                        required: true,
                        minlength: 5,
                        maxlength: 5,
                        digits: true

                    }

                }
            });

        });
    </script>
</body>

</html>