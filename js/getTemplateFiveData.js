var getTemplateThreeData = function()
{
	var nationality = $("#selectNat").val();
	var monthVal = $("#searchTxt").val();
	if(nationality == "Lebanese")
	{
		$("#tempNum").text("5");
		$("#img1").attr('src', '../images/ministry.png');
		$("#th2").text("المشروع المشترك لتأمين الأدوية للمرضى المزمنين").css('font-size', '120%');
		$("#img3").attr('src', '../images/ymca.png');
		//$("#thCode").text("الرمز");
	}
	else
	{
		$("#tempNum").text("٥");
		$("#img1").attr('src', '../images/ymca.png');
		$("#th2").html("<img src='../images/imc.gif'></img>");
		$("#img3").attr('src', '../images/unhcr.png');
		//$("#thCode").text("رقم بطاقة اللجوء");
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
		var yearNumber = date.getFullYear();
		console.log(allMonths[monthNumber]);
		console.log(monthVal);
		$("#getMonthName").text(allMonths[monthNumber]);
		$("#getYearName").text(yearNumber);
		$.ajax({
			url:'../php/getTemplateFiveData.php',
			type: 'POST',
			data: {monthVal, nationality},
			dataType: 'JSON',
			success:function(resp)
			{
				$("#tempThreeTable #fade").fadeOut(400);
				console.log(resp['chronic']);
				console.log(resp['nonChronic']);
				$("#chronic").text(resp['chronic']);
				$("#nonChronic").text(resp['nonChronic']);
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