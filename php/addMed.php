<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
if(isset($_POST['medName']))
{
	$med_name = $_POST['medName'];
	$searchMed = "SELECT * FROM medication WHERE med_name = :med_name";
	$execSearchMed = $conn->prepare($searchMed);
	$execSearchMed->bindValue(':med_name', $med_name);
	$execSearchMed->execute();
	$count = $execSearchMed->rowCount();
	if($count == 0)
	{
		$addMed = "INSERT INTO medication(med_name, med_date_added, clinic_id)
		           VALUES(:med_name, :med_received, :clinic_id)";
		$execAddMed2 = $conn->prepare($addMed);
		$execAddMed2->bindValue(':med_name', $med_name);
		$execAddMed2->bindValue(':med_received', date('Y-m-d H:i:s'));
		$execAddMed2->bindValue(':clinic_id', $clinic_id);
		$execAddMed2->execute();
		$lastId = $conn->lastInsertId();
		echo $lastId;
	}
	else
	{
		echo "exist";
	}
}
?>