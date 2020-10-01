<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');
$cid = $_SESSION['clinic_id'];
$mid = $_POST['mid'];
$resRemaining = array();

$getRemaining = "SELECT ((SELECT 
    sum(med_pharmacy.med_pill) from med_pharmacy
WHERE med_pharmacy.med_id=:mid AND med_pharmacy.clinic_id=:cid)
-
(SELECT 
        sum(consultation_med.given_quantity)
    FROM 
        consultation_med
    LEFT JOIN
        med_pharmacy ON med_pharmacy.med_pharmacy_id = consultation_med.med_pharmacy_id
    LEFT JOIN
        medication ON medication.med_id = med_pharmacy.med_id
    WHERE med_pharmacy.med_id=:mid AND med_pharmacy.clinic_id=:cid)) as remainingPills";
$execGetMedicationsRemaining = $conn->prepare($getRemaining);
$execGetMedicationsRemaining->bindValue(":mid", $mid);
$execGetMedicationsRemaining->bindValue(":cid", $cid);
$execGetMedicationsRemaining->execute();
$execGetMedicationsRemainingRes = $execGetMedicationsRemaining->fetch();

echo $execGetMedicationsRemainingRes['remainingPills'];

?>