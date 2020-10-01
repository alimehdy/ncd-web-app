<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');
$clinic_id = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$doa = $_POST['doa'];
$toa = $_POST['toa'];
try
{
$addAppointment = "INSERT INTO appointment(next_appointment_date, next_appointment_time, patient_id, clinic_id) VALUES(:doa, :toa, :pid, :cid)";
$execAddAppointment = $conn->prepare($addAppointment);
$execAddAppointment->bindValue(':doa', $doa);
$execAddAppointment->bindValue(':toa', $toa);
$execAddAppointment->bindValue(':pid', $pid);
$execAddAppointment->bindValue(':cid', $clinic_id);
$execAddAppointment->execute();

echo "added";
}
catch(Exception $e)
{
	echo $e->getMessage();
}
?>