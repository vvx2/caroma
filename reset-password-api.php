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

    <!-- Preloader -->
    <div id="biof-loading">
        <div class="biof-loading-center">
            <div class="biof-loading-center-absolute">
                <div class="dot dot-one"></div>
                <div class="dot dot-two"></div>
                <div class="dot dot-three"></div>
            </div>
        </div>
    </div>

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
        <h1 class="page-title">Forgot Password</h1>
    </div>

    <!--Navigation section-->
    <div class="container">
        <nav class="biolife-nav">
            <ul>
                <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                <li class="nav-item"><span class="current-page">Forgot Password</span></li>
            </ul>
        </nav>
    </div>

    <div class="page-contain login-page">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container-fluid">
            <div class="container" style="margin-bottom : 5% ; padding : 0px 30px ;">
	<div class="row">
		<div class="row">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
    
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                          <h3><i class="glyphicon glyphicon-envelope color-blue" style="font-size:300%;"></i></h3>
                          <h2 class="text-center">Password Reset</h2>
                            <div class="panel-body">
                              
                              <form class="form">
                                <fieldset>
                                 
                                      
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="form-group pass_show"> 
                                        <input type="password" value="faisal.khan@123" class="form-control" placeholder="New Password"> 
                                    </div> 
                                    <label>Confirm Password</label>
                                    <div class="form-group pass_show"> 
                                        <input type="password" value="faisal.khan@123" class="form-control" placeholder="Confirm Password"> 
                                    </div> 
                                </div>

                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>

                                </fieldset>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="assets/js/register_validation.js"></script>
    <script src="assets/js/numberic.js"></script>
    <script src="assets/js/reset.js"></script>
    <script src="cart.js"></script>
    <script>
        $(document).ready(function() {
            LoadCart();
        });
    </script>
</body>

</html>