<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$pid = $_REQUEST['pid'];
$clinic_id = $_SESSION['clinic_id'];
$getAllergyHistory = "SELECT * FROM patient_allergy WHERE patient_id = :pid AND clinic_id = :cid";
$execGetAllergyHistory = $conn->prepare($getAllergyHistory);
$execGetAllergyHistory->bindValue(':pid', $pid);
$execGetAllergyHistory->bindValue(':cid', $clinic_id);
$execGetAllergyHistory->execute();
$countAllergy = $execGetAllergyHistory->rowCount();
$getAllergyHistoryResult = $execGetAllergyHistory->fetchAll();
?>