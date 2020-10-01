<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');

$cid = $_SESSION['clinic_id'];

$getExpiredMed = "SELECT t1.med_id, 
    t1.med_pharmacy_id,
    t3.med_name,
    t1.med_expiry, 
    t1.med_barcode, 
    t1.med_tablet, 
    t1.med_pill, 
    t1.med_received,
    ifnull(sum(t2.given_quantity),0) as given_pills,
    t1.med_tablet - ((ifnull(sum(t2.given_quantity),0)*t1.med_tablet)/t1.med_pill) as still_tablets,
    ifnull((t1.med_pill-sum(t2.given_quantity)),t1.med_pill) as still_pills,
    datediff(t1.med_expiry, now()) as still_to_expire
FROM 
    med_pharmacy t1
LEFT JOIN 
    consultation_med t2 USING (med_pharmacy_id,clinic_id)
LEFT JOIN 
    medication t3 USING (med_id,clinic_id)
WHERE 
    t1.clinic_id=:cid
    AND
    t1.med_expiry <= date_add(now(), INTERVAL 3 MONTH)
GROUP BY 
    t1.med_pharmacy_id, 
    t1.med_expiry,
    t1.med_barcode,
    t1.med_tablet,
    t1.med_pill,
    t1.med_received";

$execGetExpiredMed = $conn->prepare($getExpiredMed);
$execGetExpiredMed->bindValue(':cid', $cid);
$execGetExpiredMed->execute();

$count=$execGetExpiredMed->rowCount();
?>