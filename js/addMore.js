$(document).ready(function()
{
	$("#medication_collector").on('change', function()
	{
		var MedCollector = $("#medication_collector").val()
		if(MedCollector != "other")
		{
			$("medication_collector_2").val(MedCollector);;
		}
		if(MedCollector == "other")
		{
			$("medication_collector_2").val("");
		}
	})
	$("#add_more").on('click', function()
	{

		var doctor_id = $("#doctor_list_id").val();
		var nurse_id = $("#nurse_list_id").val();
		var diagnosis = $("#diagnosis").val();
		var medication_id = $("#medication_id").val();
		var medication_id_text = $("#medication_id").text();
		var medication_quantity = $("#medication_quantity").val();
		var consultation_result = $("#consultation_result").val();
		var medication_collector = $("#medication_collector").val();
		var medication_collector_2 = $("#medication_collector_2").val();
		console.log(consultation_result);
		if(diagnosis == "select" || diagnosis ==null)
		{
			alert("Please specify a diagnosis");
			$("#diagnosis").css('border-color', 'red');
			$("#diagnosis").focus();
		}
		else if(medication_collector == "select")
		{
			$("#medication_collector").css('border-color', 'red');
			$("#consultation_name").focus();
		}
		else if(medication_collector == "other" && medication_collector_2 == "Other")
		{
			$("#medication_collector_2").css('border-color', 'red');
			$("#medication_collector_2").on('focus', function()
			{
				$(this).val("");
			})
			//$("#medication_collector_2").focus();
		}
		else if(medication_collector_2 == "")
		{
			$("#medication_collector_2").css('border-color', 'red');
			$("#consultation_name_2").focus();
		}
		else if(doctor_id=="select" && nurse_id=="select")
		{
			//console.log(doctor_id)

			$("#doctor_list_id").css('border-color', 'red');
			$("#nurse_list_id").css('border-color', 'red');
			$("#doctor_list_id").focus();
		}

		// else if(medication_id=="select" || medication_id =="")
		// {
		// 	$("#medication_id").css('border-color', 'red');
		// 	$("#medication_id").focus();
		// }
		// else if(medication_id_text=="")
		// {
		// 	$("#medication_id").css('border-color', 'red');
		// 	alert("Please select a medication");
			
		// }
		// else if(medication_quantity=="")
		// {
		// 	$("#medication_quantity").css('border-color', 'red');
		// 	$("#medication_quantity").focus();
		// }
		else if(consultation_result=="")
		{
			$("#consultation_result").css('border-color', 'red');
			$("#consultation_result").focus();
		}
		else
		{
			$("#diagnosis").css('border-color', '#0090ff');
			$("#doctor_list_id").css('border-color', '#0090ff');
			$("#nurse_list_id").css('border-color', '#0090ff');
			$("#medication_id").css('border-color', '#0090ff');
			$("#medication_quantity").css('border-color', '#0090ff');
			$("#consultation_result").css('border-color', '#0090ff');
			$("#medication_collector").css('border-color', '#0090ff');
			$("#medication_collector_2").css('border-color', '#0090ff');

			var resp = $("#visit_id").val();
			var pid = $("#pid").val();
			var cid = $("#complication_name_3").val();
			var consultation_result = $("#consultation_result").val();
			var pid = $("#patient_id").val();
			var doctor_id = $("#doctor_list_id").val();
			var nurse_id = $("#nurse_list_id").val();
			var medication_collector_2 = $("#medication_collector_2").val();
			$.ajax({
				url: '../php/addConsultation.php',
				type: 'POST',
				data: {visit_id: resp, pid: pid,
				       nid: nurse_id, did: doctor_id,
				       cid: cid, diagnosis: diagnosis,
				       medication_id: medication_id,
				       medication_quantity: medication_quantity,
				       consultation_result: consultation_result,
				       patient_id: pid, medication_collector_2: medication_collector_2},
				dataType: 'TEXT',

				success:function(response)
				{

					//alert("Data Added. Please add more, or close the box!");
					$("#doctor_list_id").val("select");
					$("#nurse_list_id").val("select");
					$("#complication_name_2").val("select");
					$("#diagnosis").val("select");
					$("#medication_quantity").val("");
					$("#medication_id").val("select");
					$("#consultation_result").val("");
					$("#complication_name_3").val("");
					//console.log(response);

				},
				error:function(response)
				{
					console.log(response);
				}
			})
		}
	});
});