// global var

var massage = "";



// email 

function email(data){
	var data = data;
	var email = $("#email").val();
	if(email != "")
	{
		
		var length = Number(email.length-1);
		var extantion = "";
		for(var i=length;i>=length-9;i--)
		{
			extantion += email[i];
		}
		if(extantion == "moc.liamg@")
		{
			password(data);
		}
		else
		{
			massage = "we accept email wich end with only @gmail.com";
			msg();
		}
	}
	else
	{
		massage = "please enter your email";
		msg();
	}
}


// password

function password(data) 
{
	var data = data;
	var pass = $("#password").val();

	if(pass != "")
	{
		main(data);
	}
	else
	{
		massage = "Enter password";
		msg();
	}
}

// main


function main(data){

		var data = data;
		$.ajax({
			type  : "POST",
			url : "pages/php/login.php",
			data : new FormData(data),
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
					window.location = "http://localhost/bookstore/shop/index.php";
				}
				else if(response.trim() == "pending")
				{
					$(".login-form").addClass("d-none");
					$(".otp-box").removeClass("d-none");
				}


}

});
}

// submit form

$(document).ready(function()
	{
		$(".login-form").submit(function(e){
			e.preventDefault();
			email(this);
		});

		// clall resend otp

		$(".resend-btn").click(function(){
			resend_otp();
		});

		// call verify otp


		$(".verify-btn").click(function(){
			verify_otp();
		});
	});


// verify otp code 



	function verify_otp()
	{
		var otp = $(".otp").val();
		$.ajax({
			type : "POST",
			url : "pages/php/verify.php",
			data : {
			otp : Number(otp),
			},
			beforeSend : function()
			{
				$(".verify-btn").html("Please wait..");
				$(".verify-btn").attr("disabled","disabled");
			},
			success : function(response)
			{
				$(".verify-btn").html("Verify");
				$(".verify-btn").removeAttr("disabled");
				if(response.trim() =="success")
				{
					window.location = "http://localhost/bookstore/shop/index.php";
				}
				else
				{
					massage = response;
					msg();
				}
			}
		});
	}

// resend otp code

function resend_otp(){
	$.ajax({
		type : "POST",
		url : "pages/php/resend.php",
		beforeSend : function()
		{
			$(".resend-btn").html("please wait...");
			$(".resend-btn").attr("disabled","disabled");
		},
		success : function(response)
		{
			$(".resend-btn").html("Resend OTP");
			$(".resend-btn").removeAttr("disabled");
			if(response.trim() == "success")
			{
				massage = "OTP send successfull check your email";
				success_msg();
			}
			else
			{
				massage = response;
				msg();
			}
		}
	});
}

// massage

function msg(){
	var div = document.createElement("DIV");
	div.className = "alert-danger w-75 p-3 ml-2 mt-3";
	div.innerHTML = massage;
	$(".login-notice").append(div);
	setTimeout(function(){
		$(".login-notice").html("");
	},3000);
	$(".login-btn").removeAttr("disabled");
	$(".login-form").trigger('reset');
}


// success msg

function success_msg(){
	var div = document.createElement("DIV");
	div.className = "alert-success w-75 ml-2 p-3 mt-3";
	div.innerHTML = massage;
	$(".login-notice").append(div);
	setTimeout(function()
	{
		$(".login-notice").html("");
		$(".login-form").addClass("d-none");
		$(".otp-box").removeClass("d-none");
		
	},3000);
}


