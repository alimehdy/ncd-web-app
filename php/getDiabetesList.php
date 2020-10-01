<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
$cid = $_SESSION['clinic_id'];
$encKey = "medair2017";
$diagName = '%Diabetes%';
$visit_status = "Active";
$getDiabetesList = "SELECT 
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
    GROUP BY t1.patient_id
    ORDER BY t5.date_of_assessment DESC


)
GROUP BY t1.patient_id
ORDER BY  t5.date_of_assessment DESC";
$execGetDiabetesList = $conn->prepare($getDiabetesList);
$execGetDiabetesList->bindValue(':encKey', $encKey);
$execGetDiabetesList->bindValue(':diagName', $diagName);
$execGetDiabetesList->bindValue(':cid', $cid);
$execGetDiabetesList->bindValue(':visit_status', $visit_status);
$execGetDiabetesList->execute();
$res = $execGetDiabetesList->fetchAll();
?>