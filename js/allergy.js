var addAllergy = function()
{
  var patient_allergy_med = $("#patient_allergy_med").val();
  var patient_side_effect_allergy = $("#patient_side_effect_allergy").val();
  var comment = $("#comment").val();
  var pid = $("#pid").val();
  var elem = '<button type="button" class="btn btn-danger btn-sm" id="delete_allergy" name="delete_allergy"><i class="fa fa-remove"></i></button>';
  if(patient_allergy_med == "")
  {
  	$("#patient_allergy_med").css('border-color', 'red');
  	$("#patient_allergy_med").focus();
  }
  else
  {
  	$.ajax({
      url: '../php/allergy.php',
      data: {pid: pid, patient_allergy_med: patient_allergy_med, patient_side_effect_allergy: patient_side_effect_allergy, 
        comment: comment},
      type: 'POST',
      dataType: 'TEXT',

      success:function(resp)
      {
        $("#after_th_allergy").after("<tr id="+resp+"><td>"+patient_allergy_med+"</td><td>"+patient_side_effect_allergy+"</td><td>"
          +comment+"</td><td>"+elem+"</td></tr>");
        $("#patient_allergy_med").val("");
        $("#patient_side_effect_allergy").val("");
        $("#comment").val("");
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

  $("#add_allergy").on('click', addAllergy);
  $("#patient_allergy_med").on('keypress', function(event)
  {
  	if(event.which==13)
  	{
  		$("#add_allergy").click();
  	}
  })
  $("#patient_side_effect_allergy").on('keypress', function(event)
  {
  	if(event.which==13)
  	{
  		$("#add_allergy").click();
  	}
  })
  $("#comment").on('keypress', function(event)
  {
    if(event.which==13)
    {
      $("#add_allergy").click();
    }
  })
});