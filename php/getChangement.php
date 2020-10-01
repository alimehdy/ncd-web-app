<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$encKey = "medair2017";

$getData = "SELECT CONVERT(aes_decrypt(patient_name_en, :encKey) using utf8mb4) as patient_name_en, treatment.* FROM treatment LEFT JOIN patient
ON patient.patient_id = treatment.patient_id WHERE treatment.clinic_id = :cid ORDER BY treatment.dateAdded DESC";
$execData = $conn->prepare($getData);
$execData->bindValue(":cid", $clinic_id);
$execData->bindValue(":encKey", $encKey);
$execData->execute();
$result = $execData->fetchAll();

?>