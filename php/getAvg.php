<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$getAverage = "
SELECT
diabetes_assessment_id,
    date_of_assessment,
    CONCAT(MONTHNAME(diabetes_assessment.date_of_assessment), ' - ', YEAR(diabetes_assessment.date_of_assessment)) as assessmentDate,
    MONTHNAME(diabetes_assessment.date_of_assessment) as monthNameAssessment,
    YEAR(diabetes_assessment.date_of_assessment) as yearAssessment, 
    MONTH(diabetes_assessment.date_of_assessment) as monthAssessment, 
    AVG(diabetes_assessment.assessment_result) as avgAssessment
FROM 
    diabetes_assessment
WHERE
    diabetes_assessment.clinic_id = :cid
group by 
    MONTH(diabetes_assessment.date_of_assessment), 
    YEAR(diabetes_assessment.date_of_assessment)
ORDER BY 
    yearAssessment, 
    monthAssessment ASC";

$execGetAverage = $conn->prepare($getAverage);
$execGetAverage->bindValue(':cid', $cid);
$execGetAverage->execute();
$result = $execGetAverage->fetchAll();

echo json_encode($result);
?>