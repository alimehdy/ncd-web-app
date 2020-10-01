$(document).ready(function()
  {
    $("#patient_smoker").change(function(){
      var patient_smoker = document.getElementById('patient_smoker').value;

      if(patient_smoker=="No")
      {
        $("#smoker_number_of_packets").prop("disabled", true);
      }
      else
      {
        $("#smoker_number_of_packets").prop("disabled", false);
      }
    });
    //To add diagnosis from drop list into text box
    $("#diagnosis_data").on('change', function()
    {
      $("#diagnosis").val($('#diagnosis').val() + ' - ' +
        $(this).find("option:selected").text());
    });

    $("#add_data").on('click', function(){
      var ymca_id = document.getElementById('ymca_id').value;
      if(ymca_id.length == 1)
        {
          ymca_id = '000'+$("#ymca_id").val();
        }
        if(ymca_id.length == 2)
        {
          ymca_id = '00'+$("#ymca_id").val();
        }
        if(ymca_id.length == 3)
        {
          ymca_id = '0'+$("#ymca_id").val();
        }
      var patient_id = document.getElementById('patient_id').value;
      
      var blood_type = document.getElementById('blood_type').value;
      var patient_name_en = document.getElementById('patient_name_en').value;
      var mother_name = document.getElementById('mother_name').value;
      var gender = document.getElementById('gender').value;
      var nationality = document.getElementById('nationality').value;
      var patient_name_ar = document.getElementById('patient_name_ar').value;
      var dob = document.getElementById('dob').value;
      var registration_date = document.getElementById('registration_date').value;
      var unhcr_registration_number = document.getElementById('unhcr_registration_number').value;
      var patient_address = document.getElementById('patient_address').value;
      var patient_phone = document.getElementById('patient_phone').value;
      var patient_smoker = document.getElementById('patient_smoker').value;
      var smoker_number_of_packets = document.getElementById('smoker_number_of_packets').value;
      var patient_alt_name = document.getElementById('patient_alt_name').value;
      var patient_alt_contact_add = document.getElementById('patient_alt_contact_add').value;
      var relation = document.getElementById('relation').value;
      var diagnosis = document.getElementById('diagnosis').value;
      var diagnosis_data = document.getElementById('diagnosis_data').value;
      var patient_status = document.getElementById('patient_status').value;
      var comment = document.getElementById('comment').value;
      var alcohol = document.getElementById('alcohol').value;
      if(patient_id == "")
      {
        $('#patient_id').css('border-color', 'red');
        $('#patient_id').focus();
      }
      else if(patient_status == "select")
      {
        $('#patient_status').css('border-color', 'red');
        $('#patient_status').focus();
      }
      else if(alcohol == "select")
      {
        $('#alcohol').css('border-color', 'red');
        $('#alcohol').focus();
      }

      else if(patient_name_en=="")
      {
        $('#patient_name_en').css('border-color', 'red');
        $('#patient_name_en').focus();
      }

      else if(mother_name=="")
      {
        $('#mother_name').css('border-color', 'red');
        $('#mother_name').focus();
      }

      else if(dob=="")
      {
        $('#dob').css('border-color', 'red');
        $('#dob').focus();
      }

      else if(gender=="select")
      {
        $('#gender').css('border-color', 'red');
        $('#gender').focus();
      }

      else if(registration_date=="")
      {
        $('#registration_date').css('border-color', 'red');
        $('#registration_date').focus();
      }

      else if(patient_address=="")
      {
        $('#patient_address').css('border-color', 'red');
        $('#patient_address').focus();
      }

      else if(patient_phone=="")
      {
        $('#patient_phone').css('border-color', 'red');
        $('#patient_phone').focus();
      }

      else if(patient_smoker=="select")
      {
        $('#patient_smoker').css('border-color', 'red');
        $('#patient_smoker').focus();
      }
      else if((patient_smoker=="Yes" || patient_smoker=="Occasionally") && smoker_number_of_packets==0)
      {
        $('#smoker_number_of_packets').css('border-color', 'red');
        $('#smoker_number_of_packets').focus();
        alert("Please specify the number of packets");
      }
      else if(patient_alt_name=="")
      {
        $('#patient_alt_name').css('border-color', 'red');
        $('#patient_alt_name').focus();
      }
      else if(patient_alt_contact_add=="")
      {
        $('#patient_alt_contact_add').css('border-color', 'red');
        $('#patient_alt_contact_add').focus();
      }
      else if(patient_status == "select")
      {
        $('#patient_status').css('border-color', 'red');
        $('#patient_status').focus();
      }
      else if(alcohol == "select")
      {
        $('#alcohol').css('border-color', 'red');
        $('#alcohol').focus();
      }
      else
      {
        //Ajax
        if(blood_type=="select")
        {
          blood_type ="Not Specified";
        }

        $.ajax({
          url: '../php/editPatientInfo.php',
          type: 'POST',
          data: {patient_id: patient_id, ymca_id: ymca_id, blood_type: blood_type, name_en: patient_name_en, 
            name_ar: patient_name_ar, mother_name:mother_name, gender: gender, nationality: nationality,
            dob: dob, registration_date: registration_date, unhcr_registration_number: unhcr_registration_number,
            patient_address: patient_address, patient_phone: patient_phone, patient_smoker: patient_smoker,
            smoker_number_of_packets: smoker_number_of_packets, patient_alt_name: patient_alt_name, 
            patient_alt_contact_add: patient_alt_contact_add, relation: relation, diagnosis: diagnosis, 
            diagnosis_data: diagnosis_data, comment: comment, alcohol: alcohol, patient_status: patient_status},
            
          dataType: 'TEXT',

          success:function(response)
          {
            if(response=="updated")
            {
              alert("Data Updated");
              window.location.href="patient_history.php?pid="+patient_id;
            }
            //console.log(response);
          },
          error:function(response)
          {
            alert("Information have not been updated, please try again by fillig all data");
            console.log(response)
          }
        })
      }
  });
});