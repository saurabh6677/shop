<?php
require_once("../../common_files/database/database.php");
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
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/animate.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/common_files/css/fontawesome.min.css">
	<link rel="stylesheet" href="http://localhost/bookstore/shop/css/index.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="http://localhost/bookstore/shop/common_files/js/jquery.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/popper.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/bootstrap.min.js">
	</script>

	
</head>
<body>

<?php
require_once("../../assist/nav.php");

?>

<div class="container-fluid my-3 p-3 shadow-sm">
	<div class="row">
<?php
	$get_id = "SELECT product_id FROM cart WHERE username='$username' ORDER BY id DESC";
	$response = $db->query($get_id);
	$msg = "";
	if($response && $response->num_rows !=0)
	{
		while($data = $response->fetch_assoc())
		{
			$product_id = $data['product_id'];
			$get_products = "SELECT * FROM products WHERE id='$product_id' AND username='$username'";
			$response_pro = $db->query($get_products);
			if($response_pro->num_rows != 0)
			{
				 $data_pro = $response_pro->fetch_assoc();
				 $title = $data_pro['title'];
				 $category = $data_pro['category'];
				 $price = $data_pro['price'];
				 $thumb = $data_pro['thumb'];
				 $date = $data_pro['upload_date'];
				 $uploaded_date = date_create($date);
				 $uploaded_date = date_format($uploaded_date,'d/m/Y');

				 echo "<div class='col-md-3  p-3'>
		<div class='shadow-lg rounded-lg pb-3' align='center'>
		<img src='http://localhost/bookstore/shop/products/".$thumb."' alt='".$title."' class='mt-2 shadow-lg' style='border:5px solid #fff'>
		<p class='text-center text-uppercase font-weight-bold p-0 m-0'>".$category."</p>
		<p class='text-center text-capitalize font-weight-bold p-0 m-0'>Title : ".$title."</p>
		<p class='text-center p-0 m-0'>Price  : <i class='fa fa-rupee'></i> ".$price."</p>
		<button class='btn btn-primary buy-btn' product-id='".base64_encode($data_pro['id'])."'><i class='fa fa-shopping-bag'></i> Buy Now</button>
		<button class='btn btn-danger delete-btn' product-id='".base64_encode($data_pro['id'])."'><i class='fa fa-trash'></i> Delete</button>
		</div>
		</div>";
			}
			else
			{
				$msg =  "<div class='col-md-3  p-3'>
			<div class='shadow-lg rounded-lg pb-3' align='center'>
			<p class='text-center p-0 m-0 text-danger'>This product removed By seller</p>
			<button class='btn btn-danger delete-btn' product-id='".base64_encode($product_id)."'><i class='fa fa-trash'></i> Delete</button>
			</div>
			</div>";
			}
			
		}
		echo $msg;	
	}
	else
	{
		echo "<center class='text-danger mx-auto font-weight-bold text-capitalize'>No <a href='../../'>tiems</a> found in your cart</center>";
	}

?>
</div>
</div>
<?php
require_once("../../assist/footer.php");

?>
<script>
	//buy btn code 

	$(document).ready(function(){
		
			$(".buy-btn").each(function(){
			$(this).click(function(){
				var product_id = $(this).attr("product-id");
				window.location = "http://localhost/bookstore/shop/books/"+product_id;
			});
		});
		$(".delete-btn").each(function(){
			$(this).click(function(){
				var product_id = $(this).attr("product-id");
				var btn = this;
				$.ajax({
					type : "POST",
					url : "http://localhost/bookstore/shop/pages/php/delete_cart.php",
					data : {
						product_id : product_id
					},
					beforeSend : function()
					{
						$(btn).html("wait..");
					},
					success : function(response)
					{
						$(btn).html("<i class='fa fa-trash'></i> Delete");
						if(response.trim() == "success")
						{
							var div = btn.parentElement.parentElement;
							$(div).remove();
							var num = Number($(".cart-sup").html());
							num--;
							$(".cart-sup").html(num);
						}
						else
						{
							alert(response);
						}
					}
				});
			});
		});
		
		
	});
</script>
</body>
</html>