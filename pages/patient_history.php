<?php
  include_once('../php/connection.php');
  include_once('../php/getDiagnosis.php');
  include_once('../php/getDiseaseHistory.php');
  include_once('../php/getAllergyHistory.php');
  include_once('../php/getSurgeryHistory.php');
  $pid = $_REQUEST['pid'];
  $clinic_id=$_SESSION['clinic_id'];
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
  <style type="text/css">
    input[type="text"] {
      color: #0090ff;
      border:1px solid #0090ff;
      height: 50px;
    }
  </style>
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
              <a class="dropdown-item" href="patient.php">New Patient</a>
              <a class="dropdown-item" href="patient_profile.php">Patient Profile</a>
              <a class="dropdown-item active" href="edit.php">Edit Profile and/or History</a>
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
  <br>
  <div class="container"></div>
  <div class="row">
  <div class="col-sm-6">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header" style="color: #0090ff" align="center">
            Patient Medical History
          </div>
          <div class="card-block">
            <div class="row" id="buildForm">
              <div class="col-sm-4">
             <label for="disease">Disease</label>
                <fieldset class="form-group">
                <input type="hidden" name="pid" id="pid" value="<?php echo $pid; ?>">
                <select class="form-control" id="disease" name="disease" style="color: #0090ff; border: 1px solid #0090ff">
                  <option value="select">Select</option>
                  <?php foreach($getDiagnosisResult as $getDiag) {?>
                    
                    <option value="<?php $getDiag['diagnosis_name'] ?>"><?php echo $getDiag['diagnosis_name'] ?></option>
                    <?php } ?>
                  </select>
              </fieldset>
            </div>
              <div class="col-sm-4">
                <label for="patient_medicationn">Medication</label>
                <fieldset class="form-group">
                
                <input type="text" class="form-control" id="patient_medicationn" name="patient_medicationn">
              </fieldset>
            </div>
            <div class="col-sm-4">
             <label for="patient_side_effect">Side Effect</label>
                <fieldset class="form-group">
                
                <textarea style="color: #0090ff; height:50px; border: 1px solid #0090ff" type="text" class="form-control" id="patient_side_effect" name="patient_side_effect" required></textarea>
              </fieldset>
            </div>
            
          </div>
          <button type="button" class="btn btn-primary pull-right" id="add_history"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add</button>
        </div>
        <div class="card-footer" id="footer1"><button class="btn btn-box-tool pull-right" id="minimize1" name="minimize1" data-widget="collapse"><i class="fa fa-plus pull-right"></i></button>
        <div id="table1" style="display:none">
          <table class="table table-hover">
            <tr id="after_th">
              <th>Disease</th>
              <th>Medication</th>
              <th>Side Effect</th>
              <th>Action</th>
            </tr>
            <?php foreach($getDiseaseHistoryResult as $disease) { ?>
            <tr id="<?php echo $disease['patient_medication_id'] ?>">
              <td><?php echo $disease['disease']; ?></td>
              <td><?php echo $disease['patient_medication']; ?></td>
              <td><?php echo $disease['patient_side_effect']; ?></td>
              <td><button type="button" class="btn btn-danger btn-sm" id="delete_disease" name="delete_disease"><i class="fa fa-remove"></i></button>
              </td>
            </tr>
            <?php } ?>
          </table>
          </div>
        </div>
      </div>
  </div>
  </div>
  <div class="col-sm-6">
    <div class="col-sm-12">
        <div class="card">
          <div class="card-header" style="color: #0090ff" align="center">
            Patient Allergy History
          </div>
          <div class="card-block">
            <div class="row" id="buildForm">

              <div class="col-sm-4">
                <label for="patient_allergy_med">Medication</label>
                <fieldset class="form-group">
                
                <input type="text" class="form-control" id="patient_allergy_med" name="patient_allergy_med" required>
              </fieldset>
            </div>
            <div class="col-sm-4">
             <label for="patient_side_effect_allergy">Side Effect</label>
                <fieldset class="form-group">
                
                <textarea style="color: #0090ff; height:50px; border: 1px solid #0090ff" type="text" class="form-control" id="patient_side_effect_allergy" name="patient_side_effect_allergy" required></textarea>
              </fieldset>
            </div>
            <div class="col-sm-4">
             <label for="disease">Comment</label>
                <fieldset class="form-group">
                <input type="text" class="form-control" id="comment" name="comment" required>
                
              </fieldset>
            </div>
            
          </div>
          <button type="button" class="btn btn-primary pull-right" id="add_allergy" name="add_allergy"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add</button> 
        </div>
        <div class="card-footer">
          <button class="btn btn-box-tool pull-right" id="minimize2" name="minimize2" data-widget="collapse"><i class="fa fa-plus pull-right"></i></button>
          <div id="table2" style="display:none">
            <table class="table table-hover">
              <tr id="after_th_allergy">
              <th>Medication</th>
              <th>Side Effect</th>
              <th>Comment</th>
              </tr>
              <?php foreach($getAllergyHistoryResult as $allergy) { ?>
              <tr id="<?php echo $allergy['patient_allergy_id'] ?>">
              <td><?php echo $allergy['patient_allergy_med'] ?></td>
              <td><?php echo $allergy['med_side_effect'] ?></td>
              <td><?php echo $allergy['comment'] ?></td>
              <td><button type="button" class="btn btn-danger btn-sm" id="delete_allergy" name="delete_allergy"><i class="fa fa-remove"></i></button>
              </td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
  </div>
  <br>
  <div class="row">
  <div class="col-sm-12">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header" style="color: #0090ff" align="center">
            Patient Surgical History
          </div>
          <div class="card-block">
            <div class="row" id="buildForm">
              <div class="col-sm-4">
             <label for="patient_surgery">Surgery</label>
                <fieldset class="form-group">
                
                <input type="text" class="form-control" id="patient_surgery" name="patient_surgery" required>
              </fieldset>
            </div>
              <div class="col-sm-4">
                <label for="surgery_date">date</label>
                <fieldset class="form-group">
                
                <input type="date" style="height: 50px" class="form-control" id="surgery_date" name="surgery_date" required>
              </fieldset>
            </div>
            <div class="col-sm-4">
             <label for="surgery_comment">Comment</label>
                <fieldset class="form-group">
                
                <textarea style="color: #0090ff; height:50px; border: 1px solid #0090ff" type="text" class="form-control" id="surgery_comment" name="surgery_comment" required></textarea>
              </fieldset>
            </div>
            
          </div>
          <button type="button" class="btn btn-primary pull-right" id="add_surgery" name="add_surgery"><i class="fa fa-plus fa-fw" aria-hidden="true"></i> Add</button>
        </div>
        <div class="card-footer">
          <button class="btn btn-box-tool pull-right" id="minimize3" name="minimize3" data-widget="collapse"><i class="fa fa-plus pull-right"></i></button>
          <div id="table3" style="display:none">
            <table class="table table-hover">
              <tr id="after_th_surgery">
              <th>Surgery</th>
              <th>Date</th>
              <th>Comment</th>
              </tr>
              <?php foreach($getSurgeryHistoryResult as $surgery) { ?>
              <tr id="<?php echo $surgery['surgical_info_id'] ?>">
              <td><?php echo $surgery['patient_surgery'] ?></td>
              <td><?php echo $surgery['surgery_date'] ?></td>
              <td><?php echo $surgery['comment'] ?></td>
              <td><button type="button" class="btn btn-danger btn-sm" id="delete_surgery" name="delete_surgery"><i class="fa fa-remove"></i></button>
              </td>
              </tr>
              <?php } ?>
            </table>
          </div>
        </div>
      </div>
  </div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/history.js"></script>
  <script src="../js/allergy.js"></script>
  <script src="../js/surgery.js"></script>
  <script src="../js/deleteDiseaseFromHistory.js"></script>
  <script src="../js/deleteAllergyFromHistory.js"></script>
  <script src="../js/deleteSurgeryFromHistory.js"></script>
  <script src="../js/minimize.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>