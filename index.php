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
	<link rel="stylesheet" href="css/index.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="common_files/js/jquery.js"></script>
	<script src="common_files/js/popper.js"></script>
	<script src="common_files/js/bootstrap.min.js"></script>
	
</head>
<body>

<?php
require_once("assist/nav.php");
?>
<div class="container-fluid my-3 shadow-sm">
	<div class="row">
<?php
$get_data = "SELECT * FROM products";
$response = $db->query($get_data);
if($response)
{
	while($data = $response->fetch_assoc())
	{
		echo "<div class='col-md-3  p-3'>
		<div class='shadow-lg rounded-lg pb-3' align='center'>
		<img src='products/".$data['thumb']."' alt='".$data['title']."'>
		<p class='text-center text-uppercase font-weight-bold p-0 m-0'>".$data['category']."</p>
		<p class='text-center text-capitalize font-weight-bold p-0 m-0'>Title : ".$data['title']."</p>
		<p class='text-center p-0 m-0'>Price  : <i class='fa fa-rupee'></i> ".$data['price']."</p>
		<p class='text-center p-0 m-0'>Upload date ".$data['upload_date']."</p>
		<button class='btn btn-primary'><i class='fa fa-shopping-bag'></i> Buy Now</button>
		<button class='btn btn-danger'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
		</div>
		</div>";
	}
}

?>
</div>
</div>
<?php
require_once("assist/footer.php");

?>
</body>
</html>

