<?php
  include_once('../php/connection.php');
  include_once('../php/getDiagnosis.php');
  include_once('../php/getDoctors.php');
  include_once('../php/getNurses.php');
  include_once('../php/getComplications.php');
  include_once('../php/getInfo.php');
  include_once('../php/getMedicationsInfo.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>NCD Web Application</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="icon" href="../images/Medair_Logo_2013.png">
  <link rel="stylesheet" href="../css/vert_tabs.css">
  <link rel="stylesheet" href="../css/textbox.css">
  <link rel="stylesheet" href="../css/modal.css">
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
            <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Patients
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="patient.php">New Patient</a>
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
            <a class="nav-link dropdown-toggle active" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Visits
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item active" href="visit.php">New Visit</a>
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
        <input class="form-control mr-sm-2 searchElement" type="text" id="searchTxt" name="searchTxt" placeholder="Search...">
        <button type="button" class="btn btn-primary searchElement" id="searchBtn" name="searchBtn"><i class="fa fa-search fa-fw" aria-hidden="true"></i> Search</button>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
        </li>
      </ul>
    </div>
  </nav><br>
  <div class="row justify-content-center">
    <div class="a col-xs-12 col-sm-12 col-md-10 col-lg-10 col-lg-push-10 col-md-push-10">
      <div class="card">
      <div class="card-header" style="color: #0090ff" align="center">
        Visit Information
      <!-- End class="card-header" -->
      </div>
        <div class="card-block">
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-6">
                  <label for="mother_name">Patient ID</label>
                    <fieldset class="form-group">
                      <input type="text" class="form-control" name="patient_id" id="patient_id" value="<?php echo $_REQUEST['pid'] ?>" disabled>
                    </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
                <div class="col-sm-6">
                  <label for="mother_name">Date of Visit</label>
                    <fieldset class="form-group">
                      <input type="date" style="height:39px" class="form-control" name="date_of_visit" id="date_of_visit">
                    </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
              <!-- End class="row" -->
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label for="mother_name">Visit Status</label>
                    <fieldset class="form-group">
                      <input type="text" class="form-control" name="visit_status" id="visit_status" value="Active" disabled>
                    </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
                <div class="col-sm-6">
                  <label for="patient_weight">Weight (Kg)</label>
                    <fieldset class="form-group">
                      <input type="number" class="form-control" name="patient_weight" id="patient_weight">
                    </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
                
                <div class="col-sm-6">
                  <label for="consultation_name">Consultation Type</label>
                  <fieldset class="form-group">
                    <select class="form-control select" id="consultation_name">
                      <option value="select">Select</option>
                      <option value="MedicationCollection">NCD – Nurse</option>
                      <option value="General">General</option>
                      <option value="OBS-Gyneco">OBS-Gynco</option>
                      <option value="Vaccination">Vaccination</option>
                      <option value="Family Planning">Family Planning</option>
                      <option value="NCD – General">NCD – General</option>
                      <option value="NCD – Endocrinologist">NCD – Endocrinologist</option>
                      <option value="NCD – Cardiologist">NCD – Cardiologist</option>
                    </select>
                  </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
                <div class="col-sm-6">
                  <label for="patient_height">Height (Cm)</label>
                    <fieldset class="form-group">
                      <input type="number" class="form-control" name="patient_height" id="patient_height">
                    </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
              <!-- End class="row" -->
              </div>
            <!-- End class="col-sm-4" -->
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-12">
                  
                <!-- End class="col-sm-6" -->
                </div>
                <div class="col-sm-6 ">
                <div class="col-sm-12">
                  
                <!-- End class="col-sm-6" -->
                </div>
                <!-- End class="col-sm-6" -->
                </div>
              </div>
                <div class="row">
                  <div class="col-sm-12">
                    <label for="complication_name">Symptoms</label>
                    <fieldset class="form-group">
                      <select class="form-control select" id="complication_name" name="complication_name">
                        <option value="select">Select</option>
                        <?php foreach($getExecGetComplications as $comp) { ?>
                          <option value="<?php echo $comp['complication_name'] ?>"><?php echo $comp['complication_name'] ?></option>
                        <?php } ?>
                      </select>
                    </fieldset>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                  <label for="patient_pressure">Blood Pressure</label>
                    <fieldset class="form-group">
                      <input type="text" class="form-control" name="patient_pressure" id="patient_pressure">
                    </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
                <div class="col-sm-6">
                  <label for="mother_name">Add More Symptoms</label>
                    <fieldset class="form-group">
                      <textarea type="date" style="color: #0090ff; height:125px; border: 1px solid #0090ff" " class="form-control" name="visit_reason" id="visit_reason"></textarea>
                    </fieldset>
                <!-- End class="col-sm-6" -->
                </div>
            <!-- End class="col-sm-4" -->
            </div>
            </div>

            <!-- End class="col-sm-4" -->
            </div>
            </div>
            <div class="row">
              <div class="col-sm-10">
                <!--<button type="button" class="btn btn-danger" id="calculate_cvd" name="calculate_cvd" style="margin-left: 20px; width: 150px">Calculate CVD</button>-->
                <button type="button" class="btn btn-danger" style="margin-left: 5px; width: 150px;" id="labTest" name="labTest" data-toggle="modal" data-target="#myModal2">Lab tests</button>
                <button type="button" class="btn btn-danger" style="margin-left: 5px; width: 150px;" id="foot_exam" name="foot_exam" data-toggle="modal" data-target="#myModal">Foot Exam.</button>
                <button type="button" class="btn btn-danger" id="next_app" name="next_app" style="margin-left: 5px; width: 150px;">Next Appointment</button>
              </div>
              <div class="col-sm-2">
                <button type="button" id="add_visit_info" name="add_visit_info" class="btn btn-primary pull-right" style="margin-right: 5px">Add Visit Info</button>
              </div>
              </div>
            </div>
            </div>
          <!-- End class="row" -->
          </div>
        <!-- End class="card-block" -->
        </div>
      <!-- End clas="card" -->
      </div>

    <!-- End class="a" -->
    </div>
     
  <!-- End class="row" -->
  </div>
  <div class="box" id="dialog" title="Results And Medications" style="display: none;">
    <div class="row">
        <div class="col-sm-3">
          <label for="mother_name">Patient ID</label>
            <fieldset class="form-group">
              <input type="text" class="form-control" name="patient_id" id="patient_id" value="<?php echo $_REQUEST['pid'] ?>" disabled>
            </fieldset>
        </div>
        <div class="col-sm-3">
          <label for="mother_name">Visit ID</label>
            <fieldset class="form-group">
              <input type="text" class="form-control" name="visit_id" id="visit_id" disabled>
            </fieldset>
        </div>
        <div class="col-sm-3">
          <label for="complication_name_2">Complication</label>
          <fieldset class="form-group">
            <select class="form-control select" name="complication_name_2" id="complication_name_2">
            <option value="select">Select</option>
            <?php foreach($getExecGetComplications as $res2) { ?>
              <option value="<?php echo $res2['complication_id'] ?>"><?php echo $res2['complication_name'] ?></option>
            <?php } ?>
            </select>
          </fieldset>
        </div>
        <div class="col-sm-3">
          <label for="diagnosis">Diagnosis</label>
          <fieldset class="form-group">
            <select class="form-control select" name="diagnosis" id="diagnosis">
              <option value="select">Select</option>
              <?php foreach($getDiagnosisResult as $res) { ?>
                <option value="<?php echo $res['diagnosis_id'] ?>"><?php echo $res['diagnosis_name'] ?></option>
              <?php } ?>
            </select>
      </div>
        
      </div>
      <div class="row">
        <div class="col-sm-3">
          <label for="medication_collector">Collector</label>
          <fieldset class="form-group">
            <select id="medication_collector" class="form-control select">
              <option value="select">Select</option>
              <option value="himself">Himself</option>
              <option value="relative">Relative</option>
              <option value="other">Other</option>
            </select>
          </fieldset>
        </div>
        <div class="col-sm-3">
          <label for="medication_collector_2">Collector Name</label>
            <fieldset class="form-group">
              <input type="text" name="medication_collector_2" id="medication_collector_2" class="form-control">
              </select>
            </fieldset>
        </div>
        <div class="col-sm-6">
          <label for="barcode_nbr">Barcode (Optional)</label>
            <fieldset class="form-group">
              <input type="text" class="form-control" name="barcode_nbr" id="barcode_nbr">
            </fieldset>
        </div>
      </div>
    <div class="row">
        <div class="col-sm-3">
          <label for="doctor_list_id">Doctor</label>
          <fieldset class="form-group">
            <select class="form-control select" name="doctor_list_id" id="doctor_list_id">
            <option value="select">Select</option>
            <?php foreach($getDoctorsResult as $res) { ?>
              <option value="<?php echo $res['doctor_list_id'] ?>"><?php echo $res['doctor_name'] ?></option>
            <?php } ?>
            </select>
          </fieldset>
        </div>
        <div class="col-sm-3">
          <label for="nurse_list_id">Nurse</label>
          <fieldset class="form-group">
            <select class="form-control select" name="nurse_list_id" id="nurse_list_id">
              <option value="select">Select</option>
              <?php foreach($getNursesResult as $res) { ?>
                <option value="<?php echo $res['nurse_list_id'] ?>"><?php echo $res['nurse_name'] ?></option>
              <?php } ?>
            </select>
        </div>
        <div class="col-sm-3">
          <label for="medication_id">Medication</label>
            <fieldset class="form-group">
              <select class="form-control select" name="medication_id" id="medication_id">
                <option value="select">Select</option>
                <?php foreach($result as $res3) { ?>
                  <option value="<?php echo $res3['med_pharmacy_id'] ?>" name="<?php echo $res3['med_id'] ?>"><?php echo $res3['med_name'] ?></option>
                <?php } ?>
              </select>
            </fieldset>
        <!-- End class="col-sm-3" -->
        </div>
        <div class="col-sm-3">
          <label for="medication_quantity">Quantity</label>
            <fieldset class="form-group">
              <input type="number" class="form-control" name="medication_quantity" id="medication_quantity">
            </fieldset>
        <!-- End class="col-sm-6" -->
        </div>
        <div class="col-sm-12">
          <label for="complication_name_3">Complications</label>
          <fieldset class="form-group">
            <textarea style="color: #0090ff; height:50px; border: 1px solid #0090ff" class="form-control" type="text"  name="complication_name_3" id="complication_name_3"></textarea>
          </fieldset>
        <!-- End class="col-sm-6" -->
        </div>
        <div class="col-sm-12">
          <label for="consultation_result">Results And Comments</label>
          <fieldset class="form-group">
            <textarea style="color: #0090ff; height:128px; border: 1px solid #0090ff" class="form-control" type="text"  name="consultation_result" id="consultation_result"></textarea>
          </fieldset>
        <!-- End class="col-sm-6" -->
        </div>
      </div>
    <div class="row pull-right">
        <button class="btn btn-primary pull-right" id="add_more" name="add_more">Add More</button>
    </div>
    <div class="alert alert-danger" id="danger_message" style="display: none">
      <strong>Exceeded!</strong> There's not that quantity in our stock for that medication.
    </div>
    <div class="alert alert-danger" id="danger_message_dr" style="display: none">
      <strong>Please choose either a Dotcor or a Nurse!</strong>
    </div>
  </div>
  <div id="next_app_div" title="Specify next appointment for the current patient" style="display: none;">
    <div class="row">
      <div class="col-sm-8">
        <label for="next_appointment_date">Date Of the appointment</label>
          <fieldset class="form-group">
            <input type="date" class="form-control" name="next_appointment_date" id="next_appointment_date">
          </fieldset>
      </div>
      <div class="col-sm-4">
        <label for="next_appointment_time">Time</label>
          <fieldset class="form-group">
            <input type="time" class="form-control" name="next_appointment_time" id="next_appointment_time">
          </fieldset>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <button type="button" id="add_appointment" name="add_appointment" class="btn btn-primary" style="margin-left: 15px">Add Appointment</button>
        </div>
      </div>
    </div>
  </div>
  <div id="calculate_cvd_div" title="CVD Calculations" style="display: none;">
    <div class="row">
      <div class="col-sm-4">
        <label for="time_period">Time Period</label>
          <fieldset class="form-group">
            <input type="number" class="form-control" name="time_period" id="time_period" value="10">
          </fieldset>
      </div>
      <div class="col-sm-4">
        <label for="time_period">Gender</label>
          <fieldset class="form-group">
            <input type="text" class="form-control" name="gender" id="gender" value="<?php echo $getInfoResult['gender'] ?>" disabled>
          </fieldset>
      </div>
      <div class="col-sm-4">
        <label for="time_period">Age</label>
          <fieldset class="form-group">
            <input type="text" class="form-control" name="age" id="age" value="<?php echo $getInfoResult['dob'] ?>" disabled>
          </fieldset>
      </div>
    </div>
    <div class="row">
    <div class="col-sm-4">
        <label for="smoker">Smoker</label>
          <fieldset class="form-group">
            <input type="text" class="form-control" name="smoker" id="smoker" value="<?php if($getInfoResult['patient_smoker']=="No"){echo "No";} else { echo "Yes";} ?>" disabled>
          </fieldset>
      </div>
      <div class="col-sm-4">
        <label for="sbp">Systolic Blood Pressure (mmHg)</label>
          <fieldset class="form-group">
            <input type="number" class="form-control" name="sbp" id="sbp">
          </fieldset>
      </div>
      <div class="col-sm-4">
        <label for="total_chol">Total Cholesterol (mmol/L)</label>
          <fieldset class="form-group">
            <input type="number" class="form-control" name="total_chol" id="total_chol">
          </fieldset>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <label for="hdl_chol">HDL Cholesterol (mmol/L)</label>
          <fieldset class="form-group">
            <input type="number" class="form-control" name="hdl_chol" id="hdl_chol">
          </fieldset>
      </div>
      <div class="col-sm-4">
        <label for="diabetes">Diabetes</label>
          <fieldset class="form-group">
            <select type="text" class="form-control select" name="diabetes" id="diabetes">
              <option value="select">Select</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </fieldset>
      </div>
      <div class="col-sm-4">
        <label for="lvh">LVH</label>
          <fieldset class="form-group">
            <select type="text" class="form-control select" name="lvh" id="lvh">
              <option value="select">Select</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select>
          </fieldset>
      </div>
    </div>
    <div class="row pull-right">
      <div class="col-sm-12">
        <button type="button" class="btn btn-danger pull-right" name="calculate_add" id="calculate_add">
        Calculate And Add
        </button>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade md1" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Routine Blood Test for NCDs</h4>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <table class="table table-bordered table-responsive">
                <tr>
                  <th>Date</th><td><input type="date" class="form-control" name="lab_test_date" id="lab_test_date"></td>
                  <th>Patient ID</th><td><input type="text" class="form-control" style="width: 200px" name="patient_id_lab" id="patient_id_lab" value="<?php echo $_REQUEST['pid'] ?>" disabled></td>
                </tr>
                <tr>
                  <th colspan="4" style="background-color: #0090ff">Diabetes type I or II (with or without hypertension)</th>
                  
                </tr>
                <tr>
                  <th>Glycemia</th><td colspan="3"><input type="number" class="form-control" name="glycemia" id="glycemia"></td>
                </tr>
                <tr>
                  <th>HbA1c</th><td colspan="3"><input type="number" class="form-control" name="hba" id="hba"></td>
                </tr>
                <tr>
                  <th>Creatinine</th><td colspan="3"><input type="number" class="form-control" name="creatinine" id="creatinine"></td>
                </tr>
                <tr>
                  <th>Urea</th><td colspan="3"><input type="number" class="form-control" name="urea" id="urea"></td>
                </tr>
                <tr>
                  <th>AST</th><td colspan="3"><input type="number" class="form-control" name="ast" id="ast"></td>
                </tr>
                <tr>
                  <th>ALT</th><td colspan="3"><input type="number" class="form-control" name="alt" id="alt"></td>
                </tr>
                <tr>
                  <th>Total Cholesterol</th><td colspan="3"><input type="number" class="form-control" name="total_cholesterol" id="total_cholesterol"></td>
                </tr>
                <tr>
                  <th>HDL Cholesterol</th><td colspan="3"><input type="number" class="form-control" name="hdl_cholesterol" id="hdl_cholesterol"></td>
                </tr>
                <tr>
                  <th rowspan="2">Comments</th><td colspan="4"><textarea style="border-color: #0090ff;" class="form-control" name="comment" id="comment"></textarea></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-default" id="add_lab_test" name="add_lab_test">Add lab test</button>
        </div>
      </div>
      
    </div>
  </div>
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: left;">Foot Screening</h4>
      </div>
      <div class="modal-body form-inline">
        <table class="table table-bordered table-responsive">
          <tr>
            <th>Patient ID</th>
            <td><input type="text" class="form-control" style="width: 200px" name="patient_id_foot" id="patient_id_foot" value="<?php echo $_REQUEST['pid'] ?>" disabled></td>
          </tr>
          <tr>
            <th>Date</th>
            <td><input type="date" class="form-control" name="date_of_exam" id="date_of_exam"></td>
            <th>Left Foot</th>
            <th>Right Foot</th>
          </tr>
          <tr> 
            <th rowspan="2" style="width: 100px">History</th>
            <td>1. Previous Ulcer</td>
            <td>
              <input type="radio" class="radio-inline" name="prev_ulcer_left" id="prev_ulcer_left" value="Yes">Yes
              <input type="radio" class="radio" name="prev_ulcer_left" id="prev_ulcer_left" value="No">No
            </td>
            <td>
              <input type="radio" class="radio-inline" name="prev_ulcer_right" id="prev_ulcer_right" value="Yes">Yes
              <input type="radio" class="radio" name="prev_ulcer_right" id="prev_ulcer_right" value="No">No
            </td>
          </tr>
          <tr>
            <td>2. Previous Amputation</td>
            <td>
              <input type="radio" class="radio-inline" name="prev_amput_left" id="prev_amput_left" value="Yes">Yes
              <input type="radio" class="radio" name="prev_amput_left" id="prev_amput_left" value="No">No
            </td>
            <td>
              <input type="radio" class="radio-inline" name="prev_amput_right" id="prev_amput_right" value="Yes">Yes
              <input type="radio" class="radio" name="prev_amput_right" id="prev_amput_right" value="No">No
            </td>
          </tr>
          <tr>
            <th rowspan="2">Physical Exam</th>
            <td>3. Deformity</td>
            <td>
              <input type="radio" class="radio-inline" name="deformity_left" id="deformity_left" value="Yes">Yes
              <input type="radio" class="radio" name="deformity_left" id="deformity_left" value="No">No
            </td>
            <td>
              <input type="radio" class="radio-inline" name="deformity_right" id="deformity_right" value="Yes">Yes
              <input type="radio" class="radio" name="deformity_right" id="deformity_right" value="No">No
            </td>
          </tr>
          <tr>
            <td>4. Absent pedal pulses(Dorsalis Pedis and/or Posterior Tibial)</td>
            <td>
              <input type="radio" class="radio-inline" name="absent_pedal_left" id="absent_pedal_left" value="Yes">Yes
              <input type="radio" class="radio" name="absent_pedal_left" id="absent_pedal_left" value="No">No
            </td>
            <td>
              <input type="radio" class="radio-inline" name="absent_pedal_right" id="absent_pedal_right" value="Yes">Yes
              <input type="radio" class="radio" name="absent_pedal_right" id="absent_pedal_right" value="No">No
            </td>
          </tr>
          <tr>
            <th rowspan="5">Foot Lesions</th>
              <td>5. Active Ulcer</td>
              <td>
                <input type="radio" class="radio-inline" name="active_ulcer_left" id="active_ulcer_left" value="Yes">Yes
                <input type="radio" class="radio" name="active_ulcer_left" id="active_ulcer_left" value="No">No
              </td>
              <td>
                <input type="radio" class="radio-inline" name="active_ulcer_right" id="active_ulcer_right" value="Yes">Yes
                <input type="radio" class="radio" name="active_ulcer_right" id="active_ulcer_right" value="No">No
              </td>
          </tr>
          <tr>
            <td>6. Ingrown toenail</td>
            <td>
                <input type="radio" class="radio-inline" name="ingrown_left" id="ingrown_left" value="Yes">Yes
                <input type="radio" class="radio" name="ingrown_left" id="ingrown_left" value="No">No
              </td>
              <td>
                <input type="radio" class="radio-inline" name="ingrown_right" id="ingrown_right" value="Yes">Yes
                <input type="radio" class="radio" name="ingrown_right" id="ingrown_right" value="No">No
              </td>
          </tr>
          <tr>
            <td>7. Calluses (thick plantar skin)</td>
            <td>
                <input type="radio" class="radio-inline" name="calluses_left" id="calluses_left" value="Yes">Yes
                <input type="radio" class="radio" name="calluses_left" id="calluses_left" value="No">No
              </td>
              <td>
                <input type="radio" class="radio-inline" name="calluses_right" id="calluses_right" value="Yes">Yes
                <input type="radio" class="radio" name="calluses_right" id="calluses_right" value="No">No
            </td>
          </tr>
          <tr>
            <td>8. Blisters (fluid-filled sack)</td>
            <td>
                <input type="radio" class="radio-inline" name="blisters_left" id="blisters_left" value="Yes">Yes
                <input type="radio" class="radio" name="blisters_left" id="blisters_left" value="No">No
              </td>
              <td>
                <input type="radio" class="radio-inline" name="blisters_right" id="blisters_right" value="Yes">Yes
                <input type="radio" class="radio" name="blisters_right" id="blisters_right" value="No">No
            </td>
          </tr>
          <tr>
            <td>9. Fissure (linear crack)</td>
            <td>
                <input type="radio" class="radio-inline" name="fissure_left" id="fissure_left" value="Yes">Yes
                <input type="radio" class="radio" name="fissure_left" id="fissure_left" value="No">No
              </td>
              <td>
                <input type="radio" class="radio-inline" name="fissure_right" id="fissure_right" value="Yes">Yes
                <input type="radio" class="radio" name="fissure_right" id="fissure_right" value="No">No
            </td>
          </tr>
          <tr>
            <th rowspan="3">Neuropathy More than 4/10 sites lacking feeling = yes</th>
            <td>10. Monofilament Exam</td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>a) Right <input type="number" class="form-control" style="width: 75px" name="right_result" id="right_result">/10 negatives(≥ 4 negatives = yes)</td>
            <td style="vertical-align: middle">
                <input type="radio" class="radio yes-val-r" name="monofilament_right_left" id="monofilament_right_left" value="Yes">Yes
                <input type="radio" class="radio no-val-r" name="monofilament_right_left" id="monofilament_right_left" value="No">No
              </td>
              <td style="vertical-align: middle">
                <input type="radio" class="radio-inline" name="monofilament_right_right" id="monofilament_right_right" value="Yes">Yes
                <input type="radio" class="radio" name="monofilament_right_right" id="monofilament_right_right" value="No">No
            </td>
          </tr>
          <tr>
            <td style="vertical-align: middle">b) Left <input type="number" class="form-control" style="width: 75px" name="left_result" id="left_result">/10 negatives(≥ 4 negatives = yes)</td>
            <td style="vertical-align: middle">
                <input type="radio" class="radio-inline yes-val-l" name="monofilament_left_left" id="monofilament_left_left" value="Yes">Yes
                <input type="radio" class="radio  no-val-l" name="monofilament_left_left" id="monofilament_left_left" value="No">No
              </td>
              <td style="vertical-align: middle">
                <input type="radio" class="radio-inline" name="monofilament_left_right" id="monofilament_left_right" value="Yes">Yes
                <input type="radio" class="radio" name="monofilament_left_right" id="monofilament_left_right" value="No">No
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default" id="add_examination" name="add_examination">Add</button>
      </div>
    </div>

  </div>
  </div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/addDiagnosisToTextBox.js"></script>
  <script src="../js/addVisit.js"></script>
  <script src="../js/addComplications.js"></script>
  <script src="../js/next_app.js"></script>
  <script src="../js/calculate_cvd.js"></script>
  <script src="../js/ensureQuantity.js"></script>
  <script src="../js/barcodeSearch.js"></script>
  <script src="../js/consultationType.js"></script>
  <script src="../js/footExamination.js"></script>
  <script src="../js/labTest.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>