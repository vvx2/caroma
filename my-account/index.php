<?php
require_once('inc/init.php');
$PageName = "index";
if ($login != 1) {
	echo "<script>window.location.replace('../login.php')</script>";
	exit();
}

// page 2: to ship, 3: shipping, 4: completed, 1: rejected/fail
if (isset($_REQUEST['p'])) { // order status
	$order_page = $_REQUEST['p'];
} else {
	$order_page = 2;
}

if ($user_type == "2") {
	$url = "index";
} else {
	$url = "index";
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
				<div class="row heading-bg bg-yellow">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-light">Dashboard</h5>
					</div>
				</div>
				<!-- /Title -->

				<!-- Row -->
				<div class="row">
					<div class="col-sm-3 col-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="<?php echo $url; ?>.php?p=2">
										<div class="sm-data-box bg-yellow">
											<div class="row ma-0">
												<div class="col-xs-5 text-center pa-0 icon-wrap-left">
													<i class="icon-briefcase txt-light"></i>
												</div>
												<div class="col-xs-7 text-center data-wrap-right">
													<h6 class="txt-light">To Ship</h6>
													<span class="txt-light counter counter-anim">
														<?php
														$col = "id";
														$tb = "orders";
														$opt = 'users_id = ? && status =?';
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
					<div class="col-sm-3 col-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="<?php echo $url; ?>.php?p=3">
										<div class="sm-data-box bg-blue">
											<div class="row ma-0">
												<div class="col-xs-5 text-center pa-0 icon-wrap-left">
													<i class="icon-briefcase txt-light"></i>
												</div>
												<div class="col-xs-7 text-center data-wrap-right">
													<h6 class="txt-light">Shipping</h6>
													<span class="txt-light counter">
														<?php
														$col = "id";
														$tb = "orders";
														$opt = 'users_id = ? && status =?';
														$arr = array($user_id, 3);
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
					<div class="col-sm-3 col-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="<?php echo $url; ?>.php?p=4">
										<div class="sm-data-box bg-red">
											<div class="row ma-0">
												<div class="col-xs-5 text-center pa-0 icon-wrap-left">
													<i class="icon-briefcase txt-light"></i>
												</div>
												<div class="col-xs-7 text-center data-wrap-right">
													<h6 class="txt-light">Completed</h6>
													<span class="txt-light counter">
														<?php
														$col = "id";
														$tb = "orders";
														$opt = 'users_id = ? && status =?';
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
					<div class="col-sm-3 col-12">
						<div class="panel panel-default card-view pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body pa-0">
									<a href="<?php echo $url; ?>.php?p=1">
										<div class="sm-data-box bg-green">
											<div class="row ma-0">
												<div class="col-xs-5 text-center pa-0 icon-wrap-left">
													<i class="icon-briefcase txt-light"></i>
												</div>
												<div class="col-xs-7 text-center data-wrap-right">
													<h6 class="txt-light">Rejected / Failed</h6>
													<span class="txt-light counter">
														<?php
														$col = "id";
														$tb = "orders";
														$opt = 'users_id = ? && status =?';
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
				</div>
				<!-- /Row -->

				<!-- Row -->
				<div class="row">
					<div class="col-lg-12 col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Order List</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<p class="text-muted">Please check your<code> ORDERS </code> in this list.</p>
									<div class="pills-struct mt-40">
										<ul role="tablist" class="nav nav-pills nav-pills-rounded" id="myTabs_11">
											<li role="presentation" class="<?php echo ($order_page == "2") ? "active" : "" ?>"><a href="index.php?p=2">To Ship</a></li>
											<li role="presentation" class="<?php echo ($order_page == "3") ? "active" : "" ?>"><a href="index.php?p=3">Shipping</a></li>
											<li role="presentation" class="<?php echo ($order_page == "4") ? "active" : "" ?>"><a href="index.php?p=4">Completed</a></li>
											<li role="presentation" class="<?php echo ($order_page == "1") ? "active" : "" ?>"><a href="index.php?p=1">Rejected / Failed</a></li>
											<li role="presentation" class="<?php echo ($order_page == "5") ? "active" : "" ?>"><a href="index.php?p=5">To Cancel</a></li>
										</ul>
										<div class="tab-content" id="myTabContent_11">
											<div id="home_11" class="tab-pane fade active in" role="tabpanel">
												<div class="col-sm-12 no-padding">
													<div class="panel panel-default card-view no-padding">
														<div class="panel-heading">
															<div class="pull-left">
																<h6 class="panel-title txt-dark">Export</h6>
															</div>
															<div class="clearfix"></div>
														</div>
														<div class="panel-wrapper collapse in">
															<div class="panel-body">
																<div class="table-wrap">
																	<div class="table-responsive">
																		<table id="example" class="table table-hover display pb-30">
																			<thead>
																				<tr>
																					<th>#</th>
																					<th>Order ID</th>
																					<th>Name</th>
																					<th>DateTime</th>
																					<th>Total Amount</th>
																					<th>More Detail</th>
																					<th>Action</th>
																				</tr>
																			</thead>
																			<tfoot>
																				<tr>
																					<th>#</th>
																					<th>Order ID</th>
																					<th>Name</th>
																					<th>DateTime</th>
																					<th>Total Amount</th>
																					<th>More Detail</th>
																					<th>Action</th>
																				</tr>
																			</tfoot>
																			<tbody>
																				<?php
																				$i = 1;
																				$col = "id, customer_name, gateway_order_id, date_created, total_payment, status";
																				$tb = "orders";
																				$opt = 'users_id = ? && status =? ORDER BY date_modified DESC';
																				$arr = array($user_id, $order_page);
																				$result_orders = $db->advwhere($col, $tb, $opt, $arr);
																				foreach ($result_orders as $order) {

																					$id = $order['id'];
																					$status = $order['status'];

																					//to reject order, status -> failed/Canceled
																					$btn_to_cancel = '<i data-remote="ajax/order_to_cancel.php?p=' . $id . '" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success">To Cancel</i>';
																					//order deliverd, status -> completed
																					$btn_complete = '<i data-remote="ajax/user_order_complete.php?p=' . $id . '" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-success">To Complete</i>';

																					switch ($status) {
																						case "1":
																							$status_color = "text-danger";
																							$status_display = "Failed / Canceled";
																							$status_desc = "This order was canceled, or your order payment was failed.";
																							$btn_action = "-";
																							break;
																						case "2":
																							$status_color = "text-warning";
																							$status_display = "To Ship";
																							$status_desc = "Waiting for the Caroma Malaysia to ship out the products.";
																							$btn_action = $btn_to_cancel;
																							break;
																						case "3":
																							$status_color = "text-success";
																							$status_display = "Shipping";
																							$status_desc = "This order had been shipped.";
																							$btn_action =  $btn_complete;
																							break;
																						case "4":
																							$status_color = "text-info";
																							$status_display = "Completed";
																							$status_desc = "The order was delivered.";
																							$btn_action = "-";
																							break;
																						case "5":
																							$status_color = "text-dark";
																							$status_display = "To Cancel";
																							$status_desc = "The order is pending to Cancel.";
																							$btn_action = "-";
																					}
																				?>

																					<tr>
																						<td><?php echo $i; ?></td>
																						<td><?php echo $order['gateway_order_id']; ?></td>
																						<td><?php echo $order['customer_name']; ?></td>
																						<td><?php echo $order['date_created']; ?></td>
																						<td><?php echo $order['total_payment']; ?></td>
																						<td><i data-remote="ajax/user_order_detail.php?p=<?php echo $order['id']; ?>" data-toggle="modal" data-target=".bs-example-modal-lg" class="fa fa-cogs toolsx"></i></td>
																						<td><?php echo $btn_action; ?></td>
																					</tr>
																				<?php $i++;
																				} ?>
																			</tbody>
																		</table>
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

	<!-- /Main Content -->


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

	<!-- Calender JavaScripts -->
	<script src="vendors/bower_components/moment/min/moment.min.js"></script>
	<script src="vendors/jquery-ui.min.js"></script>
	<script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
	<script src="dist/js/fullcalendar-data.js"></script>

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

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/widgets-data.js"></script>

	<script>
		//this script for modal 
		$('body').on('click', '[data-toggle="modal"]', function() {
			$($(this).data("target") + ' .modal-content').load($(this).data("remote"));
		});
	</script>


</body>

</html>