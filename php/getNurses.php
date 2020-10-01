<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../php/connection.php');
$cid = $_SESSION['clinic_id'];

$getNurses = "SELECT * FROM nurse_list WHERE clinic_id = :cid ORDER BY nurse_name";
$execGetNurses = $conn->prepare($getNurses);
$execGetNurses->bindValue(':cid', $cid);
$execGetNurses->execute();

$getNursesResult = $execGetNurses->fetchAll();
?>