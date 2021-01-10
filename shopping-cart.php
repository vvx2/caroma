<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    $time = date('Y-m-d H:i:s');
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
        <h1 class="page-title">Shopping Cart</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Shopping Cart</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain shopping-cart">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">


                <?php
                if ($login == 1) {
                    //Logined
                } else {
                ?>
                    <!--Top banner-->
                    <div class="top-banner background-top-banner-for-shopping min-height-346px">
                        <br><br><br>
                        <h3 class="title">*** Warning ***</h3>
                        <p class="subtitle">A member account is a must before you proceed to your payment .</p>
                        <p class="btns">
                            <a href="register.php" class="btn">Create An Account</a>
                            <a href="login.php" class="btn">Login</a>
                        </p>
                    </div>
                <?php
                }
                ?>

                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Your cart items</h3>
                            <form class="shopping-cart-form" role="form" action="api/cart.php?type=updatecart" method="post">
                                <input type="hidden" name="token" id="form_token" value="<?php echo $token; ?>" />
                                <table class="shop_table cart-form">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $item = array();
                                        $total_cart_price = 0;
                                        $number_cart = 0;
                                        $cart_display = "";
                                        $sub_total = 0;
                                        $shipping = 0;
                                        $total_pay = 0;

                                        if ($login == 1) {
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

                                            $table = "cart c left join product p on c.product_id = p.id left join product_translation pt on c.product_id = pt.product_id left join product_role_price pp on c.product_id = pp.product_id";
                                            $col = "c.id as id, c.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, pp.price as price";
                                            $opt = 'c.customer_id = ? && pt.language = ? && pp.type = ?';
                                            $arr = array($user_id, $language, $user_type);
                                            $get_cart = $db->advwhere($col, $table, $opt, $arr);
                                            if (count($get_cart) != 0) {
                                                foreach ($get_cart as $cart) {
                                                    if ($user_type == 3) {
                                                        $table = "distributor_product";
                                                        $col = "*";
                                                        $opt = 'product_id = ? && user_id = ?';
                                                        $arr = array($cart['p_id'], $admin_id);
                                                        $check_product_under_distributor = $db->advwhere($col, $table, $opt, $arr);

                                                        $cart['stock'] = $check_product_under_distributor[0]['stock'];
                                                    }

                                                    $normal_price = $cart['price'];
                                                    if ($user_type == 1) {
                                                        $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                                        $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                                        $opt = 'prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
                                                        $arr = array($cart['p_id'], $time, $time);
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
                                                            $is_promo = 1;
                                                            $price_display = $promo_price;
                                                        } else {
                                                            $is_promo = 0;
                                                            $price_display = $normal_price;
                                                        }
                                                    } else {
                                                        $is_promo = 0;
                                                        $price_display = $normal_price;
                                                    }
                                                    $item[$cart['p_id']] = array("qty" => $cart['qty'], "image" => $cart['image'], "name" => $cart['name'], "price" => $price_display, "ori_price" => $normal_price, "is_promo" => $is_promo, "stock" => $cart['stock'], "product_total_price" => $cart['qty'] * $cart['price']);
                                                }
                                            }
                                        } else {
                                            if (isset($_SESSION['cart'])) {
                                                foreach ($_SESSION['cart']['product'] as $key_product_id => $qty) {

                                                    $table = "product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id";
                                                    $col = "p.image as image, p.stock as stock, pt.name as name, pp.price as price";
                                                    $opt = 'p.id = ? && pt.language = ? && pp.type = ?';
                                                    $arr = array($key_product_id, $language, $user_type);
                                                    $get_cart = $db->advwhere($col, $table, $opt, $arr);
                                                    $get_cart = $get_cart[0];

                                                    $normal_price = $get_cart['price'];
                                                    if ($user_type == 1) {
                                                        $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                                        $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                                        $opt = 'prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
                                                        $arr = array($get_cart['p_id'], $time, $time);
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
                                                            $is_promo = 1;
                                                            $price_display = $promo_price;
                                                        } else {
                                                            $is_promo = 0;
                                                            $price_display = $normal_price;
                                                        }
                                                    } else {
                                                        $is_promo = 0;
                                                        $price_display = $normal_price;
                                                    }

                                                    $item[$key_product_id] = array("qty" => $qty, "image" => $get_cart['image'], "name" => $get_cart['name'], "price" => $price_display, "ori_price" => $normal_price, "is_promo" => $is_promo, "stock" => $get_cart['stock'], "product_total_price" => $qty * $get_cart['price']);
                                                }
                                            }
                                        }

                                        foreach ($item as $key => $product) {
                                            $number_cart++;
                                            $sub_total = $sub_total + ($product["price"] * $product["qty"]);
                                            $cart_display = $cart_display .
                                                '<tr class="cart_item">' .
                                                '   <td class="product-thumbnail" data-title="Product Name">' .
                                                '       <a class="prd-thumb" href="products-detail.php?p=' . $key . '">' .
                                                '           <figure><img width="113" height="113" src="img/product/' . $product["image"] . '" alt="shipping cart"></figure>' .
                                                '       </a>' .
                                                '       <a class="prd-name" href="products-detail.php?p=' . $key . '">' . $product["name"] . '</a>' .
                                                '       <div class="action">' .
                                                '           <a class="remove_cart" data-cart-value="' . $key . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' .
                                                '       </div>' .
                                                '   </td>' .
                                                '   <td class="product-price" data-title="Price">' .
                                                '       <div class="price price-contain">' .
                                                '           <ins><span class="price-amount"><span class="currencySymbol">RM</span>' . number_format($product["price"], 2, '.', '') . '</span></ins>' .
                                                '           <del><span class="price-amount"><span class="currencySymbol">RM</span>' . number_format($product["price"], 2, '.', '') . '</span></del>' .
                                                '       </div>' .
                                                '   </td>' .
                                                '   <td class="product-quantity" data-title="Quantity">' .
                                                '       <div class="quantity-box type1">' .
                                                '           <div class="qty-input">' .
                                                '              <input type="text" name="qty_product[' . $key . ']" value="' . $product["qty"] . '" data-max_value="' . $product["stock"] . '" data-min_value="1" data-step="1">' .
                                                '              <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>' .
                                                '              <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>' .
                                                '           </div>' .
                                                '       </div>' .
                                                '   </td>' .
                                                '   <td class="product-subtotal" data-title="Total">' .
                                                '       <div class="price price-contain">' .
                                                '           <ins><span class="price-amount"><span class="currencySymbol">RM</span>' . number_format($product["product_total_price"], 2, '.', '') . '</span></ins>' .
                                                '           <del><span class="price-amount"><span class="currencySymbol">RM</span>' . number_format($product["product_total_price"], 2, '.', '') . '</span></del>' .
                                                '       </div>' .
                                                '   </td>' .
                                                '</tr>';
                                        }
                                        echo $cart_display;
                                        ?>

                                        <!-- <tr class="cart_item">
                                            <td class="product-thumbnail" data-title="Product Name">
                                                <a class="prd-thumb" href="#">
                                                    <figure><img width="113" height="113" src="assets/images/shippingcart/pr-01.jpg" alt="shipping cart"></figure>
                                                </a>
                                                <a class="prd-name" href="#">National Fresh Fruit</a>
                                                <div class="action">
                                                    <a href="#" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span class="currencySymbol">RM</span>50.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">RM</span>55.00</span></del>
                                                </div>
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                <div class="quantity-box type1">
                                                    <div class="qty-input">
                                                        <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1" data-step="1">
                                                        <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                                                        <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span class="currencySymbol">RM</span>50.00</span></ins>
                                                    <del><span class="price-amount"><span class="currencySymbol">RM</span>55.00</span></del>
                                                </div>
                                            </td>
                                        </tr> -->

                                        <tr class="cart_item wrap-buttons">
                                            <td class="wrap-btn-control" colspan="4">
                                                <a href="shop.php" class="btn back-to-shop">Back to Shop</a>
                                                <button class="btn btn-update" type="submit">update</button>
                                                <button class="btn btn-clear" type="button">clear all</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <?php
                        $total_pay = $sub_total + $shipping;
                        ?>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="shpcart-subtotal-block">
                                <div class="subtotal-line">
                                    <b class="stt-name">Subtotal <span class="sub">(<?php echo $number_cart; ?> items)</span></b>
                                    <span class="stt-price">RM <?php echo number_format($sub_total, 2, '.', ''); ?></span>
                                </div>
                                <!-- <div class="subtotal-line">
                                    <b class="stt-name">Shipping</b>
                                    <span class="stt-price">RM <?php echo number_format($shipping, 2, '.', ''); ?></span>
                                </div> -->
                                <div class="tax-fee">
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name">Total</b>
                                    <span class="stt-price">RM <?php echo number_format($total_pay, 2, '.', ''); ?></span>
                                </div>
                                <div class="btn-checkout">
                                    <button class="btn checkout" style="width:100%" <?php echo ($login == 1) ? '' : 'disabled="disabled"' ?> onclick="location.href='checkout.php';">Check out</button>
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