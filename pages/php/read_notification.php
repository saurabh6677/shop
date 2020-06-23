<?php

require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}

$id = base64_decode($_POST['id']);
$status = base64_decode($_POST['status']);
$r_comment = $_POST['r_comment'];
$r_mobile = "";
$get_data = "SELECT mobile FROM users WHERE email='$username'";
						$response = $db->query($get_data);
						if($response)
						{
							$data = $response->fetch_assoc();
							$r_mobile = $data['mobile'];
						}


if($r_comment !="")
{
	$update = "UPDATE bid SET status='$status',r_comment='$r_comment',r_mobile='$r_mobile' WHERE id='$id' AND resever='$username'";
	$response = $db->query($update);
	if($response)
	{
		echo "success";
	}
	else
	{
		echo "somthing went wrong";
	}
}
else
{
	$update = "UPDATE bid SET status='$status',r_mobile='$r_mobile' WHERE id='$id' AND resever='$username'";
	$response = $db->query($update);
	if($response)
	{
		echo "success";
	}
	else
	{
		echo "somthing went wrong";
	}
}


?>