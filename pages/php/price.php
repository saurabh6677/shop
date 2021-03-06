<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}

$max = $_GET['max'];
$min = $_GET['min'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scale=1.0">
	<title>Welcome</title>
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/animate.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/fontawesome.min.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/css/index.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="http://localhost/bookstore/shop/common_files/js/jquery.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/popper.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/bootstrap.min.js"></script>
</head>
<body>

<?php
require_once("../../assist/nav.php");
?>
<div class="container-fluid">
	<div class="row ">
		<div class="col-md-12 p-0 m-0">
			<?php require_once("../../assist/slider.php");?>
		</div>
</div>
<div class="container-fluid my-3 shadow-sm">
	<h2 class="text-center py-2 text-primary text-capitalize mt-2 city">Price Between :  <i class="fa fa-rupee"></i> <small class="min"><?php echo $min?></small> -  <i class="fa fa-rupee"></i> <small class="max"><?php echo $max?></small> </h2>
	<div class="row result">
		
	</div>
</div>
</div>

<?php
require_once("../../assist/footer.php");

?>
<script>
 // short by price
	 $(document).ready(function(){
	 	
	 		var min = $(".min").html().trim();
	 		var max = $(".max").html().trim();
	 		console.log(min);

	 		if(min !="" && max !="")
	 		{
					var width = $(window).width();
					if(width <768)
					{
							var start = 0;
							var end = 3;
						dynamic_load(start,end);
					$(".result").html("");
						function dynamic_load(start,end)
						{

							$.ajax({
								type : "POST",
								url : "short_by_price.php",
								cache : false,  
								data : {
									start : Number(start),
									end : Number(end),
									min : Number(min),
									max : Number(max)
								},
								success : function(response)
								{
									
									var all_data = JSON.parse(response.trim());
									$(".result").append(all_data);
								}
							});
						}
						$(window).scroll(function(){
							var scroll_top = $(window).scrollTop();
							var browser_height = $(window).height();
							var webpage_height = $(document).height();
							var max_height = scroll_top+browser_height;
							if(max_height >webpage_height-700)
							{
								start = start+end;
								
								dynamic_load(start,end)

							}
						});
					}
					else if(width >768)
					{
						var start = 0;
						var end = 7;
						dynamic_load(start,end);
					$(".result").html("");
						function dynamic_load(start,end)
						{
							$.ajax({
								type : "POST",
								url : "short_by_price.php",
								cache : false,
								data : {
									start : Number(start),
									end : Number(end),
									min : Number(min),
									max : Number(max)
								},
								success : function(response)
								{
									
									var all_data = JSON.parse(response.trim());
									$(".result").append(all_data);
								}
							});
						}
						$(window).scroll(function(){
							var scroll_top = $(window).scrollTop();
							var browser_height = $(window).height();
							var webpage_height = $(document).height();
							var max_height = scroll_top+browser_height;
							if(max_height >webpage_height-200)
							{
								start = start+end;
								dynamic_load(start,end)

							}
						});
				 }
			}
			else
			{
				alert("please enter min and max price");
			}
	 	
	 });

	 // end short by price
</script>
</body> 
</html>

