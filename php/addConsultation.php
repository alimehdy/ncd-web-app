<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$visit_id = $_POST['visit_id'];
$patient_id = $_POST['patient_id'];
$nid = $_POST['nid'];
$did = $_POST['did'];
$cid = $_POST['cid'];
$diagnosis = $_POST['diagnosis'];
$medication_id = $_POST['medication_id'];
$medication_quantity = $_POST['medication_quantity'];
$consultation_result = $_POST['consultation_result'];
$medication_collector_2 = $_POST['medication_collector_2'];

if($medication_id=="select")
{
	$medication_id = null;
}
if($medication_quantity == "")
{
	$medication_quantity = 0;
}
//echo $lastConsultId;

$ensureQuantity = "SELECT
t1.med_pharmacy_id, t1.med_id, 
sum(t2.given_quantity) as given_pills,
t1.med_tablet - ((sum(t2.given_quantity)*t1.med_tablet)/t1.med_pill) as still_tablets,
(t1.med_pill-sum(t2.given_quantity)) as still_pills
FROM med_pharmacy t1, consultation_med t2, medication t3 WHERE (t1.med_pharmacy_id = t2.med_pharmacy_id AND t1.med_id=t3.med_id
AND t1.clinic_id=:cid AND t1.med_pharmacy_id = :mid) 

GROUP BY t1.med_pharmacy_id, t1.med_id,t3.med_name, t1.med_expiry,t1.med_barcode,t1.med_tablet,t1.med_pill,t1.med_received";
$execEnsureQuantity = $conn->prepare($ensureQuantity);
$execEnsureQuantity->bindValue(':cid', $clinic_id);
$execEnsureQuantity->bindValue(':mid', $medication_id);
$execEnsureQuantity->execute();

$res = $execEnsureQuantity->fetch();

if($nid=="select")
{
	$nid = null;
}
if($did=="select")
{
	$did = null;
}

$addConsultation = "INSERT INTO consultation(nurse_list_id, doctor_list_id,
                complication_name, diagnosis_id, visit_id, consultation_result, clinic_id,
                patient_id)
                VALUES(:nid, :did, :cid, :diagnosis, :visit_id, :consultation_result,
                :clinic_id, :patient_id)";
$execAddConsultation = $conn->prepare($addConsultation);
$execAddConsultation->bindValue(":nid", $nid);
$execAddConsultation->bindValue(":did", $did);
$execAddConsultation->bindValue(":cid", $cid);
$execAddConsultation->bindValue(":diagnosis", $diagnosis);
$execAddConsultation->bindValue(":visit_id", $visit_id);
$execAddConsultation->bindValue(":consultation_result", $consultation_result);
$execAddConsultation->bindValue(":clinic_id", $clinic_id);
$execAddConsultation->bindValue(":patient_id", $patient_id);

$execAddConsultation->execute();

$lastConsultId = $conn->lastInsertId();

$insertQuantity = "INSERT INTO consultation_med(consultation_id, med_pharmacy_id, given_quantity, date_given, medication_collector, clinic_id)
    VALUES(:consult_id, :mp_id, :gq, :dg, :medication_collector_2, :cid)";
$execInsertQuantity = $conn->prepare($insertQuantity);
$execInsertQuantity->bindValue(':consult_id', $lastConsultId);
$execInsertQuantity->bindValue(':mp_id', $medication_id);
$execInsertQuantity->bindValue(':gq', $medication_quantity);
$execInsertQuantity->bindValue(':dg', date('Y-m-d H:i:s'));
$execInsertQuantity->bindValue(':medication_collector_2', $medication_collector_2);
$execInsertQuantity->bindValue(':cid', $clinic_id);
$execInsertQuantity->execute();

echo "q_added";

?>