<?php


// require_once('connection/PDO_db_function.php');
// $db = new DB_Functions(); 
require_once('inc/init.php');
if (isset($_REQUEST['type']) && isset($_REQUEST['tb'])) {
    $type = $_REQUEST['type'];
    $tb = $_REQUEST['tb'];
}
$postedToken = filter_input(INPUT_POST, 'token');
if (!empty($postedToken)) {

    $time = date('Y-m-d H:i:s');

    if (isTokenValid($postedToken)) {
        if ($tb == "admin") {
            if ($type == "add") {
                if (isset($_POST['submit'])) {
                }
            }

            //--------------------------------------------------
            //                 Coupon Generate 
            //--------------------------------------------------

            else if ($type == "coupon_generate") {
                if (isset($_POST['btnAction'])) {

                    $name_en = trim($_POST['name_en']);
                    $name_cn = trim($_POST['name_cn']);
                    $name_my = trim($_POST['name_my']);

                    $desc_en = $_POST['desc_en'];
                    $desc_cn = $_POST['desc_cn'];
                    $desc_my = $_POST['desc_my'];

                    $start = $_POST['start'];
                    $end = $_POST['end'];

                    $coupon_type = $_POST['coupon_type']; //1=amount , 2=percantage

                    $amount = $_POST['amount'];
                    $percentage = $_POST['percentage'];

                    $min_spend = $_POST['min_spend'];
                    $dis_capped = $_POST['dis_capped'];
                    $user_per_coupon = $_POST['user_per_coupon'];
                    $usage_limit = $_POST['usage_limit'];
                    $total_usage_limit = $_POST['total_usage_limit'];
                    $coupon_generate = $_POST['coupon_generate'];

                    $product = $_POST['product'];


                    // check coupon is it isset in database
                    $table = "coupon_translation";
                    $col = "id, name";
                    $opt = 'name = ? || name = ? || name = ?';
                    $arr = array($name_en, $name_cn, $name_my);
                    $check_coupon_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_coupon_isset) != 0) {
                        echo "<script>alert(\" Coupon Existed\");
                        window.location.href='coupon.php';</script>";
                    } else {

                        $table = "coupon";
                        $colname = array("start", "end", "type", "amt", "percentage", "min_spend", "capped", "user_per_coupon", "usage_limit", "total_usage_limit", "total_times_used", "coupon_qty", "status", "date_created", "date_modified");
                        $array = array($start, $end, $coupon_type, $amount, $percentage, $min_spend, $dis_capped, $user_per_coupon, $usage_limit, $total_usage_limit, 0, $coupon_generate, 1, $time, $time);
                        $result_coupon = $db->insert($table, $colname, $array);

                        if ($result_coupon) {

                            //--------------------------
                            //  get coupon id inserted
                            //--------------------------
                            $table = "coupon";
                            $col = "id";
                            $opt = 'date_created = ?';
                            $arr = array($time);
                            $coupon = $db->advwhere($col, $table, $opt, $arr);
                            $coupon_id = $coupon[0]['id'];
                            //--------------------------


                            //--------------------------
                            //  insert coupon detail
                            //--------------------------
                            $table = "coupon_translation";
                            $colname = array("name", "description", "language", "coupon_id");
                            $array = array($name_en, $desc_en, "en", $coupon_id);
                            $result_coupon_traslation = $db->insert($table, $colname, $array);

                            $array = array($name_cn, $desc_cn, "cn", $coupon_id);
                            $result_coupon_traslation = $db->insert($table, $colname, $array);

                            $array = array($name_my, $desc_my, "my", $coupon_id);
                            $result_coupon_traslation = $db->insert($table, $colname, $array);
                            //--------------------------

                            if ($result_coupon_traslation) {

                                // insert coupon product
                                foreach ($product as $product) {

                                    $table = "coupon_product";
                                    $colname = array("product_id", "coupon_id");
                                    $array = array($product, $coupon_id);
                                    $result_coupon_product = $db->insert($table, $colname, $array);
                                }

                                if ($result_coupon_product) {


                                    $inserted_code = 0;
                                    for ($i = 0; $i < $coupon_generate; $i++) {

                                        //------------------------------------------
                                        //		To get coupon code with no repeat
                                        //------------------------------------------

                                        $check_code = 0;
                                        $coupon_code = 'CP' . random_string(7);
                                        $check_coupon_code = $db->where('code', 'coupon_code', 'code', $coupon_code);

                                        if (count($check_coupon_code) > 0) { //if count distributor code more than 1
                                            do {

                                                $coupon_code = 'CP' . random_string(7);
                                                $check_coupon_code = $db->where('code', 'coupon_code', 'code', $coupon_code);

                                                if (count($check_coupon_code) == 0) {
                                                    $check_code = 1;
                                                }
                                            } while ($check_code != 1);
                                        }
                                        //------------------------------------------

                                        //--------------------------
                                        //  insert coupon code
                                        //--------------------------
                                        $table = "coupon_code";
                                        $colname = array("code", "times_used", "coupon_id", "status", "date_created", "date_modified");
                                        $array = array($coupon_code, 0, $coupon_id, 1, $time, $time);
                                        $result_coupon_code = $db->insert($table, $colname, $array);
                                        //--------------------------

                                        if ($result_coupon_code) {
                                            $inserted_code += 1;
                                        }
                                    }

                                    if ($inserted_code == $coupon_generate) {
                                        echo "<script>alert(\" Coupon code generate Successful. Generated $inserted_code coupon code.  \");
                                          window.location.href='coupon.php';</script>";
                                    } else {
                                        echo "<script>alert(\" Generated $inserted_code coupon code. Some code was missed \");
                                          window.location.href='coupon.php';</script>";
                                    }
                                } //end result_coupon_product
                            } //end result_coupon_traslation
                            else {
                                echo "<script>alert(\" Add Coupon Fail (name part), PLease Try Again. \");
                                window.location.href='coupon.php';</script>";
                            }
                        } // end result coupon
                        else {
                            echo "<script>alert(\" Add Coupon Fail, PLease Try Again. \");
                            window.location.href='coupon.php';</script>";
                        }
                    } // end check coupon name exists
                }
            } else if ($type == "coupon_edit") {
                if (isset($_POST['btnAction'])) {

                    $coupon_id = $_POST['btnAction'];
                    $status = $_POST['status'];

                    $name_en = trim($_POST['name_en']);
                    $name_cn = trim($_POST['name_cn']);
                    $name_my = trim($_POST['name_my']);

                    $desc_en = $_POST['desc_en'];
                    $desc_cn = $_POST['desc_cn'];
                    $desc_my = $_POST['desc_my'];

                    $start = $_POST['start'];
                    $end = $_POST['end'];

                    $coupon_type = $_POST['coupon_type']; //1=amount , 2=percantage

                    $amount = $_POST['amount'];
                    $percentage = $_POST['percentage'];

                    $min_spend = $_POST['min_spend'];
                    $dis_capped = $_POST['dis_capped'];
                    $user_per_coupon = $_POST['user_per_coupon'];
                    $usage_limit = $_POST['usage_limit'];
                    $total_usage_limit = $_POST['total_usage_limit'];

                    $product = $_POST['product'];


                    // check coupon is it isset in database
                    $table = "coupon_translation";
                    $col = "id, name";
                    $opt = '(name = ? || name = ? || name = ?) && coupon_id != ?';
                    $arr = array($name_en, $name_cn, $name_my, $coupon_id);
                    $check_coupon_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_coupon_isset) != 0) {
                        echo "<script>alert(\" Coupon Existed\");
                        window.location.href='coupon.php';</script>";
                    } else {

                        $table = "coupon";
                        $data = "start=?, end=?, type=?, amt=?, percentage=?, min_spend=?, capped=?, user_per_coupon=?, usage_limit=?, total_usage_limit=?, status =?, date_modified = ? WHERE id = ?";
                        $array = array($start, $end, $coupon_type, $amount, $percentage, $min_spend, $dis_capped, $user_per_coupon, $usage_limit, $total_usage_limit, $status, $time, $coupon_id);
                        $result_coupon = $db->update($table, $data, $array);

                        if ($result_coupon) {

                            //--------------------------
                            //  Edit coupon detail
                            //--------------------------
                            $table = "coupon_translation";
                            $data = "name = ?, description = ? WHERE coupon_id = ? && language = ?";
                            $array = array($name_en, $desc_en, $coupon_id, "en");
                            $result_coupon_traslation = $db->update($table, $data, $array);

                            $array = array($name_cn, $desc_cn, $coupon_id, "cn");
                            $result_coupon_traslation = $db->update($table, $data, $array);

                            $array = array($name_my, $desc_my, $coupon_id, "my");
                            $result_coupon_traslation = $db->update($table, $data, $array);
                            //--------------------------

                            if ($result_coupon_traslation) {


                                // delete prodcut for insert again
                                $delete_product = $db->del("coupon_product", 'coupon_id', $coupon_id);

                                // insert coupon product
                                foreach ($product as $product) {

                                    $table = "coupon_product";
                                    $colname = array("product_id", "coupon_id");
                                    $array = array($product, $coupon_id);
                                    $result_coupon_product = $db->insert($table, $colname, $array);
                                }

                                if ($result_coupon_product) {
                                    echo "<script>alert(\" Edit Coupon Successful\");
                                      window.location.href='coupon.php';</script>";
                                } else {
                                    echo "<script>alert(\" Edit Coupon Fail, PLease Try Again. \");
                                      window.location.href='coupon.php';</script>";
                                }
                            } //end result_coupon_traslation
                            else {
                                echo "<script>alert(\" Edit Coupon Fail (name part), PLease Try Again. \");
                                window.location.href='coupon.php';</script>";
                            }
                        } // end result coupon
                        else {
                            echo "<script>alert(\" Edit Coupon Fail, PLease Try Again. \");
                            window.location.href='coupon.php';</script>";
                        }
                    } // end check coupon name exists
                }
            } else if ($type == "coupon_generate_new") {
                if (isset($_POST['btnAction'])) {

                    $coupon_id = $_POST['btnAction'];
                    $coupon_generate = $_POST['coupon_generate'];

                    $inserted_code = 0;
                    for ($i = 0; $i < $coupon_generate; $i++) {

                        //------------------------------------------
                        //		To get coupon code with no repeat
                        //------------------------------------------

                        $check_code = 0;
                        $coupon_code = 'CP' . random_string(7);
                        $check_coupon_code = $db->where('code', 'coupon_code', 'code', $coupon_code);

                        if (count($check_coupon_code) > 0) { //if count distributor code more than 1
                            do {

                                $coupon_code = 'CP' . random_string(7);
                                $check_coupon_code = $db->where('code', 'coupon_code', 'code', $coupon_code);

                                if (count($check_coupon_code) == 0) {
                                    $check_code = 1;
                                }
                            } while ($check_code != 1);
                        }
                        //------------------------------------------

                        //--------------------------
                        //  insert coupon code
                        //--------------------------
                        $table = "coupon_code";
                        $colname = array("code", "times_used", "coupon_id", "status", "date_created", "date_modified");
                        $array = array($coupon_code, 0, $coupon_id, 1, $time, $time);
                        $result_coupon_code = $db->insert($table, $colname, $array);
                        //--------------------------

                        if ($result_coupon_code) {
                            $inserted_code += 1;
                        }
                    }

                    $get_coupon_generated = $db->where('coupon_qty', 'coupon', 'id', $coupon_id);
                    $coupon_qty = $get_coupon_generated[0]['coupon_qty'];
                    $added_coupon_qty = $coupon_qty + $inserted_code;

                    $table = "coupon";
                    $data = "coupon_qty = ?, date_modified = ? WHERE id = ? ";
                    $array = array($added_coupon_qty, $time, $coupon_id);
                    $result_coupon_qty = $db->update($table, $data, $array);

                    if (($inserted_code == $coupon_generate) &&  $result_coupon_qty) {
                        echo "<script>alert(\" Coupon code generate Successful. Generated $inserted_code coupon code. Total code = $added_coupon_qty\");
                                          window.location.href='coupon.php';</script>";
                    } else {
                        echo "<script>alert(\" Generated $inserted_code coupon code. Some code was missed \");
                                          window.location.href='coupon.php';</script>";
                    }
                }
            }
            //--------------------------------------------------
            //                    Coupon Generate
            //--------------------------------------------------

        } // table admin
        else {
            echo "You are not admin";
        }
    } else {
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}
