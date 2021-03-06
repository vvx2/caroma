<?php
// require_once('administrator/connection/PDO_db_function.php');
// $db = new DB_FUNCTIONS();
require_once('inc/init.php');
if ($login != 1) {
    echo "<script>window.location.replace('login.php')</script>";
    exit();
}

$time = date('Y-m-d H:i:s');
$item = array();
$total_cart_price = 0;
$number_cart = 0;
$cart_display = "";
$sub_total = 0;
$discount = 0;
$shipping = 0;
$total_pay = 0;
$total_point = 0;
$total_point_earn = 0;
$point_discount = 0;

/**
 * This is a sample code for manual integration with senangPay
 * It is so simple that you can do it in a single file
 * Make sure that in senangPay Dashboard you have key in the return URL referring to this file for example http://myserver.com/senangpay_sample.php
 */

if ($server == 3) { //3=live
    $senangpay_path = "https://app.senangpay.my/payment/";
    # please fill in the required info as below
    $merchant_id = '269160188695246';
    $secretkey = '23291-493';
} else {
    $senangpay_path = "https://sandbox.senangpay.my/payment/";
    # please fill in the required info as below
    $merchant_id = '859160498101260';
    $secretkey = '3037-583';
}



# this part is to process data from the form that user key in, make sure that all of the info is passed so that we can process the payment
if (isset($_POST['detail']) && isset($_POST['amount']) && isset($_POST['order_id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
    # assuming all of the data passed is correct and no validation required. Preferably you will need to validate the data passed
    $hashed_string = hash_hmac('sha256', $secretkey . urldecode($_POST['detail']) . urldecode($_POST['amount']) . urldecode($_POST['order_id']), $secretkey);

    //this is get user data to session
    $_SESSION['order_id'] = $_POST['order_id'];

    # now we send the data to senangPay by using post method
?>
    <html>

    <head>
        <title>SenangPay</title>
    </head>

    <body onload="document.order.submit()">
        <form name="order" method="post" action="<?php echo $senangpay_path . $merchant_id; ?>">
            <input type="hidden" name="detail" value="<?php echo $_POST['detail']; ?>">
            <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
            <input type="hidden" name="order_id" value="<?php echo $_POST['order_id']; ?>">
            <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
            <input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
            <input type="hidden" name="hash" value="<?php echo $hashed_string; ?>">
        </form>
    </body>

    </html>
    <?php
}
# this part is to process the response received from senangPay, make sure we receive all required info
else if (isset($_GET['status_id']) && isset($_GET['order_id']) && isset($_GET['msg']) && isset($_GET['transaction_id']) && isset($_GET['hash'])) {
    # verify that the data was not tempered, verify the hash
    $hashed_string = hash_hmac('sha256', $secretkey . urldecode($_GET['status_id']) . urldecode($_GET['order_id']) . urldecode($_GET['transaction_id']) . urldecode($_GET['msg']), $secretkey);

    # if hash is the same then we know the data is valid
    if ($hashed_string == urldecode($_GET['hash'])) {
        # this is a simple result page showing either the payment was successful or failed. In real life you will need to process the order made by the customer
        if (urldecode($_GET['status_id']) == '1') {
            echo 'Payment was successful with message: ' . urldecode($_GET['msg']);
            echo '<br><h2>Please don\'t Refresh the page or click BACK or FORWARD button. System will redirect you to our page.</h2>';
    ?>

            <html>

            <head>
                <title>Submit User Data to Database when payment successful</title>
            </head>

            <body onload="document.success.submit()">
                <form role="form" name="success" action="api/checkout.php?type=payment_success&success=1" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="token" value="<?php echo $token; ?>" />
                    <input type="hidden" name="order_id" value="<?php echo $_GET['order_id']; ?>">

                </form>
            </body>

            </html>
        <?php
            exit();
        } else {
            echo 'Payment failed with message: ' . urldecode($_GET['msg']);
            $msg = urldecode($_GET['msg']);
            echo "<script>setTimeout(function() { window.location.href='shop.php?msg=" . $msg . "'}, 2000);</script>";
        }
    } else
        echo 'Hashed value is not correct. Please Try Again.';
    echo "<script>setTimeout(function() { window.location.href='checkout.php'}, 2000);</script>";
}
# this part is to show the form where customer can key in their information
else {
    # by right the detail, amount and order ID must be populated by the system, in this example you can key in the value yourself
    $table = "cart c left join product p on c.product_id = p.id left join product_translation pt on c.product_id = pt.product_id left join product_role_price pp on c.product_id = pp.product_id";
    $col = "c.id as id, c.qty as qty, p.id as p_id, p.stock as stock, p.point as point, p.image as image, pt.name as name, pp.price as price";
    $opt = 'c.customer_id = ? && pt.language = ? && pp.type = ?';
    $arr = array($user_id, $language, $user_type);
    $get_cart = $db->advwhere($col, $table, $opt, $arr);
    if (count($get_cart) != 0) {
        ?>
        <!DOCTYPE html>
        <html class="no-js" lang="en">

        <head>
            <?php require_once('inc/head.php'); ?>
            <style>
                label.error {
                    color: red;
                }

                .checkout-progress-wrap .steps li {
                    list-style: none;
                    padding: 2px 5px 2px;
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

                        // get user self detail
                        $table = "users u left join user_address ua on u.id = ua.user_id";
                        $col = "u.name as name,u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state";
                        $opt = 'u.id = ?';
                        $arr = array($user_id);
                        $result_user = $db->advwhere($col, $table, $opt, $arr);

                        if ($result_user != 0) {
                            $result_user = $result_user[0];

                            $customer_name = $result_user["name"];
                            $customer_email = $result_user["email"];
                            $customer_contact = $result_user["contact"];
                            $customer_address = $result_user["address"];
                            $customer_postcode = $result_user["postcode"];
                            $customer_city = $result_user["city"];
                            $customer_state = $result_user["state"];
                        } else {
                            $customer_name = "-";
                            $customer_email = "-";
                            $customer_contact =  "-";
                            $customer_address =  "-";
                            $customer_postcode = "-";
                            $customer_city = "-";
                            $customer_state =  "-";
                        }
                        ?>
                    </div>
                </div>
            </header>

            <!--Hero Section-->
            <div class="hero-section hero-background">
                <h1 class="page-title"><?php echo $lang['lang-make_a_payment']; ?></h1>
            </div>

            <!--Navigation section-->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php" class="permal-link"><?php echo $lang['lang-home']; ?></a></li>
                        <li class="nav-item"><span class="current-page"><?php echo $lang['lang-check_out']; ?></span></li>
                    </ul>
                </nav>
            </div>

            <div class="page-contain checkout">

                <!-- Main content -->
                <div id="main-content" class="main-content">
                    <div class="container sm-margin-top-37px">
                        <div class="row">
                            <div class="mobile-revers">
                            <!--checkout progress box-->
                            <form role="form" id="form_checkout" action="api/checkout.php?type=checkout&tb=user" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="token" id="form_token" value="<?php echo $token; ?>" />
                                <div class="row mobile-revers">
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                                    <div class="checkout-progress-wrap">
                                        <ul class="steps">
                                            <li class="step 1st">
                                                <div class="checkout-act active">
                                                    
                                                    <div class="box-content">
                                                    <h3 class="title-box"><!--- <span class="number">*</span> ---><?php echo $lang['lang-shipping_detail']; ?></h3>
                                                        <div class="login-on-checkout">

                                                            <p class="form-row">

                                                            <div class="col-sm-6 col-12 no-padding-left">
                                                                <label class="label-width" for="name"><?php echo $lang['lang-full_name']; ?></label>
                                                                <input class="input-width" type="text" name="name" id="name" value="<?php echo $customer_name; ?>" placeholder="Your Full Name">
                                                            </div>
                                                            <div class="col-sm-6 col-12 no-padding-left">
                                                                <label class="label-width" for="contact"><?php echo $lang['lang-contact_number']; ?></label>
                                                                <input class="input-width" type="text" name="phone" id="contact" value="<?php echo $customer_contact; ?>" placeholder="Your Contact Number">
                                                            </div>
                                                            <div class="col-sm-12 col-12 no-padding-left">
                                                                <label class="label-width" for="email"><?php echo $lang['lang-email']; ?></label>
                                                                <input class="input-width" type="email" name="email" id="email" value="<?php echo $customer_email; ?>" placeholder="Your Email">
                                                            </div>
                                                            <div class="col-sm-12 col-12 no-padding-left">
                                                                <label class="label-width" for="address"><?php echo $lang['lang-address']; ?></label>
                                                                <input class="input-width" type="text" name="address" id="address" value="<?php echo $customer_address; ?>" placeholder="Your Address">
                                                            </div>
                                                            <div class="col-sm-4 col-12 no-padding-left">
                                                                <label class="label-width" for="state"><?php echo $lang['lang-state']; ?></label>
                                                                <select class="input-width state_select" name="state" tabindex="2" required>
                                                                    <option data-option="" value="">Select State</option>
                                                                    <?php

                                                                    $tb = "state";
                                                                    $col = "id, name";
                                                                    $opt = 'id != ? order by name asc';
                                                                    $arr = array(0);
                                                                    $result = $db->advwhere($col, $tb, $opt, $arr);
                                                                    foreach ($result as $state) {
                                                                    ?>
                                                                        <option value="<?php echo $state['id']; ?>" <?php echo ($state['id'] == $customer_state) ? "selected" : "" ?>><?php echo $state['name']; ?></option>


                                                                    <?php
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-4 col-12 no-padding-left">
                                                                <label class="label-width" for="city"><?php echo $lang['lang-city']; ?></label>
                                                                <input class="input-width" type="text" name="city" id="city" value="<?php echo $customer_city; ?>" placeholder="Your City">
                                                            </div>
                                                            <div class="col-sm-4 col-12 no-padding-left">
                                                                <label class="label-width" for="postcode"><?php echo $lang['lang-zip_code']; ?></label>
                                                                <input class="input-width" type="text" name="postcode" id="postcode" value="<?php echo $customer_postcode; ?>" maxlength="5" onkeypress=" return isNumber(event)" placeholder="Your Zipcode">
                                                            </div>

                                                            <?php
                                                            if ($user_type != 1) {
                                                            ?>

                                                                <div class="col-sm-12 col-12 no-padding-left">
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10"><?php echo $lang['lang-delivery_type']; ?></label>
                                                                        <div class="radio-list">
                                                                            <div class="radio-inline pl-0">
                                                                                <div class="radio radio-info">
                                                                                    <input checked type="radio" name="delivery_type" id="delivery" value="1">
                                                                                    <label for="delivery"><?php echo $lang['lang-delivery']; ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="radio-inline">
                                                                                <div class="radio radio-info">
                                                                                    <input type="radio" name="delivery_type" id="self_collect" value="2">
                                                                                    <label for="self_collect"><?php echo $lang['lang-self_collect']; ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12 col-12 no-padding-left">
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10"><?php echo $lang['lang-payment_type']; ?></label>
                                                                        <div class="radio-list">
                                                                            <div class="radio-inline pl-0">
                                                                                <div class="radio radio-info">
                                                                                    <input checked type="radio" name="payment_type" id="online_pay" value="1">
                                                                                    <label for="online_pay"><?php echo $lang['lang-online_payment']; ?></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="radio-inline">
                                                                                <div class="radio radio-info">
                                                                                    <input type="radio" name="payment_type" id="cash" value="2">
                                                                                    <label for="cash"><?php echo $lang['lang-cash']; ?></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div hidden>
                                                                    <div class="col-sm-12 col-12 no-padding-left">
                                                                        <div class="form-group">
                                                                            <label class="control-label mb-10"><?php echo $lang['lang-use_point']; ?></label>
                                                                            <div class="radio-list">
                                                                                <div class="radio-inline pl-0">
                                                                                    <div class="radio radio-info">
                                                                                        <input checked type="radio" name="reward_point" id="is_point" value="0">
                                                                                        <label for="is_point"><?php echo $lang['lang-no']; ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php
                                                            } else {
                                                                $table = "cart c left join product p on c.product_id = p.id";
                                                                $col = "c.product_id as product_id, c.qty as qty, p.weight as weight, p.point as point, p.point_allow_discount as point_allow_discount";
                                                                $opt = 'c.customer_id = ?';
                                                                $arr = array($user_id);
                                                                $result_cart = $db->advwhere($col, $table, $opt, $arr);

                                                                // check cart is exists item
                                                                if (count($result_cart) != 0) {
                                                                    $total_point = 0; // point can be use
                                                                    //count item total weight
                                                                    foreach ($result_cart as $cart) {
                                                                        $total_point = $total_point + ($cart['qty'] * $cart['point_allow_discount']); // for reduce check
                                                                    }
                                                                }

                                                                $table = 'user_point';
                                                                $col = "*";
                                                                $opt = 'user_id =?';
                                                                $arr = array($user_id);
                                                                $user_point = $db->advwhere($col, $table, $opt, $arr);
                                                                if (count($user_point) != 0) {
                                                                    $current_point = $user_point[0]["point"];

                                                                    //-----------------------
                                                                    //      get point value
                                                                    $result_point_value = $db->get("*", "reward_point_value", 1);
                                                                    if (count($result_point_value) != 0) {
                                                                        $point_value = $result_point_value[0]['value'];
                                                                    } else {
                                                                        $point_value = 1;
                                                                    }
                                                                    //-----------------------
                                                                } else {
                                                                }

                                                            ?>
                                                                <div class="col-sm-12 col-12 no-padding-left">
                                                                    <div class="form-group">
                                                                        <label class="control-label mb-10"><?php echo $lang['lang-your_point']; ?> : <strong><?php echo $current_point; ?> <?php echo $lang['lang-point']; ?></strong></label>
                                                                        <br>
                                                                        <label class="control-label mb-10"><?php echo $lang['lang-point_can_be_discout']; ?> : <strong><?php echo $total_point; ?> <?php echo $lang['lang-point']; ?></strong></label>
                                                                        <br>
                                                                        <label class="control-label mb-10"><?php echo $lang['lang-use_point']; ?> <strong>(1 <?php echo $lang['lang-point']; ?> = RM <?php echo number_format($point_value / 100, 2) ?>)</strong></label>

                                                                        <div class="radio-list">
                                                                            <div class="radio-inline pl-0">
                                                                                <div class="radio radio-info">
                                                                                    <input checked type="radio" name="reward_point" id="is_point" value="0">
                                                                                    <label for="is_point">No</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="radio-inline">
                                                                                <div class="radio radio-info">
                                                                                    <input type="radio" name="reward_point" id="no_point" value="1">
                                                                                    <label for="no_point">Yes</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div hidden>
                                                                    <div class="col-sm-12 col-12 no-padding-left">
                                                                        <div class="form-group">
                                                                            <label class="control-label mb-10"><?php echo $lang['lang-delivery_type']; ?></label>
                                                                            <div class="radio-list">
                                                                                <div class="radio-inline pl-0">
                                                                                    <div class="radio radio-info">
                                                                                        <input checked type="radio" name="delivery_type" id="delivery" value="1">
                                                                                        <label for="delivery"><?php echo $lang['lang-delivery']; ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-12 no-padding-left">
                                                                        <div class="form-group">
                                                                            <label class="control-label mb-10"><?php echo $lang['lang-payment_type']; ?></label>
                                                                            <div class="radio-list">
                                                                                <div class="radio-inline pl-0">
                                                                                    <div class="radio radio-info">
                                                                                        <input checked type="radio" name="payment_type" id="online_pay" value="1">
                                                                                        <label for="online_pay"><?php echo $lang['lang-online_payment']; ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            </p>



                                                            <button type="button" class="btn custombtn" data-toggle="modal" data-target="#exampleModalCenter1"><?php echo $lang['lang-continue_to_purchase']; ?></button>
                                                            <a href="./shop.php"><button type="button" class="btn custombtn"><?php echo $lang['lang-cancel']; ?></button></a>
                                                            <a href="./shopping-cart.php"><button type="button" class="btn custombtn"><?php echo $lang['lang-back']; ?></button></a>

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
                                            <h3 class="title"><?php echo $lang['lang-order_summary']; ?></h3>
                                            <a href="shopping-cart.php" class="link-forward" data-toggle="tooltip" title="<?php echo $lang['lang-tooltip']; ?>"><?php echo $lang['lang-edit_cart']; ?></a>
                                        </div>

                                        <div class="cart-list-box short-type">

                                            <span class="number"><?php echo count($get_cart); ?> <?php echo $lang['lang-items']; ?></span>
                                            <ul class="cart-list">

                                                <?php
                                                foreach ($get_cart as $cart) {
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

                                                    $total_point_earn = $total_point_earn + ($cart["point"] * $cart["qty"]);
                                                    $sub_total = $sub_total + ($price_display * $cart["qty"]);

                                                    $result_gst_value = $db->get("*", "gst_value", 1);
                                                    if (count($result_gst_value) != 0) {
                                                        $gst_value = $result_gst_value[0]['value'];
                                                    } else {
                                                        $gst_value = 0;
                                                    }

                                                    $gst_tax = ($sub_total * ($gst_value / 100));

                                                    $item[$cart['p_id']] = array("qty" => $cart['qty'], "image" => $cart['image'], "name" => $cart['name'], "price" => $price_display, "ori_price" => $normal_price, "hidden_promo" => $hidden_promo, "stock" => $cart['stock'], "product_total_price" => $cart['qty'] * $cart['price']);

                                                ?>
                                                    <li class="cart-elem">
                                                        <div class="cart-item">
                                                            <div class="product-thumb">
                                                                <a class="prd-thumb" href="products-detail.php?p=<?php echo $cart["p_id"] ?>">
                                                                    <figure><img src="img/product/<?php echo $cart["image"] ?>" width="113" height="113" alt="shop-cart"></figure>
                                                                </a>
                                                            </div>
                                                            <div class="info">
                                                                <span class="txt-quantity"><?php echo $cart["qty"] ?>X</span>
                                                                <a href="#" class="pr-name"><?php echo $cart["name"] ?></a>
                                                            </div>
                                                            <div class="price price-contain">
                                                                <ins><span class="price-amount"><span class="currencySymbol">RM </span><?php echo number_format($price_display * $cart["qty"], 2, '.', ''); ?></span></ins>
                                                                <del class="<?php echo $hidden_promo; ?>"><span class="price-amount"><span class="currencySymbol">RM </span><?php echo number_format($normal_price * $cart["qty"], 2, '.', ''); ?></span></del>
                                                            </div>
                                                        </div>
                                                    </li>


                                                <?php

                                                }
                                                $total_pay = $sub_total + $shipping - $discount - $point_discount + $gst_tax;
                                                $order_detail = "Caromaca Purchase"
                                                ?>


                                            </ul>
                                            <ul class="subtotal">
                                                <li>
                                                    <div class="subtotal-line">
                                                        <b class="stt-name"><?php echo $lang['lang-subtotal']; ?></b>
                                                        <span class="stt-price" id="get_subtotal">RM <?php echo number_format($sub_total, 2, '.', ''); ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="subtotal-line">
                                                        <b class="stt-name"><?php echo $lang['lang-shipping']; ?></b>
                                                        <span class="stt-price" id="get_shipping">+ RM <?php echo number_format($shipping, 2, '.', ''); ?></span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="get_shipping_error text-danger"></div>
                                                </li>

                                                <?php
                                                if ($user_type == 1) {
                                                ?>
                                                    <li>
                                                        <div class="subtotal-line">
                                                            <b class="stt-name"><?php echo $lang['lang-discount']; ?></b>
                                                            <span class="stt-price" id="get_discount">- RM <?php echo number_format($discount, 2, '.', ''); ?></span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="subtotal-line">
                                                            <b class="stt-name"><?php echo $lang['lang-caorma_coin']; ?></b>
                                                            <span class="stt-price" id="get_point_discount">- RM <?php echo number_format(0, 2, '.', ''); ?></span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="subtotal-line">
                                                            <b class="stt-name"><?php echo $lang['lang-gst_tax']; ?> (<?php echo $gst_value; ?>%)</b>
                                                            <span class="stt-price" id="get_gst">+ RM <?php echo number_format($gst_tax, 2, '.', ''); ?></span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="col-sm-12 col-12 no-padding-left">
                                                            <label class="label-width" for="coupon"><?php echo $lang['lang-coupon_code']; ?> <span class="text-danger" id="get_coupon_msg"> </span></label>
                                                            <input class="input-width" type="text" name="coupon" id="coupon" value="" placeholder="Enter Coupon Code">
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="subtotal-line">
                                                            <b class="stt-name"><?php echo $lang['lang-coin_earn']; ?>:</b>
                                                            <span class="stt-price" style="color:green;"><?php echo $total_point_earn; ?> <?php echo $lang['lang-point']; ?></span>
                                                        </div>
                                                    </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <!-- <li>
                                                        <div class="subtotal-line">
                                                            <b class="stt-name">Discount</b>
                                                            <span class="stt-price" id="get_discount">- RM <?php echo number_format($discount, 2, '.', ''); ?></span>
                                                        </div>
                                                    </li> -->
                                                    <li>
                                                        <div class="subtotal-line">
                                                            <b class="stt-name"><?php echo $lang['lang-gst_tax']; ?> (<?php echo $gst_value; ?>%)</b>
                                                            <span class="stt-price" id="get_gst">+ RM <?php echo number_format($gst_tax, 2, '.', ''); ?></span>
                                                        </div>
                                                    </li>
                                                    <!-- <li>
                                                        <div class="col-sm-12 col-12 no-padding-left">
                                                            <label class="label-width" for="coupon">Coupon Code <span class="text-danger" id="get_coupon_msg"> </span></label>
                                                            <input class="input-width" type="text" name="coupon" id="coupon" value="" placeholder="Enter Coupon Code">
                                                        </div>
                                                    </li> -->
                                                <?php
                                                }
                                                ?>

                                                <li>
                                                    <div class="subtotal-line">
                                                        <b class="stt-name total-red"><?php echo $lang['lang-total']; ?>:</b>
                                                        <span class="stt-price total-red" id="get_totalpay">RM <?php echo number_format($total_pay, 2, '.', ''); ?></span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div hidden>
                                                <input type="text" name="detail" value="<?php echo $order_detail; ?>" placeholder="Description of the transaction" size="30" required>
                                                <input type="text" name="amount" id="total_payment" value="<?php echo $total_pay; ?>" placeholder="Amount to pay, for example 12.20" size="30" required>
                                                <input type="number" name="shipping" id="total_shipping" value="0" required>
                                                <input type="number" name="point_discount" id="total_point_discount" value="0" required>
                                                <input type="text" name="order_id" value="<?php echo time(); ?>" placeholder="Unique id to reference the transaction or order" size="30" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter1" style="z-index:2000" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3><?php echo $lang['lang-order_confirmation']; ?></h3>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div><?php echo $lang['lang-kindly_make_sure_your_shipping']; ?><br>
                                                    <span style="font-weight : bold ; color:red;"><?php echo $lang['lang-do_you_want_to_continue']; ?></span>
                                                </div>
                                            </div>
                                            <div class="modal-footer" style="text-align : center ;">
                                                <button type="submit" name="btn-sbmt" class="btn custombtn btn-submit"><?php echo $lang['lang-yes']; ?></button>
                                                <button type="button" class="btn custombtn" data-dismiss="modal"><?php echo $lang['lang-close']; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div id='loadDiv' style='position: fixed; width: 100%; height: 100%; left: 0; top: 0; background: rgba(51,51,51,0.2); z-index: 9999; display:none;'><i class="fa fa-spin fa-spinner fa-5x text-success" style='position: fixed; left: 50%; top: 50%;'></i></div>
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
                $('#myModal').on('shown.bs.modal', function() {
                    $('#myInput').trigger('focus')
                })
            </script>
            <script>
                $(document).ready(function() {
                    LoadCart();

                    $.validator.setDefaults({
                        ignore: ":hidden:not(.state_select)"
                    }) //for all select having class .state_select

                    $("#form_checkout").validate({
                        rules: {
                            name: {
                                required: true,

                            },
                            phone: {
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

                    var state = $('[name="state"]').val()
                    var delivery_type = $('[name="delivery_type"]:checked').val()
                    var point_use = $('[name="reward_point"]:checked').val()

                    load_shipping(state, delivery_type, point_use, true);

                });

                //for check coupon
                $('[name="coupon"]').blur(function() {
                    var coupon_code = $(this).val()
                    if (coupon_code) {
                        coupon_code = coupon_code;
                    } else {
                        coupon_code = "";
                    }
                    load_coupon(coupon_code);
                });

                //for check shipping fee
                $('[name="state"]').change(function() {
                    var point_use = $('[name="reward_point"]:checked').val()
                    var delivery_type = $('[name="delivery_type"]:checked').val()
                    var state = $(this).val()
                    if (state) {
                        state = state;
                    } else {
                        state = "";
                    }
                    load_shipping(state, delivery_type, point_use, true);
                });

                //for check shipping fee with onclick delivety type
                $('[name="delivery_type"]').change(function() {
                    var point_use = $('[name="reward_point"]:checked').val()
                    var delivery_type = $('[name="delivery_type"]:checked').val()
                    var state = $('[name="state"]').val()
                    if (state) {
                        state = state;
                    } else {
                        state = "";
                    }

                    console.log("state: " + state);
                    console.log("delivery_type: " + delivery_type);
                    load_shipping(state, delivery_type, point_use, true);
                });

                // for check point to discount
                $('[name="reward_point"]').change(function() {
                    var point_use = $('[name="reward_point"]:checked').val()
                    var delivery_type = $('[name="delivery_type"]:checked').val()
                    var state = $('[name="state"]').val()
                    if (state) {
                        state = state;
                    } else {
                        state = "";
                    }

                    console.log("state: " + state);
                    console.log("reward point: " + point_use);
                    load_shipping(state, delivery_type, point_use, true);
                });

                var gst_tax = <?php echo $gst_tax ?>;

                function load_shipping(state, delivery_type, point_use, status) {
                    $('#loadDiv').show();
                    var coupon = $('[name="coupon"]').val()
                    if (coupon) {
                        coupon = coupon;
                    } else {
                        coupon = "";
                    }
                    if (state == "") {
                        $(".btn-submit").attr('disabled', true);
                        $(".get_shipping_error").html("You must select your state");
                        $("#get_shipping").html('+ RM ' + parseFloat(0).toFixed(2));
                        $("#total_shipping").val(0);
                        $("#get_point_discount").html('- RM ' + "<?php echo number_format(0, 2, '.', ''); ?>");
                        $("#total_point_discount").val(0);
                        $("#get_totalpay").html('RM ' + "<?php echo number_format($total_pay, 2, '.', ''); ?>");
                        $("#total_payment").val(<?php echo $total_pay; ?>);

                        $('#loadDiv').hide();
                        //status is for run load coupon when the coupon input is empty or coupon invalid
                        if (coupon != "" && status) {
                            load_coupon(coupon);
                        }
                    } else {
                        $.post('api/shipping_fee.php', {
                            sub_total: <?php echo $sub_total; ?>,
                            state: state,
                            point_use: point_use,
                            delivery_type: delivery_type
                        }, function(data) {
                            console.log("shipping api: " + data);
                            setTimeout(function() {
                                data = JSON.parse(data);
                                if (data["Status"]) {

                                    $(".btn-submit").attr('disabled', false);
                                    $(".get_shipping_error").html("");
                                    $("#get_shipping").html('+ RM ' + parseFloat(data["Shipping_fee"]).toFixed(2));
                                    $("#get_point_discount").html('- RM ' + parseFloat(data["Point_discount"]).toFixed(2));
                                    $("#get_totalpay").html('RM ' + parseFloat(data["Total_pay"] + gst_tax).toFixed(2));
                                    $("#total_payment").val(data["Total_pay"] + gst_tax);
                                    $("#total_shipping").val(data["Shipping_fee"]);
                                    $("#total_point_discount").val(data["Point_discount"]);
                                } else {
                                    $(".btn-submit").attr('disabled', true);
                                    $(".get_shipping_error").html(data["Msg"]);
                                    $("#get_shipping").html('+ RM ' + "<?php echo number_format($shipping, 2, '.', ''); ?>");
                                    $("#get_point_discount").html('- RM ' + "<?php echo number_format($point_discount, 2, '.', ''); ?>");
                                    $("#get_totalpay").html('RM ' + "<?php echo number_format($total_pay, 2, '.', ''); ?>");
                                    $("#total_shipping").val(0);
                                    $("#total_point_discount").val(0);
                                    $("#total_payment").val(<?php echo $total_pay; ?>);
                                }
                                $('#loadDiv').hide();
                                if (coupon != "" && status) {
                                    load_coupon(coupon);
                                }
                            }, 500);
                        });
                    }



                }

                function load_coupon(coupon_code) {
                    $('#loadDiv').show();
                    var sub_total = "<?php echo $sub_total; ?>"
                    var shipping = $('[id="total_shipping"]').val()
                    var point_use = $('[name="reward_point"]:checked').val()
                    var point_discount = $('[id="total_point_discount"]').val()
                    var state = $('[name="state"]').val()
                    var delivery_type = $('[name="delivery_type"]:checked').val()
                    if (state) {
                        state = state;
                    } else {
                        state = "";
                    }

                    // console.log("coupon api shipping : " + shipping);
                    // console.log("coupon api total_pay：" + sub_total);
                    if (coupon_code != "") {
                        $.post('api/validate_coupon.php', {
                            sub_total: <?php echo $sub_total; ?>,
                            shipping: shipping,
                            point_discount: point_discount,
                            coupon_code: coupon_code
                        }, function(data) {
                            setTimeout(function() {
                                console.log("coupon api" + data);
                                data = JSON.parse(data);
                                if (data["Status"]) {
                                    $("#get_coupon_msg").html("");
                                    $("#get_discount").html('- RM ' + parseFloat(data["Amount"]).toFixed(2));
                                    $("#get_shipping").html('+ RM ' + parseFloat(data["Shipping_fee"]).toFixed(2));
                                    $("#get_point_discount").html('- RM ' + parseFloat(data["Point_discount"]).toFixed(2));
                                    $("#get_totalpay").html('RM ' + parseFloat(data["Total_pay"] + gst_tax).toFixed(2));
                                    $("#total_payment").val(data["Total_pay"] + gst_tax);
                                    $("#total_shipping").val(data["Shipping_fee"]);
                                    $("#total_point_discount").val(data["Point_discount"]);
                                } else {
                                    $("#get_coupon_msg").html(data["Msg"]);
                                    $("#get_discount").html('- RM ' + "<?php echo number_format($discount, 2, '.', ''); ?>");
                                    $("#get_shipping").html('+ RM ' + parseFloat(shipping).toFixed(2));
                                    $("#get_point_discount").html('- RM ' + parseFloat(point_discount).toFixed(2));
                                    $("#get_totalpay").html('RM ' + parseFloat(sub_total + gst_tax).toFixed(2));
                                    $("#total_payment").val(<?php echo $total_pay; ?>);
                                    $("#total_shipping").val(shipping);
                                    $("#total_point_discount").val(point_discount);
                                    load_shipping(state, delivery_type, point_use, false);
                                }
                                $('#loadDiv').hide();
                            }, 500);
                        });
                    } else {
                        load_shipping(state, delivery_type, point_use, false);
                        $("#get_coupon_msg").html("");
                        $("#get_discount").html('- RM ' + "<?php echo number_format($discount, 2, '.', ''); ?>");
                        $("#get_shipping").html('+ RM ' + parseFloat(shipping).toFixed(2));
                        $("#get_point_discount").html('- RM ' + parseFloat(point_discount).toFixed(2));
                        $("#get_totalpay").html('RM ' + parseFloat(sub_total + gst_tax).toFixed(2));
                        $("#total_payment").val(<?php echo $total_pay; ?>);
                        $("#total_shipping").val(shipping);
                        $("#total_point_discount").val(point_discount);

                        $('#loadDiv').hide();
                    }
                }
            </script>

            <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
            </script>
        </body>

        </html>
<?php
    } else {
        echo "<script>alert(\"Your Cart Is Empty. Add Product To Your Cart For Checkout. Thank You.\");
               window.location.href='shop.php';</script>";
    }
}

?>