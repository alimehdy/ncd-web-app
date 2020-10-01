<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../php/connection.php');
header('Content-type: application/json');

$res = array();
$cid = $_SESSION['clinic_id'];
$searchTxt = '%'.$_POST['searchTxt'].'%';
try{
	$searchLab = "SELECT 
						CONVERT(aes_decrypt(patient.patient_name_en, 'medair2017') USING utf8mb4) as 'pn', 
						lab_test.patient_id, 
						lab_test.lab_id, 
						lab_test.lab_status, 
						lab_test.test_date
						
						FROM	patient 
							LEFT JOIN 
								lab_test 
							ON 
								patient.patient_id = lab_test.patient_id 
							WHERE lab_test.lab_status = :lab_status
								AND
									lab_test.clinic_id = :cid
								AND 
									(lab_test.patient_id LIKE :searchTxt
									
									OR 
									aes_decrypt(patient.patient_name_en, 'medair2017') LIKE :searchTxt 
									OR 
									lab_test.test_date LIKE :searchTxt) 
				  ORDER BY lab_test.test_date";
	$execSearchLab = $conn->prepare($searchLab);
	$execSearchLab->bindValue(':lab_status', "Active");
	$execSearchLab->bindValue(':cid', $cid);
	$execSearchLab->bindValue(':searchTxt', $searchTxt);
	$execSearchLab->execute();

	$execSearchLabResult = $execSearchLab->fetchAll();

	$i = 0;
	foreach($execSearchLabResult as $result)
	{
		$res[$i] = $result;
		$i++;
	}

	echo json_encode($res);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>