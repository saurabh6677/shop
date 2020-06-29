<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
$username = htmlspecialchars($username);
$username = mysqli_real_escape_string($db,$username);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
$get_you_name = $db->prepare("SELECT fullname FROM users WHERE email=?");
$get_you_name->bind_param('s',$username);
$get_you_name->execute();
$response_sender_name = $get_you_name->get_result();
if($response_sender_name)
{
	$fullname_data =  $response_sender_name->fetch_assoc();
	$fullname_sender =  $fullname_data['fullname'];
}
$product_id = base64_decode($_GET['product_id']);
$product_id = htmlspecialchars($product_id);
$product_id = mysqli_real_escape_string($db,$product_id);
$title = "";
$category = "";
$price = "";
$thumb = "";
$seller = "";
$name = "";
$country = "";
$city = "";
$state = "";
$pincode = "";
$district = "";
$address = "";
$uploaded_date = "";
$get_details = $db->prepare("SELECT * FROM products WHERE id=?");
$get_details->bind_param('i',$product_id);
$get_details->execute();
$response = $get_details->get_result();
if($response->num_rows !=0)
{
 $data = $response->fetch_assoc();
 $title = $data['title'];
 $category = $data['category'];
 $price = $data['price'];
 $thumb = $data['thumb'];
 $date = $data['upload_date'];
 $uploaded_date = date_create($date);
 $uploaded_date = date_format($uploaded_date,'d/m/Y');
 $seller = $data['username'];
 $get_contact = "SELECT * FROM users WHERE email='$seller'";
	$response = $db->query($get_contact);
	if($response)
	{
		$data = $response->fetch_assoc();
		$name = $data['fullname'];
		$country = $data['country'];
		$city = $data['city'];
		$state =$data['state'];
		$pincode = $data['pincode'];
		$district = $data['district'];
		$address = $data['address'];
	}
}
else
{
	header("Location:http://localhost/bookstore/shop/error");
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
	<script src="http://localhost/bookstore/shop/common_files/js/bootstrap.min.js"></script>
	
	
</head>
<body>

<?php
require_once("../../assist/nav.php");
?>
<div class="container-fluid my-3 p-3 shadow-sm">
	<div class="row">
	<div class="col-md-4 p-3 d-flex justify-content-center bg-white">
		
		<div class="media">
		<img src="http://localhost/bookstore/shop/products/<?php echo $thumb;?>" class="shadow-lg" style="border:5px solid #fff">
		</div>
		</div>
		<div class="col-md-4 p-4 mb-3 d-flex justify-content-center">
		<div>
		<h4 class="text-center text-danger">Book Details</h4>
		<p class="text-uppercase font-weight-bold mt-3">Book Title : <?php echo $title;?></p>
		<p class="text-capitelize font-weight-bold mt-3">Language : <?php echo $category;?></p>
		<p class="text-capitelize font-weight-bold mt-3">Price : <i class="fa fa-rupee"></i> <?php echo $price;?></p>
		<p class="text-capitelize mt-3">Last Update : <?php echo $uploaded_date	;?></p>
		<p class="text-capitelize mt-3">Saller Name : <?php echo $name	;?></p>
		<p class="text-capitelize mt-3">City : <?php echo $city	;?></p>
		</div>
		</div>
	
	<div class="col-md-4 px-4 mb-3 d-flex justify-content-center">
		<div>
		<h4 class="text-center text-uppercase text-primary">Send Prposel To Seller</h4>
		<form class="prposel-form">
			<div class="form-group">
				<label form="price">Price <i class="fa fa-rupee"></i></label>
				<input type="number" placeholder="100" name="price" class="form-control " id="price">
			</div>
			<div class="form-group">
				<label form="comment">Comment <i class="fa fa-massage"></i></label>
				<textarea rows="4" name="comment" class="form-control" id="comment">I am ready to buy this product. call me now</textarea>
			</div>
			<input type="email" class="d-none" name="sender" value="<?php echo $username;?>">
			<input type="email" class="d-none" name="resever" value="<?php echo $seller;?>">
			<input type="text" class="d-none" name="sender_name" value="<?php echo $fullname_sender;?>">
			<input type="text" class="d-none" name="resever_name" value="<?php echo $name;?>">
			<input type="text" class="d-none" name="product_id" value="<?php echo $product_id;?>">
			<button class="btn btn-warning text-light font-weight-bold send btn">Send Now</button>
		</form>
		<div class="pr-notice"></div>
		</div>
	</div>	
	</div>
</div>
<?php
require_once("../../assist/footer.php");

?>
<script>
	$(document).ready(function(){
		$(".prposel-form").submit(function(e){
			e.preventDefault();
			$.ajax({
				type : "POST",
				url : "http://localhost/bookstore/shop/pages/php/prposel.php",
				data : new FormData(this),
				processData : false,
				contentType : false,
				cache : false,
				beforeSend : function(){
					$(".send-btn").attr("disabled", "disabled");
					$(".send-btn").html("wait...");
				},
				success : function(response)
				{
					if(response.trim() != "Sorry something went wrong else You are the owner this book, All field required")
					{
						$(".send-btn").html("Send Now");
						$(".send-btn").removeAttr("disabled");
						$(".prposel-form").addClass("d-none");
						var div = document.createElement("DIV");
						div.className = "alert-success p-4 my-3 shadow-lg";
						div.innerHTML = response;
						$(".pr-notice").append(div);
						
					}
					else
					{
						$(".send-btn").html("Send Now");
						$(".send-btn").removeAttr("disabled");
						var div = document.createElement("DIV");
						div.className = "alert-danger p-4 my-3";
						div.innerHTML = response;
						$(".pr-notice").append(div);
						setTimeout(function(){
							$(".pr-notice").html("");
							$(".prposel-form").trigger("reset");
						}, 4000);	
					}
					
				}
			});
		});
	});
</script>
</body> 
</html>
