<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$getRes = "SELECT t1.med_id, t1.med_pharmacy_id,
t3.med_name,
t1.med_expiry, 
t1.med_barcode, 
t1.med_tablet, 
t1.med_pill, 
t1.med_received,
sum(t2.given_quantity) as given_pills,
t1.med_tablet - ((ifnull(sum(t2.given_quantity),0)*t1.med_tablet)/t1.med_pill) as still_tablets,
(t1.med_pill-sum(t2.given_quantity)) as still_pills
FROM med_pharmacy t1
LEFT JOIN consultation_med t2 USING (med_pharmacy_id,clinic_id)
LEFT JOIN medication t3 USING (med_id,clinic_id)
WHERE t1.clinic_id=:cid GROUP BY t1.med_pharmacy_id, t1.med_expiry,t1.med_barcode,t1.med_tablet,t1.med_pill,t1.med_received";
$execGetRes = $conn->prepare($getRes);
$execGetRes->bindValue(':cid', $clinic_id);
$execGetRes->execute();

$fetchRes = $execGetRes->fetchAll();

?>