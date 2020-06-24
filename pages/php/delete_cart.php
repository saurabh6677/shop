<?php

require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}

$product_id = base64_decode($_POST['product_id']);

$delete = "DELETE FROM cart WHERE username='$username' AND product_id='$product_id'";
$response = $db->query($delete);
if($response)
{
	echo "success";
}
else
{
	echo "unable to delete";
}


?>