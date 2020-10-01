<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');

$getDiagnosis = "SELECT * FROM diagnosis ORDER BY diagnosis_name ASC";
$execGetDiagnosis = $conn->prepare($getDiagnosis);
$execGetDiagnosis->execute();
$getDiagnosisResult = $execGetDiagnosis->fetchAll();
?>