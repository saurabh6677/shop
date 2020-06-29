<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);

$price = trim($_POST['price']);
$price = htmlspecialchars($price);
$price = mysqli_real_escape_string($db,$price);
$comment = addslashes($_POST['comment']);
$comment = htmlspecialchars($comment);
$comment = mysqli_real_escape_string($db,$comment);
$sender = trim($_POST['sender']);
$sender = htmlspecialchars($sender);
$sender = mysqli_real_escape_string($db,$sender);
$resever = trim($_POST['resever']);
$resever = htmlspecialchars($resever);
$resever = mysqli_real_escape_string($db,$resever);
$sender_name = trim($_POST['sender_name']);
$sender_name = htmlspecialchars($sender_name);
$sender_name = mysqli_real_escape_string($db,$sender_name);
$resever_name = trim($_POST['resever_name']);
$resever_name = htmlspecialchars($resever_name);
$resever_name = mysqli_real_escape_string($db,$resever_name);
$send_date = date('Y-m-d');
$product_id = trim($_POST['product_id']);
$product_id = htmlspecialchars($product_id);
$product_id = mysqli_real_escape_string($db,$product_id);
if(!empty($price) && !empty($comment) && $sender != $resever)
{
	$check = "SELECT * FROM bid";
	$response = $db->query($check);
	if($response)
	{
		$check = $db->prepare("SELECT * FROM bid WHERE sender=? AND resever=? AND product_id=?");
		$check->bind_param('sss',$sender,$resever,$product_id);
		$check->execute();
		$response = $check->get_result();
		if($response->num_rows != 0)
		{
			echo "You all ready request this product for more info <a href='http://localhost/bookstore/shop/profile.php' class='text-decoration-none text-center'>Go to your Profile</a> and manage Your Requests";
		}
		else
		{
			$store = $db->prepare("INSERT INTO bid(price,comment,sender,sender_name,resever,resever_name,send_date,product_id)VALUES(?,?,?,?,?,?,?,?)");
			$store->bind_param('issssssi',$price,$comment,$sender,$sender_name,$resever,$resever_name,$send_date,$product_id);
			
				if($store->execute())
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
		status VARCHAR(50) DEFAULT 'unread',
		product_id INT(11),
		resever_comment MEDIUMTEXT NULL,
		r_mobile VARCHAR(20) NULL,
		PRIMARY KEY(id)
		)";
		$response = $db->query($create);
		if($response)
		{
			$check = $db->prepare("SELECT * FROM bid WHERE sender=? AND resever=? AND product_id=?");
		$check->bind_param('sss',$sender,$resever,$product_id);
		$check->execute();
		$response = $check->get_result();
		if($response->num_rows != 0)
		{
			echo "You all ready request this product for more info go to profile and manage Your Requests";
		}
		else
		{
			$store = $db->prepare("INSERT INTO bid(price,comment,sender,sender_name,resever,resever_name,send_date,product_id)VALUES(?,?,?,?,?,?,?,?)");
			$store->bind_param('issssssi',$price,$comment,$sender,$sender_name,$resever,$resever_name,$send_date,$product_id);
			
				if($store->execute())
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
	echo "Sorry something went wrong else You are the owner this book, All field required";
}
?>
