<?php
  include_once('../php/connection.php');
  include_once('../php/getMedications.php');
  include_once('../php/addMed.php');
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
            <a class="nav-link active dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-home fa-plus" aria-hidden="true"></i>Pharmacy
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="new_med.php">Medications List</a>
              <a class="dropdown-item active" href="new_quantity.php">New Med/Quantity</a>
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
        <button type="button" class="btn btn-primary searchElement" id="searchBtn" name="searchBtn"><i class="fa fa-search fa-medkit" aria-hidden="true"></i> Add Med</button>
      </div>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
        </li>
      </ul>
    </div>
  </nav>
  
  <div class="row justify-content-center">
  <div class="col-sm-12 ">
      <div class="col-sm-6">
        <label for="medication_id">Medication</label>
        <fieldset class="form-group">
          <select class="form-control select" name="medication_id" id="medication_id">
                <option value="select">Select</option>
                <?php foreach($getExecGetMedications as $res) { ?>
                <option value="<?php echo $res['med_id'] ?>"><?php echo $res['med_name'] ?></option>
                <?php } ?>
              </select>
        </fieldset>
        <!-- End class="col-sm-6" -->
      </div>
      <div class="col-sm-6">
        <label for="expiry_date">Expiry Date</label>
        <fieldset class="form-group">
          <input type="date" class="form-control" name="expiry_date" id="expiry_date">
        </fieldset>
        <!-- End class="col-sm-6" -->
      </div>
        <div class="col-sm-3">
          <label for="medication_quantity">Nbr of tablets/Pack</label>
          <fieldset class="form-group">
            <input type="number" class="form-control" name="medication_quantity" id="medication_quantity">
          </fieldset>
          <!-- End class="col-sm-6" -->
          </div>
          <div class="col-sm-3">
          <label for="medication_pill">Nbr of Pills Per each Tablet</label>
          <fieldset class="form-group">
            <input type="number" class="form-control" name="medication_pill" id="medication_pill">
          </fieldset>
          <!-- End class="col-sm-6" -->
        </div>
      <div class="col-sm-6 rounded" style="background-color: #D3D3D3">
        <div class="row clonedInput" id="clonedInput1">
          <div class="col-sm-6">
            <label for="barcode">barcode</label>
            <fieldset class="form-group">
              <input type="text" class="form-control" name="barcode" id="barcode">
            </fieldset>
            <!-- End class="col-sm-6" -->
          </div>
          
          
          <!-- End class="col-sm-6" -->
        </div>
        <button class="btn btn-primary" type="button" id="add_med" name="add_med">Add</button>
      </div>
      
  </div>
</div>
  
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/addMedInfo.js"></script>
  <script src="../js/addMed.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>