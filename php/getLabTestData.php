<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];
$result = array();
$getLabRes = "SELECT 
                   CONVERT(aes_decrypt(patient.patient_name_en, 'medair2017') USING utf8mb4) as patient_name_en,
				   patient.patient_id,
				   lab_test.lab_status,
                   lab_test.* 
                   FROM 
			       lab_test LEFT JOIN patient 
			       ON 
			       patient.patient_id = lab_test.patient_id 
			   WHERE 
			   	
			       lab_test.clinic_id = :cid 
			   AND 
			       lab_test.patient_id = :pid AND lab_test.lab_status = :lab_status
			   ORDER BY lab_test.test_date ASC";
$execGetLabResult = $conn->prepare($getLabRes);
$execGetLabResult->bindValue(':lab_status', 'Active');
$execGetLabResult->bindValue(':cid', $cid);
$execGetLabResult->bindValue(':pid', $pid);
$execGetLabResult->execute();
$count = $execGetLabResult->rowCount();

$execGetLabResultData = $execGetLabResult->fetchAll();
foreach($execGetLabResultData as $res)
{
	$result[]=$res;
}

?>