var searchFunction = function(){
	var searchTxt = $("#searchTxt").val();
	searchTxt = $.trim(searchTxt);
	//console.log(searchTxt);
	$.ajax({
		url: '../php/searchPatientWithDiabetes.php',
		type: 'POST',
		data: {searchTxt: searchTxt},
		dataType: 'JSON',

		success:function(resp)
		{
			//append data
			$("#patient_table tr").fadeOut(400);
			$("#after_tr").before("<tr class='bg-info'><th>ID</th><th>Name</th><th>Diagnosed With Diabetes</th><th>Diagnosis</th><th>Assessment Date</th><th>Assessment result (%)</th><th style='text-align:center'>New Assessment Needed</th><th style='text-align:center' colspan='2'>Actions</th></tr>");
			var i=0;
			var sumResult = 0;
			$.each( resp, function(key, result)
			{
				//console.log(JSON.stringify(result));
				var pid = result['patient_id'];
				i++
				sumResult = sumResult + parseInt(result['assessment_result']);
				var profileBtn = "<a id='profileBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Assessment Score</span></a>";
				var footExamBtn = "<a id='footExamBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Foot Exam</span></a>"

				if(result['assessment_needed']=='Yes')
				{
					$("#after_tr").after("<tr class='bg-danger class='endTr' id="+result['patient_id']+"><td>"+result['patient_id']+"</td><td>"+result['patient_name_en']+"</td><td>"
						+result['date_of_visit']+"</td><td>"+result['diagnosis_name']+
						"</td><td>"+result['date_of_assessment']+"</td><td>"+result['assessment_result']+" %</td><td>"+result['assessment_needed']+"</td><td>"+profileBtn+"</td><td>"+footExamBtn+"</td></tr>");
					
					//if visit button clicked
					$("#patient_table #profileBtn").on('click', function(){
						var id = $(this).closest('tr').attr('id');
						window.location.href = "diabetes_result.php?pid="+id;
					})
					$("#patient_table #footExamBtn").on('click', function(){
						var id = $(this).closest('tr').attr('id');
						window.location.href = "foot_exam.php?pid="+id;
					})
				}
				else
				{
					$("#after_tr").after("<tr class='endTr' id="+result['patient_id']+"><td>"+result['patient_id']+"</td><td>"+result['patient_name_en']+"</td><td>"
						+result['date_of_visit']+"</td><td>"+result['diagnosis_name']+
						"</td><td>"+result['date_of_assessment']+"</td><td>"+result['assessment_result']+" %</td><td>"+result['assessment_needed']+"</td><td>"+profileBtn+"</td><td>"+footExamBtn+"</td></tr>");
					
					//if visit button clicked
					$("#patient_table #profileBtn").on('click', function(){
						var id = $(this).closest('tr').attr('id');
						window.location.href = "diabetes_result.php?pid="+id;
					})
					$("#patient_table #footExamBtn").on('click', function(){
						var id = $(this).closest('tr').attr('id');
						window.location.href = "foot_exam.php?pid="+id;
					})
				}
			});
			// $(".endTr").append("<tr>\n<th colspan='8' style='text-align: right'>All Time Avg Result</th>\n<td>"+sumResult/i+" %</td></tr>");
			//console.log(sumResult/i)

		},
		error:function(resp)
		{
			console.log(resp);
			//console.log(JSON.stringify(resp));
		}

	});
}

$(document).ready(function()
{
	//$("#searchTxt").on('keyup', searchFunction);
	$("#searchBtn").on('click', searchFunction);
	//$("#searchTxt").on('change', searchFunction);
	$("#searchTxt").on('keydown', function(e){
		//console.log(e.which)
		var keycode = (e.keyCode ? e.keyCode : e.which);
		//console.log(keycode)
		if(keycode == 13){
			$("#searchBtn").click();
		}
	});
});