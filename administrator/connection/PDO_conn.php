<?php

$server = 2; //1= local, 2 = staging, 3 = live;
if ($server == 1) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromanew;charset=utf8;');
    define('username', 'root');
    define('pass', '');
} else if ($server == 2) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromaca_shop;charset=utf8;');
    define('username', 'caromaca_shop');
    define('pass', ';irmNFv*C~^c');
} else if ($server == 3) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromaca_shop;charset=utf8;');
    define('username', 'caromaca_shop');
    define('pass', ';irmNFv*C~^c');
}
if ($server == 1) { //1= local, 2 = staging, 3 = live;
    $server_path = "http://www.staging4.caroma.com.my/";
} else if ($server == 2) {
    $server_path = "http://www.staging4.caroma.com.my/";
} else if ($server == 3) {
    $server_path = "http://www.staging4.caroma.com.my/";
}


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
