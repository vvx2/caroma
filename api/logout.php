<?php
session_start();
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION["admin"]);
$login = 0;
$_SESSION['login'] = $login;
header("Location: ../index.php");
exit();
