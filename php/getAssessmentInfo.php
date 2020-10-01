<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];
$encKey = 'medair2017';

$getPatient = "SELECT da.diabetes_assessment_id, CONVERT(aes_decrypt(pt.patient_name_en, :encKey) USING utf8mb4) as patient_name_en,
da.date_of_assessment,
da.assessment_result 
FROM patient pt
LEFT JOIN diabetes_assessment da ON da.patient_id = pt.patient_id
WHERE pt.patient_id = :pid AND pt.clinic_id = :cid
GROUP BY diabetes_assessment_id, patient_name_en, date_of_assessment, assessment_result
ORDER BY da.date_of_assessment DESC";
$execGetPatientInfo = $conn->prepare($getPatient);
$execGetPatientInfo->bindValue(':encKey', $encKey);
$execGetPatientInfo->bindValue(':pid', $pid);
$execGetPatientInfo->bindValue(':cid', $cid);
$execGetPatientInfo->execute();

$res = $execGetPatientInfo->fetchAll();

?>