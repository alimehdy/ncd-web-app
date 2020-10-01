<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$cid = $_SESSION['clinic_id'];
$diabetes_assessment_id = $_POST['diabetes_assessment_id'];
$deleteQuery = "DELETE FROM diabetes_assessment WHERE diabetes_assessment_id = :diabetes_assessment_id AND clinic_id = :cid";
$execDeleteQuery = $conn->prepare($deleteQuery);
$execDeleteQuery->bindValue(':cid', $cid);
$execDeleteQuery->bindValue(':diabetes_assessment_id', $diabetes_assessment_id);
$execDeleteQuery->execute();

echo "deleted";
?>