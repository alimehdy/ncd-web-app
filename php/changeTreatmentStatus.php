<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$id = $_POST['id'];
$new_status = $_POST['newStatus'];

$update = "UPDATE treatment SET treatment_status = :new_status
          WHERE treatment_id = :id AND clinic_id = :cid";
$exec = $conn->prepare($update);
$exec->bindValue(':new_status', $new_status);
$exec->bindValue(':id', $id);
$exec->bindValue(':cid', $cid);
$exec->execute();

echo $new_status;
?>