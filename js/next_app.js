$(document).ready(function()
{
	$("#next_app").on('click', function()
	{
		$('#next_app_div').dialog({
          autoOpen: false, 
          hide: "puff",
          show : "slide",
          width: 'auto',
          modal: true
		});
		$( "#next_app_div" ).dialog( "open" );
		$("#add_appointment").on('click', function()
		{
			var doa = $("#next_appointment_date").val();
			var toa = $("#next_appointment_time").val();
			var pid = $("#patient_id").val();
			if(doa=="")
			{
				alert("Please specify the date");
			}
			else
			{
				$.ajax({
					url: '../php/next_app.php',
					type: 'POST',
					data: { doa: doa, toa: toa, pid: pid},
					dataType: 'TEXT',
					success:function(resp)
					{
						if(resp=="added")
						{
							alert("Appointment Added.");
							$( "#next_app_div" ).dialog( "close" );
						}
					},
					error:function(resp)
					{
						console.log(resp);
					}
				})
			}
		})
	})
})