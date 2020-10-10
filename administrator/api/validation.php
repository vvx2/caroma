<?php
require_once("../connection/PDO_db_function.php");
$db = new DB_Functions();

if (isset($_REQUEST['type'])) {
	$type = $_REQUEST['type'];
	
	if ($type == 'check_ic') {

		$ic = $_POST['user_ic'];

		$col = "ic";
		$tb = "redemption";
		$chkcol = "ic";
		$opt = $ic;

		$result = $db->where($col, $tb, $chkcol, $opt);

		if (count($result) != 0) {
			$status = false;
			$msg = "IC Is Exist";
		} else {

			$status = true;
			$msg = "IC Is Available";
		}
	}

	if ($type == 'check_user') {

		$user_name = $_POST['user_name'];

		$col = "*";
		$tb = "user";
		$chkcol = "user_name";
		$opt = $user_name;

		$result = $db->where($col, $tb, $chkcol, $opt);

		if (count($result) != 0) {
			$status = false;
			$msg = "Username Is Exist";
		} else {

			$status = true;
			$msg = "Username Is Available";
		}
	}

	if ($type == 'check_email') {

		$user_email = $_POST['user_email'];

		$col = "*";
		$tb = "user";
		$chkcol = "user_email";
		$opt = $user_email;

		$result = $db->where($col, $tb, $chkcol, $opt);

		if (count($result) != 0) {
			$status = false;
			$msg = "This Email Is Exist";
		} else {

			$status = true;
			$msg = "Email Is Available";
		}
	}
} else {
	$status = false;
	$msg = "Missing Validation Type";
}
$arr = array('Status' => $status, 'Msg' => $msg);
echo json_encode($arr);
