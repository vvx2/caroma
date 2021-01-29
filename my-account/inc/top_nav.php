<?php
require_once('inc/init.php');
if ($login != 1) {
	echo "<script>window.location.replace('../login.php')</script>";
	exit();
}
if ($user_type == 2) {
	$tb = "users u left join user_address ua on u.id = ua.user_id left join user_distributor ud on u.id = ud.user_id";
	$col = "u.name as name,u.type as user_type,u.image as image, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state, ud.distributor_code as distributor_code";
} else if ($user_type == 3) { // ud = user_dealer, du = distributr's users table
	$tb = "users u left join user_address ua on u.id = ua.user_id left join user_dealer ud on u.id = ud.user_id left join users du on ud.under_distributor = du.id left join user_distributor dis on ud.under_distributor = dis.user_id left join user_address dis_add on ud.under_distributor = dis_add.user_id";
	$col = "u.name as name,u.type as user_type,u.image as image, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state, du.name as distributor_name, dis.distributor_code as distributor_code, dis_add.contact as distributor_contact";
} else {
	$tb = "users u left join user_address ua on u.id = ua.user_id";
	$col = "u.name as name,u.type as user_type,u.image as image, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state";
}
$opt = 'u.id = ?';
$arr = array($user_id);
$result_user = $db->advwhere($col, $tb, $opt, $arr);
$result_user = $result_user[0];

$user_img = $result_user['image'];
$user_type_display = "";
if ($result_user['user_type'] == 1) {
	$user_type_display = "NORMAL USER";
} else if ($result_user['user_type'] == 2) {
	$user_type_display = "DISTRIBUTOR";
} else if ($result_user['user_type'] == 3) {
	$user_type_display = "DEALER";
}

if ($user_img != "" || $user_img != NULL) {
	$image_path = "../img/profile/" . $user_img;
} else {
	$image_path = "dist/img/user1.png";
}

$user_order = $db->where("id", "orders", "users_id", $user_id);
$user_cart = $db->where("id", "cart", "customer_id", $user_id);

$count_user_order = count($user_order);
$count_cart = count($user_cart);
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block mr-20 pull-left" href="javascript:void(0);"><i class="fa fa-bars" style="color : white;"></i></a>
    <a href="index.php"><img width="200px" class="brand-img pull-left" src="dist/img/logo.svg" alt="brand" /></a>
    <ul class="nav navbar-right top-nav pull-right">
        <li style="padding-top:20%;">
            <small style="color : white ;">Hi, <?php echo $result_user['name']; ?></small>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="<?php echo $image_path; ?>" alt="user" class="user-auth-img img-circle" /><span class="user-online-status"></span></a>
            <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                <li>
                    <a href="profile.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../api/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>