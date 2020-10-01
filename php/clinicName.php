<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');

$cid = $_SESSION['clinic_id'];


$getClinicName = "SELECT clinic_address FROM clinic WHERE clinic_id = :cid";

$execGetClinicName = $conn->prepare($getClinicName);
$execGetClinicName->bindValue(':cid', $cid);
$execGetClinicName->execute();
$res = $execGetClinicName->fetchColumn();

?>