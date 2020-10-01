$(document).ready(function()
  {

    $("input[name=clinic_staff]:radio, input[name=ymca_staff]:radio, input[name=medair_staff]:radio").change(function()
    {
      var clinic_staff = $('input[name=clinic_staff]:checked').val();
      var ymca_staff = $('input[name=ymca_staff]:checked').val();
      var medair_staff = $('input[name=medair_staff]:checked').val();
      //console.log(clinic_staff);
      //console.log(medair_staff);
      if(clinic_staff == "Yes" && medair_staff == "No")
      {
        $("#patient_name_en").val("Confidential");
        $("#patient_father_name_en").val("-");
        $("#patient_family_name_en").val("Due to agreement");
        $("#unhcr_registration_number").val("N/A");

        $("#patient_name_ar").val("سرّي");
        $("#patient_father_name_ar").val("-");
        $("#patient_family_name_ar").val("تبعا للاتفاق مع المريض");
        $("#mother_name").val("Confidential");

        $("#patient_phone").val("Confidential");

        $("#patient_name_en, #mother_name, #patient_father_name_en, #patient_family_name_en, #unhcr_registration_number, #patient_name_ar, #patient_father_name_ar, #patient_family_name_ar, #patient_phone").prop("disabled", true);
      }
      else if(clinic_staff == "Yes" && medair_staff == "Yes")
      {
        $("#patient_name_en").val("");
        $("#patient_father_name_en").val("");
        $("#patient_family_name_en").val("");
        $("#unhcr_registration_number").val("");

        $("#patient_name_ar").val("");
        $("#patient_father_name_ar").val("");
        $("#patient_family_name_ar").val("");
        $("#mother_name").val("");

        $("#patient_phone").val("");

        $("#patient_name_en, #mother_name, #patient_father_name_en, #patient_family_name_en, #unhcr_registration_number, #patient_name_ar, #patient_father_name_ar, #patient_family_name_ar, #patient_phone").prop("disabled", false);
      }

      else if(clinic_staff == "No" && medair_staff == "No")
      {
        $("#patient_name_en").val("Confidential");
        $("#patient_father_name_en").val("-");
        $("#patient_family_name_en").val("Due to agreement");
        $("#unhcr_registration_number").val("N/A");

        $("#patient_alt_name").val("N/A");
        $("#patient_alt_contact_add").val("N/A");
        $("#relation").val("N/A");

        $("#patient_name_ar").val("سرّي");
        $("#patient_father_name_ar").val("-");
        $("#patient_family_name_ar").val("تبعا للاتفاق مع المريض");
        $("#mother_name").val("Confidential");
        $("#patient_phone").val("Confidential");

        $("#patient_name_en, #mother_name, #patient_alt_name, #patient_alt_contact_add, #relation, #patient_father_name_en, #patient_family_name_en, #unhcr_registration_number, #patient_name_ar, #patient_father_name_ar, #patient_family_name_ar, #patient_phone").prop("disabled", true);
      }
      else
      {
        $("#patient_name_en").val("");
        $("#patient_father_name_en").val("");
        $("#patient_family_name_en").val("");
        $("#unhcr_registration_number").val("");

        $("#patient_alt_name").val("");
        $("#patient_alt_contact_add").val("");
        $("#relation").val("");
        $("#patient_name_ar").val("");
        $("#patient_father_name_ar").val("");
        $("#patient_family_name_ar").val("");
        $("#mother_name").val("");
        $("#patient_phone").val("");

        $("#patient_name_en, #mother_name, #patient_alt_name, #patient_alt_contact_add, #relation, #patient_father_name_en, #patient_family_name_en, #unhcr_registration_number, #patient_name_ar, #patient_father_name_ar, #patient_family_name_ar, #patient_phone").prop("disabled", false);
      }
    })

    $("#consent_div").on('click', function()
      {
        $("#consent_form").slideToggle();
        $("#collapse_btn").find('i').toggleClass('fa-plus fa-minus');
      });
    var answer = $("#answer");
    $("#answer").on('change', function()
    {
      if(answer.is(':checked'))
      {
        alert("yes");
      }
      else
      {
        alert("no");
      }
    });
    $("#patient_smoker").change(function(){
      var patient_smoker = document.getElementById('patient_smoker').value;

      if(patient_smoker=="No")
      {
        $("#smoker_number_of_packets").prop("disabled", true);
        $("#smoker_number_of_packets").val("0");
      }
      else
      {
        $("#smoker_number_of_packets").prop("disabled", false);
      }
    });
    //Correct ID
    // $("#patient_id").on('keyup', function(){
    //   $val = $(this).val();
    //   if($val.length>4)
    //   {
    //     alert("Incorrect ID. Please add a number between 1 and 8999 for Lebanese, and a number bigger than 9000 for a Syrian");
    //     $(this).val("");
    //   }
    // });
    $("#ymca_id").on('keyup', function(){
      console.log("true");
      $val = $(this).val();
      if($val.length>4)
      {
        alert("Incorrect YMCA ID. Please add a number between 1 and 8999 for Lebanese, and a number bigger than 9000 for a Syrian");
        $(this).val("");
      }
    });
    //To add diagnosis from drop list into text box
    $("#diagnosis_data").on('change', function()
    {
      $("#diagnosis").val($('#diagnosis').val() + ' - ' +
        $(this).find("option:selected").text());
    });

    $("#add_data").on('click', function(){
      var patient_id = document.getElementById('patient_id').value;
      var ymca_id = document.getElementById('ymca_id').value;
      var blood_type = document.getElementById('blood_type').value;
      var patient_name_en = document.getElementById('patient_name_en').value;
      var patient_father_name_en = document.getElementById('patient_father_name_en').value;
      var patient_family_name_en = document.getElementById('patient_family_name_en').value;
      var mother_name = document.getElementById('mother_name').value;
      var gender = document.getElementById('gender').value;
      var nationality = document.getElementById('nationality').value;
      var patient_name_ar = document.getElementById('patient_name_ar').value;
      var patient_father_name_ar = document.getElementById('patient_father_name_ar').value;
      var patient_family_name_ar = document.getElementById('patient_family_name_ar').value;
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

      var clinic_staff = $('input[name=clinic_staff]:checked').val();
      var ymca_staff = $('input[name=ymca_staff]:checked').val();
      var medair_staff = $('input[name=medair_staff]:checked').val();

      if(patient_id == "")
      {
        $('#patient_id').css('border-color', 'red');
        $('#patient_id').focus();
      }
      
      // else if(ymca_id == ""){
      //   $('#ymca_id').css('border-color', 'red');
      //   $('#ymca_id').focus();
      // }

      else if(clinic_staff == undefined)
      {
        if($("#collapse_btn").find('i').hasClass('fa-minus')===true)
        {
          $("#clinic_staff").focus();
          $("#clinic_staff").closest('div').addClass('flash');
          setTimeout(function()
          {
            $("#clinic_staff").closest('div').removeClass('flash');
          }, 2000);
        }
        else
        {
          $("#consent_form").slideToggle();
          $("#collapse_btn").find('i').toggleClass('fa-plus fa-minus');
          $("#clinic_staff").focus();
          $("#clinic_staff").closest('div').addClass('flash');
          setTimeout(function()
          {
            $("#clinic_staff").closest('div').removeClass('flash');
          }, 2000);
        }
        
      }

      else if(ymca_staff == undefined)
      {
        if($("#collapse_btn").find('i').hasClass('fa-minus')===true)
        {
          $("#ymca_staff").focus();
          $("#ymca_staff").closest('div').addClass('flash');
          setTimeout(function()
          {
            $("#ymca_staff").closest('div').removeClass('flash');
          }, 2000);
        }
        else
        {
          $("#consent_form").slideToggle();
          $("#collapse_btn").find('i').toggleClass('fa-plus fa-minus');
          $("#ymca_staff").focus();
          $("#ymca_staff").closest('div').addClass('flash');
          setTimeout(function()
          {
            $("#ymca_staff").closest('div').removeClass('flash');
          }, 2000);
        }
      }

      else if(medair_staff == undefined)
      {
        if($("#collapse_btn").find('i').hasClass('fa-minus')===true)
        {
          $("#medair_staff").focus();
          $("#medair_staff").closest('div').addClass('flash');
          setTimeout(function()
          {
            $("#medair_staff").closest('div').removeClass('flash');
          }, 2000);
        }
        else
        {
          $("#consent_form").slideToggle();
          $("#collapse_btn").find('i').toggleClass('fa-plus fa-minus');
          $("#medair_staff").focus();
          $("#medair_staff").closest('div').addClass('flash');
          setTimeout(function()
          {
            $("#medair_staff").closest('div').removeClass('flash');
          }, 2000);
        }
      }

      else if(patient_name_en=="")
      {
        $('#patient_name_en').css('border-color', 'red');
        $('#patient_name_en').focus();
      }

      else if(patient_father_name_en=="")
      {
        $('#patient_father_name_en').css('border-color', 'red');
        $('#patient_father_name_en').focus();
      }

      else if(patient_family_name_en=="")
      {
        $('#patient_family_name_en').css('border-color', 'red');
        $('#patient_family_name_en').focus();
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
      else if((ymca_id>0 && ymca_id<=8999) && nationality=="Syrian")
      {
        alert("Please insert a YMCA ID number bigger than 9000 for a Syrian Patient");
      }
      else if(ymca_id>8999 && nationality=="Lebanese")
      {
        alert("Please insert a YMCA ID number between 1 and 8999 for a Lebanese Patient ");
      }
      else
      {
        //Ajax
        var name_en = $("#patient_name_en").val()+' '+ $("#patient_father_name_en").val()+' '+ $("#patient_family_name_en").val();
        var name_ar = $("#patient_name_ar").val()+' '+ $("#patient_father_name_ar").val()+' '+ $("#patient_family_name_ar").val();
        if(blood_type=="select")
        {
          blood_type ="Not Specified";
        }
        // if(patient_id.length == 1)
        // {
        //   patient_id = '000'+$("#patient_id").val();
        // }
        // if(patient_id.length == 2)
        // {
        //   patient_id = '00'+$("#patient_id").val();
        // }
        // if(patient_id.length == 3)
        // {
        //   patient_id = '0'+$("#patient_id").val();
        // }

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

        if(patient_id.length == 1)
        {
          patient_id = '000'+$("#patient_id").val();
        }
        if(patient_id.length == 2)
        {
          patient_id = '00'+$("#patient_id").val();
        }
        if(patient_id.length == 3)
        {
          patient_id = '0'+$("#patient_id").val();
        }

        $.ajax({
          url: '../php/registration.php',
          type: 'POST',
          data: {clinic_staff, ymca_staff, medair_staff, patient_id: patient_id, ymca_id: ymca_id, blood_type: blood_type, name_en: name_en, 
            name_ar: name_ar, mother_name:mother_name, gender: gender, nationality: nationality,
            dob: dob, registration_date: registration_date, unhcr_registration_number: unhcr_registration_number,
            patient_address: patient_address, patient_phone: patient_phone, patient_smoker: patient_smoker,
            smoker_number_of_packets: smoker_number_of_packets, patient_alt_name: patient_alt_name, 
            patient_alt_contact_add: patient_alt_contact_add, relation: relation, diagnosis: diagnosis, 
            diagnosis_data: diagnosis_data, comment: comment, alcohol: alcohol, patient_status: patient_status},
            
          dataType: 'TEXT',

          success:function(response)
          {
            if(response=="exist")
            {
              alert("Patient ID or YMCA ID already exist in our system! Please check again before adding.");
            }
            else
            {
              window.location.href="patient_history.php?pid="+response;
              //console.log(response);
            }
          },
          error:function(response)
          {
            alert("Information have not been added, please try again by fillig all data");
            console.log(response)
          }
        })
      }
  });
});