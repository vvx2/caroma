<?php
require_once('administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
require_once('inc/level_controller.php');
if (isset($_SESSION['language'])) {

    $language = $_SESSION['language'];
} else {
    $_SESSION['language'] = "en";
    $language = $_SESSION['language'];
}

if ($language == "en") {
    require_once('lang/lang.en.php');
} else if ($language == "cn") {
    require_once('lang/lang.cn.php');
} else if ($language == "my") {
    require_once('lang/lang.my.php');
}
