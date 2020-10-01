<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$cid = $_SESSION['clinic_id'];

$getVisits = "SELECT t1.visit_id, t1.date_of_visit, t1.visit_status, 
              t2.patient_id, t2.ymca_id, aes_decrypt(t2.patient_name_en, 'medair2017') as pn 
              FROM visit t1 JOIN patient t2 
              WHERE t1.patient_id = t2.patient_id AND t1.clinic_id = :cid 
              ORDER BY t1.date_of_visit DESC;";
$execGetVisits = $conn->prepare($getVisits);
$execGetVisits->bindValue(':cid', $cid);
$execGetVisits->execute();
$getVisitsResult = $execGetVisits->fetchAll();
?>