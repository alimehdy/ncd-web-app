var getTemplateThreeData = function()
{
	var nationality = $("#selectNat").val();
	//var monthVal = $("#searchTxt").val();
	if(nationality == "Lebanese")
	{
		$("#tempNum").text("9");
		$("#img1").attr('src', '../images/ministry.png');
		$("#th2").text("المشروع المشترك لتأمين الأدوية للمرضى المزمنين").css('font-size', '120%');
		$("#img3").attr('src', '../images/ymca.png');
		$("#thCode").text("الرمز");
		$("#thCode2").text("الرمز");
	}
	else
	{
		$("#tempNum").text("۹");
		$("#img1").attr('src', '../images/ymca.png');
		$("#th2").html("<img src='../images/imc.gif'></img>");
		$("#img3").attr('src', '../images/unhcr.png');
		$("#thCode").text("رقم بطاقة اللجوء");
		$("#thCode2").text("رقم بطاقة اللجوء");
	}
	if(nationality == "select")
	{
		$("#selectNat").css('border-color', 'red');
		$("#selectNat").focus();
	}
	// else if(monthVal == undefined || monthVal == "")
	// {
	// 	$("#searchTxt").css('border-color', 'red');
	// 	$("#searchTxt").focus();
	// }
	else
	{
		// $("#searchTxt").css('border-color', '#0090ff');
		// $("#selectNat").css('border-color', '#0090ff');
		// var allMonths = ["كانون الثاني - January", 
		// 				"شباط - February", 
		// 				"آذار - March",
		// 				"نيسان - April", 
		// 				"أيار - May", 
		// 				"حزيران - June", 
		// 				"تموز - July",
		// 				"آب - August", 
		// 				"أيلول - September", 
		// 				"تشرين أول - October",
		// 				"تشرين ثاني - November", 
		// 				"كانون الأول - December"];
		// var date = new Date(monthVal);
		// var monthNumber = date.getMonth();
		// console.log(allMonths[monthNumber]);
		// console.log(monthVal);
		// $("#getMonthName").text(monthVal +" ("+allMonths[monthNumber]+")");
		$.ajax({
			url:'../php/getTemplateNineData.php',
			type: 'POST',
			data: {nationality},
			dataType: 'JSON',
			success:function(resp)
			{
				console.log(resp)
				$("#tempThreeTable #fade").fadeOut(400);
				$.each(resp, function(key, result)
				{
					if(result['patient_status']=='Deceased')
					{
						console.log(result['patient_status']);
						$('#tempThreeTable #after_tr_deceased').after("<tr id='fade'><td colspan='3'>"
							+result['patient_name_en']+"</td><td colspan='3'>"
							+result['unhcr_registration_number']+"</td><td colspan='3'>"
							+result['nationality']+"</td></tr>");
					}
					else
					{
						console.log(result['patient_status']);
						$('#tempThreeTable #after_tr_discharged').after("<tr id='fade'><td colspan='3'>"
							+result['patient_name_en']+"</td><td colspan='3'>"
							+result['patient_id']+"</td><td colspan='3'>"
							+result['nationality']+"</td></tr>");
					}
				});
			},
			error:function(resp)
			{
				//console.log(resp)
			}
		})
	}
}

$(document).ready(function()
{
  //$('#searchTxt').on('change', getTemplateThreeData);
  $('#selectNat').on('change', getTemplateThreeData);
  $('#searchBtn').on('click', getTemplateThreeData);
});