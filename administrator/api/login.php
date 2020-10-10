<?php
require_once("../connection/PDO_db_function.php");
$db = new DB_Functions();


if(isset($_REQUEST['Uname'])){
	$username = $_REQUEST['Uname'];
	$username = addslashes($username);
}
else{
	$username = "";
}
if(isset($_REQUEST['Pword'])){
	$password = $_REQUEST['Pword'];
}else{
	$password = "";
}
if(!empty($username)&&!empty($password)){

	$col = "*";
	$tablename = "admin";
	$opt = "user_name = ? AND user_status = ?";
	$arr = array($username,1);
	$result = $db->advwhere($col,$tablename,$opt,$arr);
	if (!empty($result)) {
		foreach($result as $row)
		{
			$encpass = $row['user_password'];
			$password = encrypt_decrypt('encrypt', $password);
			
			if($password == $encpass)
			{
				$log = true;
				$uid = $row['user_id'];
				$key = 'enc_uid';
				

				$uid = $uid.' '.hash('sha256', $key, false);
				
				$uid = str_replace('+','_',$uid);
				
			}
			else
			{	$log = false;
				$uid = "";
			}
		}

	} else {
	   $log = false;
	   $uid = "";
	}
}else{
	$log = false;
	$uid = "";
}
$arr = array($log,$uid,$username,$password);
echo json_encode($arr,true);
?>