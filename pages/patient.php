<?php
  include_once('../php/connection.php');
  include_once('../php/getDiagnosis.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>NCD Web Application</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/bootstrap-toggle.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="icon" href="../images/Medair_Logo_2013.png">
	<link rel="stylesheet" href="../css/vert_tabs.css">
  <link rel="stylesheet" href="../css/textbox.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <link rel="stylesheet" href="../css/typeaheadjs.css">

</head>
<body>
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"><img src="../images/medair_icon.png""></a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php"> <i class="fa fa-home fa-fw" aria-hidden="true"></i>Home </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link active dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Patients
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item active" href="patient.php">New Patient</a>
              <a class="dropdown-item" href="patient_profile.php">Patient Profile</a>
              <a class="dropdown-item" href="edit.php">Edit Profile and/or History</a>
              <a class="dropdown-item" href="diabetes.php">Diabetes List</a>
              <a class="dropdown-item" href="assessment.php">Monthly Assessment Avg</a>
              <a class="dropdown-item" href="labTest.php">Laboratory test Report</a>
              <a class="dropdown-item" href="changeTreatment.php">Change Medication/Treatment</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Visits
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="visit.php">New Visit</a>
              <a class="dropdown-item" href="visit_status.php">Visit Status</a>
              <a class="dropdown-item" href="appointment.php">Next Appointment</a>
              <a class="dropdown-item" href="missed_visit.php">Missed Visit</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-home fa-plus" aria-hidden="true"></i>Pharmacy
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="new_med.php">Medications List</a>
              <a class="dropdown-item" href="new_quantity.php">New Med/Quantity</a>
              <a class="dropdown-item" href="expiredMed.php">Nearly Expired Med</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-home fa-plus" aria-hidden="true"></i>Reports
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="chronic_list.php">Template 3 - Chronic diseases patients</a>
              <a class="dropdown-item" href="clinic_month_report.php">Template 5 - Clinic Monthly Report</a>
              <a class="dropdown-item" href="template_three.php">Template 6 - Chronic diseases patients</a>
              <a class="dropdown-item" href="non_chronic_list.php">Template 7 - Non chronic diseases</a>
              <a class="dropdown-item" href="treatmentReport.php">Template 8 - Change treatment/Medication</a>
              <a class="dropdown-item" href="patient_status_list.php">Template 9 - Patients Discharged/Diceased</a>
              <a class="dropdown-item" href="monthlyReport.php">Monthly Report</a>
              <a class="dropdown-item" href="dailyReport.php">Daily Report</a>
            </div>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2 searchElement" type="text" id="searchTxt" name="searchTxt" placeholder="Search..." disabled>
        <!--<button type="button" class="btn btn-primary searchElement" id="searchBtn" name="searchBtn"><i class="fa fa-search fa-fw" aria-hidden="true"></i> Search</button>-->
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
        </li>
      </ul>
    </div>
  </nav>
  <br>
  <div class="row justify-content-md-center">
   <div class="a col-xs-12 col-sm-10 col-md-10 col-lg-10 col-lg-push-10 col-md-push-10">
    <label class="custom-control custom-checkbox" style="display: none">
      <input type="checkbox" id="answer" class="custom-control-input">
      <span class="custom-control-indicator"></span>
      <span class="custom-control-description">Click Here if patient don't want to mention any personal and critical information</span>
    </label>
     <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header" style="color: #0090ff" align="center">
          Adding Patient Information
          </div>
          <div class="card-block">
          <div class="row">
          <div class="col-sm-12 alert alert-info">
          <button id="collapse_btn" class="btn btn-box-tool pull-right" data-widget="collapse"><i class="fa fa-plus"></i></button>
            <div class="col-sm-12" id="consent_div">
            Please read the consent form written on the paper and fill it with the proper answers. The answers on the program, should be conformed with the ones filled and signed by the patient himself.
            </div>
            <div dir="rtl">
            يرجى قراءة استمارة موافقة المريض على استخدام معلوماته الشخصية و تعبئة الخانات بشكل دقيق قبل البدء بإضافة المعلومات. على المعلومات المدخلة الى البرنامج ان تكون مطابقة تماما لتلك الموجودة على الاستمارة الورقية الموقعة من قبل المريض نفسه.
            </div>
            <div class="col-sm-12 collapse alert alert-danger" id="consent_form" dir="rtl">
              <div class="row">
                <div class="col-sm-9" style="border: 1px solid">
                  
                  أسمح للموظفين الطبيين و الإداريين في عيادة مركز الخدمات الإنمائية في بريتال بإدخال بياناتي الشخصية, بما في ذلك جميع المعلومات الطبية في ملفي الطبي (المعلومات الشخصية و الطبية) على برنامجه الإلكتروني, من أجل متابعة حالتي الصحية و الاتصال بي اذا لزم الأمر.
                  <br>
                  <div dir="ltr">
                  I permit the medical and administrative staff at the clinic of the Social Development Center in Brital to enter my personal details, including all medical information on my medical file (personal and medical information) into its computerized program, in order to follow up on my health and contact me if needed.
                  </div>
                  <!--<p><a id="view_1" class="btn btn-info" data-toggle="collapse" data-target="#viewdetails">View details &raquo;</a></p>-->
                </div>
                <div class="col-sm-3" style="border: 1px solid;">
                  <input type="radio" class="radio-inline" name="clinic_staff" id="clinic_staff" value="Yes">أوافق/I Consent
                  <br>
                  <input type="radio" class="radio" name="clinic_staff" id="clinic_staff_1" value="No">لا أوافق/I Do Not Consent
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9" style="border: 1px solid">
                  
                    أسمح بمشاركة هذه المعلومات كاملة مع منظمة الشبان المسيحية التي تقوم بمنح الأدوية.
                  <br>
                  <div dir="ltr">
                  I permit this information to be shared in full wit Young Men's Christian Association YMCA, who is providing the drugs.
                  </div>
                </div>
                <div class="col-sm-3" style="border: 1px solid">
                  <input type="radio" class="radio-inline" name="ymca_staff" id="ymca_staff" value="Yes">أوافق/I Consent
                  <br>
                  <input type="radio" class="radio" name="ymca_staff" id="ymca_staff_1" value="No">لا أوافق/I Do Not Consent
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9" style="border: 1px solid">
                أسمح بمشاركة هذه المعلومات مع منظمة ميدير التي تقوم بدعم برنامج الأمراض المزمنة في العيادة في مركز الخدمات في بريتال بهدف تحسين النوعية الطبية. و كما أني أسمح للفريق الطبي لمنظمة ميدير بالإطلاع على المعلومات الطبية كاملة بما فيها المعلومات الشخصية إذا إقتضت الحاجة.
                <div dir="ltr">
                I permit my information to be shared with Medair, who is supporting the NCD program in Brital SDC. I permit Medair's medical team to see my full medical information, including my personal information if necessary.
                </div>
                </div>
                <div class="col-sm-3" style="border: 1px solid">
                  <input type="radio" class="radio-inline" name="medair_staff" id="medair_staff" value="Yes">أوافق/I Consent
                  <br>
                  <input type="radio" class="radio" name="medair_staff" id="medair_staff_1" value="No">لا أوافق/I Do Not Consent
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            
            <label for="patient_id">Patient ID</label>
              <fieldset class="form-group">
                
                <input type="number" class="form-control" id="patient_id" name="patient_id" required>
                <label for="ymca_id">YMCA ID</label>
                <input type="number" class="form-control" id="ymca_id" name="ymca_id" required>
              </fieldset>
              
                <label for="patient_name_en">Name</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_name_en" id="patient_name_en">
                </fieldset>
                <label for="patient_father_name_en">Father Name</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_father_name_en" id="patient_father_name_en">
                </fieldset>
                <label for="patient_family_name_en">Family Name</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_family_name_en" id="patient_family_name_en">
              </fieldset>
              <label for="mother_name">Mother Name</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="mother_name" id="mother_name">
              </fieldset>
              <label for="gender">Gender</label>
                <fieldset class="form-group">
                
                <select style="color: #0090ff; " class="form-control select" name="gender" id="gender">
                  <option value="select">Select</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </fieldset>
              <label for="nationality">Nationality</label>
                <fieldset class="form-group">
                
                <select style="color: #0090ff" class="form-control select" name="nationality" id="nationality">
                  <option value="Syrian">Syrian</option>
                  <option value="Lebanese">Lebanese</option>
                  <option value="Palestinian">Palestinian</option>
                  <option value="Iraqi">Iraqi</option>
                  <option value="Egyptian">Egyptian</option>
                  <option value="Jordanian">Jordanian</option>
                </select>
              </fieldset>
            </div>
            <div class="col-sm-4">
              <label for="blood_type">Blood Type</label>
              <fieldset class="form-group">
                
                <select style="color: #0090ff" class="form-control select" name="blood_type" id="blood_type">
                  <option value="not_selected">Select</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                </select>
                </fieldset>
                <label for="patient_name_ar">الاسم</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_name_ar" id="patient_name_ar">
                </fieldset>
                <label for="patient_father_name_ar">اسم الأب</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_father_name_ar" id="patient_father_name_ar">
                </fieldset>
                <label for="patient_family_name_ar">العائلة</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_family_name_ar" id="patient_family_name_ar">
              </fieldset>
              <label for="dob">Date Of Birth</label>
                <fieldset class="form-group">
                
                <input style="height: 40px" class="form-control" type="date"  name="dob" id="dob">
              </fieldset>
              <label for="registration_date">Registration Date</label>
                <fieldset class="form-group">
                
                <input style="height: 40px" class="form-control" type="date"  name="registration_date" id="registration_date">
              </fieldset>
              <label for="unhcr_registration_number">UNHCR Registration #</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="unhcr_registration_number" id="unhcr_registration_number">
              </fieldset>
            </div>
            <div class="col-sm-4">
              <label for="patient_address">Address</label>
                <fieldset class="form-group">
                
                <textarea style="color: #0090ff; height:38px; border: 1px solid #0090ff" class="form-control" type="text"  name="patient_address" id="patient_address"></textarea>
              </fieldset>
              <label for="patient_phone">Phone</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_phone" id="patient_phone">
                </fieldset>
                <label for="patient_smoker">Smoker?</label>
                <fieldset class="form-group">
                
                <select style="color: #0090ff" class="form-control select" name="patient_smoker" id="patient_smoker">
                  <option value="select">Select</option>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                  <option value="Occasionally">Occasionally</option>
                </select>
                </fieldset>
                <label for="smoker_number_of_packets">Num Of Packet Per Day (علبة/باليوم)</label>
                <fieldset class="form-group">
                
                <input style="height:40px" class="form-control" type="number"  name="smoker_number_of_packets" id="smoker_number_of_packets" value="0">
                </fieldset>
                <label for="patient_alt_name">Alt. family member</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="patient_alt_name" id="patient_alt_name">
              </fieldset>
              <label for="patient_alt_contact_add">Alt. member info</label>
                <fieldset class="form-group">
                
                <textarea style="color: #0090ff; height:50px; border: 1px solid #0090ff" class="form-control" type="text"  name="patient_alt_contact_add" id="patient_alt_contact_add"></textarea>
              </fieldset>
              <label for="relation">Relation</label>
                <fieldset class="form-group">
                
                <input class="form-control" type="text"  name="relation" id="relation">
              </fieldset>
            </div>
            <div class="col-sm-6">
              <label for="diagnosis">Family Medical history</label>
                <fieldset class="form-group">
                  <textarea style="color: #0090ff; height:50px; border: 1px solid #0090ff" class="form-control" type="text"  name="diagnosis" id="diagnosis"></textarea>
                </fieldset>
            </div>
            <div class="col-sm-6">
              <label for="relation">Choose Family Medical disease history</label>
                <fieldset class="form-group">
                  <select class="form-control" id="diagnosis_data" name="diagnosis_data" style="color: #0090ff; border: 1px solid #0090ff">
                  <option value="choose">Select</option>
                  <?php foreach($getDiagnosisResult as $getDiag) {?>
                    
                    <option value="<?php $getDiag['diagnosis_name'] ?>"><?php echo $getDiag['diagnosis_name'] ?></option>
                    <?php } ?>
                  </select>
                </fieldset>
            </div>
            </div>
            <div class="row">
            <div class="col-sm-4">
            <label for="alcohol">Alcoholic?</label>
                <fieldset class="form-group">
                
                <select class="form-control" id="alcohol" name="alcohol" style=" height: 50px; color: #0090ff; border: 1px solid #0090ff">
                    <option value="select">Select</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Occasionally">Occasionally</option>
                </select>
              </fieldset>
            </div>
            <div class="col-sm-4">
            <label for="status">Status</label>
                <fieldset class="form-group">
                
                <select class="form-control" id="patient_status" name="patient_status" style=" height: 50px; color: #0090ff; border: 1px solid #0090ff">
                    <option value="select">Select</option>
                    <option value="Active">Active</option>
                    <option value="Deceased">Deceased</option>
                    <option value="Discharged">Discharged</option>
                    <option value="Defaulter">Defaulter</option>
                </select>
              </fieldset>
            </div>
            <div class="col-sm-4">
            <label for="comment">Comment</label>
                <fieldset class="form-group">
                
                <textarea style="color: #0090ff; height:50px; border: 1px solid #0090ff" class="form-control" type="text"  name="comment" id="comment"></textarea>
              </fieldset>
            </div>
          </div>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary pull-right" id="add_data" name="add_data"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add</button>
          </div>
        </div>
      </div>
     </div>
   </div>

  </div>
   </div>
</div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/bootstrap-toggle.min.js"></script>
  <script src="../js/registration.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/typeahead.bundle.js"></script>
  <script src="../js/barcodeReader.js"></script>
  <script>

    $(document).ready(function() {

      // $(function() {
      //   $("#searchTxt").typeahead({
      //     source: function(query, process) {
      //       var textVal=$("#searchTxt").val();
      //       $.ajax({
      //         url: '../php/autoComplete.php', // Please add full URL here
      //         type: 'POST',
      //         data: 'term=' + textVal,
      //         dataType: 'JSON',
      //         async: true,
      //         success: function(data) {
      //           process(data);
      //           console.log(textVal);
      //         }
      //       });
      //     }
      //   });
      // });
    })
    // $(document).ready(function(){
    //   $("#searchTxt").on('keyup', function(){


    //     searchTxt = $("#searchTxt").val();
    //     $.ajax({
    //       type: 'POST',
    //       url: '../php/autoComplete.php',
    //       data: {'searchTxt': searchTxt},
          
    //       dataType: 'json',
    //       success:function(resp)
    //       {
    //         $.each( resp, function(key, result)
    //         {
    //           var availableTags = result['patient_name_en'];
    //           $( "#searchTxt" ).autocomplete({
    //             source: "/ncd/php/autoComplete.php"
    //           });
    //         });

    //       },
    //       error:function(resp)
    //       {
    //         console.log(resp)
    //       }
    //     })
        
    //   } );

    // });
    </script>
</body>
</html>