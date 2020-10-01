var searchFunction = function(){
	var searchTxt = $("#searchTxt").val();
	//console.log(searchTxt);
	searchTxt = $.trim(searchTxt);
	$.ajax({
		url: '../php/searchVisit.php',
		type: 'POST',
		data: {searchTxt: searchTxt},
		dataType: 'JSON',

		success:function(resp)
		{
			//append data
			$("#patient_table tr").fadeOut(400);
			$("#after_tr").before("<tr class='bg-info'><th>Patient ID</th><th>YMCA ID</th><th>Visit Date</th><th>Visit ID</th><th>Patient Name</th><th>Visit Status</th><th>Change Status</th><th colspan='2'>Actions</th></tr>");
			$.each( resp, function(key, result)
			{
				var pid = result['patient_id'];
				var visitBtn = "<a id='visitBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Visit Details</span></a>"
				var addInfoBtn = "<a id='addInfoBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Add Results/Medications</span></a>";
				$("#after_tr").after("<tr id="+result['visit_id']+"><td>"+result['patient_id']+"</td><td>"+result['ymca_id']+"</td><td>"+result['date_of_visit']+"</td><td>"+result['visit_id']+"</td><td>"+result['patient_name_en']+"</td><td class='change_status'>"
					+result['visit_status']+"</td><td><select style='color: #0090ff; ' class='form-control select patient_status' name='patient_status'><option value='select'>Select</option><option value='Active'>Active</option><option value='Inactive'>Inactive</option></select><td>"+visitBtn+"</td><td>"+addInfoBtn+"</td>");
				
				//if visit button clicked
				$("#patient_table #visitBtn").on('click', function(){
					var id = $(this).closest('tr').attr('id');
					window.location.href = "visit_profile.php?pid="+id;
				})
				$("#patient_table #addInfoBtn").on('click', function(){
					var id = $(this).closest('tr').attr('id');
					$("#visit_id").val(id);
					$("#patient_id").val(result['patient_id']);
					//Dialog Box Opens
					$('#dialog').dialog({
                      autoOpen: false, 
                      hide: "puff",
                      show : "slide",
                      width: 800,
                      modal: true
    				});
    				$( "#dialog" ).dialog( "open" );
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
				          url: '../php/changeVisitStatus.php',
				          type: 'POST',
				          dataType: 'TEXT',
				          data: { pid: pid, new_status: new_status },
				          success: function(resp) {
				          	if(resp=="updated")
				          	{
				          		//alert("Visit Status Changed");
				          		//window.location.href='visit_status.php';
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
	$("#patient_table #addInfoBtn").on('click', function(){
		var id = $(this).closest('tr').attr('id');
		$("#visit_id").val(id);
		var pidTxt = $("#patient_id_txt").val();
		$("#patient_id").val(pidTxt);
		//Dialog Box Opens
		$('#dialog').dialog({
          autoOpen: false, 
          hide: "puff",
          show : "slide",
          width: 800,
          modal: true
		});
    	$( "#dialog" ).dialog( "open" );
    });
	// $("#searchTxt").on('keyup', searchFunction);
	    $("#searchBtn").on('click', searchFunction);
	// $("#searchBtn").on('focus', searchFunction);
	// $("#searchBtn").on('blur', searchFunction);
	$("#searchTxt").on('keydown', function(e){
		//console.log(e.which)
		var keycode = (e.keyCode ? e.keyCode : e.which);
		//console.log(keycode)
		if(keycode == 13){
			$("#searchBtn").click();
		}
	});
});