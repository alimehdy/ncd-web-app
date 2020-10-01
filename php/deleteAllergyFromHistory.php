<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$paid = $_POST['paid'];
try {
	$deleteAllergyFromHistory = "DELETE FROM patient_allergy WHERE patient_allergy_id = :paid AND patient_id = :pid AND clinic_id = :cid";
	$execDeleteAllergyFromHistory = $conn->prepare($deleteAllergyFromHistory);
	$execDeleteAllergyFromHistory->bindValue(':paid', $paid);
	$execDeleteAllergyFromHistory->bindValue(':pid', $pid);
	$execDeleteAllergyFromHistory->bindValue(':cid', $cid);
	$execDeleteAllergyFromHistory->execute();

	echo "deleted";

} catch (Exception $e) {
	echo $e->getMessage();
}

?>