<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getSmokingHist = "SELECT DISTINCT patient_smoker,  smoker_number_of_packets, date_of_edit from patient_edited
            WHERE clinic_id = :cid AND patient_id = :pid ORDER BY date_of_edit DESC LIMIT 5";
$execGetSmokingHist = $conn->prepare($getSmokingHist);
$execGetSmokingHist->bindValue(':cid', $cid);
$execGetSmokingHist->bindValue(':pid', $pid);
$execGetSmokingHist->execute();

$smokingRes = $execGetSmokingHist->fetchAll();

?>