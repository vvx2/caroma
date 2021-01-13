<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once('../administrator/connection/PDO_db_function.php');
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
        if ($tb == "user") {

            if ($type == "add") {
                if (isset($_POST['submit'])) {
                }
            }

            //--------------------------------------------------
            //                 reset_password 
            //--------------------------------------------------

            else if ($type == "reset_password") {
                if (isset($_POST['btnAction'])) {


                    if ($_POST['email'] == "" || $_POST['email'] == null) {
                        echo "<script>alert(\" Email Cant Be Empty, Please Try Again\");
                              window.location.href='../reset-password.php';</script>";
                        exit();
                    } else {
                        $email = $_POST['email'];
                    }

                    // check user is it isset in database
                    $table = "users";
                    $col = "id, name, email, password";
                    $opt = 'email =?';
                    $arr = array($email);
                    $check_user_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_user_isset) == 0) {
                        echo "<script>alert(\" Email Do Not Existed, Please Try Again\");
                              window.location.href='../reset-password.php';</script>";
                    } else {

                        //--------------------------
                        //       for email
                        //--------------------------
                        require_once "../administrator/vendor/autoload.php";
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

                        //--------------------------
                        //  get user details
                        //--------------------------
                        $name = $check_user_isset[0]['name'];
                        $user_email = $check_user_isset[0]['email'];
                        $user_encrypted_password = $check_user_isset[0]['password'];

                        $reset_code = encrypt_decrypt('encrypt', $user_email); //email = resetcode, because cant be duplicate in db

                        // echo $reset_code;
                        // echo '<br>';
                        // echo $decrypt_reset_code;
                        // echo '<br>';
                        // echo $password;
                        // echo '<br>';
                        //--------------------------

                        $path_reset = $server_path . "reset-password-api.php?reset_code=" . $reset_code;

                        $reset_detail = array("path" => $path_reset, "user_name" => $name);

                        //To address and name
                        $mail->addAddress($user_email);
                        $mail->Subject = "RESET PASSWORD";
                        // $mail->Body = "Congratulations on successful registration";
                        $mail->Body = get_include_contents('../administrator/mail/reset_password.php', $reset_detail);
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
                            echo "<script>alert(\" Request Successful, Please Check Your Mail\");
                                      window.location.href='../login.php';</script>";
                        } else {
                            echo "<script>alert(\"Send Mail Fail. Please Try Again\");
                                      window.location.href='../reset-password.php';</script>";
                        }
                    } // end check isset user

                }
            } else if ($type == "reset_password_api") {
                if (isset($_POST['btnAction'])) {

                    if ($_POST['reset_code'] == "" || $_POST['reset_code'] == null) {
                        echo "<script>alert(\" Reset Code Cant Be Empty, Please Try Again. Click The Link Again\");
                              window.location.href='../login.php';</script>";
                        exit();
                    } else {
                        $reset_code = $_POST['reset_code'];
                    }

                    if ($_POST['password'] == "" || $_POST['password'] == null) {
                        echo "<script>alert(\" Password Cant Be Empty, Please Try Again. Click The Link Again\");
                              window.location.href='../login.php';</script>";
                        exit();
                    } else {
                        $password = $_POST['password'];
                    }

                    $email = encrypt_decrypt('decrypt', $reset_code);
                    // check user is it isset in database
                    $table = "users";
                    $col = "id, name, email, password";
                    $opt = 'email =?';
                    $arr = array($email);
                    $check_user_isset = $db->advwhere($col, $table, $opt, $arr);

                    if (count($check_user_isset) == 0) {
                        echo "<script>alert(\" Email Do Not Existed, Please Try Again\");
                              window.location.href='../reset-password.php';</script>";
                    } else {

                        $new_password = encrypt_decrypt('encrypt', $password);

                        $table = "users";
                        $data = "password = ? WHERE id = ? ";
                        $array = array($new_password, $check_user_isset[0]['id']);
                        $result_reset_password = $db->update($table, $data, $array);

                        if ($result_reset_password) {
                            echo "<script>alert(\" Reset Password Successful\");
                                window.location.href='../login.php';</script>";
                        } else {
                            echo "<script>alert(\" Reset Password Fail. Please Try Again\");
                                window.location.href='../login.php';</script>";
                        }
                    } // end check isset user

                }
            }

            //--------------------------------------------------
            //                    reset_password
            //--------------------------------------------------

        } // table admin
    } else {
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}
