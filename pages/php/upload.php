<?php
require_once("../../common_files/database/database.php");
$file = $_FILES['thumb'];
$file_name = $file['name'];
$file_location = $file['tmp_name'];
$price = $_POST['price'];
$title = $_POST['book_name'];
$cat = $_POST['book-cat'];
$upload_date = date('Y-m-d');
$username = base64_decode($_COOKIE['_bk_']);
$check = "SELECT * FROM products";
$response = $db->query($check);
if($response)
{
	$store = "INSERT INTO products(title,category,price,thumb,username,upload_date)VALUES('$title','$cat','$price','$file_name','$username','$upload_date')";
	  	$response = $db->query($store);
	  	if($response)
	  	{
	  		if(file_exists("../../products/".$file_name))
	  		{
	  			echo "please rename your file";
	  		}
	  		else
	  		{
		  		$store_file = move_uploaded_file($file_location, "../../products/".$file_name);
		  		if($store_file)
		  		{
		  			echo "success";
		  		}
		  		else
		  		{
		  			echo "faild to store image";
		  		}
	  	    }
	  	}
	  	else
	  	{
	  		echo "unable to store data";
	  	}
}
else
{
	$create = "CREATE TABLE products(
	id INT(11) NOT NULL AUTO_INCREMENT,
	title VARCHAR(200),
	category VARCHAR(150),
	price FLOAT(20),
	thumb VARCHAR(250),
	username VARCHAR(150),
	upload_date DATE,
	PRIMARY KEY(id)
	)";
	$response = $db->query($create);
	if($response)
	{
	  if(mkdir("../../products"))
	  {
	  	$store = "INSERT INTO products(title,category,price,thumb,username,upload_date)VALUES('$title','$cat','$price','$file_name','$username','$upload_date')";
	  	$response = $db->query($store);
	  	if($response)
	  	{
	  		if(file_exists("../../products/".$file_name))
	  		{
	  			echo "please rename your file";
	  		}
	  		else
	  		{
		  		$store_file = move_uploaded_file($file_location, "../../products/".$file_name);
		  		if($store_file)
		  		{
		  			echo "success";
		  		}
		  		else
		  		{
		  			echo "faild to store image";
		  		}
	  	    }
	  	}
	  	else
	  	{
	  		echo "unable to store data";
	  	}
	  }
	  else
	  {
	  	echo "unable to create products folder";
	  }
	}
	else
	{
		echo "unaable to create table";
	}
}


?>