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
                    $colname = array("status", "customer_name", "customer_email", "customer_address", "customer_postcode", "customer_city", "customer_state", "customer_contact", "total_price", "coupon_code", "discount_percent", "discount_amount", "total_payment", "track_code", "gateway_order_id", "users_id", "type", "admin_id", "date_created", "date_modified");
                    $array = array(4, $customer_name, $customer_email, $customer_address, $customer_postcode, $customer_city, $customer_state, $customer_contact, $total_price, $coupon_code, $discount_percent, $discount_amount, $total_payment, $track_code, "self order - no id", $user_id, 2, $user_id, $time, $time);
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

                        $price = $_POST["product_price"];
                        $product_id = $_POST["product_id"];
                        $qty = $_POST["product_qty"];
                        foreach ($product_id as $key => $id) {

                            $product_qty = $qty[$key];
                            $product_price = $price[$key];
                            $product_id = $id;

                            $table = "order_items";
                            $colname = array("product_id", "qty", "price", "order_id", "date_created", "date_modified");
                            $array = array($product_id, $product_qty, $product_price, $order_id, $time, $time);
                            $result_order_item = $db->insert($table, $colname, $array);
                        }

                        if ($result_order_item) {
                            echo "<script>alert(\" Add Order Successful.\");
                            window.location.href='../order-list.php';</script>";
                        } else {
                            echo "<script>alert(\" Add Order Successful, But record order item fail.\");
                            window.location.href='../order-list.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Add Order Fail. Please try again\");
                              window.location.href='../order-list.php';</script>";
                    }
                }
            } else if ($type == "order_assign") {
                if (isset($_POST['btnAction'])) {

                    $order_id = $_POST['btnAction'];
                    $consignment_number = $_POST['consignment_number'];

                    $tablename = "orders";
                    $data = "status = ? , consignment_number =?, date_modified = ? WHERE id = ?";
                    $array = array(3, $consignment_number, $time, $order_id);
                    $result_order = $db->update($tablename, $data, $array);

                    if ($result_order) {
                        echo "<script>alert(\" Update Status Successful\");
                              window.location.href='../order-list.php?p=3';</script>";
                    } else {
                        echo "<script>alert(\" Update Status Fail. Please Try Again\");
                              window.location.href='../order-list.php?p=3';</script>";
                    }
                }
            } else if ($type == "order_complete") {
                if (isset($_POST['btnAction'])) {

                    $order_id = $_POST['btnAction'];

                    $tablename = "orders";
                    $data = "status =?, date_modified = ? WHERE id = ?";
                    $array = array(4, $time, $order_id);
                    $result_order = $db->update($tablename, $data, $array);

                    if ($result_order) {

                        //--------------------------------------------------
                        //              Get order details
                        $col = "*";
                        $tb = "orders";
                        $opt = 'id = ?';
                        $arr = array($order_id);
                        $order = $db->advwhere($col, $tb, $opt, $arr);
                        $order = $order[0];
                        //--------------------------------------------------

                        //---------------------------------------------------
                        //       VARIABLE for wallet_transaction_history
                        $total_payment = $order["total_payment"]; // amount to record
                        $gateway_order_id = $order["gateway_order_id"]; // order to record in description
                        $description = "Sale. Order Id: " . $gateway_order_id;
                        //---------------------------------------------------

                        //---------------------------------------------------
                        //       VARIABLE for user_distributor
                        $payment_type = $order["payment_type"]; //payment type to check if online payment will add amount to distributor wallet
                        //--------------------------------------------------

                        //--------------------------------------------------
                        //   Check payment type if it is online payment
                        if ($payment_type == 1) {
                            //   Get Distributor wallet details - amount
                            $col = "*";
                            $tb = "user_distributor";
                            $opt = 'user_id = ?';
                            $arr = array($user_id);
                            $distributor = $db->advwhere($col, $tb, $opt, $arr);
                            $distributor = $distributor[0];
                            $current_wallet_amount = $distributor["distributor_wallet"];

                            //   Add total_payment to amount
                            $added_wallet_amount = $current_wallet_amount + $total_payment;

                            //   Update distributor_wallet
                            $tablename = "user_distributor";
                            $data = "distributor_wallet = ? WHERE user_id = ?";
                            $array = array($added_wallet_amount, $user_id);
                            $result_user_distributor = $db->update($tablename, $data, $array);

                            if ($result_user_distributor) {
                                //   Add Histroy to distributor_wallet_transaction_history
                                $table = "distributor_wallet_transaction_history";
                                $colname = array("amount", "current_amount", "description", "distributor_id", "date_created", "date_modified");
                                $array = array($total_payment, $added_wallet_amount, $description, $user_id, $time, $time);
                                $result_wallet_history = $db->insert($table, $colname, $array);

                                if ($result_wallet_history) {
                                    echo "<script>alert(\" Update Status Successful\");
                                    window.location.href='../order-list.php?p=4';</script>";
                                } else {
                                    echo "<script>alert(\" Update Status Successful. But Insert History Fail\");
                                    window.location.href='../order-list.php?p=4';</script>";
                                }
                            } else {
                                echo "<script>alert(\" Update Status Successful. But Update Wallet Fail\");
                                    window.location.href='../order-list.php?p=4';</script>";
                            }

                            exit;
                        }
                        //--------------------------------------------------

                        echo "<script>alert(\" Update Status Successful\");
                              window.location.href='../order-list.php?p=4';</script>";
                    } else {
                        echo "<script>alert(\" Update Status Fail. Please Try Again\");
                              window.location.href='../order-list.php?p=4';</script>";
                    }
                }
            } else if ($type == "order_cancel") {
                if (isset($_POST['btnAction'])) {

                    $order_id = $_POST['btnAction'];
                    $reason = $_POST['reason'];

                    $tablename = "orders";
                    $data = "status =?,reason =?, date_modified = ? WHERE id = ?";
                    $array = array(1, $reason, $time, $order_id);
                    $result_order = $db->update($tablename, $data, $array);

                    if ($result_order) {
                        echo "<script>alert(\" Update Status Successful\");
                              window.location.href='../order-list.php?p=1';</script>";
                    } else {
                        echo "<script>alert(\" Update Status Fail. Please Try Again\");
                              window.location.href='../order-list.php?p=1';</script>";
                    }
                }
            } else if ($type == "order_approve") {
                if (isset($_POST['btnAction'])) {

                    $order_id = $_POST['btnAction'];

                    $tablename = "orders";
                    $data = "status =?, date_modified = ? WHERE id = ?";
                    $array = array(2, $time, $order_id);
                    $result_order = $db->update($tablename, $data, $array);

                    if ($result_order) {
                        echo "<script>alert(\" Update Status Successful\");
                              window.location.href='../order-list.php?p=2';</script>";
                    } else {
                        echo "<script>alert(\" Update Status Fail. Please Try Again\");
                              window.location.href='../order-list.php?p=2';</script>";
                    }
                }
            }

            //--------------------------------------------------
            //              Distributor Order
            //--------------------------------------------------

            //--------------------------------------------------
            //              Distributor Wallet
            //--------------------------------------------------
            else if ($type == "wallet_refund") {
                if (isset($_POST['btnAction'])) {

                    $refund_amt = $_POST['amount'];

                    $col = "*";
                    $tb = "user_distributor";
                    $opt = 'user_id = ?';
                    $arr = array($user_id);
                    $distributor = $db->advwhere($col, $tb, $opt, $arr);
                    $wallet_amt = $distributor[0]['distributor_wallet'];

                    if ($wallet_amt >= $refund_amt) {

                        $table = "distributor_wallet_transaction";
                        $colname = array("status", "amount", "distributor_id", "date_created", "date_modified");
                        $array = array(1, $refund_amt, $user_id, $time, $time);
                        $result_wallet = $db->insert($table, $colname, $array);

                        if ($result_wallet) {
                            echo "<script>alert(\" Request Refund Successful\");
                            window.location.href='../wallet.php';</script>";
                        } else {
                            echo "<script>alert(\" Request Refund Fail. Please try again.\");
                        window.location.href='../wallet.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Wallet amount is insufficient. Please try other amount\");
                        window.location.href='../wallet.php';</script>";
                    }
                }
            } else if ($type == "bank_update") {
                if (isset($_POST['btnAction'])) {

                    $bank_name = $_POST['bank_name'];
                    $bank_account = $_POST['bank_account'];

                    $tablename = "user_distributor";
                    $data = "bank_name =?, bank_account =? WHERE user_id = ?";
                    $array = array($bank_name, $bank_account, $user_id);
                    $result_bank = $db->update($tablename, $data, $array);

                    if ($result_bank) {
                        echo "<script>alert(\" Edit Bank Detail Successful\");
                            window.location.href='../wallet.php';</script>";
                    } else {
                        echo "<script>alert(\" Edit Bank Detail Fail. Please try again.\");
                        window.location.href='../wallet.php';</script>";
                    }
                }
            }
            //--------------------------------------------------
            //              Distributor Wallet
            //--------------------------------------------------

            //--------------------------------------------------
            //              Distributor Geo Zone
            //--------------------------------------------------
            else if ($type == "geo_zone_add") {
                if (isset($_POST['btnAction'])) {

                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $zone = $_POST['zone'];

                    // check geo_zone is it isset in database
                    $table = "geo_zone";
                    $col = "id";
                    $opt = 'name = ? && admin_id = ? ';
                    $arr = array($name, $user_id);
                    $check_geo_zone_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_geo_zone_isset) == 0) {

                        $table = "geo_zone";
                        $colname = array("name", "description", "admin_id", "date_created", "date_modified");
                        $array = array($name, $description, $user_id, $time, $time);
                        $result_geo_zone = $db->insert($table, $colname, $array);

                        if ($result_geo_zone) {
                            //--------------------------
                            //  get geo_zone id inserted
                            //--------------------------
                            $table = "geo_zone";
                            $col = "id";
                            $opt = 'date_created = ?';
                            $arr = array($time);
                            $geo_zone = $db->advwhere($col, $table, $opt, $arr);
                            $geo_zone_id = $geo_zone[0]['id'];
                            //--------------------------

                            foreach ($zone as $zone) {

                                $state_id = $zone;
                                // check geo_zone list is it isset in database, if yes, then skip
                                $table = "geo_zone_list";
                                $col = "id";
                                $opt = 'geo_zone_id = ? && state_id = ?';
                                $arr = array($geo_zone_id, $state_id);
                                $check_geo_zone_list_isset = $db->advwhere($col, $table, $opt, $arr);

                                if (count($check_geo_zone_list_isset) != 0) {
                                    continue;
                                } else {
                                    $table = "geo_zone_list";
                                    $colname = array("geo_zone_id", "state_id");
                                    $array = array($geo_zone_id, $state_id);
                                    $result_geo_zone_list = $db->insert($table, $colname, $array);

                                    if ($zone == 0) {
                                        //delete geo zone list and insert again
                                        $result_geo_zone_delete = $db->del("geo_zone_list", 'geo_zone_id', $geo_zone_id);
                                        $result_geo_zone_list = $db->insert($table, $colname, $array);
                                        break;
                                    }
                                }
                            }

                            if ($result_geo_zone_list) {
                                echo "<script>alert(\" Add Geo Zone Successful.\");
                            window.location.href='../geo_zone.php';</script>";
                            } else {
                                echo "<script>alert(\" Add Geo Zone Successful, But Add Geo Zone List fail.\");
                            window.location.href='../geo_zone.php';</script>";
                            }
                        } else {
                            echo "<script>alert(\" Add Geo Zone Fail. Please try again.\");
                        window.location.href='../geo_zone.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Geo Zone Exists, Please try again.\");
                        window.location.href='../geo_zone.php';</script>";
                    }
                }
            } else if ($type == "geo_zone_edit") {
                if (isset($_POST['btnAction'])) {

                    $geo_zone_id = $_POST['btnAction'];

                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $zone = $_POST['zone'];

                    // check geo_zone is it isset in database
                    $table = "geo_zone";
                    $col = "id";
                    $opt = 'name = ? && admin_id = ? && id != ?';
                    $arr = array($name, $user_id, $geo_zone_id);
                    $check_geo_zone_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_geo_zone_isset) == 0) {

                        $tablename = "geo_zone";
                        $data = "name =?, description=?, date_modified = ? WHERE id = ?";
                        $array = array($name, $description, $time, $geo_zone_id);
                        $result_geo_zone_update = $db->update($tablename, $data, $array);

                        if ($result_geo_zone_update) {

                            //delete geo zone list and insert again
                            $result_geo_zone_delete = $db->del("geo_zone_list", 'geo_zone_id', $geo_zone_id);

                            foreach ($zone as $zone) {

                                $state_id = $zone;
                                // check geo_zone list is it isset in database, if yes, then skip
                                $table = "geo_zone_list";
                                $col = "id";
                                $opt = 'geo_zone_id = ? && state_id = ?';
                                $arr = array($geo_zone_id, $state_id);
                                $check_geo_zone_list_isset = $db->advwhere($col, $table, $opt, $arr);

                                if (count($check_geo_zone_list_isset) != 0) {
                                    continue;
                                } else {
                                    $table = "geo_zone_list";
                                    $colname = array("geo_zone_id", "state_id");
                                    $array = array($geo_zone_id, $state_id);
                                    $result_geo_zone_list = $db->insert($table, $colname, $array);

                                    if ($zone == 0) {
                                        //delete geo zone list and insert again
                                        $result_geo_zone_delete = $db->del("geo_zone_list", 'geo_zone_id', $geo_zone_id);
                                        $result_geo_zone_list = $db->insert($table, $colname, $array);
                                        break;
                                    }
                                }
                            }

                            if ($result_geo_zone_list) {
                                echo "<script>alert(\" Edit Geo Zone Successful.\");
                            window.location.href='../geo_zone.php';</script>";
                            } else {
                                echo "<script>alert(\" Edit Geo Zone Successful, But Add Geo Zone List fail.\");
                            window.location.href='../geo_zone.php';</script>";
                            }
                        } else {
                            echo "<script>alert(\" Edit Geo Zone Fail. Please try again.\");
                        window.location.href='../geo_zone.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Geo Zone Exists, Please try again.\");
                    window.location.href='../geo_zone.php';</script>";
                    }
                }
            }
            //--------------------------------------------------
            //              Distributor Geo Zone
            //--------------------------------------------------

            //--------------------------------------------------
            //              Distributor Shipping
            //--------------------------------------------------

            else if ($type == "shipping_add") {
                if (isset($_POST['btnAction'])) {

                    $name = $_POST['name'];
                    $geo_zone = $_POST['zone'];
                    $first_weight = $_POST['first_weight'];
                    $first_price = $_POST['first_price'];
                    $next_weight = $_POST['next_weight'];
                    $next_price = $_POST['next_price'];
                    $charge = $_POST['charge'];

                    // check geo_zone is it isset in database
                    $table = "shipping";
                    $col = "id";
                    $opt = 'name = ? && admin_id = ?';
                    $arr = array($name, $user_id);
                    $check_shipping_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_shipping_isset) == 0) {

                        $table = "shipping";
                        $colname = array("name", "geo_zone", "first_weight", "first_price", "next_weight", "next_price", "charge", "admin_id", "status", "date_created", "date_modified");
                        $array = array($name, $geo_zone, $first_weight, $first_price, $next_weight, $next_price, $charge, $user_id, 1, $time, $time);
                        $result_shipping = $db->insert($table, $colname, $array);

                        if ($result_shipping) {
                            echo "<script>alert(\" Add Shipping Successful.\");
                            window.location.href='../shipping.php';</script>";
                        } else {
                            echo "<script>alert(\" Add Shipping Fail. Please try again.\");
                        window.location.href='../shipping.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Shipping Exists, Please try again.\");
                        window.location.href='../shipping.php';</script>";
                    }
                }
            } else if ($type == "shipping_edit") {
                if (isset($_POST['btnAction'])) {

                    $shipping_id = $_POST['btnAction'];

                    $name = $_POST['name'];
                    $geo_zone = $_POST['zone'];
                    $first_weight = $_POST['first_weight'];
                    $first_price = $_POST['first_price'];
                    $next_weight = $_POST['next_weight'];
                    $next_price = $_POST['next_price'];
                    $charge = $_POST['charge'];
                    $status = $_POST['status'];

                    // check geo_zone is it isset in database
                    $table = "shipping";
                    $col = "id";
                    $opt = 'name = ? && admin_id = ? && id != ?';
                    $arr = array($name, $user_id, $shipping_id);
                    $check_shipping_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_shipping_isset) == 0) {

                        $tablename = "shipping";
                        $data = "name =?, geo_zone =?, first_weight =?, first_price =?, next_weight =?, next_price =?, charge =?, status =?, date_modified = ? WHERE id = ?";
                        $array = array($name, $geo_zone, $first_weight, $first_price, $next_weight, $next_price, $charge, $status, $time, $shipping_id);
                        $result_shipping_edit = $db->update($tablename, $data, $array);

                        if ($result_shipping_edit) {
                            echo "<script>alert(\" Edit Shipping Successful.\");
                            window.location.href='../shipping.php';</script>";
                        } else {
                            echo "<script>alert(\" Edit Shipping Fail. Please try again.\");
                        window.location.href='../shipping.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Shipping Exists, Please try again.\");
                            window.location.href='../shipping.php';</script>";
                    }
                }
            } else if ($type == "shipping_delete") {
                if (isset($_POST['btnAction'])) {

                    $shipping_id = $_POST['btnAction'];

                    $result_shipping_delete = $db->del("shipping", 'id', $shipping_id);
                    if ($result_shipping_delete) {
                        echo "<script>alert(\" Delete Shipping Successful.\");
                            window.location.href='../shipping.php';</script>";
                    } else {
                        echo "<script>alert(\" Delete Shipping Fail. Please try again.\");
                        window.location.href='../shipping.php';</script>";
                    }
                }
            }

            //--------------------------------------------------
            //              Distributor Shipping
            //--------------------------------------------------

        } // table admin
    } else {
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}
