// global variables

var massage = "";



// call functions

$(document).ready(function(){
	$(".resend-btn").click(function(){
		resend_otp();
	});
});


$(document).ready(function(){
	$(".verify-btn").click(function(){
		verify_otp();
	});
});

// full name

function fullname(){
	var fullname = $("#fullname").val();
	fullname = fullname.toLowerCase();
	if(fullname != "")
	{
		email();
	}
	else
	{
		massage = "Please enter fullname";
		msg();
	}
}

// email 

function email(){
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
			mobile();
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

// mobile 


function mobile()
{
	var mobile = $("#mobile").val();
	if(Number(mobile.length) == 10)
	{
		password();
	}
	else
	{
		massage = "Please enter a valid mobile Number";
		msg();
	}
}

// pincode 

function pincode() 
{
	var pincode = $("#pincode").val();
	if(Number(pincode.length) == 6)
	{
		$.ajax({
					type : "GET",
			 		url : "https://api.postalpincode.in/pincode/"+Number(pincode),
			 		beforeSend : function()
			 		{
			 			$(".signup-btn").html("Please wait..");
			 		},
			 		success : function(response)
			 		{
				 		var status = response[0].Status;
			 					
			 			if(status == "Success")
			 			{
				 			 var length = response[0].PostOffice.length-1;
				 			 var data = response[0].PostOffice[length];
				 			 var country = data.Country;
				 			 var state = data.State;
				 			 var district = data.District;
				 			 var city = data.Block;
				 			 var formdata = new FormData();
				 			 formdata.append("fullname", $("#fullname").val());
							 formdata.append("email", $("#email").val());
							 formdata.append("mobile", $("#mobile").val());
							 formdata.append("password", $("#password").val());
							 formdata.append("country", country);
							 formdata.append("state", state);
							 formdata.append("district", district);
							 formdata.append("city", city);
							 formdata.append("pincode", pincode);

							 $.ajax({
							 	type : "POST",
							 	url : "pages/php/register.php",
							 	data : formdata,
							 	processData : false,
							 	contentType : false,
							 	cache : false,
							 	beforeSend : function()
							 	{
							 		$(".signup-btn").html("Please wait..");
									$(".signup-btn").attr("disabled","disabled");
							 	},
							 	success : function(response)
							 	{
							 		$(".signup-btn").html("Signup now");
							 		$(".signup-btn").removeAttr("disabled");
							 		if(response.trim() =="success")
							 		{
							 			massage = "Thank you for signup with us , Please wait to verify your email";
							 			success_msg();
							 		}
							 		else
							 		{
							 		massage = response.trim();
							 		msg();
							 		}
							 	}
							 });
			 			}
			 			else
			 			{
			 				$(".signup-btn").html("Signup now");
			 				$(".signup-btn").removeAttr("disabled");
			 				massage = "Please enter a valid pincode";
			 				msg();
			 			}

					}

		});
	}
	
	else
	{
		massage = "Please enter a valid pincode";
		msg();
	}
}

// password

function password() 
{
	var pass = $("#password").val();
	var pass1 = $("#re-password").val();

	if(pass === pass1)
	{
		pincode();
	}
	else
	{
		massage = "password not match";
	}
}
// submit form

$(document).ready(function()
	{
		$(".signup-form").submit(function(e){
			e.preventDefault();
			fullname();
		});
	});

// massage

function msg(){
	var div = document.createElement("DIV");
	div.className = "alert-danger w-75 p-3 mt-3";
	div.innerHTML = massage;
	$(".signup-notice").append(div);
	setTimeout(function(){
		$(".signup-notice").html("");
	},3000);
	$(".signup-btn").removeAttr("disabled");
	$(".signup-form").trigger('reset');
}



// success msg

function success_msg(){
	var div = document.createElement("DIV");
	div.className = "alert-success w-75 p-3 mt-3";
	div.innerHTML = massage;
	$(".signup-notice").append(div);
	setTimeout(function()
	{
		$(".signup-notice").html("");
		$(".signup-form").addClass("d-none");
		$(".otp-box").removeClass("d-none");
		
	},3000);
}


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