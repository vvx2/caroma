<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
if(isset($_SESSION['user_id']) && isset($_SESSION['type']))
{	
    $user_id = $_SESSION['user_id'];
	$user_type = $_SESSION['type'];
	$login = 1;
	$_SESSION['login'] = $login;
}
else
{
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

                $table = "product";
                $col = "stock,status";
                $opt = 'id = ?';
                $arr = array($product_id);
                $product = $db->advwhere($col, $table, $opt, $arr);
                $product_stock = $product[0]["stock"];

                if ($product_stock >= $product_qty) {
                    if ($login == 1) {

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
                } else {
                    $json_arr = array('Status' => false, 'Msg' => 'Stock Is Not Enough!');
                }

                $json_arr['Token'] = $token;
                echo json_encode($json_arr);
            } else if ($type == 'updatecart') {
                header('Location: ../shopping-cart.php');
                $cart = $_POST["qty_product"];
                // var_dump($cart);
                foreach ($cart as $key_product_id => $qty) {
                    if ($login == 1) {
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
                            $item[$cart['p_id']] = array("qty" => $cart['qty'], "image" => $cart['image'], "name" => $cart['name'], "price" => $cart['price'],  "stock" => $cart['stock'], "product_total_price" => $cart['qty'] * $cart['price'],);
                            $total_cart_price = $total_cart_price + ($cart['qty'] * $cart['price']);
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

                            $item[$key_product_id] = array("qty" => $qty, "image" => $get_cart['image'], "name" => $get_cart['name'], "price" => $get_cart['price'],  "stock" => $get_cart['stock'], "product_total_price" => $qty * $get_cart['price']);
                            $total_cart_price = $total_cart_price + ($qty * $get_cart['price']);
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
                    $opt = 'customer_id = ? && product_id = ?';
                    $arr = array($user_id, $product_id);
                    $remove_from_cart = $db->advdel($table, $opt, $arr);
                    $json_arr = array('Status' => true, 'Token' => $token,);
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

                    $table = "cart";
                    $opt = 'customer_id = ?';
                    $arr = array($user_id);
                    $remove_from_cart = $db->advdel($table, $opt, $arr);
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