$(document).ready(function()
{
	$(document).on('click', '#delete_surgery ', function()
	{
		var elem = $(this).closest('tr');
		var surgical_info_id = $(this).closest('tr').attr('id');
		var pid = $("#pid").val();
		if(confirm("Are you sure that you want to remove the selected surgery?"))
		{
			$.ajax({
				url: "../php/deleteSurgeryFromHistory.php",
				type: 'POST',
				data: { psid: surgical_info_id, pid: pid},
				dataType: 'TEXT',
				success:function(resp)
				{
					if(resp="deleted")
					{
						elem.fadeOut(800, function() {
							//after finishing animation
						});
					}
				},
				error:function(resp)
				{
					alert("Please try again");
				}
			});
		}
	});
});