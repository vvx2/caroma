<?php
$onpage = $user_type;

$col = "id";
$tb = "orders";
$opt = 'users_id = ? && status =?';
$arr = array($user_id, 2);
$count_order = $db->advwhere($col, $tb, $opt, $arr);
$number_order_pending = count($count_order);

if ($onpage == "1") {
?>
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li>
                <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><i class="icon-home mr-10"></i>Dashboard <span class="pull-right"><span class="label label-success mr-10"><?php echo $number_order_pending ?></span><i class="fa fa-fw fa-angle-down"></i></span></a>
                <ul id="dashboard_dr" class="collapse collapse-level-1">
                    <li>
                        <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="index.php">My Purchase</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="<?php echo ($PageName == 'profile') ? 'active' : ''; ?>" href="profile.php"><i class="fa fa-user mr-10"></i>Profile <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shop.php"><i class="fa fa-gift mr-10"></i>Shopping <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shopping-cart.php"><i class="icon-basket-loaded mr-10"></i>Your Cart <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../index.php"><i class="fa fa-leaf mr-10"></i>Shop Home <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="https://staging2.caroma.com.my"><i class="fa fa-home mr-10"></i>Caroma Home <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../rewards.php"><i class="fa fa-money mr-10"></i>My Caroma Coin <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../api/logout.php"><i class="fa fa-sign-out mr-10"></i>Logout <span class="pull-right"></span></a>
            </li>
        </ul>
    </div>

<?php
} else if ($onpage == "2") {
    $col = "id";
    $tb = "orders";
    $opt = 'admin_id = ? && status =?';
    $arr = array($user_id, 2);
    $dis_count_order = $db->advwhere($col, $tb, $opt, $arr);
    $number_dis_order_pending = count($dis_count_order);
?>
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li>
                <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><i class="icon-home mr-10"></i>Dashboard <span class="pull-right"><span class="label label-success mr-10"><?php echo $number_order_pending ?></span><i class="fa fa-fw fa-angle-down"></i></span></a>
                <ul id="dashboard_dr" class="collapse collapse-level-1">
                    <li>
                        <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="index.php">My Purchase</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="<?php echo ($PageName == 'profile') ? 'active' : ''; ?>" href="profile.php"><i class="fa fa-user mr-10"></i>Profile <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shop.php"><i class="fa fa-gift mr-10"></i>Shopping <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shopping-cart.php"><i class="icon-basket-loaded mr-10"></i>Your Cart <span class="pull-right"></span></a>
            </li>
            <li>
                <a class="<?php echo ($PageName == 'e-commerce' || $PageName == 'order-list' || $PageName == 'product' || $PageName == 'wallet' || $PageName == 'wallet_history') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><i class="fa fa-shopping-basket mr-10"></i>My Store<span class="pull-right"><span class="label label-success mr-10"><?php echo $number_dis_order_pending ?></span><i class="fa fa-fw fa-angle-down"></i></span></a>
                <ul id="ecom_dr" class="collapse collapse-level-1">
                    <li>
                        <a class="<?php echo ($PageName == 'e-commerce') ? 'active' : ''; ?>" href="e-commerce.php">Dashboard</a>
                    </li>
                    <li>
                        <a class="<?php echo ($PageName == 'order-list') ? 'active' : ''; ?>" href="order-list.php">Order Management</a>
                    </li>
                    <li>
                        <a class="<?php echo ($PageName == 'product') ? 'active' : ''; ?>" href="product.php">Products Management</a>
                    </li>
                    <li>
                        <a class="<?php echo ($PageName == 'wallet') ? 'active' : ''; ?>" href="wallet.php">E-Wallet</a>
                    </li>
                    <li>
                        <a class="<?php echo ($PageName == 'shipping') ? 'active' : ''; ?>" href="shipping.php">Shipping</a>
                    </li>
                    <li>
                        <a class="<?php echo ($PageName == 'geo_zone') ? 'active' : ''; ?>" href="geo_zone.php">Geo Zone</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="../index.php"><i class="fa fa-home mr-10"></i>Caroma Home <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../rewards.php"><i class="fa fa-money mr-10"></i>My Caroma Coin <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../api/logout.php"><i class="fa fa-sign-out mr-10"></i>Logout <span class="pull-right"></span></a>
            </li>
        </ul>
    </div>

<?php
} else if ($onpage == "3") {
?>
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li>
                <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><i class="icon-home mr-10"></i>Dashboard <span class="pull-right"><span class="label label-success mr-10"><?php echo $number_order_pending ?></span><i class="fa fa-fw fa-angle-down"></i></span></a>
                <ul id="dashboard_dr" class="collapse collapse-level-1">
                    <li>
                        <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="index.php">My Purchase</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="<?php echo ($PageName == 'profile') ? 'active' : ''; ?>" href="profile.php"><i class="fa fa-user mr-10"></i>Profile <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shop.php" ><i class="fa fa-gift mr-10"></i>Shopping <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shopping-cart.php" ><i class="icon-basket-loaded mr-10"></i>Your Cart <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../index.php" ><i class="fa fa-home mr-10"></i>Caroma Home <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../rewards.php"><i class="fa fa-money mr-10"></i>My Caroma Coin <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../api/logout.php"><i class="fa fa-sign-out mr-10"></i>Logout <span class="pull-right"></span></a>
            </li>
        </ul>
    </div>
<?php
}
?>