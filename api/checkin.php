<?php
require_once('../administrator/connection/PDO_db_function.php');
$db = new DB_FUNCTIONS();
if (isset($_SESSION['user_id']) && isset($_SESSION['type'])) {
    $user_id = $_SESSION['user_id'];
    $user_type = $_SESSION['type'];
    $login = 1;
    $_SESSION['login'] = $login;
} else {
    $login = 0;
    $_SESSION['login'] = $login;
    $user_type = 1;
}
if (isset($_SESSION['language'])) {

    $language = $_SESSION['language'];
} else {
    $_SESSION['language'] = "en";
    $language = $_SESSION['language'];
}

$time = date('Y-m-d H:i:s');
if ($login != 1) {
    echo "<script>window.location.replace('login.php')</script>";
    exit();
}
if ($user_type != 1) {
    echo "<script> alert(\" Your Are Not Normal User. So, You Cannot User This Feacture.\");
    window.location.href='../index.php';</script>";
    exit();
}

// this to check is yesterday checked in. if yes mean it is continue check in.
$date = new DateTime(); // For today/now, don't pass an arg.
$today = $date->format("Y-m-d");
$date->modify("-1 day");
$yesterday = $date->format("Y-m-d");

//--------------------------------------------------
//              Get user point details
$col = "*";
$tb = "user_point";
$opt = 'user_id = ?';
$arr = array($user_id);
$user_point = $db->advwhere($col, $tb, $opt, $arr);
if (count($user_point) == 0) {
    echo "<script>alert(\"No Point List. Please Contact Admin.\");
        window.location.href='../index.php';</script>";
    exit();
}
$user_point = $user_point[0];
//--------------------------------------------------

$checked = $user_point["checked"];
$day_continue = $user_point["day_continue"];

$check_date = $user_point["check_date"];
if ($check_date == $today) {
    echo "<script> alert(\" Your Have Checked Today!\");
    window.location.href='../rewards.php';</script>";
    exit();
}

$current_point = $user_point['point'];

// var_dump($today);
// echo "<br>";
// var_dump($yesterday);;
// echo "<br>";
// var_dump($check_date);;
// echo "<br>";

if (($check_date == NULL || $check_date == "") || $yesterday != $check_date) {
    // +1 points 
    $point_add = 1;
    $added_point = $current_point + $point_add;
    $new_continue_day = 1;
    $description = "Checkin. Day: " . $new_continue_day;
} else {
    // day_continue + 1
    if ($yesterday == $check_date) {
        if ($user_point["day_continue"] == 1) {
            $day_continue = $user_point["day_continue"] + 1;
        } else {
            $day_continue = $user_point["day_continue"];
        }
    }
    $point_add = $day_continue;
    $added_point = $current_point + $point_add;
    $description = "Checkin. Day: " . $day_continue;
    $new_continue_day =  $day_continue + 1;
}


$tablename = "user_point";
$data = "point =?, checked =?, check_date =?, day_continue =? , date_modified =? WHERE user_id = ?";
$array = array($added_point, 1, $today, $new_continue_day, $time, $user_id);
$result_user_point = $db->update($tablename, $data, $array);


if ($result_user_point) {

    //   Add Histroy to user_point_transaction_history
    $table = "user_point_transaction_history";
    $colname = array("point", "current_point", "description", "user_id", "date_created", "date_modified");
    $array = array($point_add, $added_point, $description, $user_id, $time, $time);
    $result_user_point_history = $db->insert($table, $colname, $array);

    if ($result_user_point_history) {
        echo "<script>alert(\" Checked In Successful\");
        window.location.href='../rewards.php';</script>";
    } else {
        echo "<script>alert(\" Checked In Successful. But Insert Points History Fail\");
        window.location.href='../rewards.php';</script>";
    }
} else {
    echo "<script>alert(\" Checked In Fail. Please try Again\");
    window.location.href='../rewards.php';</script>";
}
