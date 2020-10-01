$(document).ready(function(){
	$("#pid").on('change', function(){
		var getId = $("#pid").val();
		$("#patient_name").val(getId);
	});
	$("#patient_name").on('change', function(){
		var getId = $("#patient_name").val();
		$("#pid").val(getId);
	});

	$("#medication_id").on('change', function(){

		$("#old_treatment").val($("#old_treatment").val() + " + " + $("#medication_id option:selected").text());
	});

	$("#new_medication_id").on('change', function(){

		$("#new_treatment").val($("#new_treatment").val() + " + " + $("#new_medication_id option:selected").text());
	});

	$(document).on('change', '.select', function(){
		var getId = $(this).closest('tr').attr('id');
		var currentStatus = $(this).closest('tr').find('.currentStatus').html();
		var newStatus = $(this).closest('tr').find('.select').val();
		var tdToChange = $(this).closest('tr').children('td.currentStatus');
		var resetDropList = $(this).closest('tr').find('.select');
		//console.log(newStatus);
		if(currentStatus==newStatus)
		{
			alert("The status didn't changed, because you chosed the same one");
		}
		else if(newStatus=="select")
		{
			alert("Please select a status again");
		}
		else
		{
			$.ajax({
				url: '../php/changeTreatmentStatus.php',
				data: {id: getId, newStatus: newStatus},
				type: 'POST',
				dataType: 'TEXT',
				success:function(resp)
				{
					resetDropList.val("select");
					tdToChange.text(resp);
				},
				error:function(resp)
				{
					console.log(resp);
				}

			})
		}
	})

	$("#searchBtn").on('click', function(){
		var id = $("#pid").val();
		var patient_name = $("#patient_name").val();
		var monthOfChange = $("#expiry_date").val();
		//console.log(monthOfChange)
		var old_treatment = $("#old_treatment").val();
		var new_treatment = $("#new_treatment").val();
		var status = $("#treatment_status").val();

		if(id=="" || id=="select")
		{
			alert("please specify the patient ID");
			$("#pid").css('border-color', 'red');
			$("#pid").focus();
		}
		else if(monthOfChange=="")
		{
			alert("please specify the date");
			$("#expiry_date").css('border-color', 'red');
			$("#expiry_date").focus();
		}
		else if(old_treatment=="")
		{
			alert("please specify the old treatment");
			$("#old_treatment").css('border-color', 'red');
			$("#old_treatment").focus();
		}
		else
		{
			$("#pid").css('border-color', '#0090ff');
			$("#expiry_date").css('border-color', '#0090ff');
			$("#old_treatment").css('border-color', '#0090ff');

			$.ajax({
				url: '../php/addTreatmentChange.php',
				data: {id: id, monthOfChange: monthOfChange, old_treatment: old_treatment,
					  new_treatment: new_treatment, status: status},
				type: 'POST',
				dataType: 'JSON',
				success:function(resp)
				{
					$("#pid").val("select");
					$("#patient_name").val("select");
					$("#medication_id").val("select");
					$("#new_medication_id").val("select");
					$("#expiry_date").val("");
					$("#old_treatment").val("");
					$("#new_treatment").val("");
					$("#treatment_status").val("");
					//Results
					//$("#res_table #after_tr").fadeOut(400);
					//$.each(resp, function(key, result){
					$("#res_table #after_tr").after("<tr id="+resp['treatment_id']+"><td>"+resp['patient_id']+"</td><td>"+resp['patient_name_en']+"</td><td>"+resp['old_treatment']+"</td><td>"+resp['new_treatment']+"</td><td>"+resp['date_of_change']+"</td><td class='currentStatus'>"+resp['treatment_status']+"</td><td><select id='change_status' class='form-control select'><option value='select'>Select</option><option value='Active'>Active</option><option value='Inactive'>Inactive</option></select></td></tr>");
					$(document).on('change', '.select', function(){
						var getId = $(this).closest('tr').attr('id');
						var currentStatus = $(this).closest('tr').find('.currentStatus').html();
						var newStatus = $(this).closest('tr').find('.select').val();
						var tdToChange = $(this).closest('tr').children('td.currentStatus');
						var resetDropList = $(this).closest('tr').find('.select');
						//console.log(newStatus);
						if(currentStatus==newStatus)
						{
							alert("The status didn't changed, because you chosed the same one");
						}
						else if(newStatus=="select")
						{
							alert("Please select a status again");
						}
						else
						{
							$.ajax({
								url: '../php/changeTreatmentStatus.php',
								data: {id: getId, newStatus: newStatus},
								type: 'POST',
								dataType: 'TEXT',
								success:function(resp)
								{
									resetDropList.val("select");
									tdToChange.text(resp);
								},
								error:function(resp)
								{
									console.log(resp);
								}

							})
						}
					})
					//});
				},
				error:function(resp)
				{
					console.log(resp);
				}
			})
		}
	})
})