<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];

$med_id = $_POST['med_id'];
$new_quantity = $_POST['new_quantity'];

//update
$upd = "UPDATE med_pharmacy SET med_pill = :new_quantity WHERE med_pharmacy_id= :med_id
       and clinic_id = :cid LIMIT 1";
$execUpd = $conn->prepare($upd);
$execUpd->bindValue(":med_id", $med_id);
$execUpd->bindValue(":new_quantity", $new_quantity);
$execUpd->bindValue(":cid", $clinic_id);
$execUpd->execute();

echo "success";
?>