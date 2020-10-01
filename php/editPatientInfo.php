<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$patient_id = $_POST['patient_id'];
$ymca_id = $clinic_id.'-'.$_POST['ymca_id'];
// if(strlen($ymca_id)<4)
// {
//   $ymca_id = $clinic_id.'-'.$_POST['ymca_id'];
// }
// else
// {
//   $ymca_id = $_POST['ymca_id'];
// }
$encKey = 'medair2017';
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
$smoker_number_of_packets = $_POST['smoker_number_of_packets'];
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

$reason_of_edit = "Edited On the Specified date";

$updatePatientInfo = "UPDATE patient SET 
		patient_name_en = aes_encrypt(:patient_name_en, :encKey), 
		patient_name_ar = aes_encrypt(:patient_name_ar, :encKey),
    ymca_id = :ymca_id, 
		patient_mother_name = aes_encrypt(:patient_mother_name, :encKey),
        dob = :dob, 
        gender = :gender, 
        registration_date = :registration_date, 
        patient_address = :patient_address, 
        patient_phone = aes_encrypt(:patient_phone, :encKey), 
        patient_smoker = :patient_smoker,
        smoker_number_of_packets = :smoker_number_of_packets, 
        alcohol = :alcohol, 
        patient_alt_name = :patient_alt_name, 
        patient_alt_contact_add = :patient_alt_contact_add, 
        relation = :relation,
        nationality = :nationality, 
        unhcr_registration_number = aes_encrypt(:unhcr_registration_number, :encKey), 
        comment = :comment, 
        blood_type = :blood_type,  
        patient_status = :patient_status WHERE patient_id = :patient_id AND clinic_id = :clinic_id";
$execUpdatePatientInfo = $conn->prepare($updatePatientInfo);
$execUpdatePatientInfo->bindValue(":encKey", $encKey);
$execUpdatePatientInfo->bindValue(":patient_id", $patient_id);
$execUpdatePatientInfo->bindValue(":patient_name_en", $name_en);
$execUpdatePatientInfo->bindValue(":patient_name_ar", $name_ar);
$execUpdatePatientInfo->bindValue(":ymca_id", $ymca_id);
$execUpdatePatientInfo->bindValue(":patient_mother_name", $mother_name);
$execUpdatePatientInfo->bindValue(":dob", $dob);
$execUpdatePatientInfo->bindValue(":gender", $gender);
$execUpdatePatientInfo->bindValue(":registration_date", $registration_date);
$execUpdatePatientInfo->bindValue(":patient_address", $patient_address);
$execUpdatePatientInfo->bindValue(":patient_phone", $patient_phone);
$execUpdatePatientInfo->bindValue(":patient_smoker", $patient_smoker);
$execUpdatePatientInfo->bindValue(":smoker_number_of_packets", $smoker_number_of_packets);
$execUpdatePatientInfo->bindValue(":alcohol", $alcohol);
$execUpdatePatientInfo->bindValue(":patient_alt_name", $patient_alt_name);
$execUpdatePatientInfo->bindValue(":patient_alt_contact_add", $patient_alt_contact_add);
$execUpdatePatientInfo->bindValue(":relation", $relation);
$execUpdatePatientInfo->bindValue(":nationality", $nationality);
$execUpdatePatientInfo->bindValue(":unhcr_registration_number", $unhcr_registration_number);
$execUpdatePatientInfo->bindValue(":comment", $comment);
$execUpdatePatientInfo->bindValue(":blood_type", $blood_type);
$execUpdatePatientInfo->bindValue(":clinic_id", $clinic_id);
$execUpdatePatientInfo->bindValue(":patient_status", $patient_status);
$execUpdatePatientInfo->execute();

$updatePatientFamilyHistory = "UPDATE patient_family_history SET diagnosis = :diagnosis WHERE patient_id = :patient_id AND clinic_id = :clinic_id";
$execUpdatePatientFamilyHistory = $conn->prepare($updatePatientFamilyHistory);
$execUpdatePatientFamilyHistory->bindValue(":diagnosis", $diagnosis);
$execUpdatePatientFamilyHistory->bindValue(":patient_id", $patient_id);
$execUpdatePatientFamilyHistory->bindValue(":clinic_id", $clinic_id);

$execUpdatePatientFamilyHistory->execute();

//Insert Into patient edit history
$newPatient2 = "INSERT INTO patient_edited(patient_id, ymca_id, patient_name_en, patient_name_ar, patient_mother_name,
          dob, gender, registration_date, patient_address, patient_phone, patient_smoker,
          smoker_number_of_packets, alcohol, patient_alt_name, patient_alt_contact_add, relation,
          nationality, unhcr_registration_number, comment, blood_type, clinic_id, patient_status, date_of_edit, comment_on_edit)
          VALUES (:patient_id, :ymca_id, aes_encrypt(:patient_name_en, :encKey), aes_encrypt(:patient_name_ar, :encKey), aes_encrypt(:patient_mother_name, :encKey),
          :dob, :gender, :registration_date, :patient_address, aes_encrypt(:patient_phone, :encKey), :patient_smoker,
          :smoker_number_of_packets, :alcohol, :patient_alt_name, :patient_alt_contact_add, :relation,
          :nationality, aes_encrypt(:unhcr_registration_number, :encKey), :comment, :blood_type, :clinic_id, :patient_status, :doe, :comment_on_edit)
          ";
$ExecNewPatient2 = $conn->prepare($newPatient2);
$ExecNewPatient2->bindValue(":encKey", $encKey);
$ExecNewPatient2->bindValue(":patient_id", $patient_id);
$ExecNewPatient2->bindValue(":ymca_id", $ymca_id);
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
echo "updated";
?>