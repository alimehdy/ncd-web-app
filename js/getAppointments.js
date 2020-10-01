var getAppointment = function()
{
	var date_of_appointment = $("#searchDate").val();
	$.ajax({
		url: '../php/getAppointments.php',
		type: 'POST',
		data: {doa: date_of_appointment},
		dataType: 'JSON',
		success:function(resp)
		{
			$("#after_table tr").fadeOut(400);
			$("#after_tr").before("<tr class='bg-info'><th>Patient_id</th><th>Patient Name</th><th>Appointment Date</th><th>Time</th><th>Patient Phone</th><th>Relative</th><th>Relative Phone</th></tr>");

			//$("#after_table").before("<tr><th>Patient ID</th><th>Patient Name</th><th>Appointment Date</th><th>Time</th><th>Patient Name</th><th>Phone</th><th>Relative</th><th>Relative Phone</th></tr></tr>");
			$.each(resp, function(key, result) {
				$("#after_tr").after("<tr id="+result['patient_id']+"><td>"+result['patient_id']+"<td>"+result['patient_name_en']+"</td><td>"+result['next_appointment_date']+"</td><td>"+result['next_appointment_time']+"</td><td>"+result['patient_phone']+"</td><td>"+result['patient_alt_name']+"</td><td>"+result['patient_alt_contact_add']+"</td></tr>");
				
			});
			
		},
		error:function(resp)
		{
			console.log(resp)
		}
	})
};
$(document).ready(function()
{
	$("#searchDate").on('change', getAppointment);
	$("#searchBtn").on('click', getAppointment);
});