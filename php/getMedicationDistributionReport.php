<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
header('Content-type: application/json');
$cid = $_SESSION['clinic_id'];
$mid = $_POST['mid'];
$encKey = 'medair2017';
$res_distribution = array();

$getMedicationsDist = "SELECT 
    patient.patient_id as patient_id2,
    CONVERT(aes_decrypt(patient_name_en, :encKey) using utf8mb4) as patient_name_en2,
    visit.visit_id as visit_id,
    visit.date_of_visit as date_of_visit,
    medication.med_name as med_name,
    consultation_med.medication_collector as medication_collector,
    consultation_med.given_quantity as given_quantity,
    (SELECT 
        sum(consultation_med.given_quantity)
    FROM 
        med_pharmacy
    LEFT JOIN 
        medication
    ON
        med_pharmacy.med_id=medication.med_id
    LEFT JOIN 
        consultation_med
    ON 
    consultation_med.med_pharmacy_id=med_pharmacy.med_pharmacy_id
    LEFT JOIN
    consultation 
    ON 
    consultation.consultation_id=consultation_med.consultation_id
    LEFT JOIN
    visit
    ON
    visit.visit_id = consultation.visit_id
    LEFT JOIN 
    patient
    ON 
    patient.patient_id = visit.patient_id
    WHERE med_pharmacy.med_id=:mid) as sumGiven
FROM 
    med_pharmacy
LEFT JOIN 
    medication
ON 
    med_pharmacy.med_id=medication.med_id
LEFT JOIN 
    consultation_med
ON 
    consultation_med.med_pharmacy_id=med_pharmacy.med_pharmacy_id
LEFT JOIN
    consultation 
ON 
    consultation.consultation_id=consultation_med.consultation_id
LEFT JOIN
    visit
ON
    visit.visit_id = consultation.visit_id
LEFT JOIN 
    patient
ON 
    patient.patient_id = visit.patient_id
WHERE 
    med_pharmacy.med_id=:mid
    and
    med_pharmacy.clinic_id=:cid
    and
    visit.visit_status = :visitStatus

ORDER BY
    visit.date_of_visit DESC";
$execGetMedicationsDist = $conn->prepare($getMedicationsDist);
$execGetMedicationsDist->bindValue(":visitStatus", "Active");
$execGetMedicationsDist->bindValue(":encKey", $mid);
$execGetMedicationsDist->bindValue(":mid", $mid);
$execGetMedicationsDist->bindValue(":cid", $cid);
$execGetMedicationsDist->execute();
//$execGetMedicationsDist = $execGetMedicationsDist->fetchAll();
$i=0;
foreach($execGetMedicationsDist as $var2)
{
	$res_distribution[$i]=$var2;
	$i++;
}

echo json_encode($res_distribution);

?>