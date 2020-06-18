<?php

require_once("../../common_files/database/database.php");
$email = $_POST['email'];
$password = md5($_POST['password']);

$check_email = "SELECT * FROM users WHERE email='$email'";
$response = $db->query($check_email);
if($response->num_rows != 0)
{
	$check_password = "SELECT * FROM users WHERE email='$email' AND password='$password'";
	$response = $db->query($check_password);
	if($response->num_rows != 0)
	{
		$data = $response->fetch_assoc();
		if($data['status'] == "pending")
		{
			echo "pending";
		}
		else
		{
			$username = base64_encode($email);
			$time = time()+(60*60*24*365);

			setcookie("_bk_",$username,$time,"/");
			echo "success";
		}
	}
	else
	{
		echo "wrong password";
	}
}
else
{
	echo "your email or password wrong";
}


?>