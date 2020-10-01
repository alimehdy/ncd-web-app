<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getFamilyHist = "SELECT DISTINCT diagnosis from patient_family_history
            WHERE clinic_id = :cid AND patient_id = :pid";
$execGetFamilyHist = $conn->prepare($getFamilyHist);
$execGetFamilyHist->bindValue(':cid', $cid);
$execGetFamilyHist->bindValue(':pid', $pid);
$execGetFamilyHist->execute();

$familyRes = $execGetFamilyHist->fetch();

?>