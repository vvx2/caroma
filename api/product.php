<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
$time = date('Y-m-d H:i:s');

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



if (isset($_REQUEST['page'])) {
    $page = $_REQUEST['page'];
    if ($page == 1) {
        $offset = 0;
    } else {
        $offset =  ($page - 1) * 20;
    }
} else {
    $offset = 0;
}

if (isset($_REQUEST['orderby'])) {
    $orderby = $_REQUEST['orderby'];
    switch ($orderby) {
        case "popularity":
            $sqlorder = "p.date_modified ASC";
            break;
        case "rating":
            $sqlorder = "rating DESC";
            break;
        case "price":
            $sqlorder = "pp.price ASC";
            break;
        case "price-desc":
            $sqlorder = "pp.price DESC";
            break;
        case "date":
            $sqlorder = "p.date_modified DESC";
    }
} else {
    $sqlorder = "p.date_modified ASC";
}

$item = array();

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

    if (isset($_REQUEST["category"]) && $_REQUEST["category"] != 0) {
        $filter_table = " left join category c on p.category = c.id";
        $filter_opt = " && c.status =? && p.category =? ";
        $filter_arr = array($admin_id, $language, $user_type, $language, 1, 1, $_REQUEST["category"]);
    } else if ((isset($_REQUEST["price_from"]) && isset($_REQUEST["price_to"])) && ($_REQUEST["price_from"] != 0 && $_REQUEST["price_to"] != 0)) {
        $filter_table = "";
        $filter_opt = " && pp.price BETWEEN ? AND ? ";
        $filter_arr = array($admin_id, $language, $user_type, $language, 1, $_REQUEST["price_from"], $_REQUEST["price_to"]);
    } else {
        $filter_table = "";
        $filter_opt = " ";
        $filter_arr = array($admin_id, $language, $user_type, $language, 1);
    }

    $col = "*,dp.stock as dis_stock, p.stock as admin_stock, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
    $tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
    $opt = 'dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 20 OFFSET ' . $offset . '';
    $arr = $filter_arr;
    $result = $db->advwhere($col, $tb, $opt, $arr);
} else {
    if (isset($_REQUEST["category"]) && $_REQUEST["category"] != 0) {
        $filter_table = " left join category c on p.category = c.id";
        $filter_opt = " && c.status =? && p.category =? ";
        $filter_arr = array($language, $user_type, $language, 1, 1, $_REQUEST["category"]);
        $check_sql = "category";
    } else if ((isset($_REQUEST["price_from"]) && isset($_REQUEST["price_to"])) && ($_REQUEST["price_to"] != 0)) {
        $filter_table = "";
        $filter_opt = " && pp.price BETWEEN ? AND ? ";
        $filter_arr = array($language, $user_type, $language, 1, $_REQUEST["price_from"], $_REQUEST["price_to"]);
        $check_sql = "price";
    } else {
        $filter_table = "";
        $filter_opt = " ";
        $filter_arr = array($language, $user_type, $language, 1);
        $check_sql = "none";
    }

    $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
    if (isset($_REQUEST["new_arrival"]) && $_REQUEST["new_arrival"] == 1) {
        $tb = " new_arrival na left join product p on na.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
    } else {
        $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
    }
    $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 20 OFFSET ' . $offset . '';
    $arr = $filter_arr;
    $result = $db->advwhere($col, $tb, $opt, $arr);
}



if (count($result) != 0) {
    $count_result = 1;
    foreach ($result as $product) {

        $normal_price = $product['price'];
        if ($user_type == 1) {
            $col = "*, DATE_ADD(end, INTERVAL 1 DAY) as new_end_date";
            $tb = "promotion pr left join promotion_product prp on pr.id = prp.promotion_id";
            $opt = 'prp.product_id = ? && start <= ? && DATE_ADD(end, INTERVAL 1 DAY) >= ? ORDER BY date_modified';
            $arr = array($product['p_id'], $time, $time);
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
                if (isset($_REQUEST["is_promotion"]) && $_REQUEST["is_promotion"] == 1) {
                    continue;
                }
            }
        } else {
            $is_promo = 0;
            $price_display = $normal_price;
        }
        $count_result++;
        $item[] = array("product_id" => $product['p_id'], "image" => $product['image'], "category_name" => $product['ct_name'], "product_name" => $product['pt_name'], "price" => $price_display, "ori_price" => $normal_price, "is_promo" => $is_promo);
    }
    $json_arr = array('Status' => true, 'product' => $item, 'count_result' => $count_result);
    // $json_arr = array('Status' => true, 'product' => $item, 'count_result' => $count_result, "checksql" => $sqlorder);
} else {
    $json_arr = array('Status' => false, 'msg' => '<h1>No Result</h1>', "failresult" => $result);
}
// echo '<pre>';
// var_dump($json_arr) ;
echo json_encode($json_arr);
