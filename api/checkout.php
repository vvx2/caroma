<?php
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
                    $shipping = 0;

                    $table = "cart c left join product_role_price pp on c.product_id = pp.product_id";
                    $col = "c.product_id as product_id, c.qty as qty, pp.price as price";
                    $opt = 'c.customer_id = ? && pp.type = ?';
                    $arr = array($user_id, $user_type);
                    $result_cart = $db->advwhere($col, $table, $opt, $arr);
                    if ($result_cart) {
                        //count item sub total price for get total payment amount
                        foreach ($result_cart as $cart) {
                            $total_price = $total_price + ($cart['qty'] * $cart['price']);
                        }
                        $total_payment = $total_price;
                        //------------------------------------------
                        // write discount algorithm here
                        //------------------------------------------

                        // check shipping fee here
                        //todo

                        // if user typr = 2 or 3 (distributor or dealer), will no have coupon
                        if (isset($_POST['coupon'])) {
                            $coupon_code = $_POST['coupon'];
                        } else {
                            $coupon_code = "";
                        }

                        //check coupon use
                        if ($coupon_code != "") {
                            $coupon_return = validate_coupon($coupon_code, $user_id, $user_type, $total_payment, $shipping, $db);

                            if ($coupon_return['Status']) {
                                $total_payment = $coupon_return['Total_pay'];
                                $discount_percent = $coupon_return['Percentage'];
                                $discount_amount = $coupon_return['Amount'];
                                $shipping = $coupon_return['Shipping'];
                            }
                        }
                        //------------------------------------------

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
                            $opt = 'users_id =?';
                            $arr = array($user_id);
                            $dealer = $db->advwhere($col, $table, $opt, $arr);
                            $under_distributor = $dealer[0]['under_distributor'];

                            $admin_id = $under_distributor;
                        } else {
                            $admin_id = 0;
                        }
                        //------------------------------------------

                        $table = "orders";
                        $colname = array("status", "customer_name", "customer_email", "customer_address", "customer_postcode", "customer_city", "customer_state", "customer_contact", "total_price", "coupon_code", "discount_percent", "discount_amount", "shipping_fee", "total_payment", "track_code", "gateway_order_id", "payment_type", "users_id", "admin_id", "date_created", "date_modified");
                        $array = array($status_order, $customer_name, $customer_email, $customer_address, $customer_postcode, $customer_city, $customer_state, $customer_contact, $total_price, $coupon_code, $discount_percent, $discount_amount, $shipping, $total_payment, $track_code, $order_id, $payment_type, $user_id, $admin_id, $time, $time);
                        $result_order = $db->insert($table, $colname, $array);

                        if ($result_order) {


                            //--------------------------
                            //  get order id inserted
                            //--------------------------
                            $table = "orders";
                            $col = "id";
                            $opt = 'date_created = ?';
                            $arr = array($time);
                            $order = $db->advwhere($col, $table, $opt, $arr);
                            $order_id = $order[0]['id'];
                            //--------------------------


                            //------------------------------------------
                            // move cart record to order_items table
                            //------------------------------------------
                            foreach ($result_cart as $cart) {

                                $table = "order_items";
                                $colname = array("product_id", "qty", "price", "order_id", "date_created", "date_modified");
                                $array = array($cart['product_id'], $cart['qty'], $cart['price'], $order_id, $time, $time);
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
                                    echo "<script> alert(\" Order Successful, Please check your order list.\");
                                    window.location.href='../shop.php';</script>";
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

                        // if something done, run this
                        echo "<script> window.location.href='../shop.php';</script>";
                    } else { //end result
                        echo "Update Status Fail. Please Contact admin. Your order number: $gateway_order_id";
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
                $total_spend = $sub_total;

                //------------------------------------------
                // This only count the product in the coupon
                //------------------------------------------
                // foreach ($get_coupon_product as $product) {
                //     $total_spend += $product['qty'] * $product['price'];
                // }
                //------------------------------------------
                // This only count the product in the coupon
                //------------------------------------------

                if ($total_spend > $min_spend) {
                    //check total limit of the coupon
                    if ($total_times_used < $total_usage_limit) {
                        //check user limit of the coupon
                        $table = 'orders';
                        $col = "*";
                        $opt = 'users_id =? && coupon_code = ? && status = ?';
                        $arr = array($user_id, $coupon_code, 2);
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

                            //--------------------------------------------
                            //      All true will return this
                            //--------------------------------------------
                            $total_pay = $total_spend - $reduce_amt + $shipping;
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
