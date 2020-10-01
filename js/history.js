var addHistory = function()
{
  var patient_medication = $("#patient_medicationn").val();
  var disease = $("#disease option:selected").text();
  var patient_side_effect = $("#patient_side_effect").val();
  var pid = $("#pid").val();
  var elem = '<button type="button" class="btn btn-danger btn-sm" id="delete_disease" name="delete_disease"><i class="fa fa-remove"></i></button>';
  if(disease == "Select")
  {
  	$("#disease").css('border-color', 'red');
  	$("#disease").focus();
  }

  else
  {
  	$.ajax({
      url: '../php/history.php',
      data: {pid: pid, patient_medication: patient_medication, disease: disease, patient_side_effect: patient_side_effect},
      type: 'POST',
      dataType: 'TEXT',

      success:function(resp)
      {
        console.log(resp)
        $("#after_th").after("<tr id="+resp+"><td>"+disease+"</td><td>"+patient_medication+"</td><td>"
          +patient_side_effect+"</td><td>"+elem+"</td></tr>");
        $("#patient_medicationn").val("");
        $("#patient_side_effect").val("");
        $("#disease").val("select");
      },
      error:function(resp)
      {
        console.log(resp)
      }
    })
  }
}
$(document).ready(function()
{

  $("#add_history").on('click', addHistory);
  $("#patient_medication").on('keypress', function(event)
  {
  	if(event.which==13)
  	{
  		$("#add_history").click();
  	}
  })
  $("#patient_side_effect").on('keypress', function(event)
  {
  	if(event.which==13)
  	{
  		$("#add_history").click();
  	}
  })
});