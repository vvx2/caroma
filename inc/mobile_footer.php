<!--Footer For Mobile-->
<div class="mobile-footer">
    <div class="mobile-footer-inner">
        <div class="mobile-block block-menu-main" style="width: 25%;">
            <a class="menu-bar menu-toggle btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
                <span class="text"><?php echo $lang['lang-menu']; ?></span>
            </a>
        </div>
        <div class="mobile-block block-sidebar" style="width: 25%;">
            <a class="menu-bar filter-toggle btn-toggle" data-object="open-mobile-filter" href="javascript:void(0)">
                <i class="fa fa-sliders" aria-hidden="true"></i>
                <span class="text"><?php echo $lang['lang-sidebar']; ?></span>
            </a>
        </div>
        <div class="mobile-block block-minicart" style="width: 25%;">
            <a class="link-to-cart" href="shopping-cart.php">
                <span class="fa fa-shopping-bag" aria-hidden="true"></span>
                <span class="text"><?php echo $lang['lang-mobile_cart']; ?></span>
            </a>
        </div>
        <div class="mobile-block block-minicart" style="width: 25%;">
            <a class="link-to-cart" href="">
                <span class="fa fa-heart" aria-hidden="true"></span>
                <span class="text"><?php echo $lang['lang-wishlist']; ?></span>
            </a>
        </div>
        <div class="mobile-block block-global" style="width: 25%;">
            <a class="menu-bar myaccount-toggle btn-toggle" data-object="global-panel-opened" href="javascript:void(0)">
                <span class="fa fa-user-circle"></span>
                <span class="text"><?php echo $lang['lang-mobile_my_account']; ?></span>
            </a>
        </div>
    </div>
</div>

<div class="mobile-block-global">
    <div class="biolife-mobile-panels">
        <span class="biolife-current-panel-title"><?php echo $lang['lang-mobile_caroma']; ?></span>
        <a class="biolife-close-btn" data-object="global-panel-opened" href="#">&times;</a>
    </div>
    <div class="block-global-contain">
        <div class="glb-item my-account">
            <b class="title"><?php echo $lang['lang-mobile_my_account']; ?></b>
            <ul class="list">
                <?php
                if ($login == 1) {
                    $user_name = $db->where("name", "users", "id", $user_id);
                    $user_name = $user_name[0]['name'];
                ?>
                    <li class="list-item"><a href="my-account/index.php"><?php echo $user_name ?></a></li>
                <?php
                } else {
                ?>
                    <li class="list-item"><a href="login.php"><?php echo $lang['lang-mobile_login_register']; ?></a></li>
                <?php
                }
                ?>
                <li class="list-item"><a href="checkout.php"><?php echo $lang['lang-mobile_checkout']; ?></a></li>
                <li class="list-item"><a href="rewards.php"><?php echo $lang['lang-mobile_reward']; ?></a></li>
                <?php
                if ($login == 1) {
                ?>
                    <li class="list-item"><a href="api/logout.php"><?php echo $lang['lang-mobile_logout']; ?></a></li>
                <?php } ?>

            </ul>
        </div>
        <div class="glb-item languages">
            <b class="title"><?php echo $lang['lang-mobile_language']; ?></b>
            <ul class="list inline">
                <select name="change_language">
                    <option value="en" style="width: 100%;" <?php echo ($_SESSION['language'] == "en") ? "selected" : "" ?>>&nbsp;</option>
                    <option value="my" style="width: 100%;" <?php echo ($_SESSION['language'] == "my") ? "selected" : "" ?>>&nbsp;</option>
                    <option value="cn" style="width: 100%;" <?php echo ($_SESSION['language'] == "cn") ? "selected" : "" ?>>&nbsp;</option>
                </select>
            </ul>
        </div>
    </div>
</div>

<style>
li.option {
    width : 100%;
    padding: 0px 15px !important;
}
</style>