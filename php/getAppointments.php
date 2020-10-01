<?php
  include_once('../php/connection.php');
  header("Content-type:application/json");
  $cid = $_SESSION['clinic_id'];
  $doa = $_POST['doa'];
  $res = array();
  $getApp = "SELECT t1.next_appointment_date, t1.next_appointment_time, t2.patient_id, CONVERT(aes_decrypt(t2.patient_name_en, 'medair2017') USING utf8mb4) as patient_name_en, CONVERT(aes_decrypt(t2.patient_phone, 'medair2017') USING utf8mb4) as patient_phone, t2.patient_alt_name, t2.patient_alt_contact_add FROM appointment t1 JOIN patient t2 WHERE t1.clinic_id = :cid AND t1.next_appointment_date = :doa AND t1.patient_id = t2.patient_id";
  $execGetApp = $conn->prepare($getApp);
  $execGetApp->bindValue(':cid', $cid);
  $execGetApp->bindValue(':doa', $doa);
  $execGetApp->execute();
  $i = 0;
  foreach($execGetApp as $result)
  {
	$res[$i] = $result;
	$i++;
  }
  echo json_encode($res);
?>