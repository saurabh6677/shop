<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
$city = $_GET['city'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<title>Welcome</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
	<h2 class="text-center py-2 text-primary text-capitalize mt-2 city"><?php echo $city?></h2>
	<div class="row result">
		
	</div>
</div>
</div>

<?php
require_once("../../assist/footer.php");

?>
<script>
 // start short by city

	 $(document).ready(function(){
	 	
	 		var city = $(".city").html();
	 		console.log(city);
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
							url : "short_by_city.php",
							cache : false,  
							data : {
								start : start,
								end : end,
								city : city.trim()
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
							url : "short_by_city.php",
							cache : false,
							data : {
								start : start,
								end : end,
								city : city.trim()
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
			

	 });

	

// end short by city
</script>
</body> 
</html>

