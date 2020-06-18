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
<div class="container-fluid shadow-lg bg-white my-4">
	<div class="row">
		<div class="col-md-5 p-3 shadow-lg mb-3">
			<button class="btn font-weight-bold add-book-btn"><a href="#" class="text-primary text-decoration-none" style="font-size: 18px"><i class="fa fa-plus "></i> Add Books</a></button><br>
			<button class="btn font-weight-bold complete-profile-btn"><a href="#" class="text-primary text-decoration-none" style="font-size: 18px"><i class="fa fa-check "></i>  Complete Your Profile </a></button><br>
			<button class="btn font-weight-bold edit-profile-btn"><a href="#" class="text-primary text-decoration-none" style="font-size: 18px"><i class="fa fa-edit "></i> Edit Profile </a></button>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-6 mb-3">
			<div class="container py-3 shadow-lg">
				<h4 class="text-primary">UPLAOD A BOOK</h4>
				<form class="upload-form">
					<div class="form-group">
						<label for="book-name">Book Title</label>
						<input type="text" name="book_name" placeholder="book name" class="form-control w-75" required="required" id="book-name">
					</div>
					<div class="form-group">
						<label for="book-cat">Select Category</label>
						<select name="book-cat" class="form-control w-75" id="book-cat" required="required">
							<option>Chosse category</option>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Price <i class="fa fa-rupee"></i></label>
						<input type="text" name="price" placeholder="100" class="form-control w-75" required="required" id="price">
					</div>
					<div class="form-group">
						<label for="thumb">Picture <i class="fa fa-image"></i></label><br>
						
						<input type="file" accept="image" name="thumb" class="form-control w-75" required="required" id="thumb">
					</div>
					<button  type="submit" class="btn btn-primary upload-btn">Upload</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
require_once("assist/footer.php");

?>

<script>
	$(document).ready(function(){
		$(".upload-form").submit(function(e){
			e.preventDefault();
			$.ajax({
				type : "POST",
				url : "pages/php/upload.php",
				data : new FormData(this),
				processData : false,
				contentType : false,
				cache : false,
				success : function(response)
				{
					alert(response);
				}
			});
		});
	});
</script>
</body>
</html>

