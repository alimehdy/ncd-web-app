<?php
  include_once('../php/connection.php');
  include_once('../php/getDiagnosis.php');
  // include_once('../php/getVisits.php');
  include_once('../php/getDoctors.php');
  include_once('../php/getNurses.php');
  include_once('../php/getComplications.php');
  include_once('../php/getMedicationsInfo.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>NCD Web Application</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="icon" href="../images/Medair_Logo_2013.png">
  <link rel="stylesheet" href="../css/vert_tabs.css">
  <link rel="stylesheet" href="../css/textbox.css">
  <link rel="stylesheet" href="../css/jquery-ui.css">

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
              <a class="dropdown-item" href="visit.php">New Visit</a>
              <a class="dropdown-item active" href="visit_status.php">Visit Status</a>
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
  </nav>
  <div class="container">
  <div class="row justify-content-md-center">
   <div class="a col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-push-12 col-md-push-12">
     <div class="row">
     <div id="wait" style="display: none;"><img src="../images/loader.gif"></div>
     <table class="table table-hover table-responsive" id="patient_table">
        <tr class="bg-info" id="after_tr">
         <th>Patient ID</th>
         <th>YMCA ID</th>
         <th>Visit Date</th>
         <th>Visit ID</th>
         <th>Patient Name</th>
         <th>Visit Status</th>
         <th>Change Status</th>
         <th colspan="2">Actions</th>
       </tr>
       <tr>
       <th colspan="9">Type in the search box to get data</th>
       </tr>
       <?php //foreach($getVisitsResult as $visit) { ?>
       <!--<tr id="<?php //echo $visit['visit_id']; ?>">
        <td><?php //echo $visit['patient_id']; ?></td>
        <td><?php //echo $visit['ymca_id']; ?></td>
        <td><?php //echo $visit['date_of_visit']; ?></td>
        <td><a href="visit_profile.php?pid=<?php echo $visit['visit_id']; ?>"><?php echo $visit['visit_id']; ?></a></td>
        <td><?php //echo $visit['pn']; ?></td>
         
        <td class="change_status"><?php //echo $visit['visit_status']; ?></td>
        <td>
          <select style="color: #0090ff; " class="form-control select patient_status" name="patient_status">
            <option value="select">Select</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
          <input type="hidden" name="patient_id_txt" id="patient_id_txt" value="<?php //echo $visit['patient_id'] ?>">
         </td>
         <td><a href="visit_profile.php?pid=<?php //echo $visit['visit_id']; ?>" id="visitBtn"><span class="badge badge badge-info" style="background-color: #0090ff">Visit Details</span></a></td>
         <td><a id="addInfoBtn"><span class="badge badge badge-info" style="background-color: #0090ff">Add Results/Medications</span></a></td>
       </tr>  
       <?php //} ?> -->
     </table>
     </div>
    </div>
  </div>
  </div>
  <div class="box" id="dialog" title="Results And Medications" style="display: none;">
    <div class="row">
        <div class="col-sm-3">
          <label for="mother_name">Patient ID</label>
            <fieldset class="form-group">
              <input type="text" class="form-control" name="patient_id" id="patient_id" value="" disabled>
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
                  <option value="<?php echo $res3['med_pharmacy_id'] ?>"><?php echo $res3['med_name'] ?></option>
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
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/searchVisit.js"></script>
  <script src="../js/changeVisitStatus.js"></script>
  <script src="../js/addComplications.js"></script>
  <script src="../js/addMore.js"></script>
  <script src="../js/ensureQuantity.js"></script>
  <!-- <script src="../js/barcodeSearch.js"></script> -->
  <script src="../js/consultationType.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>