<?php
require_once('../../administrator/connection/PDO_db_function.php');
$db = new DB_Functions();
// require_once('inc/init.php');
// require_once("inc/level_controller.php");
if (isset($_REQUEST['type']) && isset($_REQUEST['tb'])) {
    $type = $_REQUEST['type'];
    $tb = $_REQUEST['tb'];
}

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

$postedToken = filter_input(INPUT_POST, 'token');
if (!empty($postedToken)) {

    $time = date('Y-m-d H:i:s');

    if (isTokenValid($postedToken)) {
        if ($tb == "distributor") {
            if ($type == "add") {
                if (isset($_POST['submit'])) {
                }
            }
            //--------------------------------------------------
            //                       DELETE
            //--------------------------------------------------
            else if ($type == "delete_data") {
                if (isset($_POST['btnAction'])) {

                    $table = $_REQUEST['table'];
                    $page = $_REQUEST['page'];

                    $id = $_POST['btnAction'];

                    if ($_SESSION['distributor'] == 'distributor') {

                        $result = $db->del($table, 'id', $id);

                        if ($result) {
                            echo "<script>alert(\" Delete Item Successful\");
								window.location.href='" . $page . ".php';</script>";
                        }
                    } else if ($_SESSION['distributor'] != 'distributor') {

                        die('you are not distributor');
                    }
                }
            }

            //--------------------------------------------------
            //                       DELETE
            //--------------------------------------------------

            //--------------------------------------------------
            //              Distributor Product
            //--------------------------------------------------
            else if ($type == "product_add") {
                if (isset($_POST['btnAction'])) {

                    $product_id = $_POST['product']; //product id, not table id
                    $stock = $_POST['stock'];
                    $status = $_POST['status'];


                    // check product is it isset in database
                    $table = "distributor_product";
                    $col = "id";
                    $opt = 'product_id = ? && user_id  = ?';
                    $arr = array($product_id, $user_id);
                    $check_product_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_product_isset) == 0) {

                        $table = "distributor_product";
                        $colname = array("user_id", "product_id", "stock", "status", "date_created", "date_modified");
                        $array = array($user_id, $product_id, $stock, $status, $time, $time);
                        $result_product = $db->insert($table, $colname, $array);

                        if ($result_product) {
                            echo "<script>alert(\" Add Product Successful\");
                            window.location.href='../product.php';</script>";
                        } else {
                            echo "<script>alert(\" Add Product Fail. Please try again.\");
                        window.location.href='../product.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Product Exists, Please use edit function to edit your product.\");
                        window.location.href='../product.php';</script>";
                    }
                }
            } else if ($type == "product_edit") {
                if (isset($_POST['btnAction'])) {

                    $distributor_product_id = $_POST['btnAction']; //table id.not product id.
                    $product_id = $_POST['product']; //product id, not table id
                    $status = $_POST['status'];
                    $stock = $_POST['stock'];

                    // check product is it isset in database
                    $table = "distributor_product";
                    $col = "id";
                    $opt = 'product_id = ? && user_id  = ? && id != ?';
                    $arr = array($product_id, $user_id, $distributor_product_id);
                    $check_product_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_product_isset) == 0) {

                        $table = "distributor_product";
                        $data = "stock =?, status =?, date_modified = ? WHERE id = ?";
                        $array = array($stock, $status, $time, $distributor_product_id);
                        $result_product = $db->update($table, $data, $array);

                        if ($result_product) {
                            echo "<script>alert(\" Edit Product Successful\");
                              window.location.href='../product.php';</script>";
                        } else {
                            echo "<script>alert(\" Edit Product Fail, PLease Try Again. \");
                            window.location.href='../product.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Product Exists, Please use add function to add your product.\");
                        window.location.href='../product.php';</script>";
                    }
                }

                if (isset($_POST['btnDelete'])) {

                    $distributor_product_id = $_POST['btnDelete']; //table id.not product id.

                    $result = $db->del("distributor_product", 'id', $distributor_product_id);

                    if ($result) {
                        echo "<script>alert(\" Delete Item Successful\");
                            window.location.href='../product.php';</script>";
                    }
                }
            }

            //--------------------------------------------------
            //              Distributor Product
            //--------------------------------------------------

            //--------------------------------------------------
            //              Distributor Order
            //--------------------------------------------------

            else if ($type == "self_order") {
                if (isset($_POST['btnAction'])) {

                    // get distributor self detail
                    $table = "users u left join user_address ua on u.id = ua.user_id";
                    $col = "u.name as name,u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state";
                    $opt = 'u.id = ?';
                    $arr = array($user_id);
                    $result_distributor = $db->advwhere($col, $table, $opt, $arr);

                    if ($result_distributor != 0) {
                        $result_distributor = $result_distributor[0];

                        $customer_name = $result_distributor["name"];
                        $customer_email = $result_distributor["email"];
                        $customer_contact = $result_distributor["contact"];
                        $customer_address = $result_distributor["address"];
                        $customer_postcode = $result_distributor["postcode"];
                        $customer_city = $result_distributor["city"];
                        $customer_state = $result_distributor["state"];
                    } else {
                        $customer_name = "-";
                        $customer_email = "-";
                        $customer_contact =  "-";
                        $customer_address =  "-";
                        $customer_postcode = "-";
                        $customer_city = "-";
                        $customer_state =  "-";
                    }


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

                    $total_price = $_POST['total_price'];
                    $total_payment = $_POST['total_price'];
                    $coupon_code = "";
                    $discount_percent = 0;
                    $discount_amount = 0;

                    $table = "orders";
                    $colname = array("status", "customer_name", "customer_email", "customer_address", "customer_postcode", "customer_city", "customer_state", "customer_contact", "total_price", "coupon_code", "discount_percent", "discount_amount", "total_payment", "track_code", "users_id", "date_created", "date_modified");
                    $array = array(4, $customer_name, $customer_email, $customer_address, $customer_postcode, $customer_city, $customer_state, $customer_contact, $total_price, $coupon_code, $discount_percent, $discount_amount, $total_payment, $track_code, $user_id, $time, $time);
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

                        $product_price = $_POST["product_price"];
                        $product_id = $_POST["product_id"];
                        $qty = $_POST["product_qty"];
                        foreach ($product_id as $key => $id) {

                            $product_qty = $qty[$key];
                            $product_id = $id;

                            $table = "order_items";
                            $colname = array("product_id", "qty", "price", "order_id", "date_created", "date_modified");
                            $array = array($product_id, $product_qty, $product_price, $order_id, $time, $time);
                            $result_order_item = $db->insert($table, $colname, $array);
                        }

                        if ($result_order_item) {
                            echo "<script>alert(\" Add Order Successful.\");
                            window.location.href='../shop.php';</script>";
                        } else {
                            echo "<script>alert(\" Add Order Successful, But record order item fail.\");
                            window.location.href='../shop.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Add Order Fail. Please try again\");
                              window.location.href='order-list.php';</script>";
                    }
                }
            } else if ($type == "order_assign") {
                if (isset($_POST['btnAction'])) {

                    $order_id = $_POST['btnAction'];
                    $consignment_number = $_POST['consignment_number'];

                    $tablename = "orders";
                    $data = "status = ? , consignment_number =?, date_modified = ? WHERE id = ?";
                    $array = array(3, $consignment_number, $time, $order_id);
                    $result_delivery = $db->update($tablename, $data, $array);

                    if ($result_delivery) {
                        echo "<script>alert(\" Update Status Successful\");
                              window.location.href='../order-list.php?p=3';</script>";
                    } else {
                        echo "<script>alert(\" Update Status Fail. Please Try Again\");
                              window.location.href='../order-list.php?p=3';</script>";
                    }
                }
            }

            //--------------------------------------------------
            //              Distributor Order
            //--------------------------------------------------

        } // table admin
    } else {
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}
