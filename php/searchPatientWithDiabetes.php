<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../php/connection.php');

$res = array();
$cid = $_SESSION['clinic_id'];
$searchTxt = '%'.$_POST['searchTxt'].'%';
$encKey = "medair2017";
$diagName = '%Diabetes%';
$visit_status = "Active";

$searchPatientWithDiabetes = "SELECT 
t1.patient_id,
CONVERT(aes_decrypt(t4.patient_name_en, :encKey) USING utf8mb4) as patient_name_en,
t3.date_of_visit as date_of_visit, 
t2.diagnosis_name,
ifnull(t5.date_of_assessment, 'N/A') as date_of_assessment,
ifnull(t5.assessment_result, 0) as assessment_result,
(
    SELECT 
    CASE 
        WHEN 
            (period_diff(EXTRACT(YEAR_MONTH FROM now()), EXTRACT(YEAR_MONTH FROM date_of_assessment))>=6) 
        THEN 
            'Yes' 
        ELSE 
            'No'  
        END 
    FROM diabetes_assessment t5 
    where t5.patient_id = t1.patient_id LIMIT 1
) as assessment_needed
FROM consultation t1
LEFT JOIN diagnosis t2 ON t1.diagnosis_id = t2.diagnosis_id
LEFT JOIN visit t3  ON t3.visit_id = t1.visit_id
LEFT JOIN patient t4  ON t4.patient_id = t3.patient_id
LEFT JOIN diabetes_assessment t5  ON t5.patient_id = t4.patient_id
WHERE t2.diagnosis_name   LIKE :diagName
AND  t1.clinic_id = '361'
AND  t3.visit_status='Active'
AND ( t1.patient_id,t3.date_of_visit, ifnull(t5.date_of_assessment, 'N/A')) IN (
    SELECT 
    t1.patient_id,
    min(t3.date_of_visit) as date_of_visit, 
    max(ifnull(t5.date_of_assessment, 'N/A')) as date_of_assessment
    FROM 
        consultation t1
    LEFT JOIN diagnosis t2 
        ON t1.diagnosis_id = t2.diagnosis_id
    LEFT JOIN visit t3 
        ON t3.visit_id = t1.visit_id
    LEFT JOIN patient t4 
        ON t4.patient_id = t3.patient_id
    LEFT JOIN diabetes_assessment t5 
        ON t5.patient_id = t4.patient_id
    WHERE t2.diagnosis_name    LIKE :diagName 
    AND  t1.clinic_id = :cid
    AND t3.visit_status= :visit_status
    AND 
        (CONVERT(aes_decrypt(t4.patient_name_en, :encKey) USING utf8mb4) LIKE :searchTxt 
	OR 
	    t4.patient_id LIKE :searchTxt
	OR 
	    CONVERT(aes_decrypt(t4.patient_phone, :encKey) USING utf8mb4) LIKE :searchTxt)
    GROUP BY t1.patient_id
    ORDER BY t5.date_of_assessment DESC


)
ORDER BY  t5.date_of_assessment DESC";
$execSearchPatientWithDiabetes = $conn->prepare($searchPatientWithDiabetes);
$execSearchPatientWithDiabetes->bindValue(':encKey', $encKey);
$execSearchPatientWithDiabetes->bindValue(':diagName', $diagName);
$execSearchPatientWithDiabetes->bindValue(':cid', $cid);
$execSearchPatientWithDiabetes->bindValue(':visit_status', $visit_status);
$execSearchPatientWithDiabetes->bindValue(':searchTxt', $searchTxt);
$execSearchPatientWithDiabetes->execute();

//$execSearchPatientResult = $execSearchPatient->fetchAll();

$i = 0;
foreach($execSearchPatientWithDiabetes as $result)
{
	$res[$i] = $result;
	$i++;
}

echo json_encode($res);

?>