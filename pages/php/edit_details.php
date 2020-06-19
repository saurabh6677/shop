<?php

require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}

$mobile = $_POST['mobile'];
$address = $_POST['address'];
$pincode = $_POST['pincode'];
$mobile = $_POST['mobile'];
$college = $_POST['college'];
$course = $_POST['course'];

$update = "UPDATE users SET mobile='$mobile',address='$address',pincode='$pincode',college='$college',course='$course' WHERE email='$username'";
$response = $db->query($update);
if($response)
{
	echo "Your profile update succesfully";
}
else
{
	echo "something went wrong please try again later";
}

?>