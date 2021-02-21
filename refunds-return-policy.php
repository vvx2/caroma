<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <?php
    // require_once('administrator/connection/PDO_db_function.php');
    // $db = new DB_FUNCTIONS();
    require_once('inc/init.php');
    require_once('inc/head.php');
    ?>
</head>

<body class="biolife-body">

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-02">
        <div class="header-top bg-main hidden-xs">
            <?php
            require_once('inc/header.php');
            ?>
        </div>
        <div class="header-middle biolife-sticky-object ">
            <div class="container">
                <?php
                require_once('inc/top_nav.php');
                ?>
            </div>
        </div>
    </header>

    <!--Hero Section-->
    <div class="hero-section hero-background">
        <h1 class="page-title">Refunds & Return Policy</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Refunds & Return Policy</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain about-us">

        <!-- Main content -->
        <div id="main-content" class="main-content">
             <!-- Block 09: Instagram-->
            <div class="biolife-instagram-block">
                <div class="wrap-title xs-margin-bottom-60px-im sm-margin-bottom-35-im container">
                    <i class="subtitle hidden-xs">CAROMA MALAYSIA</i>
                    <h3 class="title">Refunds & Return Policy</h3>
                    <div class="content-margin" style="text-align:left">
                        <div>
                            <h4><u><b>There is no return or cancellation or refund once the product is out for delivery expected:</b></u></h4>
                            <h4><u><b>1. A. Application for the Return of an Item</b></u></h4>
                            <p class="text-info text-infos">Buyer may only apply for the refund and/or return of the Item in the following circumstances:</p>
                            <ul>
                                <li>The Item has not been received by Buyer;</li>
                                <li>The Item received is incomplete (missing quantity or accessories);</li>
                                <li>Seller has delivered an Item that does not match the agreed specification (e.g. wrong size, colour, etc.) to Buyer;</li>
                                <li>The Item delivered to Buyer is materially different from the description provided by Seller in the listing of the Item; </li>
                                <li>The Item received has physical damage (e.g. dented, scratched, shattered);</li>
                                <li>Buyer’s application must be submitted via the Caroma E-commerce website. <a href="http://shop.caroma.com.my">http://shop.caroma.com.my</a></li>
                                <ol>    
                                    <li><b><u>B. Application for the Cancel of an Item:</b></u></li>
                                    <ul>
                                        <li>You have not made full payment to your order</li>
                                        <li>The seller has not shipped out the order (The order does not have any tracking status updated yet).</li>
                                        <li>You have not requested for cancellation for this order before this. (You are allowed to request for cancellation once only per order. The order will resume shipping process if you have previously withdrawn your cancellation request).</li>
                                    </ul>
                                </ol>
                                
                            </ul>
                        </div>

                        <div>
                            <h4><u><b>2. Condition of Returning Item</b></u></h4>
                            <p class="text-info text-infos">To enjoy a hassle-free experience when returning the Item, Buyer should ensure that the Item, including any complimentary items such as accessories that come with the Item, must be returned to Seller in the condition received by Buyer on delivery. <I>We will recommend Buyer to take a photo of the Item upon receipt.</i></p>
                        </div>

                        <div>
                            <h4><u><b>3. Liability of Return Shipping Fee</b></u></h4>
                            <ol type="I">
                                <li>In the scenario of an unforeseen error from the seller's end (i.e - damaged, faulty or wrong Item delivered to the buyer), the seller will bear buyer's return shipping fee.</li>
                                <li>In the scenario of the buyer's change of mind, buyer shall get seller's consent prior to the return request and buyer will bear the return shipping fee.</li>
                            </ol>
                        </div>

                        <div>
                            <h4><u><b>4. Refund</b></u></h4>
                            <p class="text-info text-infos">Buyer will only be refunded after Caroma has received the confirmation from Seller that Seller has received the returned Item. The refund will be made to Buyer’s credit/debit card or designated bank account, whichever is applicable.</p>
                        </div>

                        <div>
                            <h4><u><b>5. Communication Between Buyer and Seller</b></u></h4>
                            <p class="text-info text-infos">Caroma encourages Users to communicate with each other in the event where problem arises in a transaction. As Caroma is a platform for Users to conduct trading, Buyer should contact Seller directly for any issue relating to the Item purchased.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
    require_once('inc/footer.php');
    require_once('inc/mobile_footer.php');
    ?>

    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <script src="assets/js/jquery-3.4.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/jquery.nicescroll.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <script src="assets/js/biolife.framework.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="cart.js"></script>
    <script>
        $(document).ready(function() {
            LoadCart();
        });
    </script>
</body>

</html>