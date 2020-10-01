var searchFunction = function(){
	var searchTxt = $("#searchTxt").val();
	searchTxt = $.trim(searchTxt);
	//console.log(searchTxt);
	if(searchTxt !="")
	{
		$.ajax({
			url: '../php/searchMedStat.php',
			type: 'POST',
			data: {searchTxt: searchTxt},
			dataType: 'JSON',

			success:function(resp)
			{
				//append data
				$("#med_table tr").fadeOut(400);
				$("#after_tr").before("<tr class='bg-info'><th colspan='10' style='text-align: center'>Pharmacy Actual Stock</th></tr><tr class='bg-info'><th>Med ID</th><th>Med Name</th><th>Med Expiry</th><th>Barcode</th><th>received</th><th>Pills received</th><th>Date Received</th><th>Pills distributed</th><th>Remaining (in pills)</th></tr>");
				$.each( resp, function(key, result)
				{
					//var pid = result['patient_id'];

					//var profileBtn = "<a id='profileBtn'><span class='badge badge badge-info' style='background-color: #0090ff'>Patient Profile</span></a>"
					$("#after_tr").after("<tr id="+result['med_id']+"><td>"+result['med_id']+"</td><td>"+result['med_name']+"</td><td>"
						+result['med_expiry']+"</td><td>"+result['med_barcode']+"</td><td>"
						+result['ac']+"</td><td>"+result['ac1']+"</td><td>"+result['med_received']+"</td><td>"+result['given_pills']+"</td><td>"+result['still_pills']+"</td></tr>");
				});
			},
			error:function(resp)
			{
				console.log(resp);
			}
		});
	}
}

$(document).ready(function()
{
	$("#searchTxt").on('keyup', searchFunction);
	$("#searchTxt").on('change', searchFunction);
	$("#searchBtn").on('click', searchFunction);
});