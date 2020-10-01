<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$clinic_id = $_SESSION['clinic_id'];
$pid = $_POST['pid'];
$test_date = $_POST['test_date'];
$status = 'Active';
$gly = $_POST['gly'];
$hba = $_POST['hba'];
$cre = $_POST['cre'];
$ure = $_POST['ure'];
$ast = $_POST['ast'];
$alt = $_POST['alt'];
$tot = $_POST['tot'];
$hdl = $_POST['hdl'];
$comment = $_POST['comment'];

$addTest  = "INSERT INTO lab_test(clinic_id, patient_id, lab_status, test_date,
								  glycemia, hba, creatinine, urea, ast, alt,
								  lab_total_cholesterol, lab_hdl_cholesterol, lab_comment)
			 VALUES (:cid, :pid, :status, :test_date, :gly, :hba, :cre, :ure,
			         :ast, :alt, :tot, :hdl, :comment)";

$execAddtest = $conn->prepare($addTest);
$execAddtest->bindValue(':cid', $clinic_id);
$execAddtest->bindValue(':pid', $pid);
$execAddtest->bindValue(':status', $status);
$execAddtest->bindValue(':test_date', $test_date);
$execAddtest->bindValue(':gly', $gly);
$execAddtest->bindValue(':hba', $hba);
$execAddtest->bindValue(':cre', $cre);
$execAddtest->bindValue(':ure', $ure);
$execAddtest->bindValue(':ast', $ast);
$execAddtest->bindValue(':alt', $alt);
$execAddtest->bindValue(':tot', $tot);
$execAddtest->bindValue(':hdl', $hdl);
$execAddtest->bindValue(':comment', $comment);
$execAddtest->execute();

echo "Added";
?>