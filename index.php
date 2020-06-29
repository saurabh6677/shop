<?php
require_once("common_files/database/database.php");


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, inital-scal=1.0">
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
	<style>
		/* .buy-btn{
			
			background: deeppink;
			border : 2px solid deeppink !important;
			border-radius: 20px 0px 20px 0px !important;
			font-weight: bold !important;
			color: #fff !important;
		}
		.buy-btn:hover{
			background: #fff !important;
			border : 2px solid deeppink !important;
			color: deeppink !important;
		}
		.cart-btn{
			
			background: blue;
			border : 2px solid blue !important;
			border-radius: 20px 0px 20px 0px !important;
			font-weight: bold !important;
			color: #fff !important;
		}
		.cart-btn:hover{
			background: #fff !important;
			border : 2px solid blue !important;
			color: blue !important;
		}

		*/
	</style>
</head>
<body>

<?php
require_once("assist/nav.php");
?>
<div class="container-fluid">
	<div class="row ">
		<div class="col-md-12 p-0 m-0">
			<?php require_once("assist/slider.php");?>
		</div>
</div>
<div class="container-fluid my-3 shadow-sm">
	<div class="row result">
		<div class="col-md-3 shadow-lg">
			<h4 class="text-center mt-2 text-danger">Filter Products</h4>
			<hr>
			<p>Filter By City Name</p>
			<div class="btn-group border w-100">
				<button class="btn">
			<select class="form-control city">
				<?php
				$get_city = "SELECT DISTINCT city FROM users";
				$city_response = $db->query($get_city);
				if($city_response)
				{
					while($data =$city_response->fetch_assoc())
					{
						echo "<option>".$data['city']."</option>";
					}
				}

				?>
				
			</select>
			</button>
			<button class="btn city-btn btn-primary">Get</button>
		</div>
		<hr>
		<p>Filter By Price</p>
		<div class="btn-group w-100 mb-3">
			<button class="btn p-0 w-25"><input type="number" name="price" placeholder="min" class="form-control min"></button>
			<button class="btn p-0 w-25"><input type="number" name="price" placeholder="max" class="form-control max"></button>
			<button class="btn p-0 w-25 price-btn btn-danger">GET</button>
		</div>
		</div>
	</div>
</div>
</div>

<?php
require_once("assist/footer.php");

?>
<script>

</script>
</body> 
</html>

