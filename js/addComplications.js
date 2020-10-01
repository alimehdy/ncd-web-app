$(document).ready(function(){
	$("#complication_name").on('change', function()
    {
      $("#visit_reason").val($('#visit_reason').val() + ' - ' +
        $(this).find("option:selected").text());
    });

    $("#complication_name_2").on('change', function()
	{
		var val = $("#complication_name_2").val();
		if(val != "select")
		{
			$("#complication_name_3").val($("#complication_name_3").val() + ' - '+ $(this).find("option:selected").text())
		}
	});
	$("#medication_collector").on('change', function()
	{
		$("#medication_collector_2").val($(this).find("option:selected").text())		
	})
})