<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    $postedToken = filter_input(INPUT_POST, 'token');
    if (!empty($postedToken)) {
        if (isTokenValid($postedToken)) {
            $time = date('Y-m-d H:i:s');

            $login = 1;
            $user_id = 1;
            $user_type = 3;
            $language = "en";

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

                if ($_POST['contact'] == "" || $_POST['contact'] == null) {
                    $empty_input + 1;
                } else {
                    $customer_contact = $_POST['contact'];
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

                    $total_price = 0;
                    $total_payment = 0;
                    $coupon_code = "";
                    $discount_percent = 0;
                    $discount_amount = 0;

                    $table = "cart c left join product_role_price pp on c.product_id = pp.product_id";
                    $col = "c.product_id as product_id, c.qty as qty, pp.price as price";
                    $opt = 'c.customer_id = ? && pp.type = ?';
                    $arr = array($user_id, $user_type);
                    $result_cart = $db->advwhere($col, $table, $opt, $arr);
                    if ($result_cart) {
                        //count item sub total price for get total payment amount
                        foreach ($result_cart as $cart) {
                            $total_price = $total_payment + ($cart['qty'] * $cart['price']);
                        }
                        $total_payment = $total_price;
                        //------------------------------------------
                        // write discount algorithm here
                        //------------------------------------------

                        //check coupon use

                        //if used coupon
                        //check coupon type
                        //if type is discount percentage
                        //if type is discount amount
                        //get total pay amount after discount

                        //if no use coupon
                        //totalpay = totalpay

                        //------------------------------------------


                        $table = "orders";
                        $colname = array("status", "customer_name", "customer_email", "customer_address", "customer_postcode", "customer_city", "customer_state", "customer_contact", "total_price", "coupon_code", "discount_percent", "discount_amount", "total_payment", "track_code", "users_id", "date_created", "date_modified");
                        $array = array(1, $customer_name, $customer_email, $customer_address, $customer_postcode, $customer_city, $customer_state, $customer_contact, $total_price, $coupon_code, $discount_percent, $discount_amount, $total_payment, $track_code, $user_id, $time, $time);
                        $result_order = $db->insert($table, $colname, $array);

                        if ($result_order) {


                            //--------------------------
                            //  get category id inserted
                            //--------------------------
                            $table = "orders";
                            $col = "id";
                            $opt = 'date_created = ?';
                            $arr = array($time);
                            $order = $db->advwhere($col, $table, $opt, $arr);
                            $order_id = $order[0]['id'];
                            //--------------------------


                            //------------------------------------------
                            // move cart record to order_items table and clear cart
                            //------------------------------------------
                            foreach ($result_cart as $cart) {

                                $table = "order_items";
                                $colname = array("product_id", "qty", "price", "order_id", "date_created", "date_modified");
                                $array = array($cart['product_id'], $cart['qty'], $cart['price'], $order_id, $time, $time);
                                $result_order_item = $db->insert($table, $colname, $array);
                            }

                            $table = "cart";
                            $opt = 'customer_id = ?';
                            $arr = array($user_id);
                            $remove_from_cart = $db->advdel($table, $opt, $arr);

                            //------------------------------------------
                            if ($remove_from_cart && $result_order_item) {
                                echo "<script>alert(\" Checkout Successful.\");
                                window.location.href='../shop.php';</script>";
                            } else {
                                echo "<script>alert(\" Checkout Successful, But record cart fail.\");
                                window.location.href='../shop.php';</script>";
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
            } else {
                echo "<script>alert(\" no type\");
                    window.location.href='../checkout.php';</script>";
            }
        } else {
            echo "Token Expired. Please Try Again";
        }
    } else {
        echo "Token Is Required.";
    }
}
