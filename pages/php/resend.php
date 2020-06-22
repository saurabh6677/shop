<?php
require_once("../../common_files/database/database.php");
$email = $_POST['email'];

$otp = rand(768325, 6);

$update = "UPDATE users SET otp='$otp' WHERE email='$email'";
$response = $db->query($update);
if($response)
{
	$check_mail = mail($email, "Bookstore OTP", "Your OTP is : ".$otp);
	if($check_mail)
	{
		echo "please check your email and verify your account";
	}
	else
	{
		echo "unable to send otp";
	}
}
else
{
	echo "unable to send otp";
}

?>