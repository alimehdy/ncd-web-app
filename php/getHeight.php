<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];

$pid = $_POST['pidForHeight'];

$search = "SELECT * FROM visit WHERE patient_id = :pid AND clinic_id = :clinic_id AND patient_height <>0 LIMIT 1";
$executeSearch = $conn->prepare($search);
$executeSearch->bindValue(':pid', $pid);
$executeSearch->bindValue(':clinic_id', $clinic_id);
$executeSearch->execute();
$res = $executeSearch->fetch();
$rowNumber = $executeSearch->rowCount();

if($rowNumber>0){
	$height = $res['patient_height'];
}
else
{
	$height = 'Unavailable';
}

echo json_encode($height);
?>