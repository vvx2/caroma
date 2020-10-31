<?php
if (!isset($_SESSION)) {
	session_start();
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
	// echo "<script>window.location.replace('login.php')</script>";
	// exit();
}
