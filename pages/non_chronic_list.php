<?php
  include_once('../php/connection.php');
  include_once('../php/clinicName.php');
  $clinic_id = $_SESSION['clinic_id'];

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
        <li class="nav-item active">
          <div class="dropdown active">
            <a class="nav-link dropdown-toggle" href="report.php" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-file-text-o" aria-hidden="true"></i> Reports
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="chronic_list.php">Template 3 - Chronic diseases patients</a>
              <a class="dropdown-item" href="clinic_month_report.php">Template 5 - Clinic Monthly Report</a>
              <a class="dropdown-item" href="template_three.php">Template 6 - Chronic diseases patients</a>
              <a class="dropdown-item active" href="non_chronic_list.php">Template 7 - Non chronic diseases</a>
              <a class="dropdown-item" href="treatmentReport.php">Template 8 - Change treatment/Medication</a>
              <a class="dropdown-item" href="patient_status_list.php">Template 9 - Patients Discharged/Diceased</a>
              <a class="dropdown-item" href="monthlyReport.php">Monthly Report</a>
              <a class="dropdown-item" href="dailyReport.php">Daily Report</a>
            </div>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2 searchElement" type="month" id="searchTxt" name="searchTxt">
        <select class="form-control select" id="selectNat">
          <option value="select">Select</option>
          <option value="Syrian">Syrian</option>
          <option value="Lebanese">Lebanese</option>
        </select>
        <button type="button" class="btn btn-primary searchElement" id="searchBtn" name="searchBtn"><i class="fa fa-newspaper-o fa-fw" aria-hidden="true"></i> Generate Report</button>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="row">
    <div class="col-sm-10">
      <button type="button" id="print_this" name="print_this" class="btn btn-danger pull-right"><i class="fa fa-print"></i></button>
      
    </div>
  </div>
  <div class="container" id="print_div">
    <div class="row justify-content-md-center">
      <div class="a col-xs-12 col-sm-12 col-md-12 col-lg-8 col-lg-push-12 col-md-push-12">
       <div class="row">
        <table  dir="rtl" lang="ar" class="table table-bordered table-responsive table-hover table-striped" id="tempThreeTable"> 
          <tr>
            <th colspan="3" style="vertical-align: middle; text-align: center"><img id="img1" class="img-responsive" src="../images/ymca.png"></th>
            <th colspan="3" style="vertical-align: middle; text-align: center" id="th2"><img id="img2" class="img-responsive" src="../images/imc.gif"></th>
            <th colspan="3" style="vertical-align: middle; text-align: center"><img id="img3" class="img-responsive" src="../images/unhcr.png"></th>
          </tr>
          <tr>
            <th colspan="9" style="text-align: center; font-family: 'times-new-roman'"><u>لائحة عن المرضى غير المزمنين</u></th>
          </tr>
          <tr>
            <th style="text-align: right">نموذج رقم</th>
            <th style="text-align: right" colspan="4" id="tempNum">۷</th>
            <th style="text-align: right">الشهر</th>
            <th style="text-align: right" colspan="3" id="getMonthName"></th>
          </tr>
          <tr>
            <th style="text-align: right">اسم المستوصف</th>
            <th style="text-align: right; vertical-align: middle" colspan="8"><?php echo $clinic_id.' - '.$res ?></th>
          </tr>
          <tr id="after_tr">
            <th style="text-align: center; vertical-align: middle">الاسم الثلاثي</th>
            <th style="text-align: center; vertical-align: middle">الجنسية</th>
            <th style="text-align: center; vertical-align: middle" id="thCode">رقم بطاقة اللجوء</th>
            <th style="text-align: center; vertical-align: middle">الجنس</th>
            <th style="text-align: center; vertical-align: middle">تاريخ الولادة</th>
            <th style="text-align: center; vertical-align: middle">عنوان السكن الحالي</th>
            <th style="text-align: center; vertical-align: middle">اسم الدواء مع تحديد معياره</th>
            <th style="text-align: center; vertical-align: middle">الكمية بالشهر</th>
          </tr>
        </table>
       </div>
      </div>
    </div>
  </div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/getTemplateSevenData.js"></script>
  <script src="../js/print.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>