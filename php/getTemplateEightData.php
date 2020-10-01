<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');
header('Content-type:application/json');
$cid = $_SESSION['clinic_id'];
$getDate = $_POST['monthVal'];
$encKey = 'medair2017';
$status = 'Active';
$nationality = $_POST['nationality'];
$getTempThree = "SELECT
	CONVERT(aes_decrypt(patient.patient_name_en, :encKey)USING utf8mb4) as patient_name_en, old_treatment, new_treatment

FROM
	patient
LEFT JOIN
	treatment
ON
	patient.patient_id = treatment.patient_id
WHERE treatment.clinic_id = :cid 
and month(treatment.date_of_change)=month(:getVal) 
and year(treatment.date_of_change)=year(:getVal)
and patient.nationality = :nationality
and treatment.treatment_status = :status
ORDER BY patient_name_en, patient.patient_id DESC
";


$execGetTempThree = $conn->prepare($getTempThree);
$execGetTempThree->bindValue(':encKey', $encKey);
$execGetTempThree->bindValue(':cid', $cid);
$execGetTempThree->bindValue(':getVal', $getDate);
$execGetTempThree->bindValue(':nationality', $nationality);
$execGetTempThree->bindValue(':status', $status);
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