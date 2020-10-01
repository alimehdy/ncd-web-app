<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getVisitHist = "SELECT * from visit
            WHERE clinic_id = :cid AND patient_id = :pid ORDER BY date_of_visit DESC";
$execGetVisitHist = $conn->prepare($getVisitHist);
$execGetVisitHist->bindValue(':cid', $cid);
$execGetVisitHist->bindValue(':pid', $pid);
$execGetVisitHist->execute();
$count = $execGetVisitHist->rowCount();
$visitRes = $execGetVisitHist->fetchAll();

?>