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
	<script src="js/index.js"></script>
</head>
<body>
<?php
require_once("assist/nav.php");

?>
<div class="container-fluid my-4">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8 p-0 m-0">
			<div class="shadow-lg py-3 m-lg-3 rounded-lg" style="border-left: 5px solid blue">
			
			<div class="ml-4 form-group email-box">
				<label for="email">Enter your email</label>
				<input type="email" name="email" placeholder="example@gmail.com" class="email form-control w-75" id="email"><br>
				<button class="btn btn-primary send-otp">Submit</button>
			</div>
			<div class="otp-box d-none ml-4">
				<h4 class="text-primary">Verify Your Email</h4>
				<span class="text-danger">Please check your email to verify your account</span><br><br>	
				<div class="btn-group  border">
				<button class="btn">
				<input type="number" name="otp" class="form-control otp w-100">
				</button>
				<button type="btn" class="btn btn-primary verify-btn">Verify</button>
				<button type="btn" class="btn btn-danger resend-btn">Resend OTP</button>
				</div>
			</div>
			
			<div class="new-password-box d-none ml-4">
				<h4 class="text-primary">Create New Password</h4>
				<div class="form-group">
					<label for='new-password'>Enter new password</label>
					<input type="text" name="new_password" id="new-password" class="form-control w-75">
				</div>
				<div class="form-group">
					<label for='re-new-password'>Re-Enter new password</label>
					<input type="text" name="re-new_password" id="re-new-password" class="form-control w-75">
				</div>
				<button class="btn btn-primary change-password-btn">Change Password</button>
			</div>
			<div class="forgot-notice"></div>
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

