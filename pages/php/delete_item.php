<?php

require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}

$id = $_POST['id'];
$thumb = $_POST['thumb'];
$delete = "DELETE FROM products WHERE id='$id' AND username='$username'";
$response = $db->query($delete);
if($response)
{

   echo "success";
   
}
else
{
	echo "this product not exits";
}

?>