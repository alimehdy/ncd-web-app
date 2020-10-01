<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$encKey = "medair2017";

$getId = "SELECT convert(aes_decrypt(patient_name_en, :encKey) using utf8mb4) as patient_name, patient.* FROM patient WHERE clinic_id=:cid";
$execGetID = $conn->prepare($getId);
$execGetID->bindValue(":cid", $clinic_id);
$execGetID->bindValue(":encKey", $encKey);
$execGetID->execute();
$id = $execGetID->fetchAll();

?>