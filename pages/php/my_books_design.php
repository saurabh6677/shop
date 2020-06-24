<?php

require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
				$my_books = "SELECT * FROM products WHERE username='$username'";
				$response = $db->query($my_books);
				if($response->num_rows != 0)
				{
					$date = "";
					while($data = $response->fetch_assoc())
					{
						$date = date_create($data['upload_date']);
						$upload_date = date_format($date, 'd/m/Y');
						echo "<div class='bg-white my-2 p-2 rounded-lg shadow-lg' align='center'>
								<img src='products/".$data['thumb']."'>
								<p class='text-center text-uppercase font-weight-bold p-0 m-0'>".$data['category']."</p>
								<p class='text-center text-capitalize font-weight-bold p-0 m-0'>Title : ".$data['title']."</p>
								<p class='text-center p-0 m-0'>Price  : ".$data['price']." <i class='fa fa-rupee'></i></p>
								<p class='text-center p-0 m-0'>Upload date ".$upload_date."</p>
								<button class='btn d-none my-2 btn-danger delete-btn' product-id='".base64_encode($data['id'])."' thumb='products/".$data['thumb']."'><i class='fa fa-trash' ></i> Delete</button>
								
						</div>";
					}
				}
				else
				{
					echo "<h2><i class='fa fa-book'></i> Empty !</h2>";
				}
				echo '<script>
				// delete product code 

$(document).ready(function(){
$(".delete-btn").each(function(){
	$(this).click(function(){
		var main = this.parentElement;
		var thumb = $(this).attr("thumb");
		var id = $(this).attr("product-id");
		$.ajax({
		type : "POST",
		url : "http://localhost/bookstore/shop/pages/php/delete_item.php",
		data : {
			id : id,
			thumb : thumb.trim()
		},
		success : function(response)
		{
			if(response.trim() == "success")
			{
				$(main).remove();
			}
			else
			{
				alert(response);
			}
		}

	});
});
	
});
});

</script>';
			?>