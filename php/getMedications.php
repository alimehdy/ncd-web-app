<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];

$getMedications = "SELECT * FROM medication WHERE clinic_id=:cid ORDER BY med_name ASC";
$execGetMedications = $conn->prepare($getMedications);
$execGetMedications->bindValue(":cid", $cid);
$execGetMedications->execute();
$getExecGetMedications = $execGetMedications->fetchAll();
?>