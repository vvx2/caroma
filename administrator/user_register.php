<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// require_once('connection/PDO_db_function.php');
// $db = new DB_Functions(); 
require_once('inc/init.php');
// require_once("inc/level_controller.php");
if (isset($_REQUEST['type']) && isset($_REQUEST['tb'])) {
    $type = $_REQUEST['type'];
    $tb = $_REQUEST['tb'];
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

                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $contact = $_POST['contact'];
                    $password = $_POST['password'];
                    $password = encrypt_decrypt('encrypt', $password);
                    $address = $_POST['address'];
                    $state = $_POST['state'];
                    $postcode = $_POST['postcode'];
                    $city = $_POST['city'];
                    $address_name = "-";


                    // check user is it isset in database
                    $table = "users";
                    $col = "id, name";
                    $opt = 'email =?';
                    $arr = array($email);
                    $check_user_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_user_isset) != 0) {
                        echo "<script>alert(\" User Existed, Please use other email to register\");
                              window.location.href='user.php';</script>";
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
                            $colname = array("point","user_id");
                            $array = array(0, $user_id);
                            $result_user_point = $db->insert($table, $colname, $array);


                            if ($result_user_address && $result_user_point) {
                                echo "<script>alert(\" Add User Successful\");
                                      window.location.href='user.php';</script>";
                            } else {
                                echo "<script>alert(\" Add User Fail, PLease Try Again. \");
                                      window.location.href='user.php';</script>";
                            }
                        }
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
