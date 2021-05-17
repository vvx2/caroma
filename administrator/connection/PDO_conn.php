<?php

$server = 2; //1= local, 2 = staging, 3 = live 4 = Nicky Local;
if ($server == 1) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromanew;charset=utf8;');
    define('username', 'root');
    define('pass', '');
} else if ($server == 2) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromaca_shop;charset=utf8;');
    define('username', 'caromaca_shop');
    define('pass', ';irmNFv*C~^c');
} else if ($server == 3) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromaca_shop_live;charset=utf8;');
    define('username', 'caromaca_shop_live');
    define('pass', '7$..njjkG_il');
} else if ($server == 4) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromaca_shop;charset=utf8;');
    define('username', 'root');
    define('pass', '');
}
if ($server == 1) { //1= local, 2 = staging, 3 = live;
    $server_path = "https://localhost/caroma/";
} else if ($server == 2) {
    $server_path = "https://staging3.caroma.com.my/";
} else if ($server == 3) {
    $server_path = "https://shop.caroma.com.my/";
}

//-------------------------------------
//         email setting
//-------------------------------------

$admin_email = "sales@caroma.com.my"; // email receive notification
$email_host = "mail.caroma.com.my";
$email_username = "no-reply@caroma.com.my"; //email send mail
$email_password = "Caroma@9223";    //email send mail
$email_from = "info@caroma.com.my";
$email_from_name = "Caroma Team";

//-------------------------------------

try {
    $dbh = new PDO(host, username, pass); // initialize pdo

    // reset pdo
    $dbh = null;
} catch (PDOException $e) {
    die("Error!: " . $e->getMessage() . "<br/>");
}

$conn = new PDO(host, username, pass);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
