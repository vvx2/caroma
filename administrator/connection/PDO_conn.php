<?php

$server = 1; //1= local, 2 = staging, 3 = live;
if ($server == 1) {
    define('host', 'mysql:host=localhost;port=3306;dbname=caromanew;charset=utf8;');
    define('username', 'root');
    define('pass', '');
} else if ($server == 2) {
    define('host', 'mysql:host=localhost;port=3306;dbname=lenovore_staging_lenovo;charset=utf8;');
    define('username', 'lenovore_staging');
    define('pass', 'z,G^A0dDPnyn');
} else if ($server == 3) {
    define('host', 'mysql:host=localhost;port=3306;dbname=lenovore_lenovo;charset=utf8;');
    define('username', 'lenovore_lenovore');
    define('pass', 'Ao928b9FCxN;:u');
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
