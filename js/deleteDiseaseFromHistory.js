$(document).ready(function()
{
	$(document).on('click', '#delete_disease ', function()
	{
		var elem = $(this).closest('tr');
		var patient_medication_id = $(this).closest('tr').attr('id');
		var pid = $("#pid").val();
		if(confirm("Are you sure that you want to remove the selected history?"))
		{
			$.ajax({
				url: "../php/deleteDiseaseFromHistory.php",
				type: 'POST',
				data: { pmid: patient_medication_id, pid: pid},
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