<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$result = array();
$clinic_id = $_SESSION['clinic_id'];
$ensureQuantity = "SELECT t1.med_id, t1.med_pharmacy_id,
t3.med_name,
t1.med_expiry, 
t1.med_barcode, 
t1.med_tablet, 
t1.med_pill, 
t1.med_received,
ifnull(sum(t2.given_quantity),0) as given_pills,
t1.med_tablet - ((ifnull(sum(t2.given_quantity),0)*t1.med_tablet)/t1.med_pill) as still_tablets,
(t1.med_pill-sum(t2.given_quantity)) as still_pills
FROM med_pharmacy t1
LEFT JOIN consultation_med t2 USING (med_pharmacy_id,clinic_id)
LEFT JOIN medication t3 USING (med_id,clinic_id)
WHERE t1.clinic_id=:cid GROUP BY t1.med_pharmacy_id, t1.med_expiry,t1.med_barcode,t1.med_tablet,t1.med_pill,t1.med_received";
$execEnsureQuantity = $conn->prepare($ensureQuantity);
$execEnsureQuantity->bindValue(':cid', $clinic_id);
$execEnsureQuantity->execute();

$res = $execEnsureQuantity->fetchAll();

$i=0;
foreach($res as $results)
{
	if($results['still_pills']==null)
	{
		$results['still_pills']=$results['med_pill'];
	}
	if($results['still_pills']!=0)
	{
		$result[$i] = $results;
		$i++;
	}
	// $getMedications = "SELECT * FROM med_pharmacy t1 JOIN medication t2 WHERE t1.med_id = t2.med_id";
	// $execGetMedications = $conn->prepare($getMedications);
	// $execGetMedications->execute();
	// $getExecGetMedications = $execGetMedications->fetchAll();
}
?>