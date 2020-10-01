<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getStatusHist = "SELECT * from status_history
            WHERE clinic_id = :cid AND patient_id = :pid ORDER BY status_date DESC";
$execGetStatusHist = $conn->prepare($getStatusHist);
$execGetStatusHist->bindValue(':cid', $cid);
$execGetStatusHist->bindValue(':pid', $pid);
$execGetStatusHist->execute();

$statRes = $execGetStatusHist->fetchAll();

?>