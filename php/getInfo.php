<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getInfo = "SELECT ymca_id, aes_decrypt(patient_name_en, 'medair2017') as 'pn', aes_decrypt(patient_name_ar, 'medair2017') as 'pna',aes_decrypt(patient_mother_name, 'medair2017') as 'pmn', aes_decrypt(patient_phone, 'medair2017') as 'pphone', patient.* from patient 
            WHERE clinic_id = :cid AND patient_id = :pid";
$execGetInfo = $conn->prepare($getInfo);
$execGetInfo->bindValue(':cid', $cid);
$execGetInfo->bindValue(':pid', $pid);
$execGetInfo->execute();

$getInfoResult = $execGetInfo->fetch();

?>