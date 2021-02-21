<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

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
    //---------------------------------------------------------------------------
    //              All user common function is write at here. 
    //              eg. dealer user funcion, distributor user function
    //---------------------------------------------------------------------------
    if (isTokenValid($postedToken)) {
        if ($tb == "user") {
            if ($type == "add") {
                if (isset($_POST['submit'])) {
                }
            }


            //--------------------------------------------------
            //              User Profile
            //--------------------------------------------------

            else if ($type == "profile_edit") {
                if (isset($_POST['btnAction'])) {

                    $name = $_POST['name'];
                    $contact = $_POST['contact'];
                    $address = $_POST['address'];
                    $state = $_POST['state']; //state_id
                    $city = $_POST['city'];
                    $postcode = $_POST['postcode'];


                    if (!file_exists($_FILES['img']['tmp_name']) || !is_uploaded_file($_FILES['img']['tmp_name'])) { // no upload file will not update img name
                        $table = "users";
                        $data = "name =?, date_modified = ? WHERE id = ?";
                        $array = array($name, $time, $user_id);
                        $result_profile = $db->update($table, $data, $array);

                        $table = "user_address";
                        $data = "contact =?, address =?, state =?, city =?, postcode =?, date_modified = ? WHERE user_id = ?";
                        $array = array($contact, $address, $state, $city, $postcode, $time, $user_id);
                        $result_profile = $db->update($table, $data, $array);
                    } else {

                        //------------------------------------------
                        //			Image Upload Start - img
                        //------------------------------------------
                        if ($_FILES["img"]["error"] > 0) {
                            echo "<script>alert('error');</script>";
                        } else {
                            if (file_exists("../../img/profile/" . $_FILES["img"]["name"])) {
                                echo "<script>alert('exist');</script>";
                            } else {
                                $temp = explode(".", $_FILES["img"]["name"]);
                                $newfilename = 'USER' . round(microtime(true)) . '.' . end($temp);
                                move_uploaded_file($_FILES["img"]["tmp_name"], "../../img/profile/" . $newfilename);
                            }
                        }
                        //------------------------------------------
                        //			Image Upload End - img
                        //------------------------------------------
                        $table = "users";
                        $data = "name =?, image =?, date_modified = ? WHERE id = ?";
                        $array = array($name, $newfilename, $time, $user_id);
                        $result_profile = $db->update($table, $data, $array);

                        $table = "user_address";
                        $data = "contact =?, address =?, state =?, city =?, postcode =?, date_modified = ? WHERE user_id = ?";
                        $array = array($contact, $address, $state, $city, $postcode, $time, $user_id);
                        $result_profile = $db->update($table, $data, $array);
                    }

                    if ($result_profile) {
                        echo "<script>alert(\" Update Profile Successful\");
                              window.location.href='../profile.php';</script>";
                    } else {
                        echo "<script>alert(\" Update Profile Fail. Please Try Again\");
                              window.location.href='../profile.php';</script>";
                    }
                }
            } else if ($type == "change_email") {
                if (isset($_POST['btnAction'])) {

                    $email = $_POST['email']; //product id, not table id

                    // check profile is it isset in database
                    $table = "users";
                    $col = "id";
                    $opt = 'email = ?';
                    $arr = array($email);
                    $check_email_exists = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_email_exists) == 0) {

                        $table = "users";
                        $data = "email =?, date_modified = ? WHERE id = ?";
                        $array = array($email, $time, $user_id);
                        $result_email = $db->update($table, $data, $array);

                        if ($result_email) {
                            echo "<script>alert(\" Change Email Successful\");
                              window.location.href='../profile.php';</script>";
                        } else {
                            echo "<script>alert(\" Change Email Fail, PLease Try Again. \");
                            window.location.href='../profile.php';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Email Exists, Please other other email.\");
                        window.location.href='../profile.php';</script>";
                    }
                }
            } else if ($type == "change_password") {
                if (isset($_POST['btnAction'])) {

                    $old_pass = $_POST['old_password'];
                    $new_pass = $_POST['new_password'];
                    $c_pass = $_POST['confirm_password'];

                    // check profile is it isset in database
                    $table = "users";
                    $col = "*";
                    $opt = 'id = ?';
                    $arr = array($user_id);
                    $user = $db->advwhere($col, $table, $opt, $arr);

                    if (count($user) != 0) {

                        $db_old_pass = $user[0]["password"];
                        $db_old_pass = encrypt_decrypt('decrypt', $db_old_pass);
                        if ($old_pass == $db_old_pass) {

                            if ($new_pass == $c_pass) {

                                $new_pass = encrypt_decrypt('encrypt', $new_pass);

                                $table = "users";
                                $data = "password =?, date_modified = ? WHERE id = ?";
                                $array = array($new_pass, $time, $user_id);
                                $result_password = $db->update($table, $data, $array);

                                if ($result_password) {
                                    $msg = "Reset Password Successful";
                                } else {
                                    $msg = "Reset Password Fail";
                                }
                            } else {
                                $msg = "Wrong Confirm Password";
                            }
                        } else {
                            $msg = "Wrong Old Password";
                        }
                        echo "<script>alert(\" $msg\");
                              window.location.href='../profile.php';</script>";
                    } else {
                        echo "<script>alert(\" User Do Not Exists, Please Try Again.\");
                        window.location.href='../profile.php';</script>";
                    }
                }
            }
            //--------------------------------------------------
            //              User Profile
            //--------------------------------------------------

            //--------------------------------------------------
            //              Order
            //--------------------------------------------------
            else if ($type == "order_to_cancel") {
                if (isset($_POST['btnAction'])) {

                    $order_id = $_POST['btnAction'];
                    $reason = $_POST['reason'];

                    $tablename = "orders";
                    $data = "status =?,reason =?, date_modified = ? WHERE id = ?";
                    $array = array(5, $reason, $time, $order_id);
                    $result_order = $db->update($tablename, $data, $array);

                    if ($result_order) {
                        //--------------------------
                        //  get order details
                        //--------------------------
                        $table = "orders";
                        $col = "id, customer_email, customer_name, gateway_order_id, reason";
                        $opt = 'id = ?';
                        $arr = array($order_id);
                        $order = $db->advwhere($col, $table, $opt, $arr);
                        $customer_email = $order[0]['customer_email'];
                        $customer_name = $order[0]['customer_name'];
                        $gateway_order_id = $order[0]['gateway_order_id'];
                        $reason = $order[0]['reason'];
                        //--------------------------



                        if ($user_type == 3) {

                            //get distributor id that dealer under with
                            $table = 'user_dealer ud left join users u on ud.under_distributor = u.id';
                            $col = "ud.under_distributor as under_distributor, u.email as admin_email, u.name as admin_name";
                            $opt = 'user_id =?';
                            $arr = array($user_id);
                            $dealer = $db->advwhere($col, $table, $opt, $arr);
                            $under_distributor = $dealer[0]['under_distributor'];
                            $admin_email = $dealer[0]['admin_email'];
                            $admin_id = $under_distributor;
                            $admin_name = $dealer[0]['admin_name'];

                            // // get product detail.
                            // $col = "id, stock, product_id";
                            // $table = "distributor_product";
                            // $opt = 'product_id = ? AND user_id =? ';
                            // $arr = array($item['product_id'], $admin_id);
                            // $product = $db->advwhere($col, $table, $opt, $arr);

                            // //if product exists then execute
                            // if ($product) {

                            //     $product_id = $product[0]["product_id"];
                            //     $product_stock = $product[0]["stock"];
                            //     $reduced_prodcut_stock = $product_stock - $item['qty'];

                            //     $tablename = "distributor_product";
                            //     $data = "stock = ?, date_modified = ? WHERE product_id = ? AND user_id =?";
                            //     $array = array($reduced_prodcut_stock, $time, $product_id, $user_id);
                            //     $result_reduce_stock = $db->update($tablename, $data, $array);
                            // } else {
                            //     continue;
                            // }
                        } else {
                            $admin_name = "Admin";
                            // // get product detail.
                            // $col = "id, stock";
                            // $table = "product";
                            // $opt = 'id = ?';
                            // $arr = array($item['product_id']);
                            // $product = $db->advwhere($col, $table, $opt, $arr);

                            // //if product exists then execute
                            // if ($product) {

                            //     $product_id = $product[0]["id"];
                            //     $product_stock = $product[0]["stock"];
                            //     $reduced_prodcut_stock = $product_stock - $item['qty'];

                            //     $tablename = "product";
                            //     $data = "stock = ?, date_modified = ? WHERE id = ?";
                            //     $array = array($reduced_prodcut_stock, $time, $product_id);
                            //     $result_reduce_stock = $db->update($tablename, $data, $array);
                            // } else {
                            //     continue;
                            // }
                        }


                        //--------------------------
                        //       for email
                        //--------------------------

                        require_once "../../administrator/vendor/autoload.php";
                        //PHPMailer Object
                        $mail = new PHPMailer;
                        // $mail->SMTPDebug = 3;
                        $mail->isSMTP();
                        $mail->Host = $email_host;
                        $mail->SMTPAuth = true;
                        $mail->Username = $email_username;
                        $mail->Password = $email_password;
                        $mail->SMTPSecure = "tls";
                        $mail->Port = "587";
                        //Send HTML or Plain Text email
                        $mail->isHTML(true);
                        //From email address and name
                        $mail->From = $email_from;
                        $mail->FromName = $email_from_name;

                        //--------------------------
                        //       for email
                        //--------------------------
                        $path_login =  $server_path . "login.php";

                        $cancel_detail = array("path_login" => $path_login, "user_name" => $admin_name, "order_id" => $gateway_order_id, "reason" => $reason);

                        //To address and name
                        $mail->addAddress($admin_email);
                        $mail->Subject = "ORDER TO CANCEL";
                        // $mail->Body = "Congratulations on successful registration";
                        $mail->Body = get_include_contents('../../administrator/mail/order_user_to_cancel.php', $cancel_detail);
                        // $mail->send();
                        // if (!$mail->send()) {
                        //     echo "Mailer Error: " . $mail->ErrorInfo;
                        // } else {
                        //     echo "Message has been sent successfully2";
                        // }
                        //----------------------------
                        //		Email code here(end)
                        // ----------------------------
                        if (!$mail->send()) {
                            echo "<script>alert(\" Update Status Successful, But Send Mail Fail\");
                                  window.location.href='../index.php?p=5';</script>";
                        } else {
                            echo "<script>alert(\" Update Status Successful\");
                                  window.location.href='../index.php?p=5';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Update Status Fail. Please Try Again\");
                              window.location.href='../index.php?p=5';</script>";
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

                        if ($user_type == 1) {
                            //--------------------------------------------------
                            //              Get user point details
                            $col = "*";
                            $tb = "user_point";
                            $opt = 'user_id = ?';
                            $arr = array($user_id);
                            $user_point = $db->advwhere($col, $tb, $opt, $arr);
                            if (count($user_point) == 0) {
                                echo "<script>alert(\" Update Status Successful, But No Point\");
                                  window.location.href='../index.php?p=4';</script>";
                                exit();
                            }
                            $user_point = $user_point[0];
                            //--------------------------------------------------

                            $current_point = $user_point['point'];
                            $order_point = $order['reward_point'];
                            $gateway_order_id = $order["gateway_order_id"]; // order to record in description
                            $description = "Sale. Order Id: " . $gateway_order_id;
                            $added_point = $current_point + $order_point;

                            $tablename = "user_point";
                            $data = "point =? WHERE user_id = ?";
                            $array = array($added_point, $user_id);
                            $result_user_point = $db->update($tablename, $data, $array);

                            if ($result_user_point) {
                                //   Add Histroy to user_point_transaction_history
                                $table = "user_point_transaction_history";
                                $colname = array("point", "current_point", "description", "user_id", "date_created", "date_modified");
                                $array = array($order_point, $added_point, $description, $user_id, $time, $time);
                                $result_user_point_history = $db->insert($table, $colname, $array);

                                if ($result_user_point_history) {
                                    echo "<script>alert(\" Update Status Successful\");
                                window.location.href='../index.php?p=4';</script>";
                                } else {
                                    echo "<script>alert(\" Update Status Successful. But Insert Points History Fail\");
                                window.location.href='../index.php?p=4';</script>";
                                }
                            } else {
                                echo "<script>alert(\" Update Status Successful. But Update Points Fail\");
                                window.location.href='../index.php?p=4';</script>";
                            }
                        } else if ($user_type == 3) {

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

                                //get distributor id that dealer under with
                                $table = 'user_dealer';
                                $col = "*";
                                $opt = 'user_id =?';
                                $arr = array($user_id);
                                $dealer = $db->advwhere($col, $table, $opt, $arr);
                                $under_distributor = $dealer[0]['under_distributor'];
                                $admin_id = $under_distributor;

                                //   Get Distributor wallet details - amount
                                $col = "*";
                                $tb = "user_distributor";
                                $opt = 'user_id = ?';
                                $arr = array($admin_id);
                                $distributor = $db->advwhere($col, $tb, $opt, $arr);
                                $distributor = $distributor[0];
                                $current_wallet_amount = $distributor["distributor_wallet"];

                                //   Add total_payment to amount
                                $added_wallet_amount = $current_wallet_amount + $total_payment;

                                //   Update distributor_wallet
                                $tablename = "user_distributor";
                                $data = "distributor_wallet = ? WHERE user_id = ?";
                                $array = array($added_wallet_amount, $admin_id);
                                $result_user_distributor = $db->update($tablename, $data, $array);

                                if ($result_user_distributor) {
                                    //   Add Histroy to distributor_wallet_transaction_history
                                    $table = "distributor_wallet_transaction_history";
                                    $colname = array("amount", "current_amount", "description", "distributor_id", "date_created", "date_modified");
                                    $array = array($total_payment, $added_wallet_amount, $description, $admin_id, $time, $time);
                                    $result_wallet_history = $db->insert($table, $colname, $array);

                                    if ($result_wallet_history) {
                                        echo "<script>alert(\" Update Status Successful\");
                                    window.location.href='../index.php?p=4';</script>";
                                    } else {
                                        echo "<script>alert(\" Update Status Successful. But Insert History Fail\");
                                    window.location.href='../index.php?p=4';</script>";
                                    }
                                } else {
                                    echo "<script>alert(\" Update Status Successful. But Update Wallet Fail\");
                                    window.location.href='../index.php?p=4';</script>";
                                }

                                exit;
                            } else {
                                echo "<script>alert(\" Update Status Successful\");
                              window.location.href='../index.php?p=4';</script>";
                            }
                            //--------------------------------------------------
                        } else {
                            echo "<script>alert(\" Update Status Successful\");
                              window.location.href='../index.php?p=4';</script>";
                        }
                    } else {
                        echo "<script>alert(\" Update Status Fail. Please Try Again\");
                              window.location.href='../index.php?p=4';</script>";
                    }
                }
            }
            //--------------------------------------------------
            //              Order
            //--------------------------------------------------

            //--------------------------------------------------
            //              Rate Procuct
            //--------------------------------------------------
            else if ($type == "order_product_rate") {
                if (isset($_POST['btnAction'])) {

                    $order_id = $_POST['btnAction'];
                    $prouct_id = $_POST['id'];
                    $prodcut_rate = $_POST['rate'];

                    foreach ($prouct_id as $index => $prouct_id) {
                        $this_product_rate = $prodcut_rate[$index];
                        $this_prouct_id = $prouct_id;

                        $tablename = "order_items";
                        $data = "rate = ? , date_modified = ? WHERE order_id = ? && product_id =?";
                        $array = array($this_product_rate, $time, $order_id, $this_prouct_id);
                        $result_order_rate = $db->update($tablename, $data, $array);
                    }

                    if ($result_order_rate) {
                        echo "<script>alert(\" Rate Successful\");
                              window.location.href='../index.php?p=4';</script>";
                    } else {
                        echo "<script>alert(\" Rate Fail. Please Try Again\");
                              window.location.href='../index.php?p=4';</script>";
                    }
                }
            }
            //--------------------------------------------------
            //              Rate Procuct
            //--------------------------------------------------

        } // table admin
    } else {
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}
