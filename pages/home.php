<?php
  include_once('../php/connection.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>NCD Web Application</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="icon" href="../images/Medair_Logo_2013.png">
</head>
<body>
<div class="row">
<div class="col-md-2">
</div>
<div class="col-sm-8" align="center">
<div class="card">
  <img class="card-img-top" src="../images/Medair_Logo_2013.png" alt="Card image cap">
  <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
  <div class="card-block">
    <br>

</div>

<div class="row justify-content-md-center">
    <div class="col-sm-6" style="margin-bottom: 10px;">
        <div class="pull-left">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" style="width: 200px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-book fa-users" aria-hidden="true"></i>Patients
              </button>
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
        </div>
        <div class="row justify-content-md-center">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" style="width: 200px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-book fa-fw" aria-hidden="true"></i>Visits
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="visit.php">New Visit</a>
                <a class="dropdown-item" href="visit_status.php">Visit Status</a>
                <a class="dropdown-item" href="appointment.php">Next Appointment</a>
                <a class="dropdown-item" href="missed_visit.php">Missed Visit</a>
              </div>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-md-center">
    <div class="col-sm-6 align-middle">
        <div class="pull-left">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" style="width: 200px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Pharmacy
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="new_med.php">Medications List</a>
                <a class="dropdown-item" href="new_quantity.php">New Med/Quantity</a>
                <a class="dropdown-item" href="expiredMed.php">Nearly Expired Med</a>
              </div>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" style="width: 200px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-plus fa-fw" aria-hidden="true"></i>Reports
              </button>
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
        </div>
    </div>
</div>
</div>

</div>
</div>

  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>