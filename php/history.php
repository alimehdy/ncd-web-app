<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$clinic_id=$_SESSION['clinic_id'];
$pid=$_POST['pid'];
$patient_medication = $_POST['patient_medication'];
$patient_side_effect = $_POST['patient_side_effect'];
$disease = $_POST['disease'];

try {
	$addHistory = "INSERT INTO patient_med_history(patient_medication, patient_side_effect, disease, patient_id, clinic_id)
		VALUES(:patient_medication, :patient_side_effect, :disease, :patient_id, :clinic_id)";
	$ExecAddHistory = $conn->prepare($addHistory);
	$ExecAddHistory->bindValue(':patient_medication', $patient_medication);
	$ExecAddHistory->bindValue(':patient_side_effect', $patient_side_effect);
	$ExecAddHistory->bindValue(':disease', $disease);
	$ExecAddHistory->bindValue(':patient_id', $pid);
	$ExecAddHistory->bindValue(':clinic_id', $clinic_id);
	$ExecAddHistory->execute();

	$lastId = $conn->lastInsertId();
	echo $lastId;
} 
catch (Exception $e) {
	echo $e->getMessage();
}
?>