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
	<link rel="stylesheet" href="css/index.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<script src="http://localhost/bookstore/shop/common_files/js/jquery.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/popper.js"></script>
	<script src="http://localhost/bookstore/shop/common_files/js/bootstrap.min.js"></script>
</head>
<body>

<?php
require_once("../../assist/nav.php");
?>

<div class="container my-3">
	<div class="row">
		<div class="col-md-12 p-3 shadow-lg">
			<?php
                 require_once("request_design.php");
			?>
		</div>
	</div>
</div>
<?php
require_once("../../assist/footer.php");

?>
<script>
</script>
</body> 
</html>