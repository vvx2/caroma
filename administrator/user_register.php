<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('connection/PDO_db_function.php');
$db = new DB_Functions();
// require_once('inc/init.php');
if (isset($_REQUEST['type']) && isset($_REQUEST['tb'])) {
    $type = $_REQUEST['type'];
    $tb = $_REQUEST['tb'];
}
if ($tb == "admin") {
    $page = "user";
    $pagefail = "user";
} else {
    $page = "../login";
    $pagefail = "../register";
}

$postedToken = filter_input(INPUT_POST, 'token');
if (!empty($postedToken)) {

    $time = date('Y-m-d H:i:s');

    if (isTokenValid($postedToken)) {
        if ($tb == "admin" || $tb == "user") {



            if ($type == "add") {
                if (isset($_POST['submit'])) {
                }
            }


            //--------------------------------------------------
            //                 user Register 
            //--------------------------------------------------

            else if ($type == "user_register") {
                if (isset($_POST['btnAction'])) {

                    $empty_input = 0; // check is input empty
                    if ($_POST['name'] == "" || $_POST['name'] == null) {
                        $empty_input + 1;
                    } else {
                        $name = $_POST['name'];
                    }

                    if ($_POST['email'] == "" || $_POST['email'] == null) {
                        $empty_input + 1;
                    } else {
                        $email = $_POST['email'];
                    }

                    if ($_POST['contact'] == "" || $_POST['contact'] == null) {
                        $empty_input + 1;
                    } else {
                        $contact = $_POST['contact'];
                    }

                    if ($_POST['password'] == "" || $_POST['password'] == null) {
                        $empty_input + 1;
                    } else {
                        $password = $_POST['password'];
                        $password = encrypt_decrypt('encrypt', $password);
                    }

                    if ($_POST['address'] == "" || $_POST['address'] == null) {
                        $empty_input + 1;
                    } else {
                        $address = $_POST['address'];
                    }

                    if ($_POST['state'] == "" || $_POST['state'] == null) {
                        $empty_input + 1;
                    } else {
                        $state = $_POST['state'];
                    }

                    if ($_POST['postcode'] == "" || $_POST['postcode'] == null) {
                        $empty_input + 1;
                    } else {
                        $postcode = $_POST['postcode'];
                    }

                    if ($_POST['city'] == "" || $_POST['city'] == null) {
                        $empty_input + 1;
                    } else {
                        $city = $_POST['city'];
                    }

                    $address_name = "-";

                    if ($empty_input == 0) {
                        // check user is it isset in database
                        $table = "users";
                        $col = "id, name";
                        $opt = 'email =?';
                        $arr = array($email);
                        $check_user_isset = $db->advwhere($col, $table, $opt, $arr);

                        if (count($check_user_isset) != 0) {
                            echo "<script>alert(\" User Existed, Please use other email to register\");
                              window.location.href='$pagefail.php';</script>";
                        } else {

                            $table = "users";
                            $colname = array("name", "email", "password", "type", "status", "date_created", "date_modified");
                            $array = array($name, $email, $password, 1, 0, $time, $time);
                            $result_user = $db->insert($table, $colname, $array);

                            if ($result_user) {

                                //--------------------------
                                //  get user id inserted
                                //--------------------------
                                $table = "users";
                                $col = "id,email";
                                $opt = 'date_created = ?';
                                $arr = array($time);
                                $user = $db->advwhere($col, $table, $opt, $arr);
                                $user_id = $user[0]['id'];
                                $user_email = $user[0]['email'];
                                //--------------------------

                                $table = "user_address";
                                $colname = array("name", "contact", "address", "postcode", "city", "state", "status", "user_id", "date_created", "date_modified");
                                $array = array($address_name, $contact, $address, $postcode, $city, $state, 1, $user_id, $time, $time);
                                $result_user_address = $db->insert($table, $colname, $array);

                                $table = "user_point";
                                $colname = array("point", "user_id");
                                $array = array(0, $user_id);
                                $result_user_point = $db->insert($table, $colname, $array);


                                if ($result_user_address && $result_user_point) {

                                    $result_coupon_email = $db->get("*", "coupon_email", 1);
                                    if (count($result_coupon_email) != 0) {
                                        $coupon_id = $result_coupon_email[0]['coupon_id'];
                                        $tb = "coupon left join coupon_translation on coupon.id = coupon_translation.coupon_id";
                                        $col = "coupon.id as id, coupon.code as code, coupon_translation.name as name, coupon_translation.description as description";
                                        $opt = 'coupon.id = ? && coupon_translation.language = ?';
                                        $arr = array($coupon_id, "en");
                                        $result_coupon = $db->advwhere($col, $tb, $opt, $arr);
                                        if (count($result_coupon) != 0) {
                                            $coupon_name = $result_coupon[0]['name'];
                                            $coupon_id = $result_coupon[0]['id'];
                                            $coupon_code_msg = "<br> *Gift - For New User Only* <br> Coupon Code: " . $result_coupon[0]['code'] . " <br> Description: " . $result_coupon[0]['description'];
                                        } else {
                                            $coupon_id = 0;
                                            $coupon_code_msg = "";
                                        }
                                    } else {
                                        $coupon_id = 0;
                                        $coupon_code_msg = "";
                                    }

                                    //--------------------------
                                    //       for email
                                    //--------------------------
                                    require_once "vendor/autoload.php";
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
                                    $active_code = encrypt_decrypt('encrypt', $user_id);

                                    $path_active =  $server_path . "api/active_account.php?active_code=" . $active_code . "&active_mail=" . $user_email;


                                    $active_detail = array("path" => $path_active, "user_name" => $name, "coupon_id" => $coupon_id, "coupon_code_msg" => $coupon_code_msg);

                                    //To address and name
                                    $mail->addAddress($user_email);
                                    $mail->Subject = "REGISTER SUCCESSFUL";
                                    // $mail->Body = "Congratulations on successful registration";
                                    $mail->Body = get_include_contents('mail/register_active.php', $active_detail);
                                    $mail->send();
                                    // if (!$mail->send()) {
                                    //     echo "Mailer Error: " . $mail->ErrorInfo;
                                    // } else {
                                    //     echo "Message has been sent successfully2";
                                    // }
                                    //----------------------------
                                    //		Email code here(end)
                                    //----------------------------
                                    if ($mail) {
                                        echo "<script>alert(\" Register Successful\");
                                      window.location.href='$page.php';</script>";
                                    } else {
                                        echo "<script>alert(\" Register Successful! But Send Mail Fail.\");
                                      window.location.href='$page.php';</script>";
                                    }
                                } else {
                                    echo "<script>alert(\" Register Fail, PLease Try Again. \");
                                      window.location.href='$page.php';</script>";
                                }
                            } // end $result_user
                        } // end check isset user
                    } else { // end check empty input
                        echo "<script>alert(\" Your Input cannot be empty\");
                        window.location.href='$pagefail.php';</script>";
                    }
                }
            }

            //--------------------------------------------------
            //                    DISTRIBUTOR
            //--------------------------------------------------

        } // table admin
    } else {
        // echo "Token Expired. Please Try Again";
        echo "<script>alert(\" Token Expired. Please Try Again\");
                        window.location.href='$pagefail.php';</script>";
    }
} else {
    // echo "Token Is Required.";
    echo "<script>alert(\" Token Is Required\");
                        window.location.href='$pagefail.php';</script>";
}
