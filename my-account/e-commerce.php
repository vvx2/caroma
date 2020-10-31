<?php
require_once('inc/init.php');
$PageName = "index";
if ($login != 1) {
	echo "<script>window.location.replace('../login.php')</script>";
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php require_once('inc/head.php'); ?>
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
				<div class="row heading-bg  bg-yellow">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-light">Dashboard</h5>
					</div>
				</div>
				<!-- /Title -->
				<!-- Row -->
				<div class="row">
					<div class="col-sm-4 col-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="order-list.php?p=2">
										<div class="sm-data-box bg-red">
											<div class="row ma-0">
												<div class="col-xs-5 text-center pa-0 icon-wrap-left">
													<i class="icon-briefcase txt-light"></i>
												</div>
												<div class="col-xs-7 text-center data-wrap-right">
													<h6 class="txt-light">Order Pending</h6>
													<span class="txt-light counter counter-anim">
														<?php
														$col = "id";
														$tb = "orders";
														$opt = 'admin_id = ? && status =?';
														$arr = array($user_id, 2);
														$count_order = $db->advwhere($col, $tb, $opt, $arr);
														echo count($count_order);
														?>
													</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="order-list.php?p=1">
										<div class="sm-data-box bg-yellow">
											<div class="row ma-0">
												<div class="col-xs-5 text-center pa-0 icon-wrap-left">
													<i class="icon-briefcase txt-light"></i>
												</div>
												<div class="col-xs-7 text-center data-wrap-right">
													<h6 class="txt-light">Order Rejected</h6>
													<span class="txt-light counter">
														<?php
														$col = "id";
														$tb = "orders";
														$opt = 'admin_id = ? && status =?';
														$arr = array($user_id, 1);
														$count_order = $db->advwhere($col, $tb, $opt, $arr);
														echo count($count_order);
														?>
													</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4 col-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="order-list.php?p=4">
										<div class="sm-data-box bg-green">
											<div class="row ma-0">
												<div class="col-xs-5 text-center pa-0 icon-wrap-left">
													<i class="icon-briefcase txt-light"></i>
												</div>
												<div class="col-xs-7 text-center data-wrap-right">
													<h6 class="txt-light">Order Successful</h6>
													<span class="txt-light counter">
														<?php
														$col = "id";
														$tb = "orders";
														$opt = 'admin_id = ? && status =?';
														$arr = array($user_id, 4);
														$count_order = $db->advwhere($col, $tb, $opt, $arr);
														echo count($count_order);
														?>
													</span>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->


				<!-- Row -->
				<div class="row">
					<div class="col-lg-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><i class="icon-share mr-10"></i>Monthly Sales</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<canvas id="chart_1" height="417"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->

				<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Order History Exporter</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="example" class="table table-hover display  pb-30">
												<thead>
													<tr>
														<th>#</th>
														<th>Order ID</th>
														<th>DateTime</th>
														<th>Dealer's Name</th>
														<th>Dealer's Contact Number</th>
														<th>Dealer's Address</th>
														<th>Payment Method</th>
														<th>Total Amount</th>
														<th>Status</th>
														<th>More Detail</th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>#</th>
														<th>Order ID</th>
														<th>DateTime</th>
														<th>Dealer's Name</th>
														<th>Dealer's Contact Number</th>
														<th>Dealer's Address</th>
														<th>Payment Method</th>
														<th>Total Amount</th>
														<th>Status</th>
														<th>More Detail</th>
													</tr>
												</tfoot>
												<tbody>
													<?php
													$i = 1;
													$col = "*";
													$tb = "orders";
													$opt = 'admin_id = ? && status =? ORDER BY date_modified DESC';
													$arr = array($user_id, 2);
													$result_orders = $db->advwhere($col, $tb, $opt, $arr);
													foreach ($result_orders as $order) {
													?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $order['gateway_order_id']; ?></td>
															<td><?php echo $order['date_created']; ?></td>
															<td><?php echo $order['customer_name']; ?></td>
															<td><?php echo $order['customer_contact']; ?></td>
															<td><?php echo $order['customer_address']; ?></td>
															<td>FPX</td>
															<td><?php echo $order['total_payment']; ?></td>
															<td>Completed</td>
															<td><i data-remote="ajax/user_order_detail.php?p=<?php echo $order['id']; ?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="fa fa-cogs toolsx"></i></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
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

	<!-- modal content - data from ajax-->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->


	<!-- JavaScript -->


	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="vendors/bower_components/jszip/dist/jszip.min.js"></script>
	<script src="vendors/bower_components/pdfmake/build/pdfmake.min.js"></script>
	<script src="vendors/bower_components/pdfmake/build/vfs_fonts.js"></script>

	<script src="vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="dist/js/export-table-data.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- simpleWeather JavaScript -->
	<script src="vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
	<script src="dist/js/simpleweather-data.js"></script>

	<!-- Progressbar Animation JavaScript -->
	<script src="vendors/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="vendors/bower_components/Counter-Up/jquery.counterup.min.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- Sparkline JavaScript -->
	<script src="vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>

	<!-- ChartJS JavaScript -->
	<script src="vendors/chart.js/Chart.min.js"></script>

	<!-- Morris Charts JavaScript -->
	<script src="vendors/bower_components/raphael/raphael.min.js"></script>
	<script src="vendors/bower_components/morris.js/morris.min.js"></script>
	<script src="dist/js/morris-data.js"></script>

	<script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/dashboard-data.js"></script>
	<script>
		//this script for modal 
		$('body').on('click', '[data-toggle="modal"]', function() {
			$($(this).data("target") + ' .modal-content').load($(this).data("remote"));
		});
	</script>
</body>

</html>