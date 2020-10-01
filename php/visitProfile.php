<?php
error_reporting(E_ALL);

require_once('../php/connection.php');

$cid = $_SESSION['clinic_id'];
$vid = $_REQUEST['pid'];
$status = "Active";

$getVisitProfile = "SELECT patient.patient_id,
patient.ymca_id,
aes_decrypt(patient.patient_name_en, 'medair2017') as pn,
patient.nationality,
visit.visit_id,
visit.date_of_visit,
visit.visit_reason,
visit.consultation_type,
visit.patient_weight,
visit.patient_height,
visit.patient_pressure,
visit.visit_status,
visit.clinic_id,
doctor_list.doctor_name,
nurse_list.nurse_name,
consultation.complication_name,
consultation.diagnosis_id,
diagnosis.diagnosis_name,
consultation.consultation_result,
medication.med_name,
consultation_med.given_quantity,
consultation_med.medication_collector
FROM visit
LEFT JOIN patient ON patient.patient_id = visit.patient_id
LEFT JOIN consultation ON visit.visit_id=consultation.visit_id 
LEFT JOIN nurse_list ON consultation.nurse_list_id = nurse_list.nurse_list_id
LEFT JOIN doctor_list ON consultation.doctor_list_id = doctor_list.doctor_list_id
LEFT JOIN consultation_med ON consultation_med.consultation_id = consultation.consultation_id
LEFT JOIN med_pharmacy ON med_pharmacy.med_pharmacy_id = consultation_med.med_pharmacy_id
LEFT JOIN medication ON medication.med_id=med_pharmacy.med_id
LEFT JOIN diagnosis ON diagnosis.diagnosis_id = consultation.diagnosis_id
WHERE visit.clinic_id=:cid AND visit.visit_id = :vid AND visit.visit_status=:status";

$execGetVisitProfile = $conn->prepare($getVisitProfile);
$execGetVisitProfile->bindValue(':cid', $cid);
$execGetVisitProfile->bindValue(':vid', $vid);
$execGetVisitProfile->bindValue(':status', $status);
$execGetVisitProfile->execute();

$res = $execGetVisitProfile->fetchAll();
//var_dump($res);
?>