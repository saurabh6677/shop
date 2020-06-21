<?php
$login_btn = "";
$signup_btn = "";


if(!empty($_COOKIE['_bk_']))
{
	$username = base64_decode($_COOKIE['_bk_']);
	 $login_btn = '<li class="nav-item"><a href="profile.php" class="nav-link font-weight-bold"><i class="fa fa-user"></i> Profile</a></li>';
	 $signup_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/pages/php/logout.php" class="nav-link font-weight-bold"><i class="fa fa-sign-out"></i> Logout</a></li>';
	 $cart_btn = '<li class="nav-item"><a href="#" class="nav-link font-weight-bold"><i class="fa fa-shopping-cart text-primary"></i> Cart</a></li>';
}
else
{
	 $login_btn = '<li class="nav-item"><a href="login.php" class="nav-link font-weight-bold">Login</a></li>';
	 $signup_btn = '<li class="nav-item"><a href="signup.php" class="nav-link font-weight-bold">Signup</a></li>';
	 $cart_btn = "";
}
echo '<nav class="navbar navbar-expand-lg sticky-top shadow-sm bg-white">
	<a href="#" class="navbar-brand font-weight-bold">bookstore.com</a>
	<i class="fa fa-bars navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" style="font-size: 25px"></i>
	<div class="collapse navbar-collapse" id="navbar-collapse">
	<ul class="navbar-nav ml-auto">
		<li class="nav-item"><a href="http://localhost/bookstore/shop/index.php" class="nav-link font-weight-bold active">Home</a></li>
		<li class="nav-item"><a href="#" class="nav-link font-weight-bold">Audio</a></li>
		
		'.$cart_btn.$login_btn.$signup_btn.'
		
	</ul>
	</div>
</nav>';

?>