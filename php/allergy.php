<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$clinic_id=$_SESSION['clinic_id'];
$pid=$_POST['pid'];
$patient_allergy_med = $_POST['patient_allergy_med'];
$med_side_effect = $_POST['patient_side_effect_allergy'];
$comment = $_POST['comment'];

try {
	$addAllergy = "INSERT INTO patient_allergy(patient_allergy_med, med_side_effect, comment, patient_id, clinic_id)
		VALUES(:patient_allergy_med, :med_side_effect, :comment, :patient_id, :clinic_id)";
	$ExecAddAllergy = $conn->prepare($addAllergy);
	$ExecAddAllergy->bindValue(':patient_allergy_med', $patient_allergy_med);
	$ExecAddAllergy->bindValue(':med_side_effect', $med_side_effect);
	$ExecAddAllergy->bindValue(':comment', $comment);
	$ExecAddAllergy->bindValue(':patient_id', $pid);
	$ExecAddAllergy->bindValue(':clinic_id', $clinic_id);
	$ExecAddAllergy->execute();

	$lastId = $conn->lastInsertId();
	echo $lastId;
} 
catch (Exception $e) {
	echo $e->getMessage();
}
?>