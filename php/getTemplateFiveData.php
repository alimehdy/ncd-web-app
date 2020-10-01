<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$cid = $_SESSION['clinic_id'];

$monthVal = $_POST['monthVal'];
$nationality = $_POST['nationality'];
$chronic = "chronic";
$nonChronic = "non chronic";

$getInfo = "SELECT
	count(*) as chronicPatientCount
FROM
	(
		SELECT 
			patient.patient_id as pid
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
				patient.clinic_id = :cid
			AND
				year(visit.date_of_visit)= :yearVal
			AND
				month(visit.date_of_visit) = :monthVal
			AND 
				medication.med_type=:chronic
			AND
				patient.nationality = :nationality
		GROUP BY
			patient.patient_id
    )
AS
	counting";

$getInfoExec = $conn->prepare($getInfo);
$getInfoExec->bindValue(':cid', $cid);
$getInfoExec->bindValue(':yearVal', date('Y', strtotime($monthVal)));
$getInfoExec->bindValue(':monthVal', date('m', strtotime($monthVal)));
$getInfoExec->bindValue(':chronic', $chronic);
$getInfoExec->bindValue(':nationality', $nationality);
$getInfoExec->execute();

$resChronic = $getInfoExec->fetchColumn();

$getInfo2 = "SELECT
	count(*) as chronicPatientCount
FROM
	(
		SELECT 
			patient.patient_id as pid
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
				patient.clinic_id = :cid
			AND
				year(consultation_med.date_given)= :yearVal
			AND
				month(consultation_med.date_given) = :monthVal
			AND 
				medication.med_type=:chronic
			AND
				patient.nationality = :nationality
		GROUP BY
			patient.patient_id
    )
AS
	counting";

$getInfoExec2 = $conn->prepare($getInfo2);
$getInfoExec2->bindValue(':cid', $cid);
$getInfoExec2->bindValue(':yearVal', date('Y', strtotime($monthVal)));
$getInfoExec2->bindValue(':monthVal', date('m', strtotime($monthVal)));
$getInfoExec2->bindValue(':chronic', $nonChronic);
$getInfoExec2->bindValue(':nationality', $nationality);
$getInfoExec2->execute();

$resChronic2 = $getInfoExec2->fetchColumn();

$res=array("chronic"=>$resChronic, "nonChronic"=>$resChronic2);

echo json_encode($res);
//Counting with no med
// select 
// 	count(*) 
// from
// 	(SELECT 
// 		patient.patient_id as pid, 
//         visit.* 
// 	FROM
// 		patient
// 	left join
// 		visit
// 		on
// 			patient.patient_id = visit.patient_id
// 	where
// 		visit.visit_id  
// 	not in 
// 	(
// 		select 
// 			consultation.visit_id 
// 		from 
// 			consultation 
// 		left join 
// 			visit 
// 			on 
// 				consultation.visit_id=visit.visit_id
// 	)
// 	AND
// 		month(visit.date_of_visit)='12'
// 	AND
// 		year(visit.date_of_visit)='2017'
// 	AND
// 		visit.clinic_id = '361'
// 	AND
// 		patient.nationality = 'Syrian'
// 	GROUP BY
// 		patient.patient_id
// 	)
// As countingNoMed
?>