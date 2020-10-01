<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$medType = 'chronic';
//$getDate = $_POST['monthVal'];
$encKey = 'medair2017';
$nationality = $_POST['nationality'];
$deceased = "Deceased";
$discharged = "Discharged";
$getTempNine = "SELECT
	CONVERT(aes_decrypt(patient.patient_name_en, :encKey) USING utf8mb4) as patient_name_en,
	CONVERT(aes_decrypt(patient.patient_name_ar, :encKey) USING utf8mb4) as patient_name_ar ,
	patient.patient_id,
	CONVERT(aes_decrypt(patient.unhcr_registration_number, :encKey) USING utf8mb4) as unhcr_registration_number,
	patient.nationality,
	patient.patient_status
FROM
 	patient
WHERE
 	patient.nationality = :nationality
AND
 	patient.clinic_id = :cid
AND
(
 	patient.patient_status = :discharged
OR
 	patient.patient_status = :deceased
)
";

$execGetTempNine = $conn->prepare($getTempNine);
$execGetTempNine->bindValue(':encKey', $encKey);
$execGetTempNine->bindValue(':nationality', $nationality);
$execGetTempNine->bindValue(':cid', $cid);
$execGetTempNine->bindValue(':discharged', $discharged);
$execGetTempNine->bindValue(':deceased', $deceased);
//$execGetTempNine->bindValue(':getDate', $getDate);
$execGetTempNine->execute();
$result = array();

$i = 0;
foreach($execGetTempNine as $res)
{
	$result[$i] = $res;
	$i++;
}

echo json_encode($result);
?>