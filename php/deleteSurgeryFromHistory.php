<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$psid = $_POST['psid'];
try {
	$deleteSurgeryFromHistory = "DELETE FROM surgical_info WHERE surgical_info_id = :psid AND patient_id = :pid AND clinic_id = :cid";
	$execDeleteSurgeryFromHistory = $conn->prepare($deleteSurgeryFromHistory);
	$execDeleteSurgeryFromHistory->bindValue(':psid', $psid);
	$execDeleteSurgeryFromHistory->bindValue(':pid', $pid);
	$execDeleteSurgeryFromHistory->bindValue(':cid', $cid);
	$execDeleteSurgeryFromHistory->execute();

	echo "deleted";

} catch (Exception $e) {
	echo $e->getMessage();
}

?>