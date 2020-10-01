var loginFunction = function(){
	var userTxt = document.getElementById("form-username").value;
	var passTxt = document.getElementById("form-password").value;
	if(userTxt == "" && passTxt == "")
	{
		$("#lblTxt").text("Username and Password are required!");
		$('#form-username').css('border-color', '#0090ff');
		$('#form-password').css('border-color', '#0090ff');
	}
	if(userTxt == "" && passTxt != "")
	{
		$("#lblTxt").text("Username required!");
		$('#form-username').css('border-color', '#0090ff');
		$('#form-password').css('border-color', '');
	}
	if(userTxt != "" && passTxt == "")
	{
		$("#lblTxt").text("Password required!");
		$('#form-username').css('border-color', '');
		$('#form-password').css('border-color', '#0090ff');
	}
	if(userTxt !="" && passTxt != "")
	{
		$.ajax({
			url: './php/login.php',
			type: 'POST',
			dataType: 'text',
			data: {user: userTxt, pass: passTxt},

			success:function(res3)
			{
				if(res3=="correct")
				{
					window.location.href='./pages/home.php';
				}
			},
			error:function(res3) {
				if(res3==="incorrect")
				{
					alert("Username and Password are incorrect");
				}
			}
		})
		// .done(function(res3) {
		// 	if(res3=="correct")
		// 	{
		// 		window.location.href='./pages/home.php';
		// 	}
		// })
		// .fail(function(res3) {
		// 	if(res3=="incorrect")
		// 	{
		// 		alert("Username and Password are incorrect");
		// 	}
		// })
		// .always(function(res3) {
		// 	//alert("wait");
		// });
		
	} 
}

$(document).ready(function()
{
	$("#form-username").val("");
	$("#form-password").val("");
	$("#form-username").focus();

	$("#loginBtn").on('click', loginFunction);
	$("#form-username").keypress(function(event)
	{
		if(event.which == 13)
		{
			event.preventDefault();
			$("#loginBtn").click();
		}
		
	});
	$("#form-password").keypress(function(event)
	{
		if(event.which == 13)
		{
			event.preventDefault();
			$("#loginBtn").click();
		}
		
	});
});

//Or changing the button type to submit
//$(document).ready(function() {
//  $("#myForm").submit(function(event) {
//   event.preventDefault();
//    loginFunction();
//  })
//})
