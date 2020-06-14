<?php
require_once("common_files/database/database.php");

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=device-width, initial-scale=1">
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
		<div class="col-md-8" >
			<div class="shadow-lg py-3 m-3 rounded-lg" style="border-left: 5px solid blue">
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
					<label for="password">Password<sup style="color: red">*</sup></label>
					<input required="required" placeholder="raju@123" type="password" name="password" class="form-control w-75" id="password">
				</div>
				<div class="form-group">
					<label for="re-password">Re-enter Password<sup style="color: red">*</sup></label>
					<input required="required" placeholder="raju@123" type="password" name="password" class="form-control w-75" id=re-password>
				</div>
				<button class="btn signup-btn btn-primary" type="submit">Signup now</button>    <span class="ml-5 "><a href="http://localhost/bookstore/login.php">If You already have an account ?</a></span>
				<div class="signup-notice"></div>
			</form>
		</div>
		</div>
		<div class="col-md-2"></div>
	</div>
</div>
<p></p>
</body>
</html>

