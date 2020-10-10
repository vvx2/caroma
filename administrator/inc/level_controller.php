<?php
if(!isset($_SESSION))
{	session_start();
}
if(isset($_SESSION['id']) && isset($_SESSION['admin']))
{	
    $uid = $_SESSION['id'];
	$user_type = $_SESSION['admin'];
}
else if(isset($_SESSION['id']) && isset($_SESSION['supervisor']))
{	
    $uid = $_SESSION['id'];
	$user_type = $_SESSION['supervisor'];
}
else
{
	echo "<script>window.location.replace('login.php')</script>";
	exit();
}

?>