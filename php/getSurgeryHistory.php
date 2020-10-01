<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$pid = $_REQUEST['pid'];
$clinic_id = $_SESSION['clinic_id'];
$getSurgeryHistory = "SELECT * FROM surgical_info WHERE patient_id = :pid AND clinic_id = :cid";
$execGetSurgeryHistory = $conn->prepare($getSurgeryHistory);
$execGetSurgeryHistory->bindValue(':pid', $pid);
$execGetSurgeryHistory->bindValue(':cid', $clinic_id);
$execGetSurgeryHistory->execute();
$countSurgery = $execGetSurgeryHistory->rowCount();
$getSurgeryHistoryResult = $execGetSurgeryHistory->fetchAll();
?>