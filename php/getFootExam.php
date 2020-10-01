<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_REQUEST['pid'];
$result = array();
$getFootExam = "SELECT 
                   CONVERT(aes_decrypt(patient_name_en, 'medair2017') USING utf8mb4) as patient_name_en, 
                   foot_examination.* 
                   FROM 
			       foot_examination LEFT JOIN patient 
			       ON 
			       patient.patient_id = foot_examination.patient_id 
			   WHERE 
			       foot_examination.clinic_id = :cid 
			   AND 
			       foot_examination.patient_id = :pid
			   ORDER BY foot_examination.date_of_exam ASC";
$execGetFootExam = $conn->prepare($getFootExam);
$execGetFootExam->bindValue(':cid', $cid);
$execGetFootExam->bindValue(':pid', $pid);
$execGetFootExam->execute();
$count = $execGetFootExam->rowCount();

$execGetFootExam = $execGetFootExam->fetchAll();
foreach($execGetFootExam as $res)
{
	$result[]=$res;
}

?>