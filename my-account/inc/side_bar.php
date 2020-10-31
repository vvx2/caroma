<?php
$onpage = $user_type;
if ($onpage == "1") {
?>
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li>
                <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><i class="icon-home mr-10"></i>Dashboard <span class="pull-right"><span class="label label-success mr-10">4</span><i class="fa fa-fw fa-angle-down"></i></span></a>
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
                <a href="../shop.php" target="_blank"><i class="fa fa-gift mr-10"></i>Shopping <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shopping-cart.php" target="_blank"><i class="icon-basket-loaded mr-10"></i>Your Cart <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../index.php" target="_blank"><i class="fa fa-leaf mr-10"></i>Caroma Home <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../api/logout.php"><i class="fa fa-sign-out mr-10"></i>Logout <span class="pull-right"></span></a>
            </li>
        </ul>
    </div>

<?php
} else if ($onpage == "2") {
?>
    <div class="fixed-sidebar-left">
        <ul class="nav navbar-nav side-nav nicescroll-bar">
            <li>
                <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><i class="icon-home mr-10"></i>Dashboard <span class="pull-right"><span class="label label-success mr-10">4</span><i class="fa fa-fw fa-angle-down"></i></span></a>
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
                <a href="../shop.php" target="_blank"><i class="fa fa-gift mr-10"></i>Shopping <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shopping-cart.php" target="_blank"><i class="icon-basket-loaded mr-10"></i>Your Cart <span class="pull-right"></span></a>
            </li>
            <li>
                <a class="<?php echo ($PageName == 'e-commerce' || $PageName == 'order-list' || $PageName == 'product') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#ecom_dr"><i class="fa fa-shopping-basket mr-10"></i>My Store<span class="pull-right"><span class="label label-success mr-10">4</span><i class="fa fa-fw fa-angle-down"></i></span></a>
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
                </ul>
            </li>
            <li>
                <a href="../index.php" target="_blank"><i class="fa fa-leaf mr-10"></i>Caroma Home <span class="pull-right"></span></a>
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
                <a class="<?php echo ($PageName == 'index') ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#dashboard_dr"><i class="icon-home mr-10"></i>Dashboard <span class="pull-right"><span class="label label-success mr-10">4</span><i class="fa fa-fw fa-angle-down"></i></span></a>
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
                <a href="../shop.php" target="_blank"><i class="fa fa-gift mr-10"></i>Shopping <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../shopping-cart.php" target="_blank"><i class="icon-basket-loaded mr-10"></i>Your Cart <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../index.php" target="_blank"><i class="fa fa-leaf mr-10"></i>Caroma Home <span class="pull-right"></span></a>
            </li>
            <li>
                <a href="../api/logout.php"><i class="fa fa-sign-out mr-10"></i>Logout <span class="pull-right"></span></a>
            </li>
        </ul>
    </div>
<?php
}
?>