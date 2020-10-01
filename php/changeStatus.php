<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$new_status = $_POST['new_status'];
$reason_of_edit = "Status Changed Only";
if($new_status !== "select")
{
	$updateStatus = "UPDATE patient SET patient_status = :new_status WHERE patient_id = :pid AND clinic_id = :cid";
	$execUpdateStatus = $conn->prepare($updateStatus);
	$execUpdateStatus->bindValue(':new_status', $new_status);
	$execUpdateStatus->bindValue(':pid', $pid);
	$execUpdateStatus->bindValue(':cid', $cid);
	$execUpdateStatus->execute();

	$tz = 'Asia/Beirut';
	$timestamp = time();
	$dt = new DateTime("now", new DateTimeZone($tz));
	$dt->setTimestamp($timestamp);
	$final_date = $dt->format('Y.m.d, H:i:s');
	$statusLog = "INSERT INTO status_history(patient_status, status_date, patient_id, clinic_id) VALUES (:patient_status, :status_date, :pid, :cid)";
	$execStatusLog = $conn->prepare($statusLog);
	$execStatusLog->bindValue(':patient_status', $new_status);
	$execStatusLog->bindValue(':status_date', $final_date);
	$execStatusLog->bindValue(':pid', $pid);
	$execStatusLog->bindValue(':cid', $cid);
	$execStatusLog->execute();

	//Get Data
	$selectData = "SELECT * FROM patient WHERE patient_id = :pid AND clinic_id = :cid";
	$execSelectData = $conn->prepare($selectData);
	$execSelectData->bindValue(':pid', $pid);
	$execSelectData->bindValue(':cid', $cid);
	$execSelectData->execute();
	$selectResult = $execSelectData->fetch();

	//Insert Into patient edit history
	$newPatient2 = "INSERT INTO patient_edited(patient_id, patient_name_en, patient_name_ar, patient_mother_name,
	      dob, gender, registration_date, patient_address, patient_phone, patient_smoker,
	      smoker_number_of_packets, alcohol, patient_alt_name, patient_alt_contact_add, relation,
	      nationality, unhcr_registration_number, comment, blood_type, clinic_id, patient_status, date_of_edit, comment_on_edit)
	      VALUES (:patient_id, :patient_name_en, :patient_name_ar, :patient_mother_name,
	      :dob, :gender, :registration_date, :patient_address, :patient_phone, :patient_smoker,
	      :smoker_number_of_packets, :alcohol, :patient_alt_name, :patient_alt_contact_add, :relation,
	      :nationality, :unhcr_registration_number, :comment, :blood_type, :clinic_id, :patient_status, :doe, :comment_on_edit)
	      ";
	$ExecNewPatient2 = $conn->prepare($newPatient2);
	$ExecNewPatient2->bindValue(":patient_id", $pid);
	$ExecNewPatient2->bindValue(":patient_name_en", $selectResult['patient_name_en']);
	$ExecNewPatient2->bindValue(":patient_name_ar", $selectResult['patient_name_ar']);
	$ExecNewPatient2->bindValue(":patient_mother_name", $selectResult['patient_mother_name']);
	$ExecNewPatient2->bindValue(":dob", $selectResult['dob']);
	$ExecNewPatient2->bindValue(":gender", $selectResult['gender']);
	$ExecNewPatient2->bindValue(":registration_date", $selectResult['registration_date']);
	$ExecNewPatient2->bindValue(":patient_address", $selectResult['patient_address']);
	$ExecNewPatient2->bindValue(":patient_phone", $selectResult['patient_phone']);
	$ExecNewPatient2->bindValue(":patient_smoker", $selectResult['patient_smoker']);
	$ExecNewPatient2->bindValue(":smoker_number_of_packets", $selectResult['smoker_number_of_packets']);
	$ExecNewPatient2->bindValue(":alcohol", $selectResult['alcohol']);
	$ExecNewPatient2->bindValue(":patient_alt_name", $selectResult['patient_alt_name']);
	$ExecNewPatient2->bindValue(":patient_alt_contact_add", $selectResult['patient_alt_contact_add']);
	$ExecNewPatient2->bindValue(":relation", $selectResult['relation']);
	$ExecNewPatient2->bindValue(":nationality", $selectResult['nationality']);
	$ExecNewPatient2->bindValue(":unhcr_registration_number", $selectResult['unhcr_registration_number']);
	$ExecNewPatient2->bindValue(":comment", $selectResult['comment']);
	$ExecNewPatient2->bindValue(":blood_type", $selectResult['blood_type']);
	$ExecNewPatient2->bindValue(":clinic_id", $cid);
	$ExecNewPatient2->bindValue(":patient_status", $selectResult['patient_status']);
	$ExecNewPatient2->bindValue(":doe", date("Y-m-d H:i:s"));
	$ExecNewPatient2->bindValue(":comment_on_edit", $reason_of_edit);

	$ExecNewPatient2->execute();
	echo "updated";
}
else
{
	echo "select";
}
?>