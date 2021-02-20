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
        <h1 class="page-title">Shipping & Delivery</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Shipping & Delivery</span></li>
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
                    <h3 class="title">Shipping & Delivery</h3>


                    <div class="sm-margin-top-40px xs-margin-top-40px">
                        <button class="accordion">1. Is Delivery available for all products?</button>
                        <div class="panel">
                        <p>Yes</p>
                        </div>

                        <button class="accordion">2. When I will receive my order?</button>
                        <div class="panel">
                        <p>4 -7 days for West Malaysia, 12-15 Days for East Malaysia</p>
                        </div>

                        <button class="accordion">3. My order is delayed, when will I receive it?</button>
                        <div class="panel">
                        <p>Yes, sometime is logistic issues. Recommended always track your order by using our tracking online services: <a href="https://www.tracking.my/">https://www.tracking.my/</a></p>
                        </div>

                        <button class="accordion">4. What can i do if I have placed an order with the wrong shipping address?</button>
                        <div class="panel">
                        <p>You need to inform our customer service or call our support number:  016-2184993 Or email us: <a href="mailto:sales.caroma@gmail.com">sales.caroma@gmail.com</a></p>
                        </div>

                        <button class="accordion">5. Can I schedule the delivery based on my availability to receive the item?</button>
                        <div class="panel">
                        <p>Yes, need to inform us as soon as possible after the order made. So that we can courier out based on your order date</p>
                        </div>

                        <button class="accordion">6. How can I know if an item can be delivered to my area?</button>
                        <div class="panel">
                        <p>We have so many courier service like DHL, J&T, Citilink and post laju. So we will choose base on the availably area by using different kind of courier services. </p>
                        </div>

                        <button class="accordion">7. Is Express Delivery available for all products?</button>
                        <div class="panel">
                        <p>4 -7 days for West Malaysia, 12-15 Days for East Malaysia</p>
                        </div>

                        <button class="accordion">8. Why do some products take longer shipping time?</button>
                        <div class="panel">
                        <p>This one we cannot prevention. Sometimes is depending on the logistic services and their heavy duty working schedule.</p>
                        </div>

                        <button class="accordion">9. How can I change the shipping address of my order?</button>
                        <div class="panel">
                        <p>You need immediately inform our customer service or call our support number:  016-2184993 Or email us: <a href="mailto:sales.caroma@gmail.com">sales.caroma@gmail.com</a> </p>
                        </div>

                        <button class="accordion">10. Do you deliver during weekends and holidays?</button>
                        <div class="panel">
                        <p>Yes, we working and ship out every day from Monday to Saturday ( half day)  except Public holiday and Sunday.  So if your order is fall on Sunday or public holiday, we will ship out on next working day. So you can make order any times and anywhere. </p>
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

    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
        } 
    });
    }
    </script>


</body>

</html>