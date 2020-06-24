
<html>
<style>
	.search:focus{
		box-shadow: none !important;
	}
	.search{
		border: none;
	}
</style>

<body>
	
</body>
<script>
	$(document).ready(function(){
		$(".search-btn").click(function(){
			var search = $(".search").val();
			window.location = "http://localhost/bookstore/shop/search/"+search.trim();
		});
	});
</script>
</html>

<?php
$login_btn = "";
$signup_btn = "";
$username = "";
$notification_btn = "";



if(!empty($_COOKIE['_bk_']))
{
	$username = base64_decode($_COOKIE['_bk_']);
	 $login_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/dashbord" class="nav-link font-weight-bold"><i class="fa fa-tachometer"></i> Dashboard</a></li>';
	 $signup_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/pages/php/logout.php" class="nav-link font-weight-bold"><i class="fa fa-sign-out"></i> Logout</a></li>';
	 $get_cart = "SELECT COUNT(id) AS cno FROM cart WHERE username='$username'";
	 $response_cart = $db->query($get_cart);
		 if($response_cart && $response_cart->num_rows !=0)
		 {

		 	$data_cart = $response_cart->fetch_assoc();
		 	$c_no = $data_cart['cno'];
		 	 
		 	 if($c_no !=0)
		 	 {
		 	 	$cart_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/cart" class="nav-link font-weight-bold"><i class="fa fa-shopping-cart text-primary"></i><sup class="cart-sup text-danger ml-1">'.$c_no.'</sup> Cart</a></li>';
		 	 }

			 else 
			 {
				 $cart_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/cart" class="nav-link font-weight-bold"><i class="fa fa-shopping-cart text-primary"></i><sup class="cart-sup text-danger ml-1"></sup> Cart</a></li>';
			 }
		 }

		$cart_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/cart" class="nav-link font-weight-bold"><i class="fa fa-shopping-cart text-primary"></i><sup class="cart-sup text-danger ml-1"></sup> Cart</a></li>';
	 
	 $check_not = "SELECT COUNT(id) AS noti FROM bid WHERE resever='$username' AND status='unread'";
		$response = $db->query($check_not);
		if($response)
		{
		$data = $response->fetch_assoc();
			$num = $data['noti'];
		if($num !=0)
		{
			
			$notification_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/notification" class="nav-link font-weight-bold"><i class="fa fa-bell"></i><sup class="text-danger">'.$num.'</sup> Notifications</a></li>';
		}
		else
		{
			$notification_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/notification" class="nav-link font-weight-bold"><i class="fa fa-bell"></i> Notifications</a></li>';
			
		}
	}
}
else
{
	 $login_btn = '<li class="nav-item"><a href="http://localhost/bookstore/shop/login.php" class="nav-link font-weight-bold">Login</a></li>';
	 $signup_btn = '<li class="nav-item"><a href=http://localhost/bookstore/shop/signup.php" class="nav-link font-weight-bold">Signup</a></li>';
	 $cart_btn = "";
}

echo '<nav class="navbar navbar-expand-lg sticky-top shadow-sm bg-white">
	<a href="http://localhost/bookstore/shop/" class="navbar-brand font-weight-bold">bookstore.com</a>
	<i class="fa fa-bars navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" style="font-size: 25px"></i>
	<div class="collapse navbar-collapse" id="navbar-collapse">
	<ul class="navbar-nav ml-auto">
		<li class="nav-item"><a href="http://localhost/bookstore/shop/index.php" class="nav-link font-weight-bold active">Home</a></li>

		
		
		'.$notification_btn.$cart_btn.$login_btn.$signup_btn.'
		<li class="nav-item">
		<div class="btn-group">
		<button class="btn p-0 px-1 m-0" style="border: 2px solid #007bff !important;">
		<input type="search" class="form-control search p-0 m-0" name="search" placeholder="search here">
		</button>
		<button class="btn p-0 m-0 px-2 search-btn" style="border: 2px solid #007bff !important">
		<i class="fa fa-search text-primary"></i>
		</button>
		</div>
		</li>
		
	</ul>
	</div>
</nav>';


?>