<?php
  include_once('../php/connection.php');
  include_once('../php/getLabTest.php');
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
              <a class="dropdown-item" href="patient_profile.php">Patient Profile</a>
              <a class="dropdown-item" href="edit.php">Edit Profile and/or History</a>
              <a class="dropdown-item" href="diabetes.php">Diabetes List</a>
              <a class="dropdown-item" href="assessment.php">Monthly Assessment Avg</a>
              <a class="dropdown-item active" href="labTest.php">Laboratory test Report</a>
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
  <div class="container">
  <div class="row justify-content-md-center">
   <div class="a col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-push-12 col-md-push-12">
     <div class="row">
     <div id="wait" style="display: none;"><img src="../images/loader.gif"></div>
     <table class="table table-hover table-responsive" id="patient_table">
       <tr class="bg-info" id="after_tr">
         <th>patient ID</th>
         <th>Name</th>
         <th>Date of Test</th>
         <th>Status</th>
         <th>Change Status</th>
         <th colspan="5" style="text-align:center">Actions</th>
       </tr>
       <?php foreach($getLabTestResult as $lab) { ?>
       <tr id="<?php echo $lab['lab_id']; ?>">
         <td><a href="patient_profile_page.php?pid=<?php echo $lab['patient_id']; ?>"><?php echo $lab['patient_id']; ?></a></td>
         <td><?php echo $lab['pn']; ?></td>
         <td><?php echo $lab['test_date']; ?></td>
         <td><?php echo $lab['lab_status']; ?></td>
         <td>
          <select style="color: #0090ff; " class="form-control select patient_status" name="lab_status">
            <option value="select">Select</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
         </td>
         <td colspan="2"><a href="lab_test_data.php?pid=<?php echo $lab['patient_id']; ?>"><span class="badge badge badge-info" style="background-color: #0090ff">Generate Report</span></a></td>
       </tr>  
       <?php } ?>
     </table>
     </div>
    </div>
  </div>
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
                  <th>Patient ID</th><td><input type="text" class="form-control" style="width: 200px" name="patient_id_lab" id="patient_id_lab" value="<?php echo $lab['lab_id'] ?>" disabled></td>
                </tr>
                <tr>
                  <th colspan="4" style="background-color: #0090ff">Diabetes type I or II (with or without hypertension)</th>
                  
                </tr>
                <tr>
                  <th>Glycemia</th><td colspan="3"><input type="text" class="form-control" name="glycemia" id="glycemia"></td>
                </tr>
                <tr>
                  <th>HbA1c</th><td colspan="3"><input type="text" class="form-control" name="hba" id="hba"></td>
                </tr>
                <tr>
                  <th>Creatinine</th><td colspan="3"><input type="text" class="form-control" name="creatinine" id="creatinine"></td>
                </tr>
                <tr>
                  <th>Urea</th><td colspan="3"><input type="text" class="form-control" name="urea" id="urea"></td>
                </tr>
                <tr>
                  <th>AST</th><td colspan="3"><input type="text" class="form-control" name="ast" id="ast"></td>
                </tr>
                <tr>
                  <th>ALT</th><td colspan="3"><input type="text" class="form-control" name="alt" id="alt"></td>
                </tr>
                <tr>
                  <th>Total Cholesterol</th><td colspan="3"><input type="text" class="form-control" name="total_cholesterol" id="total_cholesterol"></td>
                </tr>
                <tr>
                  <th>HDL Cholesterol</th><td colspan="3"><input type="text" class="form-control" name="hdl_cholesterol" id="hdl_cholesterol"></td>
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
  </div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/changeLabStatus.js"></script>
  <script src="../js/searchLab.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>