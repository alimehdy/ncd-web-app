var calculate = function()
{
  var quant = $('#medication_quantity').val();
  var med_p_id = $("#medication_id").val();
  var med_id = $("#medication_id").find('option:selected').attr("name");
  console.log(med_p_id);
  console.log(med_id);
  $.ajax({
    url: '../php/ensureQuantity.php',
    type: 'POST',
    data: { quant: quant, mid: med_p_id, med_id: med_id},
    dataType: 'JSON',
    success:function(result)
    {
     
      var remaining = result['still_pills'];
      if(remaining == null)
      {
        remaining = result['med_pill'];
      }
      if(quant>parseInt(remaining))
      {
        //console.log('1* Quant:'+quant+'_'+remaining);
        $("#add_more").prop('disabled', true);
        $("#danger_message").show();
      }
      else
      {
        console.log('2* Quant:'+quant+'_'+remaining);
        $("#add_more").prop('disabled', false);
        $("#danger_message").hide();
      }
      // if(resp=="exceed")
      // {
      //   $("#add_more").prop('disabled', true);
      //   $("#danger_message").show();
      // }
      // else
      // {
      //   $("#add_more").prop('disabled', false);
      //   $("#danger_message").hide();
      // }
    },
    error:function(result)
    {
      console.log(result);
    }
  })
}

$(document).ready(function()
{
  $('#medication_quantity').on('keyup', calculate);
  $('#medication_id').on('change', calculate);
})