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
    $opt = 'dp.user_id = ? && pt.language = ? && pp.type =? && ct.language =? && dp.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 15 OFFSET ' . $offset . '';
    $arr = $filter_arr;
    $result = $db->advwhere($col, $tb, $opt, $arr);
} else {
    if (isset($_REQUEST["category"]) && $_REQUEST["category"] != 0) {
        $filter_table = " left join category c on p.category = c.id";
        $filter_opt = " && c.status =? && p.category =? ";
        $filter_arr = array($language, $user_type, $language, 1, 1, $_REQUEST["category"]);
    } else if ((isset($_REQUEST["price_from"]) && isset($_REQUEST["price_to"])) && ($_REQUEST["price_from"] != 0 && $_REQUEST["price_to"] != 0)) {
        $filter_table = "";
        $filter_opt = " && pp.price BETWEEN ? AND ? ";
        $filter_arr = array($language, $user_type, $language, 1, $_REQUEST["price_from"], $_REQUEST["price_to"]);
    } else {
        $filter_table = "";
        $filter_opt = " ";
        $filter_arr = array($language, $user_type, $language, 1);
    }

    $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name, rate.rating as rating";
    $tb = " product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id left join (SELECT product_id, (sum(rate) / count(product_id)) as rating FROM order_items where rate != 0 group by product_id) rate on p.id = rate.product_id " . $filter_table;
    $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.status =?' . $filter_opt . ' ORDER BY ' . $sqlorder . ' LIMIT 15 OFFSET ' . $offset . '';
    $arr = $filter_arr;
    $result = $db->advwhere($col, $tb, $opt, $arr);
}



if ($result) {
    foreach ($result as $product) {
        $item[$product['p_id']] = array("image" => $product['image'], "category_name" => $product['ct_name'], "product_name" => $product['pt_name'], "price" => $product['price']);
    }
    $json_arr = array('Status' => true, 'product' => $item, 'count_result' => count($result));
} else {
    $json_arr = array('Status' => false, 'msg' => '<h1>No Result</h1>');
}
// echo '<pre>';
// var_dump($json_arr) ;
echo json_encode($json_arr);