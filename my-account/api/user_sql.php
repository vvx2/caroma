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

        } // table admin
    } else {
        echo "Token Expired. Please Try Again";
    }
} else {
    echo "Token Is Required.";
}