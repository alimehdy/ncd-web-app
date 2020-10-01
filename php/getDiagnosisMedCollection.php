<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$txt = $_POST['txt'];

$getDiagnosis = "SELECT * FROM diagnosis WHERE diagnosis_name = :txt";
$execGetDiagnosis = $conn->prepare($getDiagnosis);
$execGetDiagnosis->bindValue(":txt", $txt);
$execGetDiagnosis->execute();
$getDiagnosisResult = $execGetDiagnosis->fetch();

echo $getDiagnosisResult['diagnosis_id'];
?>