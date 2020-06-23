<?php
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
require_once("../../common_files/database/database.php");
$file = $_FILES['thumb'];
$file_name = $file['name'];
$file_location = $file['tmp_name'];
$price = $_POST['price'];
$title = $_POST['book_name'];
$image_type = $file['type'];
$cat = $_POST['book-cat'];
$upload_date = date('Y-m-d');
$username = base64_decode($_COOKIE['_bk_']);
$get_city = "SELECT city FROM users WHERE email='$username'";

if($response = $db->query($get_city))
{
 $data = $response->fetch_assoc();
 $city = $data['city'];
}
$check = "SELECT * FROM products";
$response = $db->query($check);
if($response)
{
	$store = "INSERT INTO products(title,category,price,thumb,username,upload_date,city)VALUES('$title','$cat','$price','$file_name','$username','$upload_date','$city')";
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
		  			//image processing
		  			if($image_type == "image/jpeg")
		  			{
						$image_pixels = imagecreatefromjpeg("../../products/".$file_name);
						$o_width = imagesx($image_pixels);
						$o_height = imagesy($image_pixels);
						$canvas = imagecreatetruecolor(250, 316);
						imagecopyresampled($canvas,$image_pixels,0,0,0,0,250,316,$o_width,$o_height);

						if(imagejpeg($canvas, "../../products/".$file_name))
						{
							echo "success";
						}
						else
						{
							echo "somthing went wrong";
						}
						imagedestroy($image_pixels);
					}
					else if($image_type == "image/png")
					{
						$image_pixels = imagecreatefrompng("../../products/".$file_name);
						$o_width = imagesx($image_pixels);
						$o_height = imagesy($image_pixels);
						$canvas = imagecreatetruecolor(250, 316);
						imagecopyresampled($canvas,$image_pixels,0,0,0,0,250,316,$o_width,$o_height);

						if(imagepng($canvas, "../../products/".$file_name))
						{
							echo "success";
						}
						else
						{
							echo "somthing went wrong";
						}
						imagedestroy($image_pixels);
					}
					else
					{
						echo "upload png or jpeg image only";
					}
					//end image processing
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
	city VARCHAR(100),
	PRIMARY KEY(id)
	)";
	$response = $db->query($create);
	if($response)
	{
	  if(mkdir("../../products"))
	  {
	  	$store = "INSERT INTO products(title,category,price,thumb,username,upload_date,city)VALUES('$title','$cat','$price','$file_name','$username','$upload_date','$city')";
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
		  			//image processing

					if($image_type == "image/jpeg")
		  			{
						$image_pixels = imagecreatefromjpeg("../../products/".$file_name);
						$o_width = imagesx($image_pixels);
						$o_height = imagesy($image_pixels);
						$canvas = imagecreatetruecolor(250, 316);
						imagecopyresampled($canvas,$image_pixels,0,0,0,0,250,316,$o_width,$o_height);

						if(imagejpeg($canvas, "../../products/".$file_name))
						{
							echo "success";
						}
						else
						{
							echo "somthing went wrong";
						}
						imagedestroy($image_pixels);
					}
					else if($image_type == "image/png")
					{
						$image_pixels = imagecreatefrompng("../../products/".$file_name);
						$o_width = imagesx($image_pixels);
						$o_height = imagesy($image_pixels);
						$canvas = imagecreatetruecolor(250, 316);
						imagecopyresampled($canvas,$image_pixels,0,0,0,0,250,316,$o_width,$o_height);

						if(imagepng($canvas, "../../products/".$file_name))
						{
							echo "success";
						}
						else
						{
							echo "somthing went wrong";
						}
						imagedestroy($image_pixels);
					}
					else
					{
						echo "upload png or jpeg image only";
					}
					
					//end image processing
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