
// signup code start here

$(document).ready(function(){
	$(".signup-form").submit(function(e){
		e.preventDefault();
		var password = $("#password").val();
		if(password.length <= 8)
		{
		if($("#password").val() == $("#re-password").val())
		{
			$.ajax({
			type : "POST",
			url : "pages/php/register.php",
			data : new FormData(this),
			processData : false,
			contentType : false,
			cache : false,
			beforeSend : function(){
				$(".signup-btn").html("Please wait..");
				$(".signup-btn").attr("disabled","disabled");
			},
			success : function(response){
				$(".signup-btn").html("Signup Now");
				if(response.trim() == "success")
				{
					var div = document.createElement("DIV");
					div.className = "alert-success w-75 p-3 mt-3";
					div.innerHTML = "Thank you for signup with us";
					$(".signup-notice").append(div);
					setTimeout(function(){
						$(".signup-notice").html("");
					},2000);
					$(".signup-btn").removeAttr("disabled");
					$(".signup-form").trigger('reset');
				}
				else
				{
					var div = document.createElement("DIV");
					div.className = "alert-success w-75 p-3 mt-3";
					div.innerHTML = response;
					$(".signup-notice").append(div);
					setTimeout(function(){
						$(".signup-notice").html("");
					},2000);
					$(".signup-btn").removeAttr("disabled");
					$(".signup-form").trigger('reset');	
				}
			}

		});
		}
		else
		{
			alert("password not match");
		}
		}
		else
		{
			alert("password less then 8 digit");
		}
		
	});

});

//end signup code here


//login code start here

$(document).ready(function(){
	$(".login-form").submit(function(e){
		e.preventDefault();
		$.ajax({
			type  : "POST",
			url : "pages/php/login.php",
			data : new FormData(this),
			processData : false,
			contentType : false,
			cache : false,
			beforeSend : function()
			{
				$(".login-btn").html("Please wait..");
				$(".login-btn").attr("disabled","disabled");
			},
			success : function(response)
			{
				if(response.trim() == "success")
				{
					window.location = "https://www.google.com";
				}
				else if(response.trim() == "pending")
				{
					

					// verify code

					$(".login-form").addClass("d-none");
					$(".otp-box").removeClass("d-none");
					$(".verify-btn").click(function(){
						var otp = $(".otp").val();
						var email = $("#email").val();
						$.ajax({
							type : "POST",
							url : "pages/php/verify.php",
							data : {
								otp : Number(otp),
								email : email
							},
							beforeSend : function()
							{
								$(".verify-btn").html("Please wait..");
								$(".verify-btn").attr("disabled","disabled");
							},
							success : function(response){
								$(".verify-btn").html("Verify");
								if(response.trim() =="success")
								{
									window.location = "https://www.google.com";
								}
								else
								{
									var div = document.createElement("DIV");
										div.className = "alert-warning w-75 mt-3 p-3";
										div.innerHTML = response;
										$(".login-notice").append(div);
										setTimeout(function(){

										$(".login-notice").html("");
										var otp = $(".otp").val("");
										$(".verify-btn").removeAttr("disabled");
												},2000);	
								}
							}
						});
					});
					//end verify otp code

					//resend otp 
					$(".resend-btn").click(function(){
						var email = $("#email").val();
						$.ajax({
							type : "POST",
							url : "pages/php/resend.php",
							data : {
								email : email
							},
							beforeSend : function()
							{
								$(".resend-btn").html("please wait...");
								$(".resend-btn").attr("disabled","disabled");
							},
							success : function(response)
							{
								$(".resend-btn").html("Resend");
								$(".resend-btn").removeAttr("disabled");
								var div = document.createElement("DIV");
										div.className = "alert-warning w-75 mt-3 p-3";
										div.innerHTML = response;
										$(".login-notice").append(div);
										setTimeout(function(){
										$(".login-notice").html("");
										},2000);
							}
						});
					});

					// end resend otp code
				} 
				else
				{
					$(".login-btn").html("Login Now");
					$(".login-btn").removeAttr("disabled");
					$(".login-form").trigger('reset');
					var div = document.createElement("DIV");
					div.className = "alert-warning w-75 mt-3 p-3";
					div.innerHTML = response;
					$(".login-notice").append(div);	
					$(".login-notice").append(div);
					setTimeout(function(){
						$(".login-notice").html("");
					},2000);
					
				}
			}
		});
	});
});

//login code end here