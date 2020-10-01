var getMonthlyReport = function()
{
	//Display the month
	var displayMonth = [
		"January - كانون الثاني",
		"February - شباط",
		"March - آذار",
		"April - نيسان",
		"May - أيار",
		"June - حزيران",
		"July - تموز",
		"August - آب",
		"September - أيلول",
		"October - تشرين أول",
		"November - تشرين الثاني",
		"December - كانون الأول"
	];

	//var nationality = $("#selectNat").val();
	var monthVal = $("#searchTxt").val();
	var monthInt = new Date(monthVal);
	monthInt = monthInt.getDate();
	var displayValueOfMonth = displayMonth[monthInt];

	$.ajax({
		url: '../php/getDailyReport.php',
		data: {selectedDate: monthVal},
		type: 'POST',
		datatype: 'JSON',
		success:function(resp)
		{
			$("#monthReport tr").fadeOut(400);
			$("#after_tr").before("<tr class='bg-info'><th></th><th>Daily Report For:</th><th id='monthName' colspan='3'>"+monthVal+"</th><th>TOTAL</th></tr>");

		    $(" #after_tr").after("<tr><th></th><th>Foot Examination</th><td colspan='3'>"+resp.monthArr['foot_examination']+"</td><td>"+resp.alltimeArr['foot_examination']+"</td></tr>");	
		    $(" #after_tr").after("<tr><th></th><th>Chemistry Blood Test</th><td colspan='3'>"+resp.monthArr['chemistry']+"</td><td>"+resp.alltimeArr['chemistry']+"</td></tr>");	
		    $(" #after_tr").after("<tr><th></th><th>HbA1C</th><td colspan='3'>"+resp.monthArr['hba']+"</td><td>"+resp.alltimeArr['hba']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>Others</th><td colspan='3'></td><td></td></tr>");	
			$(" #after_tr").after("<tr><th>Epilepsy</th><td colspan='3'></td><td></td></tr>");	
			$(" #after_tr").after("<tr><th>Respiratory Chronic Disease</th><td colspan='3'></td><td></td></tr>");	
			$(" #after_tr").after("<tr><th>Cardio Vascular + Diabetes</th><td colspan='3'></td><td></td></tr>");	
			$(" #after_tr").after("<tr><th>Diabetes</th><td colspan='3'></td><td></td></tr>");	
			$(" #after_tr").after("<tr><th style='vertical-align: middle;' id='thspan5' rowspan='6'>Disease</th><th>Cardio Vascular Disease</th><td colspan='3'></td><td></td></tr>");	
			$(" #after_tr").after("<tr><th>Others</th><td colspan='3'>"+resp.monthArr['other_nationality']+"</td><td>"+resp.alltimeArr['other_nationality']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>Total Syrian</th><td colspan='3'>"+resp.monthArr['syrian_patient']+"</td><td>"+resp.alltimeArr['syrian_patient']+"</td></tr>");	
			$(" #after_tr").after("<tr><th style='vertical-align: middle;' id='thspan4' rowspan='3'>Nationality</th><th>Total Lebanese</th><td colspan='3'>"+resp.monthArr['lebanese_patient']+"</td><td>"+resp.alltimeArr['lebanese_patient']+"</td></tr>");	
			$(" #after_tr").after("<tr><th></th><th>Assessment %</th><td colspan='3'>"+resp.monthArr['average_assessment']+"</td><td>"+resp.alltimeArr['average_assessment']+"</td></tr>");	
			$(" #after_tr").after("<tr><th></th><th>Assessment #</th><td colspan='3'>"+resp.monthArr['total_assessment']+"</td><td>"+resp.alltimeArr['total_assessment']+"</td></tr>");	
			$(" #after_tr").after("<tr><th></th><th>HGT</th><td colspan='3'>"+resp.monthArr['hgt']+"</td><td>"+resp.alltimeArr['hgt']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>Other than relative</th><td colspan='3'>"+resp.monthArr['other']+"</td><td>"+resp.alltimeArr['other']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>Relative</th><td colspan='3'>"+resp.monthArr['relative']+"</td><td>"+resp.alltimeArr['relative']+"</td></tr>");	
			$(" #after_tr").after("<tr><th style='vertical-align: middle;' id='thspan3' rowspan='3'>Med Collection</th><th>Patient Himself</th><td colspan='3'>"+resp.monthArr['himself']+"</td><td>"+resp.alltimeArr['himself']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>NCD-Endo</th><td colspan='3'>"+resp.monthArr['ncd_endo']+"</td><td>"+resp.alltimeArr['ncd_endo']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>NCD-Cardio</th><td colspan='3'>"+resp.monthArr['ncd_cardio']+"</td><td>"+resp.alltimeArr['ncd_cardio']+"</td></tr>");	
			$(" #after_tr").after("<tr><th style='vertical-align: middle;' id='thspan2' rowspan='3'>Follow Up</th><th>Medication Collection</th><td colspan='3'>"+resp.monthArr['medication_collection']+"</td><td>"+resp.alltimeArr['medication_collection']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>New Patient</th><td colspan='3'>"+resp.monthArr['new_patient']+"</td><td>"+resp.alltimeArr['new_patient']+"</td></tr>");	
			$(" #after_tr").after("<tr><th>Total Consultation</th><td colspan='3'>"+resp.monthArr['total_consultation']+"</td><td>"+resp.alltimeArr['total_consultation']+"</td></tr>");	
			$(" #after_tr").after("<tr><th style='vertical-align: middle;' id='thspan1' rowspan='3'>Patients</th><th>Total NCD Patient</th><td colspan='3'>"+resp.monthArr['total_patient']+"</td><td>"+resp.alltimeArr['total_patient']+"</td></tr>");	
			$("#thspan1, #thspan2, #thspan3, #thspan4, #thspan5").addClass('monthlyReport');
		},
		error:function(resp)
		{
			console.log(resp);
		}
	})
}

$(document).ready(function()
{
	$('#searchTxt').css('border-color', 'red');
  	$('#searchTxt').on('change', getMonthlyReport);
  	$('#searchBtn').on('click', getMonthlyReport);
});