<?php
$username = base64_decode($_COOKIE['_bk_']);
if(empty($username))
{
	header("Location: http://localhost/bookstore/shop/login.php");
	exit;
}
			echo 	'<h4 class="text-primary">UPLAOD A BOOK</h4>
				<form class="upload-form">
					<div class="form-group">
						<label for="book-name">Book Title</label>
						<input type="text" name="book_name" placeholder="book name" class="form-control w-75" required="required" id="book-name">
					</div>
					<div class="form-group">
						<label for="book-cat">Select Language</label>
						<select name="book-cat" class="form-control w-75" id="book-cat" required="required">
							<option>Chosse Language</option>
							<option>Hindi</option>
							<option>English</option>
						</select>
					</div>
					<div class="form-group">
						<label for="price">Price <i class="fa fa-rupee"></i></label>
						<input type="text" name="price" placeholder="100" class="form-control w-75" required="required" id="price">
					</div>
					<div class="form-group">
						<label for="thumb">Picture <i class="fa fa-image"></i></label><br>
						
						<input type="file" accept="image" name="thumb" class="form-control w-75" required="required" id="thumb">
					</div>
					<br>
					<div class="shadow-lg preview w-50" align="center" style="margin-left:25%;margin-right:25%;border:3px solid white;">
					<p class="text-center p-text">Preview</p>
					</div>
					<br>
					<div class="progress upload-bar-con d-none">
						<div class=" bg-primary  progress-bar upload-bar text-light text-center rounded-lg"></div>
					</div><br>
					<button  type="submit" class="btn btn-primary upload-btn">Upload</button>
					<div class="upload-notice"></div>
				</form>';
				echo '<script>$(document).ready(function(){
					$("#thumb").on("change", function(){
						$(".preview").html("");
						$(".p-text").addClass("d-none");
						var file = this.files[0];
						var url = URL.createObjectURL(file);
						var img = document.createElement("IMG");
						img.src = url;
						img.style.width = "100%";
						$(".preview").append(img);

						});
		$(".upload-form").submit(function(e){
			e.preventDefault();
			if($("#book-cat").val() != "Chosse Language")
			{
				$.ajax({
				type : "POST",
				url : "pages/php/upload.php",
				data : new FormData(this),
				processData : false,
				contentType : false,
				cache : false,
				xhr : function()
				{
					var request = new XMLHttpRequest();
					request.upload.onprogress = function(e)
					{
						var percentage = Math.floor((e.loaded*100)/e.total);
						$(".upload-bar").css({
							width : percentage+"%"
						});
						$(".upload-bar").html(percentage+"%");

					}
					return request;
				},
				beforeSend : function()
				{
					$(".upload-bar-con").removeClass("d-none");
					$(".upload-btn").html("Please wait...");
					$(".upload-btn").attr("disabled","disabled");
				},
				success : function(response)
				{
					
					if(response.trim() == "success")
					{
						var div = document.createElement("DIV");
						div.className = "alert-success p-2 text-center";
						div.innerHTML = "Your book uploading successfull";
						$(".upload-notice").append(div);
						setTimeout(function(){
							$(".upload-bar-con").addClass("d-none");
							$(".upload-btn").html("Upload");
							$(".upload-form").trigger("reset");
							$(".upload-btn").removeAttr("disabled");
							$(".upload-notice").html("");
							$(".preview").html("");
						},2000);
					}
					else
					{
						var div = document.createElement("DIV");
						div.className = "alert-warning p-2 text-center";
						div.innerHTML = response;
						$(".upload-notice").append(div);
						setTimeout(function(){
							$(".upload-bar-con").addClass("d-none");
							$(".upload-btn").html("Upload");
							$(".upload-form").trigger("reset");
							$(".upload-btn").removeAttr("disabled");
							$(".upload-notice").html("");
							$(".preview").html("");
						},2000);
					}
				}
			});

			}
			else
			{
				alert("Chosse Language");
			}
					});
	});</script>';

				?>