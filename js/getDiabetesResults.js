var getResults = function(){
	var date_of_assessment = $("#date_of_assessment").val();
	var assessment_result = $("#assessment_result").val();
	var pid = $("#pid").val();
	if(date_of_assessment == "")
	{
		$("#date_of_assessment").css('border-color', 'red');
		$("#date_of_assessment").focus();
	}
	else if(assessment_result =="")
	{
		$("#assessment_result").css('border-color', 'red');
		$("#assessment_result").focus();
	}
	else
	{
		$("#date_of_assessment").css('border-color', '#0090ff');
		$("#assessment_result").css('border-color', '#0090ff');

		$.ajax({
			url: '../php/insertDiabetesAssessment.php',
			type: 'POST',
			data: {pid: pid, date_of_assessment: date_of_assessment, 
				   assessment_result: assessment_result},
			dataType: 'JSON',
			success:function(resp)
			{
				var elem = '<button type="button" class="btn btn-danger" id="delete_assessment" name="delete_assessment"><i class="fa fa-remove"></i></button>';

				$("#after_tr").after("<tr id="+resp['lastId']+"><td>"+resp['resCount']+"</td><td>"+date_of_assessment+
					"</td><td>"+assessment_result+"</td><td>"+elem+"</td></tr>");
				$("#delete_assessment").on('click', function(){
					if(confirm("Are you sure you want to remove this data?"))
					{
						var elem = $(this).closest('tr');
						var diabetes_assessment_id = $(this).closest('tr').attr('id');
						//console.log(diabetes_assessment_id);
						$.ajax({
							url: '../php/deleteAssessment.php',
							type: 'POST',
							data: {diabetes_assessment_id: diabetes_assessment_id},
							dataType: 'TEXT',
							success:function(resp)
							{
								if(resp="deleted")
								{
									elem.fadeOut(500);
								}
							},
							error:function(resp)
							{
								console.log(resp);
							}
						})
					}
				});

			},
			error:function(resp)
			{
				console.log(resp);
			}
		})
	}
}

var deleteResults = function(){
	if(confirm("Are you sure you want to remove this data?"))
	{
		var elem = $(this).closest('tr');
		var diabetes_assessment_id = $(this).closest('tr').attr('id');
		console.log(diabetes_assessment_id);

		$.ajax({
			url: '../php/deleteAssessment.php',
			type: 'POST',
			data: {diabetes_assessment_id: diabetes_assessment_id},
			dataType: 'TEXT',
			success:function(resp)
			{
				if(resp="deleted")
				{
					elem.fadeOut(500);
				}
			},
			error:function(resp)
			{
				console.log(resp);
			}
		})
	}
}

$(document).ready(function(){
	$("#add_assessment").on('click', getResults);
	$("#patient_table #delete_assessment").on('click', deleteResults);
})