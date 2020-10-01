<?php
  include_once('../php/connection.php');
  include_once('../php/getInfo.php');
  include_once('../php/getStatusHist.php');
  include_once('../php/getSmokingHist.php');
  include_once('../php/getAlcoholHist.php');
  include_once('../php/getFamilyHist.php');
  include_once('../php/getVisitHist.php');
  include_once('../php/getDiagHist.php');
  include_once('../php/getMedHist.php');
  include_once('../php/getAllergyHistory.php');
  include_once('../php/getSurgeryHistory.php');
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
            <a class="nav-link active dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Patients
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="patient.php">New Patient</a>
              <a class="dropdown-item active" href="patient_profile.php">Patient Profile</a>
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
  <div class="container"></div>
  <div class="container" id="print_div"><button id="print_this" name="print_this" class="btn btn-danger pull-right"><i class="fa fa-print"></i></button><button id="pdf_this" name="print_this" class="btn btn-danger pull-right" style="margin-right: 5px"><i class="fa fa-download"></i></button><a class="navbar-brand" href="#"><img src="../images/medair_icon.png""></a>
  <div class="row justify-content-md-center">
    <div class="col-sm-11">
      <div class="row">
        <table class="table table-bordered table-hover table-responsive">
        <tr class="bg-info">
          <th colspan="6">A. General Information</th>
        </tr>
          <tr>
            <th>Clinic ID: <?php echo $_SESSION['clinic_id'] ?></th>
            <th>YMCA ID: </th>
            <td><?php echo $getInfoResult['ymca_id'] ?></td>
            <th>Patient ID: </th>
            <td><?php echo $_REQUEST['pid'] ?></td>
          </tr>
          <tr>
            <th>Patient Name: </th>
            <td colspan="2" style="width: 100%"><?php echo $getInfoResult['pn'] ?></td>
            <th>Current Status: </th>
            <td><?php echo $getInfoResult['patient_status'] ?></td>
          </tr>
          <tr>
            <th>D.O.B: </th>
            <td colspan="2"><?php echo $getInfoResult['dob'] ?></td>
            <th>Date Of Registration: </th>
            <td><?php echo $getInfoResult['registration_date'] ?></td>
          </tr>
          <tr>
            <th>Gender: </th>
            <td colspan="2"><?php echo $getInfoResult['gender'] ?></td>
            <th>Phone Number: </th>
            <td><?php echo $getInfoResult['pphone'] ?></td>
          </tr>
          <tr>
            <th class="bg-info" colspan="6">B. Status Changed History: </th>
          </tr>
          <tr>
            <th colspan="2">Status</th>
            <th colspan="3">Date Of Change</th>
          </tr>
          <?php foreach($statRes as $res) { ?>
          <tr>
            <td colspan="2"><?php echo $res['patient_status'] ?></td>
            <td colspan="3"><?php echo $res['status_date'] ?></td>
          </tr>
          <?php } ?>
          <tr>
            <th class="bg-info" colspan="6">C. Smoking History: </th>
          </tr>
          <tr>
            <th colspan="2">Answer</th>
            <th colspan="2">Nbr of Cigarettes/day</th>
            <th colspan="2">Date Of Answer</th>
          </tr>
          <?php foreach($smokingRes as $res2) { ?>
            <tr>
              <td colspan="2"><?php echo $res2['patient_smoker'] ?></td>
              <td colspan="2"><?php echo $res2['smoker_number_of_packets'] ?></td>
              <td colspan="2"><?php echo $res2['date_of_edit'] ?></td>
            </tr>
          <?php } ?>
          <tr>
            <th class="bg-info" colspan="6">D. Alcohol History: </th>
          </tr>
          <tr>
            <th colspan="3">Answer</th>
            <th colspan="3">Date Of Answer</th>
          </tr>
          <?php foreach($alcoholRes as $res3) { ?>
          <tr>
            <td colspan="3"><?php echo $res3['alcohol'] ?></td>
            <td colspan="3"><?php echo $res3['date_of_edit'] ?></td>
          </tr>
          <?php } ?>
          <tr>
            <th class="bg-info" colspan="6">E. Family Diseases History: </th>
          </tr>
          <tr>
            <td colspan="6"><?php echo $familyRes['diagnosis'] ?></td>
          </tr>
          <tr class="bg-info" >
            <th colspan="6" >F. Visits Information (Total of <?php echo $count ?>)</th>
          </tr>
          <?php if($count>0) { ?>
            <tr>
              <th>Number</th>
              <th>Date of the visit</th>
              <th>Weight (Kg)</th>
              <th>BMI</th>
              <th>BMI Result</th>
            </tr>
          <?php } foreach($visitRes as $res4) { ?>
            <tr>
              <td><a href="visit_profile_page.php?pid=<?php echo $res4['patient_id'] ?>&vid=<?php echo $res4['visit_id'] ?>" ><?php echo $count-- ?></a></td>
              <td><?php echo $res4['date_of_visit'] ?></td>
              <td><?php if($res4['patient_weight']==0){ echo "N/A";} else { echo $res4['patient_weight']; } ?></td>
              <td><?php if($res4['patient_weight']==0){ echo "N/A"; $resBmi =0; } else { $heightM = pow(($res4['patient_height']/100), 2); $bmi = ($res4['patient_weight']/$heightM); echo $resBmi = number_format($bmi, 3, '.', ' '); } ?></td>
              <td><?php if($res4['patient_weight']==0) { echo "N/A"; } if($resBmi ==0){echo "";} if($resBmi>0 && $resBmi<18.5){echo $resCal="Underweight";}  if($resBmi>=18.5 && $resBmi<25){echo $resCal="Normal Weight";} if($resBmi>=25 && $resBmi<=29.9){echo $resCal = "Overweight";} if($resBmi>=30){echo $resCal = "Obese";}  ?></td>
            </tr>
          <?php } ?>
          <tr class="bg-info">
            <th colspan="6">G. Previously Identified Diseases by NCD (Total of <?php echo $countDiag ?>)</th>
          </tr>
          <tr>
          <?php foreach($diagRes as $res5) { ?>
            <tr>
              <td colspan="2"><?php echo $countDiag-- ?></td>
              <td colspan="4"><?php echo $res5['diagnosis_name'] ?></td>
            </tr>
          <?php } ?>
          </tr>
          <tr class="bg-info">
            <th colspan="6">H. Patient Previous Medication (Total of <?php echo $countMed ?>)</th>
          </tr>
          <?php if($countMed!=0){ ?>
          <tr>
            <th colspan="3">Disease</th>
            <th>Medication</th>
            <th colspan="2">Side Effect</th>  
          </tr>
          <?php } ?>
          <?php foreach($medRes as $res6) { ?>
            <td colspan="3"><?php echo $res6['disease'] ?></td>
            <td><?php echo $res6['patient_medication'] ?></td>
            <td colspan="2"><?php echo $res6['patient_side_effect'] ?></td>
          <?php } ?>
          <tr class="bg-info">
            <th colspan="6">I. Allergies On Medications (Total of <?php echo $countAllergy ?>)</th>
          </tr>
          <?php if($countAllergy!=0){ ?>
          <tr>
            <th colspan="2">Medication</th>
            <th colspan="2">Side Effect</th>
            <th colspan="2">Extra Information</th>
          </tr>
          <?php } foreach($getAllergyHistoryResult as $res7) { ?>
          <tr>
            <td colspan="2"><?php echo $res7['patient_allergy_med'] ?></td>
            <td colspan="2"><?php echo $res7['med_side_effect'] ?></td>
            <td colspan="2"><?php echo $res7['comment'] ?></td>
          </tr>
          <?php } ?>
          <tr class="bg-info">
            <th colspan="6">J. Surgical History (Total of <?php echo $countSurgery ?>)</th>
          </tr>
          <?php if($countSurgery!=0){ ?>
          <tr>
            <th colspan="2">Surgery</th>
            <th colspan="2">Date</th>
            <th colspan="2">Extra Information</th>
          </tr>
          <?php } foreach($getSurgeryHistoryResult as $res8) { ?>
          <tr>
            <td colspan="2"><?php echo $res8['patient_surgery'] ?></td>
            <td colspan="2"><?php echo $res8['surgery_date'] ?></td>
            <td colspan="2"><?php echo $res8['comment'] ?></td>
          </tr>
          <?php } ?>
        </table>
      </div>
    <!-- End of class col-sm-6 -->
    </div>
    <div class="col-sm-6" >
      <div class="row">
        <table class="table table-bordered table-hover table-responsive">
          
        </table>
      </div>
    </div>
  </div>
  </div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jspdf.min.js"></script>
  <script src="../js/print.js"></script>
<script src="../js/toPdf.js"></script>
<script src="../js/barcodeReader.js"></script>
</body>
</html>