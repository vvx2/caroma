<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();

if (isset($_REQUEST['active_code']) && isset($_REQUEST['active_mail'])) {
    $get_active_code = $_REQUEST['active_code'];
    $email = $_REQUEST['active_mail'];
} else {
    echo "<script> alert(\" Empty Active Code or Empty Active Mail, Please Use Correct Code or Contact Admin.\");
    window.location.href='../login.php';</script>";
    exit();
}

// active_code = user id
$active_code = encrypt_decrypt('decrypt', $get_active_code);

//--------------------------------------------------
//              Get user details
$col = "*";
$tb = "users";
$opt = 'email = ?';
$arr = array($email);
$users = $db->advwhere($col, $tb, $opt, $arr);
if (count($users) == 0) {
    echo "<script>alert(\"User Not Exists. Please Contact Admin.\");
        window.location.href='../login.php';</script>";
    exit();
}
$users = $users[0];
//--------------------------------------------------

$email = $users["email"];
$id = $users["id"];

if ($active_code == $id) {
    $table = "users";
    $data = "status = ? WHERE id = ? ";
    $array = array(1, $id);
    $result_active = $db->update($table, $data, $array);

    if ($result_active) {
        echo "<script>alert(\" Active Account Successful\");
            window.location.href='../login.php';</script>";
    } else {
        echo "<script>alert(\" Active Account Fail. Please Try Again\");
            window.location.href='../login.php';</script>";
    }
} else {
    echo "<script>alert(\"Wrong Active Code. Please Contact Admin.\");
        window.location.href='../login.php';</script>";
    exit();
}
