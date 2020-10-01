$(document).ready(function()
{
	$(document).on('click', '#delete_allergy ', function()
	{
		var elem = $(this).closest('tr');
		var patient_allergy_id = $(this).closest('tr').attr('id');
		var pid = $("#pid").val();
		if(confirm("Are you sure that you want to remove the selected allergy?"))
		{
			$.ajax({
				url: "../php/deleteAllergyFromHistory.php",
				type: 'POST',
				data: { paid: patient_allergy_id, pid: pid},
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