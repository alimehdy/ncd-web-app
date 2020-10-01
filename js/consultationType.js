$(document).ready(function()
{
	$("#consultation_name").on('change', function()
	{
		var pidForHeight = $("#patient_id").val();
		$.ajax({
			url: '../php/getHeight.php',
			data: {pidForHeight: pidForHeight},
			type: 'POST',
			dataType: 'JSON',
			success:function(resp)
			{
				if(resp!='Unavailable'){
					$("#patient_height").val(resp);
					console.log(resp);
				}
				else
				{
					$("#patient_height").val(resp);
				}
			},
			error:function(resp){
				console.log(resp);
			}
		})
		var val = $("#consultation_name").val();
		if(val == "MedicationCollection")
		{
			$("#visit_reason").prop('disabled', true);
			$("#diagnosis").prop('disabled', true);
			//$("#patient_weight").val("0");
			//$("#patient_height").val("0");
			//$("#patient_weight").prop('disabled', true);
			//$("#patient_height").prop('disabled', true);
			$("#complication_name").prop('disabled', true);
			$("#complication_name_2").prop('disabled', true);
			$("#complication_name_3").prop('disabled', true);
			$("#complication_name_3").val("Regular Medication Collection Visit");
			$("#visit_reason").val("This visit occured for medication collection only");
		}
		else if(val != "MedicationCollection")
		{
			$("#diagnosis").prop('disabled', false);
			$("#visit_reason").prop('disabled', false);
			//$("#patient_weight").prop('disabled', false);
			//$("#patient_height").prop('disabled', false);
			$("#complication_name").prop('disabled', false);
			$("#complication_name_2").prop('disabled', false);
			$("#complication_name_3").prop('disabled', false);
			$("#visit_reason").val("");
			$("#complication_name_3").val("");
			$("#diagnosis").val("");
		}
	})

})