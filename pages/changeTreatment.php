<?php
  include_once('../php/connection.php');
  include_once('../php/changeTreatment.php');
  include_once('../php/getMedications.php');
  include_once('../php/getChangement.php');
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
            <a class="nav-link dropdown-toggle active" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Patients
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="patient.php">New Patient</a>
              <a class="dropdown-item" href="patient_profile.php">Patient Profile</a>
              <a class="dropdown-item" href="edit.php">Edit Profile and/or History</a>
              <a class="dropdown-item" href="diabetes.php">Diabetes List</a>
              <a class="dropdown-item" href="assessment.php">Monthly Assessment Avg</a>
              <a class="dropdown-item" href="labTest.php">Laboratory test Report</a>
              <a class="dropdown-item active" href="changeTreatment.php">Change Medication/Treatment</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
      <div class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2 searchElement" type="text" id="searchTxt" name="searchTxt" placeholder="Add..." disabled>
        
      </div>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="row ">
  <div class="col-sm-4">
      <div class="col-sm-12">
        <label for="medication_id">Patient ID</label>
        <fieldset class="form-group">
          <select class="form-control selectNew" name="pid" id="pid">
                <option value="select">Select</option>
                <?php foreach($id as $res) { ?>
                <option value="<?php echo $res['patient_id'] ?>"><?php echo $res['patient_id'] ?></option>
                <?php } ?>
              </select>
        </fieldset>
        <label for="medication_id">Patient Name</label>
        <fieldset class="form-group">
          <select class="form-control selectNew" name="patient_name" id="patient_name">
                <option value="select">Select</option>
                <?php foreach($id as $res) { ?>
                <option value="<?php echo $res['patient_id'] ?>"><?php echo $res['patient_name'] ?></option>
                <?php } ?>
              </select>
        </fieldset>
        <!-- End class="col-sm-6" -->
      </div>
      <div class="col-sm-12">
        <label for="expiry_date">Month of change</label>
        <fieldset class="form-group">
          <input type="date" class="form-control" name="expiry_date" id="expiry_date">
        </fieldset>
        <!-- End class="col-sm-6" -->
      </div>
    </div>
    <div class="col-sm-4">
        <div class="col-sm-12 rounded">
          <label for="medication_quantity">Old Medication</label>
          <fieldset class="form-group">
          <select class="form-control selectNew" name="medication_id" id="medication_id">
                <option value="select">Select</option>
                <?php foreach($getExecGetMedications as $res) { ?>
                <option value="<?php echo $res['med_id'] ?>"><?php echo $res['med_name'] ?></option>
                <?php } ?>
              </select>
        </fieldset>
        </div>
        <div class="col-sm-12 rounded">
          <label for="medication_quantity">Old Quantity</label>
          <fieldset class="form-group">
            <textarea class="form-control" name="old_treatment" id="old_treatment"></textarea>
          </fieldset>
          <label for="treatment_status">Status</label>
          <fieldset class="form-group">
            <select class="form-control selectNew" id="treatment_status" name="treatment_status" disabled>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </fieldset>
          <!-- End class="col-sm-6" -->
          </div>
        </div>
        <div class="col-sm-4">
        <div class="col-sm-12 rounded">
          <label for="medication_quantity">New Medications</label>
          <fieldset class="form-group">
          <select class="form-control selectNew" name="new_medication_id" id="new_medication_id">
                <option value="select">Select</option>
                <?php foreach($getExecGetMedications as $res) { ?>
                <option value="<?php echo $res['med_id'] ?>"><?php echo $res['med_name'] ?></option>
                <?php } ?>
              </select>
        </fieldset>
        </div>
        <div class="col-sm-12 rounded">
          <label for="medication_quantity">New Quantity</label>
          <fieldset class="form-group">
            <textarea type="number" class="form-control" name="new_treatment" id="new_treatment"></textarea>
          </fieldset>
          <!-- End class="col-sm-6" -->
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-primary searchElement" id="searchBtn" name="addChange" id="addChange"><i class="fa fa-search fa-medkit" aria-hidden="true"></i> Add Change</button>
        </div>
        </div>       
      </div>
  </div>
  <br><br><br>
  <div class="container">
    <div class="col-sm-12">
      <table class="table table-bordered table-hovered table-condensed" id="res_table">
        <tr class="bg-info" id="after_tr">
          <th>Patient ID</th><th>Patient Name</th><th>Old Treatment</th><th>New Treatment</th><th>Date</th><th>Status</th><th>Change Status</th>
        </tr>
        <?php foreach($result as $res){ ?>
        <tr id="<?php echo $res['treatment_id'] ?>">
          <td><?php echo $res['patient_id'] ?></td>
          <td><?php echo $res['patient_name_en'] ?></td>
          <td><?php echo $res['old_treatment'] ?></td>
          <td><?php echo $res['new_treatment'] ?></td>
          <td><?php echo $res['date_of_change'] ?></td>
          <td class="currentStatus"><?php echo $res['treatment_status'] ?></td>
          <td>
            <select class="form-control select" id="change_status">
              <option value="select">Select</option>
              <option value="Active">Active</option>
              <option value="Inactive">Inactive</option>
            </select>
          </td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/checkID.js"></script>
</body>
</html>