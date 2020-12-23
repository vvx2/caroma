<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
$time = date('Y-m-d H:i:s');
$coupon_code = $_REQUEST['coupon_code'];
$sub_total = $_REQUEST['sub_total'];
$shipping = $_REQUEST['shipping'];

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

if ($login == 0) {
    $json_arr = array('Status' => false, 'Msg' => 'You have not Login!');
} else {
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
        $coupon_delivery = $coupon['free_delivery'];

        $start =  $coupon['start'];
        $end =  $coupon['end'];

        $date = new DateTime($end);
        $date->add(new DateInterval('P1D'));
        $new_end = $date->format('Y-m-d H:i:s');

        if (($time >= $start) && ($time < $new_end)) {

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

                                //check delivery fee
                                if ($coupon_delivery == 1) {
                                    $shipping = 0;
                                }

                                //--------------------------------------------
                                //      All true will return this
                                //--------------------------------------------
                                $total_pay = $total_spend - $reduce_amt + $shipping;
                                $json_arr = array('Status' => true, 'Amount' => $reduce_amt, "Total" => $total_spend, "Total_pay" => $total_pay, "Shipping_fee" => $shipping);

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
        } else {
            $json_arr = array('Status' => false, 'Msg' => 'Not in date range!');
        }
    }
}
echo json_encode($json_arr);
