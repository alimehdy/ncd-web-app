<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getMedHist = "SELECT * FROM patient_med_history
            WHERE clinic_id = :cid AND patient_id = :pid  ORDER BY patient_medication_id DESC";
$execGetMedHist = $conn->prepare($getMedHist);
$execGetMedHist->bindValue(':cid', $cid);
$execGetMedHist->bindValue(':pid', $pid);
$execGetMedHist->execute();
$countMed = $execGetMedHist->rowCount();
$medRes = $execGetMedHist->fetchAll();

?>