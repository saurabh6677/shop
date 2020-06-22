<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}

$price = $_POST['price'];
$comment = addslashes($_POST['comment']);
$sender = $_POST['sender'];
$resever = $_POST['resever'];
$sender_name = $_POST['sender_name'];
$resever_name = $_POST['resever_name'];
$send_date = date('Y-m-d');
$product_id = $_POST['product_id'];
if(!empty($price) && !empty($comment) && $sender != $resever)
{
	$check = "SELECT * FROM bid";
	$response = $db->query($check);
	if($response)
	{
		$check = "SELECT * FROM bid WHERE sender='$sender' AND resever='$resever' AND product_id='$product_id'";
		$response = $db->query($check);
		if($response->num_rows != 0)
		{
			echo "You all ready request this product for more info <a href='http://localhost/bookstore/shop/profile.php' class='text-decoration-none text-center'>Go to your Profile</a> and manage Your Requests";
		}
		else
		{
			$store = "INSERT INTO bid(price,comment,sender,sender_name,resever,resever_name,send_date,product_id)VALUES('$price','$comment','$sender','$sender_name','$resever','$resever_name','$send_date','$product_id')";
				$response = $db->query($store);
				if($response)
				{
					echo "Your prposel hase been send to  Mr. ".$resever_name." . When he will accept your request we will inform you Thank you ! <p class='text-right'>Team bookstore</p> <br>Form More Info <a href='http://localhost/bookstore/shop/profile.php' class='text-decoration-none text-center'>Go to your Profile</a> Or check your email";
				}
				else
				{
					echo "Sorry something went wrong";
				}
		}
	}
	else
	{
		$create = "CREATE TABLE bid(
		id INT(20) NOT NULL AUTO_INCREMENT,
		price FLOAT(20),
		comment MEDIUMTEXT,
		sender VARCHAR(100),
		sender_name VARCHAR(100),
		resever VARCHAR(100),
		resever_name VARCHAR(100),
		send_date DATE,
		status VARCHAR(50) DEFAULT 'pending',
		product_id INT(11),
		PRIMARY KEY(id)
		)";
		$response = $db->query($create);
		if($response)
		{
			$check = "SELECT * FROM bid WHERE sender='$sender' AND resever='$resever' AND product_id='$product_id'";
		$response = $db->query($check);
		if($response->num_rows != 0)
		{
			echo "You all ready request this product for more info go to profile and manage Your Requests";
		}
		else
		{
			$store = "INSERT INTO bid(price,comment,sender,sender_name,resever,resever_name,send_date,product_id)VALUES('$price','$comment','$sender','$sender_name','$resever','$resever_name','$send_date','$product_id')";
				$response = $db->query($store);
				if($response)
				{
					echo "Your prposel hase been send to  Mr. ".$resever_name." . When he will accept your request we will inform you Thank you ! <p class='text-right'>Team bookstore</p> <br>Form More Info <a href='http://localhost/bookstore/shop/profile.php' class='text-decoration-none text-center'>Go to your Profile</a> Or check your email";
				}
				else
				{
					echo "Sorry something went wrong";
				}
		}
		}
		else
		{
			echo "Sorry something went wrong";
		}
	}
}
else
{
	echo "Sorry something went wrong";
}
?>
