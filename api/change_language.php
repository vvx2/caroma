<?php
require_once('../administrator/connection/PDO_db_function.php');
$language = $_REQUEST['language'];

$_SESSION['language'] = $language;

$json_arr = array('Status' => true, 'Language' => $language);

echo json_encode($json_arr);
