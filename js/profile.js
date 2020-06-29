

// dynamic page request

$(document).ready(function(){
	
	$(".menu").each(function(){
		$(this).click(function(){
			$(".menu").removeClass("border border-primary");
			var link = $(this).attr("link");	
			$(this).addClass("border border-primary");	
			$.ajax({
				type : "POST",
				url : link,
				success : function(response){
					$(".dynamic-result").html(response);
					
				}
			});
		});
	

	});
});











$(document).ready(function(){
		var button_edit = document.getElementsByClassName("request-btn");
			$(button_edit).click();
	});
	$(document).ready(function(){
		if($(window).width() < 768)
		{
			 var window_height = $(window).height();
			
			$(".mobile-menu").css({
				height : window_height+"px"
			});

			$(".mobile-menu button").each(function(){
				$(this).click(function(){
					$(".mobile-menu").fadeOut(1000);
				});
			});
			$(".mobile-menu-icon").each(function(){
				$(this).click(function(){

					var icon = this;
					$(this).addClass("fa-spin");
					$(".mobile-menu").toggle(2000,function(e){
						$(".mobile-menu-icon").removeClass("fa-spin");
					});
					
				});
				
			});
		}
	});

	// notification

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












