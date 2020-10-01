var searchFunction = function(){
	var searchTxt = $("#searchTxt").val();
	searchTxt = $.trim(searchTxt);
	//console.log(searchTxt);
	$.ajax({
		url: '../php/searchPatient.php',
		type: 'POST',
		data: {searchTxt: searchTxt},
		dataType: 'JSON',

		success:function(resp)
		{
			//append data
			$("#patient_table tr").fadeOut(400);
			$("#after_tr").before("<tr class='bg-info'><th>ID</th><th>Name</th><th>Date Of Birth</th><th>Phone</th><th>Status</th><th>Change Status</th><th colspan='5' style='text-align:center'>Actions</th></tr>");
			$.each( resp, function(key, result)
			{
				var pid = result['patient_id'];
				var profileBtn = "<a id='profileBtn'><i class='badge badge-info' style='background-color: #0090ff'>Edit Profile</i></a>"
				var historyBtn = "<a id='historyBtn'><i class='badge badge-info' style='background-color: #0090ff'>Edit History</i></a>"
				$("#after_tr").after("<tr id="+result['patient_id']+"><td>"+result['patient_id']+"</td><td>"+result['patient_name_en']+"</td><td>"
					+result['dob']+"</td><td>"+result['patient_phone']+"</td><td>"
					+result['patient_status']+"</td><td><select style='color: #0090ff; ' class='form-control select patient_status' name='patient_status'><option value='select'>Select</option><option value='Active'>Active</option><option value='Deceased'>Deceased</option><option value='Discharged'>Discharged</option><option value='Defaulter'>Defaulter</option></select><td>"+profileBtn+"</td><td>"+historyBtn+"</td>");
				
				//if visit button clicked

				$("#patient_table #profileBtn").on('click', function(){
					var id = $(this).closest('tr').attr('id');
					window.location.href = "edit_patient.php?pid="+id;
				})
				$("#patient_table #historyBtn").on('click', function(){
					var id = $(this).closest('tr').attr('id');
					window.location.href = "patient_history.php?pid="+id;
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
				          url: '../php/changeStatus.php',
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
		error:function(resp)
		{

		}
	});
}

$(document).ready(function()
{
	$("#searchTxt").on('keyup', searchFunction);
	$("#searchBtn").on('click', searchFunction);
});