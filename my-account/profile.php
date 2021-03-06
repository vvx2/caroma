<?php

require_once('inc/init.php');
$PageName = "profile";
if ($login != 1) {
	echo "<script>window.location.replace('../login.php')</script>";
	exit();
}
if ($user_type == 2) {
	$tb = "users u left join user_address ua on u.id = ua.user_id left join user_distributor ud on u.id = ud.user_id";
	$col = "u.name as name,u.type as user_type,u.image as image, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state, ud.distributor_code as distributor_code";
} else if ($user_type == 3) { // ud = user_dealer, du = distributr's users table
	$tb = "users u left join user_address ua on u.id = ua.user_id left join user_dealer ud on u.id = ud.user_id left join users du on ud.under_distributor = du.id left join user_distributor dis on ud.under_distributor = dis.user_id left join user_address dis_add on ud.under_distributor = dis_add.user_id";
	$col = "u.name as name,u.type as user_type,u.image as image, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state, du.name as distributor_name, dis.distributor_code as distributor_code, dis_add.contact as distributor_contact";
} else {
	$tb = "users u left join user_address ua on u.id = ua.user_id";
	$col = "u.name as name,u.type as user_type,u.image as image, u.email as email, ua.contact as contact, ua.address as address, ua.postcode as postcode, ua.city as city, ua.state as state";
}
$opt = 'u.id = ?';
$arr = array($user_id);
$result_user = $db->advwhere($col, $tb, $opt, $arr);
$result_user = $result_user[0];

$user_img = $result_user['image'];
$user_type_display = "";
if ($result_user['user_type'] == 1) {
	$user_type_display = "NORMAL USER";
} else if ($result_user['user_type'] == 2) {
	$user_type_display = "DISTRIBUTOR";
} else if ($result_user['user_type'] == 3) {
	$user_type_display = "DEALER";
}

if ($user_img != "" || $user_img != NULL) {
	$image_path = "../img/profile/" . $user_img;
} else {
	$image_path = "dist/img/user1.png";
}

$user_order = $db->where("id", "orders", "users_id", $user_id);
$user_cart = $db->where("id", "cart", "customer_id", $user_id);

$count_user_order = count($user_order);
$count_cart = count($user_cart);
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
						<h5 class="txt-light"><?php echo $lang['lang-profile']; ?></h5>
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
												<img class="img-circle inline-block mt-40 mb-10" src="<?php echo $image_path; ?>" alt="user" />
												<h4 class="txt-light block  mb-5 capitalize-font"><?php echo $result_user['name']; ?></h4>
												<h6 class="txt-light block uppercase-font pb-10"><?php echo $user_type_display; ?></h6>
												<?php
												if ($user_type == 2) {
												?>
													<h6 class="txt-light block uppercase-font"><strong><?php echo $lang['lang-distributor_code']; ?>: </strong><?php echo $result_user['distributor_code']; ?></h6>
												<?php
												}
												?>


											</div>
											<div class="profile-image-overlay"></div>
										</div>
										<div class="social-info txt-light">
											<div class="row">
												<?php
												if ($user_type == 1) {
													//if user type is normal user, display point here

													$user_point = $db->where("point", "user_point", "user_id", $user_id);
													if (count($user_point) != 0) {
														$point = $user_point[0]['point'];
													} else {
														$point = 0;
													}
												?>
													<div class="col-sm-4 text-center">
														<i class="fa fa-truck block mb-10"></i>
														<span class="counts block head-font mb-5"><?php echo $count_user_order; ?></span>
														<span class="counts-text block"><?php echo $lang['lang-total_order']; ?></span>
													</div>
													<div class="col-sm-4 text-center">
														<a href="point_history.php" target="_blank">
														<i class="fa fa-money block mb-10"></i>
														<span class="counts block head-font mb-5"><?php echo $point; ?></span>
														<span class="counts-text block"><?php echo $lang['lang-point']; ?></span>
														</a>
													</div>
													<div class="col-sm-4 text-center">
														<i class="fa fa-shopping-cart block mb-10"></i>
														<span class="counts block head-font mb-5"><?php echo $count_cart; ?></span>
														<span class="counts-text block"><?php echo $lang['lang-cart_item']; ?></span>
													</div>

												<?php
												} else {
												?>
													<div class="col-sm-6 text-center">
														<i class="fa fa-truck block mb-10"></i>
														<span class="counts block head-font mb-5"><?php echo $count_user_order; ?></span>
														<span class="counts-text block"><?php echo $lang['lang-total_order']; ?></span>
													</div>

													<div class="col-sm-6 text-center">
														<i class="fa fa-shopping-cart block mb-10"></i>
														<span class="counts block head-font mb-5"><?php echo $count_cart; ?></span>
														<span class="counts-text block"><?php echo $lang['lang-cart_item']; ?></span>
													</div>
												<?php
												}
												?>


											</div>
										</div>

										<?php
										if ($user_type == 2) {
										?>
											<div class="social-info txt-light">
												<div class="row">
													<div class="col-sm-12 text-center">
														<i class="fa fa-link block mb-10"> <?php echo $lang['lang-url_register']; ?></i>
														<?php
														$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

														if ($actual_link != "http://localhost") {
															$register_link =  $actual_link . "/register_dealer.php?code=" . $result_user['distributor_code'];
														} else {
															$register_link =  $actual_link . "/caroma/register_dealer.php?code=" . $result_user['distributor_code'];
														}
														echo "<input type='text' value='" . $register_link . "' id='myInput' style='color:black;width: 250px;'><br><button style='color:black;margin-top:5px' onclick='myFunction()'> Copy</button>";

														?>

													</div>
												</div>
											</div>
										<?php
										} else if ($user_type == 3) {
										?>
											<div class="social-info txt-light">
												<div class="row">
													<div class="col-sm-12 text-center">
														<i class="fa fa-link block mb-10"> <?php echo $lang['lang-your_distributor']; ?></i>

														<h5>
															<strong><?php echo $lang['lang-name']; ?>:</strong> <?php echo $result_user['distributor_name']; ?><br>
															<strong><?php echo $lang['lang-distributor_code']; ?>:</strong> <?php echo $result_user['distributor_code']; ?> <br>
															<strong><?php echo $lang['lang-contact']; ?>:</strong> <?php echo $result_user['distributor_contact']; ?><br>
														</h5>
													</div>
												</div>
											</div>
										<?php
										}
										?>

									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-6">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="tab-struct custom-tab-1">
										<ul role="tablist" class="nav nav-tabs" id="myTabs_8">
											<li class="active" role="presentation" class=""><a data-toggle="tab" role="tab" href="#profile" aria-expanded="false"><?php echo $lang['lang-profile']; ?></a></li>
											<li role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" href="#change_email"><?php echo $lang['lang-change_email']; ?></a></li>
											<li role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" href="#reset_password"><?php echo $lang['lang-reset_password']; ?></a></li>
										</ul>
										<div class="tab-content" id="myTabContent_8">
											<div id="profile" class="tab-pane fade active in" role="tabpanel">
												<div class="row">
													<div class="col-md-12">
														<div class="form-wrap">
															<form data-toggle="validator" role="form" id="form_profile" action="api/user_sql.php?type=profile_edit&tb=user" method="post" enctype="multipart/form-data">
																<input type="hidden" name="token" value="<?php echo $token; ?>" />
																<div class="form-group">
																	<label for="inputName" class="control-label mb-10"><?php echo $lang['lang-name']; ?></label>
																	<input type="text" class="form-control" id="inputName" placeholder="Cina Saffary" data-error="Name Is Required" name="name" value="<?php echo $result_user['name']; ?>" required>
																	<div class="help-block with-errors"></div>
																</div>
																<div class="form-group has-feedback">
																	<label for="inputPhone" class="control-label mb-10"><?php echo $lang['lang-contact_number']; ?>r</label>
																	<div class="input-group">
																		<span class="input-group-addon">+6</span>
																		<input type="text" pattern="^(\+?6?01)[0|1|2|3|4|6|7|8|9]-*[0-9]{7,8}$" maxlength="11" class="form-control" name="contact" value="<?php echo $result_user['contact']; ?>" id="inputPhone" placeholder="012 3456 789" data-error="Eg : 016 2345 678" required>
																		<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
																	</div>

																	<div class="help-block with-errors">Contact Number Correctly!</div>
																</div>
																<div class="form-group">
																	<label for="inputAddress" class="control-label mb-10"><?php echo $lang['lang-address']; ?></label>
																	<input type="text" class="form-control" id="inputAddress" placeholder="No 321, Lorong Sentosa, Tmn Lgd 15, 81100 Johor Bahru, Johor" name="address" value="<?php echo $result_user['address']; ?>" data-error="Address Is Required" required>
																	<div class="help-block with-errors"></div>
																</div>

																<div class="form-group">
																	<div class="row">
																		<div class="col-sm-4 col-12">
																			<label for="inputStates" class="control-label mb-10"><?php echo $lang['lang-state']; ?></label>
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
																			<div class="help-block with-errors"></div>
																		</div>

																		<div class="col-sm-4 col-12">
																			<label for="inputCity" class="control-label mb-10"><?php echo $lang['lang-city']; ?></label>
																			<input type="text" class="form-control" id="inputCity" placeholder="Johor Bahru" name="city" value="<?php echo $result_user['city']; ?>" data-error="City Is Required" required>
																			<div class="help-block with-errors"></div>
																		</div>

																		<div class="col-sm-4 col-12">
																			<label for="inputZip" class="control-label mb-10"><?php echo $lang['lang-zip_code']; ?></label>
																			<input type="text" class="form-control" id="inputZip" placeholder="81100" name="postcode" value="<?php echo $result_user['postcode']; ?>" data-error="Zip Code Is Required" required>
																			<div class="help-block with-errors"></div>
																		</div>
																	</div>
																</div>

																<div class="form-group">
																	<label for="profileimage" class="control-label mb-10"><?php echo $lang['lang-profile_picture']; ?></label>
																	<input type="file" class="form-control" id="profileimage" name="img" accept="image/x-png,image/gif,image/jpeg" data-error="Only for .jpg .jpeg .png">
																	<div class="help-block with-errors"></div>
																</div>

																<div class="form-group mb-0">
																	<button type="submit" class="btn btn-success btn-anim" name="btnAction"><i class="icon-rocket"></i><span class="btn-text"><?php echo $lang['lang-submit']; ?></span></button>
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
															<form data-toggle="validator" role="form" id="form_password" action="api/user_sql.php?type=change_password&tb=user" method="post" enctype="multipart/form-data">
																<input type="hidden" name="token" value="<?php echo $token; ?>" />
																<div class="form-group">
																	<div class="form-group col-sm-12 no-padding">
																		<label for="inputPassword" class="control-label mb-10"><?php echo $lang['lang-old_password']; ?></label>
																		<input data-match-error="Old Password Is Required" name="old_password" type="password" class="form-control" id="inputPassword" placeholder="Password" required>
																	</div>
																</div>

																<div class="form-group">
																	<div class="row">
																		<div class="form-group col-sm-12">
																			<label for="inputnewPassword" class="control-label mb-10"><?php echo $lang['lang-new_password']; ?></label>
																			<input type="password" data-minlength="8" name="new_password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" class="form-control" id="inputnewPassword" placeholder="Password" required>
																			<div class="help-block"><?php echo $lang['lang-uppercase']; ?></div>
																		</div>
																		<div class="form-group col-sm-12">
																			<label for="inputPasswordConfirm" class="control-label mb-10"><?php echo $lang['lang-confirm_password']; ?></label>
																			<input type="password" class="form-control" name="confirm_password" id="inputPasswordConfirm" data-match="#inputnewPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
																			<div class="help-block with-errors"></div>
																		</div>
																	</div>
																</div>

																<div class="form-group mb-0">
																	<button type="submit" class="btn btn-success btn-anim" name="btnAction"><i class="icon-rocket"></i><span class="btn-text"><?php echo $lang['lang-submit']; ?></span></button>
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
															<form data-toggle="validator" role="form" id="form_email" action="api/user_sql.php?type=change_email&tb=user" method="post" enctype="multipart/form-data">
																<input type="hidden" name="token" value="<?php echo $token; ?>" />
																<div class="form-group">
																	<div class="form-group col-sm-12 no-padding">
																		<label for="inputEmail" class="control-label mb-10"><?php echo $lang['lang-email']; ?></label>
																		<input data-match-error="Email Is Required" type="email" class="form-control" id="inputEmail" name="email" value="<?php echo $result_user['email']; ?>" placeholder="Email" required>
																	</div>
																</div>

																<div class="form-group mb-0">
																	<button type="submit" class="btn btn-success btn-anim" name="btnAction"><i class="icon-rocket"></i><span class="btn-text"><?php echo $lang['lang-submit']; ?></span></button>
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

	<script>
		function myFunction() {
	/* Get the text field */
	var copyText = document.getElementById("myInput");

	/* Select the text field */
	copyText.select();
	copyText.setSelectionRange(0, 99999); /* For mobile devices */

	/* Copy the text inside the text field */
	document.execCommand("copy");

	/* Alert the copied text */
	alert("Copied the text: " + copyText.value);
	}
	</script>


</body>

</html>