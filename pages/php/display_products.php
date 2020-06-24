<?php
require_once("../../common_files/database/database.php");
$start = $_POST['start'];
$end = $_POST['end'];
$result = [];
$get_data = "SELECT * FROM products  LIMIT $start,$end";
$response = $db->query($get_data);


if($response)
{
	while($data = $response->fetch_assoc())
	{
		$seller = $data['username'];
		$get_name = "SELECT fullname FROM users WHERE email='$seller'";
		$name_response = $db->query($get_name);
		$data_name = $name_response->fetch_assoc();
		$name = $data_name['fullname'];
		$data = "<div class='col-md-3  p-3'>
		<div class='shadow-lg rounded-lg pb-3' align='center'>
		<img src='products/".$data['thumb']."' alt='".$data['title']."' class='mt-2 shadow-lg' style='border:5px solid #fff'>
		<p class='text-center text-uppercase font-weight-bold p-0 m-0'>".$data['category']."</p>
		<p class='text-center text-capitalize font-weight-bold p-0 m-0'>Title : ".$data['title']."</p>
		<p class='text-center p-0 m-0'>Price  : <i class='fa fa-rupee'></i> ".$data['price']."</p>
		<p class='text-center p-0 m-0 font-weight-bold text-danger'>Saller : ".$name."</p>
		<button class='btn btn-primary buy-btn' product-id='".base64_encode($data['id'])."'><i class='fa fa-shopping-bag'></i> Buy Now</button>
		<button class='btn btn-danger cart-btn' product-id='".base64_encode($data['id'])."'><i class='fa fa-shopping-cart'></i> Add to Cart</button>
		</div>
		</div>";
		array_push($result, $data);
	}
	$script = '<script>$(document).ready(function(){
		
			$(".buy-btn").each(function(){
			$(this).click(function(){
				var product_id = $(this).attr("product-id");
				window.location = "books/"+product_id;
			});
		});
		
		
	});
		// add to cart code

$(document).ready(function(){
	$(".cart-btn").each(function(){
		$(this).click(function(){
			var product_id = $(this).attr("product-id");
			$.ajax({
				type : "POST",
				url : "http://localhost/bookstore/shop/pages/php/add_to_cart.php",
				data : {
					product_id : product_id
				},
				beforeSend : function(){
					$(this).html("Please wait..");
				},
				success : function(response){
					if(response.trim() == "success")
					{
						var num = Number($(".cart-sup").html());
						num++;
						$(".cart-sup").html(num);
					}
					else if(response.trim() == "unable to add cart" || response.trim() == "This product already in your cart")
					{
						alert(response.trim());
					}
					else
					{
						
						window.location = "http://localhost/bookstore/shop/login.php";
					}
				}
			});
		});
	});
});
	</script>';
	array_push($result, $script);

	echo json_encode($result);
}

?>