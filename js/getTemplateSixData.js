var getTemplateThreeData = function()
{
	var nationality = $("#selectNat").val();
	var monthVal = $("#searchTxt").val();
	if(nationality == "Lebanese")
	{
		$("#tempNum").text("6");
		$("#img1").attr('src', '../images/ministry.png');
		$("#th2").text("المشروع المشترك لتأمين الأدوية للمرضى المزمنين").css('font-size', '120%');
		$("#img3").attr('src', '../images/ymca.png');
		$("#thCode").text("الرمز");
	}
	else
	{
		$("#tempNum").text("٦");
		$("#img1").attr('src', '../images/ymca.png');
		$("#th2").html("<img src='../images/imc.gif'></img>");
		$("#img3").attr('src', '../images/unhcr.png');
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
		var date = new Date(monthVal);
		var monthNumber = date.getMonth();
		console.log(allMonths[monthNumber]);
		console.log(monthVal);
		$("#getMonthName").text(monthVal +" ("+allMonths[monthNumber]+")");
		$.ajax({
			url:'../php/getTemplateThreeData.php',
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
						$('#after_tr').after("<tr id='fade'><td>"
							+result['patient_id']+"</td><td>"
							+result['patient_name_en']+"</td><td>"
							+result['patient_address']+"</td><td colspan='2'>"
							+result['med_name']+"</td><td>"
							+result['given_quantity']+"</td><td></td></tr>");
					}
					else
					{
						$('#after_tr').after("<tr id='fade'><td>"
							+result['patient_id']+"</td><td>"
							+result['patient_name_en']+"</td><td>"
							//+result['nationality']+"</td><td>"
							//+result['gender']+"</td><td style='width: fit'>"
							//+result['dob']+"</td><td>"
							+result['patient_address']+"</td><td colspan='2'>"
							+result['med_name']+"</td><td>"
							+result['given_quantity']+"</td><td></td></tr>");
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