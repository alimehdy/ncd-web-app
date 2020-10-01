<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$new_status = $_POST['new_status'];
if($new_status !== "select")
{
	$updateStatus = "UPDATE visit SET visit_status = :new_status WHERE visit_id = :pid AND clinic_id = :cid";
	$execUpdateStatus = $conn->prepare($updateStatus);
	$execUpdateStatus->bindValue(':new_status', $new_status);
	$execUpdateStatus->bindValue(':pid', $pid);
	$execUpdateStatus->bindValue(':cid', $cid);
	$execUpdateStatus->execute();

	// $tz = 'Asia/Beirut';
	// $timestamp = time();
	// $dt = new DateTime("now", new DateTimeZone($tz));
	// $dt->setTimestamp($timestamp);
	// $final_date = $dt->format('Y.m.d, H:i:s');
	// $statusLog = "INSERT INTO status_history(patient_status, status_date, patient_id, clinic_id) VALUES (:patient_status, :status_date, :pid, :cid)";
	// $execStatusLog = $conn->prepare($statusLog);
	// $execStatusLog->bindValue(':patient_status', $new_status);
	// $execStatusLog->bindValue(':status_date', $final_date);
	// $execStatusLog->bindValue(':pid', $pid);
	// $execStatusLog->bindValue(':cid', $cid);
	// $execStatusLog->execute();

	echo "updated";
}
else
{
	echo "select";
}
?>