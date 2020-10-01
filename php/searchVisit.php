<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../php/connection.php');

$res = array();
$cid = $_SESSION['clinic_id'];
$searchTxt = '%'.$_POST['searchTxt'].'%';

$getVisitsSearch = "SELECT t1.visit_id, t1.date_of_visit, t1.visit_status, 
              t2.patient_id, CONVERT(aes_decrypt(t2.patient_name_en, 'medair2017') USING utf8mb4) AS patient_name_en
              FROM visit t1 JOIN patient t2 
              WHERE t1.patient_id = t2.patient_id AND t1.clinic_id = :cid AND (aes_decrypt(t2.patient_name_en, 'medair2017') LIKE :searchTxt OR t2.patient_id LIKE :searchTxt OR ymca_id LIKE :searchTxt OR t2.patient_phone LIKE :searchTxt OR t1.date_of_visit LIKE :searchTxt) 
              ORDER BY t1.date_of_visit DESC";
$execGetVisitsSearch = $conn->prepare($getVisitsSearch);
$execGetVisitsSearch->bindValue(':cid', $cid);
$execGetVisitsSearch->bindValue(':searchTxt', $searchTxt);
$execGetVisitsSearch->execute();
$getVisitsSearchResult = $execGetVisitsSearch->fetchAll();

$i = 0;
foreach($getVisitsSearchResult as $result)
{
	$res[$i] = $result;
	$i++;
}

echo json_encode($res);
?>