<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$pid = $_REQUEST['pid'];
$cid = $_SESSION['clinic_id'];
$encKey = 'medair2017';
try {
	$getPatientInfo = "SELECT 
	CONVERT(aes_decrypt(patient_name_en, :encKey) USING utf8mb4) as patient_name_en_decrypt,
	CONVERT(aes_decrypt(patient_name_ar, :encKey) USING utf8mb4) as patient_name_ar_decrypt,
	CONVERT(aes_decrypt(patient_mother_name, :encKey) USING utf8mb4) as patient_mother_name_decrypt,
	CONVERT(aes_decrypt(patient_phone, :encKey) USING utf8mb4) as patient_phone_decrypt,
	CONVERT(aes_decrypt(unhcr_registration_number, :encKey) USING utf8mb4) as unhcr_registration_number_decrypt,
	patient.* FROM patient WHERE patient_id = :pid AND clinic_id = :cid";
	$execGetPatientInfo = $conn->prepare($getPatientInfo);
	$execGetPatientInfo->bindValue(':encKey', $encKey);
	$execGetPatientInfo->bindValue(':pid', $pid);
	$execGetPatientInfo->bindValue(':cid', $cid);
	$execGetPatientInfo->execute();

	$result = $execGetPatientInfo->fetch();

	$getDiagnosisInfo = "SELECT * FROM patient_family_history WHERE patient_id = :pid AND clinic_id = :cid";
	$execGetDiagnosisInfo = $conn->prepare($getDiagnosisInfo);
	$execGetDiagnosisInfo->bindValue(':pid', $pid);
	$execGetDiagnosisInfo->bindValue(':cid', $cid);
	$execGetDiagnosisInfo->execute();

	$medHistory = $execGetDiagnosisInfo->fetch();
} catch (Exception $e) {
	echo $e->getMessage();
}
?>