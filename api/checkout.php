<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
if (isset($_SESSION['user_id']) && isset($_SESSION['type'])) {
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['type'];
    $login = 1;
    $_SESSION['login'] = $login;
} else {
    $login = 0;
    $_SESSION['login'] = $login;
    $user_type = 1;
}
if (isset($_SESSION['language'])) {

    $language = $_SESSION['language'];
} else {
    $_SESSION['language'] = "en";
    $language = $_SESSION['language'];
}

if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    $postedToken = filter_input(INPUT_POST, 'token');
    if (!empty($postedToken)) {
        if (isTokenValid($postedToken)) {
            $time = date('Y-m-d H:i:s');

            if ($login != 1) {
                echo "<script>window.location.replace('login.php')</script>";
                exit();
            }

            //--------------------------------------------------
            //                CREATE ORDEDR 
            //--------------------------------------------------

            if ($type == 'checkout') {

                $empty_input = 0; // check is input empty
                if ($_POST['name'] == "" || $_POST['name'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_name = $_POST['name'];
                }

                if ($_POST['email'] == "" || $_POST['email'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_email = $_POST['email'];
                }

                if ($_POST['phone'] == "" || $_POST['phone'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_contact = $_POST['phone'];
                }

                if ($_POST['address'] == "" || $_POST['address'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_address = $_POST['address'];
                }

                if ($_POST['state'] == "" || $_POST['state'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_state = $_POST['state'];
                }

                if ($_POST['postcode'] == "" || $_POST['postcode'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_postcode = $_POST['postcode'];
                }

                if ($_POST['city'] == "" || $_POST['city'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_city = $_POST['city'];
                }
                if ($empty_input == 0) {

                    //------------------------------------------
                    //		To get tracking with no repeat
                    //------------------------------------------

                    $check_track = 0;
                    $track_code = 'CA' . random_string(8);
                    $check_track_code = $db->where('track_code', 'orders', 'track_code', $track_code);

                    if (count($check_track_code) > 0) { //if count track code more than 1
                        do {

                            $track_code = 'CA' . random_string(8);
                            $check_track_code = $db->where('track_code', 'orders', 'track_code', $track_code);

                            if (count($check_track_code) == 0) {
                                $check_track = 1;
                            }
                        } while ($check_track != 1);
                    }
                    //------------------------------------------

                    $order_id = $_POST['order_id'];
                    $total_price = 0;
                    $total_payment = 0;
                    $discount_percent = 0;
                    $discount_amount = 0;
                    $discount_reward = 0;
                    $shipping = 0;
                    $total_point_earn = 0;

                    $table = "cart c left join product_role_price pp on c.product_id = pp.product_id left join product p on c.product_id = p.id";
                    $col = "c.product_id as product_id, c.qty as qty, pp.price as price, p.point as point";
                    $opt = 'c.customer_id = ? && pp.type = ?';
                    $arr = array($user_id, $user_type);
                    $result_cart = $db->advwhere($col, $table, $opt, $arr);
                    if ($result_cart) {
                        //count item sub total price for get total payment amount
                        foreach ($result_cart as $cart) {
                            $normal_price = $cart['price'];
                            if ($user_type == 1) {
                                $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified DESC';
                                $arr = array(1, $cart['product_id'], $time, $time);
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
                                    $price_display = $promo_price;
                                } else {
                                    $price_display = $normal_price;
                                }
                            } else {
                                $price_display = $normal_price;
                            }
                            $total_price = $total_price + ($cart['qty'] * $price_display);
                            $total_point_earn = $total_point_earn + ($cart['qty'] * $cart['point']);
                        }
                        $total_payment = $total_price;

                        //------------------------------------------
                        //  check delivery type , paymeny type, admin id
                        //------------------------------------------

                        $delivery_type = $_POST['delivery_type'];
                        $payment_type = $_POST['payment_type'];

                        //delivery type 2 = self collect
                        if ($delivery_type == 2) {
                            $shipping = 0;
                        }

                        // when payment = cash(2), order will skip online payment step, direct success and wait distritor to approce on panel
                        if ($payment_type == 2) {
                            $status_order = 2;
                        } else {
                            $status_order = 1;
                        }

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
                        } else {
                            $admin_id = 0;
                        }
                        //------------------------------------------
                        //------------------------------------------
                        // write discount algorithm here
                        //------------------------------------------

                        // check shipping fee here
                        $shipping_return = get_shipping_fee($user_id, $customer_state, $admin_id, $delivery_type, $db);

                        if ($shipping_return['Status']) {
                            $shipping = $shipping_return['Shipping_fee'];
                        } else {
                            $msg = $shipping_return['Msg'];
                            echo "<script> alert(\" $msg \");
                                window.location.href='../checkout.php';</script>";
                            exit();
                        }

                        // if user typr = 2 or 3 (distributor or dealer), will no have coupon
                        if (isset($_POST['coupon'])) {
                            $coupon_code = $_POST['coupon'];
                        } else {
                            $coupon_code = "";
                        }

                        //check coupon use
                        if ($coupon_code != "") {
                            //total_paymenrt - discount in function
                            $coupon_return = validate_coupon($coupon_code, $user_id, $user_type, $total_payment, $shipping, $db);

                            if ($coupon_return['Status']) {
                                $total_payment = $coupon_return['Total_pay'];
                                $discount_percent = $coupon_return['Percentage'];
                                $discount_amount = $coupon_return['Amount'];
                                $shipping = $coupon_return['Shipping'];
                            }
                        }

                        $point_use = $_POST['reward_point'];
                        if ($point_use == 1) {
                            //total_paymenrt - discount not function
                            $point_discount_return = get_point_discount($user_id, $point_use, $db);
                            if ($point_discount_return['Status']) {
                                $discount_reward = $point_discount_return['Point_discount'];
                            } else {
                                $discount_reward = 0;
                            }
                        } else {
                            $discount_reward = 0;
                        }


                        $result_gst_value = $db->get("*", "gst_value", 1);
                        if (count($result_gst_value) != 0) {
                            $gst_value = $result_gst_value[0]['value'];
                        } else {
                            $gst_value = 0;
                        }

                        $gst_tax = ($total_price * ($gst_value / 100));

                        $total_payment = $total_payment - $discount_reward + $shipping + $gst_tax;
                        //------------------------------------------


                        $reason = "UnPaid";
                        $table = "orders";
                        $colname = array("status", "customer_name", "customer_email", "customer_address", "customer_postcode", "customer_city", "customer_state", "customer_contact", "total_price", "coupon_code", "discount_percent", "discount_amount", "discount_reward", "shipping_fee", "gst_rate", "gst_fee", "total_payment", "track_code", "gateway_order_id", "payment_type", "delivery_type",  "reason", "users_id", "admin_id", "reward_point", "date_created", "date_modified");
                        $array = array($status_order, $customer_name, $customer_email, $customer_address, $customer_postcode, $customer_city, $customer_state, $customer_contact, $total_price, $coupon_code, $discount_percent, $discount_amount, $discount_reward, $shipping, $gst_value, $gst_tax, $total_payment, $track_code, $order_id, $payment_type, $delivery_type, $reason, $user_id, $admin_id, $total_point_earn, $time, $time);
                        $result_order = $db->insert($table, $colname, $array);

                        if ($result_order) {


                            //--------------------------
                            //  get order id inserted
                            //--------------------------
                            $table = "orders";
                            $col = "id, customer_email";
                            $opt = 'date_created = ?';
                            $arr = array($time);
                            $order = $db->advwhere($col, $table, $opt, $arr);
                            $order_id = $order[0]['id'];
                            $email = $order[0]['customer_email'];
                            //--------------------------


                            //------------------------------------------
                            // move cart record to order_items table
                            //------------------------------------------
                            foreach ($result_cart as $cart) {
                                $normal_price = $cart['price'];
                                if ($user_type == 1) {
                                    $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                    $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                    $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified DESC';
                                    $arr = array(1, $cart['product_id'], $time, $time);
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
                                        $price_display = $promo_price;
                                    } else {
                                        $price_display = $normal_price;
                                    }
                                } else {
                                    $price_display = $normal_price;
                                }
                                $table = "order_items";
                                $colname = array("product_id", "qty", "price", "point", "order_id", "date_created", "date_modified");
                                $array = array($cart['product_id'], $cart['qty'], $price_display, $cart['point'], $order_id, $time, $time);
                                $result_order_item = $db->insert($table, $colname, $array);
                            }

                            //------------------------------------------
                            if ($result_order_item) {
                                //if payment type is 1 (online payment)
                                if ($payment_type == 1) {
?>
                                    <html>

                                    <head>
                                        <title>Send data back to order</title>
                                    </head>

                                    <body onload="document.order.submit()">
                                        <form name="order" method="post" action="../checkout.php">
                                            <input type="hidden" name="detail" value="<?php echo $_POST['detail']; ?>">
                                            <input type="hidden" name="amount" value="<?php echo $total_payment; ?>">
                                            <input type="hidden" name="order_id" value="<?php echo $_POST['order_id']; ?>">
                                            <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
                                            <input type="hidden" name="email" value="<?php echo $_POST['email']; ?>">
                                            <input type="hidden" name="phone" value="<?php echo $_POST['phone']; ?>">
                                            <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
                                            <input type="hidden" name="state" value="<?php echo $_POST['state']; ?>">
                                            <input type="hidden" name="city" value="<?php echo $_POST['city']; ?>">
                                            <input type="hidden" name="postcode" value="<?php echo $_POST['postcode']; ?>">

                                        </form>
                                    </body>

                                    </html>
<?php
                                } else {

                                    //------------------------------
                                    // reduce product stock
                                    //------------------------------
                                    $table = "cart c left join product_role_price pp on c.product_id = pp.product_id";
                                    $col = "c.product_id as product_id, c.qty as qty, pp.price as price";
                                    $opt = 'c.customer_id = ? && pp.type = ?';
                                    $arr = array($user_id, $user_type);
                                    $result_cart = $db->advwhere($col, $table, $opt, $arr);

                                    // loop all product in cart
                                    foreach ($result_cart as $cart) {


                                        if ($user_type == 3) {
                                            // get product detail.
                                            $col = "product_id, stock";
                                            $table = "distributor_product";
                                            $opt = 'product_id = ? && user_id = ?';
                                            $arr = array($cart['product_id'], $admin_id);
                                            $product = $db->advwhere($col, $table, $opt, $arr);

                                            //if product exists then execute
                                            if ($product) {

                                                $product_id = $product[0]["product_id"];
                                                $product_stock = $product[0]["stock"];
                                                $reduced_prodcut_stock = $product_stock - $cart['qty'];

                                                $tablename = "distributor_product";
                                                $data = "stock = ?, date_modified = ? WHERE product_id = ? && user_id = ?";
                                                $array = array($reduced_prodcut_stock, $time, $product_id, $admin_id);
                                                $result_reduce_stock = $db->update($tablename, $data, $array);
                                            } else {
                                                continue;
                                            }
                                        } else {
                                            // get product detail.
                                            $col = "id, stock";
                                            $table = "product";
                                            $opt = 'id = ?';
                                            $arr = array($cart['product_id']);
                                            $product = $db->advwhere($col, $table, $opt, $arr);

                                            //if product exists then execute
                                            if ($product) {

                                                $product_id = $product[0]["id"];
                                                $product_stock = $product[0]["stock"];
                                                $reduced_prodcut_stock = $product_stock - $cart['qty'];

                                                $tablename = "product";
                                                $data = "stock = ?, date_modified = ? WHERE id = ?";
                                                $array = array($reduced_prodcut_stock, $time, $product_id);
                                                $result_reduce_stock = $db->update($tablename, $data, $array);
                                            } else {
                                                continue;
                                            }
                                        }
                                    }

                                    //------------------------------
                                    // reduce product stock
                                    //------------------------------

                                    //------------------------------
                                    // Clear Cart Table
                                    //------------------------------
                                    $table = "cart";
                                    $remove_from_cart = $db->del($table, 'customer_id', $user_id);

                                    //------------------------------
                                    // Clear Cart Table
                                    //------------------------------

                                    //--------------------------
                                    //       for email
                                    //--------------------------

                                    $col = "o.*, o.id as order_id, st.name as state_name, u.name as user_name, o.reason as reason";
                                    $tb = "orders o left join state st on o.customer_state = st.id left join users u on u.id = o.users_id";
                                    $opt = 'o.id = ?';
                                    $arr = array($order_id);
                                    $order = $db->advwhere($col, $tb, $opt, $arr);
                                    $order = $order[0];


                                    $table = "order_items o left join product p on o.product_id = p.id left join product_translation pt on o.product_id = pt.product_id";
                                    $col = "o.id as id, o.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, o.price as price";
                                    $opt = 'o.order_id = ? AND pt.language = ? ';
                                    $arr = array($order_id, "en");
                                    $order_item = $db->advwhere($col, $table, $opt, $arr);

                                    $order_detail = array("order" => $order, "order_item" => $order_item, "server_path" => $server_path);

                                    require_once "../administrator/vendor/autoload.php";
                                    //PHPMailer Object
                                    $mail = new PHPMailer;
                                    // $mail->SMTPDebug = 3;
                                    $mail->isSMTP();
                                    $mail->Host = $email_host;
                                    $mail->SMTPAuth = true;
                                    $mail->Username = $email_username;
                                    $mail->Password = $email_password;
                                    $mail->SMTPSecure = "tls";
                                    $mail->Port = "587";
                                    //Send HTML or Plain Text email
                                    $mail->isHTML(true);
                                    //From email address and name
                                    $mail->From = $email_from;
                                    $mail->FromName = $email_from_name;
                                    //--------------------------
                                    //       for email
                                    //--------------------------

                                    //To address and name
                                    $mail->addAddress($email);
                                    $mail->Subject = "Purchase Successful";
                                    $mail->Body = get_include_contents('../administrator/mail/purchase_success_mail.php', $order_detail);
                                    // $mail->send();
                                    if (!$mail->send()) {
                                        // echo "Mailer Error: " . $mail->ErrorInfo;
                                        echo "<script> alert(\" Order Successful, But send mail Fail. Please check your order list.\");
                                    window.location.href='../my-account/index.php';</script>";
                                    } else {
                                        // if something done, run this
                                        echo "<script> alert(\" Order Successful, Please check your order list.\");
                                    window.location.href='../my-account/index.php';</script>";
                                    }
                                    //----------------------------
                                    //		Email code here(end)
                                    //----------------------------
                                }
                            }
                        } else {
                            echo "<script>alert(\" Checkout Fail. Please try again.\");
                             window.location.href='../shop.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Your Cart Is Empty. Add Product To Your Cart For Checkout. Thank You\");
                        window.location.href='../shop.php';</script>";
                    }
                } else { // end check empty input
                    echo "<script>alert(\" Your Input cannot be empty\");
                    window.location.href='../checkout.php';</script>";
                }
            }
            //--------------------------------------------------
            //                CREATE ORDEDR 
            //--------------------------------------------------


            //--------------------------------------------------
            //                PAYMENT SUCCESS 
            //--------------------------------------------------
            else if ($type == 'payment_success') {
                $success = $_REQUEST['success'];
                if ($success == "1") {

                    $gateway_order_id = $_POST['order_id'];

                    //get order id
                    $col = "*";
                    $table = "orders";
                    $opt = 'gateway_order_id = ?';
                    $arr = array($gateway_order_id);
                    $order = $db->advwhere($col, $table, $opt, $arr);

                    $order_id = $order[0]['id'];
                    $email = $order[0]['customer_email'];
                    $coupon_code = $order[0]['coupon_code'];
                    $gateway_order_id = $order[0]['gateway_order_id'];

                    $tablename = "orders";
                    $data = "status = ?, date_modified = ? WHERE id = ?";
                    $array = array(2, $time, $order_id);
                    $result = $db->update($tablename, $data, $array);

                    if ($result) {

                        //------------------------------
                        // Add coupon times used
                        //------------------------------ 
                        $col = "*";
                        $table = "coupon";
                        $opt = 'code = ?';
                        $arr = array($coupon_code);
                        $coupon = $db->advwhere($col, $table, $opt, $arr);
                        if (count($coupon) != 0) {
                            $total_times_used = $coupon[0]["total_times_used"];
                            $added_total_times_used = $total_times_used + 1;
                            $tablename = "coupon";
                            $data = "total_times_used = ? WHERE code = ?";
                            $array = array($added_total_times_used, $coupon_code);
                            $db->update($tablename, $data, $array);
                        }


                        //--------------------------------------------------
                        //              Reduce user point
                        $col = "*";
                        $tb = "user_point";
                        $opt = 'user_id = ?';
                        $arr = array($user_id);
                        $user_point = $db->advwhere($col, $tb, $opt, $arr);
                        if (count($user_point) != 0) {

                            //-----------------------
                            //      get point value
                            $result_point_value = $db->get("*", "reward_point_value", 1);
                            if (count($result_point_value) != 0) {
                                $point_value = $result_point_value[0]['value'];
                            } else {
                                $point_value = 1;
                            }
                            //-----------------------

                            $point_used = ($order[0]['discount_reward'] * 100) * $point_value;
                            $negative_amount = $point_used * -1; // insert negative number to db, for identify it is reducing

                            $user_point = $user_point[0];
                            $current_point = $user_point["point"];
                            $reduced_point = $current_point - $point_used;
                            $description = "Purchase Point Discount. Order ID: " . $gateway_order_id;

                            $tablename = "user_point";
                            $data = "point =?,  date_modified =? WHERE user_id = ?";
                            $array = array($reduced_point, $time, $user_id);
                            $result_user_point = $db->update($tablename, $data, $array);

                            if ($result_user_point) {

                                //   Add Histroy to user_point_transaction_history
                                $table = "user_point_transaction_history";
                                $colname = array("point", "current_point", "description", "user_id", "date_created", "date_modified");
                                $array = array($negative_amount, $reduced_point, $description, $user_id, $time, $time);
                                $result_user_point_history = $db->insert($table, $colname, $array);
                            }
                        }
                        //--------------------------------------------------


                        //------------------------------
                        // reduce product stock
                        //------------------------------
                        $table = "cart c left join product_role_price pp on c.product_id = pp.product_id";
                        $col = "c.product_id as product_id, c.qty as qty, pp.price as price";
                        $opt = 'c.customer_id = ? && pp.type = ?';
                        $arr = array($user_id, $user_type);
                        $result_cart = $db->advwhere($col, $table, $opt, $arr);

                        // loop all product in cart
                        foreach ($result_cart as $cart) {

                            // get product detail.
                            $col = "id, stock";
                            $table = "product";
                            $opt = 'id = ?';
                            $arr = array($cart['product_id']);
                            $product = $db->advwhere($col, $table, $opt, $arr);

                            //if product exists then execute
                            if ($product) {

                                $product_id = $product[0]["id"];
                                $product_stock = $product[0]["stock"];
                                $reduced_prodcut_stock = $product_stock - $cart['qty'];

                                $tablename = "product";
                                $data = "stock = ?, date_modified = ? WHERE id = ?";
                                $array = array($reduced_prodcut_stock, $time, $product_id);
                                $result_reduce_stock = $db->update($tablename, $data, $array);
                            } else {
                                continue;
                            }
                        }

                        //------------------------------
                        // reduce product stock
                        //------------------------------

                        //------------------------------
                        // Clear Cart Table
                        //------------------------------
                        $table = "cart";
                        $remove_from_cart = $db->del($table, 'customer_id', $user_id);

                        //------------------------------
                        // Clear Cart Table
                        //------------------------------



                        //--------------------------
                        //       for email
                        //--------------------------

                        $col = "o.*, o.id as order_id, st.name as state_name, u.name as user_name, o.reason as reason";
                        $tb = "orders o left join state st on o.customer_state = st.id left join users u on u.id = o.users_id";
                        $opt = 'o.id = ?';
                        $arr = array($order_id);
                        $order = $db->advwhere($col, $tb, $opt, $arr);
                        $order = $order[0];


                        $table = "order_items o left join product p on o.product_id = p.id left join product_translation pt on o.product_id = pt.product_id";
                        $col = "o.id as id, o.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, o.price as price";
                        $opt = 'o.order_id = ? AND pt.language = ? ';
                        $arr = array($order_id, "en");
                        $order_item = $db->advwhere($col, $table, $opt, $arr);

                        $order_detail = array("order" => $order, "order_item" => $order_item, "server_path" => $server_path);

                        require_once "../administrator/vendor/autoload.php";
                        //PHPMailer Object
                        $mail = new PHPMailer;
                        // $mail->SMTPDebug = 3;
                        $mail->isSMTP();
                        $mail->Host = $email_host;
                        $mail->SMTPAuth = true;
                        $mail->Username = $email_username;
                        $mail->Password = $email_password;
                        $mail->SMTPSecure = "tls";
                        $mail->Port = "587";
                        //Send HTML or Plain Text email
                        $mail->isHTML(true);
                        //From email address and name
                        $mail->From = $email_from;
                        $mail->FromName = $email_from_name;
                        // $mail->AddEmbeddedImage('../img/product/PROD1601368421.png', 'pic1');
                        // $mail->AddEmbeddedImage('../img/product/PROD1601370800.png', 'pic2');
                        // $mail->AddEmbeddedImage('../img/product/PROD1601374119.png', 'pic3');
                        //--------------------------
                        //       for email
                        //--------------------------

                        //To address and name
                        $mail->addAddress($email);
                        $mail->Subject = "Purchase Successful";
                        $mail->Body = get_include_contents('../administrator/mail/purchase_success_mail.php', $order_detail);
                        $mail->send();
                        // if (!$mail->send()) {
                        //     echo "Mailer Error: " . $mail->ErrorInfo;
                        // } else {
                        //     echo "Message has been sent successfully2";
                        // }
                        //----------------------------
                        //		Email code here(end)
                        //----------------------------

                        // if something done, run this
                        echo "<script> window.location.href='../my-account/index.php';</script>";
                    } else { //end result
                        echo "<script>alert(\" Update Status Fail. Please Contact admin. Your order number: $gateway_order_id\");
                                 window.location.href='../my-account/index.php?p=1';</script>";
                    }
                } //end $success==1
            } // end else if

            //--------------------------------------------------
            //                PAYMENT SUCCESS 
            //--------------------------------------------------
        } else {
            echo "Token Expired. Please Try Again";
        }
    } else {
        echo "Token Is Required.";
    }
}

function validate_coupon($coupon_code, $user_id, $user_type, $sub_total, $shipping, $db)
{

    $table = 'coupon';
    $col = "*";
    $opt = 'code = ?';
    $arr = array($coupon_code);
    $coupon = $db->advwhere($col, $table, $opt, $arr);

    if (count($coupon) <= 0) {
        $json_arr = array('Status' => false, 'Msg' => 'Coupon Code No Exists!');
    } else {
        $coupon = $coupon[0];

        $id = $coupon['id'];
        $status = $coupon['status'];
        $type = $coupon['type'];
        $amt = $coupon['amt'];
        $percentage = $coupon['percentage'];
        $min_spend = $coupon['min_spend'];
        $capped = $coupon['capped'];
        $free_delivery = $coupon['free_delivery'];
        $usage_limit = $coupon['usage_limit']; // how many time can be used per 1 user
        $total_usage_limit = $coupon['total_usage_limit'];
        $total_times_used = $coupon['total_times_used'];

        //check status of coupon
        if ($status == 1) {

            //check cart is it exists available product
            $count_product = 0;

            $table = "cart c left join coupon_product cp on c.product_id = cp.product_id left join product_role_price pp on c.product_id = pp.product_id";
            $col = "c.qty as qty, pp.price as price";
            $opt = 'c.customer_id = ? && cp.coupon_id = ? && pp.type = ?';
            $arr = array($user_id, $id, $user_type);
            $get_coupon_product = $db->advwhere($col, $table, $opt, $arr);

            if ($get_coupon_product != 0) {
                //check minimum spend
                // if want count only the product in the coupon, change sub_total to 0 and remove comment
                $total_spend = 0; // the product spend available in this coupon

                //------------------------------------------
                // This only count the product in the coupon
                //------------------------------------------
                foreach ($get_coupon_product as $product) {
                    $total_spend += $product['qty'] * $product['price'];
                }
                //------------------------------------------
                // This only count the product in the coupon
                //------------------------------------------

                if ($sub_total > $min_spend) {
                    //check total limit of the coupon
                    if ($total_times_used < $total_usage_limit) {
                        //check user limit of the coupon
                        $table = 'orders';
                        $col = "*";
                        $opt = 'users_id =? && coupon_code = ? && status != ?';
                        $arr = array($user_id, $coupon_code, 1);
                        $check_user_coupon_used = $db->advwhere($col, $table, $opt, $arr);

                        if (count($check_user_coupon_used) < $usage_limit) {
                            //check type

                            if ($type == 1) {
                                //if amount return amount reduce
                                $reduce_amt = $amt;
                            } else if ($type == 2) {
                                //if percentage, count amount to reduce with no more than capped 
                                $reduce_amt = $total_spend * ($percentage / 100);
                                if ($reduce_amt > $capped) {
                                    $reduce_amt = $capped;
                                }
                            }

                            if ($free_delivery == 1) {
                                $shipping = 0;
                            }

                            //--------------------------------------------
                            //      All true will return this
                            //--------------------------------------------
                            $total_pay = $sub_total - $reduce_amt;
                            $json_arr = array('Status' => true, 'Amount' => $reduce_amt, 'Percentage' => $percentage, "Total" => $total_spend, "Total_pay" => $total_pay, "Shipping" => $shipping);

                            //--------------------------------------------
                            //      All true will return this
                            //--------------------------------------------

                        } else {
                            $json_arr = array('Status' => false, 'Msg' => 'You have reached the maximum number of uses of this coupon!');
                        }
                    } else {
                        $json_arr = array('Status' => false, 'Msg' => 'This coupon has reached the maximum number of uses!');
                    }
                } else {
                    $json_arr = array('Status' => false, 'Msg' => 'Your consumption has not reached the minimum consumption! Minimum spend is RM' . $min_spend);
                }
            } else {
                $json_arr = array('Status' => false, 'Msg' => 'The products in cart do not exist in the scope of the coupon!');
            }
        } else {
            $json_arr = array('Status' => false, 'Msg' => 'Coupon Code Is Not Available!');
        }
    }

    return $json_arr;
}

function get_shipping_fee($user_id, $state, $admin_id, $delivery_type, $db)
{
    if ($delivery_type == 2) {
        $shipping_fee = 0;
        $json_arr = array('Status' => true, 'Shipping_fee' => $shipping_fee);
    } else {
        $table = 'shipping s left join geo_zone g on s.geo_zone = g.id left join geo_zone_list gl on g.id = gl.geo_zone_id';
        $col = "*, (first_weight*first_price)+(next_weight*next_price) as check_fee";
        $opt = 's.admin_id = ? && (gl.state_id = ? || gl.state_id = ?) && s.status = ? order by check_fee ASC';
        $arr = array($admin_id, $state, 0, 1);
        $shipping = $db->advwhere($col, $table, $opt, $arr);
        // var_dump($shipping);
        if (count($shipping) <= 0) {
            $json_arr = array('Status' => false, 'Msg' => 'State is not Available. No Shipping Fee Detail! Please Contact Admin');
        } else {
            $shipping = $shipping[0];

            $first_weight = $shipping['first_weight'];
            $first_price = $shipping['first_price'];
            $next_weight = $shipping['next_weight'];
            $next_price = $shipping['next_price'];
            $charge = $shipping['charge'];

            $table = "cart c left join product p on c.product_id = p.id";
            $col = "c.product_id as product_id, c.qty as qty, p.weight as weight";
            $opt = 'c.customer_id = ?';
            $arr = array($user_id);
            $result_cart = $db->advwhere($col, $table, $opt, $arr);

            // check cart is exists item
            if (count($result_cart) != 0) {
                $total_weight = 0;
                //count item total weight
                foreach ($result_cart as $cart) {
                    $total_weight = $total_weight + ($cart['qty'] * $cart['weight']);
                }

                if ($total_weight <= $first_weight) {
                    $shipping_fee = $first_price;
                } else {
                    $remain_weight = $total_weight - $first_weight;
                    $shipping_fee = $first_price;

                    while ($remain_weight > 0) {
                        $shipping_fee = $shipping_fee + $next_price;
                        $remain_weight = $remain_weight - $next_weight;
                    }
                }
                $shipping_fee = $shipping_fee + ($shipping_fee * ($charge / 100));
                $json_arr = array('Status' => true, 'Shipping_fee' => $shipping_fee);
            } else {
                $json_arr = array('Status' => false, 'Msg' => 'Your Cart is Empty!');
            }
        }
    }
    return $json_arr;
}

function get_point_discount($user_id, $point_use, $db)
{
    if ($point_use == 1) {

        $table = "cart c left join product p on c.product_id = p.id";
        $col = "c.product_id as product_id, c.qty as qty, p.weight as weight, p.point as point, p.point_allow_discount as point_allow_discount";
        $opt = 'c.customer_id = ?';
        $arr = array($user_id);
        $result_cart = $db->advwhere($col, $table, $opt, $arr);

        // check cart is exists item
        if (count($result_cart) != 0) {
            $total_point = 0;
            //count item total weight
            foreach ($result_cart as $cart) {
                $total_point = $total_point + ($cart['qty'] * $cart['point_allow_discount']); // for reduce check
            }
            //----------------------------------------------
            //  count reward point
            if ($point_use == 1) {
                $table = 'user_point';
                $col = "*";
                $opt = 'user_id =?';
                $arr = array($user_id);
                $user_point = $db->advwhere($col, $table, $opt, $arr);
                if (count($user_point) != 0) {
                    $current_point = $user_point[0]["point"];

                    // write point limit calculation here
                    // to limit point use
                    if ($current_point > $total_point) {
                        $point_use = $total_point;
                    } else {
                        $point_use = $current_point;
                    }
                    //-----------------------
                    //      get point value
                    $result_point_value = $db->get("*", "reward_point_value", 1);
                    if (count($result_point_value) != 0) {
                        $point_value = $result_point_value[0]['value'];
                    } else {
                        $point_value = 1;
                    }
                    //-----------------------
                    $reduce_point_fee = ($point_use / 100) * $point_value;
                } else {
                    $reduce_point_fee = 0;
                }
            } else {
                $reduce_point_fee = 0;
            }

            //----------------------------------------------
            $json_arr = array('Status' => true, 'Point_discount' => $reduce_point_fee);
        } else {
            $json_arr = array('Status' => false, 'Msg' => 'Your Cart is Empty!');
        }
    } else {
        $reduce_point_fee = 0;
        $json_arr = array('Status' => true, 'Point_discount' => $reduce_point_fee);
    }
    return $json_arr;
}
