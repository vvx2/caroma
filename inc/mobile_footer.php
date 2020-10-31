<!--Footer For Mobile-->
<div class="mobile-footer">
    <div class="mobile-footer-inner">
        <div class="mobile-block block-menu-main">
            <a class="menu-bar menu-toggle btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
                <span class="text">Menu</span>
            </a>
        </div>
        <div class="mobile-block block-sidebar">
            <a class="menu-bar filter-toggle btn-toggle" data-object="open-mobile-filter" href="javascript:void(0)">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="text">Sidebar</span>
            </a>
        </div>
        <div class="mobile-block block-minicart">
            <a class="link-to-cart" href="shopping-cart.php">
                <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                <span class="text">Cart</span>
            </a>
        </div>
        <div class="mobile-block block-global">
            <a class="menu-bar myaccount-toggle btn-toggle" data-object="global-panel-opened" href="javascript:void(0)">
                <span class="fa fa-globe"></span>
                <span class="text">Global</span>
            </a>
        </div>
    </div>
</div>

<div class="mobile-block-global">
    <div class="biolife-mobile-panels">
        <span class="biolife-current-panel-title">Global</span>
        <a class="biolife-close-btn" data-object="global-panel-opened" href="#">&times;</a>
    </div>
    <div class="block-global-contain">
        <div class="glb-item my-account">
            <b class="title">My Account</b>
            <ul class="list">
                <?php
                if ($login == 1) {
                ?>
                    <li class="list-item"><a href="login.php">User's Name</a></li>
                <?php
                } else {
                ?>
                    <li class="list-item"><a href="login.php">Login/register</a></li>
                <?php
                }
                ?>
                <li class="list-item"><a href="checkout.php">Checkout</a></li>
                <li class="list-item"><a href="rewards.php">Rewards</a></li>
                <?php
                if ($login == 1) {
                ?>
                    <li class="list-item"><a href="api/logout.php">Logout</a></li>
                <?php } ?>

            </ul>
        </div>
        <div class="glb-item languages">
            <b class="title">Language</b>
            <ul class="list inline">
                <li class="list-item"><a href="#"><img class="flag-imgs" src="assets/images/languages/malaysia-flag-icon-32.png" alt="flag"></a></li>
                <li class="list-item"><a href="#"><img class="flag-imgs" src="assets/images/languages/united-states-of-america-flag-icon-32.png" alt="flag"></a></li>
                <li class="list-item"><a href="#"><img class="flag-imgs" src="assets/images/languages/china-flag-icon-32.png" alt="flag"></a></li>
            </ul>
        </div>
    </div>
</div>