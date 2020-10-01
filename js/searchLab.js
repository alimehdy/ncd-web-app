var searchFunction = function(){
	var searchTxt = $("#searchTxt").val();
	searchTxt = $.trim(searchTxt);
	//console.log(searchTxt);
	$.ajax({
		url: '../php/searchLab.php',
		type: 'POST',
		data: {searchTxt: searchTxt},
		dataType: 'JSON',

		success:function(resp)
		{
			//append data
			$("#patient_table tr").fadeOut(400);
			$("#after_tr").before("<tr class='bg-info'><th>Patient ID</th><th>Name</th><th>Date of test</th><th>Status</th><th>Change Status</th><th colspan='5' style='text-align:center'>Actions</th></tr>");
			$.each( resp, function(key, result)
			{
				//console.log(JSON.stringify(result));
				var pid = result['patient_id'];
				var generateReport = "<a id='generateReport'><span class='badge badge badge-info' style='background-color: #0090ff'>Generate Report</span></a>";
				$("#after_tr").after("<tr id="+result['lab_id']+"><td>"+result['patient_id']+"</td><td>"+result['pn']+"</td><td>"
					+result['test_date']+"</td><td>"+result['lab_status']+"</td><td><select style='color: #0090ff; ' class='form-control select patient_status' name='lab_status'><option value='select'>Select</option><option value='Active'>Active</option><option value='Inactive'>Inactive</option></select></td><td colspan='2'>"+generateReport+"</td></tr>");
				
				//if visit button clicked
				$("#patient_table #generateReport").on('click', function(){
					var id = $(this).closest('tr').attr('id');
					window.location.href = "lab_test_data.php?pid="+result['patient_id'];
				})
				$(document).on('change', '.patient_status', function() {
				    var $select = $(this);
				    var $tr = $select.closest('tr');
				    var pid = $tr.attr('id');
				    var $status = $tr.children('td.change_status');
				    var current_status = $status.text();
				    var new_status = $select.val();
				    console.log(new_status);
				    if (current_status == new_status) {
				      alert("The status selected is already the same!");
				    }

				    else {
				      //if (confirm("Are you sure you want to change the status of a patient ?")) {
				        
				        //console.log(pid + " " + new_status);
				        $.ajax({
				          url: '../php/changeLabStatus.php',
				          type: 'POST',
				          dataType: 'TEXT',
				          data: { pid: pid, new_status: new_status },
				          success: function(resp) {
				          	if(resp=="updated")
				          	{
				          		$status.text(new_status);
				          		//console.log(resp);
				          	}
				          },
				          error: function(resp) {}
				        });
				      //}
				    }
				  });
			});
		},
		error: function (jqXHR, textStatus, errorThrown) {
        alert('Not done - ' + textStatus + ' ' + errorThrown);
    }
	});
}

$(document).ready(function()
{

	$("#searchTxt").on('keyup', searchFunction);
	$("#searchBtn").on('click', searchFunction);
	//$("#searchTxt").on('change', searchFunction);
});