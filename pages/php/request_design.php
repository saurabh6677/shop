
<html>
<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
			$get_notification = "SELECT * FROM bid WHERE resever='$username' ORDER BY send_date DESC LIMIT 6";
			$response = $db->query($get_notification);
			if($response->num_rows !=0)
			{
				while($data = $response->fetch_assoc())
				{
					$send_date = $data['send_date'];
					$send_date = date_create($send_date);
					$send_date = date_format($send_date,'d/m/Y');
					$status = $data['status'];
					$sander_name = $data['sender_name'];
					$comment = $data['comment'];
					$id = $data['id'];
					$product_id = $data['product_id'];
					$product = "SELECT * FROM products WHERE id='$product_id'";
					$pro_response = $db->query($product);
					$pro_data = $pro_response->fetch_assoc();
					$title = $pro_data['title'];
					$thumb = $pro_data['thumb'];
					if($status == "unread")
					{
						echo '<div class="alert-danger p-3 mb-3 shadow-lg">
						<i class="fa fa-close close-btn close" name="'.base64_encode($id).'"></i>
						<span class="text-success font-weight-bold">'.$sander_name.'     '.$send_date.' <small class="float-right mr-2 text-dark"> Unread Massage</small></span><br>
						<p class="text-success">Mr. '.$sander_name.' request you to buy "'.$title.'" Book From You</p>
						<div class="d-lg-flex">
							<div class="media mb-3">
							<img src=".http://localhost/bookstores/shop/products/'.$thumb.'" width="80%" class="shadow-lg" style="border:5px solid white">
							</div>
							<div class="media-body ml-2">
							<p>Mr. '.$sander_name.' say\'s to You <br>'.$comment.' </p><br>
							<lable>Fix Metting </lable>
							<input type="text" class="form-control r_comment" placeholder="ok done met tomorrow at 4:00 pm Inderapark">
							<br>
							<button class="btn btn-primary mt-4 accept-btn " name="'.base64_encode($id).'">Accept</button>
							<button class="btn btn-danger mt-4 reject-btn" name="'.base64_encode($id).'">Reject</button>
							</div>
						</div>
						</div>';
					}
					else if($status == "read")
					{
						echo '<div class="alert-success p-3 mb-3 shadow-lg">
						<i class="fa fa-close close-btn close" name="'.base64_encode($id).'"></i>
						<span class="text-success font-weight-bold">'.$sander_name.'     '.$send_date.' <small class="float-right mr-2 text-primary">You also read this Massage</small></span><br>
						<p class="text-success">Mr. '.$sander_name.' request you to buy "'.$title.'" Book From You</p>
						<div class="d-flex">
							<div class="media">
							<img src="http://localhost/bookstores/shop/products/'.$thumb.'" width="80%" class="shadow-lg" style="border:5px solid white">
							</div>
							<div class="media-body ml-2">
							<p>Mr. '.$sander_name.' say\'s to You <br>'.$comment.' </p><br>
							<button class="btn btn-primary mt-4 accept-btn " name="'.base64_encode($id).'">Accept</button>
							<button class="btn btn-danger mt-4 reject-btn" name="'.base64_encode($id).'">Reject</button>
							</div>
						</div>
						</div>';
					}
					else if($status == "accept")
					{
						echo '<div class="alert-light p-3 mb-3 shadow-lg">
						<span class="text-success font-weight-bold">'.$data['sender_name'].'     '.$send_date.' <small class="float-right text-primary"> You Accept This Request</small></span><br>
						'.$data['comment'].' <i class="fa fa-close close-btn close" name="'.base64_encode($data['id']).'"></i><br>
						
						</div>';
					}
					else if($status == "reject")
					{
						echo '<div class="alert-warning p-3 mb-3 shadow-lg">
						<span class="text-danger font-weight-bold">'.$data['sender_name'].'     '.$send_date.'<small class="float-right"> You Reject This Request</small></span><br>
						'.$data['comment'].' <i class="fa fa-close close-btn close" name="'.base64_encode($data['id']).'"></i><br>
						<lable class="d-none">Fix Metting </lable>
						<input type="text" class="form-control d-none w-50 r_comment" placeholder="ok done met tomorrow at 4:00 pm Inderapark">
						<button class="btn btn-primary mt-4 d-none accept-btn" name="'.base64_encode($data['id']).'">Accept</button>
						<button class="btn btn-danger mt-4 d-none reject-btn" name="'.base64_encode($data['id']).'">Reject</button>
						<button class="btn btn-danger mt-4 edit-btn" name="'.base64_encode($data['id']).'">Edit This</button>
						</div>';
					}

				
				
				}

			}
			$get_notification = "SELECT * FROM bid WHERE sender='$username' ORDER BY send_date DESC LIMIT 6";
				$response = $db->query($get_notification);
				if($response->num_rows !=0)
				{
					while($data = $response->fetch_assoc())
					{
						$send_date = $data['send_date'];
						$send_date = date_create($send_date);
						$send_date = date_format($send_date,'d/m/Y');
						$status = $data['status'];
						$resever_name = $data['resever_name'];
						$sander_name = $data['sender_name'];
						$comment = $data['comment'];
						$r_comment = $data['r_comment'];
						$r_mobile = $data['r_mobile'];
						$id = $data['id'];
						$product_id = $data['product_id'];
						$product = "SELECT * FROM products WHERE id='$product_id'";
						$pro_response = $db->query($product);
						$pro_data = $pro_response->fetch_assoc();
						$title = $pro_data['title'];
						$thumb = $pro_data['thumb'];
						if($status == "accept")
						{
							echo "<div class='p-3 alert-success shadow-lg mb-3'>
							<i class='fa fa-close close close-btn'></i>
							<p class='text-center font-weight-bold text-success'>Congrats Your Request Accepted By Mr. ".$resever_name."</p>
							<p>Hi Mr. ".$sander_name." , Now you can purchase '".$title."' Book From Mr. ".$resever_name." here is details</p>
								<p class='font-weight-bold text-capitelize'>Name : ".$resever_name."</p>
								<p class=' text-capitelize'><i class='fa fa-mobile'></i> Mobile : ".$r_mobile."</p>
								<p class=' text-capitelize'>".$resever_name." Say's :
								".$r_comment."</p>
							</div>";
						}
						else if($status == "reject")
						{
							echo "<div class='p-3 alert-warning shadow-lg mb-3'>
							<i class='fa fa-close close close-btn'></i>
							<p class='text-center font-weight-bold text-dark'>Sorry Your Request hase been Reject By Mr. ".$resever_name."</p>
							<p>Hi Mr. ".$sander_name." , Don't very Now you can purchase '".$title."' Book From Other Seller
							<a href='http://localhost/bookstore/shop/'>Other Seller</a>
							</p>
								<p class=' text-capitelize'>".$resever_name." Say's :
								".$r_comment."</p>
							</div>";
						}
						else if($status == "unread")
						{
							echo "<div class='p-3 alert-danger shadow-lg mb-3'>
							<i class='fa fa-close close close-btn'></i>
							<p class='text-center font-weight-bold text-danger'>You Request to  Mr. ".$resever_name." for buying '".$title."' Book
							
							</p>
							<p class='font-weight-bold text-center text-success'>Status : Pending</p>
								<a href='http://localhost/bookstore/shop/'>Get More Book's</a>
							</div>";
						}


					}
				}
			else
			{
				echo "No Notification";
			}

?>
<body>
	
</body>
<script>
	//request page code

		$(document).ready(function(){

		// close btn code
		$(".close-btn").each(function(){
			$(this).click(function(){
				var id = $(this).attr("name");
				var close_btn = this;
				var status = "read";
				var div = close_btn.parentElement;
							$(div).hide();
				/*$.ajax({
					type : "POST",
					url : "http://localhost/bookstore/shop/pages/php/read_notification.php",
					data : {
						id : id,
						status : btoa(status)
					},
					success : function(response)
					{
						if(response.trim() == "success")
						{
							var div = close_btn.parentElement;
							$(div).hide();
						}
						else
						{
							alert(response);
						}
					}
				}); */
			});
		});

		//end close btn code

		// accept btn code
		$(".accept-btn").each(function(){
			$(this).click(function(){
				var id = $(this).attr("name");
				var close_btn = this;
				var status = "accept";
				var r_comment = $(".r_comment").val();
				if(r_comment != "")
				{
					$.ajax({
						type : "POST",
						url : "http://localhost/bookstore/shop/pages/php/read_notification.php",
						data : {
							id : id,
							status : btoa(status),
							r_comment : r_comment
						},
						success : function(response)
						{
							if(response.trim() == "success")
							{
								var div = close_btn.parentElement;
								$(div).html("");
								$(div).removeClass("alert-danger");
								$(div).addClass("bg-white");
								var msg = document.createElement("div");
								msg.className = "p-5 w-100 shadow-lg text-center";
								msg.style.borderLeft = "5px solid green";
								var i =  document.createElement("i");
								i.className = "fa fa-check-circle text-success";
								i.style.fontSize = "35px";
								var p = document.createElement("p");
								p.className = "text-success p-3";
								p.innerHTML = "Thank You For Accepting This Request. <br><br><span class='float-right' style='margin-bottom:0'>Regards :<br><b>Team Bookstore</b></span>";
								$(div).append(msg);
								$(msg).append(i);
								$(msg).append(p);
								
								
							}
							else
							{
								alert(response);
							}
						}
					});
				}
				else
				{
					alert("write something in comment");
				}
			});
		});

		//accept close btn code
		// reject btn code
		$(".reject-btn").each(function(){
			$(this).click(function(){
				var id = $(this).attr("name");
				var close_btn = this;
				var status = "reject";
				var r_comment = $(".r_comment").val();
				if(r_comment != "")
				{
					$.ajax({
						type : "POST",
						url : "http://localhost/bookstore/shop/pages/php/read_notification.php",
						data : {
							id : id,
							status : btoa(status),
							r_comment : r_comment
						},
						success : function(response)
						{
							if(response.trim() == "success")
							{
								var div = close_btn.parentElement;
								$(div).html("");
								$(div).removeClass("alert-danger");
								$(div).addClass("bg-white");
								var msg = document.createElement("div");
								msg.className = "p-5 w-100 shadow-lg text-center";
								msg.style.borderLeft = "5px solid red";
								var i =  document.createElement("i");
								i.className = "fa fa-times-circle text-danger";
								i.style.fontSize = "35px";
								var p = document.createElement("p");
								p.className = "text-danger p-3";
								p.innerHTML = "Thank You For Your Opinion. <br><br><span class='float-right' style='margin-bottom:0'>Regards :<br><b>Team Bookstore</b></span>";
								$(div).append(msg);
								$(msg).append(i);
								$(msg).append(p);
							}
							else
							{
								alert(response);
							}
						}
					});
				}
				else
				{
					alert("write something in comment");
				}
			});
		});

		//reject btn code
		//edit btn code

		$(".edit-btn").each(function(){
			$(this).click(function(){
				$(this).addClass("d-none");
				var lable = this.parentElement.children[4];
				var input = this.parentElement.children[5];
				var accept_btn = this.parentElement.children[6];
				var reject_btn = this.parentElement.children[7];
				$(accept_btn).removeClass("d-none");
				$(reject_btn).removeClass("d-none");
				$(input).removeClass("d-none");
				$(lable).removeClass("d-none");
			});
		});
	});
</script>
</html>