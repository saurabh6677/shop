
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
					div.className = "alert-success w-75 mt-3";
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
					div.className = "alert-success w-75 mt-3";
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