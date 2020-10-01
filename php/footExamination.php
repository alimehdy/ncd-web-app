<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$pid = $_POST['pid'];

$date_of_exam = $_POST['date_of_exam'];

$prev_ulcer_left = $_POST['prev_ulcer_left'];
$prev_ulcer_right = $_POST['prev_ulcer_right'];
$prev_amput_left = $_POST['prev_amput_left'];
$prev_amput_right = $_POST['prev_amput_right'];
$deformity_left = $_POST['deformity_left'];
$deformity_right = $_POST['deformity_right'];
$absent_pedal_left = $_POST['absent_pedal_left'];
$absent_pedal_right = $_POST['absent_pedal_right'];
$active_ulcer_left = $_POST['active_ulcer_left'];
$active_ulcer_right = $_POST['active_ulcer_right'];
$ingrown_left = $_POST['ingrown_left'];
$ingrown_right = $_POST['ingrown_right'];
$calluses_left = $_POST['calluses_left'];
$calluses_right = $_POST['calluses_right'];
$blisters_left = $_POST['blisters_left'];
$blisters_right = $_POST['blisters_right'];
$fissure_left = $_POST['fissure_left'];
$fissure_right = $_POST['fissure_right'];
$monofilament_right_left = $_POST['monofilament_right_left'];
$monofilament_right_right = $_POST['monofilament_right_right'];
$monofilament_left_left = $_POST['monofilament_left_left'];
$monofilament_left_right = $_POST['monofilament_left_right'];

$addFootExamination = "INSERT INTO foot_examination (patient_id, date_of_exam, prev_ulcer_left, prev_ulcer_right, prev_amputation_left, prev_amputation_right, deformity_left, deformity_right, absent_pedal_pulse_left, absent_pedal_pulse_right, active_ulcer_left, active_ulcer_right, ingrown_toenail_left, ingrown_toenail_right, calluses_left, calluses_right, blisters_left, blisters_right, fissure_left, fissure_right, monofilament_right_left, monofilament_left_left, monofilament_right_right, monofilament_left_right, clinic_id) 
    VALUES (:pid,
    		:date_of_exam, 
            :prev_ulcer_left,
            :prev_ulcer_right,
            :prev_amput_left,
            :prev_amput_right,
            :deformity_left,
            :deformity_right,
            :absent_pedal_left,
            :absent_pedal_right,
            :active_ulcer_left,
            :active_ulcer_right,
            :ingrown_left,
            :ingrown_right,
            :calluses_left,
            :calluses_right,
            :blisters_left,
            :blisters_right,
            :fissure_left,
            :fissure_right,
            :monofilament_right_left,
            :monofilament_left_left,
            :monofilament_right_right,
            :monofilament_left_right,
            :clinic_id)";
$execAddFootExamination = $conn->prepare($addFootExamination);
$execAddFootExamination->bindValue(':pid', $pid);
$execAddFootExamination->bindValue(':date_of_exam', $date_of_exam);
$execAddFootExamination->bindValue(':prev_ulcer_left', $prev_ulcer_left);
$execAddFootExamination->bindValue(':prev_ulcer_right', $prev_ulcer_right);
$execAddFootExamination->bindValue(':prev_amput_left', $prev_amput_left);
$execAddFootExamination->bindValue(':prev_amput_right', $prev_amput_right);
$execAddFootExamination->bindValue(':deformity_left', $deformity_left);
$execAddFootExamination->bindValue(':deformity_right', $deformity_right);
$execAddFootExamination->bindValue(':absent_pedal_left', $absent_pedal_left);
$execAddFootExamination->bindValue(':absent_pedal_right', $absent_pedal_right);
$execAddFootExamination->bindValue(':active_ulcer_left', $active_ulcer_left);
$execAddFootExamination->bindValue(':active_ulcer_right', $active_ulcer_right);
$execAddFootExamination->bindValue(':ingrown_left', $ingrown_left);
$execAddFootExamination->bindValue(':ingrown_right', $ingrown_right);
$execAddFootExamination->bindValue(':calluses_left', $calluses_left);
$execAddFootExamination->bindValue(':calluses_right', $calluses_right);
$execAddFootExamination->bindValue(':blisters_left', $blisters_left);
$execAddFootExamination->bindValue(':blisters_right', $blisters_right);
$execAddFootExamination->bindValue(':fissure_left', $fissure_left);
$execAddFootExamination->bindValue(':fissure_right', $fissure_right);
$execAddFootExamination->bindValue(':monofilament_right_left', $monofilament_right_left);
$execAddFootExamination->bindValue(':monofilament_right_right', $monofilament_right_right);
$execAddFootExamination->bindValue(':monofilament_left_left', $monofilament_left_left);
$execAddFootExamination->bindValue(':monofilament_left_right', $monofilament_left_right);
$execAddFootExamination->bindValue(':clinic_id', $cid);
$execAddFootExamination->execute();

echo "added";

?>