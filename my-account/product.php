<?php
require_once('inc/init.php');
$PageName = "order-list";
if ($login != 1) {
	echo "<script>window.location.replace('../login.php')</script>";
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Kenny I Fast build Admin dashboard for any platform</title>
	<meta name="description" content="Kenny is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Kenny Admin, kennyadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- Morris Charts CSS -->
	<link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css" />

	<!-- Chartist CSS -->
	<link href="vendors/bower_components/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css" />

	<!-- Chartist CSS -->
	<link href="vendors/bower_components/chartist/dist/chartist.min.css" rel="stylesheet" type="text/css" />

	<!-- vector map CSS -->
	<link href="vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css" />

	<!-- Custom Fonts -->
	<link href="dist/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Calendar CSS -->
	<link href="vendors/bower_components/fullcalendar/dist/fullcalendar.css" rel="stylesheet" type="text/css" />

	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">

</head>

<body>
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->
	<div class="wrapper">

		<!-- Top Menu Items -->
		<?php require_once('inc/top_nav.php'); ?>
		<!-- /Top Menu Items -->

		<!-- Left Sidebar Menu -->
		<?php require_once('inc/side_bar.php'); ?>
		<!-- /Left Sidebar Menu -->

		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				<!-- Title -->
				<div class="row heading-bg bg-pink">
					<div class="col-lg-10 col-md-4 col-sm-4 col-xs-6">
						<h5 class="txt-light">products List</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-2 col-sm-8 col-md-8 col-xs-6">
						<div class="row">
							<a href="product-management.php"><button class="btn btn-success btn-anim"><i class="fa fa-pencil-square-o"></i><span class="btn-text">Add New Products</span></button></a>
						</div>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

				<!-- Product Row One -->
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<article class="col-item">
										<div class="photo">
											<div class="options">
												<button class="btn btn-default btn-icon-anim btn-circle mr-5" type="submit"><a href="product-management.php"><i class="icon-pencil"></i></a></button>
											</div>
											<a href="product-management.php"> <img src="dist/img/chair.jpg" class="img-responsive" alt="Product Image" /> </a>
										</div>
										<div class="info text-center">
											<h6>National Fresh Fruit</h6>
											<span class="product-spec capitalize-font block mt-5 mb-5">Ginger Series</span>
											<span class="product-spec capitalize-font block mt-5 mb-5">Published</span>
											<span class="head-font block text-warning">RM188</span>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<article class="col-item">
										<div class="photo">
											<div class="options">
												<button class="btn btn-default btn-icon-anim btn-circle mr-5" type="submit"><a href="product-management.php"><i class="icon-pencil"></i></a></button>
											</div>
											<a href="product-management.php"> <img src="dist/img/chair.jpg" class="img-responsive" alt="Product Image" /> </a>
										</div>
										<div class="info text-center">
											<h6>National Fresh Fruit</h6>
											<span class="product-spec capitalize-font block mt-5 mb-5">Ginger Series</span>
											<span class="product-spec capitalize-font block mt-5 mb-5">Published</span>
											<span class="head-font block text-warning">RM188</span>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<article class="col-item">
										<div class="photo">
											<div class="options">
												<button class="btn btn-default btn-icon-anim btn-circle mr-5" type="submit"><a href="product-management.php"><i class="icon-pencil"></i></a></button>
											</div>
											<a href="product-management.php"> <img src="dist/img/chair.jpg" class="img-responsive" alt="Product Image" /> </a>
										</div>
										<div class="info text-center">
											<h6>National Fresh Fruit</h6>
											<span class="product-spec capitalize-font block mt-5 mb-5">Ginger Series</span>
											<span class="product-spec capitalize-font block mt-5 mb-5">Published</span>
											<span class="head-font block text-warning">RM188</span>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<article class="col-item">
										<div class="photo">
											<div class="options">
												<button class="btn btn-default btn-icon-anim btn-circle mr-5" type="submit"><a href="product-management.php"><i class="icon-pencil"></i></a></button>
											</div>
											<a href="product-management.php"> <img src="dist/img/chair.jpg" class="img-responsive" alt="Product Image" /> </a>
										</div>
										<div class="info text-center">
											<h6>National Fresh Fruit</h6>
											<span class="product-spec capitalize-font block mt-5 mb-5">Ginger Series</span>
											<span class="product-spec capitalize-font block mt-5 mb-5">Published</span>
											<span class="head-font block text-warning">RM188</span>
										</div>
									</article>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<?php require_once('inc/footer.php'); ?>
			</footer>
			<!-- /Footer -->
		</div>
		<!-- /Main Content -->

	</div>
	<!-- /#wrapper -->

	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>

</body>

</html>