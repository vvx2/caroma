<?php
require_once("../administrator/connection/PDO_db_function.php");
$db = new DB_Functions();


if (isset($_REQUEST['Uname'])) {
    $username = $_REQUEST['Uname'];
    $username = addslashes($username);
} else {
    $username = "";
}
if (isset($_REQUEST['Pword'])) {
    $password = $_REQUEST['Pword'];
} else {
    $password = "";
}
if (!empty($username) && !empty($password)) {

    $col = "*";
    $tablename = "users";
    $opt = "email = ?";
    $arr = array($username);
    $result = $db->advwhere($col, $tablename, $opt, $arr);
    if (!empty($result)) {
        foreach ($result as $row) {
            $encpass = $row['password'];
            $status = $row['status'];
            $password = encrypt_decrypt('encrypt', $password);

            if ($status == 1) {
                if ($password == $encpass) {
                    $log = true;
                    $uid = $row['id'];
                    $key = 'enc_uid';

                    $uid = $uid . ' ' . hash('sha256', $key, false);

                    $uid = str_replace('+', '_', $uid);
                } else {
                    $log = false;
                    $uid = "2";
                }
            } else {
                $log = false;
                $uid = "5";
            }
        }
    } else {
        $log = false;
        $uid = "3";
    }
} else {
    $log = false;
    $uid = "4";
}
$arr = array($log, $uid, $username, $password);
echo json_encode($arr, true);
