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
            //                 promotion Generate 
            //--------------------------------------------------

            else if ($type == "promotion_generate") {
                if (isset($_POST['btnAction'])) {

                    $name_en = trim($_POST['name_en']);
                    $name_cn = trim($_POST['name_cn']);
                    $name_my = trim($_POST['name_my']);

                    $desc_en = $_POST['desc_en'];
                    $desc_cn = $_POST['desc_cn'];
                    $desc_my = $_POST['desc_my'];

                    $start = $_POST['start'];
                    $end = $_POST['end'];

                    $promotion_type = $_POST['promotion_type']; //1=amount , 2=percantage

                    $amount = $_POST['amount'];
                    $percentage = $_POST['percentage'];

                    $dis_capped = $_POST['dis_capped'];

                    $product = $_POST['product'];

                    // check promotion is it isset in database
                    $table = "promotion_translation";
                    $col = "id, name";
                    $opt = 'name = ? || name = ? || name = ?';
                    $arr = array($name_en, $name_cn, $name_my);
                    $check_promotion_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_promotion_isset) != 0) {
                        echo "<script>alert(\" promotion Existed\");
                        window.location.href='promotion.php';</script>";
                    } else {

                        $table = "promotion";
                        $colname = array("start", "end", "type", "amt", "percentage", "capped", "status", "date_created", "date_modified");
                        $array = array($start, $end, $promotion_type, $amount, $percentage, $dis_capped, 1, $time, $time);
                        $result_promotion = $db->insert($table, $colname, $array);

                        if ($result_promotion) {

                            //--------------------------
                            //  get promotion id inserted
                            //--------------------------
                            $table = "promotion";
                            $col = "id";
                            $opt = 'date_created = ?';
                            $arr = array($time);
                            $promotion = $db->advwhere($col, $table, $opt, $arr);
                            $promotion_id = $promotion[0]['id'];
                            //--------------------------


                            //--------------------------
                            //  insert promotion detail
                            //--------------------------
                            $table = "promotion_translation";
                            $colname = array("name", "description", "language", "promotion_id");
                            $array = array($name_en, $desc_en, "en", $promotion_id);
                            $result_promotion_traslation = $db->insert($table, $colname, $array);

                            $array = array($name_cn, $desc_cn, "cn", $promotion_id);
                            $result_promotion_traslation = $db->insert($table, $colname, $array);

                            $array = array($name_my, $desc_my, "my", $promotion_id);
                            $result_promotion_traslation = $db->insert($table, $colname, $array);
                            //--------------------------

                            if ($result_promotion_traslation) {

                                // insert promotion product
                                foreach ($product as $product) {

                                    $table = "promotion_product";
                                    $colname = array("product_id", "promotion_id");
                                    $array = array($product, $promotion_id);
                                    $result_promotion_product = $db->insert($table, $colname, $array);
                                }

                                if ($result_promotion_product) {
                                    echo "<script>alert(\" promotion generate Successful.  \");
                                          window.location.href='promotion.php';</script>";
                                } else {
                                    echo "<script>alert(\" promotion generate Fail. Please Try Again  \");
                                          window.location.href='promotion.php';</script>";
                                } //end result_promotion_product

                            } //end result_promotion_traslation
                            else {
                                echo "<script>alert(\" Add promotion Fail (name part), PLease Try Again. \");
                                window.location.href='promotion.php';</script>";
                            }
                        } // end result promotion
                        else {
                            echo "<script>alert(\" Add promotion Fail, PLease Try Again. \");
                            window.location.href='promotion.php';</script>";
                        }
                    } // end check promotion name exists

                }
            } else if ($type == "promotion_edit") {
                if (isset($_POST['btnAction'])) {

                    $promotion_id = $_POST['btnAction'];
                    $status = $_POST['status'];

                    $name_en = trim($_POST['name_en']);
                    $name_cn = trim($_POST['name_cn']);
                    $name_my = trim($_POST['name_my']);

                    $desc_en = $_POST['desc_en'];
                    $desc_cn = $_POST['desc_cn'];
                    $desc_my = $_POST['desc_my'];

                    $start = $_POST['start'];
                    $end = $_POST['end'];

                    $promotion_type = $_POST['promotion_type']; //1=amount , 2=percantage

                    $amount = $_POST['amount'];
                    $percentage = $_POST['percentage'];

                    $dis_capped = $_POST['dis_capped'];

                    $product = $_POST['product'];


                    // check promotion name is it isset in database
                    $table = "promotion_translation";
                    $col = "id, name";
                    $opt = '(name = ? || name = ? || name = ?) && promotion_id != ?';
                    $arr = array($name_en, $name_cn, $name_my, $promotion_id);
                    $check_promotion_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_promotion_isset) != 0) {
                        echo "<script>alert(\" promotion Name Existed\");
                        window.location.href='promotion.php';</script>";
                    } else {

                        $table = "promotion";
                        $data = "start=?, end=?, type=?, amt=?, percentage=?, capped=?, status =?, date_modified = ? WHERE id = ?";
                        $array = array($start, $end, $promotion_type, $amount, $percentage, $dis_capped, $status, $time, $promotion_id);
                        $result_promotion = $db->update($table, $data, $array);

                        if ($result_promotion) {

                            //--------------------------
                            //  Edit promotion detail
                            //--------------------------
                            $table = "promotion_translation";
                            $data = "name = ?, description = ? WHERE promotion_id = ? && language = ?";
                            $array = array($name_en, $desc_en, $promotion_id, "en");
                            $result_promotion_traslation = $db->update($table, $data, $array);

                            $array = array($name_cn, $desc_cn, $promotion_id, "cn");
                            $result_promotion_traslation = $db->update($table, $data, $array);

                            $array = array($name_my, $desc_my, $promotion_id, "my");
                            $result_promotion_traslation = $db->update($table, $data, $array);
                            //--------------------------

                            if ($result_promotion_traslation) {


                                // delete prodcut for insert again
                                $delete_product = $db->del("promotion_product", 'promotion_id', $promotion_id);

                                // insert promotion product
                                foreach ($product as $product) {

                                    $table = "promotion_product";
                                    $colname = array("product_id", "promotion_id");
                                    $array = array($product, $promotion_id);
                                    $result_promotion_product = $db->insert($table, $colname, $array);
                                }

                                if ($result_promotion_product) {
                                    echo "<script>alert(\" Edit promotion Successful\");
                                      window.location.href='promotion.php';</script>";
                                } else {
                                    echo "<script>alert(\" Edit promotion Fail, PLease Try Again. \");
                                      window.location.href='promotion.php';</script>";
                                }
                            } //end result_promotion_traslation
                            else {
                                echo "<script>alert(\" Edit promotion Fail (name part), PLease Try Again. \");
                                window.location.href='promotion.php';</script>";
                            }
                        } // end result promotion
                        else {
                            echo "<script>alert(\" Edit promotion Fail, PLease Try Again. \");
                            window.location.href='promotion.php';</script>";
                        }
                    } // end check promotion name exists
                }
            }
            //--------------------------------------------------
            //                    promotion Generate
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
