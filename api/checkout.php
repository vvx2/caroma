<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
    $postedToken = filter_input(INPUT_POST, 'token');
    if (!empty($postedToken)) {
        if (isTokenValid($postedToken)) {
            $time = date('Y-m-d H:i:s');

            $login = $_SESSION['login'];
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
                            $total_price = $total_price + ($cart['qty'] * $cart['price']);
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
                        $colname = array("status", "customer_name", "customer_email", "customer_address", "customer_postcode", "customer_city", "customer_state", "customer_contact", "total_price", "coupon_code", "discount_percent", "discount_amount", "total_payment", "track_code", "gateway_order_id", "users_id", "date_created", "date_modified");
                        $array = array(1, $customer_name, $customer_email, $customer_address, $customer_postcode, $customer_city, $customer_state, $customer_contact, $total_price, $coupon_code, $discount_percent, $discount_amount, $total_payment, $track_code, $order_id, $user_id, $time, $time);
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
?>
                                <html>

                                <head>
                                    <title>Send data back to order</title>
                                </head>

                                <body onload="document.order.submit()">
                                    <form name="order" method="post" action="../checkout.php">
                                        <input type="hidden" name="detail" value="<?php echo $_POST['detail']; ?>">
                                        <input type="hidden" name="amount" value="<?php echo $_POST['amount']; ?>">
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

                    $tablename = "orders";
                    $data = "status = ?, date_modified = ? WHERE id = ?";
                    $array = array(2, $time, $order_id);
                    $result = $db->update($tablename, $data, $array);

                    if ($result) {
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
                        $opt = 'customer_id = ?';
                        $arr = array($user_id);
                        $remove_from_cart = $db->advdel($table, $opt, $arr);

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
