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

            if ($type == 'addtocart') {

                $product_id = $_POST['product_id'];
                $product_qty = $_POST['product_qty'];

                if ($login == 1) {



                    //---------------------------------------------
                    //      To check stock enough for add to cart
                    //--------------------------------------------
                    $table = "product";
                    $col = "stock,status";
                    $opt = 'id = ?';
                    $arr = array($product_id);
                    $product = $db->advwhere($col, $table, $opt, $arr);
                    $product_stock = $product[0]["stock"];

                    //todo
                    //check stock with distributor when user type is dealer
                    if ($user_type == 3) {

                        //get distributor id that dealer under with
                        $table = 'user_dealer';
                        $col = "*";
                        $opt = 'user_id =?';
                        $arr = array($user_id);
                        $dealer = $db->advwhere($col, $table, $opt, $arr);
                        $under_distributor = $dealer[0]['under_distributor'];

                        $admin_id = $under_distributor;

                        $table = "distributor_product";
                        $col = "*";
                        $opt = 'product_id = ? && user_id = ?';
                        $arr = array($product_id, $admin_id);
                        $check_product_under_distributor = $db->advwhere($col, $table, $opt, $arr);

                        $product_stock = $check_product_under_distributor[0]['stock'];
                    }
                    $table = "cart";
                    $col = "*";
                    $opt = 'product_id = ? && customer_id = ?';
                    $arr = array($product_id, $user_id);
                    $check_cart = $db->advwhere($col, $table, $opt, $arr);
                    if (count($check_cart) != 0) {
                        $cart_qty = $check_cart[0]["qty"];
                    } else {
                        $cart_qty = 0;
                    }

                    $product_add_qty = $cart_qty + $product_qty;
                    //---------------------------------------------
                    //      To check stock enough for add to cart
                    //--------------------------------------------

                    if ($product_stock >= $product_add_qty) {
                        // check cart is it isset in database
                        $table = "cart";
                        $col = "id, qty";
                        $opt = 'product_id = ? && customer_id = ?';
                        $arr = array($product_id, $user_id);
                        $check_cart_isset = $db->advwhere($col, $table, $opt, $arr);

                        if (count($check_cart_isset) == 0) {
                            $table = "cart";
                            $colname = array("product_id", "qty", "customer_id", "date_created", "date_modified");
                            $array = array($product_id, $product_qty, $user_id, $time, $time);
                            $result_cart = $db->insert($table, $colname, $array);
                        } else {

                            $cart_id = $check_cart_isset[0]["id"];
                            $cart_qty = $check_cart_isset[0]["qty"];
                            $qty = $cart_qty + $product_qty;

                            $table = "cart";
                            $data = "qty = ?, date_modified = ? WHERE id = ? ";
                            $array = array($qty, $time, $cart_id);
                            $result_cart = $db->update($table, $data, $array);
                        }

                        if ($result_cart) {
                            $json_arr = array('Status' => true, 'Reload' => true);
                        } else {
                            $json_arr = array('Status' => false, 'Msg' => 'Add To Cart Fail!');
                        }
                    } else {
                        $json_arr = array('Status' => false, 'Msg' => 'Stock Is Not Enough!');
                    }
                } else {

                    //Check IF SESSION Exist
                    if (isset($_SESSION['cart'])) {
                        $cart = $_SESSION['cart'];
                        if (isset($cart['product'][$product_id])) {
                            $product_qty = $product_qty + $cart['product'][$product_id];
                        }

                        $json_arr = array('Status' => true, 'Reload' => true);
                        $_SESSION['cart']['product'][$product_id] = $product_qty;
                    } else {
                        $json_arr = array('Status' => true, 'Reload' => false);
                        $_SESSION['cart'] = array('product' => array($product_id => $product_qty),);
                    }
                }

                $json_arr['Token'] = $token;
                echo json_encode($json_arr);
            } else if ($type == 'updatecart') {
                header('Location: ../shopping-cart.php');
                $cart = $_POST["qty_product"];
                // var_dump($cart);
                foreach ($cart as $key_product_id => $qty) {
                    $qty = intval($qty);
                    if (is_int($qty)) {
                        $qty = $qty;
                    } else {
                        $qty = 1;
                    }

                    if ($login == 1) {

                        //to check product qty
                        if ($user_type == 3) {

                            //get distributor id that dealer under with
                            $table = 'user_dealer';
                            $col = "*";
                            $opt = 'user_id =?';
                            $arr = array($user_id);
                            $dealer = $db->advwhere($col, $table, $opt, $arr);
                            $under_distributor = $dealer[0]['under_distributor'];

                            $admin_id = $under_distributor;

                            $table = "distributor_product";
                            $col = "*";
                            $opt = 'product_id = ? && user_id = ?';
                            $arr = array($key_product_id, $admin_id);
                            $check_product_under_distributor = $db->advwhere($col, $table, $opt, $arr);

                            $product_stock = $check_product_under_distributor[0]['stock'];
                        } else {
                            $table = "product";
                            $col = "stock,status";
                            $opt = 'id = ?';
                            $arr = array($key_product_id);
                            $product = $db->advwhere($col, $table, $opt, $arr);
                            $product_stock = $product[0]["stock"];
                        }

                        // check qty in the cart, sum it to check. sum cant more than stock
                        if ($qty > $product_stock) {
                            $qty = $product_stock;
                        } else {
                            $qty = $qty;
                        }

                        $table = "cart";
                        $data = "qty = ?, date_modified = ? WHERE customer_id = ? && product_id = ?";
                        $array = array($qty, $time, $user_id, $key_product_id);
                        $result_cart = $db->update($table, $data, $array);
                    } else {
                        $_SESSION['cart']['product'][$key_product_id] = $qty;
                    }

                    // echo  "<pre>id: " . $key_product_id . " qty: " . $qty;
                }
            } else if ($type == 'getcart') {

                $item = array();
                $total_cart_price = 0;
                $number_cart = 0;
                $islogin = 0;
                if ($login == 1) {

                    $table = "cart c left join product p on c.product_id = p.id left join product_translation pt on c.product_id = pt.product_id left join product_role_price pp on c.product_id = pp.product_id";
                    $col = "c.id as id, c.qty as qty, p.id as p_id, p.stock as stock, p.image as image, pt.name as name, pp.price as price";
                    $opt = 'c.customer_id = ? && pt.language = ? && pp.type = ?';
                    $arr = array($user_id, $language, $user_type);
                    $get_cart = $db->advwhere($col, $table, $opt, $arr);
                    $islogin = 1;
                    if (count($get_cart) != 0) {
                        foreach ($get_cart as $cart) {

                            $normal_price = $cart['price'];
                            if ($user_type == 1) {
                                $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
                                $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
                                $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
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

                            $item[$cart['p_id']] = array("qty" => $cart['qty'], "image" => $cart['image'], "name" => $cart['name'], "price" => $price_display, "ori_price" => $normal_price, "is_promo" => $is_promo, "stock" => $cart['stock'], "product_total_price" => $cart['qty'] * $price_display,);
                            $total_cart_price = $total_cart_price + ($cart['qty'] * $price_display);
                            $number_cart++;
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
                                $opt = 'pr.status =? && prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
                                $arr = array(1, $key_product_id, $time, $time);
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

                            $item[$key_product_id] = array("qty" => $qty, "image" => $get_cart['image'], "name" => $get_cart['name'], "price" => $price_display, "ori_price" => $normal_price, "is_promo" => $is_promo,  "stock" => $get_cart['stock'], "product_total_price" => $qty * $price_display);
                            $total_cart_price = $total_cart_price + ($qty * $price_display);
                            $number_cart++;
                        }
                    }
                }
                $json_arr = array('Status' => true, 'cart' => $item, 'Token' => $token, 'total_price' => $total_cart_price, "login" => $islogin, 'number_cart' => $number_cart);
                echo json_encode($json_arr);
            } else if ($type == 'removefromcart') {
                $product_id = $_POST['product_id'];

                if ($login == 1) {

                    $table = "cart";
                    $col = "id";
                    $opt = 'customer_id = ? && product_id = ?';
                    $arr = array($user_id, $product_id);
                    $get_cart_id = $db->advwhere($col, $table, $opt, $arr);
                    if (count($get_cart_id) != 0) {
                        $cart_id = $get_cart_id[0]['id'];
                        $remove_from_cart = $db->del("cart", 'id', $cart_id);
                        $json_arr = array('Status' => true, 'Token' => $token,);
                    } else {
                        $json_arr = array('Status' => false, 'Token' => $token, 'Msg' => 'Remove Product Fail!');
                    }
                } else {
                    if (isset($_SESSION['cart']['product'][$product_id])) {
                        unset($_SESSION['cart']['product'][$product_id]);
                        $json_arr = array('Status' => true, 'Token' => $token,);
                    } else {
                        $json_arr = array('Status' => false, 'Token' => $token, 'Msg' => 'Remove Product Fail!');
                    }
                }
                echo json_encode($json_arr);
            } else if ($type == 'clearcart') {

                if ($login == 1) {
                    $remove_from_cart = $db->del("cart", 'customer_id', $user_id);
                    $json_arr = array('Status' => true, 'Token' => $token);
                } else {
                    if (isset($_SESSION['cart'])) {
                        unset($_SESSION['cart']);
                        $json_arr = array('Status' => true, 'Token' => $token);
                    } else {
                        $json_arr = array('Status' => false, 'Token' => $token, 'Msg' => 'Clear Cart Fail!');
                    }
                }
                echo json_encode($json_arr);
            }
        } else {
            echo "Token Expired. Please Try Again";
        }
    } else {
        echo "Token Is Required.";
    }
}
