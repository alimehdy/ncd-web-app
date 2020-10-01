<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$cid = $_SESSION['clinic_id'];

$getLabTest = "SELECT CONVERT(aes_decrypt(patient.patient_name_en, 'medair2017') USING utf8mb4) as 'pn', lab_test.patient_id, lab_test.lab_id, lab_test.lab_status, lab_test.test_date, patient.* FROM patient LEFT JOIN lab_test ON patient.patient_id = lab_test.patient_id WHERE lab_test.clinic_id = :cid AND lab_test.lab_status = :lab_status ORDER BY lab_test.test_date DESC";
$execGetLabTest = $conn->prepare($getLabTest);
$execGetLabTest->bindValue(':lab_status', "Active");
$execGetLabTest->bindValue(':cid', $cid);
$execGetLabTest->execute();
$getLabTestResult = $execGetLabTest->fetchAll();
?>