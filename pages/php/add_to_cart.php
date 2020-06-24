<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}

$product_id = base64_decode($_POST['product_id']);

$check = "SELECT * FROM cart";
$response = $db->query($check);
if($response)
{
	 $check_cart = "SELECT * FROM cart WHERE username='$username' AND product_id='$product_id'";
	 if($db->query($check_cart)->num_rows !=0)
	 {
	 	echo "This product already in your cart";
	 }
	 else
	 {
		$store = "INSERT INTO cart(username,product_id)VALUES('$username','$product_id')";
		$response = $db->query($store);
		if($response)
		{
			echo "success";
		}
		else
		{
			echo "unable to add cart";
		}
	}
}
else
{
	$create_cart = "CREATE TABLE cart(
	id INT(11) NOT NULL AUTO_INCREMENT,
	username VARCHAR(100),
	product_id INT(11),
	PRIMARY KEY(id)
	)";
	$response = $db->query($create_cart);
	if($response)
	{
		$store = "INSERT INTO cart(username,product_id)VALUES('$username','$product_id')";
		$response = $db->query($store);
		if($response)
		{
			echo "success";
		}
		else
		{
			echo "unable to add cart";
		}
	}
	else
	{
		echo "unable to create table";
	}
}
?>