<?php
require_once("../connection/PDO_db_function.php");
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
			$_SESSION['id'] = $uid;
			$type = $db->where('user_type', 'admin', 'user_id', $uid);
			$user_type = $type[0]['user_type'];

			if ($user_type == 1) {
				$_SESSION['admin'] = 'admin';
				header("Location: ../index.php");
			} 
			// else if ($user_type == 2) {
			// 	$_SESSION['supervisor'] = 'supervisor';
			// 	header("Location: ../sv_redemption.php");
			// }
		}
	}
}
