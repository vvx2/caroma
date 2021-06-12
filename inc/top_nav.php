<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 des-logo">
        <a href="index.php" class="biolife-logo bio-2-des"><img class="logo-center" src="assets/images/logo.svg" width="100%" alt="biolife logo" ></a>
    </div>
    <!--- <div class="col-lg-5 col-md-6 hidden-lg hidden-md hidden-sm hidden-xs">
        <div class="primary-menu">
            <ul class="menu biolife-menu clone-main-menu clone-primary-menu">
                <li class="menu-item"><a href="index.php">Home</a></li>
                <li class="menu-item"><a href="shop.php" class="menu-name" data-title="Shop">Shop<div class="sup-item"><span class="lbl new">New</span></div></a></li>
                <li class="menu-item"><a href="about-us.php">About Us</a></li>
                <li class="menu-item"><a href="news.php">Promotion</a></li>
                <li class="menu-item"><a href="contact-us.php">Contact Us</a></li>
            </ul>
        </div>
    </div> --->
    
    <div class="col-lg-10 col-md-10 col-sm-6 col-xs-6">
        <div class="biolife-cart-info">
        <div class="primary-menu hidden-sm hidden-xs">
            <ul class="menu biolife-menu clone-main-menu clone-primary-menu">
            <li class="menu-item"><a href="https://caroma.com.my"><?php echo $lang['lang-caroma_home']; ?></a></li>
                <li class="menu-item"><a href="index.php"><?php echo $lang['lang-shop_home']; ?></a></li>
                <li class="menu-item"><a href="shop.php" class="menu-name" data-title="Shop"><?php echo $lang['lang-shop']; ?></a></li>
                <li class="menu-item"><a href="https://caroma-store.com"><?php echo $lang['lang-caroma_mart']; ?></a></li>
                <!-- <li class="menu-item"><a href="shop.php?is_promotion=1"><?php echo $lang['lang-promotion']; ?></a></li> -->
            </ul>
        </div>
            <div class="login-item">
                <a href="rewards.php" class="login-link"><i class="biolife-icon icon-title"></i><?php echo $lang['lang-reward']; ?></a>
            </div>
            <div class="login-item">
                <?php
                if ($login == 1) {
                    $user_name = $db->where("name", "users", "id", $user_id);
                    $user_name = $user_name[0]['name'];
                ?>
                    <a href="my-account/index.php" class="login-link"><i class="biolife-icon icon-login"></i><?php echo $user_name ?></a>
                <?php
                } else {
                ?>
                    <a href="login.php" class="login-link"><i class="biolife-icon icon-login"></i><?php echo $lang['lang-login_register']; ?></a>
                <?php
                }
                ?>
            </div>
            <div class="minicart-block">
                <div class="minicart-contain">
                    <a href="javascript:void(0)" class="link-to">
                        <span class="icon-qty-combine">
                            <i class="icon-cart-mini biolife-icon"></i>
                            <span class="qty number_cart">8</span>
                        </span>
                        <span class="title"><?php echo $lang['lang-my_cart']; ?> - </span>
                        <span class="sub-total">RM 0.00</span>
                    </a>
                    <div class="cart-content">
                        <div class="cart-inner">
                            <ul class="products cart_product">

                            </ul>
                            <p class="btn-control cart_button">
                                <button class="btn view-cart" onclick="location.href='shopping-cart.php';"><?php echo $lang['lang-view_cart']; ?></button>
                                <?php if ($login == 1) { ?>
                                <button class="btn cart_checkout" onclick="location.href='checkout.php';"><?php echo $lang['lang-check_out']; ?></button>
                                <?php } else { ?>
                                <button class="btn" data-toggle="modal" data-target="#exampleModalCenter"><?php echo $lang['lang-check_out']; ?></button>
                                <?php }  ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-toggle">
                <a class="btn-toggle" data-object="open-mobile-menu" href="javascript:void(0)">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="exampleModalCenter" style="z-index:2000" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3><?php echo $lang['lang-member_registration']; ?></h3>
                    </button>
                </div>
                <div class="modal-body">
                    <div><?php echo $lang['lang-a_member_account']; ?><br>
                        <span style="font-weight : bold ; color:red;"><?php echo $lang['lang-do_you_want_to']; ?></span>
                    </div>
                </div>
                <div class="modal-footer" style="text-align : center ;">
                    <!--- <button type="button" class="btn custombtn" data-dismiss="modal"><?php echo $lang['lang-close']; ?></button> --->
                    <a class="btn custombtn" href="login.php"><?php echo $lang['lang-sign_in']; ?></a>
                    <a class="btn custombtn" href="register.php"><?php echo $lang['lang-register_now']; ?></a>
                </div>
            </div>
        </div>
    </div>

<input type="hidden" id="token" value="<?php echo $token; ?>" />