<?php
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
require_once("../../common_files/database/database.php");
$email = $_POST['email'];
$password = md5($_POST['password']);

$check = "SELECT * FROM users WHERE email='$email'";
$response = $db->query($check);
if($response->num_rows != 0)
{
	$update = "UPDATE users  SET password='$password' WHERE email='$email'";
	$response = $db->query($update);
	if($response)
	{
		echo "Your password hase successfully changed please login";
	}
	else
	{
		echo "sorry please try again later";
	}
}
else
{
	echo "user not found please register";
}
?>