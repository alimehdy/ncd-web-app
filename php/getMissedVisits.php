<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$cid = $_SESSION['clinic_id'];
$encKey = 'medair2017';
$visitStatus = 'Active';
$patientStatusDeceased = 'Deceased';
$patientStatusDischarged = 'Discharged';
$getMissedVisits = "SELECT patient.patient_id,
    CONVERT(aes_decrypt(patient.patient_name_en, :encKey) USING utf8mb4) as patient_name_en,
    CONVERT(aes_decrypt(patient.patient_phone, :encKey) USING utf8mb4) as patient_phone,
    patient.patient_status,
    CONVERT(aes_decrypt(patient.patient_alt_name, :encKey) USING utf8mb4) as patient_alt_name,
    CONVERT(aes_decrypt(patient.patient_alt_contact_add, :encKey) USING utf8mb4) as patient_alt_contact_add,
    max(visit.date_of_visit) as date_of_visit,
    datediff(now(), max(visit.date_of_visit)) as days_missed,
    (SELECT 
    datediff(now(), max(visit.date_of_visit))) as dm
FROM 
    patient
LEFT JOIN 
    visit 
    ON 
	patient.patient_id = visit.patient_id
WHERE 
    visit.date_of_visit < date_sub(now(), interval 1 month)
    AND
    patient.clinic_id = :cid
    AND 
    visit.visit_status = :visitStatus
    AND
    (
        patient.patient_status <> :patientStatusDeceased
        AND
        patient.patient_status <> :patientStatusDischarged
	)
    GROUP BY visit.patient_id
	ORDER BY dm DESC
";

$res = $conn->prepare($getMissedVisits);
$res->bindValue(':encKey', $encKey);
$res->bindValue(':cid', $cid);
$res->bindValue(':visitStatus', $visitStatus);
$res->bindValue(':patientStatusDeceased', $patientStatusDeceased);
$res->bindValue(':patientStatusDischarged', $patientStatusDischarged);
$res->execute();

$count = $res->rowCount();
?>