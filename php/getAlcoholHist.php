<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];

$getAlcoholHist = "SELECT DISTINCT alcohol, date_of_edit from patient_edited
            WHERE clinic_id = :cid AND patient_id = :pid ORDER BY date_of_edit DESC";
$execGetAlcoholHist = $conn->prepare($getAlcoholHist);
$execGetAlcoholHist->bindValue(':cid', $cid);
$execGetAlcoholHist->bindValue(':pid', $pid);
$execGetAlcoholHist->execute();

$alcoholRes = $execGetAlcoholHist->fetchAll();

?>