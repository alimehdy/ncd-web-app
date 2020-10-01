<?php
error_reporting(E_ALL);
ini_set('display_error', 1);
require_once('../php/connection.php');

$cid = $_SESSION['clinic_id'];
$barcode = '%'.$_POST['barcode'].'%';

$searchBarcode = "SELECT * FROM med_pharmacy WHERE clinic_id = :cid AND med_barcode LIKE :barcode";
$execSearchBarcode = $conn->prepare($searchBarcode);
$execSearchBarcode->bindValue(':cid', $cid);
$execSearchBarcode->bindValue(':barcode', $barcode);
$execSearchBarcode->execute();
$res = $execSearchBarcode->fetch();

echo $res['med_pharmacy_id'];
?>