<?php
require_once("../../common_files/database/database.php");
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
$fullname = "";
$mobile = "";
$pincode = "";
$address = "";
$college = "";
$course = "";

echo '	<div>
					<form class="edit-form">
						<h4 class="text-warning"><i class="fa fa-edit"></i> Edit your profile</h4>';?>
						<?php
						$get_data = "SELECT * FROM users WHERE email='$username'";
						$response = $db->query($get_data);
						if($response)
						{
							$data = $response->fetch_assoc();
							$fullname = $data['fullname'];
							$mobile = $data['mobile'];
							if($mobile !="NULL")
							{
								$pincode = $data['pincode'];
								$address = $data['address'];
								$college = $data['college'];
								$course = $data['course'];
							}
							else
							{
								$mobile = "";
								$pincode = "";
								$address = "";
								$college = "";
								$course = "";	
							}
							
							

						}
						?>
						<?php
						echo '
						<div class="form-group">
							<label for="fullname">Fullname<sup class="text-danger">*</sup></label>
							<input type="text"  name="fullname" id="fullname" class="form-control" required="required" value="';?><?php echo $fullname;?><?php echo '">
						</div>
						<div class="form-group">
							<label for="mobile">Mobile<sup class="text-danger">*</sup></label>
							<input type="text" placeholder="989778772" name="mobile" id="mobile" class="form-control" maxlength="10" required="required" value="';?><?php echo $mobile;?><?php echo '">
						</div>
						<div class="form-group">
							<label for="pincode">Pincode<sup class="text-danger">*</sup></label>
							<input type="text" placeholder="300038" name="pincode" id="pincode" class="form-control" required="required" value="'?><?php echo $pincode;?><?php echo '">
						</div>
						<div class="form-group">
							<label for="address">Address<sup class="text-danger">*</sup></label>
							<textarea  placeholder="your address" name="address" id="address" class="form-control" maxlength="100" rows="4" required="required" >
								';?><?php echo $address;?><?php echo '
							</textarea>
						</div>
						<div class="form-group">
							<label for="college">College<sup class="text-danger">*</sup></label>
							<input  placeholder="Government polytechnic mawana" name="college" id="college" class="form-control" maxlength="150" required="required" value="'?><?php echo $college;?><?php echo '">
							
						</div>
						<div class="form-group">
							<label for="course">Course<sup class="text-danger">*</sup></label>
							<input  placeholder="b.tech" name="course" id="course" class="form-control" maxlength="150" required="required" value="'?><?php echo $course;?><?php echo'">
							
						</div>
						<button type="submit" class="btn btn-primary save-btn">Save</button>
						<div class="edit-notice">
							
						</div>
					</form>
				</div>';
				echo '<script>$(document).ready(function(){
			$(".edit-form").submit(function(e){
				e.preventDefault();
				$.ajax({
					type : "POST",
					url : "pages/php/edit_details.php",
					data : new FormData(this),
					processData : false,
					contentType : false,
					cache : false,
					beforeSend : function()
					{
						var div = document.createElement("DIV");
						div.className = "alert-warning p-3 text-center";
						div.innerHTML = "Please wait"
						$(".edit-notice").append(div);
						$(".save-btn").attr("disabled","disabled");
					},
					success : function(response)
					{
						$(".edit-notice").html("");
						var div = document.createElement("DIV");
						div.className = "alert-success p-3 text-center";
						div.innerHTML = response;
						$(".edit-notice").append(div);
						$(".save-btn").removeAttr("disabled");
						$(".edit-form").trigger("reset");
						setTimeout(function(){
							$(".edit-notice").html("");
						},3000);	
					}
				});
			});
		
	});</script>';

				?>