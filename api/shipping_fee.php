<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
$time = date('Y-m-d H:i:s');
$state = $_REQUEST['state'];
$delivery_type = $_REQUEST['delivery_type'];
$point_use = $_REQUEST['point_use'];
$sub_total = $_REQUEST['sub_total'];

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

if ($delivery_type == 2) {
    $shipping_fee = 0;
    $total_pay = $sub_total + $shipping_fee;
    $json_arr = array('Status' => true, 'Shipping_fee' => $shipping_fee, 'Total_pay' => $total_pay);
} else {
    if ($login == 0) {
        $json_arr = array('Status' => false, 'Msg' => 'You have not Login!');
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
            $col = "c.product_id as product_id, c.qty as qty, p.weight as weight, p.point as point, p.point_allow_discount as point_allow_discount";
            $opt = 'c.customer_id = ?';
            $arr = array($user_id);
            $result_cart = $db->advwhere($col, $table, $opt, $arr);

            // check cart is exists item
            if (count($result_cart) != 0) {
                $total_weight = 0;
                $total_point = 0; // point can be use
                //count item total weight
                foreach ($result_cart as $cart) {
                    $total_weight = $total_weight + ($cart['qty'] * $cart['weight']);
                    $total_point = $total_point + ($cart['qty'] * $cart['point_allow_discount']); // for reduce check
                }
                //----------------------------------------------
                //  count reward point
                //  when user type is normal user, check point use
                if ($user_type == 1) {
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
                } else {
                    $reduce_point_fee = 0;
                }
                //----------------------------------------------

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
                $total_pay = $sub_total + $shipping_fee - $reduce_point_fee;
                $json_arr = array('Status' => true, 'Shipping_fee' => $shipping_fee, 'Point_discount' => $reduce_point_fee, 'Total_pay' => $total_pay);
            } else {
                $json_arr = array('Status' => false, 'Msg' => 'Your Cart is Empty!');
            }
        }
    }
}
echo json_encode($json_arr);
