<?php

require_once("../../common_files/database/database.php");
$email = $_POST['email'];
$otp = $_POST['otp'];
$check = "SELECT * FROM users WHERE email='$email'";
$response = $db->query($check);
if($response->num_rows !=0)
{
  $data = $response->fetch_assoc();

  $main_otp = $data['otp'];
  if($main_otp == $otp)
  {
  	$update = "UPDATE users SET status='active' WHERE email='$email' AND otp='$otp'";
  	$response = $db->query($update);
  	if($response)
  	{
  		
      $username = base64_encode($email);
      $time = time()+(60*60*24*365);

      setcookie("_bk_",$username,$time,"/");
  		echo "success";
  	}
  	else
  	{
  		echo "try agin later";
  	}
  }
  else
  {
  	echo "wrong otp";
  }
}
else
{
  echo $email;
}

?>