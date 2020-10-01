<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('connection.php');

$getComplications = "SELECT * FROM complication ORDER BY complication_name ASC";
$execGetComplications = $conn->prepare($getComplications);
$execGetComplications->execute();
$getExecGetComplications = $execGetComplications->fetchAll();
?>