<?php
$login_btn = "";
$signup_btn = "";
$username = "";
$notification_btn = "";


if(!empty($_COOKIE['_bk_']))
{
	$username = base64_decode($_COOKIE['_bk_']);
	 $login_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/profile.php" class="nav-link font-weight-bold"><i class="fa fa-tachometer"></i> Dashboard</a></li>';
	 $signup_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/pages/php/logout.php" class="nav-link font-weight-bold"><i class="fa fa-sign-out"></i> Logout</a></li>';
	 $cart_btn = '<li class="nav-item"><a href="#" class="nav-link font-weight-bold"><i class="fa fa-shopping-cart text-primary"></i> Cart</a></li>';
	 $check_not = "SELECT COUNT(id) AS noti FROM bid WHERE resever='$username' AND status='unread'";
		$response = $db->query($check_not);
		$data = $response->fetch_assoc();
			$num = $data['noti'];
		if($num !=0)
		{
			
			$notification_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/pages/php/notification_main.php" class="nav-link font-weight-bold"><i class="fa fa-bell"></i><sup class="text-danger">'.$num.'</sup> Notifications</a></li>';
		}
		else
		{
			$notification_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/pages/php/notification_main.php" class="nav-link font-weight-bold"><i class="fa fa-bell"></i> Notifications</a></li>';
			
		}
}
else
{
	 $login_btn = '<li class="nav-item"><a href="login.php" class="nav-link font-weight-bold">Login</a></li>';
	 $signup_btn = '<li class="nav-item"><a href="signup.php" class="nav-link font-weight-bold">Signup</a></li>';
	 $cart_btn = "";
}

echo '<nav class="navbar navbar-expand-lg sticky-top shadow-sm bg-white">
	<a href="http://localhost/bookstore/shop/" class="navbar-brand font-weight-bold">bookstore.com</a>
	<i class="fa fa-bars navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" style="font-size: 25px"></i>
	<div class="collapse navbar-collapse" id="navbar-collapse">
	<ul class="navbar-nav ml-auto">
		<li class="nav-item"><a href="http://localhost/bookstore/shop/index.php" class="nav-link font-weight-bold active">Home</a></li>
		
		
		'.$notification_btn.$cart_btn.$login_btn.$signup_btn.'
		
	</ul>
	</div>
</nav>';


?>