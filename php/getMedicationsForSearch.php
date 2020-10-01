<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$mid = $_POST['mid'];
$res = array();
header('Content-type: application/json');

$getMedications = "SELECT
    med_pharmacy.med_pharmacy_id,  
	medication.med_id, 
    medication.med_name, 
    med_pharmacy.med_barcode, 
    med_pharmacy.med_received, 
    med_pharmacy.med_expiry, 
    med_pharmacy.med_pill 
FROM 
	med_pharmacy 
    LEFT JOIN 
    medication
    ON 
    med_pharmacy.med_id = medication.med_id 
WHERE 
	med_pharmacy.med_id=:mid
    AND
    med_pharmacy.clinic_id=:cid
ORDER by med_pharmacy.med_received";
$execGetMedications = $conn->prepare($getMedications);
$execGetMedications->bindValue(":mid", $mid);
$execGetMedications->bindValue(":cid", $cid);
$execGetMedications->execute();
//$getExecGetMedications = $execGetMedications->fetchAll();
$i=0;
foreach($execGetMedications as $var)
{
	$res[$i]=$var;
	$i++;
}

echo json_encode($res);

?>