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
		echo "success";
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