<?php
include_once('PDO_conn.php');
if (!isset($_SESSION)) {
	session_start();
}


date_default_timezone_set('Singapore');
$date = date('Y-m-d H:i:s');
function random_string($length)
{
	$key = '';
	$keys = array_merge(range(0, 9), range('A', 'Z'));

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $key;
}
//token
function getToken()
{
	$token = sha1(mt_rand());
	if (!isset($_SESSION['tokens'])) {
		$_SESSION['tokens'] = array($token => 1);
	} else {
		$_SESSION['tokens'][$token] = 1;
	}
	return $token;
}
function isTokenValid($token)
{
	if (!empty($_SESSION['tokens'][$token])) {
		unset($_SESSION['tokens'][$token]);
		return true;
	}
	return false;
}

function encrypt_decrypt($action, $string)
{
	$output = false;

	$encrypt_method = "AES-256-CBC";
	$secret_key = 'key';
	$secret_iv = 'iv';

	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	if ($action == 'encrypt') {
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	} else if ($action == 'decrypt') {
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

function get_include_contents($filename, $variablesToMakeLocal)
{
	extract($variablesToMakeLocal);
	if (is_file($filename)) {
		ob_start();
		include $filename;
		return ob_get_clean();
	}
	return false;
}

$token = getToken();

class DB_FUNCTIONS
{
	protected $conn;
	function where($col, $tablename, $data, $opt)
	{
		global $conn;
		$stmt = $conn->prepare("SELECT $col FROM $tablename WHERE $data= :opt");
		$stmt->bindValue(":opt", $opt, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	function advwhere($col, $tablename, $opt, $arr)
	{
		global $conn;
		$stmt = $conn->prepare("SELECT $col FROM $tablename WHERE $opt");
		$stmt->execute($arr);
		$result = $stmt->fetchAll();
		return $result;
	}
	function get($col, $tablename, $opt)
	{
		global $conn;
		$stmt = $conn->prepare("SELECT $col FROM $tablename WHERE :opt");
		$stmt->bindValue(":opt", $opt, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	function update($tablename, $data, $array)
	{
		global $conn;
		$stmt = $conn->prepare("UPDATE `$tablename` SET $data");
		$array = array_map('trim', $array);
		$result = $stmt->execute($array);
		return $result;
	}
	function insert($tablename, $colname, $array)
	{
		global $conn;
		$datacount = count($colname);
		if ($datacount != 0 && is_array($colname)) {
			$datamark = array();
			for ($i = 0; $i < $datacount; $i++) {
				$datamark[] = '?';
			}
			$colname = implode(',', $colname);
			$datamark = implode(',', $datamark);
			$stmt = $conn->prepare("INSERT INTO $tablename ($colname) VALUES ($datamark)");
			$array = array_map('trim', $array);
			$result = $stmt->execute($array);
			return $result;
		} else {
			exit('Data Parse Error');
		}
	}

	function del($tablename, $data, $array)
	{
		global $conn;
		$stmt = $conn->prepare("DELETE FROM `$tablename` WHERE $data = $array");
		$result = $stmt->execute();
		return $result;
	}

	function delall($tablename, $data, $array)
	{
		global $conn;
		$stmt = $conn->prepare("DELETE FROM `$tablename` WHERE $data != $array");
		$result = $stmt->execute();
		return $result;
	}


	function advdel($tablename, $opt, $arr)
	{
		global $conn;
		$stmt = $conn->prepare("DELETE FROM `$tablename` WHERE $opt");
		$stmt->execute($arr);
		$result = $stmt->fetchAll();
		return $result;
	}
	function getuser($col, $tablename)
	{
		global $conn;
		$stmt = $conn->prepare("SELECT $col FROM $tablename");
		//$stmt->bindValue(":opt", $opt, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}

	function select($col, $tablename, $opt)
	{
		global $conn;
		$stmt = $conn->prepare("SELECT $col FROM $tablename ORDER BY $opt DESC LIMIT 1");
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
}