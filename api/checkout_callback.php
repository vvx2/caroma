<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();

$time = date('Y-m-d H:i:s');
/**
 * This is a sample code for manual integration with senangPay
 * It is so simple that you can do it in a single file
 * Make sure that in senangPay Dashboard you have key in the return URL referring to this file for example http://myserver.com/senangpay_sample.php
 */
// $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

// print_r($_SERVER);
// print_r($_POST);
// print_r($_GET);
// print_r($_FILES);

$string_server = implode("|", $_SERVER);
$string_post = implode("|", $_POST);
$string_get = implode("|", $_GET);

$table = "callback_log";
$colname = array("string_server", "string_post", "string_get", "date_created");
$array = array($string_server, $string_post, $string_get, $time);
$result_callback = $db->insert($table, $colname, $array);


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

# this part is to process the response received from senangPay, make sure we receive all required info
if (isset($_GET['status_id']) && isset($_GET['order_id']) && isset($_GET['msg']) && isset($_GET['transaction_id']) && isset($_GET['hash'])) {
    # verify that the data was not tempered, verify the hash
    $hashed_string = hash_hmac('sha256', $secretkey . urldecode($_GET['status_id']) . urldecode($_GET['order_id']) . urldecode($_GET['transaction_id']) . urldecode($_GET['msg']), $secretkey);

    # if hash is the same then we know the data is valid
    if ($hashed_string == urldecode($_GET['hash'])) {
        # this is a simple result page showing either the payment was successful or failed. In real life you will need to process the order made by the customer
        if (urldecode($_GET['status_id']) == '1') {

            //--------------------------------------------------
            //                PAYMENT SUCCESS 
            //--------------------------------------------------


            $gateway_order_id = $_GET['order_id'];

            //get order id
            $col = "*";
            $table = "orders";
            $opt = 'gateway_order_id = ?';
            $arr = array($gateway_order_id);
            $order = $db->advwhere($col, $table, $opt, $arr);

            // normally is variable set at routing.php, this is api, so have to set again
            $user_id = $order[0]['users_id'];
            $order_status = $order[0]['status'];
            if ($order_status == 2) {
                echo "OK";
                exit();
            }

            $col = "*";
            $tb = "users";
            $opt = 'id = ?';
            $arr = array($user_id);
            $users = $db->advwhere($col, $tb, $opt, $arr);

            $user_type = $users[0]['type'];

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
                //when user type is dealer, admin id will be distributor id - to identify the order belong who
                if ($user_type == 3) {
                    //get distributor id that dealer under with
                    $table = 'user_dealer ud left join users u on ud.under_distributor = u.id';
                    $col = "ud.under_distributor as under_distributor, u.email as admin_email, u.name as admin_name";
                    $opt = 'user_id =?';
                    $arr = array($user_id);
                    $dealer = $db->advwhere($col, $table, $opt, $arr);
                    $under_distributor = $dealer[0]['under_distributor'];
                    $admin_email = $dealer[0]['admin_email'];
                    $admin_id = $under_distributor;
                    $admin_name = $dealer[0]['admin_name'];
                } else {
                    $admin_name = "Caroma Administrator";
                }

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

                $order_detail = array("admin_name" => $admin_name, "order" => $order, "order_item" => $order_item, "server_path" => $server_path);

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
                $mail->send();
                // if (!$mail->send()) {
                //     echo "Mailer Error: " . $mail->ErrorInfo;
                // } else {
                //     echo "Message has been sent successfully2";
                // }
                //----------------------------
                //		Email code here(end)
                //----------------------------

                //----------------------------
                //		Admin Email code here
                //----------------------------
                $admin_mail = new PHPMailer;
                // $admin_mail->SMTPDebug = 3;
                $admin_mail->isSMTP();
                $admin_mail->Host = $email_host;
                $admin_mail->SMTPAuth = true;
                $admin_mail->Username = $email_username;
                $admin_mail->Password = $email_password;
                $admin_mail->SMTPSecure = "tls";
                $admin_mail->Port = "587";
                //Send HTML or Plain Text email
                $admin_mail->isHTML(true);
                //From email address and name
                $admin_mail->From = $email_from;
                $admin_mail->FromName = $email_from_name;
                //--------------------------
                //       for email
                //--------------------------

                //To address and name
                $admin_mail->addAddress($admin_email);
                $admin_mail->Subject = "New Order";
                $admin_mail->Body = get_include_contents('../administrator/mail/order_new_mail.php', $order_detail);
                $admin_mail->send();

                //----------------------------
                //		Admin Email code here(end)
                //----------------------------

                // if something done, run this
                echo "OK";
            } else { //end result
                echo "OK";
            }

            //--------------------------------------------------
            //                PAYMENT SUCCESS 
            //--------------------------------------------------

            exit();
        } else {
            echo 'OK';
        }
    } else
        echo 'OK';
}
# this part is to show the form where customer can key in their information
else {
    echo "OK";
}
