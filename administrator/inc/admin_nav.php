<?php

$user = $db->where('*', 'admin', 'user_id', $_SESSION['id']);
$user = $user[0];

$onpage = $user['user_type'];

if ($onpage == "1") {
	$adminopen = "";
	$adminclose = "";

	$supervisoropen = "<!--";
	$supervisorclose = "-->";
} else if ($onpage == "2") {
	$adminopen = "<!--";
	$adminclose = "-->";

	$supervisoropen = "";
	$supervisorclose = "";
}

if (isset($pagetype)) {
	$pagetype = $pagetype;
} else {
	$pagetype = 0;
}

if (isset($refund_type)) {
	$refund_type = $refund_type;
} else {
	$refund_type = 0;
}
?>

<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header">
				<div class="dropdown profile-element">
					<img alt="image" class="rounded-circle" src="img/userprofile/admin.svg" style="width:48px;height:48px;" />

					<span class="block m-t-xs font-bold"></span>
					<span class="text-muted text-xs block h6"><?php echo $user['user_nickname']; ?></span>
				</div>
				<div class="logo-element">
					Admin
				</div>
			</li>

			<!--  Navigation bar START here  -->
			<?php echo $adminopen ?>
			<li class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>">
				<a href="index.php"><i class="fa fa-th-large-no">DB</i> <span class="nav-label">Dashboard</span></a>
			</li>

			<li class="<?php echo ($PageName == 'product') ? 'active' : ''; ?>">
				<a href="product.php"><i class="fa fa-th-large-no">Pdt</i> <span class="nav-label">Product</span></a>
			</li>
			<li class="<?php echo ($PageName == 'stock') ? 'active' : ''; ?>">
				<a href="stock.php"><i class="fa fa-th-large-no">Stk</i> <span class="nav-label">Replenish Stock</span></a>
			</li>

			<li class="<?php echo ($PageName == 'category') ? 'active' : ''; ?>">
				<a href="category.php"><i class="fa fa-th-large-no">Ctg</i> <span class="nav-label">Category</span></a>
			</li>
			<li class="<?php echo ($PageName == 'coupon') ? 'active' : ''; ?>">
				<a href="coupon.php"><i class="fa fa-th-large-no">Cpn</i> <span class="nav-label">Coupon / Voucher</span></a>
			</li>
			<li class="<?php echo ($PageName == 'promotion') ? 'active' : ''; ?>">
				<a href="promotion.php"><i class="fa fa-th-large-no">Prm</i> <span class="nav-label">Product Promotion</span></a>
			</li>
			<li class="<?php echo ($PageName == 'new_arrival') ? 'active' : ''; ?>">
				<a href="new_arrival.php"><i class="fa fa-th-large-no">New</i> <span class="nav-label">New Arrival</span></a>
			</li>
			<li class="<?php echo ($PageName == 'user' || $PageName == 'distributor' || $PageName == 'dealer') ? 'active' : ''; ?>">
				<a href=""><i class="fa fa-th-large-no">Usr</i> <span class="nav-label">Users</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($PageName == 'user') ? 'active' : ''; ?>"><a href="user.php">Normal User</a></li>
					<li class="<?php echo ($PageName == 'distributor') ? 'active' : ''; ?>"><a href="distributor.php">Distributor</a></li>
					<li class="<?php echo ($PageName == 'dealer') ? 'active' : ''; ?>"><a href="dealer.php">Dealer</a></li>
				</ul>
			</li>
			<li class="<?php echo ($PageName == 'order') ? 'active' : ''; ?>">
				<a href=""><i class="fa fa-th-large-no">Ord</i> <span class="nav-label">Order</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($pagetype == '2') ? 'active' : ''; ?>"><a href="order.php?page=2">Pending Order</a></li>
					<li class="<?php echo ($pagetype == '3') ? 'active' : ''; ?>"><a href="order.php?page=3">Shipping Order</a></li>
					<li class="<?php echo ($pagetype == '4') ? 'active' : ''; ?>"><a href="order.php?page=4">Completed Order</a></li>
					<li class="<?php echo ($pagetype == '1') ? 'active' : ''; ?>"><a href="order.php?page=1">Reject/Failed Order</a></li>
					<li class="<?php echo ($pagetype == '5') ? 'active' : ''; ?>"><a href="order.php?page=5">To Cancel</a></li>
				</ul>
			</li>
			<li class="<?php echo ($PageName == 'refund') ? 'active' : ''; ?>">
				<a href=""><i class="fa fa-th-large-no">Wid</i> <span class="nav-label">Withdrawal</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($refund_type == '1') ? 'active' : ''; ?>"><a href="refund.php?page=1">Pending Withdraw</a></li>
					<li class="<?php echo ($refund_type == '2') ? 'active' : ''; ?>"><a href="refund.php?page=2">Success Withdraw</a></li>
					<li class="<?php echo ($refund_type == '3') ? 'active' : ''; ?>"><a href="refund.php?page=3">Rejected Withdraw</a></li>
				</ul>
			</li>
			<li class="<?php echo ($PageName == 'shipping' || $PageName == 'geo_zone') ? 'active' : ''; ?>">
				<a href=""><i class="fa fa-th-large-no">Shi</i> <span class="nav-label">Shipping</span> <span class="fa arrow"></span></a>
				<ul class="nav nav-second-level">
					<li class="<?php echo ($PageName == 'shipping') ? 'active' : ''; ?>"><a href="shipping.php">Shipping</a></li>
					<li class="<?php echo ($PageName == 'geo_zone') ? 'active' : ''; ?>"><a href="geo_zone.php">Geo Zone</a></li>
				</ul>
			</li>
			<li class="<?php echo ($PageName == 'reset_password') ? 'active' : ''; ?>">
				<a href="reset_password.php"><i class="fa fa-th-large-no">RsP</i> <span class="nav-label">Reset Password</span></a>
			</li>
			<?php echo $adminclose ?>
			<!--  Navigation bar END here  -->


		</ul>

	</div>
</nav>