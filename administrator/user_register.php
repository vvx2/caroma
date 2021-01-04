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
$postedToken = filter_input(INPUT_POST, 'token');
if (!empty($postedToken)) {

    $time = date('Y-m-d H:i:s');

    if (isTokenValid($postedToken)) {
        if ($tb == "admin" || $tb == "user") {

            if ($tb == "admin") {
                $page = "user";
                $pagefail = "user";
            } else {
                $page = "../login";
                $pagefail = "../register";
            }

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
                            $array = array($name, $email, $password, 1, 1, $time, $time);
                            $result_user = $db->insert($table, $colname, $array);

                            if ($result_user) {

                                //--------------------------
                                //  get user id inserted
                                //--------------------------
                                $table = "users";
                                $col = "id";
                                $opt = 'date_created = ?';
                                $arr = array($time);
                                $user = $db->advwhere($col, $table, $opt, $arr);
                                $user_id = $user[0]['id'];
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
                                    echo "<script>alert(\" Register Successful\");
                                      window.location.href='$page.php';</script>";
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
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}
