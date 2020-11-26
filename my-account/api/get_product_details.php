<?php
require_once('../../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
$time = date('Y-m-d H:i:s');
$product_id = $_REQUEST['product_id'];

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


    $col = "*, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name";
    $tb = "product p left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id ";
    $opt = 'pt.language = ? && pp.type =? && ct.language =? && p.id =?';
    $arr = array($language, 3, $language, $product_id);
    $product = $db->advwhere($col, $tb, $opt, $arr);

    if (count($product) <= 0) {
        $json_arr = array('Status' => false, 'Msg' => 'Product No Exists!');
    } else {
        //get product details
        $product = $product[0];
        $product_price = $product['price'];
        $product_category = $product['ct_name'];
        $product_image = $product['image'];
        $product_length = $product['length'];
        $product_width = $product['width'];
        $product_height = $product['height'];
        $product_weight = $product['weight'];
        $json_arr = array(
            'Status' => true,
            'price' => $product_price,
            "category" => $product_category,
            "image" => $product_image,
            "length" => $product_length,
            "width" => $product_width,
            "height" => $product_height,
            "weight" => $product_weight
        );
    }
}
echo json_encode($json_arr);
