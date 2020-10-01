var addSurgery = function()
{
  var patient_surgery = $("#patient_surgery").val();
  var surgery_date = $("#surgery_date").val();
  var surgery_comment = $("#surgery_comment").val();
  var pid = $("#pid").val();
  var elem = '<button type="button" class="btn btn-danger btn-sm" id="delete_surgery" name="delete_surgery"><i class="fa fa-remove"></i></button>';

  if(patient_surgery=="")
  {
  	$("#patient_surgery").css('border-color', 'red');
  	$("#patient_surgery").focus();
  }
  else if(surgery_date=="")
  {
    $("#surgery_date").css('border-color', 'red');
    $("#surgery_date").focus();
  }

  else
  {
  	$.ajax({
      url: '../php/surgery.php',
      data: {pid: pid, patient_surgery: patient_surgery, surgery_date: surgery_date, 
        surgery_comment: surgery_comment},
      type: 'POST',
      dataType: 'TEXT',

      success:function(resp)
      {
        $("#after_th_surgery").after("<tr id="+resp+"><td>"+patient_surgery+"</td><td>"+surgery_date+"</td><td>"
          +surgery_comment+"</td><td>"+elem+"</td></tr>");
        $("#patient_surgery").val("");
        $("#surgery_date").val("");
        $("#surgery_comment").val("");
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


  $("#add_surgery").on('click', addSurgery);
  $("#patient_surgery").on('keypress', function(event)
  {
  	if(event.which==13)
  	{
  		$("#add_surgery").click();
  	}
  })
  $("#surgery_comment").on('keypress', function(event)
  {
  	if(event.which==13)
  	{
  		$("#add_surgery").click();
  	}
  })
});