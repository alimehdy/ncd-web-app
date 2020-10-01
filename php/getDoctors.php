<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../php/connection.php');
$cid = $_SESSION['clinic_id'];

$getDoctors = "SELECT * FROM doctor_list WHERE clinic_id = :cid ORDER BY doctor_name ASC";
$execGetDoctors = $conn->prepare($getDoctors);
$execGetDoctors->bindValue(':cid', $cid);
$execGetDoctors->execute();

$getDoctorsResult = $execGetDoctors->fetchAll();
?>