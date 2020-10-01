$(document).ready(function() {

    $("#add_med").on('click', function(e) {
      var med_id = $("#medication_id").val();
      var expiry_date = $("#expiry_date").val();
      var barcode = $("#barcode").val();
      var tablets = $("#medication_quantity").val();
      var pills = $("#medication_pill").val();
      if(med_id == "select")
      {
        $("#medication_id").css('border-color', 'red');
        $("#medication_id").focus();
      }
      else if(expiry_date == "")
      {
        $("#expiry_date").css('border-color', 'red');
        $("#expiry_date").focus();
      }
      else if(barcode == "")
      {
        $("#barcode").css('border-color', 'red');
        $("#barcode").focus();
      }
      else if(tablets == "" || tablets == 0)
      {
        $("#medication_quantity").css('border-color', 'red');
        $("#medication_quantity").focus();
      }
      else if(pills == "" || pills == 0)
      {
        $("#medication_pill").css('border-color', 'red');
        $("#medication_pill").focus();
      }
      else
      {
        $("#medication_id").css('border-color', '#0090ff');
        $("#expiry_date").css('border-color', '#0090ff');
        $("#barcode").css('border-color', '#0090ff');
        $("#medication_quantity").css('border-color', '#0090ff');
        $("#medication_pill").css('border-color', '#0090ff');


        $.ajax({
          url: '../php/addMedInfo.php',
          type: 'post',
          data: {medication_id: med_id, expiry_date: expiry_date, barcode: barcode, medication_quantity: tablets, medication_pill: pills},
          dataType: 'TEXT',
            success: function(resp) {
              $("#barcode").val("");
              $("#barcode").focus();
            },
            error: function(resp) {
              console.log(resp);
            }
        })
      }
    });
  });