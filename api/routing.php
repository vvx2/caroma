<?php
require_once("../administrator/connection/PDO_db_function.php");
$db = new DB_Functions();


if (isset($_REQUEST['login_key'])) {

    if (strlen($_REQUEST['login_key']) >= 65) {

        $uid = $_REQUEST['login_key'];
        $uid = str_replace('_', '+', $uid);

        $key = 'enc_uid';
        $key = hash('sha256', $key, false);

        $uid = str_replace(' ', '', rtrim($uid, $key));

        if (is_numeric($uid)) {
            //get id and check user type
            $_SESSION['user_id'] = $uid;
            $type = $db->where('type', 'users', 'id', $uid);
            $user_type = $type[0]['type'];
            $_SESSION['type'] = $user_type;

            //-------------------------------
            // pass cart to db from session
            //-------------------------------

            if (isset($_SESSION['cart'])) {

                $time = date('Y-m-d H:i:s');
                foreach ($_SESSION['cart']['product'] as $key_product_id => $qty) {

                    if ($user_type == 3) {
                        
                        //get distributor id that dealer under with
                        $table = 'user_dealer';
                        $col = "*";
                        $opt = 'user_id =?';
                        $arr = array($uid);
                        $dealer = $db->advwhere($col, $table, $opt, $arr);
                        $under_distributor = $dealer[0]['under_distributor'];

                        $admin_id = $under_distributor;

                        $table = "distributor_product";
                        $col = "*";
                        $opt = 'product_id = ? && user_id = ?';
                        $arr = array($key_product_id, $admin_id);
                        $check_product_under_distributor = $db->advwhere($col, $table, $opt, $arr);

                        if ($check_product_under_distributor == 0) {
                            continue;
                        }
                        $product_stock = $check_product_under_distributor[0]['stock'];
                    } else {
                        $table = "product";
                        $col = "stock,status";
                        $opt = 'id = ?';
                        $arr = array($key_product_id);
                        $product = $db->advwhere($col, $table, $opt, $arr);
                        $product_stock = $product[0]["stock"];
                        
                    }

                    $table = "cart";
                    $col = "*";
                    $opt = 'product_id = ? && customer_id = ?';
                    $arr = array($key_product_id, $uid);
                    $check_cart_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_cart_isset) != 0) {
                        $cart_id = $check_cart_isset[0]["id"];
                        $cart_qty = $check_cart_isset[0]["qty"];

                        // check qty in the cart, sum it to check. sum cant more than stock
                        if (($cart_qty + $qty) > $product_stock) {
                            $qty = $product_stock;
                        } else {
                            $qty = $cart_qty + $qty;
                        }

                        $table = "cart";
                        $data = "qty = ?, date_modified = ? WHERE id = ? ";
                        $array = array($qty, $time, $cart_id);
                        $result_cart = $db->update($table, $data, $array);
                        
                    } else {

                        //qty cant more than product
                        if ($qty > $product_stock) {
                            $qty = $product_stock;
                        }

                        $table = "cart";
                        $colname = array("product_id", "qty", "customer_id", "date_created", "date_modified");
                        $array = array($key_product_id, $qty, $uid, $time, $time);
                        $result_cart = $db->insert($table, $colname, $array);
                        
                    }
                }

                unset($_SESSION['cart']);
                
            }

            //-------------------------------
            // pass cart to db from session
            //-------------------------------


            header("Location: ../my-account/index.php");
        }
    }
}
