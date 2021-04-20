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
            //                 Reset Password Generate 
            //--------------------------------------------------

            else if ($type == "reset_password") {
                if (isset($_POST['btnsubmit'])) {

                    $old_pass = $_POST['old_pass'];
                    $new_pass = $_POST['new_pass'];
                    $c_pass = $_POST['c_pass'];

                    if ($_SESSION['admin'] == 'admin') {

                        $admin = $db->where("*", "admin", "user_id", $_SESSION['id']);
                        $db_old_pass = $admin[0]["user_password"];
                        $admin_id = $admin[0]["user_id"];

                        $db_old_pass = encrypt_decrypt('decrypt', $db_old_pass);

                        if ($old_pass == $db_old_pass) {

                            if ($new_pass == $c_pass) {

                                $new_pass = encrypt_decrypt('encrypt', $new_pass);

                                $data = "user_password = ? WHERE user_id = ?";
                                $array = array($new_pass, $admin_id);
                                $result = $db->update("admin", $data, $array);

                                if ($result) {
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


                        echo "<script>alert(\" " . $msg . "\");
						window.location.href='reset_password.php';</script>";
                    } else if ($_SESSION['admin'] != 'admin') {

                        die('you are not admin');
                    }
                }
            }
            //--------------------------------------------------
            //                    Reset Password Generate
            //--------------------------------------------------

        } // table admin
        else {
            // echo "You are not admin";
            echo "<script>alert(\" You are not admin. \");
            window.location.href='coupon.php';</script>";
        }
    } else {
        // echo "Token Expired. Please Try Again";
        echo "<script>alert(\" Token Expired. Please Try Again\");
            window.location.href='coupon.php';</script>";
    }
} else {
    // echo "Token Is Required.";
    echo "<script>alert(\" Token Is Required\");
            window.location.href='coupon.php';</script>";
}
