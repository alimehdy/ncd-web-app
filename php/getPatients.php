<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$cid = $_SESSION['clinic_id'];

$getPatients = "SELECT CONVERT(aes_decrypt(patient_name_en, 'medair2017') USING utf8mb4) as 'pn', aes_decrypt(patient_name_ar, 'medair2017') as 'pna',aes_decrypt(patient_mother_name, 'medair2017') as 'pmn', aes_decrypt(patient_phone, 'medair2017') as 'pphone',  patient.* FROM patient WHERE clinic_id = :cid ORDER BY patient_id DESC";
$execGetPatients = $conn->prepare($getPatients);
$execGetPatients->bindValue(':cid', $cid);
$execGetPatients->execute();
$getPatientsResult = $execGetPatients->fetchAll();
?>