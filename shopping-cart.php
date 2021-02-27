<!DOCTYPE html>
<html class="no-js" lang="en">
<style>
    .label-discount {
        display: inline-block;
        clear: left;
        min-width: 54px;
        border-radius: 3px;
        text-align: center;
        font-size: 14px;
        color: #ffffff;
        margin-bottom: 5px;
        background-color: #fa3535;
        line-height: 22px;
        padding: 0 5px;
        font-weight: 700;
    }
</style>

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
        <h1 class="page-title"><?php echo $lang['lang-my_cart']; ?></h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index-2.php" class="permal-link"><?php echo $lang['lang-home']; ?></a></li>
                <li class="nav-item"><span class="current-page"><?php echo $lang['lang-my_cart']; ?></span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain shopping-cart cart-b-m">

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
                        <h3 class="title"><?php echo $lang['lang-warning']; ?></h3>
                        <p class="subtitle"><?php echo $lang['lang-a_member_account']; ?></p>
                        <p class="btns">
                            <a href="register.php" class="btn"><?php echo $lang['lang-create_account']; ?></a>
                            <a href="login.php" class="btn"><?php echo $lang['lang-sign_in']; ?></a>
                        </p>
                    </div>
                <?php
                }
                ?>

                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title"><?php echo $lang['lang-your_cart_item']; ?></h3>
                            <form class="shopping-cart-form" id="form_cart" role="form" action="api/cart.php?type=updatecart" method="post">
                                <input type="hidden" name="token" id="form_token" value="<?php echo $token; ?>" />
                                <table class="shop_table cart-form">
                                    <thead>
                                        <tr>
                                            <th class="product-name"><?php echo $lang['lang-product_name']; ?></th>
                                            <th class="product-price"><?php echo $lang['lang-price']; ?></th>
                                            <th class="product-quantity"><?php echo $lang['lang-quantity']; ?></th>
                                            <th class="product-subtotal"><?php echo $lang['lang-total']; ?></th>
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
                                                        $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified DESC';
                                                        $arr = array(1, $cart['p_id'], $time, $time);
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
                                                        } else {
                                                            $is_promo = 0;
                                                            $discount_type = "";
                                                            $price_display = $normal_price;
                                                        }
                                                    } else {
                                                        $is_promo = 0;
                                                        $discount_type = "";
                                                        $price_display = $normal_price;
                                                    }
                                                    $item[$cart['p_id']] = array("qty" => $cart['qty'], "discount_type" => $discount_type, "image" => $cart['image'], "name" => $cart['name'], "price" => $price_display, "ori_price" => $normal_price, "is_promo" => $is_promo, "stock" => $cart['stock'], "product_total_price" => $cart['qty'] * $price_display, "promo_product_total_price" => $cart['qty'] * $normal_price);
                                                }
                                            }
                                        } else {
                                            if (isset($_SESSION['cart'])) {
                                                foreach ($_SESSION['cart']['product'] as $key_product_id => $qty) {

                                                    $table = "product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id";
                                                    $col = "p.id as p_id, p.image as image, p.stock as stock, pt.name as name, pp.price as price";
                                                    $opt = 'p.id = ? && pt.language = ? && pp.type = ?';
                                                    $arr = array($key_product_id, $language, $user_type);
                                                    $get_cart = $db->advwhere($col, $table, $opt, $arr);
                                                    $get_cart = $get_cart[0];

                                                    $normal_price = $get_cart['price'];
                                                    if ($user_type == 1) {
                                                        $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                                        $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                                        $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified DESC';
                                                        $arr = array(1, $get_cart['p_id'], $time, $time);
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

                                                    $item[$key_product_id] = array("qty" => $qty, "discount_type" => $discount_type, "image" => $get_cart['image'], "name" => $get_cart['name'], "price" => $price_display, "ori_price" => $normal_price, "is_promo" => $is_promo, "stock" => $get_cart['stock'], "product_total_price" => $qty * $price_display, "promo_product_total_price" => $qty * $normal_price);
                                                }
                                            }
                                        }

                                        foreach ($item as $key => $product) {
                                            $number_cart++;
                                            $sub_total = $sub_total + ($product["price"] * $product["qty"]);

                                            if ($product['is_promo'] == 1) {
                                                $promo_price_display = '           <del><span class="price-amount"><span class="currencySymbol">RM</span><span>' . number_format($product["ori_price"], 2, '.', '') . '</span></span></del>';
                                                $promo_total_price_display = '           <del><span class="price-amount"><span class="currencySymbol">RM</span ><span class="get_ori_price_' . $key . '">' . number_format($product["promo_product_total_price"], 2, '.', '') . '</span></span></del>';
                                            } else {
                                                $promo_price_display = "";
                                                $promo_total_price_display = "";
                                            }
                                            $cart_display = $cart_display .
                                                '<tr class="cart_item">' .
                                                '   <td class="product-thumbnail product-thumb" data-title="Product Name">' .
                                                '       <a class="prd-thumb" href="products-detail.php?p=' . $key . '">' .
                                                '           <figure><img width="113" height="113" src="img/product/' . $product["image"] . '" alt="shipping cart"></figure>' .
                                                '       </a>' .
                                                '       <a class="prd-name" href="products-detail.php?p=' . $key . '">' . $product["name"] . '</a>' .
                                                '       <div class="action">' .
                                                '           <a class="remove_cart" data-cart-value="' . $key . '"><i class="fa fa-trash-o" aria-hidden="true"></i></a>' .
                                                '       </div>' .
                                                '       </div>' .
                                                '   </td>' .
                                                '   <td class="product-price" data-title="Price">' .
                                                '       <p class="label-discount">' . $product["discount_type"] . '</p>' .
                                                '       <div class="price price-contain">' .
                                                '           <ins><span class="price-amount"><span class="currencySymbol">RM</span>' . number_format($product["price"], 2, '.', '') . '</span></ins>' .
                                                $promo_price_display .
                                                '       </div>' .
                                                '   </td>' .
                                                '   <td class="product-quantity" data-title="Quantity">' .
                                                '       <div class="quantity-box type1">' .
                                                '           <div class="qty-input">' .
                                                '              <input type="text" class="change_quantity" name="qty_product[' . $key . ']" value="' . $product["qty"] . '" data-max_value="' . $product["stock"] . '" data-min_value="1" data-step="1" data-price="' . number_format($product["price"], 2, '.', '') . '" data-ori_price="' . number_format($product["ori_price"], 2, '.', '') . '" data-product_id="' . $key . '">' .
                                                '              <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>' .
                                                '              <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>' .
                                                '           </div>' .
                                                '       </div>' .
                                                '   </td>' .
                                                '   <td class="product-subtotal" data-title="Total">' .
                                                '       <div class="price price-contain">' .
                                                '           <ins><span class="price-amount"><span class="currencySymbol">RM</span><span class="get_display_price_' . $key . '">' . number_format($product["product_total_price"], 2, '.', '') . '</span></span></ins>' .
                                                $promo_total_price_display .
                                                '       </div>' .
                                                '              <input type="hidden" id="get_input_display_price_' . $key . '" name="get_input_display_price[]" value="' . number_format($product["product_total_price"], 2, '.', '') . '" >' .

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
                                                <a href="shop.php" class="btn back-to-shop"><?php echo $lang['lang-back_to_shop']; ?></a>
                                                <button class="btn btn-update" type="submit"><?php echo $lang['lang-update']; ?></button>
                                                <button class="btn btn-clear" type="button"><?php echo $lang['lang-clear_all']; ?></button>
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
                                    <b class="stt-name"><?php echo $lang['lang-subtotal']; ?> <span class="sub">(<?php echo $number_cart; ?> <?php echo $lang['lang-items']; ?>)</span></b>
                                    <span class="stt-price get_count_total">RM <?php echo number_format($sub_total, 2, '.', ''); ?></span>
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name get_msg" style="color:red;"></b>
                                </div>
                                <div class="tax-fee">
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name"><?php echo $lang['lang-total']; ?></b>
                                    <span class="stt-price get_count_total">RM <?php echo number_format($total_pay, 2, '.', ''); ?></span>
                                </div>
                                <div class="btn-checkout">
                                    <input type="hidden" name="count change" value="0" />
                                    <?php if ($login == 1) { ?>
                                        <button class="btn checkout btn_checkout" style="width:100%" onclick="location.href='checkout.php';"><?php echo $lang['lang-check_out']; ?></button>

                                    <?php } else { ?>
                                        <button type="button" class="btn custombtn" style="width:100%" data-toggle="modal" data-target="#exampleModalCenter"><?php echo $lang['lang-check_out']; ?></button>

                                    <?php }  ?>
                                    <p>click</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" style="z-index:2000" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><?php echo $lang['lang-member_registration']; ?></h3>
                    </button>
                </div>
                <div class="modal-body">
                    <div><?php echo $lang['lang-a_member_account']; ?><br>
                        <span style="font-weight : bold ; color:red;"><?php echo $lang['lang-do_you_want_to']; ?></span>
                    </div>
                </div>
                <div class="modal-footer" style="text-align : center ;">
                    <button type="button" class="btn custombtn" data-dismiss="modal"><?php echo $lang['lang-close']; ?></button>
                    <a class="btn custombtn" href="register.php"><?php echo $lang['lang-yes']; ?></a>
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


        // $(document).on('click', '.qty-input .cart-qty-btn', function(e) {
        //     e.preventDefault();
        //     let btn = $(this),
        //         input = btn.siblings("input[name^='qty']");
        //     if (input.length) {
        //         let current_val = parseInt(input.val(), 10),
        //             max_val = parseInt(input.data('max_value'), 10),
        //             step = parseInt(input.data('step'), 10),
        //             product_id = input.data('product_id'),
        //             ori_price = input.data('ori_price'),
        //             price = input.data('price'); //display price
        //         if (btn.hasClass('btn-up')) {
        //             current_val += step;
        //             if (current_val <= max_val) {
        //                 input.val(current_val);
        //             }
        //         } else {
        //             current_val -= step;
        //             if (current_val > 0) {
        //                 input.val(current_val);
        //             }
        //         }
        //         if (current_val == 0) {
        //             current_val = 1;
        //             input.val(current_val);
        //         }
        //         var total_ori_price = current_val * ori_price;
        //         var total_display_price = current_val * price;

        //         $(".get_display_price_" + product_id).html(parseFloat(total_display_price).toFixed(2));
        //         $(".get_ori_price_" + product_id).html(parseFloat(total_ori_price).toFixed(2));
        //         $("#get_input_display_price_" + product_id).val(parseFloat(total_display_price).toFixed(2));
        //         $(".btn_checkout").attr('disabled', true);
        //         $(".get_msg").html('Please click button update your cart for checkout');
        //     }

        // });


        $('[class="change_quantity"]').blur(function() {
            let btn = $(this);
            let current_val = parseInt(btn.val(), 10),
                product_id = btn.data('product_id'),
                ori_price = btn.data('ori_price'),
                price = btn.data('price'); //display price

            if (current_val == 0) {
                current_val = 1;
                btn.val(current_val);
            }

            var total_ori_price = current_val * ori_price;
            var total_display_price = current_val * price;

            $(".get_display_price_" + product_id).html(parseFloat(total_display_price).toFixed(2));
            $(".get_ori_price_" + product_id).html(parseFloat(total_ori_price).toFixed(2));
            $("#get_input_display_price_" + product_id).val(parseFloat(total_display_price).toFixed(2));
            $('[class="btn_checkout"]').attr('disabled', true);

            $(".btn_checkout").attr('disabled', true);
            $(".get_msg").html('<?php echo $lang['lang-please_click_the']; ?>');
            count_all()
        });

        function count_all() {
            var values = $("input[name='get_input_display_price[]']")
                .map(function() {
                    return $(this).val();
                }).get();

            var total_price = 0;
            $.each(values, function(key, price) {
                total_price = total_price + parseFloat(price);
            });
            $(".get_count_total").html("RM " + parseFloat(total_price).toFixed(2));

            // console.log("total price value:" + total_price);
            // console.log("test:" + values);
        }
    </script>
</body>

</html>