<?php
  include_once('../php/connection.php');
  include_once('../php/visitProfile.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>NCD Web Application</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="icon" href="../images/Medair_Logo_2013.png">
  <link rel="stylesheet" href="../css/vert_tabs.css">
  <link rel="stylesheet" href="../css/form-elements.css">
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
    <div class="row" id="wait">
      <div class="col-sm-12">
      <div class="col-sm-6 pull-left">
      <a class="navbar-brand pull-left" href="#"><img src="../images/medair_icon.png""></a>
      </div>
      <div class="col-sm-6 pull-right">
      <button type="button" class="btn btn-danger pull-right" id="print_this"><i class="fa fa-print"></i></button>
      </div></div>
        <table class="table table-responsive table-hover table-bordered">
          <tr>
            <th colspan="12" class="bg-info" style="text-align: center">Visit Information</th>
          </tr>
          <tr>
            <th colspan="12" class="bg-info">A. General Information</th>
          </tr>
          <tr>
            <th colspan="1">Visit Status</th><td colspan="3"><?php if($res[0]['visit_status']!=NULL){ echo $res[0]['visit_status']; } else {echo "No Visit";} ?></td>
            <th colspan="1">YMCA ID</th><td><?php echo $res[0]['ymca_id'] ?></td>
            <th colspan="1">Consultation Type</th><td colspan="5"><?php echo $res[0]['consultation_type'] ?></td>
          </tr>
          <tr>
            <th >Patient ID</th><td><?php echo $res[0]['patient_id'] ?></td><th >Patient Name</th><td><?php echo $res[0]['pn'] ?></td><th >Nationality</th><td><?php echo $res[0]['nationality'] ?></td><th ">Date Of Visit</th><?php echo $res[0]['date_of_visit'] ?></td>
          </tr>
          <tr>
            <th >Weight (kg)</th><td><?php echo $res[0]['patient_weight'] ?></td>
            <th>Height (Cm)</th><td><?php echo $res[0]['patient_height'] ?></td>
            
            <th >BMI</th><td><?php if($res[0]['patient_height']!=0 && $res[0]['patient_height']!=0){ $resBmi = $res[0]['patient_weight']/pow($res[0]['patient_height']/100, 2); echo number_format($resBmi, 3, '.', ' ');} else { echo "0";} ?></td>
            <th>BMI Result</th><td><?php if($res[0]['patient_weight']==0 || $res[0]['patient_height']==0)
              {
                echo "N/A";
              }  else{  if($res[0]['patient_weight']==0) { echo "N/A"; } if($resBmi ==0){echo "N/A";} if($resBmi>0 && $resBmi<18.5){echo $resCal="Underweight";}  if($resBmi>=18.5 && $resBmi<25){echo $resCal="Normal Weight";} if($resBmi>=25 && $resBmi<=29.9){echo $resCal = "Overweight";} if($resBmi>=30){echo $resCal = "Obese";} } ?></td>
          </tr>
          <tr>
            <th>Blood Pressure</th><td colspan="7"><?php echo $res[0]['patient_pressure'] ?></td>
          </tr>
          <tr>
            <th colspan="12" class="bg-info">B. Symptoms</th>
          </tr>
          <tr>
            <td colspan="12"><?php echo $res[0]['visit_reason'] ?></td>
          </tr>
          <tr>
            <th colspan="12" class="bg-info">C. Examination</th>
          </tr>
          <?php $count=0; foreach($res as $result) { ?>
          <tr>
            <th rowspan="4" class="bg-info" style="vertical-align: middle; align-content: center;"><?php echo ++$count ?></th>
            <th>Doctor</th><td colspan="2"><?php echo $result['doctor_name'] ?></td>
            <th>Nurse</th><td colspan="1"><?php echo $result['nurse_name'] ?></td>
            <th>Medication Collector</th><td colspan="1"><?php echo $result['medication_collector'] ?></td>
          </tr>
          <tr>
            <th colspan="2">Complications</th><td colspan="5"><?php echo $result['complication_name'] ?></td>
          </tr>
          <tr>
            <th colspan="2">Diagnosis</th>
            <th>Medication</th>
            <th>Qty(Pills)</th>
            <th colspan="3">Results</th>
          </tr>
          <tr>
            <td colspan="2"><?php echo $result['diagnosis_name'] ?></td>
            <td><?php echo $result['med_name'] ?></td>
            <td><?php echo $result['given_quantity'] ?></td>
            <td colspan="3"><?php echo $result['consultation_result'] ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/printMissedVisits.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>