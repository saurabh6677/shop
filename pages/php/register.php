<?php

require_once("../../common_files/database/database.php");
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$otp = rand(768325, 6);
$check = "SELECT * FROM users";
$response = $db->query($check);
if($response)
{ 

	$check = "SELECT * FROM users WHERE email='$email'";
	$response = $db->query($check);
	if($response->num_rows == 0)
	{
	$store = "INSERT INTO users(fullname,email,password,otp)VALUES('$fullname','$email','$password','$otp')";
		$response = $db->query($store);
		if($response)
		{
			$mail = mail($email, "Bookstore OTP", "Your bookstore otp is :".$otp);
			if($mail)
			{
				echo "success";
			}
			else
			{
				echo "faild to send otp on your email";
			}
		}
		else
		{
			echo "unable to insert data in users table";
		}
	}
	else
	{
		echo "this email already registerd";
	}

}
else
{
	$create = "CREATE TABLE users(
	id INT(11) NOT NULL AUTO_INCREMENT,
	fullname VARCHAR(50),
	email VARCHAR(50),
	password VARCHAR(100),
	otp INT(10),
	status VARCHAR(20) DEFAULT 'pending',
	mobile VARCHAR(20) NULL,
	pincode VARCHAR(10) NULL,
	address VARCHAR(250) NULL,
	college VARCHAR(100) NULL,
	course VARCHAR(100) NULL,
	PRIMARY KEY(id)
	)";
	$response = $db->query($create);
	if($response)
	{
		$store = "INSERT INTO users(fullname,email,password,otp)VALUES('$fullname','$email','$password','$otp')";
		$response = $db->query($store);
		if($response)
		{
			$mail = mail($email, "Bookstore OTP", "Your bookstore otp is :".$otp);
			if($mail)
			{
				echo "success";
			}
			else
			{
				echo "faild to send otp on your email";
			}
		}
		else
		{
			echo "unable to insert data in users table";
		}

	}
	else
	{
		echo "unable to create users table";
	}
}
?>