<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$vid = $_POST['vid'];
$selectMedPharm = "SELECT t3.med_pharmacy_id, t3.given_quantity, t3.consultation_med_id FROM visit t1
LEFT JOIN consultation t2 USING (visit_id, clinic_id)
LEFT JOIN consultation_med t3 USING (consultation_id, clinic_id)
WHERE t1.visit_id = t2.visit_id AND t2.consultation_id = t3.consultation_id
AND t1.clinic_id = :cid AND t1.visit_id=:vid";

$execSelectMedPharm = $conn->prepare($selectMedPharm);
$execSelectMedPharm->bindValue(':cid', $clinic_id);
$execSelectMedPharm->bindValue(':vid', $vid);
$execSelectMedPharm->execute();
$res = $execSelectMedPharm->fetchAll();

foreach($res as $result)
{
	$update = "UPDATE consultation_med SET given_quantity = 0 WHERE med_pharmacy_id = :mid
	           AND clinic_id = :cid AND consultation_med_id = :cmid";
	$execUpdate = $conn->prepare($update);
	$execUpdate->bindValue(':mid', $result['med_pharmacy_id']);
	$execUpdate->bindValue(':cid', $clinic_id);
	$execUpdate->bindValue(':cmid', $result['consultation_med_id']);
	$execUpdate->execute();
}

echo "updated";

?>