<?php
  include_once('../php/connection.php');
  include_once('../php/addMed.php');
  include_once('../php/getMedStat.php');
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
              <a class="dropdown-item active" href="new_med.php">Medications List</a>
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
        <button type="button" class="btn btn-primary searchElement" id="searchBtn" name="searchBtn"><i class="fa fa-search fa-medkit" aria-hidden="true"></i> Search</button>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="row">
    <div class="col-sm-11">
      <button type="button" id="print_this" name="print_this" class="btn btn-danger pull-right"><i class="fa fa-print"></i></button>
    </div>
  </div>
  <div class="container" id="print_div">
    <div class="row justify-content-md-center">
      <div class="a col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-push-12 col-md-push-12">
        <div class="row">
          <table class="table table-bordered table-responsive table-hover" id="med_table">
            <tr class="bg-info"><th colspan="10" style="text-align: center">Pharmacy Available Stock</th></tr>
            <tr class="bg-info" id="after_tr">
              <th>Med ID</th>
              <th>Med Name</th>
              <th>Med Expiry</th>
              <th>Barcode</th>
              <th>received</th>
              <th>Pills received</th>
              <th>Date Received</th>
              <th>Pills distributed</th>
              <!--<th>Remaining (in tablets)</th>-->
              <th>Remaining (in pills)</th>
            </tr>
            <?php foreach($fetchRes as $res) { ?>
            <tr id="<?php echo $res['med_id'] ?>">
              <td><?php echo $res['med_id'] ?></td>
              <td><?php echo $res['med_name'] ?></td>
              <td><?php echo $res['med_expiry'] ?></td>
              <td><?php echo $res['med_barcode'] ?></td>
              <td><?php echo $res['med_tablet'] ?></td>
              <td><?php echo $res['med_pill'] ?></td>
              <td><?php echo $res['med_received'] ?></td>
              <td><?php if($res['given_pills']==""){ echo "0"; } else { echo $res['given_pills']; } ?></td>
              <!--<td><?php echo floor($res['still_tablets'])?> (Exact:<?php echo number_format($res['still_tablets'], 2) ?>)</td>-->
              <td><?php if($res['still_pills']=="") { echo $res['med_pill']; } else {  echo $res['still_pills']; } ?></td>
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
  <script src="../js/searchMed.js"></script>
  <script src="../js/print.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>