<?php
require_once("common_files/database/database.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome</title>
		<link rel="stylesheet" href="common_files/css/bootstrap.min.css">
		<link rel="stylesheet" href="common_files/css/animate.css">
		<link rel="stylesheet" href="common_files/css/fontawesome.min.css">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<script src="common_files/js/jquery.js"></script>
		<script src="common_files/js/popper.js"></script>
		<script src="common_files/js/bootstrap.min.js"></script>
		<script src="js/signup.js"></script>
	</head>
	<body>
		<?php
		require_once("assist/nav.php");
		?>
		<div class="container-fluid my-4">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8 p-0 m-0">
					<div class="shadow-lg py-lg-3 m-lg-3 pb-2 rounded-lg" style="border-left: 5px solid blue">
						<h4 class="text-center text-success pt-2">Registration Form</h4>
						<form class="signup-form pl-4">
							<div class="form-group">
								<label for="fullname">Fullname<sup style="color: red">*</sup></label>
								<input required="required" placeholder="raju kumar" type="text" name="fullname" class="form-control w-75" id="fullname">
							</div>
							<div class="form-group">
								<label for="email">Email<sup style="color: red">*</sup></label>
								<input required="required" placeholder="raju@gmail.com" type="text" name="email" class="form-control w-75" id="email">
							</div>
							<div class="form-group">
								<label for="mobile">Mobile<sup style="color: red">*</sup></label>
								<input required="required" placeholder="8657000000" type="text" name="mobile" class="form-control w-75" id="mobile">
							</div>
							<div class="form-group">
								<label for="pincode">Pincode<sup style="color: red">*</sup></label>
								<input required="required" placeholder="246701" type="number" name="pincode" class="form-control w-75" id="pincode">
							</div>
							<div class="form-group">
								<label for="password">Password<sup style="color: red">*</sup></label>
								<input required="required" placeholder="raju@123" type="password" name="password" class="form-control w-75" id="password">
							</div>
							<div class="form-group">
								<label for="re-password">Re-enter Password<sup style="color: red">*</sup></label>
								<input required="required" placeholder="raju@123" type="password" name="re-password" class="form-control w-75" id=re-password>
							</div>
							<button class="btn signup-btn btn-primary" type="submit">Signup now</button><br class="d-lg-none"><br class="d-lg-none">    <span class="ml-lg-5 my-md-3"><a href="http://localhost/bookstore/shop/login.php">If You already have an account ?</a></span>
							
						</form>
						<div class="otp-box d-none ml-4">
							<h4 class="text-primary">Verify Your Email</h4>
							<span class="text-danger">Please check your email to verify your account</span><br><br>
							<div class="btn-group  border">
								<button class="btn">
								<input type="number" name="otp" class="form-control otp w-100" placeholder="enter otp">
								</button>
								<button type="btn" class="btn btn-primary verify-btn">Verify</button>
								<button type="btn" class="btn btn-danger resend-btn">Resend OTP</button>
							</div>
						</div>
						<div class="signup-notice ml-3"></div>
					</div>
				</div>
				<div class="col-md-2"></div>
			</div>
		</div>
		<?php
		require_once("assist/footer.php");
		?>
	</body>
</html>