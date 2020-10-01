<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$pmid = $_POST['pmid'];
try {
	$deleteDiseaseFromHistory = "DELETE FROM patient_med_history WHERE patient_medication_id = :pmid AND patient_id = :pid AND clinic_id = :cid";
	$execDeleteDiseaseFromHistory = $conn->prepare($deleteDiseaseFromHistory);
	$execDeleteDiseaseFromHistory->bindValue(':pmid', $pmid);
	$execDeleteDiseaseFromHistory->bindValue(':pid', $pid);
	$execDeleteDiseaseFromHistory->bindValue(':cid', $cid);
	$execDeleteDiseaseFromHistory->execute();

	echo "deleted";

} catch (Exception $e) {
	echo $e->getMessage();
}

?>