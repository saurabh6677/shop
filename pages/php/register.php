<?php

require_once("../../common_files/database/database.php");
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$re_password = $_POST['re-password'];
$mobile = $_POST['mobile'];
$pincode = $_POST['pincode'];
$country = $_POST['country'];
$state = $_POST['state'];
$district = $_POST['district'];
$city = $_POST['city'];

$otp = rand(768325, 6);

// form validation
if(!empty($fullname))
{
 	if(!empty($email))
 	{
 		if(!empty($password))
	 	{
	 		if(!empty($mobile))
		 	{
		 		if($password == $re_password)
		 		{
		 			if(!empty($pincode))
		 			{


			 		$password = md5($password);
			 		
							$check = "SELECT * FROM users";
							$response = $db->query($check);
							if($response)
							{ 

							$check = "SELECT * FROM users WHERE email='$email' OR mobile='$mobile'";
							$response = $db->query($check);
							if($response->num_rows == 0)
							{
								$store = "INSERT INTO users(fullname,email,password,otp,mobile,pincode,country,state,district,city)VALUES('$fullname','$email','$password','$otp','$mobile','$pincode','$country','$state','$district','$city')";
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
										echo "faild to send otp on your email Please Login";
									}
								}
								else
								{
									echo "This email or mobile already registerd ";
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
							pincode VARCHAR(10),
							country VARCHAR(20),
							state VARCHAR(50),
							district VARCHAR(100),
							city VARCHAR(100),
							address VARCHAR(250) NULL,
							college VARCHAR(100) NULL,
							course VARCHAR(100) NULL,
							PRIMARY KEY(id)
							)";
							$response = $db->query($create);
							if($response)
							{
								$store = "INSERT INTO users(fullname,email,password,otp,mobile,pincode,country,state,district,city)VALUES('$fullname','$email','$password','$otp','$mobile','$pincode','$country','$state','$district','$city')";
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
					
		 			}
		 			else
		 			{
		 				echo "enter a valid pincode";
		 			}
		 		}
		 		else
		 		{
		 			echo "password and re enter password not match both are must be same";
		 		}
		 	}
		 	else
		 	{
		 		echo "Please enter your mobile no";
		 	}
	 	}
	 	else
	 	{
	 		echo "Please enter your password";
	 	}
 	}
 	else
 	{
 		echo "Please enter your email";
 	}
}
else
{
	echo "Please enter your full name";
}
// end form validation


?>