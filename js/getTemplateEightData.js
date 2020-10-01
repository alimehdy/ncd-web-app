var getTemplateThreeData = function()
{
	var nationality = $("#selectNat").val();
	var monthVal = $("#searchTxt").val();
	console.log(monthVal)
	if(nationality == "Lebanese")
	{
		$("#tempNum").text("8");
		$("#img1").attr('src', '../images/ministry.png');
		$("#th2").text("GOOD STORAGE AND DISTRIBUTION. PRACTICES OF PHARMACEUTICAL").css('font-size', '120%');
		$("#th3").text("CODE: YMCA-F-03-07 (EDITION 1 Page 6/8(");
		$("#img3").attr('src', '../images/ymca.png');
		$("#thCode").text("الرمز");
	}
	else
	{
		$("#tempNum").text("٨");
		$("#img1").attr('src', '../images/ymca.png');
		$("#th2").text("GOOD STORAGE AND DISTRIBUTION. PRACTICES OF PHARMACEUTICAL");
		$("#th3").text("CODE: YMCA-F-02-07 (EDITION 1 Page 5/6)");
		$("#img3").attr('src', '../images/ministry.png');
		$("#thCode").text("رقم بطاقة اللجوء");
	}
	if(nationality == "select")
	{
		$("#selectNat").css('border-color', 'red');
		$("#selectNat").focus();
	}
	else if(monthVal == undefined || monthVal == "")
	{
		$("#searchTxt").css('border-color', 'red');
		$("#searchTxt").focus();
	}
	else
	{
		$("#searchTxt").css('border-color', '#0090ff');
		$("#selectNat").css('border-color', '#0090ff');
		var allMonths = ["كانون الثاني - January", 
						"شباط - February", 
						"آذار - March",
						"نيسان - April", 
						"أيار - May", 
						"حزيران - June", 
						"تموز - July",
						"آب - August", 
						"أيلول - September", 
						"تشرين أول - October",
						"تشرين ثاني - November", 
						"كانون الأول - December"];
		var date1 = new Date(monthVal);
		var monthNumber = date1.getMonth();
		console.log(allMonths[monthNumber]);
		console.log(monthVal);
		$("#getMonthName").text(monthVal +" ("+allMonths[monthNumber]+")");
		$.ajax({
			url:'../php/getTemplateEightData.php',
			type: 'POST',
			data: {monthVal, nationality},
			dataType: 'JSON',
			success:function(resp)
			{
				$("#tempThreeTable #fade").fadeOut(400);
				$.each(resp, function(key, result)
				{
					if(result['nationality']=='Syrian')
					{
						$('#after_tr').after("<tr id='fade'><td colspan='2'>"
							+result['patient_name_en']+"</td><td colspan='3'>"
							+result['old_treatment']+"</td><td colspan='4'>"
							+result['new_treatment']+"</td></tr>");
					}
					else
					{
						$('#after_tr').after("<tr id='fade'><td colspan='2'>"
							+result['patient_name_en']+"</td><td colspan='3'>"
							+result['old_treatment']+"</td><td colspan='4'>"
							+result['new_treatment']+"</td></tr>");
					}
				});
			},
			error:function(resp)
			{
				
			}
		})
	}
}

$(document).ready(function()
{
  $('#selectNat').val('Syrian');
  getTemplateThreeData();
  $('#searchTxt').on('change', getTemplateThreeData);
  $('#selectNat').on('change', getTemplateThreeData);
  $('#searchBtn').on('click', getTemplateThreeData);
});