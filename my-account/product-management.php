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
	<title>Caroma Malaysia | Member Center</title>
	<meta name="description" content="Kenny is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Kenny Admin, kennyadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework" />
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

	<!-- bootstrap-touchspin CSS -->
	<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Colorpicker CSS -->
	<link href="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />

	<!-- select2 CSS -->
	<link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

	<!-- switchery CSS -->
	<link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-select CSS -->
	<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-tagsinput CSS -->
	<link href="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-touchspin CSS -->
	<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

	<!-- multi-select CSS -->
	<link href="vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Switches CSS -->
	<link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Datetimepicker CSS -->
	<link href="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

	<!-- Custom CSS -->
	<link href="dist/css/custom.css" rel="stylesheet" type="text/css">

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
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-light">Product Management</h5>
					</div>
				</div>
				<!-- /Title -->

				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="form-wrap">
										<form action="#">
											<h6 class="txt-dark capitalize-font"><i class="icon-list mr-10"></i>Product Stock Availability</h6>
											<hr>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Product Name</label>
														<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
															<option value="Product 1">Product 1</option>
															<option value="Product 2">Product 2</option>
															<option value="Product 3">Product 3</option>
															<option value="Product 4">Product 4</option>
														</select>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Quantity </label> <span>[Stock Available : 38]</span>
														<input id="tch3" type="text" value="1" name="tch3" data-bts-button-down-class="btn btn-default" data-bts-button-up-class="btn btn-default">
													</div>
												</div>
												<!--/span-->
											</div>
											<!-- Row -->
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Product Categories</label>
														<input type="text" disabled value="Ginger Series" class="form-control">
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group mb-0">
														<label class="control-label mb-10">Product Tag</label>
														<select disabled class="select2 select2-multiple" multiple="multiple" data-placeholder="Choose">
															<optgroup label="Product Tag">
																<option selected value="CA">Ginger</option>
																<option selected value="NV">Pulm Organic</option>
																<option selected value="OR">Drinks</option>
																<option value="WA">Coffee</option>
																<option value="WA">Matcha</option>
															</optgroup>

														</select>
													</div>
												</div>
												<!--/span-->
											</div>
											<!--/row-->
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Price before Discount</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-cut"></i></div>
															<div class="input-group-addon">RM</div>
															<input type="text" class="form-control" id="exampleInputuname" placeholder="188">
														</div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Final Price</label>
														<div class="input-group">
															<div class="input-group-addon"><i class="ti-money"></i></div>
															<div class="input-group-addon">RM</div>
															<input type="text" class="form-control" id="exampleInputuname_1" placeholder="150">
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Logistic Company</label>
														<select class="form-control" data-placeholder="Choose a Category" tabindex="1">
															<option value="Product 1">DHL</option>
															<option value="Product 2">POS LAJU</option>
															<option value="Product 3">SHOPEE EXPRESS</option>
															<option value="Product 4">FMX EXPRESS</option>
															<option value="Product 4">SELF HANDLE</option>
														</select>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Delivery Price</label> <span>[**Per kg**]</span>
														<div class="input-group">
															<div class="input-group-addon"><i class="fa fa-truck"></i></div>
															<div class="input-group-addon">RM</div>
															<input type="text" class="form-control" id="exampleInputuname_1" placeholder="10">
														</div>
													</div>
												</div>
												<!--/span-->
											</div>
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="control-label mb-10">Status</label>
														<div class="radio-list">
															<div class="radio-inline pl-0">
																<div class="radio radio-info">
																	<input checked type="radio" name="radio" id="radio1" value="option1">
																	<label for="radio1">Published</label>
																</div>
															</div>
															<div class="radio-inline">
																<div class="radio radio-info">
																	<input type="radio" name="radio" id="radio2" value="option2">
																	<label for="radio2">Draft</label>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!--/span-->
											<div class="seprator-block"></div>
											<h6 class="txt-dark capitalize-font"><i class="icon-picture mr-10"></i>Product Images</h6>
											<hr>
											<div class="row">
												<div class="col-lg-3">
													<div class="img-upload-wrap padding-15-t-b">
														<img class="img-responsive" src="dist/img/chair.jpg" alt="upload_img">
													</div>
												</div>
												<div class="col-lg-3">
													<div class="img-upload-wrap padding-15-t-b">
														<img class="img-responsive" src="dist/img/chair.jpg" alt="upload_img">
													</div>
												</div>
												<div class="col-lg-3">
													<div class="img-upload-wrap padding-15-t-b">
														<img class="img-responsive" src="dist/img/chair.jpg" alt="upload_img">
													</div>
												</div>
												<div class="col-lg-3">
													<div class="img-upload-wrap padding-15-t-b">
														<img class="img-responsive" src="dist/img/chair.jpg" alt="upload_img">
													</div>
												</div>
											</div>
											<div class="seprator-block"></div>
											<div class="form-actions">
												<button class="btn btn-success btn-icon left-icon mr-10"> <i class="fa fa-check"></i> <span>save</span></button>
												<button type="button" class="btn btn-warning">Cancel</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->

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

	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Moment JavaScript -->
	<script type="text/javascript" src="vendors/bower_components/moment/min/moment-with-locales.min.js"></script>

	<!-- Bootstrap Colorpicker JavaScript -->
	<script src="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

	<!-- Select2 JavaScript -->
	<script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- Bootstrap Select JavaScript -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<!-- Bootstrap Tagsinput JavaScript -->
	<script src="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

	<!-- Bootstrap Touchspin JavaScript -->
	<script src="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

	<!-- Multiselect JavaScript -->
	<script src="vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>


	<!-- Bootstrap Switch JavaScript -->
	<script src="vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

	<!-- Bootstrap Datetimepicker JavaScript -->
	<script type="text/javascript" src="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Form Advance Init JavaScript -->
	<script src="dist/js/form-advance-data.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>

</body>

</html>