
<?php
require_once("common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
$get_name = "SELECT fullname FROM users WHERE email='$username'";
$name_response = $db->query($get_name);
$name = $name_response->fetch_assoc();
$name = $name['fullname'];
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
			<button class="btn font-weight-bold add-book-btn menu" link="pages/php/upload_book_design.php"><a class="text-primary text-decoration-none" style="font-size: 18px"><i class="fa fa-plus "></i> Sell Books</a></button><br>
		
			<button class="btn font-weight-bold menu edit-profile-btn" link="pages/php/edit_profile_design.php"><a class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-edit "></i> Edit Profile </a></button>
			<br>
			<button class="btn font-weight-bold menu my-products-btn" link="pages/php/my_books_design.php"><a  class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-book "></i> My Books </a></button>
			<br>
			<button class="btn font-weight-bold menu request-btn" link="pages/php/request_design.php"><a class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-paper-plane"></i> Requests </a></button>
			<br>
		</div>
	</div>
	<div class="w-25 pl-2 d-lg-none d-flex bg-dark align-items-center"><i class="fa fa-cog mobile-menu-icon" style="font-size: 35px;color: red;top: 300px;
	z-index: 2;position: fixed;top: 320px;left: 0"></i>
	</div>
<div class="container-fluid my-4" >
	<div class="row">
		<div class="col-md-12 mt-2 mb-4" >
			<div class="p-4 shadow-lg" style="border-left: 5px solid blue;border-right:5px solid blue">
				<p class="p-0 m-0 text-center font-weight-bold text-primary">WELCOME BACK</p>
				<p class="p-0 m-0 text-center text-capitalize font-weight-bold text-primary"><?php echo $name;?></p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-5 p-3 d-none d-lg-block shadow-lg mb-3" style="border-right: 5px solid blue">
			<button class="btn font-weight-bold add-book-btn menu" link="pages/php/upload_book_design.php"><a  class="text-primary text-decoration-none" style="font-size: 18px"><i class="fa fa-plus "></i> Sell Books</a></button><br>
		
			<button class="btn font-weight-bold menu edit-profile-btn" link="pages/php/edit_profile_design.php"><a  class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-edit "></i> Edit Profile </a></button>
			<br>
			<button class="btn font-weight-bold menu my-products-btn" link="pages/php/my_books_design.php"><a  class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-book "></i> My Books </a></button>
			<br>
			
			<button class="btn font-weight-bold menu request-btn" link="pages/php/request_design.php"><a class="text-primary text-decoration-none"   style="font-size: 18px"><i class="fa fa-paper-plane"></i> Requests </a></button>

		</div>
		
		<div class="col-md-6 mb-3">
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
		var button_edit = document.getElementsByClassName("request-btn");
			$(button_edit).click();
	});
	$(document).ready(function(){
		if($(window).width() < 768)
		{
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
		}
	});

	// notification

//request page code

		$(document).ready(function(){

		// close btn code
		$(".close-btn").each(function(){
			$(this).click(function(){
				var id = $(this).attr("name");
				var close_btn = this;
				var status = "read";
				var div = close_btn.parentElement;
							$(div).hide();
				/*$.ajax({
					type : "POST",
					url : "http://localhost/bookstore/shop/pages/php/read_notification.php",
					data : {
						id : id,
						status : btoa(status)
					},
					success : function(response)
					{
						if(response.trim() == "success")
						{
							var div = close_btn.parentElement;
							$(div).hide();
						}
						else
						{
							alert(response);
						}
					}
				}); */
			});
		});

		//end close btn code

		// accept btn code
		$(".accept-btn").each(function(){
			$(this).click(function(){
				var id = $(this).attr("name");
				var close_btn = this;
				var status = "accept";
				var r_comment = $(".r_comment").val();
				if(r_comment != "")
				{
					$.ajax({
						type : "POST",
						url : "http://localhost/bookstore/shop/pages/php/read_notification.php",
						data : {
							id : id,
							status : btoa(status),
							r_comment : r_comment
						},
						success : function(response)
						{
							if(response.trim() == "success")
							{
								var div = close_btn.parentElement;
								$(div).html("");
								$(div).removeClass("alert-danger");
								$(div).addClass("bg-white");
								var msg = document.createElement("div");
								msg.className = "p-5 w-100 shadow-lg text-center";
								msg.style.borderLeft = "5px solid green";
								var i =  document.createElement("i");
								i.className = "fa fa-check-circle text-success";
								i.style.fontSize = "35px";
								var p = document.createElement("p");
								p.className = "text-success p-3";
								p.innerHTML = "Thank You For Accepting This Request. <br><br><span class='float-right' style='margin-bottom:0'>Regards :<br><b>Team Bookstore</b></span>";
								$(div).append(msg);
								$(msg).append(i);
								$(msg).append(p);
								
								
							}
							else
							{
								alert(response);
							}
						}
					});
				}
				else
				{
					alert("write something in comment");
				}
			});
		});

		//accept close btn code
		// reject btn code
		$(".reject-btn").each(function(){
			$(this).click(function(){
				var id = $(this).attr("name");
				var close_btn = this;
				var status = "reject";
				var r_comment = $(".r_comment").val();
				if(r_comment != "")
				{
					$.ajax({
						type : "POST",
						url : "http://localhost/bookstore/shop/pages/php/read_notification.php",
						data : {
							id : id,
							status : btoa(status),
							r_comment : r_comment
						},
						success : function(response)
						{
							if(response.trim() == "success")
							{
								var div = close_btn.parentElement;
								$(div).html("");
								$(div).removeClass("alert-danger");
								$(div).addClass("bg-white");
								var msg = document.createElement("div");
								msg.className = "p-5 w-100 shadow-lg text-center";
								msg.style.borderLeft = "5px solid red";
								var i =  document.createElement("i");
								i.className = "fa fa-times-circle text-danger";
								i.style.fontSize = "35px";
								var p = document.createElement("p");
								p.className = "text-danger p-3";
								p.innerHTML = "Thank You For Your Opinion. <br><br><span class='float-right' style='margin-bottom:0'>Regards :<br><b>Team Bookstore</b></span>";
								$(div).append(msg);
								$(msg).append(i);
								$(msg).append(p);
							}
							else
							{
								alert(response);
							}
						}
					});
				}
				else
				{
					alert("write something in comment");
				}
			});
		});

		//reject btn code
		//edit btn code

		$(".edit-btn").each(function(){
			$(this).click(function(){
				$(this).addClass("d-none");
				var lable = this.parentElement.children[4];
				var input = this.parentElement.children[5];
				var accept_btn = this.parentElement.children[6];
				var reject_btn = this.parentElement.children[7];
				$(accept_btn).removeClass("d-none");
				$(reject_btn).removeClass("d-none");
				$(input).removeClass("d-none");
				$(lable).removeClass("d-none");
			});
		});
	});
</script>
</body>
</html>

