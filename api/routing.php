<?php
require_once("../administrator/connection/PDO_db_function.php");
$db = new DB_Functions();


if (isset($_REQUEST['login_key'])) {

    if (strlen($_REQUEST['login_key']) >= 65) {

        $uid = $_REQUEST['login_key'];
        $uid = str_replace('_', '+', $uid);

        $key = 'enc_uid';
        $key = hash('sha256', $key, false);

        $uid = str_replace(' ', '', rtrim($uid, $key));

        if (is_numeric($uid)) {
            //get id and check user type
            $_SESSION['user_id'] = $uid;
            $type = $db->where('type', 'users', 'id', $uid);
            $user_type = $type[0]['type'];

            $_SESSION['type'] = $user_type;
            header("Location: ../my-account/index.php");
        }
    }
}
