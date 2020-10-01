<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];

$patient_id = $clinic_id . '-' .$_POST['patient_id'];

$ymca_id = $clinic_id . '-' .$_POST['ymca_id'];

$clinic_staff = $_POST['clinic_staff'];
$ymca_staff = $_POST['ymca_staff'];
$medair_staff = $_POST['medair_staff'];

$blood_type = $_POST['blood_type'];
$name_en = $_POST['name_en'];
$name_ar = $_POST['name_ar'];
$mother_name = $_POST['mother_name'];
$gender = $_POST['gender'];
$nationality = $_POST['nationality'];
$dob = $_POST['dob'];
$registration_date = $_POST['registration_date'];
$unhcr_registration_number = $_POST['unhcr_registration_number'];
$patient_address = $_POST['patient_address'];
$patient_phone = $_POST['patient_phone'];
$patient_smoker = $_POST['patient_smoker'];
$smoker_number_of_packets = $_POST['smoker_number_of_packets']*20;
$patient_alt_name = $_POST['patient_alt_name'];
$patient_alt_contact_add = $_POST['patient_alt_contact_add'];
$relation = $_POST['relation'];
//Patient Family History
$diagnosis = $_POST['diagnosis'];
//$diagnosis_data = $_POST['diagnosis_data'];
//General Comment
$comment = $_POST['comment'];
$patient_status = $_POST['patient_status'];
$alcohol = $_POST['alcohol'];
$reason_of_edit = "Data Added Upon Registration using NCD App";
//Add data to patient table

$checkId = "SELECT * FROM patient WHERE (patient_id = :pid) AND clinic_id = :cid";
// $checkId = "SELECT * FROM patient WHERE (patient_id = :pid OR ymca_id = :ymca_id) AND clinic_id = :cid";
$execCheckId = $conn->prepare($checkId);
$execCheckId->bindValue(":pid", $patient_id);
// $execCheckId->bindValue(":ymca_id", $ymca_id);
$execCheckId->bindValue(":cid", $clinic_id);
$execCheckId->execute();
$count = $execCheckId->rowCount();
if($count == 0)
{
	$newPatient = "INSERT INTO patient(patient_id, ymca_id, patient_name_en, patient_name_ar, patient_mother_name,
		  dob, gender, registration_date, patient_address, patient_phone, patient_smoker,
		  smoker_number_of_packets, alcohol, patient_alt_name, patient_alt_contact_add, relation,
		  nationality, unhcr_registration_number, comment, blood_type, clinic_id, patient_status)
		  VALUES (:patient_id, :ymca_id, aes_encrypt(:patient_name_en, 'medair2017'), aes_encrypt(:patient_name_ar, 'medair2017'), aes_encrypt(:patient_mother_name, 'medair2017'),
		  :dob, :gender, :registration_date, :patient_address, aes_encrypt(:patient_phone, 'medair2017'), :patient_smoker,
		  :smoker_number_of_packets, :alcohol, :patient_alt_name, :patient_alt_contact_add, :relation,
		  :nationality, aes_encrypt(:unhcr_registration_number, 'medair2017'), :comment, :blood_type, :clinic_id, :patient_status)
		  ";
	$ExecNewPatient = $conn->prepare($newPatient);
	$ExecNewPatient->bindValue(":patient_id", $patient_id);
	$ExecNewPatient->bindValue(":ymca_id", $ymca_id);
	$ExecNewPatient->bindValue(":patient_name_en", $name_en);
	$ExecNewPatient->bindValue(":patient_name_ar", $name_ar);
	$ExecNewPatient->bindValue(":patient_mother_name", $mother_name);
	$ExecNewPatient->bindValue(":dob", $dob);
	$ExecNewPatient->bindValue(":gender", $gender);
	$ExecNewPatient->bindValue(":registration_date", $registration_date);
	$ExecNewPatient->bindValue(":patient_address", $patient_address);
	$ExecNewPatient->bindValue(":patient_phone", $patient_phone);
	$ExecNewPatient->bindValue(":patient_smoker", $patient_smoker);
	$ExecNewPatient->bindValue(":smoker_number_of_packets", $smoker_number_of_packets);
	$ExecNewPatient->bindValue(":alcohol", $alcohol);
	$ExecNewPatient->bindValue(":patient_alt_name", $patient_alt_name);
	$ExecNewPatient->bindValue(":patient_alt_contact_add", $patient_alt_contact_add);
	$ExecNewPatient->bindValue(":relation", $relation);
	$ExecNewPatient->bindValue(":nationality", $nationality);
	$ExecNewPatient->bindValue(":unhcr_registration_number", $unhcr_registration_number);
	$ExecNewPatient->bindValue(":comment", $comment);
	$ExecNewPatient->bindValue(":blood_type", $blood_type);
	$ExecNewPatient->bindValue(":clinic_id", $clinic_id);
	$ExecNewPatient->bindValue(":patient_status", $patient_status);

	$ExecNewPatient->execute();

	if($diagnosis !=="")
	{
		$addFamilyHistory = "INSERT INTO patient_family_history(patient_id, diagnosis, clinic_id)

							VALUES(:patient_id, :diagnosis, :clinic_id)";
		$ExecAddFamilyHistory = $conn->prepare($addFamilyHistory);
		$ExecAddFamilyHistory->bindValue(":patient_id", $patient_id);
		$ExecAddFamilyHistory->bindValue(":diagnosis", $diagnosis);
		$ExecAddFamilyHistory->bindValue(":clinic_id", $clinic_id);
		$ExecAddFamilyHistory->execute();
	}

	//Insert into status history:
	$statusHistory = "INSERT INTO status_history(patient_status, status_date, patient_id, clinic_id)
					  VALUES(:patient_status, :status_date, :patient_id, :cid)";
	$execStatusHistory = $conn->prepare($statusHistory);
	$execStatusHistory->bindValue(':patient_status', $patient_status);
	$execStatusHistory->bindValue(':status_date', date("Y-m-d H:i:s"));
	$execStatusHistory->bindValue(':patient_id', $patient_id);
	$execStatusHistory->bindValue(':cid', $clinic_id);
	$execStatusHistory->execute();


	//Insert Into patient edit history
	$newPatient2 = "INSERT INTO patient_edited(patient_id, patient_name_en, patient_name_ar, patient_mother_name,
		  dob, gender, registration_date, patient_address, patient_phone, patient_smoker,
		  smoker_number_of_packets, alcohol, patient_alt_name, patient_alt_contact_add, relation,
		  nationality, unhcr_registration_number, comment, blood_type, clinic_id, patient_status, date_of_edit, comment_on_edit)
		  VALUES (:patient_id, aes_encrypt(:patient_name_en, 'medair2017'), aes_encrypt(:patient_name_ar, 'medair2017'), aes_encrypt(:patient_mother_name, 'medair2017'),
		  :dob, :gender, :registration_date, :patient_address, aes_encrypt(:patient_phone, 'medair2017'), :patient_smoker,
		  :smoker_number_of_packets, :alcohol, :patient_alt_name, :patient_alt_contact_add, :relation,
		  :nationality, aes_encrypt(:unhcr_registration_number, 'medair2017'), :comment, :blood_type, :clinic_id, :patient_status, :doe, :comment_on_edit)
		  ";
	$ExecNewPatient2 = $conn->prepare($newPatient2);
	$ExecNewPatient2->bindValue(":patient_id", $patient_id);
	$ExecNewPatient2->bindValue(":patient_name_en", $name_en);
	$ExecNewPatient2->bindValue(":patient_name_ar", $name_ar);
	$ExecNewPatient2->bindValue(":patient_mother_name", $mother_name);
	$ExecNewPatient2->bindValue(":dob", $dob);
	$ExecNewPatient2->bindValue(":gender", $gender);
	$ExecNewPatient2->bindValue(":registration_date", $registration_date);
	$ExecNewPatient2->bindValue(":patient_address", $patient_address);
	$ExecNewPatient2->bindValue(":patient_phone", $patient_phone);
	$ExecNewPatient2->bindValue(":patient_smoker", $patient_smoker);
	$ExecNewPatient2->bindValue(":smoker_number_of_packets", $smoker_number_of_packets);
	$ExecNewPatient2->bindValue(":alcohol", $alcohol);
	$ExecNewPatient2->bindValue(":patient_alt_name", $patient_alt_name);
	$ExecNewPatient2->bindValue(":patient_alt_contact_add", $patient_alt_contact_add);
	$ExecNewPatient2->bindValue(":relation", $relation);
	$ExecNewPatient2->bindValue(":nationality", $nationality);
	$ExecNewPatient2->bindValue(":unhcr_registration_number", $unhcr_registration_number);
	$ExecNewPatient2->bindValue(":comment", $comment);
	$ExecNewPatient2->bindValue(":blood_type", $blood_type);
	$ExecNewPatient2->bindValue(":clinic_id", $clinic_id);
	$ExecNewPatient2->bindValue(":patient_status", $patient_status);
	$ExecNewPatient2->bindValue(":doe", date("Y-m-d H:i:s"));
	$ExecNewPatient2->bindValue(":comment_on_edit", $reason_of_edit);

	$ExecNewPatient2->execute();

	$addConsent = "INSERT INTO 
				   patient_consent
				   (
				   		clinic_staff, 
				   		ymca_staff, 
				   		medair_staff, 
				   		patient_id
				   )
				   VALUES
				   (
				   		:clinic_staff,
				   		:ymca_staff,
				   		:medair_staff,
				   		:pid
				   )";
	$execAddConsent = $conn->prepare($addConsent);
	$execAddConsent->bindValue(":clinic_staff", $clinic_staff);
	$execAddConsent->bindValue(":ymca_staff", $ymca_staff);
	$execAddConsent->bindValue(":medair_staff", $medair_staff);
	$execAddConsent->bindValue(":pid", $patient_id);
	$execAddConsent->execute();

	echo $patient_id;
}
else
{
	echo "exist";
}
?>