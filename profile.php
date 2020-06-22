
<?php
require_once("common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
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
	<link rel="stylesheet" href="css/index.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="common_files/js/jquery.js"></script>
	<script src="common_files/js/popper.js"></script>
	<script src="common_files/js/bootstrap.min.js"></script>
	<script src="js/index.js"></script>
	
</head>
<body class="position-relative">

<?php
require_once("assist/nav.php");
?>
<div class="position-fixed d-lg-none d-flex d-md-block w-100 left-0 main-menu" style="z-index: 1;">
			<div class=" p-3 w-75 mobile-menu mt-2 bg-white shadow-lg mb-3" style="border-right: 5px solid blue;border-bottom: 5px solid blue">
			<button class="btn font-weight-bold add-book-btn menu" link="pages/php/upload_book_design.php"><a href="#" class="text-primary text-decoration-none" style="font-size: 18px"><i class="fa fa-plus "></i> Sell Books</a></button><br>
		
			<button class="btn font-weight-bold menu edit-profile-btn" link="pages/php/edit_profile_design.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-edit "></i> Edit Profile </a></button>
			<br>
			<button class="btn font-weight-bold menu my-products-btn" link="pages/php/my_books_design.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-book "></i> My Books </a></button>
			<br>
			<button class="btn font-weight-bold menu notification-btn" link="pages/php/notification.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-bell"></i> Notification </a></button><br>
			<button class="btn font-weight-bold menu request-btn" link="pages/php/request_design.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-request"></i> Requests </a></button>
			<br>
		</div>
	</div>
	<div class="w-25 pl-2 d-lg-none d-flex bg-dark align-items-center"><i class="fa fa-cog mobile-menu-icon" style="font-size: 35px;color: red;top: 300px;
	z-index: 2;position: fixed;top: 320px;left: 0"></i>
	</div>
<div class="container-fluid my-4" >
	<div class="row">
		<div class="col-md-5 p-3 d-none d-lg-block shadow-lg mb-3" style="border-right: 5px solid blue">
			<button class="btn font-weight-bold add-book-btn menu" link="pages/php/upload_book_design.php"><a href="#" class="text-primary text-decoration-none" style="font-size: 18px"><i class="fa fa-plus "></i> Sell Books</a></button><br>
		
			<button class="btn font-weight-bold menu edit-profile-btn" link="pages/php/edit_profile_design.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-edit "></i> Edit Profile </a></button>
			<br>
			<button class="btn font-weight-bold menu my-products-btn" link="pages/php/my_books_design.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-book "></i> My Books </a></button>
			<br>
			<button class="btn font-weight-bold menu notification-btn" link="pages/php/notification.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-bell"></i> Notification </a></button><br>
			<button class="btn font-weight-bold menu request-btn" link="pages/php/request_design.php"><a href="#" class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-request"></i> Requests </a></button>
		</div>
		
		<div class="col-md-6 mb-3" style="z-index:-1">
			<div class="container py-3  shadow-lg dynamic-result" style="border-left: 5px solid blue">
			
			</div>
		</div>
	</div>
</div>

<?php
require_once("assist/footer.php");

?>



<script>
	$(document).ready(function(){
		var button_edit = document.getElementsByClassName("edit-profile-btn");
			$(button_edit).click();
	});
	$(document).ready(function(){
		 var window_height = $(window).height();
		$(".mobile-menu").css({
			height : window_height+"px"
		});

		$(".mobile-menu button").each(function(){
			$(this).click(function(){
				$(".mobile-menu").fadeOut(1000);
			});
		});
		$(".mobile-menu-icon").each(function(){
			$(this).click(function(){
				var icon = this;
				$(this).addClass("fa-spin");
				$(".mobile-menu").toggle(2000,function(e){
					$(".mobile-menu-icon").removeClass("fa-spin");
				});
				
			});
			
		});
	});
</script>
</body>
</html>

