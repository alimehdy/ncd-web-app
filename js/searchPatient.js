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
			$("#after_tr").before("<tr class='bg-info'><th>ID</th><th>YMCA ID</th><th>Name</th><th>Date Of Birth</th><th>Phone</th><th>Status</th><th>Change Status</th><th colspan='5' style='text-align:center'>Actions</th></tr>");
			$.each( resp, function(key, result)
			{
				//console.log(JSON.stringify(result));
				var pid = result['patient_id'];
				var profileBtn = "<a id='profileBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Patient Profile</span></a>"
				$("#after_tr").after("<tr id="+result['patient_id']+"><td>"+result['patient_id']+"</td><td>"+result['ymca_id']+"</td><td>"+result['patient_name_en']+"</td><td>"
					+result['dob']+"</td><td>"+result['patient_phone']+"</td><td>"
					+result['patient_status']+"</td><td><select style='color: #0090ff; ' class='form-control select patient_status' name='patient_status'><option value='select'>Select</option><option value='Active'>Active</option><option value='Deceased'>Deceased</option><option value='Discharged'>Discharged</option><option value='Defaulter'>Defaulter</option></select><td>"+profileBtn+"</td>");
				
				//if visit button clicked
				$("#patient_table #profileBtn").on('click', function(){
					var id = $(this).closest('tr').attr('id');
					window.location.href = "patient_profile_page.php?pid="+id;
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