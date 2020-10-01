<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../php/connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];
$date_of_assessment = $_POST['date_of_assessment'];
$assessment_result = $_POST['assessment_result'];

$insertRes = "INSERT INTO diabetes_assessment(patient_id, date_of_assessment, 
             assessment_result, clinic_id)
             VALUES(:pid, :date_of_assessment, :assessment_result, :cid)";
$execInsertRes = $conn->prepare($insertRes);
$execInsertRes->bindValue(':pid', $pid);
$execInsertRes->bindValue(':date_of_assessment', $date_of_assessment);
$execInsertRes->bindValue(':assessment_result', $assessment_result);
$execInsertRes->bindValue(':cid', $cid);
$execInsertRes->execute();
$lastId = $conn->lastInsertId();
$getPatientCount = "SELECT pt.patient_name_en,
da.date_of_assessment,
da.assessment_result 
FROM patient pt
LEFT JOIN diabetes_assessment da ON da.patient_id = pt.patient_id
WHERE pt.patient_id = :pid AND pt.clinic_id = :cid
GROUP BY patient_name_en, date_of_assessment, assessment_result
ORDER BY da.date_of_assessment DESC";
$execGetPatientCount = $conn->prepare($getPatientCount);
$execGetPatientCount->bindValue(':pid', $pid);
$execGetPatientCount->bindValue(':cid', $cid);
$execGetPatientCount->execute();
$resCount = $execGetPatientCount->rowCount();
$arrayOfResult = array();
$arrayOfResult['resCount'] = $resCount;
$arrayOfResult['lastId'] = $lastId;
echo json_encode($arrayOfResult);
?>