<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$cid = $_SESSION['clinic_id'];
$mid = $_POST['mid'];
$med_id = $_POST['med_id'];
$quant = $_POST['quant'];
//$still = 0;
$result = array();
$ensureQuantity = "SELECT 
(SELECT
	sum(med_pharmacy.med_pill)    
FROM
	med_pharmacy

WHERE med_pharmacy.med_id=:med_id AND med_pharmacy.clinic_id=:cid)
-
(SELECT
	sum(consultation_med.given_quantity)
FROM
	consultation_med
LEFT JOIN
	med_pharmacy
ON med_pharmacy.med_pharmacy_id = consultation_med.med_pharmacy_id
WHERE med_pharmacy.med_id=:med_id AND med_pharmacy.clinic_id=:cid) as still_pills
";
$execEnsureQuantity = $conn->prepare($ensureQuantity);
$execEnsureQuantity->bindValue(':cid', $cid);
$execEnsureQuantity->bindValue(':med_id', $med_id);
$execEnsureQuantity->execute();

$res = $execEnsureQuantity->fetchAll();

$i=0;
foreach($res as $result)
{
	$result[$i]=$res;
	$i++;
}
echo json_encode($result);
// if($res['still_pills'] === $res['med_pill'])
// {
// 	$still = $res['med_pill'];
// }
// else
// {
// 	$still = $res['still_pills'];
// }

// if($quant<=$still)
// {
// 	echo '1* '. $quant.'-'.$still;
// 	//echo "good";
// }

// if($quant>$still)
// {
// 	echo '2* '. $quant.'-'.$still;
// 	//echo "exceed";
// }

?>