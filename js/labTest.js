$(document).ready(function(){
	$("#add_lab_test").on('click', function(){
		var pid = $("#patient_id_lab").val();
		var test_date = $("#lab_test_date").val();
		var gly = $("#glycemia").val();
		var hba = $("#hba").val();
		var cre = $("#creatinine").val();
		var ure = $("#urea").val();
		var ast = $("#ast").val();
		var alt = $("#alt").val();
		var tot = $("#total_cholesterol").val();
		var hdl = $("#hdl_cholesterol").val();
		var comment = $("#comment").val();
		if(pid == "")
		{
			$("#patient_id_lab").css('border-color', 'red');
			$("#patient_id_lab").focus();
		}
		else if(test_date == "")
		{
			$("#lab_test_date").css('border-color', 'red');
			$("#lab_test_date").focus();
		}
		// else if(gly == "")
		// {
		// 	$("#glycemia").css('border-color', 'red');
		// 	$("#glycemia").focus();
		// }
		else
		{
			$("#lab_test_date").css('border-color', '#0090ff');
			$("#glycemia").css('border-color', '#0090ff');

			$.ajax({
				url: '../php/labTest.php',
				data: {gly: gly, hba: hba, 
					   cre: cre, ure: ure, 
					   ast: ast, alt: alt, 
					   tot: tot, hdl: hdl, 
					   pid: pid, test_date: test_date,
					   comment: comment},
				type: 'POST',
				dataType: 'TEXT',
				success:function(resp){
					if(resp=="Added")
					{
						alert("Lab test was successfully added");
						$("#lab_test_date").focus();
		                $("#lab_test_date").val("");
		                $("#glycemia").val("");
		                $("#hba").val("");
		                $("#creatinine").val("");
		                $("#urea").val("");
		                $("#ast").val("");
		                $("#alt").val("");
		                $("#total_cholesterol").val("");
		                $("#hdl_cholesterol").val("");
		                $("#comment").val("");
					}
				},
				error:function(resp){
					console.log(resp);
				}
			})
		}
	});
});