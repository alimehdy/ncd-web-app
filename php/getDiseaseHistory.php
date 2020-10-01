<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$pid = $_REQUEST['pid'];
$clinic_id = $_SESSION['clinic_id'];
$getDiseaseHistory = "SELECT * FROM patient_med_history WHERE patient_id = :pid AND clinic_id = :cid";
$execGetDiseaseHistory = $conn->prepare($getDiseaseHistory);
$execGetDiseaseHistory->bindValue(':pid', $pid);
$execGetDiseaseHistory->bindValue(':cid', $clinic_id);
$execGetDiseaseHistory->execute();
$getDiseaseHistoryResult = $execGetDiseaseHistory->fetchAll();
?>