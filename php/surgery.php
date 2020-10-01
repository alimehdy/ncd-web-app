<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$clinic_id=$_SESSION['clinic_id'];
$pid=$_POST['pid'];
$patient_surgery = $_POST['patient_surgery'];
$surgery_date = $_POST['surgery_date'];
$surgery_comment = $_POST['surgery_comment'];

try {
	$addSurgery = "INSERT INTO surgical_info(patient_surgery, comment, surgery_date, patient_id, clinic_id)
		VALUES(:patient_surgery, :surgery_comment, :surgery_date, :patient_id, :clinic_id)";
	$ExecAddSurgery = $conn->prepare($addSurgery);
	$ExecAddSurgery->bindValue(':patient_surgery', $patient_surgery);
	$ExecAddSurgery->bindValue(':surgery_comment', $surgery_comment);
	$ExecAddSurgery->bindValue(':surgery_date', $surgery_date);
	$ExecAddSurgery->bindValue(':patient_id', $pid);
	$ExecAddSurgery->bindValue(':clinic_id', $clinic_id);
	$ExecAddSurgery->execute();

	$lastId = $conn->lastInsertId();
	echo $lastId;
} 
catch (Exception $e) {
	echo $e->getMessage();
}
?>