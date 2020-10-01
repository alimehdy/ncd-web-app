<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
//header("Content-type:application/json");
$cid = $_SESSION['clinic_id'];

$searchTxt = '%'.$_REQUEST['term'].'%';
$res = array();
$getPatients = "SELECT * FROM patient WHERE clinic_id = :cid and patient_name_en LIKE :searchTxt OR dob LIKE :searchTxt OR patient_id LIKE :searchTxt OR patient_phone LIKE :searchTxt OR unhcr_registration_number LIKE :searchTxt ORDER BY patient_id DESC";

$execGetPatients = $conn->prepare($getPatients);
$execGetPatients->bindValue(':cid', $cid);
$execGetPatients->bindValue(':searchTxt', $searchTxt);
$execGetPatients->execute();
$getPatientsResult = $execGetPatients->fetchAll();

$i = 0;
foreach($getPatientsResult as $result)
{
	$res[$i] = $result;
	$i++;
}

echo json_encode($res);
?>