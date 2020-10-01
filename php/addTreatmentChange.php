<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');
header("Content-type:application/json");
$clinic_id = $_SESSION['clinic_id'];
$encKey = "medair2017";

$id = $_POST['id'];
$monthOfChange = $_POST['monthOfChange'];
$old_treatment = $_POST['old_treatment'];
$new_treatment = $_POST['new_treatment'];
$status = $_POST['status'];

$arrRes = array();
//$i = 0;

$sql = "INSERT INTO treatment(patient_id, old_treatment, new_treatment, treatment_status, clinic_id, date_of_change, dateAdded)
    VALUES (:id, :old_treatment, :new_treatment, :treatment_status, :cid, :date_of_change, NOW())";
$exec = $conn->prepare($sql);
$exec->bindValue(":id", $id);
$exec->bindValue(":old_treatment", $old_treatment);
$exec->bindValue(":new_treatment", $new_treatment);
$exec->bindValue(":treatment_status", $status);
$exec->bindValue(":cid", $clinic_id);
$exec->bindValue(":date_of_change", $monthOfChange);

$exec->execute();

$idAdded = $conn->lastInsertId();
$getData = "SELECT CONVERT(aes_decrypt(patient_name_en, :encKey) using utf8mb4) as patient_name_en, treatment.* FROM treatment LEFT JOIN patient
ON patient.patient_id = treatment.patient_id WHERE treatment.clinic_id = :cid AND treatment_id = :treatmentID LIMIT 1";
$execData = $conn->prepare($getData);
$execData->bindValue(":cid", $clinic_id);
$execData->bindValue(":encKey", $encKey);
$execData->bindValue(":treatmentID", $idAdded);
$execData->execute();
$result = $execData->fetch();
// foreach($result as $res)
// {
// 	$arrRes[$i]=$res;
// 	$i++;
// }
$arrRes = array("treatment_id"=>$result['treatment_id'],
               "patient_id"=>$result['patient_id'],
               "patient_name_en"=>$result['patient_name_en'],
               "old_treatment"=>$result['old_treatment'],
               "new_treatment"=>$result['new_treatment'],
               "treatment_status"=>$result['treatment_status'],
               "date_of_change"=>$result['date_of_change']
          );
echo json_encode($arrRes);
?>