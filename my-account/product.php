<?php
require_once('inc/init.php');
$PageName = "order-list";
if ($login != 1) {
	echo "<script>window.location.replace('../login.php')</script>";
	exit();
}
if($user_type != 2){
	echo "<script>alert(\" Your are not Distributor\");
	window.location.href='index.php';</script>";
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
				<div class="row heading-bg bg-grey">
					<div class="col-lg-10 col-md-4 col-sm-4 col-xs-6">
						<h5 class="txt-light">products List</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-2 col-sm-8 col-md-8 col-xs-6">
						<div class="row">
							<a href="product-management.php"><button class="btn btn-success btn-anim"><i class="fa fa-pencil-square-o"></i><span class="btn-text btn-textt">Add New Products</span></button></a>
						</div>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

				<!-- Product Row One -->
				<div class="row">
					<?php
					$col = "*,dp.id as dp_id, dp.stock as dp_stock,dp.status as dp_status, p.id as p_id, pt.name as pt_name, pt.description as pt_description, ct.name as ct_name";
					$tb = "distributor_product dp left join product p on dp.product_id = p.id left join product_translation pt on p.id = pt.product_id left join product_role_price pp on p.id = pp.product_id left join category_translation ct on p.category = ct.category_id";
					$opt = 'dp.user_id =? && pt.language = ? && pp.type =? && ct.language =? ORDER BY p.date_modified DESC';
					$arr = array($user_id, $language, 3, $language);
					$distributor_product = $db->advwhere($col, $tb, $opt, $arr);

					if (count($distributor_product) == 0) {
						echo "No Product. Please Add product";
					}

					foreach ($distributor_product as $product) {

					?>
						<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
							<div class="panel panel-default card-view pa-0">
								<div class="panel-wrapper collapse in">
									<div class="panel-body pa-0">
										<article class="col-item">
											<div class="photo">
												<div class="options">
													<button class="btn btn-default btn-icon-anim btn-circle mr-5" type="submit"><a href="product-management.php"><i class="icon-pencil"></i></a></button>
												</div>
												<a href="product-edit.php?p=<?php echo $product['p_id']; ?>"> <img src="../img/product/<?php echo $product['image']; ?>" class="img-responsive" alt="Product Image" /> </a>
											</div>
											<div class="info text-center">
												<h5><?php echo $product['pt_name']; ?></h5>
												<span class="product-spec capitalize-font block mt-5 mb-5"><?php echo $product['ct_name']; ?></span>
												<span class="product-spec capitalize-font block mt-5 mb-5 <?php echo ($product['dp_status'] == 1) ? "text-success" : "text-danger"; ?>"><strong><?php echo ($product['dp_status'] == 1) ? "Activate" : "Deactivate"; ?></strong></span>
												<span class="head-font block text-warning "><strong>RM<?php echo number_format($product['price'], 2); ?></strong></span>
												<span class="head-font block text-dark "><strong>Stock: <?php echo $product['dp_stock']; ?></strong></span>
											</div>
										</article>
									</div>
								</div>
							</div>
						</div>

					<?php } ?>
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