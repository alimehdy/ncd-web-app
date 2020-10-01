$(document).ready(function()
{
	//Getting the height if exist
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

	$("#medication_collector").on('change', function()
	{
		var MedCollector = $("#medication_collector").val()
		if(MedCollector != "other")
		{
			MedCollector = "";
		}
		$("medication_collector_2").val(MedCollector);
	})
	$("#add_visit_info").on('click', function()
	{
		var setDate = new Date();
		var dov = $("#date_of_visit").val();
		var dovConvert = new Date(dov);
		//console.log("Selected: "+dovConvert+" Current: "+setDate );
		
		var rov = $("#visit_reason").val();
		var doctor_id = $("#doctor_list_id").val();
		var nurse_id = $("#nurse_list_id").val();
		var patient_weight = $("#patient_weight").val();
		var patient_height = $("#patient_height").val();
		var patient_pressure = $("#patient_pressure").val();

		var consultation_result = $("#consultation_result").val();
		var pid = $("#patient_id").val();
		var visit_status = $("#visit_status").val();
		var consultation_name = $("#consultation_name").val();

		if(dov == "")
		{
			$("#date_of_visit").css('border-color', 'red');
			$("#date_of_visit").focus();
		}
		else if(dovConvert>setDate){
			alert("The date is wrong, please select the right one! Data is not added.");
			$("#date_of_visit").css('border-color', 'red');
			$("#date_of_visit").focus();
		}
		// else if(patient_weight=="")
		// {
		// 	$("#patient_weight").css('border-color', 'red');
		// 	$("#patient_weight").focus();
		// }
		// else if(patient_height=="")
		// {
		// 	$("#patient_height").css('border-color', 'red');
		// 	$("#patient_height").focus();
		// }
		else if(consultation_name == "select")
		{
			$("#date_of_visit").css('border-color', 'red');
			$("#consultation_name").css('border-color', 'red');
			$("#consultation_name").focus();
		}
		else if(patient_weight=="")
		{
			$("#patient_weight").css('border-color', 'red');
		    $("#patient_weight").focus();
		}
		else if(patient_pressure=="")
		{
			$("#patient_pressure").css('border-color', 'red');
			$("#patient_pressure").focus();
		}
		else if(patient_height=="")
		{
			$("#patient_height").css('border-color', 'red');
		    $("#patient_height").focus();
		}
		else
		{
			$("#date_of_visit").css('border-color', '#0090ff');
			$("#consultation_name").css('border-color', '#0090ff');
			$("#patient_weight").css('border-color', '#0090ff');
			$("#patient_height").css('border-color', '#0090ff');
			$("#patient_pressure").css('border-color', '#0090ff');
			//Ajax
			$.ajax({
				url: '../php/addVisit.php',
				type: 'POST',
				data: {dov: dov, 
					   rov: rov,
					   consultation_name: consultation_name, 
					   visit_status: visit_status,
					   pid: pid, patient_height: patient_height, 
					   patient_weight:patient_weight, patient_pressure: patient_pressure},
				dataType: 'TEXT',
				success:function(resp)
				{
					var visit_id = resp;
					console.log(resp)
					$("#visit_id").val(visit_id);
					$('#dialog').dialog({
                      autoOpen: false, 
                      hide: "puff",
                      show : "slide",
                      width: 800,
                      modal: true
    				});
    				$( "#dialog" ).dialog( "open" );
    				if($("#consultation_name").val()=="MedicationCollection")
    				{
    					var txt = "A Regular Medication Collection Visit";
    					$.ajax({
    						url: '../php/getDiagnosisMedCollection.php',
    						type: 'POST',
    						data: {txt: txt},
    						dataType: 'TEXT',
    						success:function(resp)
    						{
    							$("#diagnosis").val(resp);
    						},
    						error:function(resp)
    						{
    							console.log(resp);
    						}
    					})

    				}
					$("#add_more").on('click', function()
					{
					var doctor_id = $("#doctor_list_id").val();
					var nurse_id = $("#nurse_list_id").val();
					var diagnosis = $("#diagnosis").val();
					console.log("Diag: " + diagnosis);
					var medication_id = $("#medication_id").val();
					var medication_quantity = $("#medication_quantity").val();
					var consultation_result = $("#consultation_result").val();
					var medication_collector = $("#medication_collector").val();
					var medication_collector_2 = $("#medication_collector_2").val();
					if(diagnosis == "select" || diagnosis==null)
					{
						alert("Please specify a diagnosis");
						$("#diagnosis").css('border-color', 'red');
						$("#diagnosis").focus();
					}
					else if(doctor_id=="select" && nurse_id=="select")
					{
						
						$("#doctor_list_id").css('border-color', 'red');
						$("#nurse_list_id").css('border-color', 'red');
						$("#doctor_list_id").focus();
						$("#danger_message_dr").show();
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
					// else if(nurse_id=="select")
					// {
					// 	$("#nurse_list_id").css('border-color', 'red');
					// 	$("#nurse_list_id").focus();
					// }

					// else if(medication_id=="select")
					// {
					// 	$("#medication_id").css('border-color', 'red');
					// 	$("#medication_id").focus();
					// }
					// else if(medication_quantity=="")
					// {
					// 	$("#medication_quantity").css('border-color', 'red');
					// 	$("#medication_quantity").focus();
					// }
					// else if(consultation_result=="")
					// {
					// 	$("#consultation_result").css('border-color', 'red');
					// 	$("#consultation_result").focus();
					// }
					else
					{

						if(doctor_id=="select")
						{
							doctor_id = null;
						}
						if(nurse_id=="select")
						{
							nurse_id = null;
						}
						$("#doctor_list_id").css('border-color', '#0090ff');
						$("#nurse_list_id").css('border-color', '#0090ff');
						$("#medication_id").css('border-color', '#0090ff');
						$("#consultation_result").css('border-color', '#0090ff');
						$("#medication_collector_2").css('border-color', '#0090ff');
						$("#medication_collector").css('border-color', '#0090ff');
						
						var cid = $("#complication_name_3").val();
						var consultation_result = $("#consultation_result").val();
						var pid = $("#patient_id").val();
						if(doctor_id == "select")
						{
							doctor_id="";
						}
						else
						{
							var doctor_id = $("#doctor_list_id").val();
						}
						if(nurse_id == "select")
						{
							nurse_id = "";
						}
						else
						{
							var nurse_id = $("#nurse_list_id").val();
						}
						
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
								alert("Data Added. Please add more, or close the box!");
								//$("#doctor_list_id").val("select");
								//$("#nurse_list_id").val("select");
								$("#complication_name_2").val("select");
								console.log(diagnosis)
								if($("#diagnosis").val()==1)
								{
									console.log("here");
									$("#diagnosis").val(1);
								}
								$("#medication_quantity").val("");
								$("#medication_id").val("select");
								$("#consultation_result").val("");
								$("#complication_name_3").val("");
								//if($("#consultation_name").val()=="MedicationCollection")
								//{
								//	$("#diagnosis").val("MedicationCollection");
								//}
								//$("#complication_name_3").val("Regular Medication Collection Visit");
								//console.log(response);
							},
							error:function(response)
							{
								console.log(response);
							}
						})
					}
					});
				},
				error:function(resp)
				{
					console.log(resp);
				}
			});
		}
	})
});