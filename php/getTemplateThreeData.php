<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$medType = 'chronic';
$getDate = $_POST['monthVal'];
$encKey = 'medair2017';
$nationality = $_POST['nationality'];
$getTempThree = "SELECT
	patient.patient_id,
	CONVERT(aes_decrypt(patient.patient_name_en, :encKey)USING utf8mb4) as patient_name_en,
    patient.nationality,
    CONVERT(aes_decrypt(patient.unhcr_registration_number, :encKey) USING utf8mb4) as unhcr_registration_number,
    patient.gender,
    patient.dob,
    patient.patient_address,
    medication.med_name,
    sum(consultation_med.given_quantity) as given_quantity
FROM
	patient
LEFT JOIN
	visit
ON
	patient.patient_id = visit.patient_id
LEFT JOIN
	consultation
ON
	consultation.visit_id = visit.visit_id
LEFT JOIN
	consultation_med
ON
	consultation_med.consultation_id = consultation.consultation_id
LEFT JOIN
	med_pharmacy
ON
	med_pharmacy.med_pharmacy_id = consultation_med.med_pharmacy_id
LEFT JOIN
	medication
ON
	medication.med_id = med_pharmacy.med_id
WHERE
	consultation_med.clinic_id = :cid
AND
	patient.nationality = :nationality
AND
	DATE_FORMAT(visit.date_of_visit, '%Y-%m') = :getDate
AND
	medication.med_type = :medType
GROUP BY 
	patient.patient_id, 
	medication.med_name
ORDER BY
	patient_name_en DESC
";
// $getTempThree = "SELECT
// 	patient.patient_id,
// 	CONVERT(aes_decrypt(patient.patient_name_en, :encKey)USING utf8mb4) as patient_name_en,
//     patient.nationality,
//     CONVERT(aes_decrypt(patient.unhcr_registration_number, :encKey) USING utf8mb4) as unhcr_registration_number,
//     patient.gender,
//     patient.dob,
//     patient.patient_address,
//     medication.med_name,
//     consultation_med.given_quantity
// FROM
// 	patient
// LEFT JOIN
// 	visit
// ON
// 	patient.patient_id = visit.patient_id
// LEFT JOIN
// 	consultation
// ON
// 	consultation.visit_id = visit.visit_id
// LEFT JOIN
// 	consultation_med
// ON
// 	consultation_med.consultation_id = consultation.consultation_id
// LEFT JOIN
// 	med_pharmacy
// ON
// 	med_pharmacy.med_pharmacy_id = consultation_med.med_pharmacy_id
// LEFT JOIN
// 	medication
// ON
// 	medication.med_id = med_pharmacy.med_id
// WHERE
// 	consultation_med.clinic_id = :cid
// AND
// 	patient.nationality = :nationality
// AND
// 	DATE_FORMAT(visit.date_of_visit, '%Y-%m') = :getDate
// AND
// 	medication.med_type = :medType
// ORDER BY
// 	patient_name_en DESC
// ";

$execGetTempThree = $conn->prepare($getTempThree);
$execGetTempThree->bindValue(':encKey', $encKey);
$execGetTempThree->bindValue(':cid', $cid);
$execGetTempThree->bindValue(':nationality', $nationality);
$execGetTempThree->bindValue(':getDate', $getDate);
$execGetTempThree->bindValue(':medType', $medType);
$execGetTempThree->execute();
$result = array();

$i = 0;
foreach($execGetTempThree as $res)
{
	$result[$i] = $res;
	$i++;
}

echo json_encode($result);
?>