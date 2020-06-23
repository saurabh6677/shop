<?php
require_once("../../common_files/database/database.php");

$search = $_GET['search'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="view-port" content="width=device-width, initial-scale=1">
	<title>Welcome</title>
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/animate.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/fontawesome.min.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/css/index.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="http://localhost/bookstore/shop/common_files/js/jquery.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/popper.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/bootstrap.min.js"></script>
	<script src="http://localhost/bookstore/shop/js/index.js"></script>
	
</head>
<body>

<?php
require_once("../../assist/nav.php");
?>

<div class="container-fluid my-3 shadow-sm">
	<div class="row">
		<?php
		$product = "SELECT * FROM products WHERE title LIKE '%$search%'";
		$response = $db->query($product);
		if($response->num_rows !=0)
		{
			while($data = $response->fetch_assoc())
			{
				$seller = $data['username'];
				$get_name = "SELECT fullname FROM users WHERE email='$seller'";
				$name_response = $db->query($get_name);
				$data_name = $name_response->fetch_assoc();
				$name = $data_name['fullname'];
				echo "<div class='col-md-3  p-3'>
				<div class='shadow-lg rounded-lg pb-3' align='center'>
				<img src='../../products/".$data['thumb']."' alt='".$data['title']."' class='mt-2 shadow-lg' style='border:5px solid #fff'>
				<p class='text-center text-uppercase font-weight-bold p-0 m-0'>".$data['category']."</p>
				<p class='text-center text-capitalize font-weight-bold p-0 m-0'>Title : ".$data['title']."</p>
				<p class='text-center p-0 m-0'>Price  : <i class='fa fa-rupee'></i> ".$data['price']."</p>
				<p class='text-center p-0 m-0 font-weight-bold text-danger'>Saller : ".$name."</p>
				<button class='btn btn-primary buy-btn' product-id='".$data['id']."'><i class='fa fa-shopping-bag'></i> Buy Now</button>
				<button class='btn btn-danger cart-btn' product-id='".$data['id']."'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
				</div>
				</div>";
			}
		}
		else
		{
			echo "No result Found";
		}


		?>
	</div>
</div>
<?php
require_once("../../assist/footer.php");

?>
<script>
	$(document).ready(function(){
		
			$(".buy-btn").each(function(){
			$(this).click(function(){
				var product_id = $(this).attr("product-id");
				window.location = "http://localhost/bookstore/shop/pages/php/buy_product_design.php?product_id="+product_id;
			});
		});
		
		
	});</script>
</body> 
</html>

