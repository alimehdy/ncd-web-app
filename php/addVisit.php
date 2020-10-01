<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$dov = $_POST['dov'];
$rov = $_POST['rov'];

$consultation_name = $_POST['consultation_name'];
//doctor id
//nurse id
$patient_weight = $_POST['patient_weight'];
$patient_height = $_POST['patient_height'];
$patient_pressure = $_POST['patient_pressure'];

$visit_status = $_POST['visit_status'];
$addVisit = "INSERT INTO visit(date_of_visit, visit_reason, consultation_type,  
             patient_weight, patient_height, patient_pressure, visit_status, 
             patient_id, clinic_id)
             VALUES(:dov, :rov, :consultation_name, :patient_weight, :patient_height, :patient_pressure, :visit_status, :pid, :cid)";
$execAddVisit = $conn->prepare($addVisit);
$execAddVisit->bindValue(':dov', $dov);
$execAddVisit->bindValue(':rov', $rov);
$execAddVisit->bindValue(':consultation_name', $consultation_name);
$execAddVisit->bindValue(':patient_weight', $patient_weight);
$execAddVisit->bindValue(':patient_height', $patient_height);
$execAddVisit->bindValue(':patient_pressure', $patient_pressure);
$execAddVisit->bindValue(':visit_status', $visit_status);
$execAddVisit->bindValue(':pid', $pid);
$execAddVisit->bindValue(':cid', $cid);
$execAddVisit->execute();

$lastID = $conn->lastInsertId();

echo $lastID;

?>