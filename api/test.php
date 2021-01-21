<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
$time = date('Y-m-d H:i:s');

$table = 'coupon';
$col = "*";
$opt = 'code = ?';
$arr = array("DERQDW");
$coupon = $db->advwhere($col, $table, $opt, $arr);

$coupon = $coupon[0];

$id = $coupon['id'];
$status = $coupon['status'];
$type = $coupon['type'];
$amt = $coupon['amt'];
$percentage = $coupon['percentage'];
$min_spend = $coupon['min_spend'];
$capped = $coupon['capped'];
$usage_limit = $coupon['usage_limit']; // how many time can be used per 1 user
$total_usage_limit = $coupon['total_usage_limit'];
$total_times_used = $coupon['total_times_used'];
$coupon_delivery = $coupon['free_delivery'];

$start =  $coupon['start'];
$end =  $coupon['end'];

echo "<pre>";
echo "start ";
var_dump($start);

echo "end ";
var_dump($end);

echo "time ";
var_dump($time);

$date = new DateTime($end);
$date->add(new DateInterval('P1D'));
$new_end = $date->format('Y-m-d H:i:s');

$test = new DateTime("2020-12-24 23:59:59");
$test = $test->format('Y-m-d H:i:s');

$test2 = new DateTime("2020-12-25 00:00:00");
$test2 = $test2->format('Y-m-d H:i:s');
echo "new end ";
var_dump($new_end);
echo "test ";
var_dump($test);
if ($test > $test2) {
    echo "yes";
} else {
    echo "no";
}
