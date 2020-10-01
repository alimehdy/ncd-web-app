<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$searchTxt = '%'.$_POST['searchTxt'].'%';
$res = array();
$getRes = "SELECT t1.med_id,
t3.med_name,
t1.med_expiry, 
t1.med_barcode, 
sum(t1.med_tablet) as ac, 
sum(t1.med_pill) as ac1, 
t1.med_received,
sum(t2.given_quantity) as given_pills,
t1.med_tablet - ((sum(t2.given_quantity)*t1.med_tablet)/sum(t1.med_pill)) as still_tablets,
(sum(t1.med_pill)-sum(t2.given_quantity)) as still_pills
FROM med_pharmacy t1 LEFT JOIN consultation_med t2 ON t1.med_pharmacy_id = t2.med_pharmacy_id LEFT JOIN medication t3 ON t1.med_id=t3.med_id WHERE ( 
 t1.clinic_id=:cid) AND (t1.med_id LIKE :searchTxt OR t3.med_name LIKE :searchTxt  OR t1.med_barcode LIKE :searchTxt OR t1.med_expiry LIKE :searchTxt) GROUP BY t1.med_id,t3.med_name, t1.med_expiry,t1.med_barcode,t1.med_tablet,t1.med_pill,t1.med_received";
$execGetRes = $conn->prepare($getRes);
$execGetRes->bindValue(':cid', $clinic_id);
$execGetRes->bindValue(':searchTxt', $searchTxt);
$execGetRes->execute();

$i = 0;
$i = 0;
foreach($execGetRes as $result)
{
	$res[$i] = $result;
	$i++;
}

echo json_encode($res);

?>