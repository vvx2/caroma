<?php

require_once('inc/init.php');
$PageName = "profile";
if ($login != 1) {
	echo "<script>window.location.replace('../login.php')</script>";
	exit();
}
$tb = "users u left join user_address ua on u.id = ua.user_id";
$col = "u.name as name, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state";
$opt = 'u.id = ?';
$arr = array($user_id);
$result_user = $db->advwhere($col, $tb, $opt, $arr);
$result_user = $result_user[0];

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
				<div class="row heading-bg  bg-blue">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-light">profile</h5>
					</div>
				</div>
				<!-- /Title -->

				<!-- Row -->
				<div class="row">
					<div class="col-lg-4 col-md-6">
						<div class="panel panel-default card-view  pa-0">
							<div class="panel-wrapper collapse in">
								<div class="panel-body  pa-0">
									<div class="profile-box">
										<div class="profile-info-wrap text-center">
											<div class="profile-info pt-40">
												<img class="img-circle inline-block mt-40 mb-10" src="dist/img/user1.png" alt="user" />
												<h4 class="txt-light block  mb-5 capitalize-font">willard bryant</h4>
												<h6 class="txt-light block uppercase-font pb-40">Distributor</h6>
											</div>
											<div class="profile-image-overlay"></div>
										</div>
										<div class="social-info txt-light">
											<div class="row">
												<div class="col-sm-4 text-center">
													<i class="fa fa-truck block mb-10"></i>
													<span class="counts block head-font mb-5">10</span>
													<span class="counts-text block">Total Order</span>
												</div>
												<div class="col-sm-4 text-center">
													<i class="fa fa-dollar (alias) block mb-10"></i>
													<span class="counts block head-font mb-5">100</span>
													<span class="counts-text block">Total Coin</span>
												</div>
												<div class="col-sm-4 text-center">
													<i class="fa fa-shopping-cart block mb-10"></i>
													<span class="counts block head-font mb-5">1</span>
													<span class="counts-text block">Cart Items</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-6">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="tab-struct custom-tab-1 mt-40">
										<ul role="tablist" class="nav nav-tabs" id="myTabs_8">
											<li class="active" role="presentation" class=""><a data-toggle="tab" role="tab" href="#profile" aria-expanded="false">Profile</a></li>
											<li role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" href="#change_email">Change Email</a></li>
											<li role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" href="#reset_password">Reset Password</a></li>
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div id="profile" class="tab-pane fade active in" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="form-wrap">
															<form data-toggle="validator" role="form">
																<div class="form-group">
																	<label for="inputName" class="control-label mb-10">Full Name</label>
																	<input type="text" class="form-control" id="inputName" placeholder="Cina Saffary" data-error="Name Is Required" value="<?php echo $result_user['name']; ?>" required>
																	<div class="help-block with-errors"></div>
																</div>
																<div class="form-group has-feedback">
																	<label for="inputPhone" class="control-label mb-10">Contact Number</label>
																	<div class="input-group">
																		<span class="input-group-addon">+6</span>
																		<input type="text" pattern="^(\+?6?01)[0|1|2|3|4|6|7|8|9]-*[0-9]{7,8}$" maxlength="11" class="form-control" value="<?php echo $result_user['contact']; ?>" id="inputPhone" placeholder="012 3456 789" data-error="Eg : 016 2345 678" required>
																		<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																	</div>

																	<div class="help-block with-errors">Contact Number Correctly!</div>
																</div>
																<div class="form-group">
																	<label for="inputAddress" class="control-label mb-10">Address</label>
																	<input type="text" class="form-control" id="inputAddress" placeholder="No 321, Lorong Sentosa, Tmn Lgd 15, 81100 Johor Bahru, Johor" value="<?php echo $result_user['address']; ?>" data-error="Address Is Required" required>
																	<div class="help-block with-errors"></div>
																</div>

																<div class="form-group">
																	<div class="row">
																		<div class="col-sm-4 col-12">
																			<label for="inputStates" class="control-label mb-10">States</label>
																			<select class="input-width state_select form-control" name="state" tabindex="2" id="inputStates" data-error="States Is Required" required>
																				<option data-option="" value="">Select State</option>
																				<?php

																				$tb = "state";
																				$col = "id, name";
																				$opt = 'id != ?';
																				$arr = array(0);
																				$result = $db->advwhere($col, $tb, $opt, $arr);
																				foreach ($result as $state) {
																				?>
																					<option value="<?php echo $state['id']; ?>" <?php echo ($state['id'] == $result_user['state']) ? "selected" : "" ?>><?php echo $state['name']; ?></option>


																				<?php
																				} ?>
																			</select>
																			<!-- <input type="text" class="form-control" id="inputStates" placeholder="Johor" value="<?php echo $result_user['state']; ?>" data-error="States Is Required" required> -->
																			<div class="help-block with-errors"></div>
																		</div>

																		<div class="col-sm-4 col-12">
																			<label for="inputCity" class="control-label mb-10">City</label>
																			<input type="text" class="form-control" id="inputCity" placeholder="Johor Bahru" value="<?php echo $result_user['city']; ?>" data-error="City Is Required" required>
																			<div class="help-block with-errors"></div>
																		</div>

																		<div class="col-sm-4 col-12">
																			<label for="inputZip" class="control-label mb-10">Zip Code</label>
																			<input type="text" class="form-control" id="inputZip" placeholder="81100" value="<?php echo $result_user['postcode']; ?>" data-error="Zip Code Is Required" required>
																			<div class="help-block with-errors"></div>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label for="inputAddress" class="control-label mb-10">Profile Picture</label>
																	<input type="file" class="form-control" id="inputAddress" accept="image/x-png,image/gif,image/jpeg" data-error="Only for .jpg .jpeg .png" >
																	<div class="help-block with-errors"></div>
																</div>

																<div class="form-group mb-0">
																	<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>

											<div id="reset_password" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="form-wrap">
															<form data-toggle="validator" role="form">
																<div class="form-group">
																	<div class="form-group col-sm-12 no-padding">
																		<label for="inputPassword" class="control-label mb-10">Old Password</label>
																		<input data-match-error="Old Password Is Required" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
																	</div>
																</div>

																<div class="form-group">
																	<div class="row">
																		<div class="form-group col-sm-12">
																			<label for="inputPassword" class="control-label mb-10">New Password</label>
																			<input type="password" data-minlength="8" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" class="form-control" id="inputPassword" placeholder="Password" required>
																			<div class="help-block">UpperCase, LowerCase, Number, SpecialChar and min 8 Chars</div>
																		</div>
																		<div class="form-group col-sm-12">
																			<label for="inputPassword" class="control-label mb-10">Confirm Password</label>
																			<input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
																			<div class="help-block with-errors"></div>
																		</div>
																	</div>
																</div>

																<div class="form-group mb-0">
																	<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
																</div>
															</form>
														</div>
													</div>

												</div>
											</div>

											<div id="change_email" class="tab-pane fade" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="form-wrap">
															<form data-toggle="validator" role="form">
																<div class="form-group">
																	<div class="form-group col-sm-12 no-padding">
																		<label for="inputEmail" class="control-label mb-10">Email</label>
																		<input data-match-error="Email Is Required" type="email" class="form-control" id="inputEmail" value="<?php echo $result_user['email']; ?>" placeholder="Email" required>
																	</div>
																</div>

																<div class="form-group mb-0">
																	<button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Submit</span></button>
																</div>
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
				<!-- /Row -->

			</div>
			<!-- Footer -->
			<footer class="footer container-fluid pl-30 pr-30">
				<div class="row">
					<?php require_once('inc/footer.php'); ?>
				</div>
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


	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>


	<script src="vendors/bower_components/bootstrap-validator/dist/validator.min.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>
	<script src="dist/js/widgets-data.js"></script>


</body>

</html>