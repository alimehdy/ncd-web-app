<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];

$medication_id = $_POST['medication_id'];
$expiry_date = $_POST['expiry_date'];
$barcode = $_POST['barcode'];
$medication_quantity = $_POST['medication_quantity'];
$medication_pill = $_POST['medication_pill'];
$total_pills = $medication_quantity*$medication_pill;
$addMed = "INSERT INTO med_pharmacy(med_id, med_barcode, med_received, med_expiry,
           med_tablet, med_pill, clinic_id)
           VALUES(:med_id, :med_barcode, :med_received, :med_expiry, :med_tablet, :med_pill, :clinic_id)";
$execAddMed = $conn->prepare($addMed);
$execAddMed->bindValue(':med_id', $medication_id);
$execAddMed->bindValue(':med_barcode', $barcode);
$execAddMed->bindValue(':med_received', date('Y-m-d H:i:s'));
$execAddMed->bindValue(':med_expiry', $expiry_date);
$execAddMed->bindValue(':med_tablet', $medication_quantity);
$execAddMed->bindValue(':med_pill', $total_pills);
$execAddMed->bindValue(':clinic_id', $clinic_id);
$execAddMed->execute();

?>