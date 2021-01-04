<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6 des-logo">
        <a href="index.php" class="biolife-logo bio-2-des"><img class="logo-center" src="assets/images/caroma-logo.png" alt="biolife logo" ></a>
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
                <li class="menu-item"><a href="index.php">Home</a></li>
                <li class="menu-item"><a href="shop.php" class="menu-name" data-title="Shop">Shop</a></li>
                <li class="menu-item"><a href="index.php">Promotion</a></li>
            </ul>
        </div>
            <div class="login-item">
                <a href="rewards.php" class="login-link"><i class="biolife-icon icon-title"></i>Rewards</a>
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
                    <a href="login.php" class="login-link"><i class="biolife-icon icon-login"></i>Login/Register</a>
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
                        <span class="title">My Cart -</span>
                        <span class="sub-total">RM 0.00</span>
                    </a>
                    <div class="cart-content">
                        <div class="cart-inner">
                            <ul class="products cart_product">

                            </ul>
                            <p class="btn-control cart_button">
                                <button class="btn view-cart" onclick="location.href='shopping-cart.php';">view cart</button>
                                <button class="btn cart_checkout" onclick="location.href='checkout.php';">checkout</button>
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
<input type="hidden" id="token" value="<?php echo $token; ?>" />