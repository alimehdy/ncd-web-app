<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../php/connection.php');

$res = array();
$cid = $_SESSION['clinic_id'];
$searchTxt = '%'.$_POST['searchTxt'].'%';

$searchPatient = "SELECT patient_id, ymca_id,
convert(aes_decrypt(patient_name_en, 'medair2017') USING utf8mb4) as patient_name_en, 
convert(aes_decrypt(patient_name_ar, 'medair2017') USING utf8mb4) as patient_name_ar, 
dob, 
convert(aes_decrypt(patient_phone, 'medair2017') USING utf8mb4) as patient_phone, 
patient_status
FROM patient
WHERE clinic_id = :cid 
AND (patient_id LIKE :searchTxt OR ymca_id LIKE :searchTxt
OR aes_decrypt(patient_name_en, 'medair2017') LIKE :searchTxt 
OR dob LIKE :searchTxt 
OR aes_decrypt(patient_phone, 'medair2017') LIKE :searchTxt 
OR aes_decrypt(patient_name_ar, 'medair2017') LIKE :searchTxt)";
$execSearchPatient = $conn->prepare($searchPatient);
$execSearchPatient->bindValue(':cid', $cid);
$execSearchPatient->bindValue(':searchTxt', $searchTxt);
$execSearchPatient->execute();

//$execSearchPatientResult = $execSearchPatient->fetchAll();

$i = 0;
foreach($execSearchPatient as $result)
{
	$res[$i] = $result;
	$i++;
}

echo json_encode($res);

?>