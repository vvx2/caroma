<?php
session_start();
if (isset($_SESSION['language'])) {
    $language = $_SESSION['language'];
} else {
    $_SESSION['language'] = "en";
    $language = $_SESSION['language'];
}
session_destroy();
unset($_SESSION["id"]);
unset($_SESSION["admin"]);
session_start();
$login = 0;
$_SESSION['login'] = $login;
$_SESSION['language'] =  $language;
header("Location: ../index.php");
exit();
