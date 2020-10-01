$(document).ready(function()
{
	$("#searchBtn").on('click', function()
	{
		alert("Contact an administrator to add a new medication");
	// 	var searchTxt = $("#searchTxt").val();
	// 	if(searchTxt == "")
	// 	{
	// 		$("#searchTxt").css('border-color', 'red');
	// 		$("#searchTxt").focus();
	// 	}
	// 	else
	// 	{
	// 		searchTxt = $.trim(searchTxt);
	// 		$.ajax({
	// 			url: '../php/addMed.php',
	// 			type: 'POST',
	// 			data: {medName: searchTxt},
	// 			dataType: 'TEXT',
	// 			success:function(resp)
	// 			{
	// 				if(resp=="exist")
	// 				{
	// 					alert("Medication Already Exist!");
	// 				}
	// 				else
	// 				{
	// 					$('#medication_id').append($('<option>', {value:resp, text:searchTxt}));

	// 					$("#searchTxt").css('border-color', '#0090ff');
	// 					$("#searchTxt").val("");
	// 				}
	// 			},
	// 			error:function(resp)
	// 			{
	// 				console.log(resp);
	// 			}
	// 		})
	// 	}
	// })
	}
})