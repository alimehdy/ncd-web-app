<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getDiagHist = "SELECT t2.diagnosis_name from consultation t1 JOIN diagnosis t2
            WHERE t1.clinic_id = :cid AND t1.patient_id = :pid AND t1.diagnosis_id = t2.diagnosis_id ORDER BY t1.consultation_id DESC";
$execGetDiagHist = $conn->prepare($getDiagHist);
$execGetDiagHist->bindValue(':cid', $cid);
$execGetDiagHist->bindValue(':pid', $pid);
$execGetDiagHist->execute();
$countDiag = $execGetDiagHist->rowCount();
$diagRes = $execGetDiagHist->fetchAll();

?>