var searchFunction = function(){
	var searchTxt = $("#searchTxt").val();
	searchTxt = $.trim(searchTxt);
	//console.log(searchTxt);
	if(searchTxt !="Select" )
	{
		//Get the remaining
		$.ajax({
			url: '../php/getRemaining.php',
			type: 'POST',
			data: {mid: searchTxt},
			dataType: 'TEXT',
			success:function(resp3)
			{
				$("#still_pill_ajax").text(resp3);
			},
			error:function(resp3)
			{
				console.log(resp3);
			}
		})
		//Get Medication Delivery History
		$.ajax({
			url: '../php/getMedicationsForSearch.php',
			type: 'POST',
			data: {mid: searchTxt},
			dataType: 'JSON',

			success:function(resp)
			{
				//append data
				var medQuantity = 0;
				$("#med_table tr").fadeOut(400);
				$("#after_tr").before("<tr class='bg-info'><th colspan='10' style='text-align: center'>The initial stock (الكمية التي أدخلت الى ابرنامج منذ أول العام)</th></tr><tr><th>Medication ID</th><th colspan='2'>Medication Name</th><th>Medication Barcode</th><th>Date Received</th><th>Expiry Date</th><th>Pills Quantity</th></tr>");
				$.each( resp, function(key, result)
				{
					medQuantity = parseInt(medQuantity)+parseInt(result['med_pill']);
					//var pid = result['patient_id'];

					//var profileBtn = "<a id='profileBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Patient Profile</span></a>"
					$("#after_tr").after("<tr class='classLine' id="+result['med_pharmacy_id']+"><td>"+result['med_id']+"</td><td colspan='2'>"+result['med_name']+"</td><td>"
						+result['med_barcode']+"</td><td>"+result['med_received']+"</td><td>"
						+result['med_expiry']+"</td><td class='tdSel'>"+result['med_pill']+"</td></tr>");
				});
				$("#after_tr").before("<tr><th colspan='6'>Total Received</th><th>"+medQuantity+"</th></tr>");
				//Get patient and given quantity
				$.ajax({
					url: '../php/getMedicationDistributionReport.php',
					type: 'POST',
					data: {mid: searchTxt},
					dataType: 'JSON',
					success:function(resp2)
					{
						//append data
						
						$("#med_table_distribution tr").fadeOut(400);
						$("#med_table_distribution #after_tr_distribution").before("<tr class='bg-info'><th colspan='10' style='text-align: center'>Patient who received this medication (المرضى الّذين حصلوا على هذا الدواء)</th></tr><tr><th>Patient ID</th><th colspan='3'>Patient Name</th><th>Visit ID</th><th>Date of Visit</th><th colspan='2'>Medication Name</th><th>Collector</th><th>Quantity Given</th></tr>");
						$.each( resp2, function(key, result2)
						{
							//var pid = result['patient_id'];
							var sumGiven = parseInt(result2['sumGiven']);
							//var profileBtn = "<a id='profileBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Patient Profile</span></a>"
							$("#after_tr_distribution").after("<tr id="+result2['patient_id']+"><td>"+result2['patient_id2']+"</td><td colspan='3'>"+result2['patient_name_en2']+"</td><td>"+result2['visit_id']+"</td><td>"+result2['date_of_visit']+"</td><td colspan='2'>"
								+result2['med_name']+"</td><td>"+result2['medication_collector']+"</td><td>"
								+result2['given_quantity']+"</td></tr>");
						});
						
						//console.log(sumGiven);
					},
					error:function(resp2)
					{
						console.log(resp2);
					}
					
				})
			},
			error:function(resp)
			{
				console.log(resp);
			}
		});
	}
}

$(document).ready(function()
{
	$("#searchTxt").on('keyup', searchFunction);
	$("#searchTxt").on('change', searchFunction);
	$("#searchBtn").on('click', searchFunction);
});